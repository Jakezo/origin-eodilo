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

            <div class="row row-cols-1 row-cols-lg-3" style="font-size:0.8rem">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="mb-0">현재좌석이용건수</p>
                                    <h5 class="font-weight-bold"><span id="count_used">200</span><span style="font-size:0.7em">/<span id="count_seat">300</span>좌석</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-2">
                                    <p class="mb-0">금일 모바일 이용건수</p>
                                    <h5 class="font-weight-bold"><span id="count_today_mobile">23</span>건<span style="font-size:0.7em">/<span id="count_today_all">300</span>건</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-4">
                                    <p class="mb-0">금일 모바일 매출</p>
                                    <h5 class="font-weight-bold">163,352원</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card radius-10">
                        <div class="card-header border-bottom-0 bg-transparent">
                            <div class="d-lg-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-bold mb-2 mb-lg-0">배치도</h6>
                                    <span id="wlog"></span>
                                </div>
                                <div class="ms-lg-auto mb-2 mb-lg-0">
                                    <div class="btn-group-round">
                                        <div class="btn-group">
                                            <a href="/setting/map/editor" target="_blank" class="btn btn-warning px-2 btn-sm">배치도편집</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="height:600px;">
                            <div class="card">

                                    <div id="page">

                                        <link rel="stylesheet" href="/assets/plugins/seat_editor/css/jlayout.css">
                                        <input type="hidden" name="no" id="no" value="{{ $no ?? "" }}?>">
                                        <div id="room_bg" bg="{{ $map['m_bg'] ?? ""}}" class="col-sm-8" style="background-size:cover;background-position: left;background-repeat:no-repeat;background-image:url({{ $map['m_bg'] ?? ""}});width:{{ $map['m_width'] ?? 800 }}px;height:{{ $map['m_width'] ?? 600 }}px;border:1px solid #cbc7c7;">

                                        </div>
                                        <div class="guide_txt" style="display:none;">좌석을 추가하시려면 좌석관리에서 등록해주셔야 합니다.</div>
        
                                    </div>

                            </div>
                            
                        </div>

                    </div>
                </div>
                <!--div class="col-12 col-lg-3">
                    @if( $rooms )
                    @foreach( $rooms as $ri => $room )
                    <div class="col cursor-pointer" data-toggle="popover" title="안내" data-content="클릭시 왼쪽 배치도에 해당 룸이 나타남">
                        <div class="card radius-10 overflow-hidden bg-gradient-moonlit">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-white">룸 {{ $room['r_name'] }}</p>
                                        <h3 class="mb-0 text-white">11/<span style="font-size:14pt;">21</span></h3>
                                    </div>
                                    <div class="ms-auto text-white"><i class='bx bx-chat font-30'></i>
                                    </div>
                                </div>
                                <div class="progress  bg-white-2 radius-10 mt-4" style="height:4.5px;">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 66%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif                    

                </div-->
            </div>
            <!--end row-->
              
        </div>
    </div>
    <!--end page wrapper -->
@endsection


@section('javascript')

<script src="/assets/plugins/seat_editor/js/jquery.resize.js"></script>
<script src="/assets/plugins/seat_editor/js/jlayout.js"></script>
<script src="/assets/plugins/seat_editor/js/jlayoutViewer.js"></script>

<!--script src="/assets/plugins/seat_editor/js/jlayoutMapEditor.js"></script-->
<script>

        $(document).ready(function(){

            $(document).on("click",".shape", function(){
                let seat_no = $(this).attr("seat");
                console.log("선택한 좌석"+seat_no);                
                if( seat_no!= undefined  && seat_no > 0 ) {
                    $("#seatReservFormModal").modal("show");
                }
            });

            //setting_map( "fix" );
            load_view_map(mode, room);
        });

        function mapping_SeatInfo(seat_idx,seat_name){
            obj_arr[select_index].seat_idx = seat_idx;
            obj_arr[select_index].seat_name = seat_name;
            rename_shape(select_index, seat_name);
            console.log(seat_idx,seat_name);
        }


        // 좌석상태 ==== 이건 좌석상태 업데이트 못함......
        function get_SeatState(){
                console.log("좌석상태 가져오는 중...");
                $.ajax({
                    url: '/seatState',
                    type: 'get',
                    async: false,
                    beforeSend: function (xhr) {
                        //
                    },
                    //data: req,
                    success: function (res, textStatus, xhr) {
                        console.log("좌석상태");
                        console.log(res);
                       
                        res.rsvs.forEach(function( rsv, ri) {
                            console.log(rsv);
                            seat_status(rsv.rv_seat, 3);

                           // $("shape[seat='"+rsv.seat+"']").
                        });

                        if ( res.count_used != undefined ) {

                            // 현재사용중
                            $("#count_used").html(res.count_used);

                            // 총 좌석
                            $("#count_seat").html(res.count_seat);

                            // 금일 누적
                            $("#count_today_mobile").html(res.count_today_mobile);
                            $("#count_today_all").html(res.count_today_all);

                        }
                    }         

                });
        }

        var nIntervId;
        //get_SeatState(); // 요것도 일단 지원봄....
        nIntervId = setInterval(function()
        {
            //get_SeatState();
            SeatState(); //주기적 반복은 이걸로 바꿈...
        },10000);

        function stopGetSeatState() {
            clearInterval(nIntervId);
            // release our intervalID from the variable
            nIntervId = null; 
        }

</script>

@endsection
