<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $req)
    {
        return view('user')
            ->with([
                'user' => Auth::user(),
            ]);
    }

    public function readOne(Request $req, $id)
    {
        try {
            $user = User::where('id', $id)
                ->first();

            return response()->json([
                'message' => 'success',
                'data' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], 500);
        }
    }

    public function readAll(Request $req)
    {
        try {
            $user = User::with('role')->get();

            return response()->json([
                'message' => 'success',
                'data' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], 500);
        }
    }

    public function create(Request $req)
    {
        try {
            $role = Role::where('id', $req->role_id)->first();

            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->role()->associate($role);
            $user->save();

            return response()->json([
                'message' => 'success',
                'data' => $user
            ], 200);
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
            $role = Role::where('id', $req->role_id)->first();

            $user = User::find($req->id);
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->role()->associate($role);
            $user->save();

            return response()->json([
                'message' => 'success',
                'data' => $user,
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
            User::destroy($id);

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
