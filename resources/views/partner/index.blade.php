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
                                    <h5 class="font-weight-bold">200<span style="font-size:0.7em">/300좌석</span></h5>
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
                                    <h5 class="font-weight-bold">23건<span style="font-size:0.7em">/300건</span></h5>
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
                <div class="col-12 col-lg-9">
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
                                            룸선택
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
                                        <div id="room_bg" class="col-sm-8" style="width:100%;height:600px;border:1px solid #cbc7c7;">

                                        </div>
                                        <div class="guide_txt" style="display:none;">좌석을 추가하시려면 좌석관리에서 등록해주셔야 합니다.</div>
        
                                    </div>

                            </div>
                            


                            <div class="col-12  mb-5">
                                <a href="javaScript:;" class="btn btn-sm btn-outline-primary radius-2" data-bs-toggle="modal" data-bs-target="#seatStatusModal" style="width:100px;height:60px;"></a>
                                @if( $seats )
                                @foreach( $seats as $si => $seat )                                
                                <a href="javaScript:;" class="btn btn-sm btn-outline-primary radius-2 btn_seat" data-bs-toggle="modal" data-bs-target="#seatReservFormModal" seat="{{ $seat['s_no'] ?? "" }}" style="width:100px;height:60px;">{{ $seat['s_name'] ?? "" }}<br/>{{ $seat['s_no'] ?? "" }}</a>
                                @endforeach
                                @endif                                      

                                
                            </div>

                            <div class="col-12  mb-5">
                                <div class="alert alert-warning">
                                    <div>1번 좌석을 선택하면 현재 사용중인 상태를, 2번을 클릭하시면 입실처리 폼을 확인하실 수 있습니다.</div>
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
<script src="/assets/plugins/seat_editor/js/jlayoutEditor.js"></script>
<script>

        // function seat_getInfo(no) {
        //     var req = "no=" + no;
        //     console.log(req)
        //     $.ajax({
        //         url: '/setting/seat_level/getInfo',
        //         type: 'POST',
        //         async: true,
        //         beforeSend: function (xhr) {
        //             $("#seatDetail_msg").html("");
        //         },
        //         data: req,
        //         success: function (res, textStatus, xhr) {
        //             console.log(res);
        //             if (res.seat != null) {
        //                 $("#no").val(res.seat.no);
        //                 //$("#aid").val(res.seat.id).attr("readonly", true);
        //                 $("#name").val(res.seat.name);
        //                 $("#type"+res.seat.type).prop("checked","checked");
        //                 $("#state").val(res.seat.state);
        //                 $("#sex").val(res.seat.sex);
        //             } else {
        //                 $("#seatDetail_msg").html(res.message);
        //                 console.log("실패.");
        //             }
        //         },
        //         error: function (xhr, textStatus, errorThrown) {
        //             console.log('PUT error.');
        //         }
        //     });
        // }
        // function open_SeatInfo(){

        //     var idx = $("#idx").val();
        //     var room = $("#room").val();
        //     var url = "/SeatInfo/SeatInfo.php?room="+room+"&idx=" + idx;

        //     // 이미 seat_idx 가 있다면
        //     if( select_index != undefined &&  select_index != null ) {
        //         url += "&select_index="+select_index
        //     }
        //     window.open(url,'SeatInfo','width=900,height=500')

        // }

        function mapping_SeatInfo(seat_idx,seat_name){
            obj_arr[select_index].seat_idx = seat_idx;
            obj_arr[select_index].seat_name = seat_name;
            rename_shape(select_index, seat_name);
            console.log(seat_idx,seat_name);
        }

        $(document).ready(function(){

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $(document).on("click",".shape", function(){
                let seat_no = $(this).attr("seat");
                if( seat_no!= undefined  && seat_no > 0 ) {
                    $("#seatReservFormModal").modal("show");
                }
            });

            setting_map( "fix" );
        });


        // 좌석상태
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
                    }         

                });
        }

        let nIntervId;
        setInterval(function()
        {
            get_SeatState();
        },10000);

        function stopGetSeatState() {
            clearInterval(nIntervId);
            // release our intervalID from the variable
            nIntervId = null; 
        }

        

</script>

@endsection
