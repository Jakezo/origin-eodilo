<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.manager_onlypage')

@section('title', 'Page Title')

@section('content')
<link rel="stylesheet" href="/assets/plugins/seat_editor/css/jlayout.css">
<style>
    #panel_top {
        list-style-type: none;
        top:5px;
        left:5px;
        right:5px;
        padding: 0px;
        margin: 0px;
        width: 100%;
        height:70px;
        overflow: auto;
        position: fixed;
    }
    #panel_control {
        list-style-type: none;
        top:80px;
        right:5px;
        padding: 0px;
        margin: 0px;
        width: 200px;
        overflow: auto;
        position: fixed;
    }
    .selected_shape {
        border : 1px solid red;
    }
    .unselected_shape {
        border : 1px solid black;
    }
</style>   

<div class="modal fade" id="bgModal" tabindex="-3" aria-labelledby="bgModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bgModalLabel">배경이미지</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="tab-content py-3">
                    <form method="post" class="row g-3" id="bgform" name="bgform" enctype="multipart/form-data">
                        <input type="hidden" name="map" id="map" value="{{ $map ?? "" }}">

                        <div class="col-9" id="save_pannel">
                            <input type="file" name="bg" id="bg" class="form-control">
                        </div>
                        <div class="col-3" id="save_pannel">
                            <button id="btn_upload" type="button" class="btn btn-danger col-12">업로드</button>
                        </div>
                    </form>  
                </div>
               

            </div>
            <div class="modal-body">

                <div class="tab-content py-3">
                         <div class="col-2" id="del_pannel">
                            <button id="btn_delete_bg" type="button" class="btn btn-dark col-12">기존배경삭제</button>
                        </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>   



<div class="card" id="panel_control" style="z-index:10000000">
    <div class="card-body">

        <form class="row g-3">
            <input type="hidden" name="map" id="map" value="{{ $map ?? "" }}">
            <div class="col-12" id="save_pannel">
                <button type="button" id="btn_save" class="btn btn-danger col-12">편집을 저장</button>
            </div>
        </form>                                    
        {{-- 
        <div id="create_pannel">
            <div class="head">종류</div>
            <div class="body">
               
                <div><button onclick="add_shape('table');">개인좌석 -> 이기능삭제</button></div>
                <div><button onclick="add_shape('table2');">회의실</button></div>
                <div><button onclick="add_shape('wall');">벽</button></div>
                <div>
                    <button onclick="add_shape('pillar1');">둥근기둥</button>
                    <button onclick="add_shape('pillar2');">사각기둥</button>
                </div> 
                
            </div>
        </div>
        --}}
        <div id="edit_pannel" >
            룸
            <div class="row">
                <div class="col-md-6">
                    <label for="pos_x" class="form-label">가로</label>
                    <input type="text" class="form-control form-control-sm" name="room_width" id="room_width" placeholder="가로" value="{{ $bg_width }}">
                </div>
                <div class="col-md-6">
                    <label for="pos_y" class="form-label">세로</label>
                    <input type="text" class="form-control form-control-sm b" name="room_height"id="room_height" placeholder="세로" value="{{ $bg_height }}">
                </div>
            </div>

            좌석정보

            <div class="row">
                <div class="col-md-6">
                    <label for="pos_x" class="form-label">X 좌표</label>
                    <input type="text" class="form-control form-control-sm" name="pos_x" id="pos_x" placeholder="X 좌표">
                </div>
                <div class="col-md-6">
                    <label for="pos_y" class="form-label">Y 좌표</label>
                    <input type="text" class="form-control form-control-sm b" name="pos_y"id="pos_y" placeholder="Y 좌표">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="size_w" class="form-label">가로크기</label>
                    <input type="number" min="0" max="1000" name="size_w" id="size_w" class="form-control form-control-sm" placeholder="가로크기">
                </div>
                <div class="col-md-6">
                    <label for="size_h" class="form-label">세로크기</label>
                    <input type="number" min="0" max="1000" name="size_h" id="size_h" class="form-control form-control-sm b" placeholder="세로크기">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="tran_ro" class="form-label">방향회전</label>
                    <input type="number" min="0" max="360" name="tran_ro" id="tran_ro" class="form-control form-control-sm" placeholder="방향회전">
                </div>
                <div class="col-md-6">
                    <label for="tran_sc" class="form-label">확대비율</label>
                    <input type="number" min="0.3" max="2" step="0.1" name="tran_sc" id="tran_sc" class="form-control form-control-sm b" placeholder="확대비율">
                </div>
            </div>

            <div id="pn_name">객체를 수정하려면 먼저 선택해주세요.</div>

            <div class="head">상태1</div>
            <div class="row">
                <div class="col-md-12">
                    <button onclick="change_status('status2',4);" class="btn btn-xs btn-dark col-4">4일전</button> 
                    <button onclick="change_status('status2',3);" class="btn btn-xs btn-dark col-4">3일전</button> 
                    <button onclick="change_status('status2',2);" class="btn btn-xs btn-dark col-4">2일전</button>

                    <button onclick="change_status('status2',1);" class="btn btn-xs btn-dark col-6 m-1">1일전</button> 
                    <button onclick="change_status('status2',0);" class="btn btn-xs btn-dark col-6 m-1">만료</button>
                </div>
            </div>

            <div class="head">상태2</div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <button onclick="change_ribbon('status2',true);" class="btn btn-xs btn-dark col-6">ON</button> 
                    <button onclick="change_ribbon('status2',false);" class="btn btn-xs btn-dark col-6">OFF</button>
                </div>
            </div>                                        

            <!--div class="head">재작성</div>
            <div class="body">
                <div><button onclick="set_shape();">다시그리기</button></div>
                <div><button onclick="delete_shape();">선택삭제</button> <button onclick="delete_shape_all();">모두삭제</button></div>
                <div><button onclick="scale_bg(700);">전체 축소</button></div>
                <div><button onclick="set_fix();">이동방지</button></div>
            </div-->
            
        </div>
    </div>

    <div class="card-body">
        <form class="row g-3">
                <div class="col-12" id="save_pannel">
                <button id="btn_open_bg" type="button" class="btn btn-danger col-12">배경이미지</button>
            </div>
        </form>                                  
    </div>

</div>
<!--end page wrapper -->


<div class="card" id="panel_top" style="z-index:10000000">
    <div class="card-body">
        <form name="search" action="">
            <input type="hidden" name="mode" value="list">
            <div class='row'>
                <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                    <select class="single-select form-control-sm col-12" name="map" id="map" onchange="window.location='{{ $PHP_SELF ?? "" }}?map='+this.value">
                        <option value=''>배치도선택</option>
                        <?php foreach( $map_arr as $mi => $map_info ){?>
                            <option value='{{ $map_info->m_no }}' <?php if( isset($map) && $map == $map_info->m_no ) {?> selected<?php }?>>{{ $map_info->m_name }}</option>
                        <?php  }?>
                    </select>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                    <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#seatFormModal">신규</a>
                </div>
                
                <div class="col-md-8 col-sm-4 col-xs-12 mt-1">
                    <a href="javascript:;" class="btn btn-secondary px-2 btn-sm col-3 float-end" onclick="window.close()">닫기</a>
                </div>
            </div>
        </form>
    </div>
</div>

    <!--start page wrapper -->
    <div class="wrapper" style="margin-right:25px;margin-top:60px;">
        <div class="content p-2">

            <!--end breadcrumb-->

                <div class="card">
                    <div class="card-body" style="width:{{ ($bg_width+250) }}px">
                        <div id="page">

                            
                            <div id="room_bg" bg="{{ $bg_url }}" style="background-size:cover;background-position: left;background-repeat:no-repeat;background-image:url({{ $bg_url }});width:{{ $bg_width ?? 600 }}px;height:{{ $bg_height ?? 400 }}px;border:1px solid red;">

                            </div>
                            <div class="guide_txt" style="display:none;">좌석을 추가하시려면 좌석관리에서 등록해주셔야 합니다.</div>

                        </div>
                    </div>
                </div>
        </div>
    </div>


 



 

@endsection


@section('javascript')

<script src="/assets/js/jquery-ui.min.js"></script>
<!--script src="/assets/css/jquery-ui.min.css"></script-->
<script src="/assets/plugins/seat_editor/js/jquery.resize.js?time={{ time() }}"></script>
<script src="/assets/plugins/seat_editor/js/jlayout.js?time={{ time() }}"></script>
<script src="/assets/plugins/seat_editor/js/jlayoutMapEditor.js?time={{ time() }}"></script>
    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", ".seat_item", function () {
                var r_no = $(this).attr("seat");
                seat_getInfo(r_no);
                console.log(r_no);
            });

            $(document).on("click", "#btn_seat_update", function () {
                seat_update();
            });
            
            $(document).on("click", "#btn_seat_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    seat_delete();
                }
            });

            $(document).on("click", "#btn_open_bg", function () {
                $("#bgModal").modal("show");
            });

            $(document).on("click", "#btn_delete_bg", function () {
                if (confirm(" 배경이미지를 삭제하시겠습니까?") == true) {
                    delete_bg();
                }
            });
            


        });


        function seat_getInfo(no) {
            var req = "no=" + no;
            console.log(req)
            $.ajax({
                url: '/setting/seat_level/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.seat != null) {
                        $("#name").val(res.seat.name);
                        $("#type"+res.seat.type).prop("checked","checked");
                        $("#state").val(res.seat.state);
                        $("#sex").val(res.seat.sex);
                    } else {
                        $("#seatDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function open_SeatInfo(){

            var idx = $("#idx").val();
            var room = $("#room").val();
            var url = "/SeatInfo/SeatInfo.php?room="+room+"&idx=" + idx;

            // 이미 seat_idx 가 있다면
            if( select_index != undefined &&  select_index != null ) {
                url += "&select_index="+select_index
            }
            window.open(url,'SeatInfo','width=900,height=500')

        }

        function mapping_SeatInfo(seat_idx,seat_name){
            obj_arr[select_index].seat_idx = seat_idx;
            obj_arr[select_index].seat_name = seat_name;
            rename_shape(select_index, seat_name);
            console.log(seat_idx,seat_name);
        }

        function save_map() {

            let room = $("#room").val();
            let map = $("#map").val();

            let idx = $("#idx").val();
            let seats = new Array();
            let roomBG_src = $("#room_bg").attr("bg");
            let roomBG_width = $("#room_bg").width();
            let roomBG_height = $("#room_bg").height();

            const obj_arr_new = [];

            $.each(obj_arr, function( i, item ) {
                console.log(obj_arr[i].status);
                if( obj_arr[i].status != "deleted" ) {
                    obj_arr_new.push(obj_arr[i]);
                }
            });

            let map_data = {
                "bg": {
                    src: roomBG_src,
                    width: roomBG_width,
                    height: roomBG_height
                },
                "seats": obj_arr_new
            }


            //console.log(map_data);
            //return false;

            console.log("w:" + roomBG_width + "h:" + roomBG_height);

            let map_data_string = encodeURIComponent(JSON.stringify(map_data));
            let data = "mode=save&idx=" + idx + "&room=" + room +"&map=" + map + "&map_data=" + map_data_string;

            $.ajax({
                type: 'POST',
                async: false,
                url: '/setting/map/update',
                data: data,
                success: function(res) {
                    
                    if( res.result == true ) {
                        document.location.reload()
                    } else {
                        console.log(res);
                    }
                },
                error:function(e){
                    console.log("error:");
                    console.log(e);
                    if(e.status==300){
                        alert("데이터를 저장하는 실패하였습니다.");
                    }
                }
            });

        }
        
        function delete_bg(){

            var formData = new FormData();   
            formData.append("map",{{ $map ?? 0 }})         

            $.ajax({
                url: '/setting/map/bg_delete',
                processData: false,
                contentType: false,
                data: formData,                
                type: 'POST',
                async: true,
                success: function (res) {
                    $("#room_bg").css({"background-image": "url("+res.bg_url+")"}).attr("bg",res.bg_url);
                    $("#bgModal").modal("hide");
                  },
                error: function(xhr, status, msg){

                }
            });
        }

        function upload_bg(){

            if( $("#bg").val() == "" ) {
                alert("이미지를 선택해주세요.");
                return false;
            }

            var form = $('#bgform')[0];
            var formData = new FormData(form);
            formData.append("width",$("#room_bg").width())
            formData.append("height",$("#room_bg").height())

            $.ajax({
                url: '/setting/map/bg_upload',
                processData: false,
                contentType: false,
                data: formData,                
                type: 'POST',
                async: true,
                success: function (res) {
                    console.log(res)
                    $("#room_bg").css({"background-image": "url("+res.bg_url+")"}).attr("bg",res.bg_url);
                    $("#bgModal").modal("hide");
                  },
                error: function(xhr, status, msg){

                }
            });
        }

        $(document).ready(function(){
            
            /* 저장 */
            $(document).on("click","#btn_save", function(){
                save_map();
            });
            $(document).on("click","#btn_upload", function(){
                upload_bg();
            });
            /*
            $(document).on("dblclick",".shape", function(){
                open_SeatInfo();
            });
            */

            @if( $bg_url )
            //$("#room_bg").css({"background": "url({{ $bg_url }})"});            
            @endif
            
			load_view_map(mode, room);

        });

    </script>

@endsection


