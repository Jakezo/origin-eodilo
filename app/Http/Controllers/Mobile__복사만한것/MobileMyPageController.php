<?php
namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PartnerCoupon;
use App\Models\UserCoupon;
use App\Models\Partner_favorite;
use App\Models\User_cash;
use App\Models\Partner_review;
use App\Models\PartnerPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Classes\NCPdisk;

use App\Http\Classes\NCAlimtalk;

class MobileMyPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $user;

    public function __construct()
    {
        $this->mycoupon = new UserCoupon();
        $this->partnercoupon = new PartnerCoupon();
        $this->cashes = new User_cash();
    }

    ## 마이페이지 처음
    public function index(Request $request){
        if(isset(Auth::guard('user')->user()->id)){

        $data = [];
        $data["mycoupons"] = $this->mycoupon->select('uc_no',DB::Raw('count(*) as count' ))
        ->where('uc_user', Auth::guard('user')->user()->id)
        ->first();

        $data["cash_total"]=$this->cashes->select(DB::raw("sum(mp_point) as sum"))
        ->where('mp_member', Auth::guard('user')->user()->id)
        ->first();

        return view('mobile.my_home',$data);

        }else{
        return redirect('signin');
        }
    }


    ## 메일테스트
    public function mail(Request $request){

        $receiver = array(
            'email'=>'exbuilder@naver.com',
            'name'=>'엑스퍼트빌더'
        );

        $data = array(
            'detail'=>'내용은 이렇게 나갑니다.',
            'name' => "이름"
        );

        Mail::send('mails.welcome', $data, function($message) use ($receiver) {
            $message->from('mygospel7@gmail.com', '어디로서비스');
            $message->to($user['email'], $user['name'])->subject('[어디로] 메일인증을 해주세요.');
        });



        // list($microtime, $timestamp) = explode(' ',microtime());
        // $time = $timestamp . substr($microtime, 2, 3);
        // echo $time."<br>";

        // $timestamp = Carbon::now()->getTimeStamp();
        // echo $timestamp."<br>";

        // $access_key = "hfSRKJQsqJPPbeULrNz7";
        // $secret_key = "PetGINhs70gyted1fJPJCPoJIAOi7itI5HCEpXl1";

        // $message = "POST";
        // $message .= " ";
        // $message .= "/api/v1/mails";
        // $message .= "\n";
        // $message .= $timestamp;
        // $message .= "\n";
        // $message .= $access_key;
        // $signature = base64_encode(hash_hmac('sha256', $message, $secret_key, true));

        // $headers = array(
        //     "Content-Type: application/json;" ,
        //     "x-ncp-apigw-timestamp: " . $timestamp . "" ,
        //     "x-ncp-iam-access-key: " . $access_key . "" ,
        //     "x-ncp-apigw-signature-v2: " . $signature . "" );

        // $mailContentsDataSet["senderAddress"] = "wind5785@naver.com";
        // $mailContentsDataSet["senderName"] = "어디로";
        // $mailContentsDataSet["title"] = "어디로테스트메일";
        // $mailContentsDataSet["body"] = stripslashes(htmlspecialchars_decode("본문내용 HTML 형식"));
        // $mailContentsDataSet["recipients"][] =
        //         array(
        //             "address" => "exbuilder@naver.com",
        //             "name" => "조현준",
        //             "type" => "R" );
        // // $mailContentsDataSet["recipients"][] = array(
        // //     "address" => "참조 이메일",
        // //     "name" => "참조 이름",
        // //     "type" => "C" );

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "https://mail.apigw.ntruss.com/api/v1/mails");
        // curl_setopt($ch, CURLOPT_HEADER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mailContentsDataSet));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);



        return "done";
    }

   ## 메일테스트
   public function alimtalk( Request $request){

    $NCAlimtalk = new NCAlimtalk();
    $NCAlimtalk->send( "edlrevseat", $rev_arr = [], $trans_data = [] , $btn_arr = "" );

    return "done";
}

    ## 내쿠폰 목록
    public function coupon(Request $request){
    $data["mycoupons"] = [];
    $data["mycoupons"] = $this->mycoupon->select()
    ->leftjoin('partner_coupons','partner_coupons.c_no','=','user_coupons.uc_coupon')
    ->leftjoin('partners','partners.p_no','=','user_coupons.uc_partner')
    ->where('uc_user', Auth::guard('user')->user()->id)
    ->where("c_sdate",  "<=", now())
    ->where("c_edate",  ">=", now())
    ->where("uc_used", "N")
    ->orderBy("uc_no","desc")->paginate(10);

    return view('mobile.my_coupon',$data);
}

     #내찜목록
     public function myfavorite_list(Request $request){

        if(isset(Auth::guard('user')->user()->id)){



        $data["favorites"] = [];
        $data["favorites"]= \App\Models\Partner_favorite::select('p_no','p_name','p_img1','p_address1','p_address2','p_review_avg')
        ->leftjoin('partners','partners.p_no','=','partner_favorites.fv_partner')
        ->where('fv_user' , Auth::guard('user')->user()->id)
        ->orderBy("fv_no","desc")->get();


        $NCPdisk = new NCPdisk;

        foreach(  $data["favorites"] as $favorite ) {
            if( $favorite->p_img1 ) {
                $favorite->p_img1 = $NCPdisk->url($favorite->p_img1);
            }
            //////////
            $favorite['coupon_count'] = $this->partnercoupon->select()
            ->where("c_partner", $favorite->p_no)
            ->where("c_sdate",  "<=", now())
            ->where("c_edate",  ">=", now())
            ->count();

        }


        if( count($data["favorites"]) ){

            return view('mobile.my_cart',$data);
        }
       else{
            return view('mobile.my_cart_none',$data);
       }
    }else{
        return redirect('signin');
    }
}

        ## 특정유저가 쓴 리뷰 목록
    public function user_review(Request $request){


        $data["reviews"] = [];
        $data["reviews"]= \App\Models\Partner_review::select()
        ->leftjoin('partners','partners.p_no','=','partner_reviews.rv_partner')
        ->where("rv_member", Auth::guard('user')->user()->id)
        ->orderBy("rv_no","desc")->paginate(20);


        $NCPdisk = new NCPdisk;
        $imgArr = $imgArr2 = [];
        for( $i = 0; $i<=count($data["reviews"])-1; $i++ ) {

            if( $data["reviews"][$i]->rv_imgs ) {
                if( $imgArr = explode(",",$data["reviews"][$i]->rv_imgs )) {
                    if( is_array( $imgArr ) !== false ) {
                        for( $ii=0;$ii<=count($imgArr)-1;$ii++) {
                            $imgArr2[$ii] = [
                                'path' => $imgArr[$ii],
                                'url' => $NCPdisk->url($imgArr[$ii]),
                            ];
                        }
                    } elseif( $data["reviews"][$i]->rv_imgs ) {
                        $imgArr2[0] = $NCPdisk->url($data["reviews"][$i]->rv_imgs);
                    } else {

                    }
                }
            } else {

            }

            $data["reviews"][$i]->rv_imgs = $imgArr2;

        }

        $data['total'] = $data["reviews"]->total();

        return view('mobile.my_review', $data);

        }


        ## 특정유저가 쓴 리뷰 상세내용
        public function review_detail(Request $request){

            $data["reviews"] = [];
            $data["reviews"]= \App\Models\Partner_review::select()
            ->leftjoin('partners','partners.p_no','=','partner_reviews.rv_partner')
            ->where(function ($query) use ($request) {
                if ($request->u_no) {
                    $query->where("rv_member", Auth::guard('user')->user()->id);
            }
                if ($request->rv_no) {
                     $query->where("rv_no", $request->rv_no);
            }
            })->first();

            return view('mobile.my_review_modify', $data);

        }


    public function review_update(Request $request)
        {

        $result = [];
        if( $request->rv_no ) {
            $partner_review = \App\Models\Partner_review::where('rv_no', $request->rv_no)->firstOrFail();
        } else {
           $result["messege"]="잘못된정보입니다";
        }
        $partner_review->rv_partner = $request->partner ?? 0;
        $partner_review->rv_point = $request->point ?? 1;
        $partner_review->rv_member = Auth::guard('user')->user()->id;
        $partner_review->rv_contents = $request->cont ?? "";
        $partner_review->rv_imgs = $request->img ?? "";

        if( $partner_review->rv_no ) {
            $result['result'] = $partner_review->update();
        } else {
            $result['result'] = $partner_review->save();
        }
        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
            } else {
                $result['rURL'] = "";
            }

            return response($result);
        }

        #리뷰삭제
        public function review_delete(Request $request)
        {
            $result = [];
            if( $request->no ) {
                $partner_review = \App\Models\Partner_review::where('rv_no', $request->no)
                ->first();
                if( $partner_review ) {
                    $result['result'] = $partner_review->delete();
                    if( $result['result'] == false ) {
                        $result['message'] = "삭제하지 못했습니다.";
                    }
                } else {
                    $result = [
                        'result' => false,
                        'message' => "데이터가 존재하지 않습니다."];
                }
            } else {
                $result = [
                    'result' => false,
                    'message' => "정보가 존재하지 않습니다."];
            }

            return response($result);
        }


}
