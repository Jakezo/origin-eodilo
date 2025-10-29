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
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">1:1문의</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="ms-auto">
                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#useInfoModal"><i class="lni lni-youtube"></i>도움말</button>
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
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>전체</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>답변대기</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?php }?>>답변완료</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>제목+내용+작성자</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>제목</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?php }?>>내용</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?php }?>>작성자</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
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
                                    <th scope="col" class="text-center">작성일시</th>
                                    <th scope="col" class="text-center">답변여부</th>
                                    <th scope="col" class="text-center">답변일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row" class="col-1 text-center">10</th>
                                    <td class="col-3">기존회원님은 간단한 개인정보인증을 마치신 후에 이용가능합니다. </td>
                                    <td class="col-1 text-center">관리자</td>
                                    <td class="col-1 text-center">2020-04-10 00:00</td>
                                    <td class="col-1 text-center"><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button></td>
                                    <td class="col-1 text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">9</th>
                                    <td>새로운 시스템으로 업그래이드 완료하였습니다.</td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">8</th>
                                    <td>21일 새벽 시스템 변경 예정입니다. </td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">7</th>
                                    <td>새로운 시스템으로 업그래이드 완료하였습니다.</td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">6</th>
                                    <td>21일 새벽 시스템 변경 예정입니다. </td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">5</th>
                                    <td>새로운 시스템으로 업그래이드 완료하였습니다.</td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">4</th>
                                    <td>21일 새벽 시스템 변경 예정입니다. </td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger">답변대기</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">3</th>
                                    <td>새로운 시스템으로 업그래이드 완료하였습니다.</td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10</td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변대기</button></td>
                                    <td class="text-center">2020-04-10</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">2</th>
                                    <td>21일 새벽 시스템 변경 예정입니다. </td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary">답변완료</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">1</th>
                                    <td>새로운 시스템으로 업그래이드 완료하였습니다.</td>
                                    <td class="text-center">관리자</td>
                                    <td class="text-center">2020-04-10 00:00</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변완료</button></td>
                                    <td class="text-center">2020-04-10 00:00</td>
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
    <div class="modal fade" id="boardQnaModal" tabindex="-2" aria-labelledby="boardQnaModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="boardQnaModalLabel">작성하기</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="col-xs-12 mt-3">
                        제목 : 결제가 취소되었어요.
                    </div>
                    <div class="col-xs-12 mt-3">
                        글쓴이 : 조현준
                    </div>

                    <div class="col-xs-12 mt-3">
                        잘 사용하고 집에 돌아왔는데 결제가 취소되었다고 나옵니다.
                        이거 확인부탁드립니다.
                    </div>

                </div>
                <div class="modal-body">

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="title" value="" placeholder="제목" class="form-control form-control-sm col-12">
                    </div>
                    <div class="col-xs-12 mt-3">
                        <input type="text" name="point" value="" placeholder="작성자" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <textarea name="seat_memo" class="form-control"></textarea>
                    </div>

                    <div class="col-xs-12 mt-3 text-center">
                        <button type="button" class="btn btn-sm btn-primary">글작성</button>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection


