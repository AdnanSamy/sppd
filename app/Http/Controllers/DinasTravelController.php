<?php

namespace App\Http\Controllers;

use App\Models\DinasTravel;
use App\Models\ItemDinasTravel;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DinasTravelController extends Controller
{
    //

    public function index()
    {
        return view('dinas_travel');
    }

    public function travelNeedApproval()
    {
        return view('dinas_need_approval');
    }

    public function travelNeedPaid()
    {
        return view('dinas_need_paid');
    }

    public function approve(Request $req)
    {
        try {

            $dinasTravel = DinasTravel::find($req->id);
            $dinasTravel->status = 'approved';
            $dinasTravel->save();

            return response()->json([
                'message' => 'success',
                'data' => $dinasTravel,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reject(Request $req)
    {
        try {

            $dinasTravel = DinasTravel::find($req->id);
            $dinasTravel->status = 'rejected';
            $dinasTravel->note = $req->note;
            $dinasTravel->save();

            return response()->json([
                'message' => 'success',
                'data' => $dinasTravel,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function readAllByNeedApproval(Request $req)
    {
        try {
            $dinasTravel = DinasTravel::where('status', 'need_approval')->get();

            return response()->json([
                'message' => 'success',
                'data' => $dinasTravel,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function readAllByNeedPaid(Request $req)
    {
        try {
            $dinasTravel = DinasTravel::where('status', 'approved')->get();

            return response()->json([
                'message' => 'success',
                'data' => $dinasTravel,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function readOne(Request $req, $id)
    {
        try {
            $dinasTravel = DinasTravel::where('id', $id)
                ->with('itemRequest.itemDinasTravel')
                ->first();

            return response()->json([
                'message' => 'success',
                'data' => $dinasTravel,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function readAll(Request $req)
    {
        try {
            $dinasTravel = DinasTravel::all();

            return response()->json([
                'message' => 'success',
                'data' => $dinasTravel,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $req)
    {
        try {
            DB::beginTransaction();

            $dinasTravel = new DinasTravel;
            $dinasTravel->judul = $req->judul;
            $dinasTravel->total = $req->total;
            $dinasTravel->status = 'need_approval';
            $dinasTravel->save();

            foreach ($req->itemRequest as $item) {
                $itemDinasTravel = ItemDinasTravel::where('id', $item['item_dinas_travel_id'])->first();

                $itemRequest = new ItemRequest;
                $itemRequest->dinasTravel()->associate($dinasTravel);
                $itemRequest->itemDinasTravel()->associate($itemDinasTravel);
                $itemRequest->price = $item['price'];

                $itemRequest->save();
            }

            DB::commit();
            return response()->json([
                'message' => 'success',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
                'code' => $th->getLine(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $req)
    {
        try {
            $dinasTravel = DinasTravel::find($req->id);
            $dinasTravel->status = 'need_approval';
            $dinasTravel->judul = $req->judul;
            $dinasTravel->total = $req->total;
            $dinasTravel->save();

            ItemRequest::where('dinas_travel_id', $dinasTravel->id)->delete();

            foreach ($req->itemRequest as $item) {
                $itemDinasTravel = ItemDinasTravel::where('id', $item['item_dinas_travel_id'])->first();

                $itemRequest = new ItemRequest;
                $itemRequest->dinasTravel()->associate($dinasTravel);
                $itemRequest->itemDinasTravel()->associate($itemDinasTravel);
                $itemRequest->price = $item['price'];

                $itemRequest->save();
            }

            return response()->json([
                'message' => 'success',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Request $req, $id)
    {
        try {
            DinasTravel::destroy($id);

            return response()->json([
                'message' => 'success',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
