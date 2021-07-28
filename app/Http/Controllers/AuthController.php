<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('user', $request->user)->first();

        if (!$user || $user->password != $request->password) {
            return ['error' => 'error-text'];
        }

        return ['token']; //缺make token method
    }
}
