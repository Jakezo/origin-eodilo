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
                <div class="breadcrumb-title pe-3">커뮤니티관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">공지사항</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card col-lg-9 col-md-9 col-sm-12">

                <div class="card-body">
                    <h5 class="mb-0 text-primary">
                        @if( isset($board) && isset($board["b_no"]) )
                        수정하기
                        @else
                        신규작성
                        @endif
                    </h5>
                </div>


                <div class='card-body'>
                    <form enctype="multipart/form-data" method="post" name="form1" id="form1" class="row g-3">
                        {{csrf_field()}}
                        <input type="hidden" name="mode" value="modify">
                        <input type="hidden" name="b_id" id="b_id" value="{{ $b_id ?? '' }}">
                        <input type="hidden" name="page" value="">
                        @if( isset($board["b_no"])  )
                        <input type="hidden" name="no" id="no" value="{{ $board["b_no"] ?? '' }}">
                        <input type="hidden" name="rURL" value="">
                        @else
                        <input type="hidden" name="rURL" value="/community/{{ $b_id ?? '' }}">
                        @endif

                        <div class="col-md-12">
                            <label class="form-label">작성자</label>
                            <input type="text" name="uname" maxlength="50" class="form-control form-control-sm" value="{{ $board["b_uname"] ?? '관리자' }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">제목</label>
                            <input type="text" name="title" maxlength="50" class="form-control form-control-sm" value="{{ $board["b_title"] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">내용</label>
                            <textarea class="form-control" id="cont" name="cont" cols="70" style="height:200px;">{{ $board["b_cont"] ?? '' }}</textarea>

                        </div>
                        <div class="col-6">
                            <label class="form-label col-12">공개여부</label>
                            <div class="form-check-inline col-12">
                                <input type="radio" class='form-check-input' name="state" value="Y" @if( isset($board["b_state"]) && $board["b_state"] == 'Y' ) checked @endif> 공개
                                <input type="radio" class='form-check-input' name="state" value="N" @if( isset($board["b_state"]) && $board["b_state"] == 'N' ) checked @endif> 비공개
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary px-5" onclick="formcheck()">확인</button>
                            <button type="button" class="btn btn-secondary px-5" onclick="location.href='partner_list.html?mode=modify&p_no='">돌아가기</button>
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
            /*
            for(i=0;i<=oEditors.length-1;i++){
                oEditors[i].exec("UPDATE_CONTENTS_FIELD", []);
            }
            */

            var form = $('#form1')[0];
            var b_id = $("#b_id").val();
            var formData = new FormData(form);
            var url = '/community/'+b_id+'/update'
            $.ajax({
                url: url,
                processData: false,
                contentType: false,
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
                        console.log(res.message);
                    }
                },
                error: function (request, textStatus, errorThrown) {
                    console.log(1);
                    console.log(request);
                    console.log(2);
                    console.log(textStatus);
                    console.log(3);
                    console.log(errorThrown);
                }
            });
        }

    </script>

@endsection