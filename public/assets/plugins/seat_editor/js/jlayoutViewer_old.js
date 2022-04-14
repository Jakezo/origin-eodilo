function reload_view_map(){
    load_view_map(mode)
};

function load_view_map(mode){
    obj_arr = [];

    // 로딩이미지

    $("#room_bg").hide();
    $("#room_bg").after('<div style="width:100%" class="loading"><img src="/assets/plugins/seat_editor/images/loading1.gif" style="width:50%;text-align:center"/></div>');

    if( mode != undefined && mode != "" ) jlayout.mode = mode

    var data = "mode=get&idx=" + idx + "&room=" + room;
    $.ajax({
        type: 'POST',
        async: false,
        url: 'http://boss.mypro.co.kr/SeatInfo/ajax_SeatInfo.php',
        data: data,
        success: function(res) {

            if( res.map_data != undefined ) {

                let map_data = JSON.parse(res.map_data);
                let imageSRC = map_data.bg.src;


                // 여기서 현재 roomBG의 사이즈 확인
                var roomWidth = map_data.bg.width;

                // 영역 너비 확인
                var targetWidth = $("#page").width();

                // 축소비율
                var zoomRate = Math.floor( (targetWidth / roomWidth ) * 100) / 100;
                if( zoomRate > 1 ) zoomRate = 1;

                //console.log("가로저장된영역:"+map_data.bg.width+"/현재영역:"+targetWidth + "/변경할 비율"+zoomRate);

                $("#room_bg").css({"background":"url(http://boss.mypro.co.kr"+res.path + ")", 'background-size' : 'contain',  'background-repeat' : 'no-repeat', 'background-position':'center center'});


                redraw_seat(map_data.seats,zoomRate);

                $.each(obj_arr, function( i, item ) {
                    if( res.reserv != undefined ) {
                        if (res.reserv[item.seat_idx] != undefined) {
                            //console.log("==예약있음=="+i+"===="+item.seat_idx);
                            select_index = i;
                            change_ribbon('status2', true);
                            change_table('status2', true);
                        }
                    }
                 });
                //$("#room_bg").position().left

                //console.log("원래가로:" + map_data.bg.width + " => 변경:" + (map_data.bg.width * zoomRate));
                //console.log("원래세로:" + map_data.bg.height + " => 변경:" + (map_data.bg.height * zoomRate));

                $("#room_bg").height(map_data.bg.height * zoomRate);

            }


        },
        error:function(e){
            //console.log("error:"+e);
            if(e.status==300){
                alert("데이터가 없습니다.");
            }
        }
    });

    $("#room_bg").show();
    $(".loading").remove();
};


$(document).ready(function(){
    var reloadTerm = 0
    $("#room_bg").on("resize", function() {
        if( reloadTerm == 0 ) {
            reloadTerm = 1;
            setTimeout(function () {
                reload_view_map(); // mode 유지
                reloadTerm = 0;
            }, 100);
        }

    });
});