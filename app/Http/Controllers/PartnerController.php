<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Partner;
use App\Models\PartnerPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Classes\NCPdisk;


use App\Http\Controllers\PartnerRegController;

use Exception;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class PartnerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $partner;

    public function __construct()
    {
        $this->partner = new Partner();
    }


    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["partners"] = [];
        $data["partners"] = $this->partner->select()
            ->where(function ($query) use ($request) {
                if ($request->last) {
                    $now_timestamp = Carbon::now()->getTimestamp();
                    //ate_add(now(),'interval 7 day')

                    if( $request->last == "A" ) {
                        // 사용중
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), ">=", $now_timestamp+(86400*7));
                    }
                    else if( $request->last == "B" ) {
                        // 임박
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), "<", $now_timestamp+(86400*7));
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), ">=", $now_timestamp+(86400*1));
                    }
                    else if( $request->last == "C" ) {
                        // 1일전
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), "<", $now_timestamp+(86400*1));
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), ">=", $now_timestamp);
                    }
                    else if( $request->last == "D" ) {
                        // 종료
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), "<", $now_timestamp);
                    }


                }

                if ($request->q) {
                    $query->where("p_id", "like", "%".$request->q."%")
                        ->orwhere("p_name", "like", "%".$request->q."%")
                        ->orwhere("p_address1", "like", "%".$request->q."%")
                        ->orwhere("p_email", "like", "%".$request->q."%")
                        ->orwhere("p_phone", "like", "%".$request->q."%");
                }
                if( $request->state ) {
                    $query->where("p_state", $request->state);
                }
            })
            ->orderBy("p_no","desc")->paginate(10)->setPath('')->appends(request()->query());

        $data['total'] = $data["partners"]->total();
        $data['start'] = $data["partners"]->total() - $data["partners"]->perPage() * ($data["partners"]->currentPage() - 1);
        foreach(  $data["partners"] as $partner ) {

            ## 지역명
            $partner->p_area = explode(" ", $partner->p_address1);

            if( $partner->p_last_dt != "0000-00-00") {
                $last_dt = new Carbon($partner->p_last_dt);
                $last_timestamp = $last_dt->getTimestamp();
                $now_timestamp = Carbon::now()->getTimestamp();

                $term = ($last_timestamp - $now_timestamp) / 86400;

                if( $term >= 7 ) {
                    $partner->reg_state = "사용중";
                    $partner->reg_color = "success";
                }  elseif( $term < 7 && $term >= 1  ) {
                    $partner->reg_state = "임박";
                    $partner->reg_color = "info";
                }  elseif( $term < 1 &&  $term >= 0 ) {
                    $partner->reg_state = "1일전";
                    $partner->reg_color = "warning";
                } else {
                    $partner->reg_state = "종료";
                    $partner->reg_color = "danger";
                }

            } else {
                $partner->reg_state = "미사용";
                $partner->reg_color = "secondary";
            }
        }

        $data['param'] = ['state' => $request->state, 'last' => $request->last, 'area' => $request->area, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.partner.list', $data);
    }

    ## 삭제목록
    public function deleted_index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["partners"] = [];
        $data["partners"] = $this->partner->onlyTrashed()
            ->where(function ($query) use ($request) {
                if ($request->last) {
                    $now_timestamp = Carbon::now()->getTimestamp();
                    //ate_add(now(),'interval 7 day')

                    if( $request->last == "A" ) {
                        // 사용중
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), ">=", $now_timestamp+(86400*7));
                    }
                    else if( $request->last == "B" ) {
                        // 임박
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), "<", $now_timestamp+(86400*7));
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), ">=", $now_timestamp+(86400*1));
                    }
                    else if( $request->last == "C" ) {
                        // 1일전
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), "<", $now_timestamp+(86400*1));
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), ">=", $now_timestamp);
                    }
                    else if( $request->last == "D" ) {
                        // 종료
                        $query->where(DB::raw("unix_timestamp(p_last_dt)"), "<", $now_timestamp);
                    }


                }

                if ($request->q) {
                    $query->where("p_id", "like", "%".$request->q."%")
                        ->orwhere("p_name", "like", "%".$request->q."%")
                        ->orwhere("p_address1", "like", "%".$request->q."%")
                        ->orwhere("p_email", "like", "%".$request->q."%")
                        ->orwhere("p_phone", "like", "%".$request->q."%");
                }
                if( $request->state ) {
                    $query->where("p_state", $request->state);
                }
            })
            ->orderBy("p_no","desc")->paginate(10)->setPath('')->appends(request()->query());

        $data['total'] = $data["partners"]->total();
        $data['start'] = $data["partners"]->total() - $data["partners"]->perPage() * ($data["partners"]->currentPage() - 1);
        foreach(  $data["partners"] as $partner ) {

            ## 지역명
            $partner->p_area = explode(" ", $partner->p_address1);

            if( $partner->p_last_dt != "0000-00-00") {
                $last_dt = new Carbon($partner->p_last_dt);
                $last_timestamp = $last_dt->getTimestamp();
                $now_timestamp = Carbon::now()->getTimestamp();

                $term = ($last_timestamp - $now_timestamp) / 86400;

                if( $term >= 7 ) {
                    $partner->reg_state = "사용중";
                    $partner->reg_color = "success";
                }  elseif( $term < 7 && $term >= 1  ) {
                    $partner->reg_state = "임박";
                    $partner->reg_color = "info";
                }  elseif( $term < 1 &&  $term >= 0 ) {
                    $partner->reg_state = "1일전";
                    $partner->reg_color = "warning";
                } else {
                    $partner->reg_state = "종료";
                    $partner->reg_color = "danger";
                }

            } else {
                $partner->reg_state = "미사용";
                $partner->reg_color = "secondary";
            }
        }

        $data['param'] = ['state' => $request->state, 'last' => $request->last, 'area' => $request->area, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.partner.list', $data);
    }    

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];

        // if( !$request->id || !isset($request->id) || strlen($request->id) < 6  ) {

        //     $result["result"] = false;
        //     $result["partner"] = $request->id;
        //     $result["message"] = "아이디는 6자이상 입력해주세요.";
        //     return response($result);
        // }

        if( !$request->name || !isset($request->name) || strlen($request->name) < 3  ) {

            $result["result"] = false;
            $result["partner"] = $request->id;
            $result["message"] = "가맹점명은 3자이상 입력해주세요.";
            return response($result);
        }

        if( $request->no ) {
            $partner = \App\Models\Partner::where('p_no', $request->no)->first();
        } else {


            if( $partner = \App\Models\Partner::where('p_id', $request->id)->first() ) {
                $result["result"] = false;
                $result["message"] = "이미 존재하는 가맹점입니다.";
                return response($result);
            } else if( $partner = \App\Models\Partner::where('p_name', $request->name)->first() ) {
                $result["result"] = false;
                $result["message"] = "이미 존재하는 가맹점입니다.";
                return response($result);
            } else {
                $partner = new Partner();
                $partner->p_id = $request->id;
            }
        }

        if( $request->passwd ) $partner->p_passwd = $request->passwd ?? "";
        $partner->p_kind = $request->kind ?? "";
        $partner->p_open_mobile = $request->open_mobile ?? "N";
        $partner->p_open_kiosk = $request->open_kiosk ?? "N";
        $partner->p_door = $request->door ?? "Q";
        
        $partner->p_name = $request->name ?? "";
        $partner->p_homepage = $request->homepage ?? "";
        $partner->p_phone = $request->phone ?? "";
        $partner->p_bizno = $request->bizno ?? "";
        $partner->p_ceo = $request->ceo ?? "";
        $partner->p_email = $request->email ?? "";
        $partner->p_intro = $request->intro ?? "";

        $partner->p_emp_name = $request->emp_name ?? "";
        $partner->p_emp_duty = $request->emp_duty ?? "";
        $partner->p_emp_email = $request->emp_email ?? "";
        $partner->p_emp_hphone = $request->emp_hphone ?? "";

        $partner->p_zipcode = $request->zipcode ?? "";
        $partner->p_address1 = $request->address1 ?? "";
        $partner->p_address2 = $request->address2 ?? "";

        if( $request->option ) {
            $partner->p_options = implode(",", ($request->option ?? "") );
            $partner->p_options_cont = json_encode($request->options_cont);
        } else {
            $partner->p_options = "";
            $partner->p_options_cont = "";
        }

        $partner->p_map_use = $request->map_use ?? "";
        $partner->p_map_latitude = $request->map_latitude ?? 0;
        $partner->p_map_longitude = $request->map_longitude ?? 0;
        $partner->p_road = $request->road ?? "";
        $partner->p_work_time = $request->work_time ?? "";
        $partner->p_work_close = $request->work_close ?? "";
        $partner->p_parking = $request->parking ?? "";
        $partner->p_keyword = $request->keyword ?? "";
        $partner->p_seq = $request->seq ?? 0;
        $partner->p_memo = $request->memo ?? "";

        $partner->p_state = $request->state ?? "N";


        if( $partner->p_no ) {
            $result['result'] = $partner->update();
        } else {
            $result['result'] = $partner->save();

            $partnerReg = new PartnerRegController();
            $partnerReg->defaultReg($partner->p_no);
        }

        if( $partner->p_id ) {

            ## 디비를 실시간으로 생성.
            $schemaName = "boss_".$partner->p_id;
            $charset = config("database.connections.mysql.charset",'utf8mb4');
            $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');
            //config(["database.connections.mysql.database" => null]);
            $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";
            DB::statement($query);

            ## 샘플디비로 부터 복사.            
            try {
                $pwd = exec('pwd');
                $makedb = exec('php '.$pwd.'/../exbuilder_shell/french_makedb.php '.$partner->p_id);
            } catch(Exception $e) {

            }
        } 

        $data["partner"] = $partner->p_id;
        return response($result);
        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    public function delete(Request $request)
    {

        $result = [];
        if( $request->no ) {
            $partner = \App\Models\Partner::where('p_no', $request->no)->first();
            if( $partner ) {
                $data["result"] = true;
                $result['result'] = $partner->delete();
            } else {
                $data["result"] = false;
                $data["message"] = "정보가 존재하지 않습니다.";
            }
        } else {
            $data["result"] = false;
            $data["message"] = "가맹점이 선택되지 않았습니다.";
        }

        return response($result);

    }

    ## 폼을 위한 정보
    public function form(Request $request){

        $data["result"] = true;
        $data["options"] = Config::get('partner.options');
        if( $request->no ) {
            $data["partner"] = $this->partner::where("p_no",  $request->no)->first();
            
            if( !$data["partner"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

            //
            $data["partner"]->p_area = explode(" ",$data["partner"]->p_address1);

            if( isset($data["partner"]->p_options) ) {
                $data["partner"]->option_arr = explode(",",$data["partner"]->p_options);
                $data["partner"]->options_cont = json_decode($data["partner"]->p_options_cont,true);
            } 
        } else {
            $data["partner"] = [];
        }


        return view('admin.partner.form', $data);
    }

    ## 사진폼/목록
    public function photo(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["partner"] = $this->partner->select()->where("p_no",  $request->no)->first();

            if( !$data["partner"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

            $data["partner"]->p_area = explode(" ",$data["partner"]->p_address1);

        } else {
            $data["partner"] = [];
        }

        return view('admin.partner.photo', $data);
    }

    ## 폼을 위한 정보
    public function photo_upload(Request $request){

        if( !$request->img ) {
            $data["result"] = false;
            $data["message"] = "첨부된 파일이 없습니다.";
            return response($data);
        }  
        if( !$request->kind ) {
            $data["result"] = false;
            $data["message"] = "파일 구분이 선택되지 않았습니다.";
            return response($data);
        }        


        $NCPdisk = new NCPdisk;
        $upload_res = $NCPdisk->upload("partner/".$request->no, $request->img);

        //$upload_res = Storage::disk('ncloud')->put($save_filename,$file_contents);

        if( $upload_res['result'] ) {
            $last_photo = new PartnerPhoto();
            $last_seq = $last_photo::select()->where("pt_kind", $request->kind)->max("pt_seq");
            $photo = new PartnerPhoto();
            $photo->pt_filename = $upload_res['filepath'];
            $photo->pt_partner = $request->no;
            $photo->pt_kind = $request->kind;
            $photo->pt_seq = $last_seq + 1;

            $data["result"] = $photo->save();
            $data["seq"] = $photo->pt_seq;
            $data["kind"] = $photo->pt_kind;
            $data["filename"] = $photo->pt_filename;

            if( $data["result"] && $request->kind == "A") {

                $first_photo = $last_photo::where('pt_partner', $photo->pt_partner)->where("pt_kind", $request->kind)->first();
                if( $first_photo ) {

                    $partner = \App\Models\Partner::where('p_no', $photo->pt_partner)->first();
                    if( $partner ) {
                            $partner->p_img1 = $first_photo->pt_filename;
                            $partner->update();
                    }                    

                }
   
            }

        } else {
            $data["result"] = false;
            $data["message"] = "업로드에 실패했습니다.";
        }
        return response($data);
    }

    ## 사진목록얻기
    public function photo_list(Request $request){

        if( !$request->kind ) {
            $data["result"] = false;
            $data["message"] = "파일 구분이 선택되지 않았습니다.";
            return response($data);
        }  

        $data["result"] = true;
        $data['photos'] = \App\Models\PartnerPhoto::where("pt_partner", $request->no)
        ->where(function ($query) use ($request) {
            if( $request->kind != "ALL") {
                $query->where("pt_kind", $request->kind);
            }  
        })        
        ->where("pt_kind", $request->kind)->orderBy("pt_seq")->get();

        $data["kind"] = $request->kind;
        $data["result"] = true;

        foreach(  $data['photos'] as $photo ) {
            if( $photo->pt_filename ) {
                $photo->pt_filename = Storage::disk('ncloud')->temporaryUrl($photo->pt_filename,now()->addMinutes(15));
            }
        }        
        return response($data);
    }


    ## 사진삭제
    public function photo_delete(Request $request){
        if( !$request->pt ) {
            $data["result"] = false;
            $data["message"] = "파일이 선택되지 않았습니다.";
            return response($data);
        }  
        $photo = \App\Models\PartnerPhoto::where("pt_partner", $request->no)->where("pt_no", $request->pt)->first();
        if( $photo ) {
            $data["result"] = $photo->delete();
            if( $data["result"] ) {
                //Storage::delete($photo->pt_filename);
                Storage::disk('ncloud')->delete($photo->pt_filename);
            }
        } else {
            $data["result"] = false;
            $data["message"] = "존재하지 않는 파일입니다.";
            return response($data);
        }
        

        return response($data);
    }

    # API.가맹점 목록을 얻음
    public function get_list(Request $request){
        $data["result"] = true;
        $data["partners"] = $this->partner->select(["p_no", "p_name"])
            ->where("p_state", "Y")
            ->orderBy("p_name","desc")->get();

        if( $data["partners"] ) {
            $data["result"] = true;
        } else {
            $data["result"] = false;
        }

        return response($data);
    }

    ## 목록
    public function search(Request $request){

        $data["q"] = $request->q ?? "";
        $data["partners"] = $this->partner->select(["p_no as no", "p_name as name", "p_address1 as area", "p_phone as phone"])
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("p_name", "like", "%".$request->q."%")
                        ->orwhere("p_email", "like", "%".$request->q."%")
                        ->orwhere("p_phone", "like", "%".$request->q."%");
                }
          
            })
            ->orderBy("p_name","asc")->get();

        return response($data);
    } 


    ## 폼을 위한 정보
    public function get_new_last_date(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["partner"] = $this->partner->select("p_no as no", "p_name as name", DB::raw("date_format( date_add(p_last_dt, interval 1 day), '%Y-%m-%d' ) as new_dt"))->where("p_no",  $request->no)->first();
        } else {
            $data["partner"] = [];
        }
        return response($data);
    }

    # API.가맹점 찜등록/해제
    public function set_favorite(Request $request){
        if( $fv = \App\Models\Partner_favorite::where('fv_partner', $request->no)
        //->where('fv_user', $request->user)
        ->first() ) {
            $data["result"] = $fv->delete();
            $data["fv_no"] = 0;
        } else {
            $fv = new \App\Models\Partner_favorite;
            $fv->fv_partner = $request->no;
            $fv->fv_user = 8;
            $data["result"] = $fv->save();
            $data["fv_no"] = $fv->fv_no;
        }         
        return response($data);
    }


    # API.가맹점 방문한 가맹점
    public function set_visit(Request $request){
        if( $visit = \App\Models\Partner_view::where('v_partner', $request->no)
        ->where('v_user', $request->user)
        ->first() ) {
            $visit->v_count++;
            $data["result"] = $visit->update();
            $data["v_no"] = $visit->v_no;
            $data["v_time"] = \Carbon\Carbon::instance($visit->updated_at)->format('Y-m-d H:i:s');
        } else {
            $visit = new \App\Models\Partner_view;
            $visit->v_partner = $request->no;
            $visit->v_user = 8; // 임시회원번호
            $visit->v_count++;
            $data["result"] = $visit->save();
            $data["v_no"] = $visit->v_no;
            $data["v_time"] = \Carbon\Carbon::instance($visit->updated_at)->format('Y-m-d H:i:s');
        }         
        return response($data);
    }


}
