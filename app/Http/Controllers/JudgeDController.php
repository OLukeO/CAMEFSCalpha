<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Attraction;
use App\Models\Howmanypeople;
use Illuminate\Http\JsonResponse;

class JudgeDController extends StoreController
{
    //執行儲存→判斷並回傳
    public function store(Request $request): JsonResponse
    {
        $distance = $request->get('distance');
        $UID = $request->get('uid');
        //呼叫父類別的store function 並接收回傳值
        $beaconid = parent::store($request);
        //呼叫judge function 並接收回傳值
        $data = $this->judge($distance, $beaconid, $UID);
        $test=$this->onehourmain($UID,(int)$beaconid,(double)$distance);
        //將收到資料回傳
        return response()->json($data);
        //return $test;
    }
    //判斷距離及是否回傳景點的function
    public function judge($distance, $beacon, $UID)
    {
        //將變數distance更換型態(String->double),放入變數road
        $road = (double)$distance;
        //當筆資料的BeaconID
        $BID = (int)$beacon;
        //在peopleandbeacons的資料表中，使用倒敘的排法，並用UID 搜尋最新的兩筆beaconid資料(limit 由第幾筆開始顯示,抓幾筆)
        $befBID = DB::select("select beaconid from peopleandbeacons where uid =$UID order by id desc limit 1,1");
        //前一筆資料的BeaconID
        $BID1 = (int)implode(' ', array_column($befBID, 'beaconid'));
        //如果沒有前一筆資料
        if ($BID1 == null) {
            $BID1 = 0;
        }
        //在peopleandbeacons的資料表中，使用倒敘的排法，並用UID 搜尋前一筆Distance資料(limit 由第幾筆開始顯示,抓幾筆)
        $befdistance = DB::select("select distance from peopleandbeacons where uid =$UID order by id desc limit 1,1");
        //前一筆資料的距離
        $Distance = (int)implode(' ', array_column($befdistance, 'distance'));
        //如果沒有前一筆資料
        if ($Distance == null) {
            $Distance = 100;
        }
        //查詢景點資料表中符合BeaconID值的資料放入變數
        $scene = DB::select("select id,beaconid,lat,lng,viewname,note,image,url from attractions where beaconid='$BID'");
        
        //及時人流判斷需要的資料
        $humandata=$this->humandata($BID,$BID1);
        $befpeople=$humandata[0];//前一筆景點人數
        $nowpeople=$humandata[1];//當下這筆景點人數
        $befAID=$humandata[2];//前一筆AID
        $nowAID=$humandata[3];//當下這筆AID
        
        if ($scene == null) {//現在這筆不是景點
            //判斷前一筆景點人數需不需要-1
            $this->humanminus($BID1,$Distance,$befpeople,$befAID);
            return "not a attraction";
        } else {//現在這筆是景點
            //判斷距離小於等於15m
            if ($road <= 15) {
                //判斷前後兩次的BeaconID是否相同(不同回傳變數scene,相同回傳字串same position)
                if ($BID != $BID1) {
                    //當下景點人數+1
                    $this->humanplus($nowAID,$nowpeople);
                    //判斷前筆是否是景點，前筆景點人數需不需要-1
                    $this->humanminus($BID1,$Distance,$befpeople,$befAID);
                    return $scene;
                }
                //在同個beacon範圍內，上次距離超過15m
                else if ($BID == $BID1 && $Distance > 15) {
                    //當下景點人數+1
                    $this->humanplus($nowAID,$nowpeople);
                    return $scene;
                } else {//在同個beacon範圍內，上次距離<15m
                    return "same position";
                }
            } else {//當前在景點位置距離大於15m
                //判斷前筆是否是景點，前筆景點人數需不需要-1
                $this->humanminus($BID1,$Distance,$befpeople,$befAID);
                return "noting";
            }
        }
    }
    //及時人流判斷需要的資料
    public function humandata($BID,$BID1){
        //上一個景點人數
        $befpeopleS=DB::select("select peoplenumber from attractions where beaconid='$BID1'");
        $befpeople = (int)implode(' ', array_column($befpeopleS, 'peoplenumber'));
        //現在景點人數
        $nowpeopleS=DB::select("select peoplenumber from attractions where beaconid='$BID'");
        $nowpeople = (int)implode(' ', array_column($nowpeopleS, 'peoplenumber'));
        //前一筆景點id
        $befAIDS = DB::select("select id from attractions where beaconid='$BID1'");
        $befAID = (int)implode(' ', array_column($befAIDS, 'id'));
        //現在景點id
        $nowAIDS=DB::select("select id from attractions where beaconid=$BID");
        $nowAID=(int)implode(' ', array_column($nowAIDS, 'id'));
        return array($befpeople,$nowpeople,$befAID,$nowAID);
    }
    //景點人數+1的動作
    public function humanplus($nowID,$nowpeople){
        //當前景點人數加一
        $nowpeople=$nowpeople+1;
        //更新資料
        $this->update1($nowID,$nowpeople);
    }
    //判斷前一筆是否是景點，需不需要做景點人數-1的動作
    public function humanminus($BID1,$Distance,$befpeople,$befAID){
        //前一筆景點資料
        $befscene = DB::select("select * from attractions where beaconid='$BID1'");
        if($befscene==null){
            //前一筆不是景點
        }else{
            //上一筆是景點跟距離<15m
            if($Distance<=15){
                //上個景點人數-1
                $befpeople=$befpeople-1;
                //更新資料
                $this->update1($befAID,$befpeople);
            }else{//上一筆是景點跟距離>15m
                return "不動";
            }
        }
    }
    //及時人流更新的function
    public function update1($ID,$hmpeople){
        $people =  Attraction::where('id', $ID)->first();
        $people->update([
            'logtime' => now(),
            'peoplenumber' => $hmpeople,
        ]);
    }

    //一小時人流需要的資料
    public function onehourpeople($UID,$BID,$attractionid){
        //當下這一筆透過UID找到的時間
        $nowtimeA=DB::select("select logtime from peopleandbeacons where uid='$UID' order by id desc limit 0,1");
        //將陣列轉字串
        $nowtime=implode(' ', array_column($nowtimeA, 'logtime'));
        //變數nowtime的(年,月,日,時)
        $nowtime1=date('Y-m-d-H',strtotime($nowtime));
        $nowtime0=date('Y-m-d H:00:00',strtotime($nowtime));
        //變數nowtime的完整時間
        $nowtime2=date($nowtime);
        //將變數nowtime的小時+1小時
        $timePlus=date('Y-m-d H:00:00',strtotime("$nowtime2+1 hour"));
        //在一小時的區間裡，符合UID,BID,距離小於15m的最新一筆資料
        $time2=DB::select("select * from peopleandbeacons where uid='$UID' and beaconid=$BID and distance <= 15 and logtime between '$nowtime0' and '$timePlus' order by id desc limit 0,1");
        //在一小時的區間裡，符合UID,BID,距離小於15m的前一筆資料
        $time3=DB::select("select * from peopleandbeacons where uid='$UID' and beaconid=$BID and distance <= 15 and logtime between '$nowtime0' and '$timePlus' order by id desc limit 1,1");
        //在一小時的區間裡,符合AID的人數
        $hwmanypeopleA =Howmanypeople::where('aid', $attractionid,)
                    ->where('logtime', '>=',$nowtime0) 
                    ->where('logtime', '<',$timePlus)
                    ->first('peoplenumber');
        //如果變數people沒有收尋到資料，將變數hwmanypeople給一個小於0的值
        if($hwmanypeopleA!=null){
            //資料表裡符合時間內的人數
            $hwmanypeople=(int)$hwmanypeopleA->peoplenumber;
        }else{
            $hwmanypeople=-10;
        }
        //回傳需要資料
        return array($time2,$time3,$hwmanypeople,$nowtime0,$timePlus);
    }
    //一小時主要function
    public function onehourmain($UID,$BID,$road){
        //一小時的人流需要的資料
        //attractions資料表裡符合BID的景點id
        $attractionidA= DB::select("select id from attractions where beaconid='$BID'");
        $attractionid=(int)implode(' ', array_column($attractionidA, 'id'));
        //查詢景點資料表中符合當筆資料BeaconID值的資料放入變數
        $scene = DB::select("select id,beaconid,lat,lng,viewname,note,image,url from attractions where beaconid='$BID'");
        //紀錄一小時人數需要的時間和人數資料
        $onehourpeopledata=$this->onehourpeople($UID,$BID,$attractionid);
        $time2=$onehourpeopledata[0];//在一小時的區間裡，符合UID,BID,距離小於15m的最新一筆資料
        $time3=$onehourpeopledata[1];//在一小時的區間裡，符合UID,BID,距離小於15m的前一筆資料
        $hwmanypeople=$onehourpeopledata[2];//在一小時的區間裡,符合AID的人數
        $nowtime0=$onehourpeopledata[3];//當筆資料的Logtime的(年,月,日,時:00:00)
        $timePlus=$onehourpeopledata[4];//當筆資料的Logtime的(年,月,日,時+1h:00:00)
        //return array($time2,$time3,$hwmanypeople,$nowtime0,$timePlus);
        if($hwmanypeople>= 0){//判斷有沒有人數資料
            //一小時的人流判斷
            if($scene != null){//現在的位置是景點
                if($road <= 15){//距離小於等於15m
                    if($time2!=null&&$time3==null){//資料庫查詢資料中只有現在這筆，之前無資料
                        $hwmanypeople=$hwmanypeople+1;//人數加一
                        $test=$this->update2($attractionid,$nowtime0,$timePlus,$hwmanypeople);//跑一小時人流更新function
                        //return $test;
                    }else{
                        "come again";
                    }
                }
            }
        }
        else{
           "有問題，人數沒有資料";
        }
    }
    //一小時人流更新
    public function update2($attractionid,$nowtime0,$timePlus,$hwmanypeople){
        $people =  Howmanypeople::where('aid', $attractionid,)
                    ->where('logtime', '>=',$nowtime0) 
                    ->where('logtime', '<',$timePlus)
                    ->first();
                    //return $people;
        if($people!=null){//如果變數people有收尋到資料，對資料更新
            $people->update([
                'peoplenumber' => $hwmanypeople,
            ]);
        }else{
            "沒有資料";
        }           
    }
}
