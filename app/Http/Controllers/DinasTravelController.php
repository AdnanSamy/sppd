<?php

namespace App\Http\Controllers;

use App\Models\DinasTravel;
use App\Models\ItemDinasTravel;
use App\Models\ItemRequest;
use Illuminate\Http\Request;

class DinasTravelController extends Controller
{
    //

    public function readOne(Request $req, $id)
    {
        try {
            $dinasTravel = DinasTravel::where('id', $id)
                ->get();

            return [
                'message' => 'success',
                'data' => $dinasTravel,
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ];
        }
    }

    public function readAll(Request $req)
    {
        try {
            $dinasTravel = DinasTravel::all();

            return [
                'message' => 'success',
                'data' => $dinasTravel,
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ];
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

            return [
                'message' => 'success',
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ];
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

            return [
                'message' => 'success',
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ];
        }
    }

    public function delete(Request $req, $id)
    {
        try {
            DinasTravel::destroy($id);

            return [
                'message' => 'success',
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ];
        }
    }
}
