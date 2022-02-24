<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner_review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Partner;


class FrenchReviewController extends Controller
{
    public $partner_review;

    public function __construct()
    {
        $this->partner_review = new Partner_review();
    }


    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["reviews"] = [];
        $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

        $data['average'] =
            round($data["reviews"] = $this->partner_review->select("partner_reviews.*")
                ->where("rv_partner", $data["part"]["p_no"])->avg('rv_point'),2);

        $data["rv_no"] = $request->rv_no;
        $data["reviews"] = $this->partner_review->select()->select("partner_reviews.*", "partners.p_name")
            ->leftjoin('partners', 'partners.p_no', '=', 'partner_reviews.rv_partner')
            ->where("rv_partner", $data["part"]["p_no"])
            ->where(function ($query) use ($request) {
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
            ->orderBy("rv_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["reviews"]->total() - $data["reviews"]->perPage() * ($data["reviews"]->currentPage() - 1);
        $data['total'] = $data["reviews"]->total();
        $data["reviews"]->perPage();
        $data['param'] = ['fd' => $request->fd, 'q' => $request->q];

        return view('partner.customer.review_list' , $data);
    }
}