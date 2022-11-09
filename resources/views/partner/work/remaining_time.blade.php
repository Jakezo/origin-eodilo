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
				<div class="breadcrumb-title pe-3">업무관리</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">잔여시간</li>
						</ol>
					</nav>
				</div>
                <div class="ms-auto">
                    <button class="btn btn-xs btn-danger btn_manual" rel="10"><i class="lni lni-youtube"></i>도움말</button>
                </div>
			</div>
			<!--end breadcrumb-->
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<div class="row row-cols-1 row-cols-lg-2">
								<div class="col">
									<div class="card radius-10">
										<div class="card-body">
											<div class="d-flex align-items-center">
												<div class="flex-grow-1">
													<p class="mb-0">기간권</p>
													<h4 class="font-weight-bold">{{ number_format($remaind_day) }}일</h4>
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
													<p class="mb-0">시간권</p>
													<h4 class="font-weight-bold">{{ number_format($remaind_time) }}시간</h4>
												</div>
												<div class="widgets-icons bg-gradient-burning text-white"><i class="bx bx-message-square-add"></i>
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
									<th scope="col">회원명</th>
									<th scope="col">상품명</th>
									<th scope="col">구매기간</th>
									<th scope="col">잔여기간</th>
								</tr>
								</thead>
								<tbody>
								
								@if( $orders )
								@foreach( $orders as $oi => $order )
								<tr>
									<th scope="row">{{ ($start - $oi) }}</th>
									<td>{{ $order->o_member_name }}</td>
									<td>{{ $order->o_product_name }}</td>
									<td>{{ $order->o_duration }}</td>
									<td>{{ $order->o_remainder }}</td>
								</tr>
                                @endforeach
                                @endif
								</tbody>
							</table>
						</div>

						<div class="card-body d-flex justify-content-center">
							{{ $orders->appends($param)->links() }}
						</div>

					</div>


				</div>
			</div>
			<!--end row-->
		</div>
	</div>
	<!--end page wrapper -->
@endsection

