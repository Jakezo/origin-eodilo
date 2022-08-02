<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

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
                <div class="breadcrumb-title pe-3">이벤트관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">가맹점 이벤트 목록</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col">

                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="?menu={{$menu ?? ''}}">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="state" id="state">
                                            <option value="" <?php if( isset($param['state']) && $param['state'] == "" ) {?> selected<?}?>>전체</option>
                                            <option value="A" <?php if( isset($param['state']) && $param['state'] == "A" ) {?> selected<?}?>>예정</option>
                                            <option value="I" <?php if( isset($param['state']) && $param['state'] == "I" ) {?> selected<?}?>>진행</option>
                                            <option value="E" <?php if( isset($param['state']) && $param['state'] == "E" ) {?> selected<?}?>>종료</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="" <?php if( !isset($param['fd']) && $param['fd'] == "" ) {?> selected<?}?>>제목+내용</option>
                                            <option value="title" <?php if( isset($param['fd']) && $param['fd'] == "title" ) {?> selected<?}?>>제목</option>
                                            <option value="cont" <?php if( isset($param['fd']) && $param['fd'] == "cont" ) {?> selected<?}?>>내용</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? ''}}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#eventFormModal">신규작성</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col-sm-1" class="text-center">#</th>
                                    <th scope="col-sm-2" class="text-center">가맹점</th>
                                    <th scope="col-sm-2" class="text-center">기간</th>
                                    <th scope="col-sm-4">제목</th>
                                    <th scope="col-sm-1" class="text-center">타입</th>
                                    <th scope="col-sm-1" class="text-center">할인</th>
                                    <th scope="col-sm-2" class="text-center">등록일시</th>
                                    <th scope="col-sm-1" class="text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $events )
                                @foreach( $events as $ei => $event )
                                <tr>
                                    <th scope="row" class="text-center">{{ ($start - $ei) }}</th>
                                    <td class="text-center">{{ $event['p_name'] }}</td>
                                    <td>{{ $event['e_sdate'] }} ~ {{ $event['e_edate'] }}</td>
                                    <td>{{ $event['e_title'] }}</td>
                                    <td class="text-center">@if($event['e_type'] == "P" ) 금액할인 @elseif($event['e_type'] == "R" )  할인율 @endif</td>
                                    <td class="text-center">{{ $event['e_value'] }}</td>
                                    <td class="text-center">{{ substr($event['created_at'],0,16) }}</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary event_item" event="{{ $event['e_no'] }}" data-bs-toggle="modal" data-bs-target="#eventFormModal">관리</button></td>
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
                            {{ $events->appends($param)->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="eventFormModal" tabindex="-2" aria-labelledby="eventFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventFormModalLabel">이벤트</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                    <form class="form-horizontal" role="form" name="frm_event" id="frm_event">
                    {{csrf_field()}}
                    <input type="hidden" name="no" id="no" value="">
                    <div class="col-xs-12 mt-3">
                        <input type="hidden" name="partner" id="partner" value="">
                        <input name="partner_name" id="partner_name" style="ime-mode:disabled;" class="input_partner form-control form-control-sm mb-3 col-6" type="text" placeholder="클릭하여 가맹점검색" aria-label=".form-control-sm example" data-bs-toggle="modal" data-bs-target="#partnerSearchModal" search_mode="event">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="sdate" id="sdate" value="" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="edate" id="edate" value="" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <select name="type" id="type" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option value="P">할인금액</option>
                            <option value="R">할인율</option>
                        </select>
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="value" id="value" placeholder="할인금액" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="uname" id="uname" value="{{ $key ?? '' }}" placeholder="작성자" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="title" id="title" value="" placeholder="제목" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <textarea name="cont" id="cont" class="form-control" style="height:200px;"></textarea>
                    </div>

                    <div class="col-xs-12 mt-3" id="eventDetail_msg">

                    </div>


                    <div class="col-xs-12 mt-3 text-center">
                        <button type="button" class="btn btn-sm btn-primary" id="btn_event_update">글작성</button>
                    </div>
                    </form>
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

            $(document).on("click", ".event_item", function () {
                var e_no = $(this).attr("event");
                event_getInfo(e_no);
                console.log(e_no);
            });

            $(document).on("click", "#btn_event_update", function () {
                event_update();
            });

            $(document).on("click", "#btn_event_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    event_delete();
                }
            });

        });

        function event_update() {
            var req = $("#frm_event").serialize();
            $.ajax({
                url: '/event/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#eventDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#eventDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#eventDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function event_delete() {
            var req = $("#frm_event").serialize();
            console.log(req);
            $.ajax({
                url: '/event/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#eventDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#eventDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function event_getInfo(no) {
            var req = "no=" + no;
            $.ajax({
                url: '/event/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#eventDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);                    

                    if (res.event != null) {
                        $("#no").val(res.event.no);
                        $("#partner").val(res.event.partner);
                        $("#partner_name").val(res.event.partner_name);
                        //$("#aid").val(res.event.id).attr("readonly", true);
                        $("#sdate").val(res.event.sdate);
                        $("#edate").val(res.event.edate);
                        $("#value").val(res.event.value);
                        $("#title").val(res.event.title);
                        $("#cont").val(res.event.cont);
                        $("#type").val(res.event.type);
                    } else {
                        $("#eventDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function event_delete() {
            var req = $("#partner_event").serialize();
            console.log(req);
            $.ajax({
                url: '/event/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#eventDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#eventDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function setPartnerSelected_event(no,name){
            $("#frm_event #partner").val(no);
            $("#frm_event #partner_name").val(name);   
        }
    </script>


@endsection

