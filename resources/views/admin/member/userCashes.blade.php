@extends('layouts.manager_popup')

@section('title', 'Page Title')

@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">회원정보21</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">{{ $user['nickname'] ?? ( $user['name'] ?? $user['email'] ) }} ({{ $user['id']  ?? '' }})</li>
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
                    <a class="nav-link" href="/member/user_info?id={{ $user['id'] }}" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                            </div>
                            <div class="tab-title">기본정보</div>
                        </div>
                    </a>
                </li>
                @if( isset( $user['id'] ) )                
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_buyProducts?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                            </div>
                            <div class="tab-title">구매내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_reserveSeats?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">이용내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_customs?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">1:1문의</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_alarms?id={{ $user['id'] }}" role="tab" aria-selected="false">
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
                    <a class="nav-link active" href="/member/user_cashes?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">캐쉬</div>
                        </div>
                    </a>
                </li>
                @endif                
            </ul>
            
            
            <div class="card">
                <div class="card-body">
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
						@if( $cashes )
						@foreach( $cashes as $ci => $cash )  							
						<tr>
							<th scope="row">{{ ($start - $ci) }}</th>
							<td>{{ $cash['mp_contents'] }}</td>
							<td>{{ number_format($cash['mp_point']) }}</td>
							<td>{{ $cash['created_at'] }}</td>
						</tr>
                        @endforeach
                        @endif     
						</tbody>
					</table>
					<div class="alert alert-sm alert-success my-2 p-2">
						<div class="bold font-weight-bold">개발가이드</div>
						1. 가맹점(만)의 회원의 환불등은 가맹점 캐쉬에 적립됩니다.<br>
						2. -(마이너스입력) 가능합니다.<br>
						3. 캐쉬는 현금의 이동에 의한 온라인 통화로 현금 환불이 가능합니다.
					</div>

                </div>

                <div class="card-body d-flex justify-content-center">
                    {{ $cashes->appends($param)->links() }}
                </div>

            </div>
        </div>
    </div>
    <!--end row-->
</div>

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


    </script>

@endsection
