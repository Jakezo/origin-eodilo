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

            <div class="dash-wrapper bg-dark">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">

                    <a href="admin_member_list.html">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">금일 회원가입</p>
                                    <h3 class="mb-3 text-white">345</h3>
                                    <p class="font-13 text-white">이달 2,350 건 / 총 1,111,111 건</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="admin_use_history.html">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">금일 이용내역</p>
                                    <h3 class="mb-3 text-white">345</h3>
                                    <p class="font-13 text-white">이달 2,350 건 / 총 1,111,111 건</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="admin_sell_list_day.html">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">금일 예상수수료</p>
                                    <h3 class="mb-3 text-white">345,000</h3>
                                    <p class="font-13 text-white">이달 2,350,0000 건</p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/service_listsdm.html">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">신규 가맹점 신청</p>
                                    <h3 class="mb-3 text-white">3</h3>
                                    <p class="font-13 text-white">이달 1,009 건 / 총 123,000 건</p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/service_listsdm.html">
                        <div class="col col-md-12">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">신규 고객문의</p>
                                    <h3 class="mb-3 text-white">1</h3>
                                    <p class="font-13 text-white">금일 123 건 / 이달 1,000,222 건</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!--end row-->
            </div>

            <div class="row row-cols-1 row-cols-xl-3">
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-3">신규 가맹점 개설신청</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="border:1px solid #000000;">

                                <table class="table mb-0 table-striped">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">기존운영자</th>
                                        <th scope="col" class="text-center">작성자</th>
                                        <th scope="col" class="text-center">작성일시</th>
                                        <th scope="col" class="text-center">처리</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="col text-center">10</th>
                                        <td class="col ">기존운영 </td>
                                        <td class="col  text-center">김부천</td>
                                        <td class="col  text-center">2020-04-10</td>
                                        <td scope="col" class="text-center"><button class="btn btn-xs btn-danger">신규</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="col-2 text-center">9</th>
                                        <td class="col ">신규개점 </td>
                                        <td class="col  text-center">이서울</td>
                                        <td class="col  text-center">2020-04-10</td>
                                        <td scope="col" class="text-center"><button class="btn btn-xs btn-secondary">완료</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">8</th>
                                        <td class="col ">신규개점 </td>
                                        <td class="text-center">임고양</td>
                                        <td class="text-center">2020-04-10</td>
                                        <td scope="col" class="text-center"><button class="btn btn-xs btn-secondary">완료</button></td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-3">신규1:1문의</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="border:1px solid #000000;">

                                <table class="table mb-0 table-striped">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">제목</th>
                                        <th scope="col" class="text-center">작성일시</th>
                                        <th scope="col" class="text-center">답변여부</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="col-1 text-center">10</th>
                                        <td class="col-2">질문입니다. </td>
                                        <td class="col-1 text-center">04-10 00:00</td>
                                        <td class="col-1 text-center"><button class="btn btn-xs btn-danger">신규</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">9</th>
                                        <td>질문질문.....</td>
                                        <td class="text-center">04-10 00:00</td>
                                        <td class="text-center"><button class="btn btn-xs btn-secondary">답변</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">8</th>
                                        <td>답변기다립니다. </td>
                                        <td class="text-center">04-10 00:00</td>
                                        <td class="text-center"><button class="btn btn-xs btn-secondary">답변</button></td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-3">신규고객문의</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="border:1px solid #000000;">

                                <table class="table mb-0 table-striped">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">제목</th>
                                        <th scope="col" class="text-center">작성일시</th>
                                        <th scope="col" class="text-center">답변여부</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="col-1 text-center">10</th>
                                        <td class="col-2">질문입니다. </td>
                                        <td class="col-1 text-center">04-10 00:00</td>
                                        <td class="col-1 text-center"><button class="btn btn-xs btn-danger">신규</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">9</th>
                                        <td>질문질문.....</td>
                                        <td class="text-center">04-10 00:00</td>
                                        <td class="text-center"><button class="btn btn-xs btn-secondary">답변</button></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">8</th>
                                        <td>답변기다립니다. </td>
                                        <td class="text-center">04-10 00:00</td>
                                        <td class="text-center"><button class="btn btn-xs btn-secondary">답변</button></td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->



        </div>
    </div>
    <!--end page wrapper -->
@endsection


