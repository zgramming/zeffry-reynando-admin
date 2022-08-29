<?php

namespace App\Http\Controllers\ZeffryReynando;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\Models\ZeffryReynando\Profile;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;
use Throwable;

class ProfileController extends Controller
{
    public function index()
    {

        $keys = [
            'row' => Profile::whereNotNull('id')->first()
        ];
        return view('zeffry-reynando.profile.data', $keys);
    }

    /**
     * @throws Throwable
     */
    public function save(int $id = 0): JsonResponse|Redirector|RedirectResponse|Application
    {
        try {
            DB::beginTransaction();
            $row = Profile::find($id);
            $post = request()->all();
            $rules = [
                'name' => ['required'],
                'motto' => ['required'],
                'description' => ['required'],
            ];

            if (!empty($post['image'])) $rules['image'] = ['required', 'image'];

            $validator = Validator::make($post, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator->messages())->withInput();
            }

            $data = [
                'name' => $post['name'],
                'motto' => $post['motto'],
                'description' => $post['description'],
            ];

            if (!empty($post['image'])) {
                $isExists = Storage::disk('public')->has("images/profile/$row?->image");
                $data['image'] = uploadImage($post['image'], Constant::PATH_IMAGE_PROFILE, $isExists ? $row?->image : null);
            }


            $result = Profile::updateOrCreate(['id' => $id], $data);
            if (!$result) throw new Exception("Failed to save profile", 400);

            /// Commit Transaction
            DB::commit();
            if (!empty($post['form_type'])) {
                $message = "Yess Berhasil Insert / Update";
                session()->flash('success', $message);
                return response()->json(['success' => true, 'message' => $message], 200);
            }
            return redirect('zeffry-reynando/profile')->with('success', !empty($id) ? "Berhasil update" : "Berhasil membuat");
        } catch (QueryException $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;

            if (!empty($post['form_type'])) return response()->json(['success' => false, 'errors' => $message], $code);
            return back()->withErrors($message)->withInput();
        } catch (Throwable $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;

            if (!empty($post['form_type'])) return response()->json(['success' => false, 'errors' => $message], $code);
            return back()->withErrors($message)->withInput();
        }

    }
}
