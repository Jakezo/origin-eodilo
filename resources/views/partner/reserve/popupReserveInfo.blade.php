@extends('layouts.manager_popup')

@section('title', 'Page Title')

@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">예약정보</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">{{ $reserve["rv_member_name"] }}</li>
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

                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
    
                            <form action="" aria-label="{{ __('Register') }}" class="row g-3 form-horizontal" role="form" name="frm_member" id="frm_member">
                            {{csrf_field()}}
                            <input type="hidden" name="nextStep" id="nextStep" value="{{ $nextStep ?? '' }}">
                            <input type="hidden" name="no" id="no" value="{{ $member['no']  ?? '' }}">
    
    
                                <div class="col-md-6">
                                    <label for="name" class="form-label">이름</label>
                                    <div class="input-group member_name"> 
                                        {{ $reserve["rv_member_name"] }}
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <label for="sex" class="form-label">구분</label>
                                    <div class="input-group member_from"> 
                                        @if( $reserve["rv_member_from"] == "M") 
                                        모바일
                                        @else
                                        로컬회원
                                        @endif  
                                    </div>  
                                </div>
    
                                <div class="col-md-6">
                                    <label for="birth" class="form-label">좌석</label>
                                    <div class="input-group seat_name"> 
                                        {{ $seat['s_name'] }} 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">시간</label>
                                    <div class="input-group reserve_time"> 
                                        {{ substr($reserve['rv_sdate'],5,11) }} ~ {{ substr($reserve['rv_edate'],5,11) }} 
                                    </div>
                                </div>
    
                                <div class="col-12 alert alert-danger d-none" id="memberDetail_msg">
    
                                </div>
                                

                            </form>
    
                        </div>
                    </div>

                    <div class="row col-12 mt-4 mb-2">
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="open_extendTime('form')">연장</button>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="go_outSeat('form')">퇴실</button>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_changeTimeForm').removeClass('d-none');">시간</button>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_changeSeatForm').removeClass('d-none');ChangableSeats()">이동</button>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_MemoForm').removeClass('d-none');">메모</button>
                        </div>
                    </div>

                    <!-- 연장 -->
                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_extForm">
                        <div class="col-12">
                            <form action="" class="row g-3 form-horizontal" role="form" name="buy_form" id="buy_form">
                            {{csrf_field()}}                                    
                            <input type="hidden" name="rv" id="rv" value="{{ $reserve['rv_no'] }}">

                            <h6>연장가능시간(최대)</h6>
                            <div class="row mb-2">
                                <div class="col-8">
                                    <select id="extDuration" name="extDuration" class="form-control form-select-sm" onchange="open_extendTime('duration',this.value)">
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2" id="extTimeMsg">
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 d-none" id="extPayform">
                                <div class="row col-12 mb-2">
                                    <div class="col-4">결제요금</div>
                                    <div class="col-8">
                                        <input name="b_pay_money" id="b_pay_money" value="0" class="form-control form-control-sm mb-3 col-6" type="text" placeholder="총구매금액">
                                    </div>
                                </div>

                                <div class="row col-12 mb-2">
                                    <div class="col-4">결제</div>
                                    <div class="col-8">
                                        <select name="b_pay_kind" id="b_pay_kind" class="form-select form-select-sm mb-3">
                                            <option value="">결제방법</option>
                                            <option value="LCASH">현금</option>
                                            <option value="LCARD">카드</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-12 mb-2">
                                    <div class="col-4">결제여부</div>
                                    <div class="col-8">
                                        <select name="b_pay_state" id="b_pay_state" class="form-select form-select-sm mb-3">
                                            <option value="N">대기</option>
                                            <option value="Y">완료</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row col-12 mb-2" id="productDetail_msg">

                                </div>

                                <div class="row justify-content-center">
                                    <button type="button" id="btn_extTime_action" class="btn btn-primary col-5">확  인 </button>
                                </div>
                            </div>
                            </form> 
                        </div>
                    </div>

                    <!-- 시간변경 -->
                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_changeTimeForm">
                        <div class="col-12">
                            <h6>변경 가능시간</h6>
                            <form method="post" id="rForm">
                            {{csrf_field()}}                                    
                            <input type="hidden" name="rv" id="rv" value="{{ $reserve['rv_no'] }}">
                            <input type="hidden" name="b_edate" id="b_edate" value="{{ substr($reserve['rv_edate'],0,10) }}">
                            <input type="hidden" name="b_etime" id="b_etime" value="{{ substr($reserve['rv_edate'],11,8) }}">
                            <input type="hidden" name="b_duration" id="b_duration" value="{{ $reserve['rv_duration'] }}">
                            <input type="hidden" name="b_seat" id="b_seat" value="{{ $reserve['rv_seat'] }}">                            
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm datepicker" name="b_sdate" id="b_sdate" value="{{ substr($reserve['rv_sdate'],0,10) }}">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" name="b_stime" id="stime" value="{{ substr($reserve['rv_sdate'],11,8) }}">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-primary" id="btn_changeTime">변경하기</button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>사용신청한 시간만큼 변경가능하며, 그외의 경우는 취소후 다시 예약해주세요.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 d-none" id="msg_changeTime">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>

                    <!-- 좌석변경 -->
                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_changeSeatForm">
                        <div class="col-12">
                            <h6>변경 가능 좌석</h6>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <select class="form-control form-select-sm" id="newSeat" name="newSeat">
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-sm btn-primary" id="btn_changeSeatOk">자리이동하기</button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>잔여시간 1시간 미만은 좌석 변경이 불가능합니다.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 퇴실 -->
                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_outForm">
                        <div class="col-12">
                            <h6>현재시간부로 퇴실</h6>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <button type="button" class="btn btn-sm btn-primary" id="btn_out">퇴실하기</button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-success" id="refundInfo">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 메모 -->
                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_MemoForm">
                        <div class="col-12">
                            <h6>메모</h6>
                            <div class="col-12"><textarea id="seat_memo" name="seat_memo" class="form-control">{{ $reserve['rv_memo'] }}</textarea></div>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="button" id="btn_save_memo" class="btn btn-sm btn-primary">저장하기</button>
                        </div>
                    </div>                    

                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>






@endsection

@section('javascript')
<script>

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // 퇴실 버튼
    $(document).on("click","#btn_out",function(){
        go_outSeat("action");
    });    
    // 시간변경 버튼
    $(document).on("click","#btn_changeTime",function(){
        changeTime();
    });    
    //  좌석변경실행 버튼
    $(document).on("click","#btn_changeSeat",function(){
        ChangableSeats();
    });   
    //  좌석변경실행 버튼
    $(document).on("click","#btn_changeSeatOk",function(){
        changeSeatOk();
    });    
  
    //  좌석연장실행 버튼
    $(document).on("click","#btn_extTime_action",function(){
        var duration = $("#extDuration").val();
        if( duration != undefined && duration != '' ) {
            open_extendTime("action",duration);
        } else {
            var html = "시간을 선택해 주세요.";
            $("#extTimeMsg .alert").html(html).addClass("alert-danger").removeClass("alert-success");
            $("#extTimeMsg").removeClass("d-none");
        }

    }); 

    // 메모저장
    $(document).on("click","#btn_save_memo",function(){
        setUserResMemo($("#seat_memo").val());
    });


    open_reserveInfo();

});


</script>
<script>
    // 좌석정보얻기
    function open_reserveInfo(){

        var formData = new FormData();
        formData.append("rv", $("#rv").val());
        $.ajax({
            url: '/reserve/get_reserveInfo',
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {

            },
            success: function (res) {
                console.log(res.reserve);
                $(".member_name").html( res.reserve.rv_member_name );

                if( res.reserve.rv_member_from == "L" ) $(".member_from").html("가맹점회원");
                if( res.reserve.rv_member_from == "M" ) $(".member_from").html("모바일회원");

                $(".seat_name").html( res.seat.s_name );
                $(".reserve_time").html( res.reserve.rv_sdate + " ~ " + res.reserve.rv_edate );

            },
            error: function (xhr, textStatus, errorThrown) {
                $("#eventDetail_msg").html(xhr.responseJSON.message);
            }
        });
    }   

    function open_extendTime(mode,duration){

        $('#seatExt_extForm').removeClass('d-none');

        //$('.seatExt').addClass('d-none');
        $('#seatExt_outForm').addClass('d-none');


        if( mode == "action") {
            if( duration == undefined || duration == '' ) {
                $("#extTimeMsg .alert").html("기간을 선택해주세요.").removeClass("alert-danger").addClass("alert-success");
                $("#extTimeMsg").removeClass("d-none");
                return;
            } 
        }
        
        var req = "rv={{ $reserve['rv_no'] }}&mode="+mode;
        if( duration != undefined ) req += "&duration=" + duration;

        if( mode == 'action' ) {
            req += "&b_pay_money=" + $("#b_pay_money").val();
            req += "&b_pay_kind=" + $("#b_pay_kind").val();
            req += "&b_pay_state=" + $("#b_pay_state").val();
        }

        console.log(req);
        $.ajax({
            url: '/reserve/reserveExtendTime',
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {

            },
            data: req,
            success: function (res, textStatus, xhr) {
                console.log(res);
                if( res.result == true ) {

                    if( mode == "action" ) {

                        window.close();
                        //open_reserveInfo();
                    } else if( mode == "duration" ) {

                        var time_type_name = "시간";
                        if( res.times_type == "D" ) {
                            time_type_name = "일";
                        }
                        if( res.times_type == "T" ) {
                            time_type_name = "시간";
                        }

                        if( res.duration != undefined ) {
                            $("#b_pay_money").val(res.price);
                            var html = res.duration + "" + time_type_name + " 연장 금액 " + res.price + "입니다. ( " + res.price_msg + " )";
                            $("#extTimeMsg .alert").html(html).removeClass("alert-danger").addClass("alert-success");
                            $("#extTimeMsg").removeClass("d-none");
                            $("#extPayform").removeClass("d-none");
                        } else {
                            $("#extTimeMsg").addClass("d-none"); 
                        }
                    } else if( mode == "form" ) {
                        var time_type_name = "시간";
                        if( res.times_type == "D" ) {
                            time_type_name = "일";
                        }
                        if( res.times_type == "T" ) {
                            time_type_name = "시간";
                        }
                        $("#extDuration").empty();
                        var option = $('<option value="">기간을 선택해주세요.</option>');
                        $("#extDuration").append(option);
                        for( var i = 1; i <= res.times; i++) {
                            var option = $('<option value="'+i+'">'+i+''+time_type_name+'</option>');
                            $("#extDuration").append(option);
                        }
                    }
                } else {
 
                }
            },           
            error: function (xhr, textStatus, errorThrown) {
                $("#productDetail_msg").html(res.message);
                console.log('PUT error.');
            },
            complete: function (data) {
                $("#btn_productBuy").removeClass("disabled");
            }     
        });
    }  

    function go_outSeat(mode){
        $('.seatExt').addClass('d-none');
        $('#seatExt_outForm').removeClass('d-none');
        
        var req = "rv={{ $reserve['rv_no'] }}&mode="+mode;
        $.ajax({
            url: '/reserve/reserveRefundInfo',
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {

            },
            data: req,
            success: function (res, textStatus, xhr) {
                console.log(res);
                if( res.result == true ) {

                    if( mode == "action" ) {
                        open_reserveInfo();
                        openPopup("퇴실처리하였습니다.","callback_close()");
                        
                    } else if( mode == "form" ) {
                        var html  = '';
                        //html += '<div>총 예약시간 6시간</div>\n';
                        //html += '<div>총 이용시간 2시간</div>\n';
                        html += '<div>환불금액 '+res.PriceArr.refund_pirce+'</div>\n';// ( A 등급좌석, 성인, 연장금액 ) 이정보  추가필요함.
                        html += '<div>환불금액은 보유머니로 적립됩니다.</div>\n';
                        $("#refundInfo").html(html);                        
                    }
                } else {
                    $("#refundInfo").html(res.message);    
                }
            },           
            error: function (xhr, textStatus, errorThrown) {
                $("#productDetail_msg").html(res.message);
                console.log('PUT error.');
            },
            complete: function (data) {
                $("#btn_productBuy").removeClass("disabled");
            }     
        });
    }    

	function changeTime(){

            var req = $("#rForm").serialize();
            console.log(req);
            $.ajax({
                url: '/reserve/reserveChangeTimeOk',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                data: req,
                success: function (res) {
                    console.log(res);
                    if( res.result == true ) {
                        $("#msg_changeTime").find(".alert").html(res.message);
                        $("#msg_changeTime").find(".alert").removeClass("alert-danger").addClass("alert-success");
                        $("#msg_changeTime").removeClass("d-none");
                        opener.document.location.reload();
                        document.location.reload();

                    } else {
                        $("#msg_changeTime").find(".alert").html(res.message);
                        $("#msg_changeTime").find(".alert").removeClass("alert-success").addClass("alert-danger");
                        $("#msg_changeTime").removeClass("d-none");
                    }                 

                },
                error: function (xhr, textStatus, errorThrown) {
                    openPopup(xhr.responseJSON.message);
                    //$("#eventDetail_msg").html();
                }
            });

	}    

    // 변경가능성 및 가능좌석조회
	function ChangableSeats(mode){

        var req = $("#rForm").serialize();
        $.ajax({
            url: '/reserve/reserveChangeSeat',
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {

            },
            data: req,
            success: function (res) {
                console.log(res);
                if( res.result == true ) {

                    $("#newSeat").empty();

                    $.each(res.seats, function (index, seat) {
                        var option = $('<option value="'+seat.s_no+'">'+seat.s_name+'('+seat.r_name+')</option>');
                        $("#newSeat").append(option);
                    });

                } else {
                    openPopup(res.message);
                }                 

            },
            error: function (xhr, textStatus, errorThrown) {
                $("#eventDetail_msg").html(xhr.responseJSON.message);
            }
        });
    } 

    // 자리변경
	function changeSeatOk(){

        var formData = new FormData();
        formData.append("rv", $("#rv").val());
        formData.append("newSeat", $("#newSeat").val());
        $.ajax({
            url: '/reserve/reserveChangeSeatOk',
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {

            },
            success: function (res) {
                console.log(res);
                if( res.result == true ) {
                    document.location.href = '?rv=' + res.rv;
                    opener.document.location.reload();
                    //open_reserveInfo();
                } else {
                    $("#msg_changeTime").find(".alert").html(res.message);
                    $("#msg_changeTime").find(".alert").removeClass("alert-success").addClass("alert-danger");
                    $("#msg_changeTime").removeClass("d-none");
                }                 

            },
            error: function (xhr, textStatus, errorThrown) {
                $("#eventDetail_msg").html(xhr.responseJSON.message);
            }
        });
    }    

    // 메모저장
    function setUserResMemo(memo) {

        formData = new FormData();

        formData.append("rv", $("#rv").val());
        formData.append("memo",memo );

        $.ajax({
            url: '/reserve/setUserResMemo',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success: function (res, textStatus, xhr) {
                console.log(res);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(xhr.responseJSON.file);
                console.log(xhr.responseJSON.line);
                console.log(xhr.responseJSON.message);
            }
        });   
    }
</script>
@endsection