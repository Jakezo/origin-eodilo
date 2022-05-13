<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!--link href="/assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" /-->
    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet" />
    <script src="/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!--link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"-->
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="/assets/css/header-colors.css" />
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>관리자</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">

        <!--navigation-->
        @include("layouts.manager_sidebar")
        @yield('sidebar')
        <!--end navigation-->

    </div>
    <!--end sidebar wrapper -->
    <!--start header -->
    <header>
        @include("layouts.manager_topnav")
    </header>

    @yield('content')

    <!-- 상품구매 -->
    <div class="modal fade" id="productBuyFormModal" tabindex="-1" aria-labelledby="productBuyFormModalLabel" style="display: none;z-index:200000;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seatFormModalLabel">상품구매</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body setInfoHtmnl">
                    <form id="productBuyForm" name="productBuyForm">
                        
                    <!-- 창구 -->
                    <input type="hidden" name="b_device_from" id="b_device_from" value="A">
                    <input type="hidden" name="b_birth" id="b_birth" value="">
                    <input type="hidden" name="b_ageType" id="b_ageType" value="">
                    <input type="hidden" name="b_locker" id="b_locker" value="">
                    <input type="hidden" name="b_member" id="b_member" value="">
                    <div class="row">
                        <div class="col-7">
                            <div class="row col-12 mb-2">
                                <div class="col-4">이용자 <span class="btn_member_register btn btn-xs btn-info" nextStep="buyProduct">[가입하기]</span></div>
                                <div class="col-8">
                                    <input name="b_member_name" id="b_member_name" style="ime-mode:disabled;" class="form-control form-control-sm mb-3 col-6 input_member" type="text" placeholder="클릭하여 회원검색" aria-label=".form-control-sm example" data-bs-toggle="modal" data-bs-target="#memberListModal" search_mode="product">
                                    <div id="b_birth_txt"></div>
                                </div>
                            </div>

                            <div class="row col-12 mb-2 d-none" id="buyProduct_row_seat_info">
                                <div class="col-4">좌석</div>
                                <div class="col-8" id="buyProduct_seat_info">

                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">상품등급</div>
                                <div class="col-8">
                                    <select name="b_seatlevel" id="b_seatlevel" class="form-select form-select-sm mb-3">
                                        <option value="">먼저상품선택</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="row col-12 mb-2">
                                <div class="col-4">이용권선택</div>
                                <div class="col-8">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="b_product_kind" id="b_product_kind_A" value="A">
                                        <label class="form-check-label" for="b_product_kind_A">하루이용권</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="b_product_kind" id="b_product_kind_T" value="T">
                                        <label class="form-check-label" for="b_product_kind_T">시간권</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="b_product_kind" id="b_product_kind_D" value="D">
                                        <label class="form-check-label" for="b_product_kind_D">기간권</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="b_product_kind" id="b_product_kind_P" value="P">
                                        <label class="form-check-label" for="b_product_kind_P">정액권</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="b_product_kind" id="b_product_kind_F" value="F">
                                        <label class="form-check-label" for="b_product_kind_F">고정권</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">상품선택</div>
                                <div class="col-8">
                                    <select name="b_duration" id="b_duration" class="form-select form-select-sm mb-3">
                                        <option value="">먼저이용권선택</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">좌석요금</div>
                                <div class="col-8">
                                    <input name="b_price_seat" id="b_price_seat" value="0" class="form-control form-control-sm mb-3 col-6" type="text" placeholder="좌석구매금액">
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4"></div>
                                <div class="col-8" id="price_seat_Detail">
                                    
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">사물함</div>
                                <div class="col-8">
                                    <div class="input-group input-group-sm mb-3">
                                        <input type="text" name="b_locker_name" id="b_locker_name" class="form-control " size="50"   placeholder="사물함"/>
                                        <button class="btn input-group-addon btn-outline-secondary" type="button" id="btn_search_locker">사물함검색</button>
                                    </div>                                      
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">사물함요금</div>
                                <div class="col-8">
                                    <input name="b_price_locker" id="b_price_locker" value="0" class="form-control form-control-sm mb-3 col-6" type="text" placeholder="사물함구매금액">
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">합계요금</div>
                                <div class="col-8">
                                    <input name="b_price_total" id="b_price_total" value="0" class="form-control form-control-sm mb-3 col-6" type="text" placeholder="총구매금액">
                                </div>
                            </div>


                            <div class="row col-12 mb-2">
                                <div class="col-4">결제요금</div>
                                <div class="col-8">
                                    <input name="b_pay_money" id="b_pay_money" value="0" class="form-control form-control-sm mb-3 col-6" type="text" placeholder="총구매금액">
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">결제</div>
                                <div class="col-8">
                                    <select name="b_pay_kind" id="b_pay_kind" class="form-select form-select-sm mb-3">
                                        <option value="">결제방법</option>
                                        <option value="LCASH">현금</option>
                                        <option value="LCARD">카드</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-4">결제여부</div>
                                <div class="col-8">
                                    <select name="b_pay_state" id="b_pay_state" class="form-select form-select-sm mb-3">
                                        <option value="N">대기</option>
                                        <option value="Y">완료</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mb-2" id="productDetail_msg">

                            </div>

                            <div class="row justify-content-center">
                                <button type="button" id="btn_productBuy" class="btn btn-primary col-5">확  인 </button>
                            </div>
                        </div>
                        <div class="col-5">
                            시간표 2021-10-10
                            <div id="time_table2">

                            </div>
                            <div class="alert alert-info">시간을 클릭한후 왼쪽 폼에서 수정가능합니다.</div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- 회원목록(검색) -->
    <div class="modal fade" id="memberListModal" tabindex="-3" aria-labelledby="memberListModalLabel" style="display: none;z-index:9999999;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberListModalLabel">회원검색</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="frm_search_member" id="frm_search_member" onsubmit="return member_search();">
                        <div class="row">

                            <div class="col-md-9 col-xs-12 mt-1">
                                <input type="text" name="search_member_q" id="search_member_q" value="" placeholder="아이디, 이름, 전화번호 " class="form-control form-control-sm col-12">
                            </div>
                            <div class="col-md-3 col-xs-12 mt-1 justify-content-right">
                                <button type="submit" class="btn btn-warning px-2 btn-sm col-12">검색</button>
                            </div>
                        </div>
                    </form>

                    <table class="table mb-0 table-striped">
                        <thead>
                        <tr>
                            <th scope="col">이름</th>
                            <th scope="col">연락처</th>
                            <th scope="col">생년월일</th>
                            <th scope="col">관리</th>
                        </tr>
                        </thead>
                        <tbody id="member_search_list">
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 사물함 선택 -->
    <div class="modal fade" id="lockerListModal" tabindex="-3" aria-labelledby="lockerListModalLabel" style="display: none;z-index:193000;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lockerListModalLabel">사물함</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table mb-0 table-striped">
                        <thead>
                        <tr>
                            <th scope="col">사물함구역</th>
                            <th scope="col">사물함명</th>
                            <th scope="col">사용기간</th>
                        </tr>
                        </thead>
                        <tbody id="locker_search_list">
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 회원가입 -->
    <div class="modal fade" id="memberRegModal" tabindex="-3" aria-labelledby="memberRegModalLabel" style="display: none;z-index:990000;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberRegModalLabel">회원정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">기본정보</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primarybuy" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">구매내역</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryuse" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">이용내역</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primarycustom" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">1:1문의</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryalarm" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">알람내역</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#points" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">포인트</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#cashes" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">캐쉬</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">

                            <form action="/member/update" aria-label="{{ __('Register') }}" class="row g-3 form-horizontal" role="form" name="frm_member" id="frm_member">
                            {{csrf_field()}}
                            <input type="hidden" name="step" id="step" value="">
                            <input type="hidden" name="no" id="no" value="">


                                <div class="col-md-6">
                                    <label for="name" class="form-label">이름</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0" name="name" id="name" placeholder="이름">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="sex" class="form-label">성별</label>
                                    <div class="input-group"> 
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="sex" id="sex_M" value="M" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary" for="sex_M">남</label>
                                        <input type="radio" class="btn-check" name="sex" id="sex_F" value="F" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="sex_F">여</label>
                                      </div>    
                                    </div>  
                                </div>

                                <div class="col-md-6">
                                    <label for="birth" class="form-label">생년월일</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="date" class="form-control border-start-0 datepicker" name="birth" id="birth"  placeholder="생년월일">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="phone" class="form-label">전화번호</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-microphone"></i></span>
                                        <input type="text" class="form-control border-start-0" name="phone" id="phone"  placeholder="휴대폰번호">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="inputEmailAddress" class="form-label">이메일주소</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-message"></i></span>
                                        <input type="email" class="form-control border-start-0"  name="email" id="email" placeholder="이메일주소">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="passwd" class="form-label">비번</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
                                        <input type="password" class="form-control border-start-0" name="passwd" id="passwd" placeholder="비밀번호 입력">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="tags_A" class="form-label">Tag</label>
                                    <div class="input-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_A" value="A">
                                            <label class="form-check-label" for="tags_A"><i class="bx bxs-tag text-primary font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_B" value="B">
                                            <label class="form-check-label" for="tags_B"><i class="bx bxs-tag text-info font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_C" value="C">
                                            <label class="form-check-label" for="tags_C"><i class="bx bxs-tag text-success font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_D" value="D">
                                            <label class="form-check-label" for="tags_D"><i class="bx bxs-tag text-danger font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_E" value="E">
                                            <label class="form-check-label" for="tags_E"><i class="bx bxs-tag text-warning font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_F" value="F">
                                            <label class="form-check-label" for="tags_F"><i class="bx bxs-tag text-secondary font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="memo" class="form-label">메모</label>
                                    <textarea class="form-control" id="memo" name="memo" placeholder="메모" rows="3"></textarea>
                                </div>

                                <div class="col-12" id="memberDetail_msg">

                                </div>
                                
                                <div class="col-12 text-center">
                                    <button type="button" id="btn_member_update" class="btn btn-info px-5">확인</button>
                                </div>
                                
                                <div class="col-12 text-left">
                                    해당회원을 삭제하시려면 <span class="btn btn-secondary btn-xs" id="btn_member_delete">삭제</span> 를 클릭해주세요.
                                </div>
                                
                            </form>

                            <div class="alert alert-sm alert-success my-2 p-2">
                                <div class="bold font-weight-bold">개발가이드</div>
                                1. 가맹점에서 가입시 회원은 가맹점회원으로만 등록됩니다.<br>
                                2. 가입시 메세지, 이벤트 메세지를 통해 모바일에 가입하면 이후 모바일 회원을 전환됩니다.<br>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="primarybuy" role="tabpanel">

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">구매일</th>
                                    <th scope="col">구매상품</th>
                                    <th scope="col">잔여</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>3시간권</td>
                                    <td>24분</td>
                                    <td><button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#memberRegModal">사용중</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>3시간권</td>
                                    <td>0분</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">이용완료</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>3시간권</td>
                                    <td>0분</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">이용완료</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>1개월권</td>
                                    <td>12일</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">이용완료</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="primaryuse" role="tabpanel">

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">입실</th>
                                    <th scope="col">퇴실</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#memberRegModal">예약</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#memberRegModal">사용중</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">종료</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>20-10-17 00:00:00</td>
                                    <td>20-10-17 00:00:00</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">종료</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="primarycustom" role="tabpanel">

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">제목</th>
                                    <th scope="col">등록일</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>시간이 자동으로 소진되고 있어요</td>
                                    <td>20-10-17</td>
                                    <td><button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#memberRegModal">대기중</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>회원가입시 부모님 명의로 가능한가요?</td>
                                    <td>20-10-17</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">답변완료</button></td>
                                </tr>
                                </tbody>
                            </table>


                            <div class="alert alert-sm alert-success my-2 p-2">
                                <div class="bold font-weight-bold">개발가이드</div>
                                1. 가맹점 1:1 문의내용만 <br>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="primaryalarm" role="tabpanel">

                            <form name="search" action="/manager/member_list.html?menu=">
                                <input type="hidden" name="mode" value="list">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#memberRegModal">신규발송하기</a>
                                    </div>
                                </div>
                            </form>

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">제목/내용</th>
                                    <th scope="col">발송일</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>SMS</td>
                                    <td>시간이 자동으로 소진되고 있어요</td>
                                    <td>20-10-17</td>
                                    <td><button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#memberRegModal">전송실패</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>SMS</td>
                                    <td>회원가입시 부모님 명의로 가능한가요?</td>
                                    <td>20-10-17</td>
                                    <td><button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">답변완료</button></td>
                                </tr>
                                </tbody>
                            </table>


                            <div class="alert alert-sm alert-success my-2 p-2">
                                <div class="bold font-weight-bold">개발가이드</div>
                                1. 회원에게 발송된 자동알람등의 내용으로 이용 가맹점 코드가 구분하고  해당 가맹점의 이용내역에 대한 내용만을 보여준다..<br>
                                2. SMS발송내역에 대한 DB 는 통합DB에 존재해야할것으로 생각됨.<br>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="points" role="tabpanel">

                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>

                                    <div class="col-md-4 col-sm-3 col-xs-12 mt-1">
                                        현재 총 30,000 포인트
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 mt-1">
                                        <input type="text" name="title" value="" placeholder="구분명" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                        <input type="text" name="point" value="" placeholder="포인트" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#memberRegModal">적립</a>
                                    </div>
                                </div>
                            </form>


                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">발생포인트</th>
                                    <th scope="col">발생일</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>환불</td>
                                    <td>45,000 </td>
                                    <td>20-10-17 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>이용권구매</td>
                                    <td>-4,000 </td>
                                    <td>20-10-17 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>이용권구매</td>
                                    <td>-40,000 </td>
                                    <td>20-10-17 00:00:00</td>
                                </tr>

                                </tbody>
                            </table>
                            <div class="alert alert-sm alert-success my-2 p-2">
                                <div class="bold font-weight-bold">개발가이드</div>
                                1. 가맹점(만)의 회원의 환불등은 가맹점 포인트에 적립됩니다.<br>
                                2. -(마이너스입력) 가능합니다.<br>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cashes" role="tabpanel">

                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>

                                    <div class="col-md-4 col-sm-3 col-xs-12 mt-1">
                                        현재 총 30,000 캐쉬
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 mt-1">
                                        <input type="text" name="title" value="" placeholder="구분명" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                        <input type="text" name="point" value="" placeholder="캐쉬" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#memberRegModal">적립</a>
                                    </div>
                                </div>
                            </form>


                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">발생캐쉬</th>
                                    <th scope="col">발생일</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>환불</td>
                                    <td>45,000 </td>
                                    <td>20-10-17 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>이용권구매</td>
                                    <td>-4,000 </td>
                                    <td>20-10-17 00:00:00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>이용권구매</td>
                                    <td>-40,000 </td>
                                    <td>20-10-17 00:00:00</td>
                                </tr>

                                </tbody>
                            </table>
                            <div class="alert alert-sm alert-success my-2 p-2">
                                <div class="bold font-weight-bold">개발가이드</div>
                                1. 가맹점(만)의 회원의 환불등은 가맹점 캐쉬에 적립됩니다.<br>
                                2. -(마이너스입력) 가능합니다.<br>
                                3. 캐쉬는 현금의 이동에 의한 온라인 통화로 현금 환불이 가능합니다.
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 좌석 정보 / 예약 폼 -->
    <div class="modal fade" id="seatReservFormModal" tabindex="-1" aria-labelledby="seatFormModalLabel" style="display: none;z-index:100000;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seatFormModalLabel">좌석번호 01 / 룸 M01</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body setInfoHtmnl">


                    <ul class="nav nav-tabs nav-primary navbar-xs mb-2 pd-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#seatCurrentInfo" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">좌석보기</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#seatCurrentTime" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bxs-time font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">예약 및 시간</div>
                                </div>
                            </a>
                        </li>
                    </ul>                    
                    <div class="tab-content py-3">

                        <!-- 1. 좌석정보보기 -->
                        <div class="tab-pane fade show active" id="seatCurrentInfo" role="tabpanel">
                            <div class="row col-12 mb-2">
                                <div class="col-8"><h6>이용자 : <span id="seatCurrentUserName"></span></h6></div>
                                <div class="col-4 text-right"><span class="btn btn-xs btn-info">외출중</span></div>
                            </div>
                            <div class="row col-12 mb-2">
                                <div class="col-5">입실시간</div>
                                <div class="col-7" id="seatCurrentSdate"></div>
                            </div>
                            <div class="row col-12 mb-2">
                                <div class="col-5">퇴실예정</div>
                                <div class="col-7" id="seatCurrentEdate"></div>
                            </div>

                            <hr/>
                            <div id="seatIotInfo">
                            </div>

                            <!--div class="row col-12 mb-2">
                                <div class="col-5">전원(IOT_02)</div>
                                <div class="col-7">

                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"> 켜짐</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-5">인터넷(IOT_03)</div>
                                <div class="col-7">

                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault3">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"> 켜짐</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-5">환풍기(IOT_04)</div>
                                <div class="col-7">

                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault4">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"> 켜짐</label>
                                    </div>

                                </div>
                            </div-->

                            <hr/>
                            <div class="row col-12 mb-2">
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        <h6>메모</h6>
                                        <div id="seatCurrentMemo">메모없음</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 mt-4 mb-2">
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_extForm').removeClass('d-none');">연장</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_outForm').removeClass('d-none');">퇴실</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_changeTimeForm').removeClass('d-none');">시간</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_changeSeatForm').removeClass('d-none');">이동</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_MemoForm').removeClass('d-none');">메모</button>
                                </div>
                            </div>

                            <div class="row col-12 mb-2 d-none seatExt" id="seatExt_extForm">
                                <div class="col-12">
                                    <h6>연장가능시간(최대)</h6>
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            <select class="form-control form-select-sm">
                                                <option>1시간( ~ 18:00 )</option>
                                                <option>2시간( ~ 19:00 )</option>
                                                <option>3시간( ~ 20:00 )</option>
                                                <option selected>4시간( ~ 21:00 )</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-sm btn-success">연장하기</button>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-success">
                                                <div>4시간 요금 60,000 ( A 등급좌석, 성인, 연장금액 )</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <div>연장가능한 시간이 없습니다.</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row col-12 mb-2 d-none seatExt" id="seatExt_changeTimeForm">
                                <div class="col-12">
                                    <h6>변경 가능시간</h6>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <select class="form-control form-select-sm">
                                                <option>15:00시부터</option>
                                                <option>16:00시부터</option>
                                                <option>17:00시부터</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <select class="form-control form-select-sm">
                                                <option selected>4시간( ~ 21:00 )</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-sm btn-success">변경하기</button>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <div>사용신청한 시간만큼 변경가능하며, 그외의 경우는 취소후 다시 예약해주세요.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <div>이미 예약시간이 초과되어 시간변경이 불가능합니다.</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row col-12 mb-2 d-none seatExt" id="seatExt_changeSeatForm">
                                <div class="col-12">
                                    <h6>변경 가능 좌석</h6>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <select class="form-control form-select-sm">
                                                <option>M01룸 02번좌석</option>
                                                <option>M01룸 07번좌석</option>
                                                <option>M01룸 15번좌석</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-sm btn-success">변경하기</button>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <div>잔여시간 1시간 미만은 좌석 변경이 불가능합니다.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <div>현재 변경가능한 좌석이 없습니다.</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row col-12 mb-2 d-none seatExt" id="seatExt_outForm">
                                <div class="col-12">
                                    <h6>현재시간부로 퇴실</h6>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-sm btn-primary">퇴실하기</button>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-success">
                                                <div>총 예약시간 6시간</div>
                                                <div>총 이용시간 2시간</div>
                                                <div>환불금액 60,000 ( A 등급좌석, 성인, 연장금액 )</div>
                                                <div>환불금액은 보유머니로 적립됩니다.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <div>이미 예약시간이 지났습니다.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <div>1시간이하는 환불금액이 없습니다.</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row col-12 mb-2 d-none seatExt" id="seatExt_MemoForm">
                                <div class="col-12">
                                    <h6>메모</h6>
                                    <div class="col-12"><textarea id="seat_memo" name="seat_memo" class="form-control"></textarea></div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="button" id="btn_save_memo" class="btn btn-sm btn-primary">저장하기</button>
                                </div>
                            </div>

                        </div>

                        <!-- 2. 예약하기 -->                        
                        <div class="tab-pane fade show"  id="seatCurrentTime" role="tabpanel">
                            <div class="row">
                                <div class="col-7">
                                    <form id="reservationForm" name="reservationForm">
                                
                                    <!-- 창구 -->
                                    <input type="hidden" name="rv_device_from" id="rv_device_from" value="A">
                                    <input type="hidden" name="rv_birth" id="rv_birth" value="">
                                    <input type="hidden" name="rv_ageType" id="rv_ageType" value="">
                                    <input type="hidden" name="rv_locker" id="rv_locker" value="">
                                    <input type="hidden" name="rv_member" id="rv_member" value="">
                                    <input type="hidden" name="rv_room" id="rv_room" value="">
                                    <input type="hidden" name="rv_seat" id="rv_seat" value="">
                                    <div class="row col-12 mb-2">
                                        <div class="col-4">이용자 <span class="btn_member_register btn btn-xs btn-info" nextStep="reservSeat">등록하기</span></div>
                                        <div class="col-8">
                                            <input name="rv_member_name" id="rv_member_name" style="ime-mode:disabled;" class="form-control form-control-sm mb-3 col-6 input_member" type="text" placeholder="클릭하여 회원검색" aria-label=".form-control-sm example" data-bs-toggle="modal" data-bs-target="#memberListModal"  search_mode="reservation">
                                            <div id="rv_birth_txt"></div>                                    
                                        </div>
                                    </div>
                                    <div class="row col-12 mb-2">
                                        <div class="col-4">이용권선택 <span class="btn btn-xs btn-info" id="btn_reserv_buyProduct" nextStep="reservSeat">상품구매</span></div>
                                        <div class="col-8" id="member_products">
                                            이용자를 먼저 선택해 주세요.
                                        </div>
                                    </div>
                                    <div class="row col-12 mb-2">
                                        <div class="col-4">입실시간</div>
                                        <div class="col-8">
                                            <div class="form-radio form-radio-inline">
                                                <input class="form-radio-input" type="radio" name="rv_type" id="rv_type_C" value="C" checked="checked">
                                                <label class="form-radio-label" for="inlineCheckbox1">현시간부터</label>
                                            </div>
                                            <div class="form-radio form-check-inline">
                                                <input class="form-radio-input" type="radio" name="rv_type" id="rv_type_R" value="R">
                                                <label class="form-radio-label" for="inlineCheckbox1">예약</label>
                                            </div>
        
                                            <input name="rv_sdate" id="rv_sdate" class="form-control form-control-sm mb-3 col-6" type="date" value="<?=date('Y-m-d')?>" placeholder="날자" aria-label=".form-control-sm example">
                                            <input name="rv_stime" id="rv_stime" class="form-control form-control-sm mb-3 col-6" type="time" id="stime" placeholder="시간" aria-label=".form-control-sm example">
                                        </div>
                                    </div>
                                    <div class="row col-12 mb-2">
                                        <div class="col-4">사용시간</div>
                                        <div class="col-8">
                                            <select name="rv_duration" id="rv_duration" class="form-select form-select-sm mb-3" aria-label="Default select example">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-12 mb-2">
                                        <div class="col-4">퇴실시간</div>
                                        <div class="col-8">
                                            <input name="rv_edate" id="rv_edate" class="form-control form-control-sm mb-3 col-6" type="date" name="edate" placeholder="날자" aria-label=".form-control-sm example">
                                            <input name="rv_etime" id="rv_etime" class="form-control form-control-sm mb-3 col-6" type="time" name="etime" placeholder="시간" aria-label=".form-control-sm example">
                                        </div>
                                    </div>
        
                                    <!--div class="row col-12 mb-2">
                                        <div class="col-4">요금</div>
                                        <div class="col-8">
                                            <input name="rv_price" id="rv_price" class="form-control form-control-sm mb-3 col-6" type="text" placeholder="구매금액" aria-label=".form-control-sm example">
                                        </div>
                                    </div>
        
                                    <div class="row col-12 mb-2">
                                        <div class="col-4">결제</div>
                                        <div class="col-8">
                                            <select name="rv_pay_kind" id="rv_pay_kind" class="form-select form-select-sm mb-3" aria-label="Default select example">
                                                <option selected="">결제방법</option>
                                                <option value="1">현금</option>
                                                <option value="2">카드</option>
                                            </select>
                                        </div>
                                    </div>
        
        
                                    <div class="row col-12 mb-2">
                                        <div class="col-4">결제여부</div>
                                        <div class="col-8">
                                            <select name="rv_pay_state" id="rv_pay_state" class="form-select form-select-sm mb-3" aria-label="Default select example">
                                                <option value="N">대기</option>
                                                <option value="Y">완료</option>
                                            </select>
                                        </div>
                                    </div-->
        
                                    <div class="row justify-content-center mt-3" id="reserveSeat_msg">
                                        
                                    </div>
        
                                    <div class="row justify-content-center">
                                        <button type="button" id="btn_reserv" class="btn btn-primary col-5">확  인 </button>
                                    </div>
        
                                    </form>                            
                                </div>
                                <div class="col-5">
                                    시간표 2021-10-10
                                    <div id="time_table">
                                        <!--div class="row border-bottom border-top">
                                            <div class="col-3 border-right">01</div>
                                            <div class="col-9 bg-secondar text-white">조현준</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">02</div>
                                            <div class="col-9 bg-secondary text-white">조현준</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">03</div>
                                            <div class="col-9 bg-secondary text-white">조현준</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">04</div>
                                            <div class="col-9 bg-secondary text-white">조현준</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">05</div>
                                            <div class="col-9 bg-info">조현준</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">06</div>
                                            <div class="col-9 bg-info">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">07</div>
                                            <d-iv class="col-9 bg-info">최현우</d-iv>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">08</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">09</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">09:30</div>
                                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('09:30:00')">예약가능</button></div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">10</div>
                                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('10:00:00')">예약가능</button></div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">11</div>
                                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('11:00:00')">예약가능</button></div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">12</div>
                                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('12:00:00')">예약가능</button></div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">13</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">14</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">15</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">16</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">17</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">18</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">19</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">20</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">21</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">22</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">23</div>
                                            <div class="col-9">최현우</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-3 border-right">24</div>
                                            <div class="col-9">최현우</div>
                                        </div-->
                                    </div>
                                    <div class="alert alert-info">시간을 클릭한후 왼쪽 폼에서 수정가능합니다.</div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- 긴급 IOT 세팅 -->
    <div class="modal fade" id="controlGlobalModal" tabindex="-3" aria-labelledby="controlGlobalModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="controlGlobalModalLabel">긴급IOT컨트롤</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="seatLevelInfo" role="tabpanel">

                            <form class="row g-3">


                                <div class="row col-12 mb-2">
                                    <div class="col-5">조명(IOT_01)</div>
                                    <div class="col-7">

                                        <div class="form-check form-switch form-switch-md">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> 켜짐</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row col-12 mb-2">
                                    <div class="col-5">전원(IOT_02)</div>
                                    <div class="col-7">

                                        <div class="form-check form-switch form-switch-md">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> 켜짐</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row col-12 mb-2">
                                    <div class="col-5">인터넷(IOT_03)</div>
                                    <div class="col-7">

                                        <div class="form-check form-switch form-switch-md">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> 켜짐</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row col-12 mb-2">
                                    <div class="col-5">환풍기(IOT_04)</div>
                                    <div class="col-7">

                                        <div class="form-check form-switch form-switch-md">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> 켜짐</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-warning px-5">확인</button>
                                </div>


                            </form>

                        </div>

                        <div class="tab-pane fade" id="seatLevelPrice1" role="tabpanel">

                            <div>
                                <div style="width:100%;text-align:left; font-size:12pt;padding:10px;color:#d07070">1시간을 기준으로 요금표 만들기</div>

                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-2 text-center">#</th>
                                        <th scope="col" class="col-3 text-center">합계</th>
                                        <th scope="col" class="col-3 text-center">독서실요금</th>
                                        <th scope="col" class="col-3 text-center">스터디룸요금</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" rowspan="2">기본</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_A_t" name="seat_price[student][A][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rroom col-12" id="price_student_A_r" name="seat_price[student][A][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sroom col-12" id="price_student_A_s" name="seat_price[student][A][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="number" class="in_price adult total col-12" id="price_adult_A_t" name="seat_price[adult][A][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rroom col-12" id="price_adult_A_r" name="seat_price[adult][A][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sroom col-12" id="price_adult_A_s" name="seat_price[adult][A][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="2">신규</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_N_t" name="seat_price[student][N][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rroom col-12" id="price_student_N_r" name="seat_price[student][N][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sroom col-12" id="price_student_N_s" name="seat_price[student][N][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="number" class="in_price adult total col-12" id="price_adult_N_t" name="seat_price[adult][N][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rroom col-12" id="price_adult_N_r" name="seat_price[adult][N][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sroom col-12" id="price_adult_N_s" name="seat_price[adult][N][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="2">연장</th>
                                        <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_X_t" name="seat_price[student][X][T]" value="" placeholder="학생 요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student rroom col-12" id="price_student_X_r" name="seat_price[student][X][R]" value="" placeholder="학생 독서실요금"></td>
                                        <td class=" text-center"><input type="number" class="in_price student sroom col-12" id="price_student_X_s" name="seat_price[student][X][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="number" class="in_price adult total col-12" id="price_adult_X_t" name="seat_price[adult][X][T]" value="" placeholder="성인 요금"></td>
                                        <td><input type="number" class="in_price adult rroom col-12" id="price_adult_X_r" name="seat_price[adult][X][R]" value="" placeholder="성인 독서실요금"></td>
                                        <td><input type="number" class="in_price adult sroom col-12" id="price_adult_X_s" name="seat_price[adult][X][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="2">1시간당 할인율</th>
                                        <td class=" text-center">
                                            <input type="number" class="in_price student rroom col-12 mb-2" id="rate_student" name="rate_student" value="" placeholder="학생할인율">
                                            <input type="number" class="in_price student sroom col-12 mb-2" id="rate_adult" name="rate_adult" value="" placeholder="성인할인율">
                                        </td>
                                        <td class=" text-center"></td>
                                    </tr>

                                    </tbody>
                                </table>

                                <div class="row justify-content-center my-3">
                                    <button type="button" class="btn btn-primary col-5">생성</button>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="seatLevelPrice2" role="tabpanel">
                            <div style="width:100%;text-align:left; font-size:12pt;padding:10px;color:#d07070">1일차를 기준으로 요금표 만들기</div>

                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th scope="col" class="col-2 text-center">#</th>
                                    <th scope="col" class="col-3 text-center">합계</th>
                                    <th scope="col" class="col-3 text-center">독서실요금</th>
                                    <th scope="col" class="col-3 text-center">스터디룸요금</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row" rowspan="2">기본</th>
                                    <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_A_t" name="seat_price[student][A][T]" value="" placeholder="학생 요금"></td>
                                    <td class=" text-center"><input type="number" class="in_price student rroom col-12" id="price_student_A_r" name="seat_price[student][A][R]" value="" placeholder="학생 독서실요금"></td>
                                    <td class=" text-center"><input type="number" class="in_price student sroom col-12" id="price_student_A_s" name="seat_price[student][A][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                </tr>
                                <tr>
                                    <td><input type="number" class="in_price adult total col-12" id="price_adult_A_t" name="seat_price[adult][A][T]" value="" placeholder="성인 요금"></td>
                                    <td><input type="number" class="in_price adult rroom col-12" id="price_adult_A_r" name="seat_price[adult][A][R]" value="" placeholder="성인 독서실요금"></td>
                                    <td><input type="number" class="in_price adult sroom col-12" id="price_adult_A_s" name="seat_price[adult][A][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                </tr>
                                <tr>
                                    <th scope="row" rowspan="2">신규</th>
                                    <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_N_t" name="seat_price[student][N][T]" value="" placeholder="학생 요금"></td>
                                    <td class=" text-center"><input type="number" class="in_price student rroom col-12" id="price_student_N_r" name="seat_price[student][N][R]" value="" placeholder="학생 독서실요금"></td>
                                    <td class=" text-center"><input type="number" class="in_price student sroom col-12" id="price_student_N_s" name="seat_price[student][N][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                </tr>
                                <tr>
                                    <td><input type="number" class="in_price adult total col-12" id="price_adult_N_t" name="seat_price[adult][N][T]" value="" placeholder="성인 요금"></td>
                                    <td><input type="number" class="in_price adult rroom col-12" id="price_adult_N_r" name="seat_price[adult][N][R]" value="" placeholder="성인 독서실요금"></td>
                                    <td><input type="number" class="in_price adult sroom col-12" id="price_adult_N_s" name="seat_price[adult][N][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                </tr>
                                <tr>
                                    <th scope="row" rowspan="2">연장</th>
                                    <td class=" text-center"><input type="number" class="in_price student total col-12" id="price_student_X_t" name="seat_price[student][X][T]" value="" placeholder="학생 요금"></td>
                                    <td class=" text-center"><input type="number" class="in_price student rroom col-12" id="price_student_X_r" name="seat_price[student][X][R]" value="" placeholder="학생 독서실요금"></td>
                                    <td class=" text-center"><input type="number" class="in_price student sroom col-12" id="price_student_X_s" name="seat_price[student][X][S]" value="" placeholder="학생 스터디룸 요금"></td>
                                </tr>
                                <tr>
                                    <td><input type="number" class="in_price adult total col-12" id="price_adult_X_t" name="seat_price[adult][X][T]" value="" placeholder="성인 요금"></td>
                                    <td><input type="number" class="in_price adult rroom col-12" id="price_adult_X_r" name="seat_price[adult][X][R]" value="" placeholder="성인 독서실요금"></td>
                                    <td><input type="number" class="in_price adult sroom col-12" id="price_adult_X_s" name="seat_price[adult][X][S]" value="" placeholder="성인 스터디룸 요금"></td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="2">1시간당 할인율</th>
                                    <td class=" text-center">
                                        <input type="number" class="in_price student rroom col-12 mb-2" id="rate_student" name="rate_student" value="" placeholder="학생할인율">
                                        <input type="number" class="in_price student sroom col-12 mb-2" id="rate_adult" name="rate_adult" value="" placeholder="성인할인율">
                                    </td>
                                    <td class=" text-center"></td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="row justify-content-center my-3">
                                <button type="button" class="btn btn-primary col-5">생성</button>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 좌석이용상태 --> 
    <div class="modal fade" id="useInfoModal" tabindex="-2" aria-labelledby="useInfoModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal- md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seatStatusModalLabel">구매/이용정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row col-12 mb-2">
                        <div class="col-8"><h6>이용자 : 조현준</h6></div>
                        <div class="col-4 text-right"><span class="btn btn-xs btn-info">외출중</span></div>
                    </div>
                    <div class="row col-12 mb-2">
                        <div class="col-5">상품명</div>
                        <div class="col-7">시간권 ( 20 시간 )</div>
                    </div>
                    <div class="row col-12 mb-2">
                        <div class="col-5">구매일시</div>
                        <div class="col-7">2020-11-26 17:00</div>
                    </div>
                    <div class="row col-12 mb-2">
                        <div class="col-5">사용시간</div>
                        <div class="col-7">16시간</div>
                    </div>
                    <div class="row col-12 mb-2">
                        <div class="col-5">잔여시간</div>
                        <div class="col-7">04시간</div>
                    </div>

                    <div class="row col-12 mb-2">
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <h6>메모</h6>
                                <div>학교에서 바로 오기 때문에 시간변동 가능성 있음 양해바람.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-12 mt-4 mb-2">
                        <div class="col-5">
                            <button type="button" class="btn btn-sm btn-warning col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_outForm').removeClass('d-none');">환불요청</button>
                        </div>
                        <div class="col-5">
                            <button type="button" class="btn btn-sm btn-outline-secondary col-12 mx-1 mb-1" onclick="$('.seatExt').addClass('d-none');$('#seatExt_MemoForm').removeClass('d-none');">메모</button>
                        </div>
                    </div>

                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_extForm">
                        <div class="col-12">
                            <h6>연장가능시간(최대)</h6>
                            <div class="row mb-2">
                                <div class="col-8">
                                    <select class="form-control form-select-sm">
                                        <option>1시간( ~ 18:00 )</option>
                                        <option>2시간( ~ 19:00 )</option>
                                        <option>3시간( ~ 20:00 )</option>
                                        <option selected>4시간( ~ 21:00 )</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-sm btn-success">연장하기</button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        <div>4시간 요금 60,000 ( A 등급좌석, 성인, 연장금액 )</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>연장가능한 시간이 없습니다.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_changeTimeForm">
                        <div class="col-12">
                            <h6>변경 가능시간</h6>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <select class="form-control form-select-sm">
                                        <option>15:00시부터</option>
                                        <option>16:00시부터</option>
                                        <option>17:00시부터</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-control form-select-sm">
                                        <option selected>4시간( ~ 21:00 )</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-sm btn-success">변경하기</button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>사용신청한 시간만큼 변경가능하며, 그외의 경우는 취소후 다시 예약해주세요.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>이미 예약시간이 초과되어 시간변경이 불가능합니다.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_changeSeatForm">
                        <div class="col-12">
                            <h6>변경 가능 좌석</h6>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <select class="form-control form-select-sm">
                                        <option>M01룸 02번좌석</option>
                                        <option>M01룸 07번좌석</option>
                                        <option>M01룸 15번좌석</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-sm btn-success">변경하기</button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>잔여시간 1시간 미만은 좌석 변경이 불가능합니다.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>현재 변경가능한 좌석이 없습니다.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_outForm">
                        <div class="col-12">
                            <h6>현재시간부로 퇴실</h6>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <button type="button" class="btn btn-sm btn-primary">퇴실하기</button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        <div>총 예약시간 6시간</div>
                                        <div>총 이용시간 2시간</div>
                                        <div>환불금액 60,000 ( A 등급좌석, 성인, 연장금액 )</div>
                                        <div>환불금액은 보유머니로 적립됩니다.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>이미 예약시간이 지났습니다.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div>1시간이하는 환불금액이 없습니다.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row col-12 mb-2 d-none seatExt" id="seatExt_MemoForm">
                        <div class="col-12">
                            <h6>메모111</h6>
                            <div class="col-12"><textarea name="seat_memo" class="form-control"></textarea></div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#seatReservFormModal">이좌석 예약하기</button>
                </div>
            </div>
        </div>
    </div>

    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2021. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
        </div>
        <hr/>
        <h6 class="mb-0">Theme Styles</h6>
        <hr/>
        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                <label class="form-check-label" for="lightmode">Light</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                <label class="form-check-label" for="darkmode">Dark</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                <label class="form-check-label" for="semidark">Semi Dark</label>
            </div>
        </div>
        <hr/>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
            <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
        </div>
        <hr/>
        <h6 class="mb-0">Header Colors</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
            </div>
        </div>
        <hr/>
        <h6 class="mb-0">Sidebar Backgrounds</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="manualPlayerModal" tabindex="-2" aria-labelledby="manualPlayerModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualPlayerModalLabel">메뉴얼</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="manualPlayerHtml">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--end switcher-->
<!-- Bootstrap JS -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--script src="/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script-->
<!--script src="/assets/js/index5.js"></script-->
<!--app JS-->
<script src="/assets/js/app.js"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<!-- 시계 -->
<script src="/assets/js/topTimer.js"></script>
<style>
    .time_pop { background-color: black; color:white;}
 </style>
<script>
    $( function () {
        $( '[data-toggle="popover"]' ).popover()
    });

    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd", // 텍스트 필드에 입력되는 날짜 형식.
            changeMonth: true, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
            changeYear: true, // 년을 바꿀 수 있는 셀렉트 박스를 표시한다.
            nextText: '다음 달', // next 아이콘의 툴팁.
            prevText: '이전 달', // prev 아이콘의 툴팁.
            yearRange: 'c-10:c+2', // 년도 선택 셀렉트박스를 현재 년도에서 이전, 이후로 얼마의 범위를 표시할것인가.
            numberOfMonths: [1,1], // 한번에 얼마나 많은 월을 표시할것인가. [2,3] 일 경우, 2(행) x 3(열) = 6개의 월을 표시한다.
            dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'], // 요일의 한글 형식.
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식.
            showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다.
            currentText: '오늘 날짜' , // 오늘 날짜로 이동하는 버튼 패널
            closeText: '닫기',  // 닫기 버튼 패널
            /*
              minDate: '-100y', // 현재날짜로부터 100년이전까지 년을 표시한다.
              showButtonPanel: true, // 캘린더 하단에 버튼 패널을 표시한다.
                buttonImage: "images/cal.jpg", // 버튼 이미지
            */
        });
    });

    $('#memberListModal').on('shown.bs.modal', function (e) {
        $("#search_member_q").focus();
    });

    $(".btn_logout").on("click",function(){
        var req = "step=logout";
        console.log(req);
        $.get( "/logout", req, function( res ) {
        console.log(res);
            if( res.result == true ){
                var rURL = res.rURL;
                location.href = "/partnerlogin";
            }
        });
    });

    $(".btn_manual").on("click",function(){
        let b_no = $(this).attr("rel");
        let url = "/manual/vod/gethtml/" + b_no;
        $.get( url, function( res ) {
            $("#manualPlayerModalLabel").html(res.title);
            $("#manualPlayerHtml").html(res.html);
            $("#manualPlayerModal").modal("show");
        });
    });

    $("#iot_1").click(function(){
        var check = $(this).prop('checked');
        let url = "/mqtt/put";
        if(check == true) {
            $.post( url, function( res ) {
                $("#iot_1").html(res);
            });
        } else {
            alert(2);
        }
    });

    function getDuration( mode ){
        let today = new Date();
        let year = today.getFullYear(); // 년도
        let month = today.getMonth() + 1;  // 월
        let date = today.getDate();  // 날짜
        let day = today.getDay();  // 요일

        if( month < 10 ) month = "0" + String(month);
        if( date < 10 ) date = "0" + String(date);

        if( mode != undefined ) {
            if (mode == "Y") {
                let sdate = year + "-" + month + "-" + "01";
                let edate = year + "-" + month + "-" + date;
            }
            if (mode == "M") {
                let sdate = year + "-" + month + "-" + "01";
                let edate = year + "-" + month + "-" + date;
            }
            if (mode == "D") {
                let sdate = year + "-" + month + "-" + date;
                let edate = year + "-" + month + "-" + date;
            }
        }


        return year + "-" + month + "-" + date;
    }

    function getDate( mode, val ){
        let today = new Date();
        let year = today.getFullYear(); // 년도
        let month = today.getMonth() + 1;  // 월
        let date = today.getDate();  // 날짜
        let day = today.getDay();  // 요일

        if( mode != undefined ) {
            if (mode == "Y") {
                year = year + val;
                date = date - 1;
            }
            if (mode == "M") {
                month = month + val;
                date = date - 1;
            }
            if (mode == "D") {
                date = date + val;
            }

        }

        if( month < 10 ) month = "0" + String(month);
        if( date < 10 ) date = "0" + String(date);

        return year + "-" + month + "-" + date;
    }
    </script>



    <script>

        var seat_info = {};
        var seat_levels = {};
        var user_sex = "M";
        var member_info = {};
        var product_info = {};
        var user_ageType = "A";
        var setPriceOpt = {};
        var product_arr = [];
        var member_search_mode = "";
        var nextStepBuyProudct = "";



        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // 회원정보 띄우기
            $(document).on("click",".btn_member_register",function(){
                mreg_next_mode = true;
                var nextStep = $(this).attr("nextStep");
                member_register(nextStep);
            });

            // 회원정보 띄우기
            $(document).on("click",".member_view",function(){
                var no = $(this).attr('no');
                member_viewer(no);
            });

            // 타임테이블 마우스오버
            $(document).on("mouseover",".time_row",function(){
                $(this).find('div').addClass("time_pop");
            });

            // 타임테이블 마우스오버
            $(document).on("mouseout",".time_row",function(){
                $(this).find('div').removeClass("time_pop");
            });

            // 시작시간 설정
            $(document).on("click",".time_row",function(){
                var dt = $(this).attr("dt").split(" ");
                $("#rv_sdate").val(dt[0]);
                $("#rv_stime").val(dt[1]);

                // 기간이 선택되었다면 종료시간 선택
                console.log("종료시간 선택 : 실행시작");
                resetLastTime();
                console.log("종료시간 선택 : 실행후");
            });

            $(document).on("click",".input_member",function(){
                member_search_mode = $(this).attr("search_mode");
            });
            
            // 좌석선택
            $(document).on("click",".btn_seat",function(){
                var no = $(this).attr("seat");
                console.log("선택된 좌석:" + no);
                
                if( no ) {
                    seat_getInfo(no, CurrentDate);
                    seat_getReserveInfo(no, CurrentDate);
                    //$("#seatStatusModal").modal("show");
                } 
                setSdateFromCurrentTime();
            });            

            // 시간선택
            $(document).on("change","#rv_duration",function(){
                var time = $(this).val();
                console.log(time);
                console.log("사용자 학생여부" + user_ageType);
                // 기본금액을 보여주기 위해서 사용자 선택이 안됐다면 학생요금을 보여줌
                if( user_ageType == "") user_ageType = "S";

                var price = seat_info.seat_level.sl_price_time[time][user_ageType]['N']['T'];
                $("#rv_price").val(price);
            });  

            // 회원선택
            $(document).on("click",".member_item",function(){
                var mb_no = $(this).attr("rel");
                if( mb_no ) {
                    member_getInfo(mb_no);
                } else {
                    $("#frm_member #no").val("");
                    $("#frm_member #step").val("add");
                }
            });

            // 상품구매버튼
            $(document).on("click","#btn_util_buyProduct,#btn_reserv_buyProduct ",function(){

                // 가맹점상품가져와서 업데이트
                getProduct();

                // 좌석레벨가져와서 업데이트
                seatlevel_setList();

                nextStepBuyProudct = $(this).attr("nextStep");
                console.log("nextStepBuyProudct = "+nextStepBuyProudct);
                console.log(member_info.name);

                if( nextStepBuyProudct == "reservSeat") {
                    $("#buyProduct_row_seat_info").removeClass("d-none");
                    $("#buyProduct_row_seat_info #buyProduct_seat_info").html("");                    
                    console.log("좌석에서 왔음");
                    console.log(seat_info);
                    var html = "좌석번호 :" + seat_info.seat.s_no + "<br>" + seat_info.seat_level.sl_name + "<br>";

                    console.log(html);
                    // 좌석정보
                    $("#buyProduct_row_seat_info #buyProduct_seat_info").html( html );

                    // 좌석등급자동선택
                    console.log("좌석등급 자동선택 : "+seat_info.seat_level.sl_no);
                    $("#productBuyForm #b_seatlevel").val(seat_info.seat_level.sl_no);
                }
                // 선택된 회원이 있다면 선택
                $("#productBuyForm #b_member").val(member_info.no);
                $("#productBuyForm #b_member_name").val(member_info.name);
                

                $("#productBuyFormModal").modal("show");                
            });
            
            // 회원선택
            $(document).on("click",".btn_member_select",function(){
                $("#memberListModal").modal("hide");
                var m_no = $(this).attr("mb");
                console.log("회원번호:"+m_no);
                member_setBuyer(m_no);

                setPriceSeat();
            });

            // 등급선택
            $(document).on("change","#b_seatlevel",function(){
                setPriceOpt.seat_level = $(this).val();     
                setPriceSeat();
            }); 

            // 상품선택
            $('input[name="b_product_kind"]').change(function() {
                // 모든 radio를 순회한다.
                $('input[name="b_product_kind"]').each(function() {
                    if( $(this).prop('checked') == true ) {

                        setPriceOpt.b_product_kind  = $(this).val();
                        console.log(setPriceOpt.b_product_kind);
                        
                        if( setPriceOpt.b_product_kind == "A" ) {
                            console.log("하루이용권");
                            $('#b_duration').empty();
                            $.each(product_arr['A'], function(duration){
                                var option = $('<option value="'+duration+'">'+duration+'일</option>');
                                $('#b_duration').append(option);
                            });        
                        }

                        if( setPriceOpt.b_product_kind == "T" ) {
                            console.log("시간권");
                            console.log(product_arr['T']);
                            $('#b_duration').empty();
                            $.each(product_arr['T'], function(key, duration){
                                var option = $('<option value="'+duration+'">'+duration+'시간</option>');
                                $('#b_duration').append(option);
                            });        
                        }

                        if( setPriceOpt.b_product_kind == "D" || setPriceOpt.b_product_kind == "F" ) {
                            $('#b_duration').empty();
                            $.each(product_arr['D'], function(key, duration){
                                var option = $('<option value="'+duration+'">'+duration+'일</option>');
                                $('#b_duration').append(option);
                            });        
                        }

                        if( setPriceOpt.b_product_kind == "F" ) {
                            $('#b_duration').empty();
                            $.each(product_arr['F'], function(key, duration){
                                var option = $('<option value="'+duration+'">'+duration+'개월</option>');
                                $('#b_duration').append(option);
                            });        
                        }

                        if( setPriceOpt.b_product_kind == "P" ) {
                            $('#b_duration').empty();
                            $.each(product_arr['P'], function(key, price){
                                var option = $('<option value="'+price+'">'+price+'원'+'</option>');
                                $('#b_duration').append(option);
                            });        
                        }


                        setPriceOpt.duration = $('#b_duration').val();  
                    }
                });

                setPriceSeat();
                
            });


            // 기간선택
            $(document).on("change","#b_duration",function(){
                setPriceOpt.duration = $(this).val();  
                setPriceSeat();
            });


            // 사물함 검색
            $(document).on("click","#btn_search_locker",function(){
                $("#lockerListModal").modal("show");
                var req = "";
                $.ajax({
                    url: '/product/searchLocker',
                    type: 'POST',
                    async: true,
                    beforeSend: function (xhr) {
                        $("#lockerDetail_msg").html("");
                    },
                    data: req,
                    success: function (res, textStatus, xhr) {
                        if( res.result == true ) {

                            console.log(res);
                            $('#locker_search_list').empty();
                            res.lockers.forEach(function( locker, li) {
                                console.log(locker);
                                var html = '';
                                html = html + '<tr>';
                                html = html + '    <td>' + locker.l_area + '</td>';
                                html = html + '    <td>' + locker.l_name + '</td>';
                                html = html + '    <td><button type="button" class="btn btn-xs btn-primary btn_locker_select" locker="' + locker.l_no + '" locker_name="' + locker.l_name + '">선택</button></td>';
                                html = html + '</tr>';
                                $('#locker_search_list').append(html);
                            });
                            
                        } else {
                            $("#lockerDetail_msg").html( res.message );
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log('PUT error.');
                    }
                });
            });
            
            // 사물함선택
            $(document).on("click",".btn_locker_select",function(){
                $("#lockerListModal").modal("hide");
                var l_no = $(this).attr("locker");
                var l_name = $(this).attr("locker_name");
                $("#b_locker").val(l_no);
                $("#b_locker_name").val(l_name);

                setPriceLocker();
            });

            // 요금변경시
            $(document).on("change","#b_price_seat, #b_price_locker",function(){
                var price_seat = parseInt($("#b_price_seat").val());     
                var price_locker = parseInt($("#b_price_locker").val());                     

                var price_total = price_seat + price_locker;
                $("#b_price_total").val(price_total);
            }); 
                        
            // 구매실행
            $(document).on("click","#btn_productBuy",function(){
                product_buy();
            });

            // 회원의 상품선택
            $(document).on("click",".user_product",function(){

                selected_seat_no = seat_info.seat.s_no;
                selected_product_kind = $(this).attr("kind");
                selected_product_no = $(this).val();

                setUserProduct(member_info.no, selected_seat_no, selected_product_no);

            });
            
            // 메모저장
            $(document).on("click","#btn_save_memo",function(){
                setUserResMemo($("#seat_memo").val());
            });
            
            // 시간선택
            $(document).on("change","#seatReservFormModal #rv_duration",function(){
                resetLastTime()
            });
            
            // 현시간부터 선택
            $(document).on("click","#rv_type_C",function(){
                setSdateFromCurrentTime();
            });

            // 예약/입실 버튼
            $(document).on("click","#btn_reserv",function(){
                reservSeat();
            });

            $(document).on("change",".iot_check",function(){
                iot_no = $(this).closest(".iot_dev").attr("iot");
                dev_no = $(this).closest(".iot_dev").attr("dev");
                status = $(this).prop("checked") ? "O" : "F";

                manager_publish(iot_no,dev_no,status);

            });

        });


        // 예약상태가져오기
        function SeatState() {

            formData = new FormData();

            $.ajax({
                url: '/reservation/reserveSeatState',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                //data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.result == true) {
                        res.seats.forEach(function(seat) {
                            console.log("예약있는거 확인"+seat.rv_member_name);
                            //모바일 $('.btn_seat[seat='+seat.s_no+']').children('a').addClass("type-off").removeClass("type-on");
                            $('.btn_seat[seat='+seat.s_no+']').addClass("on");
                            $('.btn_seat[seat='+seat.s_no+']').find(".name").html('<span style="font-size:10pt;">'+seat.rv_member_name+'</span>');
                        });
                    } else {
                        $("#eventDetail_msg").html(xhr.message);
                    }
                },   
                error: function (xhr, textStatus, errorThrown) {
                    $("#eventDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }


        // 시작시간
        function manager_publish(iot_no,dev_no,status){

            formData = new FormData();

            formData.append("iot_no",iot_no );
            formData.append("dev_no",dev_no );
            formData.append("status",status );

            $.ajax({
                url: '/mqtt/publish',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                //data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);

                },           
  
            });
        }


        // 시작시간
        function resetLastTime(){
            //$("#seatReservFormModal #rv_stime").val( CurrentTime );
            duration = $('#rv_duration').val();
            console.log( "선택된 기간 : " + duration );

            if( product_info ) {
                console.log( "상품정보 있음" );

                if( product_info.o_duration_type == "D") {
                    setLastTime("D",duration);   
                } else {
                    setLastTime("T",duration);   
                }

                //console.log( "변경시간 : " + DiffDate + " " + DiffTime );
                //$("#seatReservFormModal #rv_edate").val( DiffDate );
                //$("#seatReservFormModal #rv_etime").val( DiffTime );                    

            } else {
                console.log( "상품정보 없음" );
                $("#reserveSeat_msg").html( "이용자의 상품을 선택해주세요." );
            }
        }
        
        // 상품목록가져오기
        function getProduct(){
            $.ajax({
                url: '/setting/product/getProduct',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    //
                },
                //data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if( res.result == true ) {
                        product_arr = res.products;
                        console.log(product_arr['T']);

                    } else {
                        $("#reserveSeat_msg").html( res.message );
                    }                    

                },           
  
            });

        }

        // 좌석예약하기
        function reservSeat(){
            var req = $("#reservationForm").serialize();
            console.log(req);

            $.ajax({
                url: '/reservation/reserveSeat',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    //
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log("실행결과:");
                    console.log(res);
                    if( res.result == true ) {
                        $("#reserveSeat_msg").html( res.message );

                        // 회원의 상품다시 불러온다.
                        member_getProducts(member_info.no);

                        // 목록을 업데이트 해준다.
                        seat_getInfo(res.s_no, CurrentDate);
                        resved_list();
                    } else {
                        $("#reserveSeat_msg").html( res.message );
                    }                    

                },
                error: function(xhr, status, msg){
                    console.log(xhr);
                    console.log(xhr.responseJSON.file);
                    console.log(xhr.responseJSON.line);
                    console.log(xhr.responseJSON.message);                        
                }           
  
            });

        }
        
        // 회원정보 팝업창        
        function member_viewer(no){
            var url = "/member/popupInfo?no=" + no;
            window.open(url,"popup_member_"+ no,"width=900,height=800")
        }
        
        // 회원등록 팝업창
        function member_register( nestStep ){
            var url = "/member/popupReg";
            if( nestStep != undefined ) url = url  + "?nextStep=" + nestStep;
            window.open(url,"popup_member_new","width=900,height=800")
        }                

        // 상품선택시 상태 가져오기
        function setUserProduct(member, seat, product) {
            var req = "m=" + member_info.no + "&s=" + seat_info.seat.s_no + "&o=" + selected_product_no;

            console.log(req);
            $.ajax({
                url: '/member/productState',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    //$("#lockerDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res.product.o_product_kind);
                    console.log(res.product.o_duration);

                    // 전역변수에 추가
                    if( res.product ) product_info = res.product;
                    console.log(res.product.o_remainder);

                    if( res.product.o_product_kind == "A" ) {

                        console.log("하루이용권");                            
                        $('#rv_duration').empty();
                        var option = $('<option value="DAY">종료시까지</option>');
                        $('#rv_duration').append(option);

                        duration = $('#rv_duration').val();
                        setLastTime("D",duration);        
                    }

                    if( res.product.o_product_kind == "T" ) {
                        $('#rv_duration').empty();
                        $('#rv_duration').append('<option selected="">시간선택</option>');
                        for(var duration=1;duration<=res.product.o_duration;duration++){
                            var option = $('<option value="'+duration+'">'+duration+'시간</option>');
                            $('#rv_duration').append(option);
                        };   

                        duration = $('#rv_duration').val();
                        setLastTime("T",duration);  
                    }

                    if( res.product.o_product_kind == "P" ) {
                        $('#rv_duration').empty();
                        $('#rv_duration').append('<option selected="">포인트선택</option>');
                        for(var duration=1;duration<=res.product.o_duration;duration++){
                            var option = $('<option value="'+duration+'">'+duration+'포인트</option>');
                            $('#rv_duration').append(option);
                        };      

                        duration = $('#rv_duration').val();
                        setLastTime("D",duration);  
                    }

                    if( res.product.o_product_kind == "D" || res.product.o_product_kind == "F" ) {

                        console.log("여기까지"+res.product.o_duration);
                        $('#rv_duration').empty();
                        $('#rv_duration').append('<option value="0">기간선택</option>');
                        for(var duration=1;duration<=res.product.o_duration;duration++){
                            var option = $('<option value="'+duration+'">'+duration+'일</option>');
                            $('#rv_duration').append(option);
                        };       

                        duration = $('#rv_duration').val();
                        console.log("선택된 기간 : "+duration)
                        setLastTime("D",duration);

                    }

                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });  
        }

        // 현재시간을 시작시간으로 세팅
        function setSdateFromCurrentTime(){

            console.log( "현시간 : " + CurrentDate + " " + CurrentTime );
            $("#seatReservFormModal #rv_sdate").val( CurrentDate );
            $("#seatReservFormModal #rv_stime").val( CurrentTime );

            //getTimeDiff( "M", 3 );
            console.log( "변경시간 : " + DiffDate + " " + DiffTime );
            $("#seatReservFormModal #rv_edate").val( DiffDate );
            $("#seatReservFormModal #rv_etime").val( DiffTime );

        }

        // 종료시간 선택 ( 시작시간으로 부터 )     
        function setLastTime(DiffType, DiffValue){
            
            console.log( "계산파라미터 : " + DiffType + " " + DiffValue );

            if( DiffValue != undefined ) {
                rv_sdate = $("#rv_sdate").val();
                rv_stime = $("#rv_stime").val();
                console.log( "시작시간 : " + rv_sdate + "T" + rv_stime );

                Stime = new Date(rv_sdate + "T" + rv_stime);
                console.log( "시작타임 : " + Stime );

                if( DiffType == "D") {
                    //day
                    getTimeDiff( Stime, "D", DiffValue );
                } 
                if( DiffType == "T") {
                    //day
                    getTimeDiff( Stime, "H", DiffValue );
                } 

                $("#seatReservFormModal #rv_edate").val( DiffDate );
                $("#seatReservFormModal #rv_etime").val( DiffTime );
            }
        }

        // 총 금액 세팅  
        function setPriceTotal(){
            let price_seat = 0;
            let price_locker = 0;
            let price_total = 0;

            if( $("#b_price_seat").val() != "" && isNumber( $("#b_price_seat").val() ) ) {
                price_seat = parseInt( $("#b_price_seat").val() );     
            } 

            if( $("#b_price_locker").val() != "" && isNumber( $("#b_price_locker").val() ) ) {
                price_locker = parseInt( $("#b_price_locker").val() );     
            } 

            console.log("좌석금액 : "+price_seat);
            console.log("사물함금액 : "+price_locker);
            price_total = price_seat + price_locker;

            $("#b_price_total").val(price_total);
            $("#b_pay_money").val(price_total);
        }

        // 사물함금액세팅
        function setPriceLocker(){
            
            var price_locker = 0;

            console.log("사물한 금액세팅 : " + setPriceOpt.b_product_kind);
            if( setPriceOpt.b_product_kind == "A" ) {
                price_locker = 1000;

            }
            if( setPriceOpt.b_product_kind == "T" ) {
                price_locker = setPriceOpt.duration * 1000;
            }

            if( setPriceOpt.b_product_kind == "P" ) {
                price_locker = ceil(setPriceOpt.duration/31) * 10000;
            }

            if( setPriceOpt.b_product_kind == "D" || setPriceOpt.b_product_kind == "F" ) {
                price_locker = ceil(setPriceOpt.duration/31) * 10000;
            }            

            console.log("사물한 금액세팅");
            $("#b_price_locker").val(price_locker);
            setPriceTotal();

        }

        function setPriceSeat(){
            $("#price_seat_Detail").html("금액을 계산중...");

            if( member_info == undefined || member_info.ageType == undefined) {
                $("#price_seat_Detail").html("회원을 선택해주세요.");
                return;
            }
            if( setPriceOpt.seat_level == undefined ) {
                $("#price_seat_Detail").html("좌석등급을 선택해주세요.");
                return;
            }

            if( setPriceOpt.b_product_kind == undefined ) {
                $("#price_seat_Detail").html("이용권을 선택해주세요.");
                return;
            }

            if( setPriceOpt.seat_level == undefined ) {
                $("#price_seat_Detail").html("좌석등급을 선택해주세요.");
                return;
            }
            if( setPriceOpt.duration == undefined ) {
                $("#price_seat_Detail").html("기간을 선택해주세요.");
                return;
            }

            console.log("상품 : " + setPriceOpt.b_product_kind);
            console.log("기간 : " + setPriceOpt.duration);     
            console.log("좌석등급 : " + setPriceOpt.seat_level);     
            console.log("나이구분 : " + member_info.ageType);  

            console.log(setPriceOpt);

            if( setPriceOpt.b_product_kind == "D" ) {
                price_data = JSON.parse(seat_levels[setPriceOpt.seat_level].sl_price_day);
            } else if( setPriceOpt.b_product_kind == "T" ) {
                price_data = JSON.parse(seat_levels[setPriceOpt.seat_level].sl_price_time);
            }
            
            // 신규/(독서실/스터디룸)합계금액
            var price = price_data[setPriceOpt.duration][member_info.ageType]['N']['T'];
            $("#b_price_seat").val(price);
            $("#price_seat_Detail").html("");

            setPriceTotal();
        }

        // 상품구매
        function product_buy(){

            $("#productDetail_msg").html("처리중.....");
            var req = $("#productBuyForm").serialize();
            console.log(req);
            $.ajax({
                url: '/product/buyProduct',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#btn_productBuy").addClass("disabled");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if( res.result == true ) {
                        console.log("nextStepBuyProudct = "+nextStepBuyProudct);
                        if( nextStepBuyProudct == "reservSeat" ) {
                            $("#productBuyFormModal").modal("hide"); 
                            $("#seatReservFormModal").modal("show"); 

                            // 상품목록 다시 읽어 예약폼에 보여주고.
                            member_getProducts(member_info.no);

                            $("#reservationForm #rv_member").val(member_info.no);
                            $("#reservationForm #rv_member_name").val(member_info.name);  
                            
                            $("#reservationForm #rv_birth").val(member_info.birth);  
                            $("#reservationForm #rv_ageType").val(member_info.ageType);                             

                            // 방금 구매한 상품 선택한다.
                            $(".user_product[value='"+member_info.no+"']").prop("checked",true);
                            console.log( "구매번호:"+res.no );
                            
                            nextStepBuyProudct = "";
                        } else {
                            $("#productDetail_msg").html("구매가 완료되었습니다.");
                        }
                        //$("#productBuyFormModal").delay(3000).modal("hide");
                    } else {
                        $("#productDetail_msg").html(res.message);
                    }
                },           
                error: function (xhr, textStatus, errorThrown) {
                    $("#productDetail_msg").html(res.message);
                    console.log('PUT error.');
                },
                complete: function (data) {
                    $("#btn_productBuy").removeClass("disabled");
                }     
            });
        }

        // 좌석등급 가져와 보여주기
        function seatlevel_setList(){

            $.ajax({
                url: '/partner_api/seat_level/get_list',
                type: 'POST',
                async: false,
                beforeSend: function (xhr) {
                    //
                },
                //data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    seat_levels = res.seatlevels;
                    $('#b_seatlevel').empty();
                    
                    //seat_levels.forEach(function( seatlevel, si) {
                    for(key in seat_levels){
                        var option = $('<option value="'+seat_levels[key].sl_no+'">'+seat_levels[key].sl_name+'</option>');
                        $('#b_seatlevel').append(option);
                    };
                },           
  
            });
        }
        
        // 해당좌석 예약목록
        function resved_list() {
            $('#time_table').empty();

            for( var hi = 0; hi <= 23; hi++ ){
                var exist_hh = 0;
                var html = first_html = '';
                var hh = '';
                if( String(hi).length == 2 ) hh = hi;
                else if( String(hi).length == 1 ) hh = "0" + hi;

                //console.log("시간:"+hh);
                //console.log(seat_info.reserved[hh]);

                if( seat_info.reserved[hh].length > 0  ) {
                    for(key in seat_info.reserved[hh]){
                        if( seat_info.reserved[hh][key].rv_no != undefined && seat_info.reserved[hh][key].rv_no > 0 ) {

                            html = html + '<div class="row border-bottom time_row" dt="' + CurrentDate + ' ' + seat_info.reserved[hh][key].hi + ':00">';
                            html = html + '    <div class="col-3 border-right">'+seat_info.reserved[hh][key].hi+'</div>';
                            html = html + '    <div class="col-9 bg-info" rv="'+seat_info.reserved[hh][key].rv_no+'">'+seat_info.reserved[hh][key].rv_member_name+'</div>';
                            html = html + '</div>';
                        }

                        //console.log(seat_info.reserved[hh][key].hi);
                        if( seat_info.reserved[hh][key].hi == hh + ":00" ) {
                            exist_hh++;
                            //console.log(hh+" 있음...");
                        }
                    };                
                } 
                // 정각 00:00 건이 존재 하지 않거나 없으면 
                if( exist_hh == 0 || seat_info.reserved[hh].length < 1 ) {
                    first_html = first_html + '<div class="row border-bottom time_row" dt="' + CurrentDate + ' ' + hh + ':00:00">';
                    first_html = first_html + '    <div class="col-3 border-right">'+hh+':00</div>';
                    first_html = first_html + '    <div class="col-9 bg-white" rv="">예약가능</div>';
                    first_html = first_html + '</div>';
                }          
                
                html = first_html + html;
                $('#time_table').append(html);

            };    
        }

        function setUserResMemo(memo) {

            formData = new FormData();

            formData.append("rv",current_rv );
            formData.append("memo",memo );

            $.ajax({
                url: '/reservation/setUserResMemo',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                success: function (res, textStatus, xhr) {
                    console.log(res);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    console.log(xhr.responseJSON.file);
                    console.log(xhr.responseJSON.line);
                    console.log(xhr.responseJSON.message);
                }
            });   
        }

        var current_rv = 0

        // 해당좌석 예약정보 ( 현시간 예약 정보만 )
        function seat_getReserveInfo(no){

            $("#seatCurrentUserName").html("예약없음");
            $("#seatCurrentSdate").html("예약없음");
            $("#seatCurrentEdate").html("예약없음");
            $("#seatReservFormModal #seatCurrentMemo").html(""); 

            var req = "seat=" + no ;
            console.log("예약정보요청 : " + req);
            $.ajax({
                url: '/reservation/getSeatReserveInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#memberDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    
                    $("#seatIotInfo").empty();

                    console.log("예약정보가져왔음.");
                    console.log(res.currentReserve);

                    current_rv = res.currentReserve.rv_no

                    if( res.currentReserve.rv_memo ) {
                        $("#seatReservFormModal #seatCurrentMemo").html(res.currentReserve.rv_memo); 
                    } else {
                        $("#seatReservFormModal #seatCurrentMemo").html(""); 
                    }

                    if( res.currentReserve ) {
                        $("#seatCurrentUserName").html(res.currentReserve.rv_member_name);
                        $("#seatCurrentSdate").html(res.currentReserve.rv_sdate);
                        $("#seatCurrentEdate").html(res.currentReserve.rv_edate);
                    } else {
                        $("#seatCurrentUserName").html("예약없음");
                        $("#seatCurrentSdate").html("예약없음");
                        $("#seatCurrentEdate").html("예약없음");
                    }


                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });            
  
        }

        // 상품에서 선택할수 있는 시간 목록세팅
        function resrve_setting_time(){

            console.log(seat_info.seat_level.sl_price_time);

            $.each(seat_info.seat_level.sl_price_time, function(duration, price_arr){
                var option = $('<option value="'+duration+'">'+duration+'시간</option>');
                $('#rv_duration').append(option);
            });           
            
            setPriceSeat(); 

            //seat_info.seat_level.sl_price_time.forEach( index, price_time ) => {
            //    console.log(index,price_time );
            //});
        }

        // 좌석정보 가져오기           
        function seat_getInfo(no, dt){
            var req = "no=" + no ;
            if( dt != undefined )  req = req + "&dt=" + dt;
            console.log(req);
            $.ajax({
                url: '/reservation/getSeatInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#memberDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    
                    seat_info = res;
                    console.log(seat_info);

                    console.log("IOT 정보 ===========");
                    console.log(res.seat_iot);

                    if( res.seat_iot ) {

                        res.seat_iot.forEach(function (item, index, array) {
                            console.log("IOT 정보 ");
                            console.log(item);

                            var html = ''
                            html += '<div class="row col-12 mb-2 iot_dev" dev="'+item.dev+'" iot="'+item.no+'">';
                            html += '    <div class="col-5">'+item.name+'</div>';
                            html += '    <div class="col-7">';
                            html += '        <div class="form-check form-switch form-switch-md">';
                            html += '            <input class="form-check-input iot_check" type="checkbox" id="iot_'+item.no+'" value="Y">';
                            html += '            <label class="form-check-label" for="iot_'+item.no+'"> 켜짐</label>';
                            html += '        </div>';
                            html += '        <div id="iot_1_msg"></div>';
                            html += '    </div>';
                            html += '</div>';

                            $("#seatIotInfo").append(html);
                        })                        

                    } else {

                    }       
                    

                    $("#reservationForm #rv_seat").val(seat_info.seat.s_no);
                    $("#reservationForm #rv_room").val(seat_info.seat.s_room);

                    seat_info.seat.s_name = seat_info.seat.s_name ? seat_info.seat.s_name : seat_info.seat.s_no; 
                    let selected_seat_name = "좌석 " + seat_info.seat.s_name + " / " + seat_info.room.r_name;

                    $("#seatReservFormModal #seatFormModalLabel").html(selected_seat_name);  

                    $("#reservationForm #rv_seat").val(seat_info.seat.s_no);
                    $("#reservationForm #rv_room").val(seat_info.seat.s_room);

                    resrve_setting_time();
                    resved_list();



                    //if( res.result != null ) {
                    //    $("#seatReservFormModal .setInfoHtmnl").val(res.html);
                    //    console.log(req);
                    //} 
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    console.log(xhr.responseJSON.file);
                    console.log(xhr.responseJSON.line);
                    console.log(xhr.responseJSON.message);
                }
            });
        }

        // 회원정보 가져오기      
        function member_getInfo(no){
            var req = "no=" + no ;
            console.log(req);
            $.ajax({
                url: '/member/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#memberDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if( res.member != null ) {
                        $("#frm_member #no").val(res.member.no);
                        $("#frm_member #step").val("");
                        $("#frm_member #name").val(res.member.name);
                        $("#frm_member #birth").val(res.member.birth);
                        $("#frm_member #email").val(res.member.email);
                        $("#frm_member #phone").val(res.member.phone);
                        if( res.member.state ) {
                            $("#state" + res.member.state).prop("checked",true);
                        }
                        console.log("회원정보를 가져왔음...");
                    } else {
                        $("#memberDetail_msg").html( res.message );
                        console.log("실패.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        // 회원검색
        function member_search(){
            var req = "q=" + $("#frm_search_member #search_member_q").val();
            console.log(req);
            $.ajax({
                url: '/member/search',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#memberDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    $('#member_search_list').empty();
                    res.members.forEach(function( member, mi) {
                        console.log(member);
                        var html = '';
                        html = html + '<tr>';
                        html = html + '    <td class="member_view" no="' + member.mb_no + '"><i class="bx bx-mobile-alt"></i> ' + member.mb_name + '</td>';
                        html = html + '    <td>' + member.mb_phone + '</td>';
                        html = html + '    <td>' + member.mb_birth + '</td>';
                        html = html + '    <td><button type="button" class="btn btn-xs btn-primary btn_member_select" mb="' + member.mb_no + '">선택</button></td>';
                        html = html + '</tr>';
                        $('#member_search_list').append(html);
                    });

                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });

            return false;
        }  
        
        // 구매자선택
        function member_setBuyer(no){
            var req = "no=" + no ;
            console.log(req);
            $.ajax({
                url: '/member/getInfo',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#memberDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);

                    if( res.member != null ) {
                        member_info = res.member;
                        if( member_search_mode == "product" ) {
                            $("#b_member").val(member_info.no);
                            $("#b_member_name").val(member_info.name);
                            $("#b_ageType").val(member_info.ageType);
                            $("#b_birth").val(member_info.birth);
                            
                            $("#b_birth_txt").html(member_info.birth + "(" + member_info.age + ", " + member_info.ageTypeText + ")");

                        }
                        if( member_search_mode == "reservation" ) {
                            console.log(member_search_mode);
                            $("#rv_member").val(member_info.no);
                            $("#rv_member_name").val(member_info.name);
                            $("#rv_ageType").val(member_info.ageType);
                            $("#rv_birth").val(member_info.birth);
                            
                            $("#rv_birth_txt").html(member_info.birth + "(" + member_info.age + ", " + member_info.ageTypeText + ")");

                            member_getProducts(member_info.no);

                        }


                        setPriceSeat();
                    } else {
                        $("#memberDetail_msg").html( res.message );
                        console.log("실패.");
                    }
                    
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        }

        // 회원의 상품목록 가져와 보여주기
        function member_getProducts(member){
            var req = "no=" + member;
            console.log(req);
            $.ajax({
                url: '/member/productsList',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#memberDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);

                    $('#member_products').empty();
                    if( res.products.length > 0 ) {
                        res.products.forEach(function( product, pi) {
                            console.log(member);
                            var html = '';

                            html = html + '<div class="form-check">';

                            if( product.o_remainder > 0 ) {
                            html = html + '<input class="form-check-input user_product" type="radio" name="rv_product" id="rv_product_' + product.o_no + '" kind="'+product.o_product_kind+'" remainder="' + product.o_remainder + '" value="' + product.o_no + '">';
                            } else {
                            html = html + '<input class="form-check-input user_product" type="radio" name="rv_product" id="rv_product_' + product.o_no + '" kind="'+product.o_product_kind+'" remainder="' + product.o_remainder + '" disabled>';
                            }
                            html = html + '    <label class="form-check-label" for="rv_product_' + product.o_no + '">'+product.o_product_name+'</label>';
                            html = html + '</div>';

                            $('#member_products').append(html);
                        });
                    } else {
                        $('#member_products').append("<span class='error_txt'>회원의 상품이 존재하지 않습니다.</span>");
                    }

                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });

            return false;
        }  

        function isNumber(s) {
            s += ''; // 문자열로 변환
            s = s.replace(/^\s*|\s*$/g, ''); // 좌우 공백 제거
            if (s == '' || isNaN(s)) return false;
            return true;
          }




        
        
        
        </script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@yield('javascript')