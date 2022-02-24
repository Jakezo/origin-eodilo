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
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">사물함배치도</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger btn_manual" rel="8"><i class="lni lni-youtube"></i>도움말</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-12 col-lg-9 d-lg-flex align-items-lg-stretch">
                    <div class="card radius-10 w-100">
                        <div class="card-header border-bottom-0 bg-transparent">
                            <div class="d-lg-flex align-items-center">
                                <div class="">
                                    <h5 class="mb-1">현재 선택된 영역</h5>
                                    <p class="text-secondary mb-2 mb-lg-0 font-14">12개 사물함</p>
                                </div>
                                <div class="ms-lg-auto">
                                    <div class="btn-group-round">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-white">영역1</button>
                                            <button type="button" class="btn btn-white">영역2</button>
                                            <button type="button" class="btn btn-white">영역3</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 d-lg-flex align-items-lg-stretch">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">사물함목록</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>사물함번호</th>
                                        <th>사용자</th>
                                        <th>종료일시</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>조현준</td>
                                        <td>2020-10-10 ( 3일전 )</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>최현우</td>
                                        <td>2020-10-10 ( 3일전 )</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>미사용</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>미사용</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>미사용</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>미사용</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>미사용</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>미사용</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
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


