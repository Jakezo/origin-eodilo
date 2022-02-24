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
                <div class="breadcrumb-title pe-3">설정</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">관리자정보</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#useInfoModal"><i class="lni lni-youtube"></i>도움말</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->


 
            <div class="card">
                <div class="card-body">
                    <form method="get" action="/emp" id="search_frm">
                        <div class="col-12 text-right mb-2 row">
                            <div class="col-sm-8 mb-1 text-left">
                                <input type="text" class="form-control form-control-sm date col-12" name="q" value="{{ $q ?? '' }}" placeholder="이름, 이메일, 핸드폰, 아이디" onchange="this.form.submit()">
                            </div>
                            <div class="col-sm-2 mb-1 text-left">
                                <button type="button" class="btn btn-sm btn-secondary col-12">검색</button>
                            </div>

                            <div class="col-sm-2 mb-1 text-left">
                                <button type="button" class="btn btn-info btn-sm admin_item col-12" aid="" data-bs-toggle="modal" data-bs-target="#adminDetailModal">사용자등록</button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive-sm">
                        <table class="table mb-0">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center d-none d-md-table-cell">#</th>
                                <th scope="col" class="text-center">아이디</th>
                                <th scope="col" class="text-center">이름</th>
                                <th scope="col" class="text-center d-none d-sm-table-cell">이메일</th>
                                <th scope="col" class="text-center d-none d-md-table-cell">휴대폰</th>
                                <th scope="col" class="text-center ">상태</th>
                                <th scope="col" class="text-center d-none d-md-table-cell">등록일</th>
                                <th scope="col" class="text-center d-none d-md-table-cell">최근로그인</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if( $admins ?? "" ) 
                            @foreach ( $admins as $ai => $admin)
                            <tr class="admin_item" admin="{{ $admin['mn_no'] ?? '' }}" data-bs-toggle="modal" data-bs-target="#adminDetailModal">
                                <td class="text-center d-none d-md-table-cell" scope="row">{{ (count($admins)-$ai) }}</td>
                                <td class="text-center">{{ $admin['mn_id'] ?? '' }}</td>
                                <td class="text-center">{{ $admin['mn_name'] ?? '' }}</td>
                                <td class="text-center d-none d-sm-table-cell">{{ $admin['mn_email'] ?? '' }}</td>
                                <td class="text-center d-none d-md-table-cell">{{ $admin['mn_phone'] ?? '' }}</td>
                                <td class="text-center">
                                    @if( $admin['mn_state'] == "Y" )
                                        <span class="btn btn-xs btn-success">승인</span>
                                    @elseif( $admin['mn_state'] == "N" )
                                        <span class="btn btn-xs btn-warning">미승인</span>
                                    @elseif( $admin['mn_state'] == "X" )
                                        <span class="btn btn-xs btn-secondary">차단</span>
                                    @endif
                                </td>
                                <td class="text-center d-none d-md-table-cell"> {{ $admin['created_at'] ?? '' }} </td>
                                <td class="text-center d-none d-md-table-cell"> {{ $admin['mn_login_last'] ?? '' }} </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                 
                </div>
                <div class="card-body d-flex justify-content-center">

                    <!--nav aria-label="Page navigation example">
                        <ul class="pagination pagination-sm">
                            <li class="page-item active"><a class="page-link">1</a>
                            </li>
                            <li class="page-item d-none d-sm-inline-block"><a class="page-link" href="?skey=&amp;page=2">2</a>
                            </li>
                        </ul>
                    </nav-->
                </div>

            </div>
        </div>
        <!--end row-->
    </div>
    <div class="modal" id="adminDetailModal" tabindex="-1" aria-labelledby="adminDetailModal" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rpInfoModalLabel">관리자정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="adminDetail_body">
                    <form action="/emp/update" aria-label="{{ __('Register') }}" class="form-horizontal" role="form" name="frm_admin" id="frm_admin">
                        
                        {{csrf_field()}}
                        <input type="hidden" name="step" id="step" value="">
                        <input type="hidden" name="no" id="no" value="">

                        <div class="form-group mt-2">
                            <label for="aid" class="col-sm-12 control-label">아이디</label>
                            <div class="col-sm-12">
                                <input type="text" name="aid" id="aid" value="" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div style="clear:both"></div>

                        <div class="form-group mt-2">
                            <label for="pw" class="col-sm-12 control-label">비밀번호</label>
                            <div class="col-sm-12">
                                <input type="password" name="passwd" id="passwd" value="" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div style="clear:both"></div>


                        <div class="form-group mt-2">
                            <label for="name" class="col-sm-12 control-label">이름</label>
                            <div class="col-sm-12 text-left">
                                <input type="text" name="name" id="name" value="" size="30" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div style="clear:both"></div>

                        <div class="form-group mt-2">
                            <label for="email" class="col-sm-12 control-label">이메일</label>
                            <div class="col-sm-12 text-left">
                                <input type="email" name="email" id="email" value="" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="phone" class="col-sm-12 control-label">휴대폰</label>
                            <div class="col-sm-12 text-left">
                                <input type="text" name="phone" id="phone" value="" size="30" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="blockN" class="col-sm-12 control-label">승인</label>
                            <div class="col-sm-12 text-left">
                                <input type="radio" name="state" id="stateY" value="Y" checked=""> 승인
                                <input type="radio" name="state" id="stateN" value="N"> 신청
                                <input type="radio" name="state" id="stateX" value="X"> 중지
                            </div>
                        </div>

                        <div class="col-12 text-center text-danger" id="adminDetail_msg"></div>

                        <br>
                        <table width="100%">
                            <tbody><tr>
                                <td height="25" class="class_admin_table_blank" colspan="2" align="center">

                                    <button type="button" class="btn btn-sm btn-primary" id="btn_admin_update">확인</button>
                                    <button type="button" class="btn btn-sm btn-secondary" id="btn_admin_delete">삭제</button>
                                </td>
                            </tr>
                            </tbody></table>
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

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("click",".admin_item",function(){
                var a_no = $(this).attr("admin");
                admin_getInfo(a_no);
                console.log(a_no);
            });
            $(document).on("click","#btn_admin_update",function(){
                admin_update();
            });
            $(document).on("click","#btn_admin_delete",function(){
                if( confirm("삭제하시겠습니까?") == true ) {
                    admin_delete();
                }
            });

            $('#adminDetailModal').on('show.bs.modal', function (e) {
                $("#aid").val("").attr("readonly", false);
            });

        });

        function admin_update(){
            var req = $("#frm_admin").serialize();
            console.log(req);
            console.log('/setting/emp/update');

            $.ajax({
                url: '/setting/emp/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#adminDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
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

        function admin_delete(){
            var req = $("#frm_admin").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/emp/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#adminDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
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
        function admin_getInfo(no){
            var req = "no=" + no ;
            console.log(req);
            $.ajax({
                url: '/setting/emp/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#adminDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if( res.admin != null ) {
                        $("#no").val(res.admin.no);
                        $("#aid").val(res.admin.aid).attr("readonly", true);
                        $("#name").val(res.admin.name);
                        $("#email").val(res.admin.email);
                        $("#phone").val(res.admin.phone);
                        if( res.admin.state ) {
                            $("#state" + res.admin.state).prop("checked",true);
                        }
                        console.log(req);
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

    </script>

@endsection