<?php

namespace App\Http\Controllers;

use App\Models\DinasTravel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboards')
            ->with([
                'user' => Auth::user(),
            ]);
    }

    public function getItemRequest(Request $req)
    {
        try {
            $itemRequests = DB::table('item_dinas_travel as itd')
                ->selectRaw('ir.item_dinas_travel_id, itd.item, count(ir.item_dinas_travel_id) as count_num')
                ->leftJoin('item_request as ir', 'itd.id', '=', 'ir.item_dinas_travel_id')
                ->groupBy('ir.item_dinas_travel_id', 'itd.item')
                ->get();

            return response()->json([
                'message' => 'success',
                'data' => $itemRequests,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getRequestDataPerMonth(Request $req)
    {

        try {
            $months = [
                [
                    'month' => 'January',
                    'num' => 1,
                    'data' => 0,
                ],
                [
                    'month' => 'February',
                    'num' => 2,
                    'data' => 0,
                ],
                [
                    'month' => 'March',
                    'num' => 3,
                    'data' => 0,
                ],
                [
                    'month' => 'April',
                    'num' => 4,
                    'data' => 0,
                ],
                [
                    'month' => 'May',
                    'num' => 5,
                    'data' => 0,
                ],
                [
                    'month' => 'June',
                    'num' => 6,
                    'data' => 0,
                ],
                [
                    'month' => 'July',
                    'num' => 7,
                    'data' => 0,
                ],
                [
                    'month' => 'August',
                    'num' => 8,
                    'data' => 0,
                ],
                [
                    'month' => 'September',
                    'num' => 9,
                    'data' => 0,
                ],
                [
                    'month' => 'October',
                    'num' => 10,
                    'data' => 0,
                ],
                [
                    'month' => 'November',
                    'num' => 11,
                    'data' => 0,
                ],
                [
                    'month' => 'December',
                    'num' => 12,
                    'data' => 0,
                ],
            ];
            for ($i = 0; $i < count($months); $i++) {
                $dinasTravel = DB::table('dinas_travel')
                    ->select('created_at')
                    ->whereRaw('MONTH(created_at) = ?', [$months[$i]['num']])
                    ->count();

                Log::info("DINAS " . $dinasTravel);

                $months[$i]['data'] = $dinasTravel;
            }

            return response()->json([
                'message' => 'success',
                'data' => $months,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
