var jlayout = {};
var obj_arr = [];
var select_index = null;
var mode = "";

var idx = 0;
var room = 0;


function scale_bg(sc){
    $("#room_bg").css("transform","rotate(0deg) scale("+sc+")");
}

function draw_shape(obj_info,zoomRate){
    //console.log("전달받은배율" + zoomRate);
    if( zoomRate == undefined || zoomRate == null || zoomRate > 1) {
        zoomRate = 1;
    }
    
    //console.log("확정배율" + zoomRate);
    if( !obj_info.type )  obj_info.type = "table";
    var html = '';

    var new_index = ( obj_arr.length != undefined &&  obj_arr.length != null ) ? obj_arr.length : 0 ;
    var new_id = "shape_" + new_index;

    var style= "left:"+obj_info.s_map_x+";left:"+obj_info.s_map_y;

    html += '<div class="shape table btn_seat" id="'+new_id+'" idx='+new_index+' seat="'+obj_info.s_no+'" btn_seatstyle='+style+'>';
    html += '    <div class="status">';
    html += '        <div class="status1"></div>';
    html += '        <div class="status2"></div>';
    html += '    </div>';
    html += '    <div class="name">';
    html += obj_info.s_name?obj_info.s_name : obj_info.s_no;
    html += '    </div>';
    html += '</div>';

    /*
    if( obj_info.type == "table") {

        html += '<div class="shape table" id="'+new_id+'" idx='+new_index+'>';
        html += '    <div class="status">';
        html += '        <div class="status1"></div>';
        html += '        <div class="status2"></div>';
        html += '    </div>';
        html += '    <div class="name">';
        html += '        미지정';
        html += '    </div>';
        html += '</div>';

    } else if( obj_info.type == "table2") {

        html += '<div class="shape table2" id="'+new_id+'" idx='+new_index+'>';
        html += '    <div class="status">';
        html += '        <div class="status1"></div>';
        html += '        <div class="status2"></div>';
        html += '    </div>';
        html += '    <div class="name">';
        html += '        미지정';
        html += '    </div>';
        html += '</div>';

    } else if( obj_info.type == "wall") {

        html += '<div class="shape wall" id="'+new_id+'" idx='+new_index+'>';
        html += '</div>';

    } else if( obj_info.type == "pillar1") {

        html += '<div class="shape pillar1" id="'+new_id+'" idx='+new_index+'>';
        html += '</div>';

    } else if( obj_info.type == "pillar2") {

        html += '<div class="shape pillar2" id="'+new_id+'" idx='+new_index+'>';
        html += '</div>';

    }
    */
    jlayout.mode = "edit";
    if( html ) {

        $("#room_bg").append(html);
        //console.log("인덱스 : "+new_index);
        obj_arr[new_index] = {
            "s_no": obj_info.s_no ?? 0,
            "type": obj_info.type ?? 'edit',
            "pos_x": obj_info.s_map_x ?? 0,
            "pos_y": obj_info.s_map_y ?? 0,
            "size_w": $("#shape_" + new_index).width() ?? 100,
            "size_h": $("#shape_" + new_index).height() ?? 80,
            "rotate": obj_info.s_map_r ?? 0,
            "scale": obj_info.scale ?? 1,
            "status": ""
        };

        if( jlayout.mode == "edit") {
            $("#shape_" + new_index).css("cursor","move");
            $("#shape_" + new_index).draggable();
        } else {
            $("#shape_" + new_index).css("cursor","pointer");
        }

    }

    // 생성된 객체 선택
    select_shape( new_index );

    if( obj_arr[new_index].pos_x == null || obj_arr[new_index].pos_x == undefined ) {
        console.log("x = "+obj_arr[new_index].pos_x+" , y = "+obj_arr[new_index].pos_y);
    }

    // 위치이동
    var l = $("#room_bg").offset().left + (obj_arr[new_index].pos_x*zoomRate);
    var t = $("#room_bg").offset().top + (obj_arr[new_index].pos_y*zoomRate);

    // 위치이동
    move_shape( new_index, Math.ceil(l) , Math.ceil(t)  );

    // 회전
    set_rosc( new_index, obj_arr[new_index].rotate, obj_arr[new_index].scale );

    // 사이즈조정
    if( zoomRate > 0.9 ) {
        zoomRatePlus = 0;
    } else if( zoomRate > 0.8 ) {
        zoomRatePlus = 0.02;
    } else if( zoomRate > 0.7 ) {
        zoomRatePlus = 0.01;
    } else if( zoomRate > 0.6 ) {
        zoomRatePlus = 0.2;
    } else if( zoomRate > 0.5 ) {
        zoomRatePlus = 0.35;
    } else {
        zoomRatePlus = 0.2;
    }

    //console.log("배율["+zoomRate+"] 추가배율["+zoomRatePlus+"]");
    resize_shape( new_index, $("#shape_"+new_index).width()*(zoomRate+zoomRatePlus), $("#shape_"+new_index).height()*(zoomRate+zoomRatePlus))

    return new_index;
}

function set_fix(){
    console.log("좌석고정시키기 목록루프");
    $.each(obj_arr, function( i, item ) {
        console.log(i + "번째" + item.type + "고정" );
        $("#shape_"+i).draggable( "option", "disabled", true );
    });
}

function set_bg(src,width,height){
    $("#roomBG").css("background-color",src);
    //$("#roomBG").width(width);
    //$("#roomBG").height(height);
}

function set_rosc(i, ro, sc ){

    $("#shape_"+i).css("-ms-transform","rotate("+ro+"deg)");
    $("#shape_"+i).css("-webkit-transform","rotate("+ro+"deg)");
    $("#shape_"+i).css("transform","rotate("+ro+"deg) scale("+sc+")");
}

function set_status(i, kind, val){
    $("#shape_"+i).find("."+kind).css("background-color",val);
}

function delete_shape() {

    if( select_index ) {
        obj_arr[select_index].status = "deleted";
        $("#shape_" + select_index).hide();
    }

}

function move_shape(i, pos_x, pos_y) {

    //console.log("여기에 자리잡기:"+pos_x + "/" + pos_y)

    //$("#shape_"+i).offset({left:pos_x, top:pos_y});
    $("#shape_"+i).css("left", pos_x);
    $("#shape_"+i).css("top", pos_y);
}

function resize_shape( i, w, h ) {

        obj_arr[i].size_w = w;
        obj_arr[i].size_h = h;

        $("#shape_" + i).width( obj_arr[i].size_w );
        $("#shape_" + i).height( obj_arr[i].size_h );

}

function delete_shape_all() {

    $.each(obj_arr, function( i, item ) {
        obj_arr[i].status = "deleted";
        $("#shape_" + i).hide();
    });

}

/* 요소 모두 제거 */
function reset_shape_all() {
    obj_arr = [];
    $(".shape").remove();
}

function set_edit_value(i){
    var obj_info = obj_arr[i];

    $("#edit_pannel #pos_x").val(obj_info.pos_x);
    $("#edit_pannel #pos_y").val(obj_info.pos_y);
    $("#edit_pannel #size_w").val(obj_info.size_w);
    $("#edit_pannel #size_h").val(obj_info.size_h);

    $("#edit_pannel #tran_ro").val(obj_info.rotate);
    $("#edit_pannel #tran_sc").val(obj_info.scale);
}

/* 제어를 위해 선택하기 */
function select_shape( index ) {

    select_index = index;
    set_edit_value(select_index);

    $(".shape").css("border","1px solid #000000");

    /* fix mode 에서는 선택라인 보이지 않음 */
    console.log("mode:"+jlayout.mode);
    if( jlayout.mode != "fix" ) {
        $("#shape_" + select_index).css("border", "1px solid red");
    }
}

/* 부각하기 */
function standUp_shape( index ) {
    select_index = index;
    $("#shape_" + select_index).css("border", "3px solid orange");
    $("#shape_" + select_index+" .name").css("color", "orange");
}

/* 부각안하기 */
function standDown_shape( index ) {
    select_index = index;
    $("#shape_" + select_index).css("border", "1px solid #dddddd");
    $("#shape_" + select_index+" .name").css("color", "#dddddd");
}

/* 부각초기화 */
function standReset_shape() {
    $(".shape").css("border", "1px solid #000000");
    $(".shape .name").css("color", "#000000");
}

function change_status(kind, val){

    var obj_info = obj_arr[select_index];

    if( val >= 4 ) {
        set_status(select_index, "status1", "#f1bcbc");
    } else if( val >= 3 ) {
        set_status(select_index, "status1", "#95e290");
    } else if( val >= 2 ) {
        set_status(select_index, "status1", "#5fc6e2");
    } else if( val >= 1 ) {
        set_status(select_index, "status1", "#18ba4e");
    }

}

function change_ribbon(kind, val){

    var obj_info = obj_arr[select_index];

    if( val == true) {
        set_status(select_index, "status2", "#000000");
    } else {
        set_status(select_index, "status2", "#ffffff");
    }
}


function seat_status(seat, val){

    var obj_info = obj_arr[select_index];

    if( val >= 4 ) {
        $("shape[seat='"+seat+"']").find(".status1").css("background-color","#f1bcbc");
    } else if( val >= 3 ) {
        $("shape[seat='"+seat+"']").find(".status1").css("background-color","#95e290");
    } else if( val >= 2 ) {
        $("shape[seat='"+seat+"']").find(".status1").css("background-color","#5fc6e2");
    } else if( val >= 1 ) {
        $("shape[seat='"+seat+"']").find(".status1").css("background-color","#18ba4e");
    }

}

function seat_ribbon(kind, val){

    var obj_info = obj_arr[select_index];

    if( val == true) {
        $("#shape_"+i).find(".status2").css("background-color","#000000");
    } else {
        $("#shape_"+i).find(".status2").css("background-color","#ffffff");
    }
}



function change_table(kind, val){

    console.log(select_index+"번째 객체");
    if( val == true) {
        $("#shape_"+select_index).css("background-color","#aaaaaa");
    } else {
        $("#shape_"+select_index).css("background-color","#ffffff");
    }
}

function rename_shape(i, name) {
    $("#shape_"+i).find(".name").html(name);
}

function redraw_seat(obj_arr_tmp,zoomRate){
    console.log("drow seat ");

    if( zoomRate != undefined && zoomRate != null ) {
            //모두제거
            reset_shape_all();
            console.log("모든 목록 : ");
            $.each(obj_arr_tmp, function( i, item ) {

                // 객체 그리기
                draw_shape(obj_arr_tmp[i], zoomRate);

                // 객체크기변경
                if( zoomRate != 1 ) {
                    $("#shape_"+i).width($("#shape_"+i).width()*zoomRate);
                    $("#shape_"+i).height($("#shape_"+i).height()*zoomRate);

                    // 객체내 상태아이콘 크기 변경
                    $(".status1").width($(".status1").width()*zoomRate);
                    $(".status1").height($(".status1").height()*zoomRate);
                    $(".status2").width($(".status2").width()*zoomRate);
                    $(".status2").height($(".status2").height()*zoomRate);
                }

                // 텍스트변경
                if( zoomRate < 0.3 ) {
                    console.log("0.3 보다 작을때 : ")
                    $("#shape_"+i).find(".name").css("font-size","0.4em");
                } else if( zoomRate < 0.5 ) {
                    console.log("0.5 보다 작을때 : ")
                    $("#shape_"+i).find(".name").css("font-size","0.3em");
                }

                if( obj_arr_tmp[i].seat_idx != undefined && obj_arr_tmp[i].seat_idx != null ){
                    obj_arr[i].seat_idx = obj_arr_tmp[i].seat_idx;

                    if( obj_arr_tmp[i].seat_name != undefined && obj_arr_tmp[i].seat_name != null ) {
                        obj_arr[i].seat_name = obj_arr_tmp[i].seat_name;
                        rename_shape(i, obj_arr_tmp[i].seat_name);
                    }
                }
            });
    }
}


function setting_map(  mode, no ){
    room  = no ?? 0;
    load_view_map(mode);
}