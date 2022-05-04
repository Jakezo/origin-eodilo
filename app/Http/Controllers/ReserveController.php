<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Partner;
use App\Models\FrenchSeat;
use App\Models\FrenchSeatLevel;
use App\Models\FrenchLocker;
use App\Models\FrenchProduct;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\Partner_review;
use App\Models\PartnerPhoto;
use App\Models\PartnerCoupon;
use App\Models\UserCoupon;

use App\Models\MobileProductOrder;
use App\Models\MobileReservSeat;
use App\Models\User_cash;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReserveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $partner;

    public function __construct(Request $request)
    {
        $this->partner = new Partner();
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchSeatLevel = new FrenchSeatLevel();
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();
        $this->FrenchLocker = new FrenchLocker();

        $this->MobileProductOrder  = new MobileProductOrder();
        $this->MobileReservSeat  = new MobileReservSeat();

        $this->Partner_review = new Partner_review();
        $this->PartnerCoupon = new PartnerCoupon();

    }


    ## 목록
    public function index(Request $request){

        $data["reserves"] = [];
        $data["reserves"] = $this->MobileReservSeat->select("mobile_reserv_seats.*","mobile_reserv_seats.created_at as reserved_at",
        "partners.p_no","partners.p_id","partners.p_name",
        "users.id","users.nickname","users.email","users.nickname","users.phone", "users.sex", "users.birth" )
            ->leftjoin('partners', 'rv_partner', '=', 'partners.p_no')
            ->leftjoin('users', 'rv_member', '=', 'users.id')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("nickname", "like", "%" . $request->q . "%")
                            ->orwhere("name", "like", "%" . $request->q . "%");                        
                    }  elseif( $request->fd == "id" ) {
                        $query->where("users.id", "like", "%" . $request->q . "%");
                    } else {
                        $query->where("nickname", "like", "%" . $request->q . "%")
                            ->orwhere("name", "like", "%" . $request->q . "%")
                            ->orwhere("users.id", "like", "%" . $request->q . "%");
                    }
                }
                if ($request->sdate) {
                    $query->where( DB::raw("date_format(mobile_reserv_seats.rv_sdate,'%Y-%m-%d')"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("date_format(mobile_reserv_seats.rv_sdate,'%Y-%m-%d')"),  "<=", $request->edate);
                }

                if ($request->state) {

                    if( $request->state == "A" ) {
                        $query->where("c_sdate",  ">", now());
                    } elseif( $request->state == "I" ) {
                        $query->where("c_sdate",  "<=", now());
                        $query->where("c_edate",  ">=", now());
                    }  elseif( $request->state == "E" ) {
                        $query->where("c_edate",  "<", now());
                    }

                }
            })
            ->orderBy("rv_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["reserves"]->total() - $data["reserves"]->perPage() * ($data["reserves"]->currentPage() - 1);
        $data['total'] = $data["reserves"]->total();
        $data['param'] = [
                'state' => $request->state, 
                'sdate' => $request->sdate, 
                'edate' => $request->edate, 
                'fd' => $request->fd, 
                'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.reserve.history', $data);
    }

}
