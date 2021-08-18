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
            return response()->json(['error'=>'Unauthorised'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        $user->update(['token'=>$token]);

        return ['token' => $token,
                'role' => $user->role,
                'name' => $user->name,
                'uid' => $user->id
                ];
    }

    public function tourist_login(Request $request): array
    {
        $request->validate([
            'sidimei' => 'required|string',
            'role' => 'required|string', //可移除?
            'name' => 'required', //可以除?
        ]);

        $tourist = User::create(['sidimei' => $request->sidimei,
            'role' => $request->role,
            'name' =>$request->name]);

        return ['token' => $tourist->createToken('token')->plainTextToken];
    }

    public function revoke_token(Request $request): array
    {
        $request->validate([
            'sidimei' => 'required|string',
        ]);

        $user = User::where('sidimei', $request->sidimei)->first();
        $user->update(['token'=>'']);
        //$request->user()->currentAccessToken()->delete();
        return ['text' => 'logout!'];
    }
}
