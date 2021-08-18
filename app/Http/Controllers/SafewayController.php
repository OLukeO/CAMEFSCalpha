<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ibeaconlocation;

class SafewayController extends Controller
{
    public function start_monitor(Request $request){
        $request->validate([
            'uid' => 'required',

        ]);

        $user = User::where('id', $request->uid)->first();
        $ibeacon = ibeaconlocation::where('major', $request->major)->first();

       // $ibeacon->id  顯示ibeaconID對應的位置

        return [$request->uid, $user->name]; //傳user, 位置給view
    }

    public function end_monitor(Request $request){
        return 0; // 感覺不用傳啥
    }

    public function sos(Request $request){
        return 0; //改為求救狀態
    }
}
