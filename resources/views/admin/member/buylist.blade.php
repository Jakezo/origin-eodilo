<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

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
                <div class="breadcrumb-title pe-3">회원구매</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">회원구매내역</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form name="search" action="<?=$PHP_SELF?>">
                                <div class='row'>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="">상품구분</option>
                                            <option value="<?=$k?>">시간권</option>
                                            <option value="<?=$k?>">기간권</option>
                                            <option value="<?=$k?>">고정권</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="">결제방법전체</option>
                                            <option value="<?=$k?>">카드결제</option>
                                            <option value="<?=$k?>">현금결제</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <input type="text" name="partner" id="partner" value="<?=$partner?>" placeholder="가맹점선택" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-12 mt-1">
                                        <input type="text" name="sdate" id="sdate" value="<?=$sdate?>" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-12 mt-1">
                                        <input type="text" name="edate" id="edate" value="<?=$edate?>" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mt-1">
                                        <div class="col-12">
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('<?=date("Y-m-d")?>');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('<?=date("Y-m-01")?>');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('<?=date("Y-01-01")?>');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-lg-4">
                                <div class="col">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">상품금액총액</p>
                                                    <h4 class="font-weight-bold">32,000,842</h4>
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
                                                    <p class="mb-0">캐쉬사용총액</p>
                                                    <h4 class="font-weight-bold">-16,352</h4>
                                                </div>
                                                <div class="widgets-icons bg-gradient-burning text-white">C
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
                                                    <p class="mb-0">포인트사용총액</p>
                                                    <h4 class="font-weight-bold">-16,352</h4>
                                                </div>
                                                <div class="widgets-icons bg-gradient-burning text-white">P
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
                                                    <p class="mb-0">결제금액</p>
                                                    <h4 class="font-weight-bold">16,000,352</h4>
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
                                    <th scope="col">상품구분</th>
                                    <th scope="col">구매자</th>
                                    <th scope="col">가맹점</th>
                                    <th scope="col">상품금액</th>
                                    <th scope="col">캐쉬</th>
                                    <th scope="col">포인트</th>
                                    <th scope="col">결제금액</th>
                                    <th scope="col">결제방법</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020-10-20</td>
                                    <td>시간권</td>
                                    <td>조현준</td>
                                    <td>성석점</td>
                                    <td>300,000</td>
                                    <td>-20,000</td>
                                    <td>-10,000</td>
                                    <td>270,000</td>
                                    <td>신용카드</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberBuyModal">상세</button> <button class="btn btn-xs btn-primary">카드전표</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020-10-20</td>
                                    <td>시간권</td>
                                    <td>조현준</td>
                                    <td>성석점</td>
                                    <td>300,000</td>
                                    <td>-20,000</td>
                                    <td>-10,000</td>
                                    <td>270,000</td>
                                    <td>신용카드</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberBuyModal">상세</button> <button class="btn btn-xs btn-primary">카드전표</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020-10-20</td>
                                    <td>기간권</td>
                                    <td>최현우</td>
                                    <td>성석점</td>
                                    <td>300,000</td>
                                    <td>-20,000</td>
                                    <td>-10,000</td>
                                    <td>270,000</td>
                                    <td>현금</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberBuyModal">상세</button> <button class="btn btn-xs btn-primary">현금영수증</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020-10-20</td>
                                    <td>기간권</td>
                                    <td>최현우</td>
                                    <td>성석점</td>
                                    <td>300,000</td>
                                    <td>-20,000</td>
                                    <td>-10,000</td>
                                    <td>270,000</td>
                                    <td>현금</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberBuyModal">상세</button> <button class="btn btn-xs btn-primary">현금영수증</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020-10-20</td>
                                    <td>고정권</td>
                                    <td>오조다</td>
                                    <td>성석점</td>
                                    <td>300,000</td>
                                    <td>-20,000</td>
                                    <td>-10,000</td>
                                    <td>270,000</td>
                                    <td>현금</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberBuyModal">상세</button> <button class="btn btn-xs btn-primary">현금영수증</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020-10-20</td>
                                    <td>고정권</td>
                                    <td>오조다</td>
                                    <td>성석점</td>
                                    <td>300,000</td>
                                    <td>-20,000</td>
                                    <td>-10,000</td>
                                    <td>270,000</td>
                                    <td>카카오페이</td>
                                    <td><button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberBuyModal">상세</button> <button class="btn btn-xs btn-primary">현금영수증</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Prev</a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                    <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="memberBuyModal" tabindex="-2" aria-labelledby="memberBuyModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberBuyModalLabel">좌석번호 01 / 룸 M01</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="seatCurrentInfo" role="tabpanel">
                            <div class="row col-12 mb-2">
                                <div class="col-5"><h6>이용자 : 조현준</h6></div>
                                <div class="col-7 text-right">1976.09.20. 남자 / 성인</div>
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
                                <div class="col-5">상품금액</div>
                                <div class="col-7 text-right">
                                    300,000 원
                                </div>
                            </div>
                            <div class="row col-12 mb-2">
                                <div class="col-5">캐쉬사용</div>
                                <div class="col-7 text-right">
                                    -20,000 원
                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-5">포인트사용</div>
                                <div class="col-7 text-right">
                                    -10,000 원
                                </div>
                            </div>
                            <div class="row col-12 mb-2">
                                <div class="col-5">결제금액</div>
                                <div class="col-7 text-right">

                                    270,000 원

                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-5">결제방법</div>
                                <div class="col-7 text-right">

                                    카드결제  신한 0000-0000-XXXX-XXXX

                                </div>
                            </div>

                            <div class="row col-12 mb-2">
                                <div class="col-5">결제일시</div>
                                <div class="col-7 text-right">

                                    2020-10-10 11:11:11

                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection


