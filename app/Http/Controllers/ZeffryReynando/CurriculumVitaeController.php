<?php

namespace App\Http\Controllers\ZeffryReynando;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\Models\ZeffryReynando\CurriculumVitae;
use DataTables;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CurriculumVitaeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $keys = [];

        return view('zeffry-reynando.cv.data', $keys);
    }

    /**
     * @throws Exception
     */
    public function datatable(): View|Factory|JsonResponse|Application
    {
        if (!request()->ajax()) return view('error.notfound');

        $values = CurriculumVitae::all();
        $datatable = DataTables::of($values)
            ->addIndexColumn()
            ->addColumn('file',function(CurriculumVitae $item){
                $url = url("api/cv/download/$item->id");
                return "<a href='$url' target='_blank' style='color: red' ><i class='fas fa-file-pdf'></i></a>";
            })
            ->addColumn("action", function (CurriculumVitae $item) {
                $urlUpdate = url("zeffry-reynando/cv/form_modal/$item->id");
                return "
                <div class='d-flex flex-row'>
                    <a href=\"#\" class=\"btn btn-primary mx-1\" onclick=\"openBox('$urlUpdate',{size : 'modal-lg'})\"><i class='fa fa-edit'></i></a>
                </div>
                ";
            })
            ->rawColumns(['file','action']);

        return $datatable->toJson();
    }

    public function form_modal(int $id = 0): Factory|View|Application
    {
        $keys = [
            'row' => CurriculumVitae::find($id),
        ];

        return view('zeffry-reynando.cv.form.form_modal', $keys);
    }

    /**
     * @throws Throwable
     */
    public function save(int $id = 0): JsonResponse
    {
        try {
            $row = CurriculumVitae::find($id);
            $post = request()->all();
            $file = $post['file'] ?? null;

            $rules = [];
            if (!empty($file)) $rules['file'] = ['mimes:pdf'];

            $validator = Validator::make($post, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->messages(),
                ], 400);
            }

            $data = [
                'version' => empty($row) ? 1 : $row->version + 1,
            ];

            if (!empty($file)) {
                $data['name'] = uploadFile($file, Constant::PATH_FILE_CV, $row?->name);
            }

            $result = CurriculumVitae::updateOrCreate(['id' => $row?->id], $data);
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

}
