<?php

namespace App\Http\Controllers\ZeffryReynando;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\Models\MasterData;
use App\Models\PortfolioImages;
use App\Models\PortfolioTechnology;
use App\Models\ZeffryReynando\Portfolio;
use DataTables;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Str;
use Throwable;

class PortfolioController extends Controller
{
    public function index(): Factory|View|Application
    {
        $keys = [];

        return view('zeffry-reynando.portfolio.data', $keys);
    }

    /**
     * @throws Exception
     */
    public function datatable(): View|Factory|JsonResponse|Application
    {
        if (!request()->ajax()) return view('error.notfound');
        $values = Portfolio::with(['type', 'mainTechnology'])->get();
        $datatable = DataTables::of($values)
            ->addIndexColumn()
            ->addColumn("action", function (Portfolio $item) {
                $urlUpdate = url("zeffry-reynando/portfolio/form_modal/$item->id");
                $urlDelete = url("zeffry-reynando/portfolio/delete/$item->id");
                $field = csrf_field();
                $method = method_field('DELETE');
                return "
                <div class='d-flex flex-row'>
                    <a href=\"#\" class=\"btn btn-primary mx-1\" onclick=\"openBox('$urlUpdate',{size : 'modal-lg'})\"><i class='fa fa-edit'></i></a>
                    <form action=\"$urlDelete\" method=\"post\">
                        $field
                        $method
                        <button type=\"submit\" class=\"btn btn-danger mx-1\"><i class=\"fa fa-trash\"></i></button>
                    </form>
                </div>
                ";
            })
            ->rawColumns(['action']);

        return $datatable->toJson();
    }

    public function form_modal(int $id = 0): Factory|View|Application
    {
        $keys = [
            'row' => Portfolio::find($id),
            'imagesPreview' => PortfolioImages::wherePortfolioId($id)->get(),
            'types' => MasterData::whereMasterCategoryCode("TYPE_APPLICATION")->get(),
            'technologies' => MasterData::whereMasterCategoryCode("TECHNOLOGY")->get(),
            'otherTechnology' => PortfolioTechnology::wherePortfolioId($id)->get()->pluck('technology_id')->toArray() ?? [],
        ];

        return view('zeffry-reynando.portfolio.form.form_modal', $keys);
    }

    /**
     * @throws Throwable
     */
    public function save(int $id = 0): JsonResponse
    {
        try {
            DB::beginTransaction();
            $row = Portfolio::find($id);
            $post = request()->all();

            $rules = [
                'type_application_id' => ['required'],
                'main_technology_id' => ['required'],
                'other_technology.*' => ['required'],
                'title' => ['required'],
                'title_slug' => ['required'],
                'short_description' => ['required'],
                'full_description' => ['required'],
            ];

            if (!empty($post['banner_image'])) $rules['banner_image'] = ['image'];
            if (!empty($post['preview_image'])) $rules['preview_image.*'] = ['image'];

            $validator = Validator::make($post, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->messages(),
                ], 400);
            }

            $data = [
                'type_application_id' => $post['type_application_id'],
                'main_technology_id' => $post['main_technology_id'],
                'title' => $post['title'],
                'title_slug' => $post['title_slug'],
                'short_description' => $post['short_description'],
                'full_description' => $post['full_description'],
                'github_url' => $post['github_url'],
                'web_url' => $post['web_url'],
                'google_playstore_url' => $post['google_playstore_url'],
                'app_store_url' => $post['app_store_url'],
            ];

            if (!empty($post['banner_image'])) {
                $data['banner_image'] = uploadImage($post['banner_image'], Constant::PATH_IMAGE_BANNER_PORTFOLIO, $row?->banner_image ?? null);
            }

            $result = Portfolio::updateOrCreate(['id' => $id], $data);

            /// Cleansing & Insert Portfolio Other Technology
            PortfolioTechnology::wherePortfolioId($result->id)->delete();
            $technologies = [];
            $now = date('Y-m-d H:i:s');
            foreach ($post['other_technology'] as $key => $value) {
                $technologies[] = [
                    'id' => Str::uuid(),
                    'portfolio_id' => $result->id,
                    'technology_id' => $value,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            PortfolioTechnology::insert($technologies);

            /// Hanya jalankan upload multiple image ketika ada filenya & mode insert
            /// Jika mode update, gunakan ajax untuk menghapus / upload satuan
            if (!empty($post['preview_image']) && empty($row)) {
                $images = [];
                $now = date('Y-m-d H:i:s');

                foreach ($post['preview_image'] as $key => $image) {
                    $imageName = uploadImage($image, Constant::PATH_IMAGE_PREVIEW_PORTFOLIO);
                    $images[] = [
                        'id' => Str::uuid(),
                        'image' => $imageName,
                        'portfolio_id' => $result->id,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                PortfolioImages::insert($images);
            }

            if (!$result) throw new Exception("Terjadi kesalahan saat proses penyimpanan, lakukan beberapa saat lagi...", 400);

            /// Commit Transaction
            DB::commit();
            $message = "Yess Berhasil Insert / Update";
            session()->flash('success', $message);
            return response()->json(['success' => true, 'message' => $message], 200);
        } catch (QueryException $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;
            return response()->json(['success' => false, 'errors' => $message], $code);
        } catch (Throwable $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;
            return response()->json(['success' => false, 'errors' => $message], $code);
        }
    }

    /**
     * @throws Throwable
     */
    public function delete(int $id = 0): Redirector|Application|RedirectResponse
    {
        try {
            DB::beginTransaction();

            $row = Portfolio::findOrFail($id);

            /// Delete image before delete data
            Storage::disk('public')->delete(Constant::PATH_IMAGE_BANNER_PORTFOLIO . "/$row->banner_image");

            /// Delete preview images
            $previewImages = PortfolioImages::wherePortfolioId($id)->get();
            foreach ($previewImages as $key => $image) {
                Storage::disk('public')->delete(Constant::PATH_IMAGE_PREVIEW_PORTFOLIO . "/$image->image");
            }

            $row->delete();

            /// Commit Transaction
            DB::commit();
            return redirect('zeffry-reynando/portfolio')->with('success', 'Berhasil menghapus data !!!');
        } catch (QueryException $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            return back()->withErrors($message)->withInput();
        } catch (Throwable $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            return back()->withErrors($message)->withInput();
        }
    }

    /**
     * Ajax
     */

    public function addImagePreview($id = 0): Model|PortfolioImages|JsonResponse
    {
        try {
            $request = request()->all();
            $data = [
                'id' => Str::uuid(),
                'image' => uploadImage($request['file'], Constant::PATH_IMAGE_PREVIEW_PORTFOLIO),
                'portfolio_id' => $id,
            ];
            $result = PortfolioImages::create($data);
            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (Throwable $e) {
            /// Rollback Transaction
            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;
            return response()->json(['success' => false, 'errors' => $message], $code);
        }
    }

    public function removeImagePreview($portfolioImageId = 0): JsonResponse
    {
        try {
            $image = PortfolioImages::find($portfolioImageId);
            Storage::disk('public')->delete(Constant::PATH_IMAGE_PREVIEW_PORTFOLIO . "/$image->image");
            $image->delete();

            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            /// Rollback Transaction
            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;
            return response()->json(['success' => false, 'errors' => $message], $code);
        }
    }
}
