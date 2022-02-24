<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\StandardProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StandardProductController extends Controller
{
    public $StandardProduct;

    public function __construct()
    {
        $this->StandardProduct = new StandardProduct();
    }   
    
    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $result = [];

        if( $StandardProduct = StandardProduct::first() ) {
            $result['result'] = true;
            $result['data'] = [
                "A" => explode(",",$StandardProduct->prd_A),
                "D" => explode(",",$StandardProduct->prd_D),
                "T" => explode(",",$StandardProduct->prd_T),
                "F" => explode(",",$StandardProduct->prd_F),
                "P" => explode(",",$StandardProduct->prd_P)  
            ];
        } else {
            $result['result'] = false;
            $result['data'] = [];
        }
        return view('admin.partner.standard_product', $result);

    }

    ## 목록
    public function update(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $result = [];
        $StandardProduct = StandardProduct::first();

        if( !$StandardProduct ) {
            $StandardProduct = new StandardProduct();
        }

        $StandardProduct->prd_A = $request->A ? implode(",",$request->A) : "";
        $StandardProduct->prd_D = $request->D ? implode(",",$request->D) : "";
        $StandardProduct->prd_T = $request->T ? implode(",",$request->T) : "";
        $StandardProduct->prd_F = $request->F ? implode(",",$request->F) : "";
        $StandardProduct->prd_P = $request->P ? implode(",",$request->P) : "";               

        if( isset( $StandardProduct->prd_no ) ) {
            $result['result'] = $StandardProduct->update();
        } else {
            $result['result'] = $StandardProduct->save();
        }
        
        $result['data'] = [
            "A" => $StandardProduct->prd_A,
            "D" => $StandardProduct->prd_D,
            "T" => $StandardProduct->prd_T,
            "F" => $StandardProduct->prd_F,
            "P" => $StandardProduct->prd_P  
        ];

        return response($result);

    }
}
