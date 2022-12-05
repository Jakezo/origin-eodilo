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
                            <a class="nav-link active" href="/partner/standard/price">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">좌석금액 기본세팅</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="/partner/standard/product">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">상품 기본세팅</div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <form id="frm_price_form" name="frm_price_form">
                    {{csrf_field()}}        
                    <input type="hidden" name="no" value="{{ $sl_no }}">  
                    <input type="hidden" name="price_kind" value="time">  

                    <div class="tab-content py-3">                          

                        <div class="col-lg-5 col-md-12">

                                <div class="row col-12">
                                    <h4>1시간 기준 금액 표준</h4>
                                </div>

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
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_time_student_A_t" name="seat_time_price[S][A][T]" value="{{  $sl_price_time['S']['A']['T'] }}" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_time_student_A_r" name="seat_time_price[S][A][R]" value="{{  $sl_price_time['S']['A']['R'] }}" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_time_student_A_s" name="seat_time_price[S][A][S]" value="{{  $sl_price_time['S']['A']['S'] }}" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_time_adult_A_t" name="seat_time_price[A][A][T]" value="{{  $sl_price_time['A']['A']['T'] }}" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_time_adult_A_r" name="seat_time_price[A][A][R]" value="{{  $sl_price_time['A']['A']['R'] }}" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_time_adult_A_s" name="seat_time_price[A][A][S]" value="{{  $sl_price_time['A']['A']['S'] }}" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">신규</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_time_student_N_t" name="seat_time_price[S][N][T]" value="{{  $sl_price_time['S']['N']['T'] }}" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_time_student_N_r" name="seat_time_price[S][N][R]" value="{{  $sl_price_time['S']['N']['R'] }}" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_time_student_N_s" name="seat_time_price[S][N][S]" value="{{  $sl_price_time['S']['N']['S'] }}" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_time_adult_N_t" name="seat_time_price[A][N][T]" value="{{  $sl_price_time['A']['N']['T'] }}" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_time_adult_N_r" name="seat_time_price[A][N][R]" value="{{  $sl_price_time['A']['N']['R'] }}" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_time_adult_N_s" name="seat_time_price[A][N][S]" value="{{  $sl_price_time['A']['N']['S'] }}" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">연장</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_time_student_X_t" name="seat_time_price[S][X][T]" value="{{  $sl_price_time['S']['X']['T'] }}" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_time_student_X_r" name="seat_time_price[S][X][R]" value="{{  $sl_price_time['S']['X']['R'] }}" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_time_student_X_s" name="seat_time_price[S][X][S]" value="{{  $sl_price_time['S']['X']['S'] }}" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_time_adult_X_t" name="seat_time_price[A][X][T]" value="{{  $sl_price_time['A']['X']['T'] }}" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_time_adult_X_r" name="seat_time_price[A][X][R]" value="{{  $sl_price_time['A']['X']['R'] }}" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_time_adult_X_s" name="seat_time_price[A][X][S]" value="{{  $sl_price_time['A']['X']['S'] }}" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" colspan="2">1시간당 할인율</th>
                                        <td class=" text-center">
                                            <input type="number" class="col-12 mb-2" id="rate_time_student" name="rate_time_student" value="{{  $sl_rate_student_time }}" placeholder="학생할인율">
                                            <input type="number" class="col-12 mb-2" id="rate_time_adult" name="rate_time_adult" value="{{  $sl_rate_adult_time }}" placeholder="성인할인율">
                                        </td>
                                        <td class=" text-center"></td>
                                    </tr>
                                    </tbody>
                                </table>
    
                        </div>

                        <div class="col-lg-5 col-md-12">

                                <div class="row col-12">
                                    <h4>1일 기준 금액 표준</h4>
                                </div>

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
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_day_student_A_t" name="seat_day_price[S][A][T]" value="{{  $sl_price_day['S']['A']['T'] }}" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_day_student_A_r" name="seat_day_price[S][A][R]" value="{{  $sl_price_day['S']['A']['R'] }}" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_day_student_A_s" name="seat_day_price[S][A][S]" value="{{  $sl_price_day['S']['A']['S'] }}" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_day_adult_A_t" name="seat_day_price[A][A][T]" value="{{  $sl_price_day['A']['A']['T'] }}" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_day_adult_A_r" name="seat_day_price[A][A][R]" value="{{  $sl_price_day['A']['A']['R'] }}" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_day_adult_A_s" name="seat_day_price[A][A][S]" value="{{  $sl_price_day['A']['A']['S'] }}" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">신규</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_day_student_N_t" name="seat_day_price[S][N][T]" value="{{  $sl_price_day['S']['N']['T'] }}" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_day_student_N_r" name="seat_day_price[S][N][R]" value="{{  $sl_price_day['S']['N']['R'] }}" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_day_student_N_s" name="seat_day_price[S][N][S]" value="{{  $sl_price_day['S']['N']['S'] }}" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_day_adult_N_t" name="seat_day_price[A][N][T]" value="{{  $sl_price_day['A']['N']['T'] }}" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_day_adult_N_r" name="seat_day_price[A][N][R]" value="{{  $sl_price_day['A']['N']['R'] }}" placeholder="성인 독서실요금"></td>
sl_price_day                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" rowspan="2">연장</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_day_student_X_t" name="seat_day_price[S][X][T]" value="{{  $sl_price_day['S']['X']['T'] }}" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rseatlevel col-12" id="price_day_student_X_r" name="seat_day_price[S][X][R]" value="{{  $sl_price_day['S']['X']['R'] }}" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sseatlevel col-12" id="price_day_student_X_s" name="seat_day_price[S][X][S]" value="{{  $sl_price_day['S']['X']['S'] }}" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <td><input type="number" class="in_price adult total col-12" id="price_day_adult_X_t" name="seat_day_price[A][X][T]" value="{{  $sl_price_day['A']['X']['T'] }}" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rseatlevel col-12" id="price_day_adult_X_r" name="seat_day_price[A][X][R]" value="{{  $sl_price_day['A']['X']['R'] }}" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sseatlevel col-12" id="price_day_adult_X_s" name="seat_day_price[A][X][S]" value="{{  $sl_price_day['A']['X']['S'] }}" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr class="price_row">
                                        <th scope="row" colspan="2">1시간당 할인율</th>
                                        <td class=" text-center">
                                            <input type="number" class="col-12 mb-2" id="rate_day_student" name="rate_day_student" value="{{  $sl_rate_student_day }}" placeholder="학생할인율">
                                            <input type="number" class="col-12 mb-2" id="rate_day_adult" name="rate_day_adult" value="{{  $sl_rate_adult_day }}" placeholder="성인할인율">
                                        </td>
                                        <td class=" text-center"></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="row justify-content-center my-3">
                                    <button type="button" id="btn_price_save" class="btn btn-primary col-5">저장</button>
                                </div>

                            </div>

                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--start overlay-->
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
            $(document).on("click", "#btn_price_save", function () {
                price_update();
            });


        });


        function price_update() {
            var req = $("#frm_price_form").serialize();
            console.log(req);

            $.ajax({
                url: '/partner/standard/price/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#seatlevelDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    document.location.reload();

                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#seatlevelDetail_msg").html(xhr.responseJSON.message);
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

                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#seatlevelPriceTime_msg").html(xhr.responseJSON.message);
                }
            });
        }

    </script>


@endsection