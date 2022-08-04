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
                <div class="breadcrumb-title pe-3">장치명/좌석관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">장치명설정</li>
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

                                    </div>
                                    <div class="col-md-8 col-sm-4 col-xs-12 mt-1">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#iotFormModal">신규</a>
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
                                        <th scope="col" class=" text-center">장치명</th>
                                        <th scope="col" class=" text-center">구분</th>
                                        <th scope="col" class=" text-center">업무마감시</th>
                                        <th scope="col" class=" text-center">성별</th>
                                        <th scope="col" class=" text-center">장치명상태</th>
                                        <th scope="col" class=" text-center">관리</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( $iots )
                                    @foreach( $iots as $ri => $iot )
                                    <tr>
                                        <th scope="row" class=" text-center">1</th>
                                        <td class=" text-center">{{ $iot['i_name'] ?? '' }}</td>
                                        <td class=" text-center">

                                            @if($iot['i_type'] == "D")
                                                    출입문
                                            @elseif($iot['i_type'] == "S")
                                                    기타
                                            @endif
                                        </td>
                                        <td class=" text-center">

                                            @if($iot['i_endwork'] == "Y")
                                                    OFF
                                            @endif
                                        </td>
                                        <td class=" text-center">

                                            @if($iot['i_sex'] == "M")
                                                    남자
                                            @elseif($iot['i_sex'] == "F")
                                                    여자
                                            @else
                                                    모두
                                            @endif
                                        </td>
                                        <td class=" text-center">{{ $iot['i_status'] ?? '' }}</td>
                                        <td class="col-2 text-center">
                                                <button class="btn btn-xs btn-secondary m-1 iot_item" iot="{{ $iot->i_no ?? 0 }}" data-bs-toggle="modal" data-bs-target="#iotFormModal">관리</button>
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


                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="iotFormModal" tabindex="-3" aria-labelledby="iotFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iotFormModalLabel">장치추가</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="iotInfo" role="tabpanel">
                            <form class="form-horizontal  g-3" role="form" name="frm_iotInfo" id="frm_iotInfo">
                            {{csrf_field()}}
                            <input type="hidden" name="no" id="no" value="">

                                <div class="col-12 mt-3">
                                    <label for="name" class="form-label col-12">구분</label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="typeD" value="D">
                                        <label class="form-check-label" for="typeD">현관출입문</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="typeZ" value="Z">
                                        <label class="form-check-label" for="typeS">기타</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="name" class="form-label col-12">구분</label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="endwork" id="endwork" value="Y">
                                        <label class="form-check-label" for="stateM">업무종료시OFF</label>
                                    </div>
                                </div>



                                <div class="col-md-12 mt-3">
                                    <label for="name" class="form-label col-3">이름</label>
                                    <div class="input-group col-9"> 
                                        <input type="text" class="form-control" name="name" id="name" placeholder="장치명">
                                    </div>
                                </div>

                                <div class="col-12 mt-3">

                                    <label for="sexA" class="form-label col-12">성별구분</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="sexA" value="A">
                                        <label class="form-check-label" for="sexA">무관</label>
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

                                <div class="col-xs-12 mt-3" id="iotDetail_msg">

                                </div>

                                <div class="col-12 text-center">
                                    <button type="button" id="btn_iot_update" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 장치을 삭제 <button type="button" id="btn_iot_delete" class="btn btn-xs btn-secondary">삭제</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="iotMap" role="tabpanel">

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
            $(document).on("click", ".iot_item", function () {
                var i_no = $(this).attr("iot");
                iot_getInfo(i_no);
            });
            $(document).on("click", "#btn_iot_update", function () {
                iot_update();
            });
            $(document).on("click", "#btn_iot_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    iot_delete();
                }
            });
            $('#iotFormModal').on('show.bs.modal', function (e) {
                //iot_getInfo();
            });

        });

        function iot_update() {
            var req = $("#frm_iotInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/iot/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#iotDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#iotDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#iotDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function iot_delete() {
            var req = $("#frm_iotInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/iot/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#iotDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#iotDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function iot_getInfo(no) {
            var req = "no=" + no;
            console.log(req);

            $.ajax({
                url: '/setting/iot/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#iotDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);
                    if (res.iot != null) {
                        $("#no").val(res.iot.no);
                        //$("#aid").val(res.iot.id).attr("readonly", true);
                        $("#name").val(res.iot.name);
                        $("#seat_count").val(res.iot.seat_count);
                        $("#type").val(res.iot.type);
                        if( res.iot.state_mobile == 'Y' ) $("#state_mobile").prop("checked",true);
                        else $("#state_mobile").prop("checked",false);
                        if( res.iot.state_kiosk == 'Y' ) $("#state_kiosk").prop("checked",true);
                        else $("#state_kiosk").prop("checked",false);

                        $("#sex"+res.iot.sex).prop("checked","checked");
                        $("#type"+res.iot.type).prop("checked","checked");
                        $("#iot1").val(res.iot.iot1);
                        $("#iot2").val(res.iot.iot2);
                        $("#iot3").val(res.iot.iot3);
                        $("#iot4").val(res.iot.iot4);
                        if( res.iot.endwork == 'Y' ) $("#endwork").prop("checked",true);
                        else $("#endwork").prop("checked",false);

                    } else {
                        $("#iotDetail_msg").html(res.message);
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

