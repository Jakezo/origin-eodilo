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
                            <li class="breadcrumb-item active" aria-current="page">고객리뷰</li>
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
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <div>평점 평균: {{ isset($average) ? ($average) : '' }} 점</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">지점</th>
                                    <th scope="col" class="text-center">내용</th>
                                    <th scope="col" class="text-center">작성자</th>
                                    <th scope="col" class="text-center">평점</th>
                                    <th scope="col" class="text-center">작성일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $reviews )
                                    @foreach( $reviews as $bi => $review )
                                        <tr>
                                            <th scope="row" class="col-2 text-center">{{ ($start - $bi) }}</th>
                                            <td class="text-center">{{$review['p_name']}}</td>
                                            <td class="text-center">{{$review['rv_contents']}}</td>
                                           
                                            @if($review['rv_member']==0)
                                            <td class="text-center">임시작성자</td>
                                            @else
                                            <td class="text-center">임시작성자</td>
                                            @endif

                                            @if($review['rv_point']==1)
                                                <td class="text-center"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==2)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==3)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==4)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==5)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==0)
                                                <td class="text-center">평점없음</td>
                                            @endif
                                            <td class="text-center">{{$review['created_at']}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection