<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function readAll(Request $req)
    {
        try {
            $role = Role::get();

            return response()->json([
                'message' => 'success',
                'data' => $role,
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Internal Server Error',
                'detail' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
