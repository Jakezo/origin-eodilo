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
                <div class="breadcrumb-title pe-3">룸/좌석관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">좌석등급설정</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger btn_manual" rel="7"><i class="lni lni-youtube"></i>도움말</button>
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

                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#seatLevelFormModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">등급명</th>
                                    <th scope="col" class="text-center">구분</th>
                                    <th scope="col" class="text-center">시간금액</th>
                                    <th scope="col" class="text-center">기간금액</th>
                                    <th scope="col" class="text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $seatlevels )
                                @foreach( $seatlevels as $ri => $seatlevel )
                                <tr>
                                    <td class="text-center">{{ $seatlevel->sl_name ?? '' }}</td>
                                    <td class="text-center">
                                        @if ( $seatlevel->sl_type == "A" )
                                            좌석
                                        @elseif ( $seatlevel->sl_type == "S" )
                                            스터디테이블
                                        @endif
                                    </td>
                                    <td class="text-center">@if( $seatlevel->sl_price_time_state ) <span class="btn btn-info btn-xs">등록됨</span> @else <span class="btn btn-danger btn-xs">미등록</span> @endif</td>
                                    <td class="text-center">@if( $seatlevel->sl_price_day_state ) <span class="btn btn-info btn-xs">등록됨</span> @else <span class="btn btn-danger btn-xs">미등록</span> @endif</td>
                                    <td class="text-center"><a href="javascript:;" class="btn btn-secondary btn-xs seatlevel_item" seatlevel="{{ $seatlevel->sl_no ?? 0 }}" data-bs-toggle="modal" data-bs-target="#seatLevelFormModal">관리</a></td>
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
                            {{ $seatlevels->appends($param)->links() }}
                        </div>

                    </div>



                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="seatLevelFormModal" tabindex="-3" aria-labelledby="seatLevelFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberRegModalLabel">좌석레벨정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#seatLevelInfo" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">기본정보</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#seatLevelPrice1" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-time font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">시간요금표</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#seatLevelPrice2" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-calendar font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">기간요금표</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="seatLevelInfo" role="tabpanel">
                            <form class="form-horizontal  g-3" role="form" name="frm_seatlevelInfo" id="frm_seatlevelInfo">
                                {{csrf_field()}}
                                <input type="hidden" name="no" class="sl_no" value="">

                                <!--div class="col-md-12">
                                    <div class="alert border-0 border-start border-5 border-primary alert-dismissible fade show">
                                        <div>등급명을 저장한후에 금액설정을 할 수 있습니다.</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div-->

                                <div class="col-md-12">
                                    <label for="name" class="form-label">좌석등급명</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="좌석등급명">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="typeA" value="A">
                                        <label class="form-check-label" for="typeA">좌석</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="typeS" value="S">
                                        <label class="form-check-label" for="typeS">스터디룸</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" id="btn_seatlevel_update" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 좌석등급을 삭제 <button type="button" id="btn_seatlevel_delete" class="btn btn-xs btn-secondary">삭제</button>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="seatLevelPrice1" role="tabpanel">

                            <div>
                                <div class="row col-12">
                                    <div class="col-8 text-brown font-18">1시간을 기준으로 요금표 만들기</div>
                                    <div class="col-4 text-right">
                                        <button class="btn btn-sm btn-info" id="btn_getStandard_time">은하표준금액선택</button>
                                    </div>
                                </div>
                                <form id="frm_seatlevel_price_time_form" name="frm_seatlevel_price_time_form">
                                {{csrf_field()}}        
                                <input type="hidden" name="no" class="sl_no">  
                                <input type="hidden" name="price_kind" value="time">                            
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-2 text-center">#</th>
                                        <th scope="col" class="col-3 text-center">합계</th>
                                        <th scope="col" class="col-3 text-center">독서실요금</th>
                                        <th scope="col" class="col-3 text-center">스터디룸요금</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">기본</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_time_student_A_t" name="seat_price[S][A][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_time_student_A_r" name="seat_price[S][A][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_time_student_A_s" name="seat_price[S][A][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_time_adult_A_t" name="seat_price[A][A][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_time_adult_A_r" name="seat_price[A][A][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_time_adult_A_s" name="seat_price[A][A][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">신규</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_time_student_N_t" name="seat_price[S][N][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_time_student_N_r" name="seat_price[S][N][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_time_student_N_s" name="seat_price[S][N][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_time_adult_N_t" name="seat_price[A][N][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_time_adult_N_r" name="seat_price[A][N][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_time_adult_N_s" name="seat_price[A][N][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">연장</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_time_student_X_t" name="seat_price[S][X][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_time_student_X_r" name="seat_price[S][X][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_time_student_X_s" name="seat_price[S][X][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_time_adult_X_t" name="seat_price[A][X][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_time_adult_X_r" name="seat_price[A][X][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_time_adult_X_s" name="seat_price[A][X][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" colspan="2">1시간당 할인율</th>
                                        <td class=" text-center">
                                            <input type="number" class="col-12 mb-2" id="rate_time_student" name="rate_time_student" value="" placeholder="학생할인율">
                                            <input type="number" class="col-12 mb-2" id="rate_time_adult" name="rate_time_adult" value="" placeholder="성인할인율">
                                        </td>
                                        <td class=" text-center"></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="row justify-content-center my-3">
                                    <button type="button" id="btn_price_time_make" class="btn btn-primary col-5">생성</button>
                                </div>

                                </form>

                                <form id="frm_seatlevel_price_time_save_form" name="frm_seatlevel_price_time_save_form">
                                <input type="hidden" name="no" class="sl_no">   
                                <input type="hidden" name="price_kind" value="time">    
                                {{csrf_field()}}                                    
                                <div id="seatlevelPriceTime_msg">

                                </div>

                                <div class="row justify-content-center my-3">
                                    <button type="button" id="btn_price_day_save" class="btn btn-primary col-5">저장</button>
                                </div>
                                </form>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="seatLevelPrice2" role="tabpanel">
                            <div>
                                <div class="row col-12">
                                    <div class="col-8 text-brown font-18">1일을 기준으로 요금표 만들기</div>
                                    <div class="col-4 text-right">
                                        <button class="btn btn-sm btn-info" id="btn_getStandard_day">은하표준금액선택</button>
                                    </div>
                                </div>
                                <form id="frm_seatlevel_price_day_form" name="frm_seatlevel_price_day_form">
                                {{csrf_field()}}        
                                <input type="hidden" name="no" class="sl_no">  
                                <input type="hidden" name="price_kind" value="day">                            
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-2 text-center">#</th>
                                        <th scope="col" class="col-3 text-center">합계</th>
                                        <th scope="col" class="col-3 text-center">독서실요금</th>
                                        <th scope="col" class="col-3 text-center">스터디룸요금</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">기본</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_day_student_A_t" name="seat_price[S][A][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_day_student_A_r" name="seat_price[S][A][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_day_student_A_s" name="seat_price[S][A][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_day_adult_A_t" name="seat_price[A][A][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_day_adult_A_r" name="seat_price[A][A][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_day_adult_A_s" name="seat_price[A][A][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">신규</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_day_student_N_t" name="seat_price[S][N][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_day_student_N_r" name="seat_price[S][N][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_day_student_N_s" name="seat_price[S][N][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_day_adult_N_t" name="seat_price[A][N][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_day_adult_N_r" name="seat_price[A][N][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_day_adult_N_s" name="seat_price[A][N][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">연장</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_day_student_X_t" name="seat_price[S][X][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_day_student_X_r" name="seat_price[S][X][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_day_student_X_s" name="seat_price[S][X][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_day_adult_X_t" name="seat_price[A][X][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_day_adult_X_r" name="seat_price[A][X][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_day_adult_X_s" name="seat_price[A][X][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="2">1일당 할인율</th>
                                        <td class=" text-center">
                                            <input type="number" class="in_price student rseatlevel col-12 mb-2" id="rate_day_student" name="rate_day_student" value="" placeholder="학생할인율">
                                            <input type="number" class="in_price student sseatlevel col-12 mb-2" id="rate_day_adult" name="rate_day_adult" value="" placeholder="성인할인율">
                                        </td>
                                        <td class=" text-center"></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="row justify-content-center my-3">
                                    <button type="button" id="btn_price_day_make" class="btn btn-primary col-5">생성</button>
                                </div>

                                </form>

                                <form id="frm_seatlevel_price_day_save_form" name="frm_seatlevel_price_day_save_form">
                                <input type="hidden" name="no" class="sl_no">   
                                <input type="hidden" name="price_kind" value="day"> 
                                {{csrf_field()}}                                    
                                <div id="seatlevelPriceDay_msg">

                                </div>

                                <div class="row justify-content-center my-3">
                                    <button type="button" id="btn_price_day_save" class="btn btn-primary col-5">저장</button>
                                </div>
                                </form>
                            </div>
                        </div>
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

            $(document).on("click", ".seatlevel_item", function () {
                var r_no = $(this).attr("seatlevel");
                seatlevel_getInfo(r_no);
                console.log(r_no);
            });
            $(document).on("click", "#btn_seatlevel_update", function () {
                seatlevel_update();
            });
            $(document).on("click", "#btn_seatlevel_delete", function () {
                if (confirm("삭제하시겠습니까?") == true) {
                    seatlevel_delete();
                }
            });


            $(document).on("keyup change", ".in_price.total",  function(){
                let row = $(this).closest(".price_row");
                let price_total = row.find(".total").val();
                let price_rroom = ( row.find(".rseatlevel").val() ) ? row.find(".rseatlevel").val() : null;;
                let price_sroom = ( row.find(".sseatlevel") )  ? row.find(".sseatlevel").val() : null;
                console.log(price_total,price_rroom,price_sroom);

                if( row.find(".rseatlevel") && row.find(".sseatlevel") ) {
                    if( price_sroom == "" ) {
                        price_rroom = price_total;
                        row.find(".rseatlevel").val(price_rroom);
                    } else {
                        price_sroom = price_total - price_rroom;
                        row.find(".sseatlevel").val(price_sroom);
                    }
                } else if( price_rroom != null ) {
                    price_rroom = price_total;
                    row.find(".rseatlevel").val(price_rroom);
                } else if( price_sroom != null ) {
                    price_sroom = price_total;
                    row.find(".sseatlevel").val(price_sroom);
                }

                row.find(".total").val(price_total);                
                
                /*
                let row = $(this).closest(".price_row");
                let price_total = row.find(".total").val();
                let price_rroom = ( row.find(".rroom").val() ) ? row.find(".rroom").val() : null;;
                let price_sroom = ( row.find(".sroom") )  ? row.find(".sroom").val() : null;
                console.log(price_total,price_rroom,price_sroom);

                if( row.find(".rroom") && row.find(".sroom") ) {
                    if( price_sroom == "" ) {
                        price_rroom = price_total;
                        row.find(".rroom").val(price_rroom);
                    } else {
                        price_sroom = price_total - price_rroom;
                        row.find(".sroom").val(price_sroom);
                    }
                } else if( price_rroom != null ) {
                    price_rroom = price_total;
                    row.find(".rroom").val(price_rroom);
                } else if( price_sroom != null ) {
                    price_sroom = price_total;
                    row.find(".sroom").val(price_sroom);
                }

                row.find(".total").val(price_total);
                */
            });

            $(".in_price.rseatlevel").on("change keydown keyup", function(){
                let row = $(this).closest(".price_row");
                let price_total = row.find(".total").val();
                let price_rroom = ( row.find(".rseatlevel").val() ) ? row.find(".rseatlevel").val() : null;;
                let price_sroom = ( row.find(".sseatlevel") )  ? row.find(".sseatlevel").val() : null;
                console.log(price_total,price_rroom,price_sroom);
                if( row.find(".sseatlevel") ) {
                    price_sroom = price_total - price_rroom;
                    row.find(".sseatlevel").val(price_sroom);
                } else {
                    price_total = price_rroom;
                    row.find(".total").val(price_total);
                }
            });
        
            $(".in_price.sseatlevel").on("change keydown keyup", function(){
                let row = $(this).closest(".price_row");
                let price_total = row.find(".total").val();
                let price_rroom = ( row.find(".rseatlevel").val() ) ? row.find(".rseatlevel").val() : null;;
                let price_sroom = ( row.find(".sseatlevel") )  ? row.find(".sseatlevel").val() : null;
                console.log(price_total,price_rroom,price_sroom);
                if( row.find(".rseatlevel") ) {
                    price_rroom = price_total - price_sroom;
                    row.find(".rseatlevel").val(price_rroom);
                } else {
                    price_total = price_sroom;
                    row.find(".total").val(price_total);
                }
            });
            
            
            // 금액관련
            $(document).on("click", "#btn_price_time_make", function () {
                seatlevel_price_make("time");
            });

            // 저장
            $(document).on("click", "#btn_price_time_save", function () {
                seatlevel_price_save("time");
            });

            // 금액관련
            $(document).on("click", "#btn_price_day_make", function () {
                seatlevel_price_make("day");
            });

            // 저장
            $(document).on("click", "#btn_price_day_save", function () {
                seatlevel_price_save("day");
            });

            $(document).on("click", "#btn_getStandard_time", function () {
                getStandardPrice('time');
            });
            $(document).on("click", "#btn_getStandard_day", function () {
                getStandardPrice('day');
            });

            $('#seatlevelFormModal').on('show.bs.modal', function (e) {

            });

        });

        function getStandardPrice(mode) {
            $.ajax({
                url: '/setting/seat_level/getStandardPrice',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatlevelDetail_msg").html("");
                },
                //data: req,
                success: function (res, textStatus, xhr) {

                    console.log(mode);
                    console.log(res);
                    if( mode == "time" ) {
                        $("#price_time_adult_A_t").val( res.data.sl_price_time['A']['A']['T'] );
                        $("#price_time_adult_A_r").val( res.data.sl_price_time['A']['A']['R'] );
                        $("#price_time_adult_A_s").val( res.data.sl_price_time['A']['A']['S'] );  

                        $("#price_time_student_A_t").val( res.data.sl_price_time['S']['A']['T'] );
                        $("#price_time_student_A_r").val( res.data.sl_price_time['S']['A']['R'] );
                        $("#price_time_student_A_s").val( res.data.sl_price_time['S']['A']['S'] ); 

                        $("#price_time_adult_N_t").val( res.data.sl_price_time['A']['N']['T'] );
                        $("#price_time_adult_N_r").val( res.data.sl_price_time['A']['N']['R'] );
                        $("#price_time_adult_N_s").val( res.data.sl_price_time['A']['N']['S'] );  

                        $("#price_time_student_N_t").val( res.data.sl_price_time['S']['N']['T'] );
                        $("#price_time_student_N_r").val( res.data.sl_price_time['S']['N']['R'] );
                        $("#price_time_student_N_s").val( res.data.sl_price_time['S']['N']['S'] );  

                        $("#price_time_adult_X_t").val( res.data.sl_price_time['A']['X']['T'] );
                        $("#price_time_adult_X_r").val( res.data.sl_price_time['A']['X']['R'] );
                        $("#price_time_adult_X_s").val( res.data.sl_price_time['A']['X']['S'] );  

                        $("#price_time_student_X_t").val( res.data.sl_price_time['S']['X']['T'] );
                        $("#price_time_student_X_r").val( res.data.sl_price_time['S']['X']['R'] );
                        $("#price_time_student_X_s").val( res.data.sl_price_time['S']['X']['S'] );       
                        
                        $("#rate_time_student").val( res.data.sl_rate_student_time );
                        $("#rate_time_adult").val( res.data.sl_rate_adult_time );
                    }

                    if( mode == "day" ) {
                        $("#price_day_adult_A_t").val( res.data.sl_price_day['A']['A']['T'] );
                        $("#price_day_adult_A_r").val( res.data.sl_price_day['A']['A']['R'] );
                        $("#price_day_adult_A_s").val( res.data.sl_price_day['A']['A']['S'] );  

                        $("#price_day_student_A_t").val( res.data.sl_price_day['S']['A']['T'] );
                        $("#price_day_student_A_r").val( res.data.sl_price_day['S']['A']['R'] );
                        $("#price_day_student_A_s").val( res.data.sl_price_day['S']['A']['S'] ); 

                        $("#price_day_adult_N_t").val( res.data.sl_price_day['A']['N']['T'] );
                        $("#price_day_adult_N_r").val( res.data.sl_price_day['A']['N']['R'] );
                        $("#price_day_adult_N_s").val( res.data.sl_price_day['A']['N']['S'] );  

                        $("#price_day_student_N_t").val( res.data.sl_price_day['S']['N']['T'] );
                        $("#price_day_student_N_r").val( res.data.sl_price_day['S']['N']['R'] );
                        $("#price_day_student_N_s").val( res.data.sl_price_day['S']['N']['S'] );  

                        $("#price_day_adult_X_t").val( res.data.sl_price_day['A']['X']['T'] );
                        $("#price_day_adult_X_r").val( res.data.sl_price_day['A']['X']['R'] );
                        $("#price_day_adult_X_s").val( res.data.sl_price_day['A']['X']['S'] );  

                        $("#price_day_student_X_t").val( res.data.sl_price_day['S']['X']['T'] );
                        $("#price_day_student_X_r").val( res.data.sl_price_day['S']['X']['R'] );
                        $("#price_day_student_X_s").val( res.data.sl_price_day['S']['X']['S'] );  

                        $("#rate_day_student").val( res.data.sl_rate_student_day );
                        $("#rate_day_adult").val( res.data.sl_rate_adult_day );                
                    }

                    
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }


        function seatlevel_update() {
            var req = $("#frm_seatlevelInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/seat_level/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatlevelDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);

                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#seatlevelDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#seatlevelDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function seatlevel_delete() {
            var req = $("#frm_seatlevelInfo").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/seat_level/delete',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatlevelDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#seatlevelDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function seatlevel_getInfo(no) {
            var req = "no=" + no;
            console.log(req)
            $.ajax({
                url: '/setting/seat_level/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatlevelDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.seatlevel != null) {
                        $(".sl_no").val(res.seatlevel.no);
                        //$("#aid").val(res.seatlevel.id).attr("readonly", true);
                        $("#name").val(res.seatlevel.name);
                        $("#type"+res.seatlevel.type).prop("checked","checked");
                        $("#state").val(res.seatlevel.state);
                        $("#sex").val(res.seatlevel.sex);
                        view_price_detail( "time", JSON.parse(res.seatlevel.price_time) );
                        view_price_detail( "day", JSON.parse(res.seatlevel.price_day) );
                    } else {
                        $("#seatlevelDetail_msg").html(res.message);
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        function seatlevel_price_make(price_kind) {
            console.log("모드:"+price_kind);
            if( price_kind == "time" ) {
                var req = $("#frm_seatlevel_price_time_form").serialize();
            } else if( price_kind == "day" ) {
                var req = $("#frm_seatlevel_price_day_form").serialize();
            } else {
                alert("구분이 선택되지 않았습니다.");
                return false;
            }

            console.log(req);
            $.ajax({
                url: '/setting/seat_level/price_make',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    if( price_kind == "time" ) {
                        $("#seatlevelPriceTime_msg").html("생성중.....");
                    } else if( price_kind == "day" ) {
                        $("#seatlevelPriceDay_msg").html("생성중.....");
                    } 
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);

                    if (res.result == true) {

                        if( price_kind == "time" ) {
                            view_price_detail("time",res.price);
                        } else if( price_kind == "day" ) {
                            view_price_detail("day", res.price);
                        } 

                    } else {
                        $("#seatlevelPriceTime_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#seatlevelPriceTime_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function view_price_detail(price_kind, price) {
            
            if( price  == "" || price== null ) {
                if( price_kind == "time") {
                    $("#seatlevelPriceTime_msg").html("정보가 존재하지 않습니다.");    
                } 
                if( price_kind == "day") {
                    $("#seatlevelPriceDay_msg").html("정보가 존재하지 않습니다.");  
                }
            }
            for( var i = 1; i <= 23; i++ ) {

                if( price[i] == null ) {
                    price[i] = [];
                }

                console.log(price[i]);
                var html = '';
                html +=  '<table class="table mb-0">';
                html +=  '    <tbody>';
                html +=  '    <tr>';
                html +=  '        <th scope="row" colspan="3">'+i+'시간금액</th>';
                html +=  '    </tr>';                                
                html +=  '    <tr>';
                html +=  '        <th scope="row" rowspan="2">기본</th>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_A_t" name="seat_price['+i+'][S][A][T]" value="'+price[i]['S']['A']['T']+'" placeholder="학생 요금"></td>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_student_A_r" name="seat_price['+i+'][S][A][R]" value="'+price[i]['S']['A']['R']+'" placeholder="학생 독서실요금"></td>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_student_A_s" name="seat_price['+i+'][S][A][S]" value="'+price[i]['S']['A']['S']+'" placeholder="학생 스터디룸 요금"></td>';
                html +=  '    </tr>';
                html +=  '    <tr>';
                html +=  '        <td><input type="number" class="in_price adult total col-12" id="price_adult_A_t" name="seat_price['+i+'][A][A][T]" value="'+price[i]['A']['A']['T']+'" placeholder="성인 요금"></td>';
                html +=  '        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_adult_A_r" name="seat_price['+i+'][A][A][R]" value="'+price[i]['A']['A']['R']+'" placeholder="성인 독서실요금"></td>';
                html +=  '        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_adult_A_s" name="seat_price['+i+'][A][A][S]" value="'+price[i]['A']['A']['S']+'" placeholder="성인 스터디룸 요금"></td>';
                html +=  '    </tr>';
                html +=  '    <tr>';
                html +=  '        <th scope="row" rowspan="2">신규</th>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_N_t" name="seat_price['+i+'][S][N][T]" value="'+price[i]['S']['N']['T']+'" placeholder="학생 요금"></td>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_student_N_r" name="seat_price['+i+'][S][N][R]" value="'+price[i]['S']['N']['R']+'" placeholder="학생 독서실요금"></td>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_student_N_s" name="seat_price['+i+'][S][N][S]" value="'+price[i]['S']['N']['S']+'" placeholder="학생 스터디룸 요금"></td>';
                html +=  '    </tr>';
                html +=  '    <tr>';
                html +=  '        <td><input type="number" class="in_price adult total col-12" id="price_adult_N_t" name="seat_price['+i+'][A][N][T]" value="'+price[i]['A']['N']['T']+'" placeholder="성인 요금"></td>';
                html +=  '        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_adult_N_r" name="seat_price['+i+'][A][N][R]" value="'+price[i]['A']['N']['R']+'" placeholder="성인 독서실요금"></td>';
                html +=  '        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_adult_N_s" name="seat_price['+i+'][A][N][S]" value="'+price[i]['A']['N']['S']+'" placeholder="성인 스터디룸 요금"></td>';
                html +=  '    </tr>';
                html +=  '    <tr>';
                html +=  '        <th scope="row" rowspan="2">연장</th>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_X_t" name="seat_price['+i+'][S][X][T]" value="'+price[i]['S']['X']['T']+'" placeholder="학생 요금"></td>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_student_X_r" name="seat_price['+i+'][S][X][R]" value="'+price[i]['S']['X']['R']+'" placeholder="학생 독서실요금"></td>';
                html +=  '        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_student_X_s" name="seat_price['+i+'][S][X][S]" value="'+price[i]['S']['X']['S']+'" placeholder="학생 스터디룸 요금"></td>';
                html +=  '    </tr>';
                html +=  '    <tr>';
                html +=  '        <td><input type="number" class="in_price adult total col-12" id="price_adult_X_t" name="seat_price['+i+'][A][X][T]" value="'+price[i]['A']['X']['T']+'" placeholder="성인 요금"></td>';
                html +=  '        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_adult_X_r" name="seat_price['+i+'][A][X][R]" value="'+price[i]['A']['X']['R']+'" placeholder="성인 독서실요금"></td>';
                html +=  '        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_adult_X_s" name="seat_price['+i+'][A][X][S]" value="'+price[i]['A']['X']['S']+'" placeholder="성인 스터디룸 요금"></td>';
                html +=  '    </tr>';
                html +=  '    </tbody>';
                html +=  '</table>';

                if( price_kind == "time") {
                    $("#seatlevelPriceTime_msg").append( html );    
                } 
                if( price_kind == "day") {
                    $("#seatlevelPriceDay_msg").append( html );  
                }
            }
        }
        

        function seatlevel_price_save(mode) {
            if( mode == "time" ) var req = $("#frm_seatlevel_price_time_save_form").serialize();
            if( mode == "day" ) var req = $("#frm_seatlevel_price_day_save_form").serialize();
            console.log(req);
            $.ajax({
                url: '/setting/seat_level/price_save',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    //$("#seatlevelPriceTime_msg").html(".....");
                },
                data: req,
                success: function (res, textStatus, xhr) {

                    console.log(res);

                    if (res.result == true) {
                        $("#seatlevelPriceTime_msg").append("저장이 완료되었습니다.");                    
                        //document.location.reload();
                    } else {
                        $("#seatlevelPriceTime_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#seatlevelPriceTime_msg").html(xhr.responseJSON.message);
                }
            });
        }
    </script>


@endsection


