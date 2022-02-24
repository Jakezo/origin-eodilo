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
                <div class="breadcrumb-title pe-3">가맹점관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">가맹점 기본세팅</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card col-md-12 col-sm-12">

                <div class="modal-body">

                    <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="/partner/standard/">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">IOT 기본세팅</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="/partner/standard/price">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">좌석금액 기본세팅</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" href="/partner/standard/product">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">상품 기본세팅</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <form name="productsForm" id="productsForm" class="row g-3">
                    <div class="tab-content py-3">

                                        <div class="row">
            
                                            <div class="col-sm-12 col-md-3 mb-3">
            
                                                <h4>시간권</h4>
                                                <table class="table mb-0 table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            선택
                                                            <!--div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                            </div-->
                                                        </th>
                                                        <th scope="col">시간</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for( $i=1; $i<=24; $i++)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="T_{{ $i }}" name="T[]" value="{{ $i }}" @if( isset($data['T']) && in_array($i,$data['T']) ) checked="checked" @endif>
                                                            </div>
                                                        </th>
                                                        <th>{{ $i }}시간</th>
                                                    </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
            
                                            <div class="col-sm-12 col-md-3 mb-3">
            
                                                <h4>기간권</h4>
                                                <table class="table mb-0 table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            선택
                                                            <!--div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                            </div-->
                                                        </th>
                                                        <th scope="col">기간</th>
                                                        <th scope="col">
                                                            
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for( $i=1; $i<=30; $i+=2)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="D_{{ $i }}" name="D[]" value="{{ $i }}" @if( isset($data['D']) && in_array($i,$data['D']) ) checked="checked" @endif>
                                                            </div>
                                                        </th>
                                                        <th>{{ ($i) }}일</th>
                                                        <th>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="D_{{ ($i+1) }}" name="D[]" value="{{ ($i+1) }}" @if( isset($data['D']) && in_array(($i+1),$data['D']) ) checked="checked" @endif>
                                                            </div>
                                                        </th>
                                                        <th>{{ ($i+1) }}일</th>
                                                    </tr>
                                                    @endfor                                            
            
                                                    </tbody>
                                                </table>
                                            </div>
            
                                            <div class="col-sm-12 col-md-3 mb-3">
                                                <h4>고정권</h4>
                                                <table class="table mb-0 table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            선택
                                                            <!--div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                            </div-->
                                                        </th>
                                                        <th scope="col">시간</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for( $i=1; $i<=24; $i++)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="F_{{ $i }}" name="F[]" value="{{ $i }}" @if( isset($data['F']) && in_array($i,$data['F']) ) checked="checked" @endif>
                                                            </div>
                                                        </th>
                                                        <th>{{ $i }}개월</th>
                                                    </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
            
                                            <div class="col-sm-12 col-md-3 mb-3">
            
                                                <h4>정액권</h4>
                                                <table class="table mb-0 table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            선택
                                                            <!--div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                            </div-->
                                                        </th>
                                                        <th scope="col">시간</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for( $i=10000; $i<=240000; $i+=10000)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="P_{{ $i }}" name="P[]" value="{{ $i }}" @if( isset($data['P']) && in_array($i,$data['P']) ) checked="checked" @endif>
                                                            </div>
                                                        </th>
                                                        <th>{{ $i }} 포인트</th>
                                                    </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>                                
            
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-primary px-5" onclick="formcheck()">정보수정</button>
                                        </div>

                    </div>
                </form>

                </div>

            </div>
        </div>

        <div class="search-overlay"></div>
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
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

    });   
    function formcheck(){

        var form = $('#productsForm')[0];
        var formData = new FormData(form);
        var url = '/partner/standard/product/update'
        $.ajax({
            url: url,
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success: function (res) {
                console.log(res);
                if (res.result == true) {
                    if (res.rURL != undefined) {
                        document.location.href = res.rURL;
                    } else {
                        //document.location.reload();
                    }
                } else {
                    console.log(res.message);
                }
            },
            error: function (request, textStatus, errorThrown) {
                console.log(1);
                console.log(request);
                console.log(2);
                console.log(textStatus);
                console.log(3);
                console.log(errorThrown);
            }
        });
    }      

</script>   

@endsection


