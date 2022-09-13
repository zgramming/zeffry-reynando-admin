<?php

namespace App\Http\Controllers\ZeffryReynando;

use App\Http\Controllers\Controller;
use App\Models\ZeffryReynando\Portfolio;
use App\Models\ZeffryReynando\Statistic;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class StatisticController extends Controller
{
    public function index(): Factory|View|Application
    {
        $keys = [];

        return view('zeffry-reynando.statistic.data', $keys);
    }

    /**
     * @throws Exception
     */
    public function datatable(): View|Factory|JsonResponse|Application
    {
        if (!request()->ajax()) return view('error.notfound');
        $values = Statistic::all();
        $datatable = DataTables::of($values)
            ->addIndexColumn();
        return $datatable->toJson();
    }
}
