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
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">룸설정</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger btn_manual" rel="6"><i class="lni lni-youtube"></i>도움말</button>
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
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name">독서실+스터디룸</option>
                                            <option value="p_name">독서실</option>
                                            <option value="p_emp_name">스터디룸</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 col-sm-4 col-xs-12 mt-1">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#roomFormModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class=" text-center">#</th>
                                        <th scope="col" class=" text-center">구분</th>
                                        <th scope="col" class=" text-center">성별</th>
                                        <th scope="col" class=" text-center">룸명</th>
                                        <th scope="col" class=" text-center">좌석수</th>
                                        <th scope="col" class=" text-center">룸상태</th>
                                        <th scope="col" class=" text-center">관리</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( $rooms )
                                    @foreach( $rooms as $ri => $room )
                                    <tr>
                                        <th scope="row" class=" text-center">1</th>
                                        <td class=" text-center">

                                            @if($room['r_type'] == "D")
                                                    일반
                                            @elseif($room['r_type'] == "S")
                                                    스터디룸
                                            @endif
                                        </td>
                                        <td class=" text-center">

                                            @if($room['r_sex'] == "M")
                                                    남자
                                            @elseif($room['r_sex'] == "F")
                                                    여자
                                            @else
                                                    모두
                                            @endif
                                        </td>
                                        <td class=" text-center">{{ $room['r_name'] ?? '' }}</td>
                                        <td class=" text-center">{{ $room->r_seat_count ?? 0 }}</td>
                                        <td class=" text-center">

                                            @if($room['r_state_mobile'] == "Y")
                                            <button class="btn btn-xs btn-primary">모바일</button>
                                            @endif

                                            @if($room['r_state_kiosk'] == "Y")
                                            <button class="btn btn-xs btn-primary">키오스크</button>
                                            @endif


                                        </td>
                                        <td class="col-2 text-center">
                                                <button class="btn btn-xs btn-secondary m-1 room_item" room="{{ $room->r_no ?? 0 }}" data-bs-toggle="modal" data-bs-target="#roomFormModal">관리</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        <div class="card-body d-flex justify-content-center">
                            {{ $rooms->appends($param)->links() }}
                        </div>

                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="roomFormModal" tabindex="-3" aria-labelledby="roomFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomFormModalLabel">룸추가</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#roomInfo" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">기본정보</div>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#roomMap" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">배치도</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="roomInfo" role="tabpanel">
                            <form class="form-horizontal  g-3" role="form" name="frm_roomInfo" id="frm_roomInfo">
                            {{csrf_field()}}
                            <input type="hidden" name="no" id="no" value="">

                                <div class="col-12 mt-3">
                                    <label for="name" class="form-label col-12">구분</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="typeD" value="D">
                                        <label class="form-check-label" for="typeD">독서실</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="typeS" value="S">
                                        <label class="form-check-label" for="typeS">스터디룸</label>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="name" class="form-label col-3">이름</label>
                                    <div class="input-group col-9"> 
                                        <input type="text" class="form-control" name="name" id="name" placeholder="룸명">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="seat_count" class="form-label">좌석수</label>
                                    <div class="input-group"> 
                                        <input type="number" class="form-control" id="seat_count" name="seat_count" placeholder="좌석수">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="state_mobile" class="form-label col-12">구분</label>                                   
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="state_mobile" id="state_mobile" value="Y">
                                        <label class="form-check-label" for="stateM">모바일</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="state_kiosk" id="state_kiosk" value="Y">
                                        <label class="form-check-label" for="stateK">키오스크</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">

                                    <label for="sexA" class="form-label col-12">성별구분</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="sexA" value="A">
                                        <label class="form-check-label" for="sexA">모두</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="sexM" value="M">
                                        <label class="form-check-label" for="sexM">남성</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="sexF" value="F">
                                        <label class="form-check-label" for="sexF">여성</label>
                                    </div>

                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="iot" class="form-label">IOT번호</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx">IOT 1</i></span>
                                        <input type="text" class="form-control border-start-0" id="iot1" name="iot1" placeholder="IOT port">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx">IOT 2</i></span>
                                        <input type="text" class="form-control border-start-0" id="iot2" name="iot2" placeholder="IOT port">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx">IOT 3</i></span>
                                        <input type="text" class="form-control border-start-0" id="iot3" name="iot3" placeholder="IOT port">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx">IOT 4</i></span>
                                        <input type="text" class="form-control border-start-0" id="iot4" name="iot4" placeholder="IOT port">
                                    </div>
                                </div>

                                <div class="col-xs-12 mt-3" id="roomDetail_msg">

                                </div>

                                <div class="col-12 text-center">
                                    <button type="button" id="btn_room_update" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 룸을 삭제 <button type="button" id="btn_room_delete" class="btn btn-xs btn-secondary">삭제</button>
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
            $(document).on("click", ".room_item", function () {
                var r_no = $(this).attr("room");
                room_getInfo(r_no);
            });
            $(document).on("click", "#btn_room_update", function () {
                room_update();
            });
            $(document).on("click", "#btn_room_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    room_delete();
                }
            });
            $('#roomFormModal').on('show.bs.modal', function (e) {
                //room_getInfo();
            });

        });

        function room_update() {
            var req = $("#frm_roomInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/room/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#roomDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#roomDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#roomDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function room_delete() {
            var req = $("#frm_roomInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/room/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#roomDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#roomDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function room_getInfo(no) {
            var req = "no=" + no;
            console.log(req);

            $.ajax({
                url: '/setting/room/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#roomDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);
                    if (res.room != null) {
                        $("#no").val(res.room.no);
                        //$("#aid").val(res.room.id).attr("readonly", true);
                        $("#name").val(res.room.name);
                        $("#seat_count").val(res.room.seat_count);
                        $("#type").val(res.room.type);
                        if( res.room.state_mobile == 'Y' ) $("#state_mobile").prop("checked",true);
                        if( res.room.state_kiosk == 'Y' ) $("#state_kiosk").prop("checked",true);
                        $("#sex"+res.room.sex).prop("checked","checked");
                        $("#type"+res.room.type).prop("checked","checked");
                        $("#iot1").val(res.room.iot1);
                        $("#iot2").val(res.room.iot2);
                        $("#iot3").val(res.room.iot3);
                        $("#iot4").val(res.room.iot4);

                    } else {
                        $("#roomDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }
    </script>


@endsection

