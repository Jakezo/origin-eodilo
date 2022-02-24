<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <!--p>This is appended to the master sidebar.</p-->
@endsection

@section('content')

    <!--start page wrapper -->
    <script language="javaScript" src="/module/nmap/nmap.js" type="text/javascript"></script>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">업체정보관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">업체정보</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">

                <div class="card-body">
                    <h5 class="mb-0 text-primary">
                        @if( $partner && $partner["p_no"] )
                        가맹점명 {{ $partner["p_name"] }}
                        @endif
                    </h5>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/form/{{ $partner["p_no"] }}'">
                            <a class="nav-link" data-bs-toggle="tab" href="/partner/form/{{ $partner["p_no"] }}"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">가맹점정보</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/photo/{{ $partner["p_no"] }}'">
                            <a class="nav-link active" data-bs-toggle="tab" href="/partner/photo/{{ $partner["p_no"] }}"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">가맹점사진정보</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-microphone font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">이용현황</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">1:1문의</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">공지사항</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-microphone font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">이용통계</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-microphone font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">정산내역</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>


                <div class='card-body'>

                    <form action="" method="post" name="photoform" id="photoform" enctype="multipart/form-data" class="row g-3" onsubmit="return false;">
                        {{csrf_field()}}
                        <input type="hidden" name="no" value="{{ $partner["p_no"] }}">
    
                        <div class="col-md-6">
                            <label class="form-label">사진구분</label>
                            <div class="form-check-inline col-12">
                                <input type="radio" class='form-radio-input pkind' id="kind_A" name="kind" value="A" checked onclick="img_kind = this.value;img_get()"> 
                                <label for="kind_A">대표이미지</label>
                                <input type="radio" class='form-radio-input pkind' id="kind_D" name="kind" value="D" onclick="img_kind = this.value;img_get()"> 
                                <label for="kind_D">상세이미지</label>
                                <input type="radio" class='form-radio-input pkind' id="kind_S1" name="kind" value="S1" onclick="img_kind = this.value;img_get()"> 
                                <label for="kind_S1">노트북석</label>
                                <input type="radio" class='form-radio-input pkind' id="kind_S2" name="kind" value="S2" onclick="img_kind = this.value;img_get()"> 
                                <label for="kind_S2">1인석</label>
                                <input type="radio" class='form-radio-input pkind' id="kind_S3" name="kind" value="S3" onclick="img_kind = this.value;img_get()"> 
                                <label for="kind_S3">스터디룸</label>                                                              
                                <input type="radio" class='form-radio-input pkind' id="kind_S4" name="kind" value="S4" onclick="img_kind = this.value;img_get()"> 
                                <label for="kind_S4">자유석</label>                               
                            </div>
                        </div>

                        @for( $ii=0; $ii<=0; $ii++ )
                        <div class="col-12">
                            <label class="form-label">파일</label>
                            <input class="form-control" type="file" name="img" id="img">
                        </div>
                        @endfor
    
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary px-5" id="btn_photo_upload" name="Submit">확인</button>
                            <button type="button" class="btn btn-primary px-5" onclick="location.href='partner_photo_list.html?mode=photo&p_no='">목록</button>
                        </div>
                    </form>

                    <div class="card-body">
                        <div class="row" id="photo_list">
                            
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    <?
    //include $CFG['module_dir']."/zipcode/zipcode.inc.php";
    ?>
    <!--end page wrapper -->
@endsection


@section('javascript')

    <script>
        var img_kind = "A";
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click","#btn_photo_upload",function(){
                img_upload();
            });

            $(document).on("click",".btn_photo_del",function(){
                if( confirm("삭제하시겠습니까?") == true ) {
                    pt = $(this).attr("pt");
                    img_del(pt);
                }
            });
  
        });

        function img_list(photos){

            $("#photo_list").empty();
            if( photos != undefined ) {
                photos.forEach(function(photo){
                    var html = '<div class="col-sm-3 photoObj img_item" pt="'+photo.pt_no+'">';
                    html += '<img src="'+photo.pt_filename+'" class="">';
                    html += '<span class="btn btn-xs btn-light img_des btn_photo_del" pt="'+photo.pt_no+'">x</span>';
                    html += '</div>';
                    $("#photo_list").append(html);
                });
            }

        }

        function img_get(){
            let data = "kind=" + img_kind;
            console.log(data);
            $.ajax({
                url: '/partner/photo/{{ $partner["p_no"] }}/list',
                type: 'POST',
                data: data,
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        console.log(res);
                        img_list(res.photos);
                    } else {
                        $("#partnerErrMsg").html(res.message).removeClass("d-none");
                    }
                },
                error: function(xhr, status, msg){
                    ajax_error(xhr.responseJSON)
                }
            });
        }

        function img_del(pt){

            var data = "pt=" + pt;
            $.ajax({
                url: '/partner/photo/{{ $partner["p_no"] }}/delete',
                type: 'POST',
                data: data,
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        $(".photoObj[pt='"+pt+"']").remove();

                    } else {
                        $("#partnerErrMsg").html(res.message).removeClass("d-none");
                    }
                },
                error: function(xhr, status, msg){
                    ajax_error(xhr.responseJSON)
                }
            });
        }

        function img_upload(){

            if( $("#photoform #img").val() == "" ) {
                alert("이미지를 선택해주세요.");
                return false;
            }

            var form = $('#photoform')[0];
            var formData = new FormData(form);

            //for (var pair of formData.entries()) { 
            //    console.log(pair[0]+ ', ' + pair[1]); 
            //}

            console.log(formData); 
            $.ajax({
                url: '/partner/photo/{{ $partner["p_no"] }}/upload',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    img_get();
                    if (res.result == true) {
                        $("#photoform #img").val("");
                    } else {
                        $("#partnerErrMsg").html(res.message).removeClass("d-none");
                    }
                },
                error: function(xhr, status, msg){
                    ajax_error(xhr.responseJSON)
                }
            });
        }
        setTimeout(function(){
            img_get();
        },50);
        

    </script>

@endsection
