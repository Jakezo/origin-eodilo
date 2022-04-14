function add_shape(shapeType){

    var pos_x = $("#room_bg").width() / 2;
    var pos_y = $("#room_bg").height() / 2;

    var obj_info = { type:shapeType, pos_x:pos_x, pos_y:pos_y, size_w: 200, size_h: 150, rotate : 0, scale : 1 };
    var new_index = draw_shape(obj_info, true);

}

function reload_view_map(){
    //console.log("사이즈변경:");
    load_view_map(mode)
};

function load_view_map( mode, room ){
    obj_arr = [];
    // 로딩이미지

    $("#room_bg").hide();
    $("#room_bg").html('<div style="width:100%" class="loading"><img src="/assets/plugins/seat_editor/images/loading1.gif" style="width:50%;text-align:center"/></div>');
    //console.log("모드 : "+mode);
    if( mode != undefined && mode != "" ) jlayout.mode = mode;

    //var data = "no=" + room;
    var data = "";
    if( room != undefined ) {
        data = "room=" + room;
    }

    //console.log("request : " + data);
    //console.log("url : "+'/partner_api/seat/editor_getMapInfo');
    $.ajax({
        type: 'POST',
        async: false,
        url: '/partner_api/seat/editor_getMapInfo',
        data: data,
        success: function(res) {
            
                //let map_data = JSON.parse(res.map_data);
                //let imageSRC = map_data.bg.src;

                // 여기서 현재 roomBG의 사이즈 확인
                var roomWidth = res.bg.width ?? 500;
                // 영역 너비 확인
                var targetWidth = $("#page").width();

                console.log("targetWidth : " + targetWidth + " / roomWidth : " + roomWidth);

                // 축소비율
                //var zoomRate = Math.floor( (targetWidth / roomWidth ) * 100) / 100;
                var zoomRate = (targetWidth / roomWidth );
                if( zoomRate > 1 ) zoomRate = 1;
                $("#wlog").html(roomWidth + "/" + targetWidth)

                //$("#room_bg").css({"background":"url(http://boss.mypro.co.kr/"+res.path + ")", 'background-size' : 'contain',  'background-repeat' : 'no-repeat', 'background-position':'center center'});

                //$("#log").html(JSON.stringify(map_data));
                //console.log(map_data);
                redraw_seat(res.seats,zoomRate);

                //$("#room_bg").height(map_data.bg.height * zoomRate);

        },
        error:function(e){
            console.log("error:");
            console.log(e);
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

    $(document).on("click",".status2", function(){
        //alert(1)
    });

    $(document).on("change","#edit_pannel #size_w", function(){

        if( select_index >= 0 ){
            resize_shape( select_index, $(this).val(), $(this).val() * 0.66 )
        } else {
            alert("객체를 선택한 후에 변경할 수 있습니다.")
        }

    });

    $(document).on("change","#edit_pannel #size_h", function(){

        if( select_index >= 0 ){

            /* 사이즈 정보 변경 */
            obj_arr[select_index].size_h = $(this).val();

            $("#shape_" + select_index).width(obj_arr[select_index].size_w);

            if( obj_arr[select_index].type =="table" ) {
                $("#shape_" + select_index).height( obj_arr[select_index].size_h  );
            }

        } else {
            alert("객체를 선택한 후에 변경할 수 있습니다.")
        }

    });

    $(document).on("change","#edit_pannel #tran_sc", function(){

        if( select_index >= 0 ){

            obj_arr[select_index].scale = $(this).val();
            set_rosc( select_index, obj_arr[select_index].rotate, obj_arr[select_index].scale );

        } else {
            alert("객체를 선택한 후에 변경할 수 있습니다.")
        }

    });

    $(document).on("change","#edit_pannel #tran_ro", function(){

        if( select_index >= 0 ){
            obj_arr[select_index].rotate = $(this).val();
            set_rosc( select_index, obj_arr[select_index].rotate, obj_arr[select_index].scale );
        } else {
            alert("객체를 선택한 후에 변경할 수 있습니다.")
        }

    });


    /* 드레그 */
    $(document).on("click",".shape", function(){
        //console.log("좌석선택.....");
        if( select_index != $(this).attr("idx") ) {
            select_index = $(this).attr("idx");
            set_edit_value(select_index);
        }

        // 테이블이면 세로크기 수정 불가
        if( obj_arr[select_index].type == "table" ) {
            $("#edit_pannel #size_h").attr("readonly",true);
        }

        $(".shape").css("border","1px solid #000000");
        $(this).css("border","1px solid red");

    }).on("drag",".shape", function(){
        //console.log("드래그.....");
        if( select_index != $(this).attr("idx") ) {
            select_index = $(this).attr("idx");
            set_edit_value(select_index);
        }

        // 테이블이면 세로크기 수정 불가
        if( obj_arr[select_index].type == "table" ) {
            $("#size_h").attr("readonly",true);
        }

        $("#edit_pannel #pos_x").val($(this).position().left);
        $("#edit_pannel #pos_y").val($(this).position().top);

        /* 좌표 정보 변경 */
        obj_arr[select_index].pos_x = $(this).position().left;
        obj_arr[select_index].pos_y = $(this).position().top;

        $(".shape").css("border","1px solid #000000");
        $(this).css("border","1px solid red");

    });

    $(window).bind('wheel', function(event){

        if( select_index == undefined || select_index == null ) {
            return;
        }

        //console.log("드래그.....");
        var trans_ro = parseFloat( $("#edit_pannel #tran_ro").val() );
        var trans_sc = parseFloat( $("#edit_pannel #tran_sc").val() );

        if(event.shiftKey) {

            if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                trans_sc += 0.1;
                if( trans_sc > 2 ) trans_sc = 2;
            }
            else {
                trans_sc -= 0.1;
                if( trans_sc < 0.5 ) trans_sc = 0.5;
            }

            $("#edit_pannel #tran_sc").val(trans_sc);

            obj_arr[select_index].scale = trans_sc;
            obj_arr[select_index].rotate = obj_arr[select_index].rotate ? obj_arr[select_index].rotate : 9;

            //console.log("회전 : " + obj_arr[select_index].rotate)
            set_rosc(select_index, obj_arr[select_index].rotate, obj_arr[select_index].scale );

        }  else {

            if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                trans_ro += 2;
                if( trans_ro > 360 ) trans_ro = 0;
            }
            else {
                trans_ro -= 2;
                if( trans_ro < 0 ) trans_ro = 360;
            }

            $("#edit_pannel #tran_ro").val(trans_ro);

            obj_arr[select_index].rotate = trans_ro;
            set_rosc(select_index, obj_arr[select_index].rotate, obj_arr[select_index].scale );

        }

    });

});