<?php

namespace App\Http\Controllers;

use App\Models\HistoryLocation;
use App\Models\IbeaconLocation;
use App\Models\Monitoring;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SafewayController extends Controller
{
    public function start_monitor(Request $request): JsonResponse
    {
        $request->validate([
            'uid' => 'required',
            'major' => 'required',
            'minor' => 'required',
            'rssi' => 'required|string',
            'distance' => 'required|string',
            'txpower' => 'required|string',
            //'apitoken' => 'required|string',
        ]);
        $user = User::where('id', $request->get('uid'))->first();
        $ibeacon = IbeaconLocation::where('id', $this->check_ibeacon($request->get('major'), $request->get('minor')))->first();
        $is_monitoring = Monitoring::where('uid', $request->get('uid'))->first();

        if (!$user || $user->role == 0) {
            return response()->json(['error' => 'User does not exist or Authentication error'], 401);
        }
        if (!$ibeacon) {
            return response()->json(['error' => 'Ibeacon does not exist'], 401);
        }

        if ($is_monitoring) {
            $is_monitoring->update([
                'lat' => $ibeacon['lat'],
                'lng' => $ibeacon['lng'],
                'distance' => $request->get('distance'),
            ]);
        } else {
            Monitoring::create([
                'uid' => $user->id,
                'sidimei' => $user->sidimei,
                'name' => $user->name,
                'distance' => $request->get('distance'),
                'lat' => $ibeacon['lat'],
                'lng' => $ibeacon['lng'],
            ]);
        }

        HistoryLocation::create([
            'uid' => $user->id,
            'state' => 'start',
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'rssi' => $request->get('rssi'),
            'distance' => $request->get('distance'),
            'txpower' => $request->get('txpower'),
        ]);

        return response()->json(['success' => 'ok']);
    }

    public function end_monitor(Request $request): JsonResponse
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
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'rssi' => $request->get('rssi'),
            'distance' => $request->get('distance'),
            'txpower' => $request->get('txpower'),
        ]);

        $is_monitor = Monitoring::where('uid', $request->get('uid'))->first();
        if (!$is_monitor) {
            return response()->json(['error' => 'can\'t not find uid or User is not monitoring'], 401);
        }
        $is_monitor->delete();

        return response()->json(['success' => 'ok']);
    }

    public function sos(Request $request): JsonResponse
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
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'rssi' => $request->get('rssi'),
            'distance' => $request->get('distance'),
            'txpower' => $request->get('txpower'),
        ]);

        $is_monitor = Monitoring::where('uid', $request->get('uid'))->first();
        if (!$is_monitor) {
            return response()->json(['error' => 'can\'t not find uid or User is not monitoring'], 401);
        }
        $is_monitor->update(['sos' => 1]);

        return response()->json(['success' => 'ok']);
    }

    //結束sos
    public function sos_end(Request $request): JsonResponse
    {
        $request->validate([
            'uid' => 'required',
            'rssi' => 'required|string',
            'distance' => 'required|string',
            'txpower' => 'required|string',
        ]);

        HistoryLocation::create([
            'uid' => $request->get('uid'),
            'state' => 'sosend',
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'rssi' => $request->get('rssi'),
            'distance' => $request->get('distance'),
            'txpower' => $request->get('txpower'),
        ]);

        $is_monitor = Monitoring::where('uid', $request->get('uid'))->first();
        if (!$is_monitor) {
            return response()->json(['error' => 'can\'t not find uid or User is not monitoring'], 401);
        }
        $is_monitor->update(['sos' => 0]);

        return response()->json(['success' => 'ok']);
    }

    public function show()
    {
        $people = DB::table('monitoring')->orderBy('sos', 'desc')->get();

        $people_reverse = DB::table('monitoring')->orderBy('sos', 'desc')->get(); //asc?

        $beacon = DB::select("select lat,lng from ibeacon_location where major ='50000'");

        return view('safe', compact('people', 'people_reverse', 'beacon'));

        //return response()->json(['success' => $people]);
        //測試資料
    }

    public function check_ibeacon($major, $minor)
    {
        $ibeacon = IbeaconLocation::where('major', $major)->get(); //改
        for ($i = 0; $ibeacon; ++$i) {
            if ($ibeacon[$i]['minor'] == $minor) {
                return $ibeacon[$i]['id'];
            }
        }

        return null;
    }
}
