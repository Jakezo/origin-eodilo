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
                <div class="breadcrumb-title pe-3">개발센터</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">개발자게시판</li>
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
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-6 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="answer" id="answer">
                                            <option value="" <?php if( !isset($param['answer']) && $param['answer'] == "" ) {?> selected<?}?>>전체</option>
                                            <option value="N" <?php if( isset($param['answer']) && $param['answer'] == "N" ) {?> selected<?}?>>답변대기</option>
                                            <option value="Y" <?php if( isset($param['answer']) && $param['answer'] == "Y" ) {?> selected<?}?>>답변완료</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="" <?php if( !isset($param['fd']) && $param['fd'] == "" ) {?> selected<?}?>>제목+내용+작성자</option>
                                            <option value="title" <?php if( isset($param['fd']) && $param['fd'] == "title" ) {?> selected<?}?>>제목</option>
                                            <option value="cont" <?php if( isset($param['fd']) && $param['fd'] == "cont" ) {?> selected<?}?>>내용</option>
                                            <option value="uname" <?php if( isset($param['fd']) && $param['fd'] == "uname" ) {?> selected<?}?>>작성자</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? ''}}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#customFormModal">작성</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건  <a target="_blank" href="https://docs.google.com/spreadsheets/d/12_MjxFUjM7NzJccwLXPbIDHyVJHg5ypjELY57UBHC3Q/edit?usp=sharing" class="btn btn-success">어디로 개발 IA</a></div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">제목</th>
                                    <th scope="col" class="text-center">작성자</th>
                                    <th scope="col" class="text-center">작성일시</th>
                                    <th scope="col" class="text-center">답변여부</th>
                                    <th scope="col" class="text-center">답변일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $customs )
                                @foreach( $customs as $ci => $custom )
                                <tr>
                                    <th scope="row" class="text-center">{{ ($start - $ci) }}</th>
                                    <td><a href="/customer/dev/view/{{ $custom['q_no'] }}">{{ $custom['q_title'] }}</a></td>
                                    <td class="text-center">{{ $custom['q_uname'] }}</td>
                                    <td class="text-center">{{ substr($custom['created_at'],0,16) }}</td>
                                    <td class="text-center">
                                        @if( $custom['a_answer'] == "Y" )
                                            <button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변완료</button>
                                        @else
                                            <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button>
                                        @endif
                                    </td>
                                    <td class="text-center">@if( isset($custom["a_answer"]) && $custom["a_answer"] == 'Y' ) {{ substr($custom['a_answer_at'],0,16) }} @endif</td>
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
                            {{ $customs->appends($param)->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="customFormModal" tabindex="-2" aria-labelledby="customFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customFormModalLabel">작성</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" name="frm_custom" id="frm_custom">
                    {{csrf_field()}}
                    <input type="hidden" name="step" id="step" value="">
                    <input type="hidden" name="no" id="no" value="">

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="uname" value="{{ Auth::guard("admin")->user()->admin_name }}" placeholder="작성자" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="title" value="{{ $title ?? '' }}" placeholder="제목" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <textarea name="cont" class="form-control" style="height:200px;"></textarea>
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
                custom_update();
            });
            $(document).on("click", "#btn_custom_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    custom_delete();
                }
            });

        });

        function custom_update() {
            var req = $("#frm_custom").serialize();
            $.ajax({
                url: '/customer/dev/update',
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
                        console.log(xhr);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }

        function custom_delete() {
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

        function custom_getInfo(no) {
            var req = "no=" + no;
            console.log(req);
            $.ajax({
                url: '/emp/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#customDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.custom != null) {
                        $("#no").val(res.custom.no);
                        $("#aid").val(res.custom.id).attr("readonly", true);
                        $("#name").val(res.custom.name);
                        $("#email").val(res.custom.email);
                        $("#phone").val(res.custom.phone);
                        if (res.custom.state) {
                            $("#state" + res.custom.state).prop("checked", true);
                        }
                        console.log(req);
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