<?
include_once "../config/config.inc.php";
?>
<?php include_once "include/header.inc.php";?>

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">업무관리</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">입출입기록</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#useInfoModal"><i class="lni lni-youtube"></i>도움말</button>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<table class="table mb-0 table-striped">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">회원명</th>
											<th scope="col">상품명</th>
											<th scope="col">외출일시</th>
											<th scope="col">복귀일시</th>
											<th scope="col">경과기간</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">1</th>
											<td>조현준</td>
											<td>10일권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">2</th>
											<td>최현우</td>
											<td>40시간권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">1</th>
											<td>조현준</td>
											<td>10일권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">2</th>
											<td>최현우</td>
											<td>40시간권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">1</th>
											<td>조현준</td>
											<td>10일권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">2</th>
											<td>최현우</td>
											<td>40시간권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">1</th>
											<td>조현준</td>
											<td>10일권</td>
											<td>2020-10-10 00:00</td>
											<td></td>
											<td>60분 <a href="javascript:;" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#seatFormModal">관리</a></td>
										</tr>
										<tr>
											<th scope="row">2</th>
											<td>최현우</td>
											<td>40시간권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">1</th>
											<td>조현준</td>
											<td>10일권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
										</tr>
										<tr>
											<th scope="row">2</th>
											<td>최현우</td>
											<td>40시간권</td>
											<td>2020-10-10 00:00</td>
											<td>2020-10-10 00:00</td>
											<td>20분</td>
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
		<!--end page wrapper -->

<?php include_once "include/footer.inc.php";?>

<?php include_once "include/footer_close.inc.php";?>