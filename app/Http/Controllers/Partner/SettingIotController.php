<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchIot;
use App\Models\FrenchSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class SettingIotController extends Controller
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

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["iots"] = [];
        $data["iots"] = $this->FrenchIot->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("i_name", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("i_no","desc")->paginate(50);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["iots"]->total() - $data["iots"]->perPage() * ($data["iots"]->currentPage() - 1);
        $data['total'] = $data["iots"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];

        return view('partner.setting.iot',$data);
    }


    ## 목록 위한 정보
    public function get_list(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["iots"] = [];
        $data["iots"] = $this->FrenchIot->select("i_no","i_name","i_sex","i_type","i_iot1","i_iot2","i_iot3","i_iot4")
            ->orderBy("i_name","asc")->get();

        return response($data);

    }

    ## 폼을 위한 정보
    public function getInfo(Request $request){

            Config::set('database.connections.partner.database',"boss_".$request->account);

            $data["result"] = true;
            $data["iot"] = $this->FrenchIot->select(
                    [
                        'i_no as no',
                        'i_name as name',
                        'i_type as type',
                        'i_sex as sex',
                        'i_partner as partner',
                        'i_iot1 as iot1',
                        'i_iot2 as iot2',
                        'i_iot3 as iot3',
                        'i_iot4 as iot4'
                    ]
                )
                ->where("i_no",  $request->no)->first();
            return response($data);

    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $FrenchIot = FrenchIot::where('i_no', $request->no)->firstOrFail();
        } else {
            $FrenchIot = new FrenchIot();
        }

        $FrenchIot->i_partner = $request->account ?? "";
        $FrenchIot->i_name = $request->name ?? "";
        $FrenchIot->i_type = $request->type ?? "";
        $FrenchIot->i_sex = $request->sex ?? "";
        $FrenchIot->i_iot1 = $request->iot1 ?? "";
        $FrenchIot->i_iot2 = $request->iot2 ?? "";
        $FrenchIot->i_iot3 = $request->iot3 ?? "";
        $FrenchIot->i_iot4 = $request->iot4 ?? "";

        if( isset( $FrenchIot->i_no ) ) {
            $result['result'] = $FrenchIot->update();
        } else {
            $result['result'] = $FrenchIot->save();
            //$FrenchIot->i_no = $result['result'];
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }


    public function delete(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $FrenchIot = FrenchIot::where('i_no', $request->no)->firstOrFail();

            if($FrenchIot->delete()) {
                $result = ['result' => true];
            } else {
                $result = [
                    'result' => false,
                    'message' => "삭제되지 않았습니다."];
                return response($result);
            }
        } else {
            $result = [
                'result' => false,
                'message' => "정보가 존재하지 않습니다."];
            return response($result);
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }





    ## 전체 IOT 컨트롤
    public function get_all_iot(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["iots"] = [];
        $data["iots"] = $this->FrenchIot->select("i_no","i_name","i_sex","i_type","i_iot1","i_iot2","i_iot3","i_iot4")
            ->orderBy("i_name","asc")->get();

        return response($data);

    }


}
