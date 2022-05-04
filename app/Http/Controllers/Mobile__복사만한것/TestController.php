<?php
namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AlimTalkController;
use Illuminate\Support\Facades\Storage;
use Aws\Resource\Aws;
use App\Http\Classes\NCAlimtalk;

class TestController extends Controller
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

    }

    public function filelist()
    {
    //     //dd( config("filesystems") );
    //     $aa = Storage::disk('ncloud');

    //     //$aa = Storage::disk('sftp')->put('www/storage/file.txt', 'Contents');
    //     $aa = Storage::disk('ncloud')->put('file.txt', 'Contents');
    //     var_dump($aa);

    //dd( Storage::disk('ncloud')->allFiles() );
        $fileContents = "dfdfd";
        $contents = Storage::disk('ncloud')->allFiles();
        $aa = Storage::disk('ncloud')->put('/34/file.txt', 'Contents');
        //$aa = Storage::disk('ncloud')->temporaryUrl('file.txt',now()->addMinutes(5));
            var_dump($aa);

    }
    
	
    ## 마이페이지 처음
    public function index(Request $request){
        $data = [];
        return view('mobile.my_home',$data);
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
             
        $authNum = rand(100000, 999999);// 랜덤 인증 번호 생성
         $NCAlimtalk = new NCAlimtalk();
         $rev_arr[] = [
                 "to" => "01042040696",
                 "content" => "아래 인증번호를 입력해주세요.\n".$authNum
         ];
         $res = $NCAlimtalk->send( "edlhpcheck", $rev_arr);
         var_dump($res);
     }	    
}