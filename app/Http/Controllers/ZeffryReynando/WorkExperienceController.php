<?php

namespace App\Http\Controllers\ZeffryReynando;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\Models\MasterData;
use App\Models\ZeffryReynando\WorkExperience;
use DataTables;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Storage;
use Throwable;

class WorkExperienceController extends Controller
{
    public function index(): Factory|View|Application
    {
        $keys = [];

        return view('zeffry-reynando.work-experience.data', $keys);
    }

    /**
     * @throws Exception
     */
    public function datatable(): View|Factory|JsonResponse|Application
    {
        if (!request()->ajax()) return view('error.notfound');
        $values = WorkExperience::with(['company', 'job'])->get();
        $datatable = DataTables::of($values)
            ->addIndexColumn()
            ->addColumn("action", function (WorkExperience $experience) {
                $urlUpdate = url("zeffry-reynando/work-experience/form_modal/$experience->id");
                $urlDelete = url("zeffry-reynando/work-experience/delete/$experience->id");
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
            'row' => WorkExperience::find($id),
            'companies' => MasterData::whereMasterCategoryCode("COMPANY")->get(),
            'jobs' => MasterData::whereMasterCategoryCode("JOB")->get()
        ];

        return view('zeffry-reynando.work-experience.form.form_modal', $keys);
    }

    /**
     * @throws Throwable
     */
    public function save(int $id = 0): JsonResponse
    {
        try {
            DB::beginTransaction();
            $row = WorkExperience::find($id);
            $post = request()->all();

            $rules = [
                'job_id' => ['required'],
                'company_id' => ['required'],
                'start_date' => ['required', 'date'],
            ];

            if (!empty($post['company_image'])) $rules['company_image'] = ['image'];
            if (!empty($post['end_date'])) $rules['end_date'] = ['date'];

            $validator = Validator::make($post, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->messages(),
                ], 400);
            }

            $data = [
                'job_id' => $post['job_id'],
                'company_id' => $post['company_id'],
                'start_date' => $post['start_date'],
                'end_date' => !empty($post['end_date']) ? $post['end_date'] : null,
                'description' => $post['description'],
            ];

            if (!empty($post['company_image'])) $data['company_image'] = uploadImage($post['company_image'], Constant::PATH_IMAGE_COMPANY, $row?->company_image ?? null);

            $result = WorkExperience::updateOrCreate(['id' => $id], $data);
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

            $row = WorkExperience::findOrFail($id);

            /// Delete image before delete data
            Storage::disk('public')->delete(Constant::PATH_IMAGE_COMPANY . "/$row->company_image");

            $row->delete();

            /// Commit Transaction
            DB::commit();
            return redirect('zeffry-reynando/work-experience')->with('success', 'Berhasil menghapus data !!!');
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
}
