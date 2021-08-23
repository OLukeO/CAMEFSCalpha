<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user_login(Request $request): JsonResponse
    {
        $request->validate([
            'sidimei' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('sidimei', $request->get('sidimei'))->first();

        if (!$user || $user->password != $request->get('password')) {
            return response()->json(['error'=>'User does not exist or Wrong password'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        $user->update(['token'=>$token]);

        return response()->json(['uid' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'token' => $token,
                ]);
    }

    public function tourist_login(Request $request): JsonResponse
    {
        $request->validate([
            'sidimei' => 'required|string',
        ]);

        if (User::where('sidimei', $request->get('sidimei'))->first()) {
            return response()->json(['error'=>'sidimei already exist']);
        }

        $tourist = User::create(['sidimei' => $request->get('sidimei')]);

        return response()->json(['token' => $tourist->createToken('token')->plainTextToken]); // 不用?
    }

    public function revoke_token(Request $request): JsonResponse
    {
        $request->validate([
            'sidimei' => 'required|string',
        ]);

        $user = User::where('sidimei', $request->get('sidimei'))->first();
        $user->update(['token'=>'']);

        return response()->json(['text' => 'logout!']);
    }
}
