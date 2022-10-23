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
                <div class="breadcrumb-title pe-3">업무</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">업무일지</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-xs btn-danger btn_manual" rel="10"><i class="lni lni-youtube"></i>도움말</button>
                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card col-lg-9 col-md-9 col-sm-12">

                <div class='card-body'>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">작성자</label>
                        <input type="text" name="uname" maxlength="50" class="form-control form-control-sm" value="{{ $board["b_uname"] ?? '관리자' }}" disabled>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">제목</label>
                        <input type="text" name="title" maxlength="50" class="form-control form-control-sm" value="{{ $board["b_title"] ?? '' }}" disabled>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">내용</label>
                        <div class="card">
                            <div class='card-body'>
                                {!! nl2br(e($board["b_cont"])) !!}
                            </div>
                        </div>
                    </div>


                    <form enctype="multipart/form-data" method="post" name="form1" id="form1" class="row g-3">
                        {{csrf_field()}}
                        <input type="hidden" name="mode" value="modify">
                        @if( isset($board["b_no"])  )
                        <input type="hidden" name="no" id="no" value="{{ $board["b_no"] ?? '' }}">
                        @endif
                        <input type="hidden" name="rURL" value="/customer/partner/">
                    </form>

                    <div class="col-12 text-center">
                        @if( isset($board['b_no']) && $board['b_no'] > 0  )
                        <button type="button" class="btn btn-warning px-5" onclick="location.href='/work/work_board/form/{{ $board['b_no'] }}'">수정하기</button>
                        @else
                        @endif

                        <button type="button" class="btn btn-secondary px-5" onclick="location.href='partner_list.html?mode=modify&p_no='">돌아가기</button>
                    </div>

                </div>

                <div class='card-body'>
                    <form name="comm_form" id="comm_form" class="row g-3">
                    {{csrf_field()}}
                    <input type="hidden" name="mode" value="add">
                    <input type="hidden" name="no" id="no" value="{{ $board['b_no'] ?? '' }}">

                   
                    <div class="col-md-12 mt-3" id="comments_list">

                    </div>                    


                    <div class="col-md-12 mt-3">
                        <label class="form-label">댓글 @auth {{ Auth::guard("partner")->user()->mn_name }} @endauth</label>
                        <textarea class="form-control" id="comm" name="comm" cols="70" style="height:100px;"></textarea>
                    </div>
                    <div class="col-md-12 mt-1 text-right">
                        <div class="float:left">

                        </div>
                        <div class="text-right">
                            <button type="button" id="btn_comm_add" class="btn btn-primary px-5">댓글쓰기</button>
                        </div>
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

            $(document).on("click","#btn_comm_add", function(){
                comm_add();
            });                 
        });

        function formcheck(){
            /*
            for(i=0;i<=oEditors.length-1;i++){
                oEditors[i].exec("UPDATE_CONTENTS_FIELD", []);
            }
            */

            var form = $('#form1')[0];
            var formData = new FormData(form);
            var url = '/customer/partner/answer'
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


        $(document).on("click",".btn_comm_del",function(){                 
            if( confirm("삭제하시겠습니까?") == true ) {
                var b_no = $(this).attr("b_no");
                var comm_no = $(this).attr("comm_no");  
                comm_del( b_no, comm_no );
            }
        });

        function comm_add(){
            var req = $("#comm_form").serialize();
            var url = '/comments/update'
            $.ajax({
                url: url,
                data: req,
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        $("#comm_form #comm").val("");
                        comm_list();
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

        function comm_del( b_no, comm_no ){
            var req = "no=" + b_no + "&comm_no="+comm_no;
            console.log(req);
            var url = '/comments/delete'
            $.ajax({
                url: url,
                data: req,
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        $(".comm_row[comm='"+comm_no+"']").remove();
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

        
        function comm_list(){
            var req = $("#comm_form").serialize();
            var url = '/comments/list'
            $.ajax({
                url: url,
                data: req,
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $('#comments_list').empty();
                },
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        for(key in res.comments){
                            var html = "";

                            html = html + '<div class="alert border-0 border-start border-5 border-secondary alert-dismissible fade show py-2 comm_row" comm="'+res.comments[key].c_no+'">';
                            html = html + '    <div class="d-flex align-items-center">';
                            html = html + '        <div class="font-35 text-secondary">';
                            html = html + '        </div>';
                            html = html + '        <div class="ms-3">';
                            html = html + '            <h6 class="mb-0">'+res.comments[key].c_comments+'</h6>';
                            html = html + '            <div>';
                            html = html + '                 <div>'+res.comments[key].c_uname+' '+res.comments[key].rdate+'</div>';
                            html = html + '            </div>';
                            html = html + '        </div>';
                            html = html + '    </div>';
                            if( res.comments[key].is_my!=undefined && res.comments[key].is_my == true ) {                            
                            html = html + '    <button type="button" class="btn-close btn_comm_del" b_no="'+res.comments[key].c_parent+'" comm_no="'+res.comments[key].c_no+'"></button>';
                            }                            
                            html = html + '</div>';

                            $('#comments_list').append(html);
                        };

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
        
        comm_list();
    </script>

@endsection