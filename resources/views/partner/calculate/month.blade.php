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
                <div class="breadcrumb-title pe-3">정산</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">월별정산내역</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-xs btn-danger btn_manual" rel="15"><i class="lni lni-youtube"></i>도움말</button>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="estimate" id="estimate">
                                            <option value="" <?php if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) {?> selected<?}?>>2021</option>
                                            <option value="" <?php if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) {?> selected<?}?>>2020</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="estimate" id="estimate">
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>전체</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>01</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>02</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>03</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>04</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>05</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>06</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>07</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>08</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>09</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>10</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>11</option>
                                            <option value="" @if( isset($_GET["estimate"]) && $_GET["estimate"] == "Y" ) selected @endif>12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                        <div class="col-12">
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-01") }}');$('#edate').val('{{ date('Y-m-t') }}');">이달</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-01-01") }}');$('#edate').val('<{{ date('Y-12-31') }}');">금년</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                        </div>
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
                                    <th scope="col">#</th>
                                    <th scope="col">정산월</th>
                                    <th scope="col">사용인원</th>
                                    <th scope="col">사용시간</th>
                                    <th scope="col">누적매출</th>
                                    <th scope="col">수수료</th>
                                    <th scope="col">정산금액</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>2020-10</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>2020-09</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>2020-08</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>2020-07</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>2020-06</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>2020-05</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>2020-04</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>2020-03</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>2020-02</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020-01</td>
                                    <td>160</td>
                                    <td>2,300</td>
                                    <td>30,849,000</td>
                                    <td>3,084,900</td>
                                    <td>30,519,000</td>
                                    <td><button class="btn btn-xs btn-secondary">일별정산내역보기</button></td>
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


