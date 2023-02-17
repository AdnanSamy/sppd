<?php

namespace App\Http\Controllers;

use App\Models\ItemDinasTravel;
use Illuminate\Http\Request;

class ItemDinasTravelController extends Controller
{
    public function readOne(Request $req, $id)
    {
        try {
            $itemDinasTravel = ItemDinasTravel::where('id', $id)
                ->get();

            return [
                'message' => 'success',
                'data' => $itemDinasTravel,
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
            $itemDinasTravel = ItemDinasTravel::all();

            return [
                'message' => 'success',
                'data' => $itemDinasTravel,
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
            $itemDinasTravel = new ItemDinasTravel();
            $itemDinasTravel->item = $req->item;
            $itemDinasTravel->save();

            return [
                'message' => 'success',
                'data' => $itemDinasTravel
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
            $itemDinasTravel = ItemDinasTravel::find($req->id);
            $itemDinasTravel->item = $req->item;
            $itemDinasTravel->save();

            return [
                'message' => 'success',
                'data' => $itemDinasTravel,
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
            ItemDinasTravel::destroy($id);

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
