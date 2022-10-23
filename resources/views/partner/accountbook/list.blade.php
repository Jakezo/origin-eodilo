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
                <div class="breadcrumb-title pe-3">정산</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">현금출납부</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#useInfoModal"><i class="lni lni-youtube"></i>도움말</button>
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
                                        <select class="single-select form-control-sm col-12" id="kind" name="kind">
                                            <option value="">전체</option>
                                            <option value="I" @if( isset($param["kind"]) && $param["kind"] == "I" ) selected @endif>입금</option>
                                            <option value="O" @if( isset($param["kind"]) && $param["kind"] == "O" ) selected @endif>출금</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <input type="text" name="sdate" id="sdate" value="{{ $param["sdate"] ?? '' }}" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <input type="text" name="edate" id="edate" value="{{ $param["edate"] ?? '' }}" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <div class="col-12">
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('<?=date("Y-m-d")?>');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('<?=date("Y-m-01")?>');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('<?=date("Y-01-01")?>');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#accountbookFormModal">신규/항목관리</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3">
                                <div class="col">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">입금총액</p>
                                                    <h4 class="font-weight-bold">{{ number_format($total_in["sum"]) }}</h4>
                                                </div>
                                                <div class="widgets-icons bg-gradient-blues text-white"><i class="bx bx-message-square-add"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">출금총액</p>
                                                    <h4 class="font-weight-bold">{{ number_format($total_out["sum"]*-1) }}</h4>
                                                </div>
                                                <div class="widgets-icons bg-gradient-burning text-white"><i class="bx bx-message-square-minus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">차액</p>
                                                    <h4 class="font-weight-bold">{{ number_format($total_sum)  }}</h4>
                                                </div>
                                                <div class="widgets-icons bg-gradient-moonlit text-white"><i class="bx bx-message-square-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">날자</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">항목</th>
                                    <th scope="col">내용</th>
                                    <th scope="col">입금액</th>
                                    <th scope="col">출금액</th>
                                    <th scope="col">수정</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $AccountBooks )
                                @foreach( $AccountBooks as $ai => $AccountBook )                                    
                                <tr>
                                    <th scope="row">{{ ($start - $ai) }}</th>
                                    <td>{{ $AccountBook['ab_date'] }}</td>
                                    <td>@if( $AccountBook['ab_kind'] == "I" ) 입금 @elseif( $AccountBook['ab_kind'] == "O" ) 출금 @endif </td>
                                    <td>{{ $AccountBook['d_name'] }}</td>
                                    <td>{{ $AccountBook['ab_cont'] }}</td>
                                    <td>@if( $AccountBook['ab_kind'] == "I" ) {{ number_format($AccountBook['ab_amount']) }} @endif </td>
                                    <td>@if( $AccountBook['ab_kind'] == "O" ) {{ number_format($AccountBook['ab_amount']) }} @endif </td>
                                    <td><button class="btn btn-xs btn-primary ab_item" no="{{ $AccountBook['ab_no'] }}">수정</button></td>
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
                            {{ $AccountBooks->appends($param)->links() }}
                        </div>                        
                    </div>



                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="accountbookFormModal" tabindex="-3" aria-labelledby="accountbookFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountbookFormModalLabel">현금출납 등록</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#accountbookInfo" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">정보입력</div>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#accountbookKind" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-folder-open font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">항목관리</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="accountbookInfo" role="tabpanel">

                            <form class="row g-3" id="ab_form" name="ab_form" onsubmit="return false;">
                            <input type="hidden" type="radio" name="no" id="a_no" value="">

                                <div class="col-md-12">
                                    <label for="a_div" class="form-label">날자</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-calendar"></i></span>
                                        <input type="text" name="date" id="a_date" value="{{ date("Y-m-d") }}" class="datepicker form-control border-start-0" placeholder="날자">
                                    </div>
                                </div>  

                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kind" id="a_kind_I" value="I">
                                        <label class="form-check-label" for="a_kind_I">입금</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kind" id="a_kind_O" value="O">
                                        <label class="form-check-label" for="a_kind_O">출금</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="a_div" class="form-label">항목</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-food-menu"></i></span>
                                        <select name="div" id="a_div" class="form-select">
                                        </select>
                                    </div>
                                </div>     
                                  
                                <div class="col-md-12">
                                    <label for="a_cont" class="form-label">내용</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-edit-alt"></i></span>
                                        <input type="text" name="cont" id="a_cont" class="form-control border-start-0" placeholder="내용">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="a_amount" class="form-label">금액</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-coin"></i></span>
                                        <input type="text" name="amount" id="a_amount" class="form-control border-start-0" placeholder="금액">
                                    </div>
                                </div>

                                <div class="col-md-12" id="msgAccountBook">

                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-warning px-5">확인</button>
                                </div>

                                <div class="col-12 text-right">
                                    이 항목을 삭제 <button type="button" class="btn btn-xs btn-secondary">삭제</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="accountbookKind" role="tabpanel">

                            <div class="row">
                                <form class="row g-3" id="div_form" name="div_form" onsubmit="return false;">
                                    <div class="col-md-4 col-sm-3 col-xs-12 mt-1">
                                        항목추가
                                    </div>
                                    <div class="col-md-6 col-sm-8 col-xs-12 mt-1">
                                        <input type="text" name="name" value="" placeholder="항목명" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <button type="button" id="btn_div_add" class="btn btn-warning px-2 btn-sm col-12">추가</a>
                                    </div>
                                </form>
                            </div>

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">항목명</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody id="div_lists">
                                <tr>
                                    <th scope="row">1</th>
                                    <td>모바일매출</td>
                                    <td><button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#memberRegModal">고정</button></td>
                                </tr>
                                </tbody>
                            </table>
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
        var divs_arr = [];

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("submit","#ab_form", function(){
                ab_add();
            });  

            $(document).on("click",".ab_item",function(){
                var ab_no = $(this).attr("no");
                console.log(ab_no);
                ab_getInfo(ab_no);
                $("#accountbookFormModal").modal("show");
            });            

            $(document).on("click","#btn_div_add", function(){
                div_add();
            });  

            $(document).on("keydown","#div_form input", function(event){
                if(event.keyCode==13) {
                    div_add();
                }
            });         

            $(document).on("click",".btn_div_del",function(){                 
                if( confirm("삭제하시겠습니까?") == true ) {
                    var no = $(this).attr("no");
                    div_del( no );
                }
            });        

            div_list();
        });

        function ab_getInfo(no){
            
            var req = "no=" + no ;
            $("#ab_form input[name='no']").val("");

            console.log(req);
            $.ajax({
                url : '/accountbook/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if( res.AccountBook != null ) {
                        console.log(res.AccountBook);
                        console.log(res.AccountBook.ab_date);
                        $("#ab_form #a_no").val(res.AccountBook.ab_no);
                        $("#ab_form #a_date").val(res.AccountBook.ab_date);
                        $("#ab_form #a_kind_"+res.AccountBook.ab_kind).prop("checked",true);
                        $("#ab_form #a_div").val(res.AccountBook.ab_div);
                        $("#ab_form #a_cont").val(res.AccountBook.ab_cont);
                        $("#ab_form #a_amount").val(res.AccountBook.ab_amount);
                        console.log(req);
                    } else {
                        $("#adminDetail_msg").html( res.message );
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }        

        function ab_add(){
            var req = $("#ab_form").serialize();
            console.log(req);
            var url = '/accountbook/update'
            $.ajax({
                url: url,
                data: req,
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        $("#ab_form input[name='no']").val("");
                        $("#ab_form input[name='cont']").focus();                        
                        $("#ab_form input[name='amount']").val("");
                    } else {
                        $("#msgAccountBook").html(res.message);
                        console.log(res.message);
                    }
                },
                error: function (request, textStatus, errorThrown) {

                }
            });
        }
        
        
        function formcheck(){
            /*
            for(i=0;i<=oEditors.length-1;i++){
                oEditors[i].exec("UPDATE_CONTENTS_FIELD", []);
            }
            */

            var form = $('#form1')[0];
            var formData = new FormData(form);
            var url = '/customer/partner/answer'
            $.ajax({
                url: url,
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        if (res.rURL != undefined) {
                            document.location.href = res.rURL;
                        } else {
                            document.location.reload();
                        }
                    } else {
                        console.log(res.message);
                    }
                },
                error: function (request, textStatus, errorThrown) {
                    console.log(1);
                    console.log(request);
                    console.log(2);
                    console.log(textStatus);
                    console.log(3);
                    console.log(errorThrown);
                }
            });
        }

        function div_add(){
            var req = $("#div_form").serialize();
            console.log(req);
            var url = '/accountbook/div/update'
            $.ajax({
                url: url,
                data: req,
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        $("#div_form input").val("");
                        div_list();
                    } else {
                        console.log(res.message);
                    }
                },
                error: function (request, textStatus, errorThrown) {

                }
            });
        }

        function div_del( no ){
            var req = "no=" + no;
            
            console.log(req);
            var url = '/accountbook/div/delete'
            $.ajax({
                url: url,
                data: req,
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {

                        var i = 0;
                        for( key in divs_arr ){
                            if( divs_arr[key].d_no == no ) {
                                divs_arr.splice( key, 1 );
                                break;
                            }
                        };                        
                        div_list_view();
                        
                    } else {
                        console.log(res.message);
                    }
                },
                error: function (request, textStatus, errorThrown) {

                }
            });
        }        

        
        function div_list_view(){
            console.log( divs_arr );
            var i = 0;
            $('#div_lists').empty();
            for( key in divs_arr ){
                var html = "";
                html = html + '<tr>';
                html = html + '    <th scope="row">'+(++i)+'</th>';
                html = html + '    <td>'+divs_arr[key].d_name+'</td>';
                html = html + '    <td><button type="button" class="btn btn-xs btn-secondary btn_div_del" no="'+divs_arr[key].d_no+'">삭제</button></td>';
                html = html + '</tr>';
                $('#div_lists').append(html);
            };


            $("#ab_form #a_div").empty();
            var html = '<option value="">항목선택</option>';
            $("#ab_form #a_div").append(html);            
            for( key in divs_arr ){
                var html = '<option value="'+divs_arr[key].d_no+'">' + divs_arr[key].d_name + '</option>';
                $("#ab_form #a_div").append(html);
            };          

        }  
        
        function div_list(){
            var req = $("#div_form").serialize();
            var url = '/accountbook/div/list'
            $.ajax({
                url: url,
                data: req,
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                },
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        divs_arr = res.divs;
                        div_list_view();

                    } else {
                        console.log(res.message);
                    }
                },
                error: function (request, textStatus, errorThrown) {
                    console.log(1);
                    console.log(request);
                    console.log(2);
                    console.log(textStatus);
                    console.log(3);
                    console.log(errorThrown);
                }
            });
        }  
    </script>

@endsection