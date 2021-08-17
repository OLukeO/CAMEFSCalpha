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
            'sidimei' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('sidimei', $request->sidimei)->first();

        if (!$user || $user->password != $request->password) {
            return response()->json(['error'=>'Unauthorised'], 401);
        }

        return ['token' => $user->createToken('token')->plainTextToken, 'role' => $user->role,
            'name' => $user->name, 'uid' => $user->id];
    }

    public function tourist_login(Request $request)
    {
        $request->validate([
            'sidimei' => 'required',
            'role' => 'required',
            'name' => 'required',
        ]);

        $tourist = User::create(['sidimei' => $request->sidimei, 'role' => $request->role, 'name' =>$request->name]);

        return ['token' => $tourist->createToken('token')->plainTextToken];
    }

    public function revoke_token(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([],204);
    }
}
