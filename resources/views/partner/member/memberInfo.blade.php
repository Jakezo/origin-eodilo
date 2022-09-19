@extends('layouts.manager_popup')

@section('title', 'Page Title')

@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">회원정보</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    @if( isset( $member['name'] ) )
                    <li class="breadcrumb-item active" aria-current="page">{{ $member['name']  ?? '' }} ({{ $member['id']  ?? '' }})</li>
                    @else
                    <li class="breadcrumb-item active" aria-current="page">구매내역</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
       
        <div class="col">

            <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_info?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                            </div>
                            <div class="tab-title">기본정보</div>
                        </div>
                    </a>
                </li>
                @if( isset( $member['mb_name'] ) )                
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_buyProducts?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">

                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                            </div>
                            <div class="tab-title">구매내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_reserveSeats?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">이용내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_alarms?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">
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
                @endif                
            </ul>
            
            
            <div class="card">
                <div class="card-body">

                
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
    
                            <form action="" aria-label="{{ __('Register') }}" class="row g-3 form-horizontal" role="form" name="frm_member" id="frm_member">
                            {{csrf_field()}}
                            <input type="hidden" name="nextStep" id="nextStep" value="{{ $nextStep ?? '' }}">
                            <input type="hidden" name="no" id="no" value="{{ $member['mb_no']  ?? '' }}">
    
    
                                <div class="col-md-6">
                                    <label for="name" class="form-label">이름</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0" name="name" id="name" value="{{ $member['mb_name']  ?? '' }}" placeholder="이름" style="ime-mode:enabled">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <label for="sex" class="form-label">성별</label>
                                    <div class="input-group"> 
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="sex" id="sex_M" value="M" autocomplete="off" @if( isset($member ) && $member['mb_sex'] == "M" ) checked="checked" @endif>
                                        <label class="btn btn-outline-primary" for="sex_M">남</label>
                                        <input type="radio" class="btn-check" name="sex" id="sex_F" value="F" autocomplete="off" @if( isset($member ) && $member['mb_sex'] == "F" ) checked="checked" @endif>
                                        <label class="btn btn-outline-primary" for="sex_F">여</label>
                                      </div>    
                                    </div>  
                                </div>
    
                                <div class="col-md-6">
                                    <label for="birth" class="form-label">생년월일</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0 datepicker" name="birth" id="birth" value="{{ $member['mb_birth']  ?? '' }}"  placeholder="생년월일">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">전화번호</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-microphone"></i></span>
                                        <input type="text" class="form-control border-start-0" name="phone" id="phone" value="{{ $member['mb_phone']  ?? '' }}"  placeholder="휴대폰번호">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmailAddress" class="form-label">이메일주소</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-message"></i></span>
                                        <input type="email" class="form-control border-start-0"  name="email" id="email" value="{{ $member['mb_email']  ?? '' }}"  style="ime-mode:disabled" placeholder="이메일주소">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="passwd" class="form-label">비번</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
                                        <input type="password" class="form-control border-start-0" name="passwd" id="passwd" placeholder="비밀번호 입력">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tags_A" class="form-label">Tag</label>
                                    <div class="input-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_A" value="A" @if( isset($member ) && in_array( "A", $member['tags_arr'] ) ) checked="checked" @endif>
                                            <label class="form-check-label" for="tags_A"><i class="bx bxs-tag text-primary font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_B" value="B" @if( isset($member ) && in_array( "B", $member['tags_arr'] ) ) checked="checked" @endif>
                                            <label class="form-check-label" for="tags_B"><i class="bx bxs-tag text-info font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_C" value="C" @if( isset($member ) && in_array( "C", $member['tags_arr'] ) ) checked="checked" @endif>
                                            <label class="form-check-label" for="tags_C"><i class="bx bxs-tag text-success font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_D" value="D" @if( isset($member ) && in_array( "D", $member['tags_arr'] ) ) checked="checked" @endif>
                                            <label class="form-check-label" for="tags_D"><i class="bx bxs-tag text-danger font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_E" value="E" @if( isset($member ) && in_array( "E", $member['tags_arr'] ) ) checked="checked" @endif>
                                            <label class="form-check-label" for="tags_E"><i class="bx bxs-tag text-warning font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="tags[]" id="tags_F" value="F" @if( isset($member ) && in_array( "F", $member['tags_arr'] ) ) checked="checked" @endif>
                                            <label class="form-check-label" for="tags_F"><i class="bx bxs-tag text-secondary font-24 mr-5">&nbsp;&nbsp;&nbsp;</i></label>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tags_A" class="form-label">차단</label>
                                    <div class="input-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input mt-2" type="checkbox" name="state" id="state" value="B" @if( isset($member ) && $member['mb_state'] =="B" ) ) checked="checked" @endif>
                                            <label class="form-check-label" for="tags_A">차단시 본 가맹점에 예약이 불가능합니다.</label>
                                          </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="memo" class="form-label">메모</label>
                                    <textarea class="form-control" id="memo" name="memo" placeholder="메모" rows="3">{{ $member['memo']  ?? '' }}</textarea>
                                </div>
    
                                <div class="col-12 alert alert-danger d-none" id="memberDetail_msg">
    
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
                                    @if( isset( $orders ) )
                                    @foreach( $orders as $oi => $order )         
                                    <tr>
                                        <th scope="row">{{ (count($orders) - $oi) }}</th>
                                        <td>{{ $order['created_at'] }}</td>
                                        <td>
                                            @if($order['o_product_kind'] == "A") 
                                                하루이용권 
                                            @elseif($order['o_product_kind'] == "T") 
                                                시간권 {{ $order['o_duration'] }} 시간
                                            @elseif($order['o_product_kind'] == "D") 
                                                기간권 {{ $order['o_duration'] }} 일
                                            @elseif($order['o_product_kind'] == "F") 
                                                고정권  {{ $order['o_duration'] }} M
                                            @elseif($order['o_product_kind'] == "P") 
                                                정액권   {{ $order['o_duration'] }} Points
                                            @endif
    
                                        </td>
                                        <td>
                                            @if($order['o_product_kind'] == "A") 
                                                <span class="btn btn-xs @if( $order['o_remainder_day'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_day'] }} / {{ $order['o_duration'] }}</span> 회
                                            @elseif($order['o_product_kind'] == "T") 
                                                <span class="btn btn-xs @if( $order['o_remainder_time'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_time'] }} / {{ $order['o_duration'] }}</span> 시간
                                            @elseif($order['o_product_kind'] == "D") 
                                                <span class="btn btn-xs @if( $order['o_remainder_day'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_day'] }} / {{ $order['o_duration'] }}</span> 일
                                            @elseif($order['o_product_kind'] == "F") 
                                                -
                                            @elseif($order['o_product_kind'] == "P") 
                                                <span class="btn btn-xs @if( $order['o_remainder_point'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_point'] }} / {{ $order['o_duration'] }}</span> P
                                            @endif
                                        </td>   
                                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#memberRegModal">사용중</button></td>
                                    </tr>

                                    @endforeach
                                    @endif  
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="primaryuse" role="tabpanel">
    
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">예약일시</th>
                                    <th scope="col">입실일시</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset( $reservs ) )
                                @foreach( $reservs as $ri => $reserv )                                       
                                <tr>
                                    <th scope="row">{{ (count($reservs) - $ri) }}</th>
                                    <td>{{ substr($reserv['rv_sdate'],5,11) }} ~ {{ substr($reserv['rv_edate'],5,11) }}</td>    
                                    <td>{{ substr($reserv['rv_state_seat_in'],5,11) }} ~ {{ substr($reserv['rv_state_seat_out'],5,11) }}</td>                                    
                                    <td>
                                        @if($reserv['rv_state'] == "A") 
                                            <span class="btn btn-xs btn-warning btn-R" data-bs-toggle="modal" data-bs-target="#useInfoModal">예약</span>
                                        @elseif($reserv['rv_state'] == "U") 
                                            <span class="btn btn-xs btn-primary btn-U" data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</span>
                                        @elseif($reserv['rv_state'] == "M") 
                                            <span class="btn btn-xs btn-secondary btn-M" data-bs-toggle="modal" data-bs-target="#useInfoModal">이동</span>
                                        @elseif($reserv['rv_state'] == "X") 
                                            <span class="btn btn-xs btn-secondary btn-X" data-bs-toggle="modal" data-bs-target="#useInfoModal">종료</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($reserv['rv_state_seat'] == "IN") 
                                            <span class="btn btn-xs btn-in">{{ $reserv['rv_state_seat'] }}</span>
                                        @elseif($reserv['rv_state_seat'] == "OUT") 
                                            <span class="btn btn-xs btn-out">{{ $reserv['rv_state_seat'] }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif     
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
            </div>
        </div>
    </div>
    <!--end row-->
</div>






@endsection

@section('javascript')
<script>

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click","#btn_member_update",function(){
        console.log("한번들어옴..");
        member_update();
        console.log("qwer2");
    });

    $(document).on("click","#btn_member_delete",function(){
        if( confirm("삭제하시겠습니까?") == true ) {
            member_delete();
        }
    });
});

function member_getInfoView(member){
    var req = "no=" + member ;
    console.log(req);
    $.ajax({
        url: '/member/getInfo',
        type: 'POST',
        async: true,
        beforeSend: function (xhr) {
            $("#memberDetail_msg").html("").addClass("d-none");
        },
        data: req,
        success: function (res, textStatus, xhr) {
            console.log(res);
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
                console.log(req);
            } else {
                $("#memberDetail_msg").html( res.message ).removeClass("d-none");;
                console.log("실패.");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log('PUT error.');
        }
    });
}

function member_update(){
    var req = $("#frm_member").serialize();
    console.log(req)
    $("#memberDetail_msg").html("").addClass("d-none");
    $.ajax({
        url: '/member/update',
        type: 'POST',
        async: true,
        beforeSend: function (xhr) {
            $("#memberDetail_msg").html("").addClass("d-none");
        },
        data: req,
        success: function (res, textStatus, xhr) {
            console.log(res)

            if( res.result == true ) {
                //document.location.reload();
                member_info = res.member;

                // 가입후 바로 상품구매창...( 그러나 좌석먼저 선택이라면 의미 없음 )
                // 선택된 회원이 있다면 선택

                $(opener.document).find("#productBuyForm #b_member").val(member_info.no);
                $(opener.document).find("#productBuyForm #b_member_name").val(member_info.name);
                $(opener.document).find("#productBuyForm #b_birth").val(member_info.birth);
                $(opener.document).find("#productBuyForm #b_ageType").val(member_info.ageType);

                $(opener.document).find("#reservationForm #rv_member").val(member_info.no);
                $(opener.document).find("#reservationForm #rv_member_name").val(member_info.name);  
                $(opener.document).find("#reservationForm #rv_birth").val(member_info.birth);  
                $(opener.document).find("#reservationForm #rv_ageType").val(member_info.ageType); 

                //opener.document.setPriceSeat();

                // 좌석레벨가져와서 업데이트
                //seatlevel_setList();
                //$("#productBuyFormModal").modal("show");

                var nextStep = $("#nextStep").val();
                console.log("nextStep :" + nextStep);

                if( nextStep == "reservSeat") {
                    member_getProducts(member_info.no);
                    window.close();
                } else {
                    location.reload()
                }

            } else {
                $("#memberDetail_msg").html( res.message ).removeClass("d-none");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log('PUT error.');
        }
    });
}

function member_delete(){
    var req = $("#frm_member").serialize();
    console.log(req);
    $.ajax({
        url: '/member/delete',
        type: 'POST',
        async: true,
        beforeSend: function (xhr) {
            $("#memberDetail_msg").html("");
        },
        data: req,
        success: function (res, textStatus, xhr) {
            console.log(res);
            if( res.result == true ) {
                document.location.reload();
            } else {
                $("#memberDetail_msg").html( res.message );
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log('PUT error.');
        }
    });
}

</script>
@endsection