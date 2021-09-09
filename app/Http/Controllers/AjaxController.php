<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function index(Request $request){
        $scene = DB::select("select viewname from attractions");

        $scene = implode(' ', array_column($scene, 'viewname'));

        $scene = explode(" ", $scene);

        $labels = $scene;

        $nowpeople = DB::select("select peoplenumber from attractions");

        $nowpeople = implode(' ', array_column($nowpeople, 'peoplenumber'));

        $nowpeople = explode(" ", $nowpeople);

        $data=$nowpeople;
        
        //echo json_encode($scene, JSON_NUMERIC_CHECK),json_encode($nowpeople, JSON_NUMERIC_CHECK);
        //return json_encode($scene, JSON_NUMERIC_CHECK),json_encode($nowpeople, JSON_NUMERIC_CHECK);

        return response()->json(compact('labels', 'data'));
    }
}
