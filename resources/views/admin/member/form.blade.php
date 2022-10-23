<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <!--p>This is appended to the master sidebar.</p-->
@endsection

@section('content')

    <!--start page wrapper -->
    <script language="javaScript" src="/module/nmap/nmap.js" type="text/javascript"></script>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">사용자정보관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">사용자정보</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">

                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/user/form/{{ $user && $user["p_no"] }}'">
                            <a class="nav-link active" data-bs-toggle="tab" href="/user/form/{{ $user &&  $user["p_no"] }}"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">회원정보</div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>


                <div class='card-body'>
                    <form enctype="multipart/form-data" method="post" name="form1" id="form1" class="row g-3">
                        {{csrf_field()}}
                        <input type="hidden" name="mode" value="modify">
                        <input type="hidden" name="id" value="{{ $user["id"] ?? '' }}">
                        <input type="hidden" name="page" value="">
                        @if( $user )
                        <input type="hidden" name="rURL" value="">
                        @else
                        <input type="hidden" name="rURL" value="/member/list">
                        @endif

                        <div class="col-md-6">
                            <label class="form-label">이메일</label>
                            <input type="email" class="form-control form-control-sm" name="email" maxlength="50" value="{{ $user["email"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">비빌번호</label>
                            <input type="text" class="form-control form-control-sm" name="passwd" value="">
                        </div>

                        <!--div class="col-md-6">
                            <label class="form-label">아이디</label>
                            <input type="text" name="user_id" maxlength="50" class="form-control form-control-sm" value="{{ $user["user_id"] ?? '' }}"@if( isset($user["user_id"]) ) readonly @endif>
                        </div-->
                        <div class="col-md-6">
                            <label class="form-label">이름</label>
                            <input type="text" name="name" maxlength="50" class="form-control form-control-sm" value="{{ $user["name"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">전화번호</label>
                            <input type="text" class="form-control form-control-sm" name="phone" maxlength="50" value="{{ $user["phone"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">닉네임</label>
                            <input type="text" name="nickname" maxlength="50" class="form-control form-control-sm" value="{{ $user["nickname"] ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label for="birth" class="form-label">생년월일</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="birth" id="birth" value="{{ $user['birth']  ?? '' }}"  placeholder="생년월일">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="sex" class="form-label">성별</label>
                            <div class="input-group"> 
                            <div class="btn-group btn-group-sm" role="group">
                                <input type="radio" class="btn-check" name="sex" id="sex_M" value="M" autocomplete="off" @if( isset($user ) && $user['sex'] == "M" ) checked="checked" @endif>
                                <label class="btn btn-outline-primary" for="sex_M">남</label>
                                <input type="radio" class="btn-check" name="sex" id="sex_F" value="F" autocomplete="off" @if( isset($user ) && $user['sex'] == "F" ) checked="checked" @endif>
                                <label class="btn btn-outline-primary" for="sex_F">여</label>
                              </div>    
                            </div>  
                        </div>

                        <div class="col-6">
                            <label class="form-label col-12">Block</label>
                            <div class="form-check-inline col-12">
                                <input type="radio" class='form-check-input' name="state" value="A" @if( $user && $user["state"] == 'A' ) checked @endif> 사용
                                <input type="radio" class='form-check-input' name="state" value="B" @if( $user && $user["state"] == 'B' ) checked @endif> 비활성
                                ( 비활성시 로그인불가 )
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">메모</label>
                            <textarea class="form-control" name="memo" rows="3">{{ $user["memo"] ?? '' }}</textarea>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="alert alert-danger d-none" id="userErrMsg">

                        </div>

                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary px-5" onclick="formcheck()">정보수정</button>
                            <button type="button" class="btn btn-secondary px-5" onclick="location.href='user_list.html?mode=modify&p_no='">돌아가기</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    <?
    //include $CFG['module_dir']."/zipcode/zipcode.inc.php";
    ?>
    <!--end page wrapper -->
@endsection


@section('javascript')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function formcheck(){
            $("#userErrMsg").html("").addClass("d-none");

            formData = $("#form1").serialize();
            console.log(formData); 
            $.ajax({
                url: '/member/update',
                data: formData,
                type: 'POST',
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        if (res.rURL != undefined) {
                            document.location.href = res.rURL;
                        } else {
                            document.location.reload();
                        }
                    } else {
                        $("#userErrMsg").html(res.message).removeClass("d-none");
                    }
                },
                error: function(xhr, status, msg){
                    ajax_error(xhr.responseJSON)
                }
            });
        }

    </script>

@endsection
