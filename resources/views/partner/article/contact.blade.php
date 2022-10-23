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
				<div class="breadcrumb-title pe-3">자원관리</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">연락처정보</li>
						</ol>
					</nav>
				</div>
				<div class="ms-auto">
					<div class="btn-group">

					</div>
				</div>
			</div>
			<!--end breadcrumb-->
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목+내용</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?}?>>제목</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?}?>>내용</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#contactModal">신규작성</a>
                                    </div>

                                </div>
                            </form>
                        </div>
						<div class="card-body">
							<div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
							<table class="table mb-0 table-striped">
								<thead>
								<tr>
									<th scope="col-sm-1" class="text-center">#</th>
                                    <th scope="col-sm-2" class="text-center">상호명</th>
                                    <th scope="col-sm-2" class="text-center">담당자이름</th>
                                    <th scope="col-sm-1" class="text-center">연락처</th>
                                    <th scope="col-sm-2" class="text-center">이메일</th>
                                    <th scope="col-sm-1" class="text-center">등록일시</th>
									<th scope="col-sm-1" class="text-center">관리</th>
								</tr>
								</thead>
								<tbody>
									@if( $frenchcontacts )
									@foreach( $frenchcontacts as $ri => $frenchcontact )
									<tr>
										<th scope="row" class="text-center">{{ ($start - $ri) }}</th>
										<td class="text-center">{{ $frenchcontact['c_name'] }}</td>
										<td class="text-center">{{ $frenchcontact['c_empname'] }}</td>
										<td class="text-center">{{ $frenchcontact['c_phone'] }}</td>
										<td class="text-center">{{ $frenchcontact['c_email'] }}</td>
										<td class="text-center">{{$frenchcontact['created_at']}}</td>
									<td class="text-center"><button class="btn btn-xs btn-secondary contactM" frenchcontact="{{ $frenchcontact['c_no'] }}" data-bs-toggle="modal" data-bs-target="#contactModal">관리</button></td>
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
						@foreach($errors->all() as $error)
						{{ $error }}
					@endforeach
					<div class="card-body d-flex justify-content-center">
						{{ $frenchcontacts->appends($param)->links() }}
					</div>
					</div>




					{{-- 연락처 등록 모달 --}}
					<div class="modal fade" id="contactModal" tabindex="-3" aria-labelledby="contactModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="contactModalLabel">연락처 등록</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
				
									<ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
												<div class="d-flex align-items-center">
													<div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
													</div>
													<div class="tab-title">정보</div>
												</div>
											</a>
										</li>
									</ul>
									<div class="tab-content py-3">
										<div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
				
				
											<form action=""  class="row g-3" name="contactform" id="contactform" >
												{{csrf_field()}}
												<input type="hidden" name="no" id="no" value="">
												<div class="width:100px;word-break:break-all;word-wrap:break-word;">
													<label for="inputLastName1" class="form-label">상호명</label>
													<input type="text" name="name" value="" class="form-control border-start-0" id="name" placeholder="상호명">
												</div>
												 <div class="width:100px;word-break:break-all;word-wrap:break-word;">
													<label for="inputLastName1" class="form-label">담장자이름</label>
													<input type="text" name="empname" value="" class="form-control border-start-0" id="empname" placeholder="담담자이름">
												</div>
												<div class="width:100px;word-break:break-all;word-wrap:break-word;">
													<label for="inputLastName1" class="form-label">연락처</label>
													<input type="text" name="phone" value="" class="form-control border-start-0" id="phone" placeholder="연락처">
												</div>
												<div class="width:100px;word-break:break-all;word-wrap:break-word;">
													<label for="inputLastName1" class="form-label">이메일</label>
													<input type="text" name="email" value="" class="form-control border-start-0" id="email" placeholder="이메일">
												</div>
												<div class="width:100px;word-break:break-all;word-wrap:break-word;">
													<label for="inputLastName1" class="form-label">기타</label>
													<textarea name="cont" value="" id="cont" class="form-control" style="height:200px;"></textarea>
												</div>
												
						
										</div>
				
									 <!--잘모르겠음--><div class="col-12 text-center text-danger" id="adminDetail_msg"></div>
				
												<div class="col-12 text-center">
													<button type="button" class="btn btn-danger px-5" id="btn_contact_update">등록</button>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										</div>
			     						</div>
									</div>		
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end row-->
		</div>
	</div>
	<!--end page wrapper -->
@endsection

@section('javascript')

<script>

	$(document).ready(function () {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).on("click", ".contactM", function () {
			var c_no = $(this).attr("frenchcontact");
			contact_getInfo(c_no);
			console.log(c_no);
		});

		$(document).on("click", "#btn_contact_update", function () {
			contact_update();
		});


	});


	function contact_update() {
		var req = $("#contactform").serialize();
		$.ajax({
			url: '/article/contact/update',
			type: 'POST',
			async: true,
			beforeSend: function (xhr) {
				$("#eventDetail_msg").html("");
			},
			data: req,
			success: function (res, textStatus, xhr) {
				if (res.result == true) {
					document.location.reload();
				} else {
					$("#eventDetail_msg").html(xhr.message);
				}
			},
			error: function (xhr, textStatus, errorThrown) {
				$("#eventDetail_msg").html(xhr.responseJSON.message);
			}
		});
	}

	function contact_getInfo(no) {
		var req = "no=" + no;
		$.ajax({
			url: '/article/contact/getInfo',
			type: 'POST',
			async: true,
			beforeSend: function (xhr) {
				$("#eventDetail_msg").html("");
			},
			data: req,
			success: function (res, textStatus, xhr) {
					console.log(res);
				if (res.result != null) {
					$("#no").val(res.frenchcontact.no);
					$("#name").val(res.frenchcontact.name);
					$("#empname").val(res.frenchcontact.empname);
					$("#phone").val(res.frenchcontact.phone);
					$("#email").val(res.frenchcontact.email);
					$("#cont").val(res.frenchcontact.cont);
				} else {
					$("#eventDetail_msg").html(res.message);
					console.log("실패.");
				}
			},
			error: function (xhr, textStatus, errorThrown) {
				console.log('PUT error.');
			}
		});
	}

</script>

@endsection
