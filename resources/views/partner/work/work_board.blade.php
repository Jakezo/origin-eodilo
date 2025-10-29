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
                            <li class="breadcrumb-item active" aria-current="page">업무게시판</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-xs btn-danger btn_manual" rel="10"><i class="lni lni-youtube"></i>도움말</button>
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
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="" <?php if( !isset($param['fd']) && $param['fd'] == "" ) {?> selected<?php }?>>제목+내용+작성자</option>
                                            <option value="title" <?php if( isset($param['fd']) && $param['fd'] == "title" ) {?> selected<?php }?>>제목</option>
                                            <option value="cont" <?php if( isset($param['fd']) && $param['fd'] == "cont" ) {?> selected<?php }?>>내용</option>
                                            <option value="uname" <?php if( isset($param['fd']) && $param['fd'] == "uname" ) {?> selected<?php }?>>작성자</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? ''}}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 mt-1 justify-content-right">
                                        <a href="work_board/form" class="btn btn-warning px-2 btn-sm col-12">작성하기</a>                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th class="col-1" class="text-center">#</th>
                                    <th class="col-3">제목</th>
                                    <th class="col-1" class="text-center">작성자</th>
                                    <th class="col-1" class="text-center">작성일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $boards )
                                @foreach( $boards as $bi => $board )
                                <tr>
                                    <th scope="row" class="text-center">{{ ($start - $bi) }}</th>
                                    <td><a href="/work/work_board/view/{{ $board['b_no'] }}">{{ $board['b_title'] }}</a></td>
                                    <td class="text-center">{{ $board['b_uname'] }}</td>
                                    <td class="text-center">{{ substr($board['created_at'],0,16) }}</td>
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
                            {{ $boards->appends($param)->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!--end row-->
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
            $(document).on("click", ".board_item", function () {
                var a_no = $(this).attr("board");
                board_getInfo(a_no);
                console.log(a_no);
            });
            $(document).on("click", "#btn_board_update", function () {
                board_update();
            });
            $(document).on("click", "#btn_board_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    board_delete();
                }
            });
        });

        function board_update() {
            var req = $("#frm_board").serialize();
            $.ajax({
                url: '/board/dev/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#boardDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#boardDetail_msg").html(res.message);
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

        function board_delete() {
            var req = $("#frm_board").serialize();
            console.log(req);
            $.ajax({
                url: '/emp/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#boardDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#boardDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function board_getInfo(no) {
            var req = "no=" + no;
            console.log(req);
            $.ajax({
                url: '/emp/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#boardDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.board != null) {
                        $("#no").val(res.board.no);
                        $("#aid").val(res.board.id).attr("readonly", true);
                        $("#name").val(res.board.name);
                        $("#email").val(res.board.email);
                        $("#phone").val(res.board.phone);
                        if (res.board.state) {
                            $("#state" + res.board.state).prop("checked", true);
                        }
                        console.log(req);
                    } else {
                        $("#boardDetail_msg").html(res.message);
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