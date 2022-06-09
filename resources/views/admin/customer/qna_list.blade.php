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
                            <li class="breadcrumb-item active" aria-current="page">이벤트 목록</li>
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
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>전체</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>답변대기</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>답변완료</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목+내용+작성자</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>내용</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>작성자</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? ''}}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#customFormModal">신규작성</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">기간</th>
                                    <th scope="col" class="text-center">할인율</th>
                                    <th scope="col" class="text-center">등록일시</th>
                                    <th scope="col" class="text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10% 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10,000원 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10% 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10% 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10% 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10% 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10% 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>2020-04-10 ~ 2021-04-10</td>
                                    <td class="text-center">10% 할인</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#customFormModal">관리</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Prev</a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                    <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                </ul>
                            </div>
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
                        <input type="text" name="title" value="{{ $key ?? '' }}" placeholder="제목" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <textarea name="seat_memo" class="form-control"></textarea>
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
                url: '/customer/member/update',
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