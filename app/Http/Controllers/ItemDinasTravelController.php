<?php

namespace App\Http\Controllers;

use App\Models\ItemDinasTravel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ItemDinasTravelController extends Controller
{

    public function index()
    {
        return view('item_dinas_travel')
            ->with([
                'user' => Auth::user(),
            ]);
    }

    public function readOne(Request $req, $id)
    {
        try {
            $itemDinasTravel = ItemDinasTravel::where('id', $id)
                ->first();

            return response()->json([
                'message' => 'success',
                'data' => $itemDinasTravel,
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
            $itemDinasTravel = ItemDinasTravel::all();

            return response()->json([
                'message' => 'success',
                'data' => $itemDinasTravel,
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
            $itemDinasTravel = new ItemDinasTravel();
            $itemDinasTravel->item = $req->item;
            $itemDinasTravel->save();

            return response()->json([
                'message' => 'success',
                'data' => $itemDinasTravel
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
            $itemDinasTravel = ItemDinasTravel::find($req->id);
            $itemDinasTravel->item = $req->item;
            $itemDinasTravel->save();

            return response()->json([
                'message' => 'success',
                'data' => $itemDinasTravel,
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
            ItemDinasTravel::destroy($id);

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
