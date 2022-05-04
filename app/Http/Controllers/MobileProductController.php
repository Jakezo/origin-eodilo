<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchProduct;
use App\Models\StandardProduct;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Config;

class MobileProductController extends Controller
{

    public $MobileProduct;

    public function __construct()
    {
        $this->FrenchProduct = new FrenchProduct();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];

        $FrenchProduct = FrenchProduct::firstOrFail();
        if( $FrenchProduct = FrenchProduct::firstOrFail() ) {
            $result['result'] = true;
            $result['data'] = [
                "A" => explode(",",$FrenchProduct->prd_A),
                "D" => explode(",",$FrenchProduct->prd_D),
                "T" => explode(",",$FrenchProduct->prd_T),
                "F" => explode(",",$FrenchProduct->prd_F),
                "P" => explode(",",$FrenchProduct->prd_P)
            ];
        } else {
            $result['result'] = false;
            $result['data'] = [];
        }

        return view('partner.setting.product', $result);

    }


    ## 목록
    public function getProduct(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];

        $FrenchProduct = FrenchProduct::firstOrFail();
        if( $FrenchProduct = FrenchProduct::firstOrFail() ) {
            $result['result'] = true;
            $result['products'] = [
                "A" => explode(",",$FrenchProduct->prd_A),
                "D" => explode(",",$FrenchProduct->prd_D),
                "T" => explode(",",$FrenchProduct->prd_T),
                "F" => explode(",",$FrenchProduct->prd_F),
                "P" => explode(",",$FrenchProduct->prd_P)
            ];
        } else {
            $result['result'] = false;
            $result['products'] = [];
        }

        return response($result);

    }

    ## 목록
    public function getStandardProduct(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];

        $StandardProduct = StandardProduct::first();


        if( !$StandardProduct ) {
            $StandardProduct = new StandardProduct();
        }

        $FrenchProduct = FrenchProduct::first();
        if( !$FrenchProduct ) {
            $FrenchProduct = new FrenchProduct();
        }


        $FrenchProduct->prd_A = $StandardProduct->prd_A;
        $FrenchProduct->prd_D = $StandardProduct->prd_D;
        $FrenchProduct->prd_T = $StandardProduct->prd_T;
        $FrenchProduct->prd_F = $StandardProduct->prd_F;
        $FrenchProduct->prd_P = $StandardProduct->prd_P;
        if( isset( $FrenchProduct->prd_no ) ) {
            $result['result'] = $FrenchProduct->update();
        } else {
            $result['result'] = $FrenchProduct->save();
        }
        $result['data'] = [
            "A" => $FrenchProduct->prd_A,
            "D" => $FrenchProduct->prd_D,
            "T" => $FrenchProduct->prd_T,
            "F" => $FrenchProduct->prd_F,
            "P" => $FrenchProduct->prd_P
        ];

        return response($result);

    }




}
