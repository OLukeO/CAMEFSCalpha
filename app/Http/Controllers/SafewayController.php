<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IbeaconLocation;
use App\Models\HistoryLocation;
use App\Models\Monitoring;

class SafewayController extends Controller //好像需要加狀態1, 2
{
    public function start_monitor(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'minor' => 'required',
            'major' => 'required',
            'rssi' => 'required|string',
            'distance' => 'required|string',
            'txpower' => 'required|string',
            'apitoken' => 'required|string',
        ]);

        $user = User::where('id', $request->uid)->first();
        $ibeacon = IbeaconLocation::where('major', $request->major)->first(); //改以uuid分辨
        $is_monitor = Monitoring::where('uid', $request->uid)->first();

        if (!$user || $request->apitoken != $user->token || !$ibeacon) // token認證
        {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        if ($is_monitor) {
            $is_monitor->update([
                'lan' => $ibeacon['major'],
                'lng' => $ibeacon['minor'],
            ]);
        } else {
            Monitoring::create(['uid' => $user->id,
                'lan' => 20,
                'lng' => 20,
            ]);
        }

        //紀錄位置(純紀錄, 沒用)
        HistoryLocation::create(['uid' => $user->id,
            'rssi' => $request->rssi,
            'distance' => $request->distance,
            'txpower' => $request->txpower,
        ]);

        // $ibeacon->id  顯示ibeaconID對應的位置
        return null;
    }


    public function end_monitor(Request $request) //確認關閉app會call此api
    {
        $request->validate([
            'uid' => 'required',
        ]);

        $is_monitor = Monitoring::where('uid', $request->uid)->first();
        $is_monitor::deleted();
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
        //return 0; //改為求救狀態
    }
}
