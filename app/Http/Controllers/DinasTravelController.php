<?php

namespace App\Http\Controllers;

use App\Models\DinasTravel;
use App\Models\ItemDinasTravel;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DinasTravelController extends Controller
{
    //

    public function index()
    {
        return view('dinas_travel');
    }

    public function readOne(Request $req, $id)
    {
        try {
            $dinasTravel = DinasTravel::where('id', $id)
                ->get();

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
            $dinasTravel = new DinasTravel;
            $dinasTravel->judul = $req->judul;
            $dinasTravel->status = 'need_approval';
            // $dinasTravel->total = $req->total;
            $dinasTravel->save();

            $items = [];

            foreach ($req->itemRequest as $item) {
                array_push($items, [
                    'dinas_travel_id' => $dinasTravel->id,
                    'item_dinas_travel_id' => $item->itemDinasTravelId,
                    'price' => $item->price,
                ]);
            }

            ItemRequest::create($items);

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

    public function update(Request $req)
    {
        try {
            $dinasTravel = DinasTravel::find($req->id);
            $dinasTravel->judul = $req->judul;
            $dinasTravel->save();

            ItemRequest::where('dinas_travel_id', $dinasTravel->id)->delete();

            $items = [];

            foreach ($req->itemRequest as $item) {
                array_push($items, [
                    'dinas_travel_id' => $dinasTravel->id,
                    'item_dinas_travel_id' => $item->itemDinasTravelId,
                    'price' => $item->price,
                ]);
            }

            ItemRequest::create($items);

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
