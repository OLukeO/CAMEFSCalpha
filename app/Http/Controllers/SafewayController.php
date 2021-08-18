<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IbeaconLocation;
use App\Models\HistoryLocation;

class SafewayController extends Controller //好像需要加狀態1, 2
{
    public function start_monitor(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'minor' => 'required',
            'major' => 'required',
            'rssi' => 'required',
            'distance' => 'required',
            'txpower' => 'required',
            'apitoken' => 'required',
        ]);

        $user = User::where('id', $request->uid)->first();
        $ibeacon = IbeaconLocation::where('major', $request->major)->first();

        if (!$user || $request->apitoken != $user->token || !$ibeacon) // token認證
        {
            return response()->json(['error'=>'Unauthorised'], 401);
        }

        HistoryLocation::create(['uid' => $user->id,
                                'rssi' => $request->rssi,
                                'distance' => $request->distance,
                                'txpower' => $request->txpower,
                                 ]);
       // $ibeacon->id  顯示ibeaconID對應的位置

        return [$user->id, $user->name, $ibeacon->minor, $ibeacon->major]; //傳user, 位置給view
    }

    public function end_monitor(Request $request) //確認關閉app會call此api
    {
        $request->validate([
            'uid' => 'required',
        ]);

        return 0; // 感覺不用傳啥
    }

    public function sos(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'minor' => 'required',
            'major' => 'required',
            'rssi' => 'required',
            'distance' => 'required',
            'txpower' => 'required',
            'apitoken' => 'required',
        ]);
        return 0; //改為求救狀態
    }
}
