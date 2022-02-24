<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchLockerArea;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Config;

class SettingLockerAreaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $FrenchLockerArea;

    public function __construct()
    {
        $this->FrenchLockerArea = new FrenchLockerArea();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["locker_areas"] = [];
        $data["locker_areas"] = $this->FrenchLockerArea->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("la_name", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("la_no","desc")->paginate(50);
        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["locker_areas"]->total() - $data["locker_areas"]->perPage() * ($data["locker_areas"]->currentPage() - 1);
        $data['total'] = $data["locker_areas"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];

        return view('partner.setting.locker_area', $data);
    }



    ## 목록 위한 정보
    public function get_list(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["locker_area"] = [];
        $data["locker_area"] = $this->FrenchLockerArea->select("la_no", "la_name", "la_locker_count", "la_locker_state", "la_locker_open_kiosk", "la_locker_open_mobile")
            ->orderBy("la_name","asc")->get();

        return response($data);

    }

    ## 폼을 위한 정보
    public function getInfo(Request $request){

            Config::set('database.connections.partner.database',"boss_".$request->account);

            $data["result"] = true;
            $data["locker_area"] = $this->FrenchLockerArea->select(
                    [
                        'la_no as no',
                        'la_name as name',
                        'la_locker_count as locker_count',
                        'la_locker_state as locker_state',
                        'la_locker_open_mobile as open_mobile',
                        'la_locker_open_kiosk as open_kiosk'
                    ]
                )
                ->where("la_no",  $request->no)->first();
            return response($data);

    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $FrenchLockerArea = FrenchLockerArea::where('la_no', $request->no)->firstOrFail();
        } else {
            $FrenchLockerArea = new FrenchLockerArea();
        }

        $FrenchLockerArea->la_bg = $request->bg ?? "";
        $FrenchLockerArea->la_name = $request->name ?? "";
        $FrenchLockerArea->la_locker_count = $request->locker_count ?? "";
        $FrenchLockerArea->la_locker_open_mobile = $request->open_mobile ?? "N";
        $FrenchLockerArea->la_locker_open_kiosk = $request->open_kiosk ?? "N";

        if( isset( $FrenchLockerArea->la_no ) ) {
            $result['result'] = $FrenchLockerArea->update();
        } else {
            $result['result'] = $FrenchLockerArea->save();
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
            $FrenchLockerArea = FrenchLockerArea::where('la_no', $request->no)->firstOrFail();

            if($FrenchLockerArea->delete()) {
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


}
