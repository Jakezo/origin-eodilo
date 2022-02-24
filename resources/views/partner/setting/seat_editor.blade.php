<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.manager_onlypage')

@section('title', 'Page Title')

@section('content')
    <!--start page wrapper -->
    <div class="wrapper">
        <div class="content p-2">

            <!--end breadcrumb-->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="room" id="room" onchange="window.location='{{ $PHP_SELF ?? "" }}?no={{ $_GET['idx'] ?? "" }}&room='+this.value">
                                            <option value=''>룸선택</option>
                                            <?php foreach( $rooms as $ri => $room ){?>
                                                <option value='{{ $room->r_no }}' <?if( $no == $room->r_no ) {?> selected<?}?>>{{ $room->r_name }}</option>
                                            <?php  }?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#seatFormModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="card">
                                <div class="card-body">
                                    <div id="page">

                                        <link rel="stylesheet" href="/assets/plugins/seat_editor/css/jlayout.css">
                                        <input type="hidden" name="no" id="no" value="{{ $no ?? "" }}?>">
                                        <div id="room_bg" class="col-sm-8" style="width:100%;height:600px;border:1px solid #cbc7c7;">

                                        </div>
                                        <div class="guide_txt" style="display:none;">좌석을 추가하시려면 좌석관리에서 등록해주셔야 합니다.</div>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card">
                                <div class="card-body">

                                    <form class="row g-3">

                                        <div class="col-12" id="save_pannel">
                                            <button id="btn_save" type="button" class="btn btn-danger col-12">편집을 저장</button>
                                        </div>
                                    </form>                                    
                            
                                    <div id="create_pannel">
                                        <div class="head">종류</div>
                                        <div class="body">
                                            <div><button onclick="add_shape('table');">개인좌석 -> 이기능삭제</button></div>
                                            {{-- <div><button onclick="add_shape('table2');">회의실</button></div>
                                            <div><button onclick="add_shape('wall');">벽</button></div>
                                            <div>
                                                <button onclick="add_shape('pillar1');">둥근기둥</button>
                                                <button onclick="add_shape('pillar2');">사각기둥</button>
                                            </div> --}}
                                        </div>
                                    </div>
                            
                                    <div id="edit_pannel">
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

                                        {{-- <div class="head">재작성</div>
                                        <div class="body">
                                            <div><button onclick="set_shape();">다시그리기</button></div>
                                            <div><button onclick="delete_shape();">선택삭제</button> <button onclick="delete_shape_all();">모두삭제</button></div>
                                            <div><button onclick="scale_bg(700);">전체 축소</button></div>
                                            <div><button onclick="set_fix();">이동방지</button></div>
                                        </div>
                                        --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    

                </div>
            </div>
            <!--end row-->
        </div>
    </div>

    <!--end page wrapper -->
@endsection


@section('javascript')

<script src="/assets/js/jquery-ui.min.js"></script>
<script src="/assets/css/jquery-ui.min.css"></script>
<script src="/assets/plugins/seat_editor/js/jquery.resize.js"></script>
<script src="/assets/plugins/seat_editor/js/jlayout.js"></script>
<script src="/assets/plugins/seat_editor/js/jlayoutEditor.js"></script>
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

            $('#seatFormModal').on('show.bs.modal', function (e) {

            });

        });


        // function seat_update() {
        //     var req = $("#frm_seatInfo").serialize();
        //     alert(req)
        //     $.ajax({
        //         url: '/setting/seat/update',
        //         type: 'POST',
        //         async: true,
        //         beforeSend: function (xhr) {
        //             $("#seatDetail_msg").html("");
        //         },
        //         data: req,
        //         success: function (res, textStatus, xhr) {

        //             console.log(res);

        //             if (res.result == true) {
        //                 document.location.reload();
        //             } else {
        //                 $("#seatDetail_msg").html(xhr.message);
        //             }
        //         },
        //         error: function (xhr, textStatus, errorThrown) {
        //             $("#seatDetail_msg").html(xhr.responseJSON.message);
        //         }
        //     });
        // }

        // function seat_delete() {
        //     var req = $("#frm_seat").serialize();
        //     console.log(req);
        //     $.ajax({
        //         url: '/setting/seat_level/delete',
        //         type: 'POST',
        //         async: true,
        //         beforeSend: function (xhr) {
        //             $("#seatDetail_msg").html("");
        //         },
        //         data: req,
        //         success: function (res, textStatus, xhr) {
        //             if (res.result == true) {
        //                 document.location.reload();
        //             } else {
        //                 $("#seatDetail_msg").html(res.message);
        //                 console.log("실패.");
        //             }
        //         },
        //         error: function (xhr, textStatus, errorThrown) {
        //             console.log('PUT error.');
        //         }
        //     });
        // }

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
                        $("#no").val(res.seat.no);
                        //$("#aid").val(res.seat.id).attr("readonly", true);
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

        function get_rooms() {
            var req = "";
            $.ajax({
                url: '/partner_api/room/get_list',
                type: 'GET',
                async: true,
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.result == true) {
                        $('#room option').remove();
                        res.rooms.forEach(function(room) {
                            var option = $('<option value="'+room.r_no+'">'+room.r_name+'</option>');
                            $('#room').append(option);
                        });
                    } else {
                        var option = $('<option value="">룸정보가 존재하지 않습니다</option>');
                        $('#room').append(option);
                    }
                },
            });
        }

        function get_seatLevels() {
            var req = "";
            $.ajax({
                url: '/partner_api/seat_level/get_list',
                type: 'GET',
                async: true,
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.result == true) {
                        $('#level option').remove();
                        res.seatlevels.forEach(function(sl) {
                            var option = $('<option value="'+sl.sl_no+'">'+sl.sl_name+'</option>');
                            $('#level').append(option);
                        });
                    } else {
                        var option = $('<option value="">등급정보가 존재하지 않습니다</option>');
                        $('#level').append(option);
                    }
                },
            });
        }

        //get_rooms();
        //get_seatLevels();
    </script>
    <script>

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
            let idx = $("#idx").val();
            let seats = new Array();
            let roomBG_src = $("#room_bg").attr("src");
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

            let map_data_string = JSON.stringify(map_data);
            let data = "mode=save&idx=" + idx + "&room=" + room + "&map_data=" + map_data_string;

            $.ajax({
                type: 'POST',
                async: false,
                url: '/setting/seat/editor/update',
                data: data,
                success: function(res) {
                    console.log(res);
                    if( res.result == true ) {
                        document.location.reload()
                    } else {
                        console.log(res.msg);
                    }
                },
                error:function(e){
                    console.log("error:"+e);
                    if(e.status==300){
                        alert("데이터를 저장하는 실패하였습니다.");
                    }
                }
            });

        }

        $(document).ready(function(){

            /* 저장 */
            $(document).on("click","#btn_save", function(){
                save_map();
            });

            $(document).on("dblclick",".shape", function(){
                open_SeatInfo();
            });

            <?php if( $bg_url ) { ?>
            // 이거 없어도 될듯.. set_bg('<?=$bg_url?>','<?=$bg_width?>','<?=$bg_height?>');
            <?}?>

            <?php //if( $no ) { ?>
                setting_map({{ $no ?? 0 }}, "edit" );
            <?//}?>
        });

    </script>

@endsection


