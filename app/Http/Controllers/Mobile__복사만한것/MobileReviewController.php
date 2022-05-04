<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Partner_review;
use App\Models\MobileProductOrder;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Classes\NCPdisk;

class MobileReviewController extends Controller
{
    public $partner_review;

    public function __construct()
    {
        $this->partner_review = new Partner_review();
    }

    function ReviewForm(Request $request){
        $data = [];

        if( $request->order ) {
            $order = MobileProductOrder::find($request->order);
            $data["order"] = $order->o_no;
            $data["partner"] = $order->o_partner;
        } else {

        }
        return view('mobile.my_review_reg', $data);

    }

    ## 가맹점 리뷰 목록
    public function partner_reviews(Request $request){

        $data["reviews"] = [];
        $data["rv_no"] = $request->rv_no;

        if( $request->mode == "recom" ) {
            $order1 = "rv_point";
        } else {
            $order1 = "created_at";
        }

        $data["reviews"] = $this->partner_review->select("partner_reviews.*", "partners.p_name")
            ->leftjoin('partners', 'partners.p_no', '=', 'partner_reviews.rv_partner')
            ->where(function ($query) use ($request) {
                if ($request->no) {
                    $query->where("rv_partner", $request->no);
                }
                if ($request->q) {
                    if( $request->fd == "cont" ) {
                        $query->where("rv_contents", "like", "%" . $request->q . "%");
                    } elseif( $request->fd == "member" ) {
                        $query->where("rv_member", "like", "%" . $request->q . "%");
                    }  else {
                        $query->where("rv_contents", "like", "%" . $request->q . "%")
                            ->orwhere("rv_member", "like", "%" . $request->q . "%");
                    }
                }
                if( $request->b_id ) {
                    $query->where("b_id", $request->b_id);
                }
                if( $request->state ) {
                    $query->where("b_state", $request->state);
                }

            })
            ->orderBy($order1,"desc")->paginate(10);

            $NCPdisk = new NCPdisk;

            foreach(  $data["reviews"] as $reviews ) {
                if( $reviews->rv_imgs ) {
                    $reviews->rv_imgs =  $NCPdisk->url($reviews->rv_imgs);
                }
            }

        $data["mode"]= $request->mode;

        $data['total'] = $data["reviews"]->total();

        $data['average'] = round($data["reviews"]->where("rv_partner", $request->no)->avg('rv_point'),2);


        return view('mobile.detail_review', $data);

    }

    public function review_save(Request $request)
    {



        if( !isset($request->point) )  {
            $result["result"] = false;
            $result["message"] = "평가점수를 입력해주세요.";
            return response($result);
        }

        if( !isset($request->order) )  {
            $result["result"] = false;
            $result["message"] = "구매정보가 없습니다.";
            return response($result);
        }
        if(!Auth::guard('user')->check() ) {
                $result["result"] = false;
                $result["message"] = "로그인후에 이용하실 수 있습니다.";
                return response($result);
        }

        $result = [];
        $partner_review = new \App\Models\Partner_review;
        $partner_review->rv_partner = $request->partner ?? 2;
        $partner_review->rv_point = $request->point ?? "";
        $partner_review->rv_member = Auth::guard('user')->user()->id;
        $partner_review->rv_contents = $request->cont ?? "";

        if( $request->img ) {
            $partner_review->rv_imgs = implode(",",$request->img);
        } else {
            $partner_review->rv_imgs = "";
        }

        $partner_review->rv_order = $request->order ?? "";

        $result['result'] = $partner_review->save();
        $result['message'] = $request->partner;

        return response( $result);

        if( $result['result'] ) {
            $this->ReviewPartnerUpdate($request->partner);
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response( $result);

    }

    function ReviewPartnerUpdate($partner){
        $Partner = \App\Models\Partner::where("p_no",$partner)->first();

        $tmp = \App\Models\Partner_review::select(
            DB::raw("count(*) as count"),
            DB::raw("avg(rv_point) as point")
        )
        ->where("rv_partner", $request->partner)->first();

        $result["result"] = false;
        $result["message"] =  $tmp;
        return response($result);

        $Partner->p_review_count = $tmp['count'];
        $Partner->p_review_avg = $tmp['point'];
        $Partner->update();
    }


}
