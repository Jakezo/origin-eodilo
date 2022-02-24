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
                            <li class="breadcrumb-item active" aria-current="page">1:1문의</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="ms-auto">
                        <button class="btn btn-xs btn-danger btn_manual" rel="17"><i class="lni lni-youtube"></i>도움말</button>
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
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목+내용+작성자</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>내용</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>작성자</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-xs-6 mt-1 justify-content-right">
                                        <a href="/customer/qna/form" class="btn btn-warning px-2 btn-sm col-12">작성하기</a>
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
                                    <th scope="col" class="text-center">작성자</th>
                                    <th scope="col" class="text-center">답변여부</th>
                                    <th scope="col" class="text-center">작성일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $customs )
                                @foreach( $customs as $ci => $custom )
                                <tr>
                                    <th scope="row" class="col-2 text-center">{{($start - $ci)}}</th>
                                    <td><a href="/customer/qna/view/{{ $custom['q_no'] }}">{{ $custom['q_title'] }}</a></td>
                                    <td class="col-2 text-center">{{ $custom['q_uname'] }}</td>
                                    <td class="text-center">
                                        @if( $custom['a_answer'] == "Y" )
                                            <button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변완료</button>
                                        @else
                                            <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button>
                                        @endif
                                    </td>
                                    <td class="col-2 text-center">{{ substr($custom['created_at'],0,16) }}</td>
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

    <div class="modal fade" id="customFormModal" tabindex="-2" aria-labelledby="customFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customFormModalLabel">문의임시등록</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" name="frm_custom" id="frm_custom">
                        {{csrf_field()}}
                        <input type="hidden" name="step" id="step" value="">
                        <input type="hidden" name="no" id="no" value="">

                        <div class="col-xs-12 mt-3">
                            <select type="text" name="partner" id="partner" class="form-control form-select-sm col-12">
                            </select>
                        </div>

                        <div class="col-xs-12 mt-3">
                            <input type="hidden" name="member" id="member" value="1">
                            <input type="text" name="uname" id="uname" value="임시회원명" placeholder="작성자" class="form-control form-control-sm col-12">
                        </div>

                        <div class="col-xs-12 mt-3">
                            <input type="text" name="title" id="title" value="{{ $title ?? '' }}" placeholder="제목" class="form-control form-control-sm col-12">
                        </div>

                        <div class="col-xs-12 mt-3">
                            <textarea name="cont" id="cont" class="form-control" style="height:200px;"></textarea>
                        </div>
                        <div class="col-xs-12 mt-3" id="customDetail_msg">

                        </div>

                        <div class="col-xs-12 mt-3 text-center">
                            <button type="button" class="btn btn-sm btn-primary" id="btn_custom_update">글작성</button>
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
            $(document).on("click", ".custom_item", function () {
                var a_no = $(this).attr("custom");
                custom_getInfo(a_no);
                console.log(a_no);
            });
            $(document).on("click", "#btn_custom_update", function () {
                custom2_update();
            });
            $(document).on("click", "#btn_custom_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    custom2_delete();
                }
            });

            $('#customFormModal').on('show.bs.modal', function (e) {
                get_partners();
            });


        });

        function get_partners() {
            var req = "";
            $.ajax({
                url: '/api/partner/get_list',
                type: 'get',
                async: true,
                beforeSend: function (xhr) {
                    $("#customDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.result == true) {
                        $('#partner option').remove();
                        res.partners.forEach(function(partner) {
                            $('#partner').append(option);
                            var option = $('<option value="'+partner.p_no+'">'+partner.p_name+'</option>');
                            $('#partner').append(option);
                        });
                    } else {
                        $("#customDetail_msg").html(xhr.message);

                    }
                },
                error: function (xhr, textStatus, errorThrown) {

                    $("#customDetail_msg").html(xhr.responseJSON.message);

                }
            });
        }

        function custom2_update() {
            var req = $("#frm_custom").serialize();
            console.log(req);
            $.ajax({
                url: '/customer/qna/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#customDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#customDetail_msg").html(xhr.message);

                    }
                },
                error: function (xhr, textStatus, errorThrown) {

                    $("#customDetail_msg").html(xhr.responseJSON.message);

                }
            });
        }

        function custom2_delete() {
            var req = $("#frm_custom").serialize();
            console.log(req);
            $.ajax({
                url: '/emp/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#customDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#customDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

    </script>;


@endsection
