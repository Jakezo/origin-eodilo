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
                <div class="breadcrumb-title pe-3">상품관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">상품정보관리</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-xs btn-danger btn_manual" rel="9"><i class="lni lni-youtube"></i>도움말</button>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card col-md-12 col-sm-12">

                    <div class="card-body">


                        <form name="productsForm" id="productsForm" class="row g-3">

                            <div class="row mt-3">
                                <div class="col-offset-sm-3 col-sm-3 mb-3">                                
                                    <button type="button" class="btn btn-sm btn-primary" id="btn_setStandardProduct">은하표준상품 적용하기</button>
                                </div>
                            </div>

                            <div class="row mt-3">

                                <div class="col-sm-12 col-md-3 mb-3">

                                    <h4>시간권</h4>
                                    <table class="table mb-0 table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                </div>
                                            </th>
                                            <th scope="col">시간</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for( $i=1; $i<=24; $i++)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="T_{{ $i }}" name="T[]" value="{{ $i }}" @if( in_array($i,$data['T']) ) checked="checked" @endif>
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
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                </div>
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
                                                    <input class="form-check-input" type="checkbox" id="D_{{ $i }}" name="D[]" value="{{ $i }}" @if( in_array($i,$data['D']) ) checked="checked" @endif>
                                                </div>
                                            </th>
                                            <th>{{ ($i) }}일</th>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="D_{{ ($i+1) }}" name="D[]" value="{{ ($i+1) }}" @if( in_array(($i+1),$data['D']) ) checked="checked" @endif>
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
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                </div>
                                            </th>
                                            <th scope="col">시간</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for( $i=1; $i<=24; $i++)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="F_{{ $i }}" name="F[]" value="{{ $i }}" @if( in_array($i,$data['F']) ) checked="checked" @endif>
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
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck3">
                                                </div>
                                            </th>
                                            <th scope="col">시간</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for( $i=10000; $i<=240000; $i+=10000)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="P_{{ $i }}" name="P[]" value="{{ $i }}" @if( in_array($i,$data['P']) ) checked="checked" @endif>
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
                        </form>

                    </div>

            </div>
        </div>
        <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
            <img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
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



    <div class="modal fade" id="standardProductModal" tabindex="-3" aria-labelledby="standardProductModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="standardProductModalLabel">좌석정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 text-center">
                        은하표준상품으로 적용하시겠습니까?
                    </div>
                    
                    <div class="col-12 text-center">
                        <button type="button" id="btn_setStandardProductConfirm" class="btn btn-warning px-5">적용하기</button>
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


@section('javascript')

<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("click","#btn_setStandardProduct", function(){
            $("#standardProductModal").modal("show");
        });

        $(document).on("click","#btn_setStandardProductConfirm", function(){
            getStandardProduct();
        });
    });   


    function getStandardProduct(){

        var form = $('#productsForm')[0];
        var formData = new FormData(form);
        var url = '/setting/product/getStandardProduct'
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
                        document.location.reload();
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

    function formcheck(){

        var form = $('#productsForm')[0];
        var formData = new FormData(form);
        var url = '/setting/product/update'
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

