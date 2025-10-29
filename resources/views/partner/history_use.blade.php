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
                <div class="breadcrumb-title pe-3">Dash Board</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">이용내역보기</li>
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

                            <div class="card-body">
                                <form name="search" action="{{ $PHP_SELF ?? '' }}?>">
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-12 col-xs-12 mt-1">
                                            <div class="row">
                                                <div class="col-4">
                                                    <select class="single-select form-control-sm col-12" name="estimate" id="estimate">
                                                        <option value="" @if ( isset($estimate) && $estimate == "" ) selected @endif>사용중</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "Y" ) selected @endif>종료</option>
                                                    </select>
                                                </div>

                                                <div class="col-4">
                                                    <select class="single-select form-control-sm col-12" name="estimate" id="estimate">
                                                        <option value="" @if ( isset($estimate) && $estimate == "" ) selected @endif>스터디룸+독서실</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "" ) selected @endif>스터디룸</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "" ) selected @endif>독서실</option>
                                                    </select>
                                                </div>

                                                <div class="col-4">
                                                    <select class="single-select form-control-sm col-12" name="estimate" id="estimate">
                                                        <option value="" @if ( isset($estimate) && $estimate == "" ) selected @endif>전체상품</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "" ) selected @endif>기간권</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "" ) selected @endif>시간권</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                            <input type="text" name="sdate" id="sdate" value="{{ $sdate ?? '' }}" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                            <input type="text" name="edate" id="edate" value="{{ $edate ?? '' }}" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                            <div class="col-12">
                                                <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-d") }}');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                                <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-01") }}');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                                <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-01-01") }}');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                                <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-3 col-sm-3 col-xs-12 mt-1">
                                            <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                                <option value="">사용자명, 상품명</option>
                                                <option value="m_name" <?php if( isset($fd) && $fd == "m_name" ) {?> selected<?php }?>>사용자명</option>
                                                <option value="m_id" <?php if( isset($fd) && $fd == "m_id" ) {?> selected<?php }?>>회원ID</option>
                                                <option value="oi_names" <?php if( isset($fd) && $fd == "oi_names" ) {?> selected<?php }?>>상품명</option>
                                            </select>
                                        </div>
                                        <div class="col-md-7 col-sm-5 col-xs-12 mt-1">
                                            <input type="text" name="key" value="{{ isset($fd) && $key }}" class="form-control form-control-sm col-12">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                            <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">이용번호</th>

                                    <th scope="col">사용자명</th>
                                    <th scope="col">룸/좌석</th>
                                    <th scope="col">사물함</th>
                                    <th scope="col">상태</th>
                                    <th scope="col">입실/퇴실시간</th>
                                    <th scope="col">등록/신청일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>1234234</td>

                                    <td>조현준</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-primary"  data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>1234234</td>
                                    <td>최현우</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>1234234</td>
                                    <td>오조다</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#useInfoModal">강제퇴실대상</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>1234234</td>
                                    <td>아크말</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>1234234</td>
                                    <td>하이다르</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#useInfoModal">외출</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>1234234</td>
                                    <td>조현준</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>1234234</td>
                                    <td>최현우</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#useInfoModal">종료</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>1234234</td>
                                    <td>오조다</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#useInfoModal">종료</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>1234234</td>
                                    <td>아크말</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#useInfoModal">종료</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>1234234</td>
                                    <td>하이다르</td>
                                    <td>M1 / 12</td>
                                    <td>No.13</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#useInfoModal">종료</button></td>
                                    <td>10-10 00:00 ~ 10-10 03:00</td>
                                    <td>2020-10-10 00:00:00</td>
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
    <!--end page wrapper -->
@endsection


