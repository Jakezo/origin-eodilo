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
                            <li class="breadcrumb-item active" aria-current="page">사물함 구역관리</li>
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
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>1층 복도</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>2층 복도</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>A룸</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 col-sm-4 col-xs-12 mt-1">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#lockerAreaFormModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class=" text-center">구역명</th>
                                    <th scope="col" class=" text-center">사물함갯수</th>
                                    <th scope="col" class=" text-center">사용중</th>
                                    <th scope="col" class=" text-center">미사용</th>
                                    <th scope="col" class=" text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $locker_areas )
                                @foreach( $locker_areas as $li => $locker_area )                                    
                                <tr>
                                    <th scope="row">{{ (count($locker_areas)-$li) }}</th>
                                    <td class=" text-center">{{ $locker_area['la_name'] ?? '' }}</td>
                                    <td class=" text-center">{{ $locker_area['la_locker_count'] ?? 0 }}</td>
                                    <td class=" text-center">{{ $locker_area['la_state'] ?? '' }}</td>
                                    <td class=" text-center">
                                        @if($locker_area['la_locker_open_mobile'] == "Y")
                                        <button class="btn btn-xs btn-primary">모바일</button>
                                        @endif

                                        @if($locker_area['la_locker_open_kiosk'] == "Y")
                                        <button class="btn btn-xs btn-primary">키오스크</button>
                                        @endif
                                    </td>
                                    <td class=" text-center"><button type="button" class="btn btn-xs btn-primary locker_area_item" locker_area="{{ $locker_area['la_no'] ?? 0 }}" data-bs-toggle="modal" data-bs-target="#lockerAreaFormModal">수정</button></td>
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
                            {{ $locker_areas->appends($param)->links() }}
                        </div>                        

                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>

    <div class="modal fade" id="lockerAreaFormModal" tabindex="-3" aria-labelledby="lokerAreaFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lokerAreaFormModalLabel">사물함구역추가</h5>
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

                            <form class="form-horizontal  g-3" role="form" name="frm_lockerAreaInfo" id="frm_lockerAreaInfo">
                                {{csrf_field()}}
                                <input type="hidden" name="no" id="no" value="">
                                <div class="col-md-12 mt-3">
                                    <label for="name" class="form-label">구역명</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0" id="name" name="name" placeholder="구역명">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="locker_count" class="form-label">사물함수</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0" id="locker_count" name="locker_count" placeholder="사물함수">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="open_mobile" id="open_mobile" value="Y">
                                        <label class="form-check-label" for="openM">모바일</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="open_kiosk" id="open_kiosk" value="Y">
                                        <label class="form-check-label" for="openK">키오스크</label>
                                    </div>
                                </div>                                

                                <div class="col-12 mt-3">

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

                                <div class="col-12 text-center">
                                    <button type="button" id="btn_locker_area_update" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 영역을 삭제 <button type="button" id="btn_locker_area_delete" class="btn btn-xs btn-secondary">삭제</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="lockerAreaDetail_msg" role="tabpanel">

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
            $(document).on("click", ".locker_area_item", function () {
                var la_no = $(this).attr("locker_area");
                locker_area_getInfo(la_no);
            });
            $(document).on("click", "#btn_locker_area_update", function () {
                locker_area_update();
            });
            $(document).on("click", "#btn_locker_area_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    locker_area_delete();
                }
            });
            $('#lockerAreaFormModal').on('show.bs.modal', function (e) {
                //room_getInfo();
            });

        });

        function locker_area_update() {
            var req = $("#frm_lockerAreaInfo").serialize();
            console.log(req);

            $.ajax({
                url: '/setting/locker_area/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#lockerAreaDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#lockerAreaDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#lockerAreaDetail_msg").html(xhr.responseJSON.message);
                }
            });

        }

        function locker_area_delete() {
            var req = $("#frm_lockerAreaInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/locker_area/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#lockerAreaDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#lockerAreaDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function locker_area_getInfo(no) {
            var req = "no=" + no;
            console.log(req)

            $.ajax({
                url: '/setting/locker_area/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#lockerAreaDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res.locker_area);
                    if (res.locker_area != null) {
                        $("#no").val(res.locker_area.no);
                        //$("#aid").val(res.room.id).attr("readonly", true);
                        $("#name").val(res.locker_area.name);
                        $("#locker_count").val(res.locker_area.locker_count);
                        if( res.locker_area.open_mobile == 'Y' ) $("#open_mobile").prop("checked",true);
                        if( res.locker_area.open_kiosk == 'Y' ) $("#open_kiosk").prop("checked",true);
                        //$("#sex"+res.locker_area.sex).prop("checked","checked");
    
                    } else {
                        $("#lockerAreaDetail_msg").html(res.message);
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

