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
                <div class="breadcrumb-title pe-3">쿠폰관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">쿠폰목록</li>
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
                            <form name="search" action="?menu={{$menu ?? ''}}">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="state" id="state">
                                            <option value="" <?php if( isset($param['state']) && $param['state'] == "" ) {?> selected<?php }?>>전체</option>
                                            <option value="A" <?php if( isset($param['state']) && $param['state'] == "A" ) {?> selected<?php }?>>예정</option>
                                            <option value="I" <?php if( isset($param['state']) && $param['state'] == "I" ) {?> selected<?php }?>>진행</option>
                                            <option value="E" <?php if( isset($param['state']) && $param['state'] == "E" ) {?> selected<?php }?>>종료</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="" <?php if( !isset($param['fd']) && $param['fd'] == "" ) {?> selected<?php }?>>제목+내용</option>
                                            <option value="title" <?php if( isset($param['fd']) && $param['fd'] == "title" ) {?> selected<?php }?>>제목</option>
                                            <option value="cont" <?php if( isset($param['fd']) && $param['fd'] == "cont" ) {?> selected<?php }?>>내용</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? ''}}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#couponFormModal">신규작성</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                             <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">기간</th>
                                    <th scope="col" class="text-center">제목</th>
                                    <th scope="col" class="text-center">할인</th>
                                    <th scope="col" class="text-center">등록일시</th>
                                    <th scope="col" class="text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $coupons )
                                @foreach( $coupons as $ci => $coupon )
                                <tr>
                                    <th scope="row" class="text-center">{{ ($start - $ci) }}</th>
                                    <td>{{$coupon['c_sdate']}}~{{$coupon['c_edate']}}</td>
                                    <td class="text-center">{{$coupon['c_title']}}</td>
                                    <td class="text-center">@if($coupon['c_type'] == "P" ) {{$coupon['c_value']}}원
                                     @elseif($coupon['c_type'] == "R" ){{$coupon['c_value']}}% 
                                    @endif
                                    </td>
                                    <td class="text-center">{{$coupon['created_at']}}</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary coupon_item" coupon="{{ $coupon['c_no'] }}" data-bs-toggle="modal" data-bs-target="#couponFormModal">관리</button></td>
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
                            {{ $coupons->appends($param)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="couponFormModal" tabindex="-2" aria-labelledby="couponFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponFormModalLabel">이벤트</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="row g-3" name="partner_coupon" id="partner_coupon">
                {{csrf_field()}}
                <input type="hidden" name="no" id="no" value="">
                    <div class="col-xs-12 mt-3">
                        <input type="text" name="partnername" value="{{$partner['p_name']}}" placeholder="" class="form-control form-control-sm col-12" readonly>
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="sdate" id="sdate" value="" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="edate" id="edate" value="" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                    <select name="type" id="type" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option value="P">할인금액</option>
                            <option value="R">할인율</option>
                        </select>
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="value" id="value" value="" placeholder="금액/%" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="text" name="title" id="title" value="" placeholder="제목" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <textarea name="seat_memo" class="form-control"></textarea>
                    </div>

                    <div class="col-12 text-center text-danger" id="couponDetail_msg"></div>

                    <div class="col-xs-12 mt-3 text-center">
                        <button type="button" class="btn btn-sm btn-primary" id="btn_partner_coupon"> 확 인 </button>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_coupon_del" class="btn btn-warning d-none" data-bs-dismiss="modal">삭제</button>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('javascript')

<script>

        $(document).ready(function() {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", ".coupon_item", function () {
                        var e_no = $(this).attr("coupon");
                        partner_coupon_getInfo(e_no);
                        console.log(e_no);
                    });

                    $(document).on("click","#btn_partner_coupon",function(){
                        partner_coupon_update();
                    });
                    $(document).on("click","#btn_coupon_del",function(){
                        partner_coupon_delete();
                    });
            
            $('#couponFormModal').on('shown.bs.modal', function (e) {
                $("#btn_coupon_del").addClass("d-none");
            });

        });




        function partner_coupon_delete(){
            var req = $("#partner_coupon").serialize();
            $.ajax({
                url:'/coupon/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#couponDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if( res.result == true ) {
                    document.location.reload();
                    } else {
                        $("#couponDetail_msg").html( res.message );
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#couponDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }



    function partner_coupon_update(){
        var req = $("#partner_coupon").serialize();
        $.ajax({
            url:'/coupon/update',
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {
                $("#couponDetail_msg").html("");
            },
            data: req,
            success: function (res, textStatus, xhr) {
                console.log(res);
                if( res.result == true ) {
                document.location.reload();
                } else {
                    $("#couponDetail_msg").html( res.message );
                    console.log("실패.");
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                $("#couponDetail_msg").html(xhr.responseJSON.message);
            }
        });
    }

    function partner_coupon_getInfo(no) {
            var req = "no=" + no;
            console.log(req);
            $.ajax({
                url: '/coupon/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#couponDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);                    
                    if (res.coupon != null) {
                        $("#no").val(res.coupon.no);
                        //$("#aid").val(res.coupon.id).attr("readonly", true);
                        $("#sdate").val(res.coupon.sdate);
                        $("#edate").val(res.coupon.edate);
                        $("#value").val(res.coupon.value);
                        $("#title").val(res.coupon.title);
                        $("#cont").val(res.coupon.cont);
                        $("#type").val(res.coupon.type);

                        $("#btn_coupon_del").removeClass("d-none");

                    } else {
                        $("#couponDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }
</script>

@endsection