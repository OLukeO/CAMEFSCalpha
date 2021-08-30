<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Peopleandbeacon;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        //將變數request裡的Major,Minor放入相對應的變數
        $Major=$request->get('major');
        $Minor=$request->get('minor');

        /*在ibeaconlocation資料表中收尋資料符合where條件的資料放入變數BeaconIDdata。
          使用select方法得到的資料是陣列*/
        $BeaconIDdata=DB::select("select * from ibeacon_location where major = $Major and minor =$Minor");
        
        //將陣列中的BeaconID資料存入變數Beaconstring(型態 String)
        $Beaconstring=implode(' ', array_column($BeaconIDdata, 'id'));
        
        //轉變型態(String->int)
        $BeaconID=(int)$Beaconstring;
        $UIDstring=$request->get('uid');
        $UID=(int)$UIDstring;

        //更新對應欄位
        $PeopleandBeacon = new Peopleandbeacon([
            'logtime'=> now(),
            'beaconid'=> $BeaconID,
            'rssi'=>$request->get('rssi'),
            'distance'=>$request->get('distance'),
            'txpower'=>$request->get('txpower'),
            'uid'=>$UID
        ]);
        
        //將資料存入資料庫
        $PeopleandBeacon->save();
        //回傳BeaconID
        return $BeaconID;
    }
    //人流資料的顯示API
    public function show(): JsonResponse
    {
        $allpeople=DB::select("select id,viewname,peoplenumber,logtime from attractions");
        return response()->json($allpeople);
    }
}
