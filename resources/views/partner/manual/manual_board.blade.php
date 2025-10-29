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
                <div class="breadcrumb-title pe-3">온라인메뉴얼</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">메뉴얼</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <div class="ms-auto">
                            <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#useInfoModal"><i class="lni lni-youtube"></i>도움말</button>
                        </div>
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
                                    <!--div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="" id="">
                                            <option value="" <?php if( isset($fd) && $fd == "" ) {?> selected<?php }?>>전체</option>
                                            <option value="name" <?php if( isset($fd) && $fd == "name" ) {?> selected<?php }?>>답변대기</option>
                                            <option value="title" <?php if( isset($fd) && $fd == "title" ) {?> selected<?php }?>>답변완료</option>
                                        </select>
                                    </div-->
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="" <?php if( isset($param['fd']) && $param['fd'] == "" ) {?> selected<?php }?>>제목+내용+작성자</option>
                                            <option value="title" <?php if( isset($param['fd']) && $param['fd'] == "title" ) {?> selected<?php }?>>제목</option>
                                            <option value="cont" <?php if( isset($param['fd']) && $param['fd'] == "cont" ) {?> selected<?php }?>>내용</option>
                                            <option value="uname" <?php if( isset($param['fd']) && $param['fd'] == "uname" ) {?> selected<?php }?>>작성자</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="/manual/board/form" class="btn btn-warning px-2 btn-sm col-12">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="d-xs-none col-sm-2 col-md-1 text-center">#</th>

                                    <th scope="col" class="col-xs-10 col-sm-6 col-md-6">제목</th>
                                    <th scope="col" class="d-sm-none col-md-1 text-center">작성자</th>
                                    <th scope="col" class="d-xs-none col-sm-2 col-md-2 text-center">작성일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $helpboards )
                                @foreach( $helpboards as $bi => $helpboard )
                                <tr>
                                    <td scope="row" class="d-xs-none text-center">{{ ($start - $bi) }}</td>

                                    <td><a href="/manual/board/view/{{ $helpboard['b_no'] }}">{{ $helpboard['b_title'] }}</a></td>
                                    <td class="d-sm-none col-md-1 text-center">{{ $helpboard['b_uname'] }}</td>
                                    <td class="d-xs-none text-center">{{ substr($helpboard['created_at'],0,16) }}</td>
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
                            {{ $helpboards->appends($param)->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="manualFormModal" tabindex="-2" aria-labelledby="manualFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manualFormModalLabel">작성하기</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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


