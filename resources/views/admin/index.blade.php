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

                    <a href="/member/list">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">금일 회원가입</p>
                                    <h3 class="mb-3 text-white">{{ number_format($users["count_today"]) }}</h3>
                                    <p class="font-13 text-white">이달 {{ number_format($users["count_month"]) }} 건 / 총 {{ number_format($users["count_month"]) }} 건</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/history">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">금일 이용내역</p>
                                    <h3 class="mb-3 text-white">{{ number_format($reserves["count_today"]) }}</h3>
                                    <p class="font-13 text-white">이달 {{ number_format($reserves["count_month"]) }} 건 / 총 {{ number_format($reserves["count_month"]) }} 건</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">금일 예상수수료</p>
                                    <h3 class="mb-3 text-white">{{ number_format($reserves["count_today"]) }}</h3>
                                    <p class="font-13 text-white">이달 {{ number_format($reserves["count_month"]) }} 건 / 총 {{ number_format($reserves["count_month"]) }} 건</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/partner/apply">
                        <div class="col border-end border-light-2">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">신규 가맹점 신청</p>
                                    <h3 class="mb-3 text-white">{{ number_format($partner_apply["count_today"]) }}</h3>
                                    <p class="font-13 text-white">이달 {{ number_format($partner_apply["count_month"]) }} 건 / 총 {{ number_format($partner_apply["count_month"]) }} 건</p>
                                
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/customer/member">
                        <div class="col col-md-12">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">신규 고객문의</p>
                                    <h3 class="mb-3 text-white">{{ number_format($customs["count_today"]) }}</h3>
                                    <p class="font-13 text-white">이달 {{ number_format($customs["count_month"]) }} 건 / 총 {{ number_format($customs["count_month"]) }} 건</p>
                                
                                 </div>
                            </div>
                        </div>
                    </a>
                </div><!--end row-->
            </div>

            <div class="row row-cols-1 row-cols-xl-2">


                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-3">고객문의</h6>
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
                                    @if( $customs["data"] )
                                    @foreach( $customs["data"] as $ci => $custom )
                                    <tr>
                                        <th scope="row" class="col-1 text-center">10</th>
                                        <td class="col-2"><a href="/customer/member/view/{{ $custom['q_no'] }}">{{ $custom['q_cont'] }}</a> </td>
                                        <td class="col-1 text-center">{{ substr($custom['created_at'],5,11) }}</td>
                                        <td class="col-1 text-center">
                                            @if( $custom['a_answer'] == "Y" )
                                                <button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변완료</button>
                                            @else
                                                <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">신규</button>
                                            @endif                                            
                                    </tr>                                    
                                    @endforeach
                                    @endif
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
                                    <h6 class="mb-3">가맹점문의</h6>
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
                                        @if( $custom2s["data"] )
                                        @foreach( $custom2s["data"] as $ci => $custom2 )
                                        <tr>
                                            <th scope="row" class="col-1 text-center">10</th>
                                            <td class="col-2"><a href="/customer/partner/view/{{ $custom2['q_no'] }}">{{ $custom2['q_cont'] }}</a> </td>
                                            <td class="col-1 text-center">{{ substr($custom2['created_at'],5,11) }}</td>
                                            <td class="col-1 text-center">
                                                @if( $custom2['a_answer'] == "Y" )
                                                    <button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변완료</button>
                                                @else
                                                    <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">신규</button>
                                                @endif                                            
                                        </tr>                                    
                                        @endforeach
                                        @endif
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
                                    <h6 class="mb-3">추가신청</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="border:1px solid #000000;">

                                <table class="table mb-0 table-striped">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">지점명</th>
                                        <th scope="col" class="text-center">작성자</th>
                                        <th scope="col" class="text-center">작성일시</th>
                                        <th scope="col" class="text-center">처리</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if( $partner_apply["data"] )
                                    @foreach( $partner_apply["data"] as $ci => $apply )
                                    <tr>
                                        <th scope="row" class="col-1 text-center">10</th>
                                        <td class="col-2"><a href="/partner/apply">{{ $apply['app_title'] }}</a> </td>
                                        <td class="col-1">{{ $apply['app_name'] }} </td>
                                        <td class="col-1 text-center">{{ substr($apply['created_at'],5,11) }}</td>
                                        <td class="col-1 text-center">
                                            @if( $apply['a_answer'] == "Y" )
                                                <button class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#boardQnaModal">답변완료</button>
                                            @else
                                                <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#boardQnaModal">신규</button>
                                            @endif                                            
                                    </tr>                                    
                                    @endforeach
                                    @endif                                        

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

            </div><!--end row-->
            
        </div>
    </div>
    <!--end page wrapper -->
@endsection


