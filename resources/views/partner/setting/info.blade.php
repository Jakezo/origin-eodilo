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
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger btn_manual" rel="5"><i class="lni lni-youtube"></i>도움말</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">

                    <div class="card-body">

                        <form enctype="multipart/form-data" method="post" name="form1" id="form1" class="row g-3">
                            {{csrf_field()}}
                            <input type="hidden" name="mode" value="modify">
                            <input type="hidden" name="no" value="{{ $partner["p_no"] ?? '' }}">
                            <input type="hidden" name="page" value="">
                            @if( $partner )
                                <input type="hidden" name="rURL" value="">
                            @else
                                <input type="hidden" name="rURL" value="/partner">
                            @endif

                            <div class="col-md-6">
                                <label class="form-label">업체명</label>
                                <input type="text" name="name" maxlength="50" class="form-control form-control-sm" value="{{ $partner["p_name"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">홈페이지주소</label>
                                <input type="text" class="form-control form-control-sm" name="homepage" value="{{ $partner["p_homepage"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">전화번호</label>
                                <input type="text" class="form-control form-control-sm" name="phone" maxlength="50" value="{{ $partner["p_phone"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">사업자번호</label>
                                <input type="text" class="form-control form-control-sm" name="bizno" maxlength="50" value="{{ $partner["p_bizno"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="ceo">대표자명</label>
                                <input type="text" class="form-control form-control-sm" name="ceo" id="ceo" maxlength="50" value="{{ $partner["p_ceo"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">대표이메일</label>
                                <input type="email" class="form-control form-control-sm" name="email" maxlength="50" value="{{ $partner["p_email"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">담당자명</label>
                                <input type="text" class="form-control form-control-sm" name="emp_name" value="{{ $partner["p_emp_name"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">직책</label>
                                <input type="text" class="form-control form-control-sm" name="emp_duty" maxlength="50" value="{{ $partner["p_emp_duty"] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">핸드폰</label>
                                <input type="text" class="form-control form-control-sm" name="emp_hphone" maxlength="50" value="{{ $partner["p_emp_hphone"] ?? '' }}" readonly>
                                <font color="#ff0000">( - 로 구분)</font>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">담당자이메일</label>
                                <input type="email" class="form-control form-control-sm" name="emp_email" value="{{ $partner["p_emp_email"] ?? '' }}" maxlength="50" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">주소</label>
                                <input type="text" class="form-control form-control-sm" id="zipcode" name="zipcode" value="{{ $partner["p_address1"] ?? '' }} {{ $partner["p_address2"] ?? '' }} / 우 {{ $partner["p_zipcode"] ?? '' }}" readonly>
                            </div>

                            <div class="col-12">
                                <label class="form-label mt-3">지도  @if( $partner && $partner["p_map_use"] == 'Y' ) 표기 @endif </label>
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
                                <button type="submit" class="btn btn-primary px-5 btn-sm mt-4" onclick="open_nmap_pointwindow('', encodeURIComponent(document.getElementById('address1').value ) + ' ' + encodeURIComponent( document.getElementById('address2').value ), '','map' )">좌표보기</button>
                            </div>
                            <div class='col-sm-12'>
                                <div class="form-check-inline mt-3">
                                    <input type="radio" class='form-check-input' id="map_useY" name="map_use" value="Y" @if( $partner && $partner["p_map_use"] == 'Y' ) checked @endif>
                                    <label for="map_use_1" class="custom-control-label">지도표기</label>
                                    <input type="radio" class='form-check-input' id="map_useN" name="map_use" value="N" @if( $partner && $partner["p_map_use"] == 'N' ) checked @endif>
                                    <label for="map_use_2" class="custom-control-label">지도표기안함</label>
                                </div>
                            </div>


                            
                            <div class="col-12">
                                <label class="form-label">업무마감시간</label>
                                <input type="time" class="form-control form-control-sm" name="deadline_time" value="{{ $partner["p_deadline_time"] ?? '' }}">
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
                                <label class="form-label">가맹점소개</label>
                                <textarea class="form-control" id="intro" name="intro" cols="70">{{ $partner["p_intro"] ?? '' }}</textarea>

                            </div>
                            <div class="col-12">
                                <label class="form-label">키워드</label>
                                <input type="text" class="form-control form-control-sm" name="keyword" value="{{ $partner["p_keyword"] ?? '' }}">
                            </div>

                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary px-5" onclick="formcheck()">정보수정</button>
                                <button type="button" class="btn btn-secondary px-5" onclick="location.href='partner_list.html?mode=modify&p_no='">돌아가기</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
            <img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
        </div>
        <div class="search-overlay"></div>
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
    </div>
    <!--end page wrapper -->
@endsection

@section('javascript')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function formcheck(){
            /*
            for(i=0;i<=oEditors.length-1;i++){
                oEditors[i].exec("UPDATE_CONTENTS_FIELD", []);
            }
            */

            console.log(1);
            var form = $('#form1')[0];
            var formData = new FormData(form);
            $.ajax({
                url: '/setting/infoUpdate',
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
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }

    </script>

@endsection

