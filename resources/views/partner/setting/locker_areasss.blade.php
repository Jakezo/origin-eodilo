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
                <div class="breadcrumb-title pe-3">사물함관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">사물함정보관리</li>
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
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>구역전체</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>1층복도</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>2층복도</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>A룸 입구옆</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>구분전체</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>상단</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>중앙</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>하단</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#lockerFormModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">구역</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">사물함명</th>
                                    <th scope="col">공개여부</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>10</th>
                                    <td>M01</td>
                                    <td>상단</td>
                                    <td>A1</td>
                                    <td>모바일, 키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>9</th>
                                    <td>M01</td>
                                    <td>상단</td>
                                    <td>A2</td>
                                    <td>모바일, 키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>8</th>
                                    <td>M01</td>
                                    <td>중앙</td>
                                    <td>A3</td>
                                    <td>모바일, 키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>7</th>
                                    <td>M01</td>
                                    <td>중앙</td>
                                    <td>A4</td>
                                    <td>모바일, 키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>6</th>
                                    <td>M01</td>
                                    <td>하단</td>
                                    <td>A5</td>
                                    <td>키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>5</th>
                                    <td>M01</td>
                                    <td>하단</td>
                                    <td>A6</td>
                                    <td>키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>4</th>
                                    <td>M01</td>
                                    <td>하단</td>
                                    <td>A7</td>
                                    <td>키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>3</th>
                                    <td>M01</td>
                                    <td>하단</td>
                                    <td>A8</td>
                                    <td>모바일,키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>2</th>
                                    <td>M01</td>
                                    <td>하단</td>
                                    <td>A9</td>
                                    <td>모바일,키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                                        </div>
                                    </th>
                                    <th>1</th>
                                    <td>M01</td>
                                    <td>하단</td>
                                    <td>A10</td>
                                    <td>모바일,키오스크</td>
                                    <td><a href="javascript:;" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lockerFormModal">관리</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <div class='row'>
                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <input class="form-check-input" type="checkbox" id="gridCheck3"> 선택 좌석을
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <select class="single-select form-control-xs col-12" name="fd" id="fd">
                                        <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>등급전체</option>
                                        <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>A등급</option>
                                        <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>B등급</option>
                                        <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>C등급</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                    <button type="submit" class="btn btn-secondary px-2 btn-xs col-12">변경</button>
                                </div>
                            </div>

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
    <div class="modal fade" id="lockerFormModal" tabindex="-3" aria-labelledby="lockerFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lockerFormModalLabel">사물함정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="roomInfo" role="tabpanel">

                            <form class="row g-3">
                                <div class="col-md-12">
                                    <label for="inputLastName1" class="form-label">이름</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0" id="inputLastName1" placeholder="좌석번호">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputLastName2" class="form-label">사물함구분</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0" id="inputLastName2" placeholder="사물함구분">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputLastName2" class="form-label">구분</label>
                                    <div class="input-group">
                                        <select class="form-control form-select-sm">
                                            <option>상단</option>
                                            <option>중앙</option>
                                            <option>하단</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputLastName2" class="form-label">IOT세팅</label>

                                    <div class="col-12 mb-2">
                                        <input type="text" class="form-control" id="inputLastName2" placeholder="1">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            <div>사물함 개방 IOT 포트를 사용하는 가맹점의 경우 각 포트번호르 입력</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    공개
                                </div>
                                <div class="col-12">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexCheck1" id="sexCheck1" value="option1">
                                        <label class="form-check-label" for="sexCheck1">모두</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexCheck2" id="sexCheck2" value="option1">
                                        <label class="form-check-label" for="sexCheck2">모바일</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexCheck3" id="sexCheck3" value="option1">
                                        <label class="form-check-label" for="sexCheck3">키오스크</label>
                                    </div>

                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 사물함을 삭제 <button type="button" class="btn btn-xs btn-secondary">삭제</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="roomMap" role="tabpanel">

                        </div>
                        <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">입실</th>
                                    <th scope="col">퇴실</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#memberRegModal">예약</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#memberRegModal">사용중</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">종료</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">종료</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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


