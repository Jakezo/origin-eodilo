

function windowPopup(popUrl) {
    var popOption = "status=yes, menubar=yes, toolbar=yes, resizable=yes";
    window.open(popUrl, popOption);
}

function callback_close(){
    opener.document.location.reload();
    window.close();
}

function openPopup(message, callback){
    $("#errorInfoModal .modal-body").html(message);
    $('#errorInfoModal').modal('show');

    if( callback != undefined ) {
        $("#errorInfoModalConfirm").removeClass("d-none")

        $( "#errorInfoModalConfirm" ).bind( "click", function() {
            eval( callback );
        });

        $("#errorInfoModalClose").addClass("d-none")
    } else {
        $("#errorInfoModalConfirm").addClass("d-none")
        $("#errorInfoModalClose").removeClass("d-none")
    }
}

function priceToString(val) {
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/* 에디터에서 파일 업로드를 처리함 */
function sendFile(file, editor){
    var data = new FormData();
    data.append("file", file);
    console.log(file);
    $.ajax({
        data : data,
        type : "POST",
        url : "/editor/upload",
        contentType : false,
        processData : false,
        success : function(data){
            console.log(data);
            $(editor).summernote("insertImage",data.file_url);
        }
    });
}



