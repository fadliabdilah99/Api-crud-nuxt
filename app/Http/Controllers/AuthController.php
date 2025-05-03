<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        Log::info($request->all());
        $credentials = $request->only('email', 'password');

        if ($token = Auth::guard('api')->attempt($credentials)) {
            Log::info('User dengan email ' . $request->email . ' berhasil login');
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
                'user' => Auth::user(),
            ]);
        }

        Log::warning('User dengan email ' . $request->email . ' gagal login');
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }
}
