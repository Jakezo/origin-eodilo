<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchSeatLevel;
use App\Models\StandardPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Config;

class SettingSeatLevelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $FrenchSeatLevel;

    public function __construct()
    {
        $this->FrenchSeatLevel = new FrenchSeatLevel();
    }


    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["seatlevels"] = [];
        $data["seatlevels"] = $this->FrenchSeatLevel->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("sl_name", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("sl_no","desc")->paginate(10);


        for( $i = 0; $i <= count($data["seatlevels"])-1; $i++ ) {

            if( isJson($data["seatlevels"][$i]->sl_price_time) ) {
                $data["seatlevels"][$i]->sl_price_time_state = true;
            } else {
                $data["seatlevels"][$i]->sl_price_time_state = false;
            }

            if( isJson($data["seatlevels"][$i]->sl_price_day) ) {
                $data["seatlevels"][$i]->sl_price_day_state = true;
            } else {
                $data["seatlevels"][$i]->sl_price_day_state = false;
            }
        }               


        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["seatlevels"]->total() - $data["seatlevels"]->perPage() * ($data["seatlevels"]->currentPage() - 1);
        $data['total'] = $data["seatlevels"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
        return view('partner.setting.seat_level', $data);
    }


    ## 목록 위한 정보
    public function get_list(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["seatlevels"] = [];
        $arr = $this->FrenchSeatLevel->select("sl_no","sl_name","sl_type","sl_price_time","sl_price_day")
            ->orderBy("sl_name","asc")->get();

        for( $i = 0; $i <= count($arr)-1; $i++ ) {
            $data["seatlevels"][$arr[$i]->sl_no] = $arr[$i];
        }            

        return response($data);

    }


    ## 폼을 위한 정보
    public function getInfo(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["seatlevel"] = $this->FrenchSeatLevel->select(
                [
                    'sl_no as no',
                    'sl_partner as partner',
                    'sl_name as name',
                    'sl_type as type',
                    'sl_price_time as price_time',
                    'sl_price_day as price_day',
                    'sl_rate_student_time as rate_student_time',
                    'sl_rate_student_day as rate_student_day',
                    'sl_rate_adult_time as rate_adult_time',
                    'sl_rate_adult_day as rate_adult_day'
                ]
            )
            ->where("sl_no",  $request->no)->first();
            return $data;
        return response($data);

    }

 
    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $SeatLevel = FrenchSeatLevel::where('sl_no', $request->no)->first();
        } else {
            $SeatLevel = new FrenchSeatLevel();
        }

        $SeatLevel->sl_partner = $request->account ?? "";
        $SeatLevel->sl_name = $request->name ?? "";
        $SeatLevel->sl_type = $request->type ?? "A";
        //$SeatLevel->sl_price = $request->price ?? "";

        if( isset( $SeatLevel->sl_no ) ) {
            $result['result'] = $SeatLevel->update();
        } else {
            $result['result'] = $SeatLevel->save();
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
            $SeatLevel = FrenchSeatLevel::where('sl_no', $request->no)->firstOrFail();

            if($SeatLevel->delete()) {
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


    ## 가격만들기
    public function price_make(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $price = $request->seat_price;

        $result['result'] = true;
        $result['rate_student'] = $request->rate_student;
        $result['rate_adult'] = $request->rate_adult;


        if( $request->price_kind == "time") {
            $max_i = 23;
        } else if( $request->price_kind =="day") {
            $max_i = 31;
        }

        for( $i = 1; $i <= $max_i; $i++ ) {

            // 학생할인율
            $discount['S'] = ( $request->rate_student / 100 * ( $i - 1 ) );

            // 성인할인율
            $discount['A'] = ( $request->rate_adult / 100 * ( $i - 1 ) );

            $result["price_kind"] = $request->price_kind;
            foreach( config('product.productAgeType') as $ak => $av ) {
                foreach( config('product.productBuyType') as $tk => $tv ) {
                    $result['price'][$i][$ak][$tk]['T'] = ceil( ($request->seat_price[$ak][$tk]['T'] * ( $i )) - ($request->seat_price[$ak][$tk]['T'] * $discount[$ak] ));
                    $result['price'][$i][$ak][$tk]['R'] = ceil(($request->seat_price[$ak][$tk]['R'] * ( $i )) - ($request->seat_price[$ak][$tk]['R'] * $discount[$ak] ));
                    $result['price'][$i][$ak][$tk]['S'] = ceil(($request->seat_price[$ak][$tk]['S'] * ( $i )) - ($request->seat_price[$ak][$tk]['S'] * $discount[$ak] ));
                }
            }

        }
        return response($result);

    }    


    ## 가격저장하기
    public function price_save(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        
        if( $request->no ) {

            $SeatLevel = FrenchSeatLevel::where('sl_no', $request->no)->firstOrFail();

            if( $request->price_kind == "time" ) {
                $SeatLevel->sl_price_time = json_encode($request->seat_price);
                $SeatLevel->sl_rate_student_time = $request->rate_student;
                $SeatLevel->sl_rate_adult_time = $request->rate_adult;
            }

            if( $request->price_kind == "day" ) {
                $SeatLevel->sl_price_day = json_encode($request->seat_price);
                $SeatLevel->sl_rate_student_day = $request->rate_student;
                $SeatLevel->sl_rate_adult_day = $request->rate_adult;
            }

            $result['result'] = $SeatLevel->update();
            $result['price_kind'] = $request->price_kind;
            $result['message'] = $SeatLevel;

        } else {

            $result['result'] = false;
            $result['message'] = "존재하지 않는 등급입니다.";

        }

        return response($result);

    } 


    ##  표준금액가져오기
    public function getStandardPrice(Request $request){

        //$StandardPrice = StandardPrice::first();

        if( $StandardPrice = StandardPrice::first() ) {
            
            $StandardPrice->sl_price_time = json_decode($StandardPrice->sl_price_time,true);
            $StandardPrice->sl_price_day = json_decode($StandardPrice->sl_price_day,true);

            $result['result'] = true;
            $result['data'] = $StandardPrice;            

        } else {
            $result['result'] = false;
            $result['message'] = "정보가 존재하지 않습니다.";
        }

        return response($result);
    }


}

