<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('user token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => $token,
            'user' => $user,
        ]);
    }
    public function me()
    {
        $id = Auth::user()->id;
        $role = Auth::user()->role;
        
        if ($role == 2) {
            # code...
            $users = DB::select("SELECT * FROM users, siswa WHERE users.id = siswa.id_users AND users.id = $id ");
            return response()->json([
                'success' => true,
                'message' => 'Data tersedia',
                'data' => $users,
            ]);
        }else{
            $guru = DB::select("SELECT * FROM users, guru WHERE users.id = guru.id_users AND users.id = $id");
            return response()->json([
                'success' => true,
                'message' => 'Data tersedia',
                'data' => $guru,
            ]);
        }
    }
}
