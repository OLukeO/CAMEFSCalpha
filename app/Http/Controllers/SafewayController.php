<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IbeaconLocation;
use App\Models\HistoryLocation;
use App\Models\Monitoring;

class SafewayController extends Controller
{
    public function start_monitor(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'major' => 'required',
            'minor' => 'required',
            'rssi' => 'required|string',
            'distance' => 'required|string',
            'txpower' => 'required|string',
            'apitoken' => 'required|string',
        ]);

        $user = User::where('id', $request->uid)->first();
        $ibeacon = IbeaconLocation::where('major', $request->major)->first();
        $is_monitoring = Monitoring::where('uid', $request->uid)->first();

        if (!$user || $request->apitoken != $user->token || $user->role == 0) // token認證
        {
            return response()->json(['error' => 'User does not exist or Authentication error'], 401);
        }
        if (!$ibeacon)
        {
            return response()->json(['error' => 'Ibeacon does not exist'], 401);
        }

        if ($is_monitoring) {
            $is_monitoring->update([
                'lan' => $ibeacon['lan'],
                'lng' => $ibeacon['lng'],
            ]);
        } else {
            Monitoring::create([
                'uid' => $user->id,
                'lan' => $ibeacon['lan'],
                'lng' => $ibeacon['lng'],
            ]);
        }

        //紀錄位置(純紀錄, 沒用)
        HistoryLocation::create([
            'uid' => $user->id,
            'rssi' => $request->rssi,
            'distance' => $request->distance,
            'txpower' => $request->txpower,
        ]);

        return null;
    }


    public function end_monitor(Request $request) //確認關閉app會call此api
    {
        $request->validate([
            'uid' => 'required',
        ]);

        $is_monitor = Monitoring::where('uid', $request->uid);
        $is_monitor->delete();
    }

    public function sos(Request $request)
    {
        $request->validate([
            'uid' => 'required',
        ]);

        $is_monitor = Monitoring::where('uid', $request->uid);
        $is_monitor->update(['sos' => 1]);
    }
}
