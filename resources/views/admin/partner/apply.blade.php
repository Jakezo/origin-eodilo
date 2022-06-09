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
                <div class="breadcrumb-title pe-3">가맹점관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">가맹점신청</li>
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

                    <hr/>
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목+내용</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>내용</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#applyModal">신규작성</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">제목</th>
                                    <th scope="col">기존운영자</th>
                                    <th scope="col" class="text-center">작성자</th>
                                    <th scope="col" class="text-center">작성일시</th>
                                    <th scope="col" class="text-center">처리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $partner_apply )
                                @foreach( $partner_apply as $ri => $partner_app )
                                <tr>
                                    <th scope="row" class="col text-center">{{ (count($partner_apply)-$ri) }}</th>
                                    <td class="col " data-bs-toggle="modal" data-bs-target="#applyModal">{{ $partner_app['app_title'] }} </td>
                                    <td class="col "> 
                                    @if( $partner_app['app_state'] == "N" )
                                    <span>운영예정</span>
                                    @elseif( $partner_app['app_state'] == "Y" )
                                    <span>현재운영중</span>
                                    @endif
                                    </td>
                                    <td class="col  text-center">{{ $partner_app['app_name'] }}</td>
                                    <td class="col  text-center">{{ $partner_app['created_at']}}</td>
                                    <td scope="col" class="text-center"><button class="btn btn-xs btn-success">완료</button></td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                        {{ $partner_apply->appends($param)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->


    <div class="modal fade" id="applyModal" tabindex="-3" aria-labelledby="applyModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">가맹점신청정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">기본정보</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">


                            <form action="/partner" class="row g-3" name="partner_app" id="partner_app" >
                                <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label">제목</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" name="title" value="" class="form-control border-start-0" id="inputLastName1" placeholder="제목">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label">이름</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" name="name" value="" class="form-control border-start-0" id="inputLastName1" placeholder="이름">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="inputPhoneNo" class="form-label">연락처</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-microphone"></i></span>
                                        <input type="text" name="phone" value="" class="form-control border-start-0" id="inputPhoneNo" placeholder="휴대폰번호">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">주소(예정주소)</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-message"></i></span>
                                        <input type="text" name="address" value="" class="form-control border-start-0" id="inputEmailAddress" placeholder="주소">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">상태</label>
                                    <div class='col-sm-12'>
                            <div class="form-check-inline mt-3">
                            <input type="radio" class='form-check-input' id="stateY" name="state" value="Y">현재운영중
                            <input type="radio" class='form-check-input' id="stateN" name="state" value="N" checked> 운영예정
                            </div>
                                </div>

                            </div>

                     <!--잘모르겠음--><div class="col-12 text-center text-danger" id="adminDetail_msg"></div>

                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-danger px-5" id="btn_partner_apply">신청</button>
                                </div>
                            </form>


                        </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script>

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("click","#btn_partner_apply",function(){
                partner_apply_add();
            });
            $('#adminDetailModal').on('show.bs.modal', function (e) {
                $("#aid").val("").attr("readonly", false);
            });


            function partner_apply_add(){
                var req = $("#partner_app").serialize();

                console.log(req);
                $.ajax({
                    url:'/partner/apply/store',
                    type: 'POST',
                    async: true,
                    beforeSend: function (xhr) {
                        $("#adminDetail_msg").html("");
                    },
                    data: req,
                    success: function (res, textStatus, xhr) {
                        console.log(res);
                        if( res.result == true ) {
                            document.location.reload();
                        } else {
                            $("#adminDetail_msg").html( res.message );
                            console.log("실패.");
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log('PUT error.');
                    }
                });
            }
        });

    </script>
@endsection
