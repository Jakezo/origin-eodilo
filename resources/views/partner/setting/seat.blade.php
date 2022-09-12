<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.manager')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <!--p>This is appended to the master sidebar.</p-->
@endsection

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">룸/좌석관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">좌석관리</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger btn_manual" rel="7"><i class="lni lni-youtube"></i>도움말</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>룸전체</option>
                                            @if( $rooms )
                                            @foreach( $rooms as $si => $room )
                                            <option value="{{ $room->r_no }}" <?php if( isset($no) && $no == $room->r_no ) {?> selected<?}?>>{{ $room->r_name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="lv" id="lv">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>등급전체</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>A등급</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>B등급</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>C등급</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#seatFormModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <form id="frm_seatlist" name="frm_seatlist">
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건  <a href="/setting/map/editor" target="_blank" class="btn btn-warning px-2 btn-sm">배치도편집</a></div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="s_all" id="s_all" value="Y" >

                                        </div>
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">룸</th>
                                    <th scope="col">좌석명</th>
                                    <th scope="col">좌석등급/성별/연령</th>
                                    <th scope="col">IOT</th>
                                    <th scope="col">공개여부</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $seats )
                                @foreach( $seats as $si => $seat )
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="s_arr[]" value="{{ $seat->s_no ?? '' }}">
                                        </div>
                                    </th>
                                    <th>{{ (count($seats)-$si) }}</th>
                                    <td>{{ $seat->r_name ?? '' }}</td>
                                    <td>@if( trim($seat->s_name) ) {{ $seat->s_name  }} @else - @endif</td>
                                    <td>@if( trim($seat->sl_name) ) {{ $seat->sl_name  }} @else - @endif  / {{ $seat->s_sex }} / {{ $seat->s_age }} </td>
                                    <td>@if( trim($seat->s_iot1) ) {{ $seat->s_iot1  }} @endif / @if( trim($seat->s_iot2) ) {{ $seat->s_iot2  }} @endif</td>
                                    <td>
                                        @if($seat['s_open_mobile'] == "Y")
                                        <button class="btn btn-xs btn-primary">모바일</button>
                                        @else
                                            <button class="btn btn-xs btn-secondary">모바일</button>
                                        @endif

                                        @if($seat['s_open_kiosk'] == "Y")
                                        <button class="btn btn-xs btn-primary">키오스크</button>
                                        @else
                                            <button class="btn btn-xs btn-secondary">키오스크</button>
                                        @endif
                                    </td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs seat_item" seat="{{ $seat->s_no ?? '' }}">관리</a></td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <div class='row'>
                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <input class="form-check-input" type="checkbox" checked="checked" readonly> 선택 좌석을
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <select class="single-select form-control-sm col-12" name="change_room" id="change_room">
                                        <option value="">룸전체</option>
                                        @if( $rooms )
                                        @foreach( $rooms as $si => $room )
                                        <option value="{{ $room->r_no }}" <?php if( isset($no) && $no == $room->r_no ) {?> selected<?}?>>{{ $room->r_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <select class="single-select form-control-sm col-12" name="change_lv" id="change_lv">

                                    </select>
                                </div>

                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <select class="single-select form-control-sm col-12" name="change_st" id="change_st">
                                        <option value="">사용여부변경</option>
                                        <option value="Y">사용</option>
                                        <option value="N">미사용</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <button type="button" id="btn_change_seatlevel" class="btn btn-secondary px-2 btn-sm col-12">변경</button>
                                </div>
                            </div>

                        </div>
                        </form>
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="seatFormModal" tabindex="-3" aria-labelledby="seatFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seatFormModalLabel">좌석정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" role="tabpanel">

                            <form action="" class="form-horizontal" role="form" name="frm_seatInfo" id="frm_seatInfo">
                                {{csrf_field()}}
                                <input type="hidden" name="step" id="step" value="">
                                <input type="hidden" name="no" id="no" value="">


                                <div class="col-md-12">
                                    <label for="name" class="form-label">좌석번호</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="좌석번호">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="name" class="form-label">룸</label>
                                    <div class="input-group">
                                        <select name="room" id="room" class="form-control form-select-sm col-12">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="name" class="form-label">등급</label>
                                    <div class="input-group">
                                        <select name="level" id="level" class="form-control form-select-sm col-12">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 row">
                                    <label for="inputLastName2" class="form-label">IOT세팅</label>

                                    <div class="col-3">
                                        <input type="text" class="form-control col-3" name="iot1" id="iot1" placeholder="">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control col-3" name="iot2" id="iot2" placeholder="">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control col-3" name="iot3" id="iot3" placeholder="">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control col-3" name="iot4" id="iot4" placeholder="">
                                    </div>

                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="name" class="form-label">추가 IOT</label>
                                </div>
                                <div class="col-12 mt-0">
                                    @if( $iots )
                                    @foreach( $iots as $ii => $iot )
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input iot_ext" type="checkbox" name="iot_ext[]" id="iot_ext_{{ $iot['no'] }}" value="{{ $iot['no'] }}">
                                        <label class="form-check-label" for="iot_ext_{{ $iot['no'] }}">{{ $iot['name'] }}</label>
                                    </div>

                                    @endforeach
                                    @endif                                    

                                </div>                                

                                <div class="col-md-12 row">


                                    <div class="col-6">


                                        <div class="col-md-12 mt-3">
                                            <label for="state" class="form-label">사용여부</label>
                                        </div>
                                        <div class="col-12 mt-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="state" id="stateY" value="Y">
                                                <label class="form-check-label" for="stateY">사용</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="state" id="stateN" value="N">
                                                <label class="form-check-label" for="stateN">미사용</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-md-12 mt-3">
                                            <label for="name" class="form-label">공개여부</label>
                                        </div>
                                        <div class="col-12 mt-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="open_mobile" id="open_mobile" value="Y">
                                                <label class="form-check-label" for="stateM">모바일</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="open_kiosk" id="open_kiosk" value="Y">
                                                <label class="form-check-label" for="stateK">키오스크</label>
                                            </div>
                                        </div> 
                                    </div>


                                </div>                                


                                <div class="col-md-12 row">


                                    <div class="col-6">
                                        <label for="age" class="form-label">성별</label>
                                        <div class="input-group">
                                            <select name="sex" id="sex" class="form-control form-select-sm col-12">
                                                <option value="A">무관</option>
                                                <option value="M">남자</option>
                                                <option value="F">여자</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="sex" class="form-label">연령</label>
                                        <div class="input-group">
                                            <select name="age" id="age" class="form-control form-select-sm col-12">
                                                <option value="">모두</option>
                                                <option value="A">성인</option>
                                                <option value="S">학생</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>                                



                                <div class="col-12 text-center">
                                    <button type="button" id="btn_seat_update" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 좌석을 삭제 <button type="button" class="btn btn-xs btn-secondary">삭제</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="roomMap" role="tabpanel">

                        </div>
                        <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">입실</th>
                                    <th scope="col">퇴실</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#memberRegModal">예약</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#memberRegModal">사용중</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">종료</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">종료</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!--end page wrapper -->
@endsection


@section('javascript')

    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // 좌석 선택
            $(document).on("click", ".seat_item", function () {
                var r_no = $(this).attr("seat");
                console.log("선택좌석: "+r_no);
                seat_getInfo(r_no);
                $("#seatFormModal").modal("show");
            });

            // 정보수정
            $(document).on("click", "#btn_seat_update", function () {
                seat_update();
            });

            // 삭제
            $(document).on("click", "#btn_seat_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    seat_delete();
                }
            });

            // 모두선택
            $("#s_all").on("click",function(){
                $("input[type='checkbox'][name^='s_arr']").prop("checked", $(this).prop("checked") );
            });

            // 등급변경
            $(document).on("click", "#btn_change_seatlevel", function () {
                if (confirm("등급을 변경하시겠습니까?") == true) {
                    seat_changeLevel();
                }
            });

            $(document).on("click", "#s_all", function () {
                $("#s_all").on("click",function(){
                    var ck = $(this).prop("checked");
                    if( ck != true ) ck = false;
                    console.log(ck);
                    $("input[type='checkbox'][name^='s_arr']").prop("checked", ck );
                });
            });            

        });
        
        function seat_changeLevel() {
            var req = $("#frm_seatlist").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/seat/changeLevel',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#seatDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#seatDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }
        function seat_update() {
            var req = $("#frm_seatInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/seat/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#seatDetail_msg").html(xhr.message);
                    }
                },
                error: function(xhr, status, msg){
                    console.log(xhr);
                    console.log(xhr.responseJSON.file);
                    console.log(xhr.responseJSON.line);
                    console.log(xhr.responseJSON.message);
                }
            });
        }

        function seat_delete() {
            var req = $("#frm_seat").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/seat_level/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#seatDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function(xhr, status, msg){
                    console.log(xhr);
                    console.log(xhr.responseJSON.file);
                    console.log(xhr.responseJSON.line);
                    console.log(xhr.responseJSON.message);
                }
            });
        }

        function seat_getInfo(no) {
            var req = "no=" + no;
            console.log(req)
            $.ajax({
                url: '/setting/seat/getInfo',
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
                        $("#level").val(res.seat.level);
                        $("#room").val(res.seat.room);
                        if( res.seat.open_mobile == "Y") {
                            $("#open_mobile").prop("checked","checked");
                        } else {
                            $("#open_mobile").prop("checked","");
                        }
                        if( res.seat.open_kiosk == "Y") {
                            $("#open_kiosk").prop("checked","checked");
                        } else {
                            $("#open_kiosk").prop("checked","");
                        }
                        if( res.seat.state == "Y") {
                            $("#stateY").prop("checked","checked");
                        } else {
                            $("#stateN").prop("checked","");
                        }
                        $("#type"+res.seat.type).prop("checked","checked");
                        $("#iot1").val(res.seat.iot1);
                        $("#iot2").val(res.seat.iot2);
                        $("#iot3").val(res.seat.iot3);
                        $("#iot4").val(res.seat.iot4);
                        $("#sex").val(res.seat.sex);
                        $("#age").val(res.seat.age);

                        var iot_ext_arr = res.seat.iot_ext.split(",");
                        console.log(iot_ext_arr);
                        $(".iot_ext").prop("checked", false);
                        for( i=0;i<=iot_ext_arr.length-1;i++){
                            $(".iot_ext[id='iot_ext_"+iot_ext_arr[i]+"']").prop("checked", true);
                        }

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
                        
                        var option = $('<option value="'+room.r_no+'">룸선택</option>');
                        $('#room').append(option);

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


                        $('#level').append('<option value="">등급선택</option>');   
                        for (var key in res.seatlevels) { 
                            console.log(key, res.seatlevels[key]); 
                            var option = $('<option value="'+res.seatlevels[key].sl_no+'">'+res.seatlevels[key].sl_name+'</option>');
                            $('#level').append(option);
                        }

                        // 검색창에도 변경
                        $('#lv option').remove();
                        $('#lv').append('<option value="">등급선택</option>');                        
                        for (var key in res.seatlevels) { 
                            var option = $('<option value="'+res.seatlevels[key].sl_no+'">'+res.seatlevels[key].sl_name+'</option>');
                            $('#lv').append(option);
                        }
                        
                        // 변경창에도 변경
                        $('#change_lv option').remove();
                        $('#change_lv').append('<option value="">등급변경</option>');                        
                        for (var key in res.seatlevels) { 
                            var option = $('<option value="'+res.seatlevels[key].sl_no+'">'+res.seatlevels[key].sl_name+'</option>');
                            $('#change_lv').append(option);
                        }



                    } else {
                        var option = $('<option value="">등급정보가 존재하지 않습니다</option>');
                        $('#level').append(option);
                    }
                },
            });
        }

        get_rooms();
        get_seatLevels();
    </script>


@endsection


