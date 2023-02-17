<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $req){
        return view('user');
    }

    public function readOne(Request $req, $id)
    {
        try {
            $user = User::where('id', $id)
                ->get();

            return [
                'message' => 'success',
                'data' => $user,
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
            $user = User::with('role')->get();

            return [
                'message' => 'success',
                'data' => $user,
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
            $user = new User();
            $user->item = $req->item;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->role_id = $req->roleId;
            $user->save();

            return [
                'message' => 'success',
                'data' => $user
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
            $user = User::find($req->id);
            $user->item = $req->item;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->role_id = $req->roleId;
            $user->save();

            return [
                'message' => 'success',
                'data' => $user,
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
            User::destroy($id);

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
