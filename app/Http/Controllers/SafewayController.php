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

        $user = User::where('id', $request->get('uid'))->first();
        $ibeacon = IbeaconLocation::where('major', $request->get('major'))->first(); //改
        //$ibeacon=IbeaconLocation::select("select * from IbeaconLocation where major = $request->get('major') and minor = $request->get('minor')");
        $is_monitoring = Monitoring::where('uid', $request->get('uid'))->first();

        if (!$user || $request->apitoken != $user->token || $user->role == 0)
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

        //紀錄位置(紀錄)
        HistoryLocation::create([
            'uid' => $user->id,
            'state' => 'start',
            'rssi' => $request->get('rssi'),
            'distance' => $request->get('distance'),
            'txpower' => $request->get('txpower'),
        ]);

        return response()->json(['success' => 'ok']);
    }


    public function end_monitor(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'rssi' => 'required|string',
            'distance' => 'required|string',
            'txpower' => 'required|string',
        ]);

        HistoryLocation::create([
            'uid' => $request->get('uid'),
            'state' => 'end',
            'rssi' => $request->get('rssi'),
            'distance' => $request->get('distance'),
            'txpower' => $request->get('txpower'),
        ]);

        $is_monitor = Monitoring::where('uid', $request->get('uid'))->first();
        if (!$is_monitor) return response()->json(['error' => 'cant not find uid or User is not monitoring'], 401);
        $is_monitor->delete();

        return response()->json(['success' => 'ok']);
    }

    public function sos(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'rssi' => 'required|string',
            'distance' => 'required|string',
            'txpower' => 'required|string',
        ]);

        HistoryLocation::create([
            'uid' => $request->get('uid'),
            'state' => 'sos',
            'rssi' => $request->get('rssi'),
            'distance' => $request->get('distance'),
            'txpower' => $request->get('txpower'),
        ]);

        $is_monitor = Monitoring::where('uid', $request->get('uid'))->first();
        if (!$is_monitor) return response()->json(['error' => 'cant not find uid or User is not monitoring'], 401);
        $is_monitor->update(['sos' => 1]);

        return response()->json(['success' => 'ok']);
    }
}
