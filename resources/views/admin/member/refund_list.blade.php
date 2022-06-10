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
                <div class="breadcrumb-title pe-3">회원관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">환불신청관리</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="">
                                <div class='row'>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="refund" id="refund">
                                            <option value="">상태</option>
                                            <option value="N" @if( isset($param["refund"]) && $param["refund"] == 'N' ) selected @endif>충전</option>
                                            <option value="Y" @if( isset($param["refund"]) && $param["refund"] == 'Y' ) selected @endif>충전요청</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-md-1 col-sm-3 col-xs-12 mt-1">
                                        <input type="text" name="sdate" id="sdate" value="{{ $param["sdate"] }}" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-lg-2 col-md-1 col-sm-3 col-xs-12 mt-1">
                                        <input type="text" name="edate" id="edate" value="{{ $param["edate"] }}" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 mt-1">
                                        <div class="col-12">
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-d") }}');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-01") }}');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-01-01") }}');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-xs-6 mt-1">
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
                                    <th scope="col">날자</th>
                                    <th scope="col">상태</th>
                                    <th scope="col">사용자</th>
                                    <th scope="col">신청캐쉬</th>
                                    <th scope="col">환불금액</th>
                                    <th scope="col">계좌정보</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset( $refunds) )
                                @foreach( $refunds as $ci => $refund )
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ substr($refund['created_at'],5,11) }}</td>
                                    <td>
                                        @if( $refund['cr_refund'] == "Y" )
                                            <button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#boardQnaModal">완료</button>
                                        @elseif( $refund['cr_refund'] == "X" )
                                            <button class="btn btn-xs btn-warining" data-bs-toggle="modal" data-bs-target="#boardQnaModal">거절</button>
                                        @else
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">요청</button>                                            
                                        @endif  

                                    </td>
                                    <td>{{ $refund['name'] ?? $refund['nickname'] ?? $refund['email']}}</td>
                                    <td>{{ number_format($refund['cr_cash']) }}</td>
                                    <td>{{ number_format($refund['cr_money']) }}</td>
                                    <td>{{ $refund['cr_bank'] }}/{{ $refund['cr_bank_account'] }}</td>
                                    <td><button class="btn btn-xs btn-primary item" item="{{ $refund['cr_no'] }}" data-bs-toggle="modal" data-bs-target="#crFormModal">환불처리</button></td>
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
                            {{ $refunds->appends($param)->links() }}
                        </div>

                    </div>


                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="crFormModal" tabindex="-2" aria-labelledby="crFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crFormModalLabel">환불신청정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" enctype="multipart/form-data" role="form" name="frm_cr" id="frm_cr">
                        {{csrf_field()}}
                        <input type="hidden" name="no" id="no" value="">

    
                        <div class="col-xs-12 mt-3">
                            <input type="text" name="bank" id="bank" value="" placeholder="은행명" class="form-control form-control-sm col-12">
                        </div>
                        <div class="col-xs-12 mt-3">
                            <input type="text" name="bank_account" id="bank_account" value="" placeholder="계좌번호" class="form-control form-control-sm col-12">
                        </div>
    
                        <div class="col-xs-12 mt-3">
                            신청금액
                            <input type="text" name="cash" id="cash" value="" placeholder="신청금액" class="form-control form-control-sm col-12" disabled="disabled">
                        </div>

                        <div class="col-xs-12 mt-3 row">

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup">환불금액</span>
                                <input type="text" name="money" id="money" value="" placeholder="환불금액" class="form-control form-control-sm col-xs-6" aria-describedby="inputGroup">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="$('#money').val($('#cash').val())">전액</button>
                              </div>

                        </div>
    
                        <div class="col-xs-12 mt-3">
                            메모
                            <textarea name="memo" id="memo" class="form-control" style="height:100px;"></textarea>
                        </div>

                        <div class="form-group mt-2">
                            환불여부 / 날자

                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                  <input class="form-check-input mt-0" type="checkbox" name="refund" id="refund" value="Y" aria-label="환불여부">
                                </div>
                                <input type="date" name="refund_at" id="refund_at" class="form-control" aria-label="">
                              </div>
  
                        </div>
    
                        <div class="col-xs-12 mt-3" id="crDetail_msg">
    
                        </div>
    
    
                        <div class="col-xs-12 mt-3 text-center">
                            <button type="button" class="btn btn-sm btn-primary" id="btn_cr_update">저장</button>
                        </div>
                        </form>


                </div>
                <div class="modal-footer">

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
            $(document).on("click", ".item", function () {
                var cr_no = $(this).attr("item");
                cr_getInfo(cr_no);
                console.log(cr_no);
            });
            $(document).on("click", "#btn_cr_update", function () {
                cr_update();
            });
            $(document).on("click", "#btn_cr_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    cr_delete();
                }
            });

            $('#eventFormModal').on('show.bs.modal', function (e) {
                get_partners();
            });


        });

        function cr_update() {
            var form = $('#frm_cr')[0];
            var formData = new FormData(form);            
            $.ajax({
                url: '/member/refund/update',
                processData: false,
                contentType: false,
                data: formData,                
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#eventDetail_msg").html("");
                },
                data: formData,
                success: function (res, textStatus, xhr) {

                    console.log(res);
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#eventDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#eventDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }


        function cr_getInfo(no) {
            var req = "no=" + no;
            $.ajax({
                url: '/member/refund/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#eventDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.refund != null) {
                        $("#frm_cr #no").val(res.refund.cr_no);
                        $("#frm_cr #cash").val(res.refund.cr_cash);
                        $("#frm_cr #money").val(res.refund.cr_money);
                        $("#frm_cr #bank").val(res.refund.cr_bank);
                        $("#frm_cr #bank_account").val(res.refund.cr_bank_account);

                        if( res.refund.cr_refund == "Y" ) {
                            $("#frm_cr #refund").prop("checked",true).attr("disabled",true);
                        } else {
                            $("#frm_cr #refund").prop("checked",false).attr("disabled",false);
                        }

                        console.log(res.refund.cr_refund_at);
                        $("#frm_cr #refund_at").val(res.refund.cr_refund_at);

                    } else {
                        $("#eventDetail_msg").html(res.message);
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

