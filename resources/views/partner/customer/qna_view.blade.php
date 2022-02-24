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
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">문의 내용</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card col-lg-9 col-md-9 col-sm-12">

                <div class='card-body'>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">작성자</label>
                        <input type="text" name="uname" maxlength="50" class="form-control form-control-sm" value="{{ $custom["q_uname"] ?? '관리자' }}" disabled>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">제목</label>
                        <input type="text" name="title" maxlength="50" class="form-control form-control-sm" value="{{ $custom["q_title"] ?? '' }}" readonly>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">내용</label>

                        <input type="text" name="cont" maxlength="50" class="form-control form-control-sm" value="{{ $custom["q_cont"] ?? '' }}" readonly>
                    </div>

                </div>      
 
                </div>


                @if ($custom['a_answer'] == "Y")
                <div class="breadcrumb-title pe-3" >
                <h4 style="color:#424242">답변내용</h4>
                </div>
                @else
                @endif

                <div class="card col-lg-9 col-md-9 col-sm-12">
                <div class='card-body'>

                    @if ($custom['a_answer'] == "Y")
                    <div class="col-md-12">
                            <label class="form-label">작성자</label>
                            <input type="text" name="uname" maxlength="50" class="form-control form-control-sm" value="{{ $custom["a_uname"] ?? '관리자' }}" readonly>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">제목</label>
                            <input type="text" name="title" maxlength="50" class="form-control form-control-sm" value="{{ $custom["a_title"] ?? '' }}" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label">내용</label>
                            <textarea class="form-control" id="a_cont" name="a_cont" cols="70" style="height:200px;" readonly>{{ $custom["a_cont"] ?? '' }}</textarea>
                        </div>
                    @else
                    @endif
                    <div class="col-12 text-center">
                            @if($custom['a_answer'] == "N" )
                            <button type="button" class="btn btn-primary px-5" onclick="location.href='/customer/qna/form/{{ $custom['q_no'] }}'">수정하기</button>
                            @else
                            @endif
                            <button type="button" class="btn btn-secondary px-5" onclick="history.back()">돌아가기</button>
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
