<?php

use App\Constant\Constant;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ZeffryReynando\PortfolioController;
use App\Models\MasterData;
use App\Models\ZeffryReynando\Portfolio;
use App\Models\ZeffryReynando\Profile;
use App\Models\ZeffryReynando\WorkExperience;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('menu/get_menu_by_modul/{id_modul}', [MenuController::class, 'getMenuByModul']);

Route::post("portfolio/upload_image_preview/{portfolio_id}", [PortfolioController::class, 'addImagePreview']);
Route::post("portfolio/remove_image_preview/{portfolio_id}", [PortfolioController::class, 'removeImagePreview']);

Route::prefix('work-experience')->group(function () {
    Route::get('/', function (Request $request) {
        $workExperience = WorkExperience::with(['company', 'job'])->orderBy('start_date', 'DESC')->get()->toArray();
        $workExperience = array_map(fn($item) => [...$item, 'company_image' => asset(sprintf("%s/%s/%s", 'storage', Constant::PATH_IMAGE_COMPANY, $item['company_image']))], $workExperience);
        return response()->json(['success' => true, 'data' => $workExperience]);
    });
});

Route::prefix('portfolio')->group(function () {
    Route::get('/', function (Request $request) {
        $portfolios = Portfolio::with([
            'mainTechnology' => fn(BelongsTo $item) => $item->select(['id', 'name']),
            'type' => fn(BelongsTo $item) => $item->select(['id', 'name']),
            'otherTechnology' => fn(HasMany $item) => $item->select(['id', 'portfolio_id', 'technology_id']),
//            'previewImages' => fn(HasMany $item) => $item->select(['id', 'portfolio_id', 'image']),
            'otherTechnology.technology' => fn(BelongsTo $item) => $item->select(['id', 'name']),
        ])->get();
        return response()->json(['success' => true, 'data' => $portfolios]);
    });

    Route::get('/{id}', function (Request $request, int $id = 0) {
        $portfolio = Portfolio::with([
            'mainTechnology' => fn(BelongsTo $item) => $item->select(['id', 'name']),
            'type' => fn(BelongsTo $item) => $item->select(['id', 'name']),
            'otherTechnology' => fn(HasMany $item) => $item->select(['id', 'portfolio_id', 'technology_id']),
            'previewImages' => fn(HasMany $item) => $item->select(['id', 'portfolio_id', 'image']),
            'otherTechnology.technology' => fn(BelongsTo $item) => $item->select(['id', 'name']),
        ])->find($id);

        $portfolio->banner_image = asset(sprintf("%s/%s/%s", "storage", Constant::PATH_IMAGE_BANNER_PORTFOLIO, $portfolio->banner_image));
        $portfolio->previewImages = $portfolio->previewImages->map(function($item){
            $item->image = asset(sprintf("%s/%s/%s","storage",Constant::PATH_IMAGE_PREVIEW_PORTFOLIO,$item->image));
            return $item;
        });
        return response()->json(['success' => true, 'data' => $portfolio]);
    });
});

Route::prefix("home")->group(function () {
    Route::get("profile", function (Request $request) {
        $profile = Profile::whereNotNull('id')->first();
        return response()->json(['success' => true, 'data' => $profile]);
    });

    Route::get('my_statistic', function (Request $request) {
        $totalWorkExperience = WorkExperience::count('id');
        $totalApplication = Portfolio::count('id');
        $totalTechnologyUsed = MasterData::whereMasterCategoryCode('TECHNOLOGY')->count('id');

        return response()->json(['success' => true, 'data' => [
                'total_work_experience' => $totalWorkExperience,
                'total_application' => $totalApplication,
                'total_technology_used' => $totalTechnologyUsed]
            ]
        );
    });

    Route::get('most_used_technology', function (Request $request) {
        $technology = MasterData::select(['id', 'name', 'parameter1_value as imageUrl'])
            ->limit(4)
            ->orderBy('total_technology_used', 'DESC')
            ->whereMasterCategoryCode('TECHNOLOGY')
            ->withCount(['totalTechnologyUsed as total_technology_used'])
            ->get();
        return response()->json(['success' => true, 'data' => $technology]);
    });
});
