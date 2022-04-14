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
                <div class="breadcrumb-title pe-3">고객센터</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">문의 수정</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card col-lg-9 col-md-9 col-sm-12">

                <div class='card-body'>

                    <form enctype="multipart/form-data" method="post" name="form1" id="form1" class="row g-3">
                        {{csrf_field()}}
                        <input type="hidden" name="mode" value="modify">
                        @if( isset($custom["q_no"])  )
                        <input type="hidden" name="no" id="no" value="{{ $custom["q_no"] ?? '' }}">
                        @endif
                        <input type="hidden" name="rURL" value="/customer/qna/">
                        <div class="col-md-12 mb-3">
                        <label class="form-label">작성자</label>
                        <input type="text" name="uname" maxlength="50" class="form-control form-control-sm" value="{{ isset($custom["q_uname"]) ? $custom["q_uname"] : ($uname ?? '') }}" readyonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">제목</label>
                        <input type="text" name="title" maxlength="50" class="form-control form-control-sm" value="{{ $custom["q_title"] ?? '' }}" >
                    </div>
                    <div class="col-12 mb-3">
                    <div class="col-12">
                            <label class="form-label">내용</label>
                            <textarea class="form-control" id="cont" name="cont" cols="70" style="height:200px;">{{ $custom["q_cont"] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        @if( isset( $custom["q_no"] )  )
                        <button type="button" class="btn btn-primary px-5" onclick="formcheck()">수정하기</button>
                        @else
                        <button type="button" class="btn btn-primary px-5" onclick="formcheck()">작성하기</button>
                        @endif
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
 

            var form = $('#form1')[0];
            var formData = new FormData(form);
            var url = '/customer/qna/update'
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