<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\FrenchIot;
use App\Models\FrenchSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class MobileIotController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $FrenchIot;

    public function __construct()
    {
        $this->FrenchIot = new FrenchIot();
    }

    ## 목록 위한 정보
    public function get_list(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["iots"] = [];
        $data["iots"] = $this->FrenchIot->orderBy("i_name","asc")->get();

        return response($data);

    }


}
