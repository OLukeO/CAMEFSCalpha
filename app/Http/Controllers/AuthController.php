<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user_login(Request $request)
    {
        $request->validate([
            'sidimei' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('sidimei', $request->sidimei)->first();

        if (!$user || $user->password != $request->password) {
            return response()->json(['error'=>'User does not exist or Wrong password'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        $user->update(['token'=>$token]);

        return ['uid' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'token' => $token,
                ];
    }

    public function tourist_login(Request $request): array
    {
        $request->validate([
            'sidimei' => 'required|string',
        ]);

        if (User::where('sidimei', $request->sidimei)->first()) {
            return ['error'=>'sidimei already exist'];
        }

        $tourist = User::create(['sidimei' => $request->sidimei]);

        return ['token' => $tourist->createToken('token')->plainTextToken]; // 不用?
    }

    public function revoke_token(Request $request): array
    {
        $request->validate([
            'sidimei' => 'required|string',
        ]);

        $user = User::where('sidimei', $request->sidimei)->first();
        $user->update(['token'=>'']);

        return ['text' => 'logout!'];
    }
}
