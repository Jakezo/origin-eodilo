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
                <div class="breadcrumb-title pe-3">정산</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">일일정산내역</li>
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
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <input type="text" name="sdate" id="sdate" value="{{ $param['sdate'] ?? '' }}" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <input type="text" name="edate" id="edate" value="{{ $param['edate'] ?? ''  }}" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                        <div class="col-12">
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-d") }}');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-01") }}');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-01-01") }}');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
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
                                    <th scope="col">정산일</th>
                                    <th scope="col">가맹점</th>
                                    <th scope="col">총사용건수</th>
                                    <th scope="col">총수익</th>
                                    <th scope="col">총수수료</th>
                                    <th scope="col">집계일시</th>
                                    <th scope="col">정산금액</th>
                                    <th scope="col">가맹점정산</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset( $culculates ) )
                                @foreach( $culculates as $ci => $culculate )
                                <tr>
                                    <td scope="row">{{ (count($culculates)-$ci) }}</td>
                                    <td>{{ $culculate['cal_date'] }}</td>
                                    <td><i class="bx bx-building"></i> {{ $culculate['p_name'] }}</td>
                                    <td class="text-right">{{ $culculate['cal_reserve_count'] }}</td>
                                    <td class="text-right">{{ number_format($culculate['cal_revenue']) }}</td>
                                    <td class="text-right">{{ number_format($culculate['cal_commission']) }}</td>
                                    <td class="text-right">{{ $culculate['created_at'] }}</td>
                                    <td class="text-right">{{ number_format($culculate['cal_revenue'] - $culculate['cal_commission']) }}</td>
                                    
                                    <td class="text-right">
                                        @if( $culculate['cal_status'] == "A" ) 
                                            <span class="btn btn-xs btn-danger btn_calculate" cal="{{ $culculate['cal_no'] }}">미정산</span>
                                        @elseif( $culculate['cal_status'] == "Y" ) 
                                            <span class="btn btn-xs btn-primary btn_calculate" cal="{{ $culculate['cal_no'] }}">정산완료</span>
                                        @else

                                        @endif
                                    </td>
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
                            {{ $culculates->appends($param)->links() }}
                        </div>                        
                    </div>



                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
  

    <div class="modal fade" id="calculateModal" tabindex="-2" aria-labelledby="calculateModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calculateModalLabel">정산정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" name="calc_form" id="calc_form">
                    {{csrf_field()}}
                    <input type="hidden" name="no" id="no" value="">
    
                    <div class="row col-12 mb-2  seatExt" id="seatExt_changeTimeForm">
                        <div class="col-12">
                            <h6 class="calculate_date">지급상태 변경</h6>
                            <div class="row mb-2">
                                <div class="col">
    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="st" id="stA" value="A">
                                        <label class="form-check-label" for="stA">미정산</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="st" id="stY" value="Y">
                                        <label class="form-check-label" for="stY">정산완료</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-primary" id="btn_update_calc">변경하기</button>
                                </div>
                            </div>
    
                            <div class="row mb-2 calculate_list">
                                
                             </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<script>
    var selected_cal = 0;
    function calculate_getInfo(no) {
        var req = "no=" + no;
        console.log(req);        
        $.ajax({
            url: '/calculate/getInfo',
            type: 'POST',                
            async: true,
            beforeSend: function (xhr) {

            },
            data: req,
            success: function (res, textStatus, xhr) {
                selected_cal = res.culculates.cal_no;

                $("#calc_form #no").val(selected_cal);

                var log = "총예약건수 : " + res.culculates.cal_reserve_count + "<br>";
                log += "수익금 : " + res.culculates.cal_revenue + "<br>";
                log += "수수료 : " + res.culculates.cal_commission + "<br>";

                if( res.culculates.cal_status == "A" )  {
                    $("#calc_form #stA").prop("checked", true);
                } else if( res.culculates.cal_status == "Y" )  {
                    $("#calc_form #stY").prop("checked", true);
                }
                $(".calculate_list").html(log);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }
    function calculate_update() {
        var req = $("#calc_form").serialize();
        $.ajax({
            url: '/calculate/update',
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {

            },
            data: req,
            success: function (res, textStatus, xhr) {
                console.log(res);
                if (res.result == true) {
                    document.location.reload();
                } else {

                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }

    $(document).ready(function(){
        $(document).on("click", ".btn_calculate",function(){
        
            var cal_no = $(this).attr('cal');        
            calculate_getInfo(cal_no);
            $("#calculateModal").modal("show");
            
        });

        $(document).on("click", "#btn_update_calc",function(){
                    calculate_update();
        });

        $('#calculateModal').on('show.bs.modal', function (event) {            
            var button = $(event.relatedTarget);            
            var deleteUrl = button.data('title');            
            var modal = $(this);                   
        })



    });
</script>  
@endsection