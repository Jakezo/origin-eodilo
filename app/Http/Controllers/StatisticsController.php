<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\UserCashBuy;
use Carbon\Carbon;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();     
    }

    public function day(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["orders"] = [];
        $data["orders"] = $this->FrenchProductOrder->select("french_product_orders.*","date_add(french_product_orders.created_at, inteval 3 hours) as std_date")
        ->where(function ($query) use ($request) {
            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }
            if ($request->sdate) {
                $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }
            if ($request->edate) {
                $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

            if ($request->pkind) {
                    $query->where("o_product_kind", $request->pkind);
            }            

            //  if ($request->state) {
            //     if( $request->state == "A" ) {
            //         $query->where("o_duration", "<", "%" . $request->q . "%");
            //     } elseif( $request->state == "N" ) {
            //         $query->where("e_title", "like", "%" . $request->q . "%");
            //     }  elseif( $request->state == "Y" ) {
            //         $query->where("e_cont", "like", "%" . $request->q . "%");
            //     }

            //     $query->where("o_state", $request->state);
            //  }         

            if ($request->pay_state) {
                $query->where("o_pay_state", $request->pay_state);
            }
        })
        ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_product_orders.o_member')
        ->orderBy("o_no","desc")->paginate(6);

        $data['productType'] = Config::get('product.productType');


        $data['start'] = $data["orders"]->total() - $data["orders"]->perPage() * ($data["orders"]->currentPage() - 1);
        $data['total'] = $data["orders"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        return response($data);
        return view('partner.statistics.day',$data);

    }


    public function cashbuy(Request $request)
    {

        $data["result"] = true;
        $data["cashbuys"] = \App\Models\UserCashBuy::where('cb_pay', "Y")
        ->where(function ($query) use ($request) {

            if ($request->q) {
                $query->where("users.id", "like", "%".$request->q."%")
                ->orwhere("users.name", "like", "%".$request->q."%")
                ->orwhere("users.nickname", "like", "%".$request->q."%")
                ->orwhere("users.phone", "like", "%".$request->q."%")
                ->orwhere("sb_friend_name", "like", "%".$request->q."%")
                ->orwhere("sb_friend_phone", "like", "%".$request->q."%");
            }
            if ($request->sdate) {
                $query->where( DB::raw("date_format(cb_pay_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }
            if ($request->edate) {
                $query->where( DB::raw("date_format(cb_pay_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

            if ($request->friend ) {
                    $query->where("cb_friend", $request->friend);
            }                    

            // if( $request->mode == "out" ) {
            //     $query->where("mp_point", "<" , 0);
            // }elseif( $request->mode == "in" ) {
            //         $query->where("mp_point", ">", 0);
            // }
        })
        ->leftjoin('users', 'users.id', '=', 'user_cash_buys.cb_member')
        ->orderBy("cb_no","desc")->paginate(10);

        $data['friend'] = $request->friend;
        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["cashbuys"]->total() - $data["cashbuys"]->perPage() * ($data["cashbuys"]->currentPage() - 1);
        $data['total'] = $data["cashbuys"]->total();
        $data['param'] = [
                'sdate' => $request->sdate, 
                'edate' => $request->edate, 
                'firend' => $request->firend, 
                'fd' => $request->fd, 
                'q' => $request->q];

        return view('admin.statistics.cashbuy',$data);

    }    
}
