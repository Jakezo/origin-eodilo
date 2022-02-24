<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StandardPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class StandardPriceController extends Controller
{
    public $StandardPrice;

    public function __construct()
    {
        $this->StandardPrice = new StandardPrice();
    }


    ## 목록
    public function index(Request $request){

        $StandardPrice = StandardPrice::first();

        if( !$StandardPrice ) {
            $StandardPrice = new StandardPrice();
        }

        $StandardPrice->sl_price_time = json_decode($StandardPrice->sl_price_time,true);
        $StandardPrice->sl_price_day = json_decode($StandardPrice->sl_price_day,true);

        return view('admin.partner.standard_price',$StandardPrice);
    }


    ## 목록 위한 정보
    public function get_list(Request $request){

        $data["result"] = true;
        $data["StandardPrices"] = [];
        $arr = $this->StandardPrice->select("sl_no","sl_name","sl_type","sl_price_time","sl_price_day")
            ->orderBy("sl_name","asc")->get();

        for( $i = 0; $i <= count($arr)-1; $i++ ) {
            $data["StandardPrices"][$arr[$i]->sl_no] = $arr[$i];
        }            

        return response($data);

    }


    ## 폼을 위한 정보
    public function getInfo(Request $request){

        $data["result"] = true;
        $data["StandardPrice"] = $this->StandardPrice->select(
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



    public function delete(Request $request)
    {

        $result = [];
        if( $request->no ) {
            $StandardPrice = StandardPrice::where('sl_no', $request->no)->firstOrFail();

            if($StandardPrice->delete()) {
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

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());
        $result = [];
        if( $request->no ) {
            $StandardPrice = StandardPrice::where('sl_no', $request->no)->first();
        } else {
            $StandardPrice = new StandardPrice();
        }

        $StandardPrice->sl_name = $request->name ?? "";
        $StandardPrice->sl_price_time = json_encode($request->seat_time_price);
        $StandardPrice->sl_rate_student_time = $request->rate_time_student;
        $StandardPrice->sl_rate_adult_time = $request->rate_time_adult;

        $StandardPrice->sl_price_day = json_encode($request->seat_day_price);
        $StandardPrice->sl_rate_student_day = $request->rate_day_student;
        $StandardPrice->sl_rate_adult_day = $request->rate_day_adult;

        if( isset( $StandardPrice->sl_no ) ) {
            $result['result'] = $StandardPrice->update();
        } else {
            $result['result'] = $StandardPrice->save();
        }

        return response($result);
    }

}
