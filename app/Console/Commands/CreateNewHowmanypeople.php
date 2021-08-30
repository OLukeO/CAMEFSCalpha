<?php

namespace App\Console\Commands;

use App\Models\Howmanypeople;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateNewHowmanypeople extends Command
{
    /**
     * The name and signature of the console command.

     *

     * @var string
     */
    protected $signature = 'create:newHowmanypeople';

    /**
     * The console command description.

     *

     * @var string
     */
    protected $description = '已新增新的景點人數統計表';

    /**
     * Create a new command instance.

     *

     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.

     *

     * @return int
     */
    public function handle()
    {
        //判斷要建幾個新的 景點人數統計(HowManyPeople)

        $NumAID = DB::select('select id from attractions order by id desc limit 0,1'); //以id用遞減找一筆資料的id(找到最大的id即可知道有幾個景點)

        $NumAID = (int) $NumAID;

        //新增每一筆景點的統計人數

        for ($index = 1; $index <= $NumAID; $index + 1) {
            $people = new Howmanypeople([
                'logtime' => now(),

                'aid' => $index,

                'peoplenumber' => 0,
            ]);

            $people->save();

            return;
        }
    }
}
