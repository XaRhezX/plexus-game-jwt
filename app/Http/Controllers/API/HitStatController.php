<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HitStatController extends Controller
{
    use ApiResponse;

    public function lastDay(){

        $data = DB::table('rest_api_logs')
        ->selectRaw('DATE_FORMAT(created_at, "%Y%m%d%H") as hour, count(id) as number')
        ->whereBetween('created_at', [now()->subHour(24), now()])
        ->groupBy('hour')
        ->orderBy('hour','desc')
        ->get();

        return $this->success($data);
    }

    public function lastWeek(){

        $data = DB::table('rest_api_logs')
        ->selectRaw('DATE_FORMAT(created_at, "%Y%m%d") as day, count(id) as number')
        ->whereBetween('created_at', [now()->subWeek(1), now()])
        ->groupBy('day')
        ->orderBy('day','desc')
        ->get();

        return $this->success($data);
    }

    public function lastMonth(){

        $data = DB::table('rest_api_logs')
        ->selectRaw('DATE_FORMAT(created_at, "%Y%m%d") as day, count(id) as number')
        ->whereBetween('created_at', [now()->subMonth(1), now()])
        ->groupBy('day')
        ->orderBy('day','desc')
        ->get();

        return $this->success($data);
    }
}
