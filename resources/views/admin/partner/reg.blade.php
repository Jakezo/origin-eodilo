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
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">가맹점연장내역</li>
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
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>가맹점명</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#regFormModal">신규작성</a>
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
                                    <th scope="col">가맹점</th>
                                    <th scope="col">기간</th>
                                    <th scope="col" class="text-center">결제방법</th>
                                    <th scope="col" class="text-center">연장금액</th>
                                    <th scope="col" class="text-center">일시</th>
                                    <th scope="col" class="text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $partner_regs )
                                @foreach( $partner_regs as $ri => $partner_reg )
                                <tr>
                                    <td scope="row" class="text-center">{{ (count($partner_regs)-$ri) }}</td>
                                    <td class="">{{ $partner_reg['p_name'] }}</td>
                                    <td>{{ $partner_reg['pr_sdate'] ?? '' }} ~ {{ $partner_reg['pr_edate'] ?? '' }}</td>
                                    <td class="text-center">
                                        @if( $partner_reg['pr_pay_kind'] == "B" )
                                        <span class="btn btn-xs btn-success">계좌이체</span>
                                        @elseif( $partner_reg['pr_pay_kind'] == "C" )
                                        <span class="btn btn-xs btn-info">카드결제</span>
                                        @else
                                        <span class="btn btn-xs btn-secondary">무료이용</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ number_format($partner_reg['pr_pay_money']) ?? 0 }} </td>
                                    <td class="text-center">{{ substr($partner_reg['created_at'],2,8) ?? '' }}</td>
                                    <td class="text-center"><button class="btn btn-xs btn-secondary reg_item" pr="{{ $partner_reg['pr_no'] }}">관리</button></td>
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
                            {{ $partner_regs->appends($param)->links() }}
                        </div>

                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>

    <div class="modal fade" id="regFormModal" tabindex="-2" aria-labelledby="regFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="regFormModalLabel">계약기간 연장</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" name="frm_reg" id="frm_reg">
                    {{csrf_field()}}
                    <input type="hidden" name="no" id="no" value="">
                    <input type="hidden" name="partner" id="partner" value="">
                    <input name="partner_name" id="partner_name" style="ime-mode:disabled;" class="input_partner form-control form-control-sm mb-3 col-6" type="text" placeholder="클릭하여 가맹점검색" aria-label=".form-control-sm example" data-bs-toggle="modal" data-bs-target="#partnerSearchModal" search_mode="reg">

                    <div class="col-xs-12 mt-3">
                        <input type="date" name="sdate" id="sdate" value="" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                    </div>
                    <div class="col-xs-12 mt-3 text-center">
                        <button type="button" class="btn btn-sm btn-secondary" onclick="get_date('Y', 1)">1년</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="get_date('Y', 2)">2년</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="get_date('M', 1)">1개월</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="get_date('M', 3)">3개월</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="get_date('M', 6)">6개월</button>
                    <div class="col-xs-12 mt-3">
                        <input type="text" name="edate" id="edate" value="" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                    </div>

                    <div class="col-xs-12 mt-3">
                        <select name="pay_kind" id="pay_kind" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option value="">연장결제방법</option>
                            <option value="B">온라인입금</option>
                            <option value="C">카드결제</option>
                        </select>
                    </div>

                    <div class="col-xs-12 mt-3">
                        <input type="number" name="pay_money" id="pay_money" value="0" placeholder="금액" class="form-control form-control-sm col-12">
                    </div>

                    <div class="col-xs-12 mt-3" id="regDetail_msg">

                    </div>

                    <div class="col-xs-12 mt-3 text-center">
                        <button type="button" class="btn btn-sm btn-primary" id="btn_reg_update">글작성</button>
                    </div>
                    </form>
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
            $(document).on("click", ".reg_item", function () {
                var pr_no = $(this).attr("pr");
                reg_getInfo(pr_no);
                console.log(pr_no);
            });
            $(document).on("click", "#btn_reg_update", function () {
                reg_update();
            });
            $(document).on("click", "#btn_reg_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    reg_delete();
                }
            });
            $('#regFormModal').on('show.bs.modal', function (e) {
                get_partners();
            });

        });

        function set_edate(dt){
            $("#edate").val(dt);
        }
        
        function get_date(t, v){

            let ymd = $("#sdate").val();

            if( ymd ) {
                let ymd_arr = ymd.split("-");
                let date = new Date(ymd_arr[0], ymd_arr[1]-1, ymd_arr[2]);

                if( t == "Y") {
                    date.setFullYear(date.getFullYear() + v);
                }
                if( t == "M") {
                    date.getMonth() + 1
                    date.setMonth(date.getMonth() + v);
                }
                date.setDate(date.getDate() - 1);

                let new_date = date.getFullYear() + "-" + ('0' + (date.getMonth() + 1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);
                set_edate(new_date);
            } else {
                alert("시작일을 입력하고 선택할 수 있습니다.");
            }

        }

        function get_partners() {
            var req = "";
            $.ajax({
                url: '/api/partner/get_list',
                type: 'get',
                async: true,
                beforeSend: function (xhr) {
                    $("#regDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.result == true) {
                        $('#partner option').remove();
                        res.partners.forEach(function(partner) {
                            $('#partner').append(option);
                            var option = $('<option value="'+partner.p_no+'">'+partner.p_name+'</option>');
                            $('#partner').append(option);
                        });
                    } else {
                        $("#regDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {

                    $("#regDetail_msg").html(xhr.responseJSON.message);

                }
            });
        }

        function reg_update() {
            var req = $("#frm_reg").serialize();
            $.ajax({
                url: '/partner/reg/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#regDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#regDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#regDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function reg_delete() {
            var req = $("#frm_event").serialize();
            console.log(req);
            $.ajax({
                url: '/partner/reg/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#regDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#regDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function reg_getInfo(no) {
            var req = "no=" + no;
            $.ajax({
                url: '/partner/reg/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#regDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.reg != null) {
                        $("#regFormModal #no").val(res.reg.pr_no);
                        //$("#aid").val(res.event.id).attr("readonly", true);
                        $("#regFormModal #partner").val(res.reg.pr_partner);
                        $("#regFormModal #partner_name").val(res.reg.p_name);
                        $("#regFormModal #sdate").val(res.reg.pr_sdate);
                        $("#regFormModal #edate").val(res.reg.pr_edate);
                        $("#regFormModal #pay_kind").val(res.reg.pr_pay_kind);
                        $("#regFormModal #pay_money").val(res.reg.pr_pay_money);
                        $("#regFormModal").modal("show");

                    } else {
                        $("#regDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }







        function partner_getInfo(no) {
            var req = "no=" + no;
                        console.log(req);
            $.ajax({
                url: '/api/partner/get_new_last_date',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#regDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                        $("#sdate").val(res.partner.new_dt);
                        //$("#pay_money").val(res.partner.pay_money);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }


    </script>


@endsection

