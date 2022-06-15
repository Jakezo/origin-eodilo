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
                    <a class="nav-link active" href="/member/user_info?id={{ $user['id'] }}" role="tab" aria-selected="true">
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
                    <a class="nav-link" href="/member/user_cashes?id={{ $user['id'] }}" role="tab" aria-selected="false">
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


					<form class="form-horizontal" role="form" name="frm_push" id="frm_push" method="post" action="">
						<input type="hidden" name="id"  value="{{ $user['id'] }}">
						<input type="hidden" name="step" value="send">
	
						<div class="form-group mt-2">
							<label for="aid" class="col-sm-12 control-label">제목</label>
							<div class="col-sm-12">
								<input type="text" name="title" id="title" value="" class="form-control form-control-sm">
							</div>
						</div>
						<div style="clear:both"></div>
	
						<div class="form-group mt-2">
							<label for="aid" class="col-sm-12 control-label">내용</label>
							<div class="col-sm-12">
								<textarea name="body" id="body" class="form-control form-control-sm" ROWS="3" style="width:100%"></textarea>
							</div>
						</div>
						<div style="clear:both"></div>
	

                          <p>
                            <a class="btn btn-secondary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                옵션사용
                              </a>                            

                          </p>
                          <div class="collapse" id="collapseExample">
                            <div class="form-group mt-2">
                                <label for="aid" class="col-sm-12 control-label">옵션파라미터1</label>
                                <div class="col-sm-12 row">
                                    <div class="col">
                                        <input type="text" name="pkey[]" value="" placeholder="키" class="form-control form-control-sm">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="pval[]" value="" placeholder="값" class="form-control form-control-sm">
                                    </div>
                                </div>						
                            </div>
                            <div class="form-group mt-2">
                                <label for="aid" class="col-sm-12 control-label">옵션파라미터2</label>
                                <div class="col-sm-12 row">
                                    <div class="col">
                                        <input type="text" name="pkey[]" value="" placeholder="키" class="form-control form-control-sm">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="pval[]" value="" placeholder="값" class="form-control form-control-sm">
                                    </div>
                                </div>						
                            </div>
                            <div class="form-group mt-2">
                                <label for="aid" class="col-sm-12 control-label">옵션파라미터3</label>
                                <div class="col-sm-12 row">
                                    <div class="col">
                                        <input type="text" name="pkey[]" value="" placeholder="키" class="form-control form-control-sm">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="pval[]" value="" placeholder="값" class="form-control form-control-sm">
                                    </div>
                                </div>						
                            </div>
                          </div>

                            <div class="col-sm-12 mt-3" id="pushDetail_msg">토큰 : {{ substr($user['push_token'],0,20) }} .. {{ substr($user['push_token'],strlen($user['push_token'])-20,20) }}</div>

                            <div class="form-group mt-2">
                                <div class="col-sm-12 row">
                                    <div class="col">
                                        <label class="form-label col-12">중요도</label>
                                        <div class="form-check-inline col-12">
                                            <input type="radio" class="form-check-input" name="priority" id="priority_H" value="high" checked="checked"> 높음
                                            <input type="radio" class="form-check-input" name="priority" id="priority_M" value="normal"> 보통
                                        </div>
                                    </div>
                                    <div class="col d-grid gap-2">
                                        <button type="button" onclick="app_push()" class="btn btn-md btn-primary col-xs-12" id="btn_admin_update">발송</button>	
                                    </div>
                                </div>						
                            </div>



						</form>


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

		function app_push(){
			$("#pushDetail_msg").html("발송시작")
			var req = $("#frm_push").serialize();
			$.ajax ({
				// URL은 필수 요소이므로 반드시 구현해야 하는 Property입니다.
				url	: "/member/user_push_proc", 
				type: "post", 
				data  : req, 
				success: function(res) {		
					console.log(res)			
					res_info = JSON.parse(res);
					console.log(res_info)
                    if( res_info )
					console.log(res_info.results)
					var msg = "";
					msg += "multicast_id : " + res_info.multicast_id + ".<br>";
					msg += "성공 : " + res_info.success + "건.<br>";
					msg += "실패 : " + res_info.failure + "건.<br>";
		
					for( var i=0; i<=res_info.results.length - 1 ; i++ ) {
						msg += "message_id : " + res_info.results[0].message_id + ".<br>";					
					}
		
					$("#pushDetail_msg").html(msg)
				}
			});
		}

    </script>

@endsection
