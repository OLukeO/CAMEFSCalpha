<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Howmanypeople;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ChartJsController extends Controller
{
    public function index(Request $request)
    {   
        
        //收尋時間
        $t = $request->get('logtime');
        $date = date('Y-m-d 00:00:00', strtotime($t));
        $date2 = date('Y-m-d 23:00:00', strtotime($t));

        //二維陣列[[储存十筆景點時間]]
        $Alltime = [['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0']];
        //二維陣列[[储存十筆景點人數]]
        $Allpeople = [['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0'], ['0']];

        for ($i = 1; $i <= 10; $i++) {

            if ($t == null) {

                $Alltime[$i] = [

                    '00:00:00', '01:00:00', '02:00:00', '03:00:00', '04:00:00', '05:00:00', '06:00:00', '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00',

                    '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00', '19:00:00', '20:00:00', '21:00:00', '22:00:00', '23:00:00',

                ];

                $Allpeople[$i] = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
            } else {

                //幾點幾分

                $time = DB::select("select time(logtime) from howmanypeoples where aid='$i' and logtime >='$date' and logtime <='$date2' ");

                $time = implode(' ', array_column($time, 'time(logtime)'));

                $time = explode(" ", $time);

                $Alltime[$i] = $time;

                //人數

                $user = DB::select("select peoplenumber from howmanypeoples where aid='$i' and logtime >='$date' and logtime <='$date2'");

                $uu = implode(' ', array_column($user, 'peoplenumber'));

                $uu = explode(" ", $uu);

                $Allpeople[$i] = $uu;
            }
        }
        return view('chartjs')->with('Alltime', json_encode($Alltime, JSON_NUMERIC_CHECK))->with('Allpeople', json_encode($Allpeople, JSON_NUMERIC_CHECK));
    }
}
