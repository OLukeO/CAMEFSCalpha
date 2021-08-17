<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user_login(Request $request): array
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('user', $request->user)->first();

        if (!$user || $user->password != $request->password) {
            return ['error' => 'error-text'];
        }

        return ['token' => $user->createToken('token')->plainTextToken];
    }

    public function guests_login(): array
    {
        return ['token' => "aaaa"];
    }

    public function revoke_token(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([],204);
    }
}
