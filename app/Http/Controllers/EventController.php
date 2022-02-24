<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Classes\NCPdisk;

class EventController extends Controller
{
    public function __construct()
    {
        $this->event = new Event();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["events"] = [];
        $data["events"] = $this->event->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "title" ) {
                        $query->where("e_title", "like", "%" . $request->q . "%");
                    }  elseif( $request->fd == "cont" ) {
                        $query->where("e_cont", "like", "%" . $request->q . "%");
                    } else {
                        $query->
                                where("e_title", "like", "%" . $request->q . "%")
                            ->orwhere("e_cont", "like", "%" . $request->q . "%");
                    }
                }
                if ($request->state) {

                    if( $request->state == "A" ) {
                        $query->where("e_sdate",  ">", now());
                    } elseif( $request->state == "I" ) {
                        $query->where("e_sdate",  "<=", now());
                        $query->where("e_edate",  ">=", now());
                    }  elseif( $request->state == "E" ) {
                        $query->where("e_edate",  "<", now());
                    }

                }
            })
            ->orderBy("e_no","desc")->paginate(10);


            $NCPdisk = new NCPdisk;            
            foreach(  $data['events'] as $event ) {
                if( $event->e_img1 ) {
                    $event->e_img1 = $NCPdisk->url($event->e_img1);
                }
                if( $event->e_img2 ) {
                    $event->e_img2 = $NCPdisk->url($event->e_img2);
                }
                if( $event->e_img3 ) {
                    $event->e_img3 = $NCPdisk->url($event->e_img3);
                }
            }  

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["events"]->total() - $data["events"]->perPage() * ($data["events"]->currentPage() - 1);
        $data['total'] = $data["events"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.event.event_list', $data);
    }

    public function index_partner(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["events"] = [];
        $data["events"] = $this->event->select()
        ->select("events.*", "partners.p_name")
            ->leftjoin('partners', 'e_partner', '=', 'partners.p_no')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "title" ) {
                        $query->where("e_title", "like", "%" . $request->q . "%");
                    }  elseif( $request->fd == "cont" ) {
                        $query->where("e_cont", "like", "%" . $request->q . "%");
                    } else {
                        $query->
                                where("e_title", "like", "%" . $request->q . "%")
                            ->orwhere("e_cont", "like", "%" . $request->q . "%");
                    }
                }
                if ($request->state) {

                    if( $request->state == "A" ) {
                        $query->where("e_sdate",  ">", now());
                    } elseif( $request->state == "I" ) {
                        $query->where("e_sdate",  "<=", now());
                        $query->where("e_edate",  ">=", now());
                    }  elseif( $request->state == "E" ) {
                        $query->where("e_edate",  "<", now());
                    }

                }
            })
            ->orderBy("e_no","desc")->paginate(10);


 

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["events"]->total() - $data["events"]->perPage() * ($data["events"]->currentPage() - 1);
        $data['total'] = $data["events"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.event.event_partner', $data);
    }



    public function update(Request $request)
    {

        #DB::enableQueryLog();	//query log 시작 선언부
        #dd(DB::getQueryLog());
        $result = [];
        if( $request->no ) {
            $event = \App\Models\Event::where('e_no', $request->no)->firstOrFail();
        } else {
            $event = new event();
        }

        $event->e_partner = $request->partner ?? 0;
        $event->e_admin = $request->admin ?? 0;
        $event->e_manager = $request->manager ?? 0;
        $event->e_sdate = $request->sdate ?? "";
        $event->e_edate = $request->edate ?? "";
        $event->e_type = $request->type ?? "P";
        $event->e_value = $request->value ?? "";
        $event->e_title = $request->title ?? "";
        $event->e_cont = $request->cont ?? "";
        $event->e_read = $request->read ?? "N";

        if( $request->del_img1=="Y" ) {
            Storage::disk('ncloud')->delete($event->e_img1);
            $event->e_img1 = ""; 
        }

        if( $request->del_img2=="Y" ) {
            Storage::disk('ncloud')->delete($event->e_img2);
            $event->e_img2 = ""; 
            
        }
        if( $request->del_img2=="Y" ) {
            Storage::disk('ncloud')->delete($event->e_img3);
            $event->e_img3 = ""; 
            
        }

        if( $request->img1 ) {
            $NCPdisk = new NCPdisk;
            $upload_res = $NCPdisk->upload("event", $request->img1);            
            if( $upload_res ) {
                $event->e_img1 = $upload_res['filepath'];  
            }
        }

        if( $request->img2 ) {
            $NCPdisk = new NCPdisk;
            $upload_res = $NCPdisk->upload("event", $request->img2);            
            if( $upload_res ) {
                $event->e_img2 = $upload_res['filepath'];  
            }
        } 
        if( $request->img3 ) {
            $NCPdisk = new NCPdisk;
            $upload_res = $NCPdisk->upload("event", $request->img3);            
            if( $upload_res ) {
                $event->e_img3 = $upload_res['filepath'];   
            }
        }           

        if( $event->e_no ) {
            $result['result'] = $event->update();
        } else {
            $result['result'] = $event->save();
        }
        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    ## 폼을 위한 정보
    public function getInfo(Request $request){
        $data["result"] = true;
        $data["event"] = $this->event->select(
                [
                    'e_no as no',
                    'e_type as type',
                    'e_sdate as sdate',
                    'e_edate as edate',
                    'e_title as title',
                    'e_cont as cont',
                    'e_cont2 as cont2',
                    'e_img1 as img1',
                    'e_img2 as img2',
                    'e_img3 as img3',
                    'e_partner as partner',
                    'e_value as value',
                    'partners.p_name as p_name'
                ]
            )
            ->leftjoin('partners', 'events.e_partner', '=', 'partners.p_no')
            ->where("e_no",  $request->no)->first();

            $NCPdisk = new NCPdisk;            
        

            if( $data['event']->img1 ) {
                $data['event']->img1_url = $NCPdisk->url($data['event']->img1);
            }
            if( $data['event']->img2 ) {
                $data['event']->img2_url = $NCPdisk->url($data['event']->img2);
            }
            if( $data['event']->img3 ) {
                $data['event']->img3_url = $NCPdisk->url($data['event']->img3);
            }



        return response($data);
    }

    ## 폼을 위한 정보 - 사용자에서 사용할...
     public function view(Request $request){

         $data["result"] = true;
         if( $request->no ) {
             $data["event"] = $this->event->select()->where("q_no",  $request->no)->first();

             if( !$data["event"] ) {
                 return redirect()->back()->withErrors(['alert', 'Updated!']);
             }

         } else {
             $data["event"] = [];
         }
         return view('admin.event.event_form.', $data);
     }

}
