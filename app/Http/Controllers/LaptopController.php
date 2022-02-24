<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use App\Models\Partner;

class FrenchLaptopController extends Controller
{
    public function __construct()
    {
        $this->partner = new Partner();
        $this->laptop = new Laptop();
    }

    
## 목록
public function index(Request $request){
    Config::set('database.connections.partner.database',"boss_".$request->account);
    //DB::enableQueryLog();	//query log 시작 선언부
    $data["part"] = [];
    $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

    $data["laptops"] = [];
    $data["laptops"] = $this->laptop->select()
    ->where("lap_partner", $data["part"]["p_no"])
    ->where(function ($query) use ($request) {
        if ($request->q) {
            if( $request->fd == "model" ) {
                $query->where("lap_model", "like", "%" . $request->q . "%");
            } elseif( $request->fd == "spec" ) {
                $query->where("lap_spec", "like", "%" . $request->q . "%");
            }  elseif( $request->fd == "state" ) {
                $query->where("lap_state", "like", "%" . $request->q . "%");
            } else {
                $query->where("lap_model", "like", "%" . $request->q . "%")
                    ->orwhere("lap_spec", "like", "%" . $request->q . "%")
                    ->orwhere("lap_state", "like", "%" . $request->q . "%");
            }
        }
    })
    ->orderBy("lap_no","desc")->paginate(6);

    $data['start'] = $data["laptops"]->total() - $data["laptops"]->perPage() * ($data["laptops"]->currentPage() - 1);
    $data['total'] = $data["laptops"]->total();
    $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
    return view('partner.article.laptop',$data);
}


#저장, 업데이트
public function update(Request $request){
    Config::set('database.connections.partner.database',"boss_".$request->account);


    $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();
    $result = [];
    if( $request->no ) {
        $laptop = \App\Models\Laptop::where('lap_no', $request->no)->firstOrFail();
    } else {
        $laptop = new laptop();
    }
    $laptop->lap_partner = $data["part"]["p_no"] ?? 0;
    $laptop->lap_model = $request->model ?? "";
    $laptop->lap_spec = $request->spec ?? "";
    $laptop->lap_state = $request->state ?? "N";

 
    if( $laptop->lap_no ) {
        $result['result'] = $laptop->update();
    } else {
        $result['result'] = $laptop->save();
    }
    if( $request->rURL ) {
        $result['rURL'] = $request->rURL;
    } else {
        $result['rURL'] = "";
    }

    return response($result);
}

#폼정보
public function getInfo(Request $request){
    Config::set('database.connections.partner.database',"boss_".$request->account);
 
    $data["result"] = true;
    $data["laptop"] = $this->laptop->select(
            [
                'lap_no as no',
                'lap_model as model',
                'lap_spec as spec',
                'lap_state as state'
            ]
        )
        ->where("lap_no",  $request->no)->first();
    return response($data);
}

}
