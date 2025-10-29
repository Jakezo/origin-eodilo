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
                            <li class="breadcrumb-item active" aria-current="page">동영상메뉴얼</li>
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

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>

                                    <div class="col-sm-2 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="b_title" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>제목</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                @if( $vodboards )
                @foreach( $vodboards as $bi => $vodboard )
                <div class="col-3">
                    <div class="card btn_manual" rel="{{ $vodboard['b_no'] }}">
                        <img src="{{ youtube_videoID2ImgSrc(youtube_link2videoID($vodboard['b_vod'])) }}" -class="img-fluid" alt="" style="width:100%">
                        <div class="card-body">
                            <h6 class="card-title cursor-pointer">{{ $vodboard['b_title'] }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>


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


