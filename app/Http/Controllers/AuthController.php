<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function user_login(Request $request): JsonResponse
    {
        $request->validate([
            'sidimei' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('sidimei', $request->get('sidimei'))->first();
        //如果不是使用者或者是密碼不正確的話，回傳ERROR
        if (!$user || $user->password != $request->get('password')) {
            return response()->json(['error' => 'User does not exist or Wrong password'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        $user->update(['token' => $token]);

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
        $user = User::where('sidimei', $request->get('sidimei'))->first();
        if (!$user) {
            $tourist = User::create(['sidimei' => $request->get('sidimei')]);
            $token = $tourist->createToken('token')->plainTextToken;
            $tourist->update(['token' => $token]);

            return response()->json(['uid' => $tourist->id, 'token' => $token]);
        }
        $token = $user->createToken('token')->plainTextToken;
        $user->update(['token' => $token]);

        return response()->json(['uid' => $user->id, 'token' => $token]);
    }

    public function revoke_token(Request $request): JsonResponse
    {
        $request->validate([
            'sidimei' => 'required|string',
        ]);

        $user = User::where('sidimei', $request->get('sidimei'))->first();
        $user->update(['token' => '']);

        return response()->json(['text' => 'logout!']);
    }

    public function admin_login()
    {
        return view('welcome');
    }

    public function do_admin_login(Request $request)
    {
        $user = User::where('sidimei', $request->get('sidimei'))->first();
        if (!$user or $user->role != 99) {
            return back()->with('error');
        }
        if (($request->get('password') != $user->password)) {
            return back()->with('error');
        }
        $people = DB::table('monitoring')->orderBy('sos', 'desc')->get();
        $people_reverse = DB::table('monitoring')->orderBy('sos', 'asc')->get();

        return view('safe', compact('people', 'people_reverse'));
    }
}
