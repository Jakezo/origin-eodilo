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
                        @else
                        신규가맹점 등록
                        @endif
                    </h5>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/form/{{ $partner["p_no"] ?? "" }}'">
                            <a class="nav-link active" data-bs-toggle="tab" href="/partner/form/{{ $partner["p_no"] ?? "" }}"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">가맹점정보</div>
                                </div>
                            </a>
                        </li>
                        @if( isset( $partner )  && isset($partner["p_no"]) ) 
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/photo/{{ $partner["p_no"] ?? "" }}'">
                            <a class="nav-link" data-bs-toggle="tab" href="/partner/photo/{{ $partner["p_no"]  ?? "" }}"
                               role="tab" aria-selected="false">
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
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/calculate/{{ $partner["p_no"] }}'">
                            <a class="nav-link" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-microphone font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">정산내역</div>
                                </div>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>


                <div class='card-body'>
                    <form enctype="multipart/form-data" method="post" name="form1" id="form1" class="row g-3">
                        {{csrf_field()}}
                        <input type="hidden" name="mode" value="modify">
                        <input type="hidden" name="no" id="no" value="{{ $partner["p_no"] ?? '' }}">
                        <input type="hidden" name="page" value="">
                        @if( $partner )
                        <input type="hidden" name="rURL" value="">
                        @else
                        <input type="hidden" name="rURL" value="/partner">
                        @endif

                        <div class="col-md-6">
                            <label class="form-label">구분</label>
                            <br>
                            <input class="form-check-input" type="radio" name="kind" value="A" @if( $partner && $partner["p_kind"] == 'A' ) checked @endif> 독서실
                            <input class="form-check-input" type="radio" name="kind" value="B" @if( $partner && $partner["p_kind"] == 'B' ) checked @endif> 스터디룸
                            <input class="form-check-input" type="radio" name="kind" value="C" @if( $partner && $partner["p_kind"] == 'C' ) checked @endif> 독서실 + 스터디룸
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">사용</label>
                            <br>
                            <input class="form-check-input" type="checkbox" name="open_mobile" value="Y" @if( $partner && $partner["p_open_mobile"] == 'Y' ) checked @endif> 모바일
                            <input class="form-check-input" type="checkbox" name="open_kiosk" value="Y" @if( $partner && $partner["p_open_kiosk"] == 'Y' ) checked @endif> 키오스크
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">가맹점ID</label>
                            <input type="text" name="id" maxlength="50" class="form-control form-control-sm" value="{{ $partner["p_id"] ?? '' }}"@if( isset($partner["p_no"]) ) readonly @endif>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">비빌번호</label>
                            <input type="text" class="form-control form-control-sm" name="passwd" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">브랜드</label>
                            <input type="text" name="brand" maxlength="50" class="form-control form-control-sm" value="{{ $partner["p_brand"] ?? '' }}">
                        </div>                        
                        <div class="col-md-6">
                            <label class="form-label">업체명</label>
                            <input type="text" name="name" maxlength="50" class="form-control form-control-sm" value="{{ $partner["p_name"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">홈페이지주소</label>
                            <input type="text" class="form-control form-control-sm" name="homepage" value="{{ $partner["p_homepage"] ?? '' }}">
                            <a href="" target="_blank">[바로가기]</a>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">전화번호</label>
                            <input type="text" class="form-control form-control-sm" name="phone" maxlength="50" value="{{ $partner["p_phone"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">사업자번호</label>
                            <input type="text" class="form-control form-control-sm" name="bizno" maxlength="50" value="{{ $partner["p_bizno"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="ceo">대표자명</label>
                            <input type="text" class="form-control form-control-sm" name="ceo" id="ceo" maxlength="50" value="{{ $partner["p_ceo"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">대표이메일</label>
                            <input type="email" class="form-control form-control-sm" name="email" maxlength="50" value="{{ $partner["p_email"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">담당자명</label>
                            <input type="text" class="form-control form-control-sm" name="emp_name" value="{{ $partner["p_emp_name"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">직책</label>
                            <input type="text" class="form-control form-control-sm" name="emp_duty" maxlength="50" value="{{ $partner["p_emp_duty"] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">핸드폰</label>
                            <input type="text" class="form-control form-control-sm" name="emp_hphone" maxlength="50" value="{{ $partner["p_emp_hphone"] ?? '' }}">
                            <font color="#ff0000">( - 로 구분)</font>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">담당자이메일</label>
                            <input type="email" class="form-control form-control-sm" name="emp_email" value="{{ $partner["p_emp_email"] ?? '' }}" maxlength="50">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">우편번호</label>
                            <input type="text" class="form-control form-control-sm" id="zipcode" name="zipcode" value="{{ $partner["p_zipcode"] ?? '' }}" onclick="execDaumPostcode('partner')">
                        </div>
                        <div class='col-md-12'>
                            <label class="form-label control-label">도로명주소</label>
                        </div>
                        <div class='col-sm-8 col-xl-8'>
                            <input type="text" class="form-control form-control-sm" id="address1" name="address1" value="{{ $partner["p_address1"] ?? '' }}" onclick="execDaumPostcode('partner')">
                        </div>
                        <div class='col-sm-4 col-xl-4'>
                            <input type="text" class="form-control form-control-sm" id="address2" name="address2" value="{{ $partner["p_address2"] ?? '' }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label mt-3">네이버좌표</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label mb-1">Lat</label>
                            <input type="text" class="form-control form-control-sm" id="map_latitude" name="map_latitude" value="{{ $partner["p_map_latitude"] ?? '' }}" title="위도">
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label mb-1">Lng</label>
                            <input type="text" class="form-control form-control-sm" id="map_longitude" name="map_longitude" value="{{ $partner["p_map_longitude"] ?? '' }}" title="경도">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <button type="button" class="btn btn-primary px-5 btn-sm mt-4" onclick="open_nmap_pointwindow('', encodeURIComponent(document.getElementById('address1').value ) + ' ' + encodeURIComponent( document.getElementById('address2').value ), '','map' )">좌표보기</button>
                        </div>
                        <div class='col-sm-12'>
                            <div class="form-check-inline mt-3">
                                <input type="radio" class='form-check-input' id="map_useY" name="map_use" value="Y" @if( $partner && $partner["p_map_use"] == 'Y' ) checked @endif>
                                <label for="map_use_1" class="custom-control-label">지도표기</label>
                                <input type="radio" class='form-check-input' id="map_useN" name="map_use" value="N" @if( $partner && $partner["p_map_use"] == 'N' ) checked @endif>
                                <label for="map_use_2" class="custom-control-label">지도표기안함</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">출입문타입</label>
                            <br>
                            <input class="form-check-input" type="radio" name="door" value="Q" @if( $partner && $partner["p_door"] == "Q" ) checked @endif> QR코드
                            <input class="form-check-input" type="radio" name="door" value="S" @if( $partner && $partner["p_door"] == "S" ) checked @endif> 비밀번호
                            <input class="form-check-input" type="radio" name="door" value="B" @if( $partner && $partner["p_door"] == "B" ) checked @endif> 버튼
                            <input class="form-check-input" type="radio" name="door" value="P" @if( $partner && $partner["p_door"] == "P" ) checked @endif> 지문인식
                            
                            
                        </div>

                        <div class='col-sm-12'>
                            <label class="form-label col-12">시설옵션</label>
                            @foreach( $options as $okey => $oval ) 
                            <div class="input-group mb-3">
                                <div class="input-group-text col-sm-4 col-md-2">
                                  <input type="checkbox" class="form-check-input mt-0" name="option[]" value="{{ $okey ?? '' }}" @if( $partner &&  in_array($okey,$partner["option_arr"]) !== false ) checked=checked @endif>
                                  &nbsp;&nbsp;{{ $oval ?? '' }}
                                </div>
                                <input type="text" name="options_cont[]" value="{{ $partner['options_cont'][$okey] ?? "" }}" placeholder="간단한 안내" class="form-control col-sm-4" aria-label="{{ $oval ?? '' }}">
                            </div>                            
                            @endforeach
                        </div>

                        <div class="col-12">
                            <label class="form-label">오시는길</label>
                            <input type="text" class="form-control form-control-sm" name="road" value="{{ $partner["p_road"] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">영업시간</label>
                            <input type="text" class="form-control form-control-sm" name="work_time" value="{{ $partner["p_work_time"] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">휴무일</label>
                            <input type="text" class="form-control form-control-sm" name="work_close" value="{{ $partner["p_work_close"] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">주차정보</label>
                            <input type="text" class="form-control form-control-sm" name="parking" value="{{ $partner["p_parking"] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">상세설명</label>
                            <textarea class="form-control" id="intro" name="intro" cols="70">{{ $partner["p_intro"] ?? '' }}</textarea>

                        </div>
                        <div class="col-12">
                            <label class="form-label">키워드</label>
                            <input type="text" class="form-control form-control-sm" name="keyword" value="{{ $partner["p_keyword"] ?? '' }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label col-12">공개여부</label>
                            <div class="form-check-inline col-12">
                                <input type="radio" class='form-check-input' name="state" value="Y" @if( !$partner || ($partner && $partner["p_state"] == 'Y') ) checked @endif> 공개
                                <input type="radio" class='form-check-input' name="state" value="N" @if( $partner && $partner["p_state"] == 'N' ) checked @endif> 비공개
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label col-12">노출순서</label>
                            <div class="form-check-inline col-7 mt-1">
                                <input type="text" class="col-sm-4 form-control form-control-sm" name="seq" id="seq" value="{{ $partner["p_seq"] ?? '' }}">
                            </div>
                            <div class="form-check-inline col-2 mt-1">
                                등급
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">메모</label>
                            <textarea class="form-control" name="memo" rows="3">{{ $partner["p_memo"] ?? '' }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">업무마감시간</label>
                            <input type="time" class="form-control form-control-sm" name="deadline_time" value="{{ $partner["p_deadline_time"] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">수수료율</label>
                            <input type="text" class="form-control form-control-sm" name="commission" value="{{ $partner["p_commission"] ?? '' }}">
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="alert alert-danger d-none" id="partnerErrMsg">

                        </div>

                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary px-5" onclick="formcheck()">정보수정</button>
                            <button type="button" class="btn btn-secondary px-5" onclick="location.href='partner_list.html?mode=modify&p_no='">돌아가기</button>
                        </div>


                     
                    </form>

                    @if( isset( $partner )  && isset($partner["p_no"]) ) 
                    <div class="col-12 text-right mt-5 mb-3">
                        <button type="button" class="btn btn-xs btn-danger px-5" id="btn_partner_delete">삭제</button>
                    </div>
                    @endif   
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
    <script src="/assets/js/nmap.js"></script> 
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click",".btn_fav",function(){
                console.log("파트너:"+$(this).attr("partner"));
                fn_favorite( $(this).attr("partner"));
            });
            $(document).on("click","#btn_partner_delete",function(){
                delete_partner();
            });
        });

        function formcheck(){
            $("#partnerErrMsg").html("").addClass("d-none");
            /* 요거는 나중에.....
            for(i=0;i<=oEditors.length-1;i++){
                oEditors[i].exec("UPDATE_CONTENTS_FIELD", []);
            }
            */

            formData = $("#form1").serialize();
            $.ajax({
                url: '/partner/update',
                //processData: false,
                //contentType: false,
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
                        $("#partnerErrMsg").html(res.message).removeClass("d-none");
                    }
                },
                error: function(xhr, status, msg){
                    openPopup(xhr.responseJSON)
                }
            });
        }

        function delete_partner(){
            $("#partnerErrMsg").html("").addClass("d-none");
            /* 요거는 나중에.....
            for(i=0;i<=oEditors.length-1;i++){
                oEditors[i].exec("UPDATE_CONTENTS_FIELD", []);
            }
            */
            if( confirm("정말로 삭제하시겠습니까?") == true ) {
                formData = new FormData();
                console.log($("#form1 #no").val()); 
                formData.append("no",$("#form1 #no").val() );
                console.log(formData); 
                $.ajax({
                    url: '/partner/delete',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'POST',
                    success: function (res) {
                        console.log(res);
                        if (res.result == true) {
                                document.location.href = "/partner";
                        } else {
                            $("#partnerErrMsg").html(res.message).removeClass("d-none");
                        }
                    },
                    error: function(xhr, status, msg){
                        console.log(xhr);
                        console.log(xhr.responseJSON.file);
                        console.log(xhr.responseJSON.line);
                        console.log(xhr.responseJSON.message);                        
                        ajax_error(xhr.responseJSON)
                    }
                });
            }
        }        

    </script>

@endsection
