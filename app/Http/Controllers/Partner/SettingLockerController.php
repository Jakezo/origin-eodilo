<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchLocker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Config;

class SettingLockerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $FrenchLocker;

    public function __construct()
    {
        $this->FrenchLocker = new FrenchLocker();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["lockers"] = [];
        $data["lockers"] = $this->FrenchLocker->select(["french_lockers.*", "la.la_no", "la.la_name"])
        ->leftjoin('french_locker_areas as la', 'french_lockers.l_area', '=', 'la.la_no')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("l_name", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("l_no","desc")->paginate(50);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["lockers"]->total() - $data["lockers"]->perPage() * ($data["lockers"]->currentPage() - 1);
        $data['total'] = $data["lockers"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
        return view('partner.setting.locker', $data);
    }


    ## 검색
    public function searchLocker(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["lockers"] = $this->FrenchLocker->select(["french_lockers.*", "la.la_no", "la.la_name"])
        ->leftjoin('french_locker_areas as la', 'french_lockers.l_area', '=', 'la.la_no')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("l_name", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("l_no","desc")->get();

        return response($data);
    }
    


    ## 폼을 위한 정보
    public function getInfo(Request $request){

            Config::set('database.connections.partner.database',"boss_".$request->account);

            $data["result"] = true;
            $data["locker"] = $this->FrenchLocker->select(
                    [
                        'l_no as no',
                        'l_name as name',
                        'l_area as area',
                        'l_dvd_no as dvd_no'
                    ]
                )
                ->where("l_no",  $request->no)->first();
            return response($data);

    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $FrenchLocker = FrenchLocker::where('l_no', $request->no)->firstOrFail();
        } else {
            $FrenchLocker = new FrenchLocker();
        }

        //$FrenchSeat->s_partner = $request->account ?? "";
        $FrenchLocker->l_name = $request->name ?? "";
        $FrenchLocker->l_area = $request->area ?? 0;
        $FrenchLocker->l_iot1 = $request->iot1 ?? "";
        $FrenchLocker->l_iot2 = $request->iot2 ?? "";

        if( isset( $FrenchLocker->l_no ) ) {
            $result['result'] = $FrenchLocker->update();
        } else {
            $result['result'] = $FrenchLocker->save();
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
            $FrenchLocker = FrenchLocker::where('l_no', $request->no)->firstOrFail();

            if($FrenchLocker->delete()) {
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
