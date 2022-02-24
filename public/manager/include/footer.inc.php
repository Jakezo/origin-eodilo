<div class="modal fade" id="seatReservFormModal" tabindex="-1" aria-labelledby="seatFormModalLabel" style="display: none;z-index:100000;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seatFormModalLabel">좌석번호 01 / 룸 M01</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-7">
                        <div class="row col-12 mb-2">
                            <div class="col-4">이용자</div>
                            <div class="col-8">
                                <input class="form-control form-control-sm mb-3 col-6" type="text" placeholder="클릭하여 회원검색" aria-label=".form-control-sm example" data-bs-toggle="modal" data-bs-target="#memberListModal">
                            </div>
                        </div>
                        <div class="row col-12 mb-2">
                            <div class="col-4">이용권선택</div>
                            <div class="col-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">50시간권</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">3일권</label>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mb-2">
                            <div class="col-4">입실시간</div>
                            <div class="col-8">
                                <div class="form-radio form-radio-inline">
                                    <input class="form-radio-input" type="radio" name="sdate" value="option1">
                                    <label class="form-radio-label" for="inlineCheckbox1">현시간부터</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-radio-input" type="radio" name="stime" value="option2">
                                    <label class="form-radio-label" for="inlineCheckbox1">예약</label>
                                </div>

                                <input class="form-control form-control-sm mb-3 col-6" type="date" value="<?=date('Y-m-d')?>" placeholder="날자" aria-label=".form-control-sm example">
                                <input class="form-control form-control-sm mb-3 col-6" type="time" id="stime" placeholder="시간" aria-label=".form-control-sm example">
                            </div>
                        </div>
                        <div class="row col-12 mb-2">
                            <div class="col-4">사용시간</div>
                            <div class="col-8">
                                <select class="form-select form-select-sm mb-3" aria-label="Default select example">
                                    <option selected="">시간선택</option>
                                    <option value="1">1시간</option>
                                    <option value="2">2시간</option>
                                </select>
                            </div>
                        </div>
                        <div class="row col-12 mb-2">
                            <div class="col-4">퇴실시간</div>
                            <div class="col-8">
                                <input class="form-control form-control-sm mb-3 col-6" type="date" name="edate" placeholder="날자" aria-label=".form-control-sm example">
                                <input class="form-control form-control-sm mb-3 col-6" type="time" name="etime" placeholder="시간" aria-label=".form-control-sm example">
                            </div>
                        </div>

                        <div class="row col-12 mb-2">
                            <div class="col-4">요금</div>
                            <div class="col-8">
                                4,600 원
                            </div>
                        </div>

                        <div class="row col-12 mb-2">
                            <div class="col-4">결제</div>
                            <div class="col-8">
                                <select class="form-select form-select-sm mb-3" aria-label="Default select example">
                                    <option selected="">결제방법</option>
                                    <option value="1">현금</option>
                                    <option value="2">카드</option>
                                </select>
                            </div>
                        </div>


                        <div class="row col-12 mb-2">
                            <div class="col-4">결제여부</div>
                            <div class="col-8">
                                <select class="form-select form-select-sm mb-3" aria-label="Default select example">
                                    <option value="N">대기</option>
                                    <option value="Y">완료</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-primary col-5">확  인 </button>
                        </div>
                    </div>
                    <div class="col-5">
                        시간표 2021-10-10
                        <div class="row border-bottom border-top">
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
                        </div>
                        <div class="alert alert-info">시간을 클릭한후 왼쪽 폼에서 수정가능합니다.</div>
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="memberListModal" tabindex="-3" aria-labelledby="memberListModalLabel" style="display: none;z-index:193000;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="memberListModalLabel">회원검색</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="search" action="/manager/member_list.html?menu=">
                    <input type="hidden" name="mode" value="list">
                    <div class="row">

                        <div class="col-md-9 col-xs-12 mt-1">
                            <input type="text" name="title" value="" placeholder="아이디, 이름, 전화번호 " class="form-control form-control-sm col-12">
                        </div>
                        <div class="col-md-3 col-xs-12 mt-1 justify-content-right">
                            <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12">검색</a>
                        </div>
                    </div>
                </form>

                <table class="table mb-0 table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">아이디</th>
                        <th scope="col">이름</th>
                        <th scope="col">연락처</th>
                        <th scope="col">이용횟수</th>
                        <th scope="col">최근이용일</th>
                        <th scope="col">가입일</th>
                        <th scope="col">관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>mygospel</td>
                        <td><i class="bx bx-mobile-alt"></i> 조현준</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>exbuilder</td>
                        <td><i class="bx bx-user"></i> 엑스빌</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>ozoda</td>
                        <td><i class="bx bx-user"></i> 오조다</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>ozoda</td>
                        <td><i class="bx bx-user"></i> 오조다</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>ozoda</td>
                        <td><i class="bx bx-user"></i> 오조다</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>ozoda</td>
                        <td><i class="bx bx-user"></i> 오조다</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>ozoda</td>
                        <td><i class="bx bx-user"></i> 오조다</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>ozoda</td>
                        <td><i class="bx bx-user"></i> 오조다</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>

                    <tr>
                        <th scope="row">2</th>
                        <td>ozoda</td>
                        <td><i class="bx bx-user"></i> 오조다</td>
                        <td>010-4204-0696</td>
                        <td>1회</td>
                        <td>20-10-17</td>
                        <td>20-10-17</td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-bs-dismiss="modal">선택</button></td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="memberRegModal" tabindex="-3" aria-labelledby="memberRegModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
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


                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputLastName1" class="form-label">이름</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                    <input type="text" class="form-control border-start-0" id="inputLastName1" placeholder="이름">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputLastName2" class="form-label">생년월일</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                    <input type="text" class="form-control border-start-0 datepicker" id="inputLastName2" placeholder="생년월일">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputPhoneNo" class="form-label">전화번호</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-microphone"></i></span>
                                    <input type="text" class="form-control border-start-0" id="inputPhoneNo" placeholder="휴대폰번호">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">이메일주소</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-message"></i></span>
                                    <input type="text" class="form-control border-start-0" id="inputEmailAddress" placeholder="이메일주소">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">비번</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
                                    <input type="text" class="form-control border-start-0" id="inputChoosePassword" placeholder="비밀번호 입력">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputConfirmPassword" class="form-label">비번확인</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock"></i></span>
                                    <input type="text" class="form-control border-start-0" id="inputConfirmPassword" placeholder="비밀번호 확인">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputConfirmPassword" class="form-label">Tag</label>
                                <div class="input-group">
                                    <i class="bx bx-tag text-primary font-24 mr-5">&nbsp;&nbsp;&nbsp;</i>
                                    <i class="bx bx-tag text-info font-24 mr-5">&nbsp;&nbsp;&nbsp;</i>
                                    <i class="bx bxs-tag text-success font-24 mr-5">&nbsp;&nbsp;&nbsp;</i>
                                    <i class="bx bx-tag text-danger font-24 mr-5">&nbsp;&nbsp;&nbsp;</i>
                                    <i class="bx bx-tag text-warning font-24 mr-5">&nbsp;&nbsp;&nbsp;</i>
                                    <i class="bx bx-tag text-secondary font-24 mr-5">&nbsp;&nbsp;&nbsp;</i>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputAddress3" class="form-label">메모</label>
                                <textarea class="form-control" id="inputAddress3" placeholder="메모" rows="3"></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-danger px-5">가입</button>
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

                        <form name="search" action="<?=$PHP_SELF?>?menu=<?=$menu?>">
                            <input type="hidden" name="mode" value="list">
                            <div class='row'>

                                <div class="col-md-4 col-sm-3 col-xs-12 mt-1">
                                    현재 총 30,000 포인트
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 mt-1">
                                    <input type="text" name="title" value="<?=$key?>" placeholder="구분명" class="form-control form-control-sm col-12">
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                    <input type="text" name="point" value="<?=$key?>" placeholder="포인트" class="form-control form-control-sm col-12">
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

                        <form name="search" action="<?=$PHP_SELF?>?menu=<?=$menu?>">
                            <input type="hidden" name="mode" value="list">
                            <div class='row'>

                                <div class="col-md-4 col-sm-3 col-xs-12 mt-1">
                                    현재 총 30,000 캐쉬
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 mt-1">
                                    <input type="text" name="title" value="<?=$key?>" placeholder="구분명" class="form-control form-control-sm col-12">
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                    <input type="text" name="point" value="<?=$key?>" placeholder="캐쉬" class="form-control form-control-sm col-12">
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

<div class="modal fade" id="seatStatusModal" tabindex="-2" aria-labelledby="seatStatusModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seatStatusModalLabel">좌석번호 01 / 룸 M01</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

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
                                <div class="tab-title">시간보기</div>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="seatCurrentInfo" role="tabpanel">
                        <div class="row col-12 mb-2">
                            <div class="col-8"><h6>이용자 : 조현준</h6></div>
                            <div class="col-4 text-right"><span class="btn btn-xs btn-info">외출중</span></div>
                        </div>
                        <div class="row col-12 mb-2">
                            <div class="col-5">입실시간</div>
                            <div class="col-7">2020-11-26 10:00</div>
                        </div>
                        <div class="row col-12 mb-2">
                            <div class="col-5">퇴실예정</div>
                            <div class="col-7">2020-11-26 17:00</div>
                        </div>

                        <hr/>
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

                        <hr/>
                        <div class="row col-12 mb-2">
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <h6>메모</h6>
                                    <div>학교에서 바로 오기 때문에 시간변동 가능성 있음 양해바람.</div>
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
                                <div class="col-12"><textarea name="seat_memo" class="form-control"></textarea></div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade show"  id="seatCurrentTime" role="tabpanel">

                        시간표 2021-10-10
                        <div class="row border-bottom border-top">
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
                            <div class="col-3 border-right">09:30<button class="btn btn-xs btn-warning" onclick="$('#stime').val('09:30:00')">현재</button></div>
                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('09:30:00')">예약가능</button></div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-3 border-right">10</div>
                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('09:30:00')">예약가능</button></div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-3 border-right">11</div>
                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('09:30:00')">예약가능</button></div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-3 border-right">12</div>
                            <div class="col-9"><button class="btn btn-xs btn-success" onclick="$('#stime').val('09:30:00')">예약가능</button></div>
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
                        </div>

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#seatReservFormModal">이좌석 예약하기</button>
            </div>
        </div>
    </div>
</div>

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
                        <h6>메모</h6>
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
<!--end switcher-->
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="assets/js/index5.js"></script>
<!--app JS-->
<script src="assets/js/app.js"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

<!-- 시계 -->
<script src="assets/js/topTimer.js"></script>
<script>
    $( function () {
        $( '[data-toggle="popover"]' ).popover()
    } );
    $(".btn_logout").on("click",function(){
        var req = "step=logout";
        $.post( "/module/manager/manager_action/ajax_manager_login.ajax.php", req, function( res ) {
            var res_info = JSON.parse(res);
            if( res_info.result == true ){
                var rURL = res_info.rURL;
                location.href = "./login.html";
            }
        });
    });
</script>