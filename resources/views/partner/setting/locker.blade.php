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
                <div class="breadcrumb-title pe-3">사물함관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">사물함관리</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger btn_manual" rel="8"><i class="lni lni-youtube"></i>도움말</button>
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
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>M01</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>M02</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>W01</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>W02</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
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
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#lockerFormModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">구역</th>
                                    <th scope="col">사물함명</th>
                                    <th scope="col">IOT</th>
                                    <th scope="col">공개여부</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $lockers )
                                @foreach( $lockers as $si => $locker )
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>{{ (count($lockers)-$si) }}</th>
                                    <td>{{ $locker->la_name ?? '' }}</td>
                                    <td>{{ $locker->l_name ?? '' }}</td>
                                    <td>@if( trim($locker->l_iot1) ) {{ $locker->l_iot1  }} @endif / @if( trim($locker->l_iot2) ) {{ $locker->l_iot2  }} @endif</td>                                    
                                    <td>
                                        @if($locker['l_open_mobile'] == "Y")
                                        <button class="btn btn-xs btn-primary">모바일</button>
                                        @endif

                                        @if($locker['l_open_kiosk'] == "Y")
                                        <button class="btn btn-xs btn-primary">키오스크</button>
                                        @endif
                                    </td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="lockerFormModal" tabindex="-3" aria-labelledby="lockerFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lockerFormModalLabel">사물함정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" role="tabpanel">

                            <form action="" class="form-horizontal" role="form" name="frm_lockerInfo" id="frm_lockerInfo">
                                {{csrf_field()}}
                                <input type="hidden" name="step" id="step" value="">
                                <input type="hidden" name="no" id="no" value="">


                                <div class="col-md-12">
                                    <label for="name" class="form-label">사물함번호</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="사물함번호">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="name" class="form-label">구역</label>
                                    <div class="input-group">
                                        <select name="area" id="area" class="form-control form-select-sm col-12">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 row">
                                    <label for="inputLastName2" class="form-label">IOT세팅</label>

                                    <div class="col-3">
                                        <input type="text" class="form-control form-select-sm col-3" name="iot1" id="iot1" placeholder="">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control form-select-sm col-3" name="iot2" id="iot2" placeholder="">
                                    </div>

                                </div>


                                <div class="col-12">
                                    공개
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="open_mobile" id="open_mobile" value="Y">
                                        <label class="form-check-label" for="stateM">모바일</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="open_kiosk" id="open_kiosk" value="Y">
                                        <label class="form-check-label" for="stateK">키오스크</label>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="button" id="btn_locker_update" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 사물함을 삭제 <button type="button" class="btn btn-xs btn-secondary">삭제</button>
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

            $(document).on("click", ".locker_item", function () {
                var r_no = $(this).attr("locker");
                locker_getInfo(r_no);
                console.log(r_no);
            });
            $(document).on("click", "#btn_locker_update", function () {
                locker_update();
            });
            $(document).on("click", "#btn_locker_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    locker_delete();
                }
            });

            $('#lockerFormModal').on('show.bs.modal', function (e) {

            });

        });


        function locker_update() {
            var req = $("#frm_lockerInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/locker/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#lockerDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#lockerDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#lockerDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function locker_delete() {
            var req = $("#frm_locker").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/locker_level/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#lockerDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#lockerDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function locker_getInfo(no) {
            var req = "no=" + no;
            console.log(req)
            $.ajax({
                url: '/setting/locker_level/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#lockerDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.locker != null) {
                        $("#no").val(res.locker.no);
                        //$("#aid").val(res.locker.id).attr("readonly", true);
                        $("#name").val(res.locker.name);
                        $("#type"+res.locker.type).prop("checked","checked");
                        $("#state").val(res.locker.state);
                        $("#sex").val(res.locker.sex);
                    } else {
                        $("#lockerDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function get_lockerArea() {
            var req = "";
            $.ajax({
                url: '/partner_api/locker_area/get_list',
                type: 'GET',
                async: true,
                data: req,
                success: function (res, textStatus, xhr){ 
                    console.log(1);
                    console.log(res);
                    console.log(2);
                    if (res.result == true) {
                        $('#area option').remove();
                        res.locker_area.forEach(function(la) {
                            var option = $('<option value="'+la.la_no+'">'+la.la_name+'</option>');
                            $('#area').append(option);
                        });
                    } else {
                        var option = $('<option value="">등급정보가 존재하지 않습니다</option>');
                        $('#area').append(option);
                    }
                },
            });
        }


        get_lockerArea();
    </script>


@endsection


