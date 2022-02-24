<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>Synadmin – Bootstrap5 Admin Template</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<div class="authentication-header"></div>
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="assets/images/logo-img.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="p-4 rounded">
									<div class="text-center">
										<h3 class="">모바일에서 사용자로그인 </h3>
										<a href="javascript:autoLogin();">[자동로그인]</a>
									</div>
									<div class="form-body">
										<form class="row g-3" id="form1" name="form1" method="post" action="/userloginok">
											{{csrf_field()}}											
											<div class="col-12">
												<label for="login_email" class="form-label">이메일</label>
												<input type="id" class="form-control @error('login_email') is-invalid @enderror" name="login_email" id="login_email" placeholder="이메일" value="{{ old('login_id') }}" required autocomplete="login_email" autofocus>
											</div>
											<div class="col-12">
												<label for="login_pw" class="form-label">비밀번호</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control @error('login_pw') is-invalid @enderror border-end-0" name="login_pw" id="login_pw" required autocomplete="current-password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

													<label class="form-check-label" for="remember">
														{{ __('Remember Me') }}
													</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="button" onclick="login()" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="p-4 rounded">
									<div class="text-center">
										<h3 class="">모바일에서 휴대폰로그인 </h3>
									</div>
									<div class="form-body">
										<form class="row g-3" id="form2" id="form2" method="post" action="/userloginok">
											{{csrf_field()}}											
											<div class="col-12">
												<label for="phone" class="form-label">휴대폰번호</label>
												<input type="id" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="휴대폰번호" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
											</div>

											<div class="col-12">
												<div class="d-grid">
													<button type="button" onclick="check_phone()" class="btn btn-primary"><i class="bx bxs-lock-open"></i>인증번호발송</button>
												</div>
											</div>

											<div class="col-12">
												<label for="login_pw" class="form-label">인증번호</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control @error('login_pw') is-invalid @enderror border-end-0" name="phone_pass" id="phone_pass" onkeyup="check_phone_auth()" required autocomplete="current-password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >

													<label class="form-check-label" for="remember">
														{{ __('Remember Me') }}
													</label>
												</div>
											</div>
											<div id="auth_msg"></div>
											<div class="col-12">
												<div class="d-grid">
													<button type="button" onclick="login_phone()" class="btn btn-primary"><i class="bx bxs-lock-open"></i>휴대폰로그인</button>
												</div>
											</div>
										</form>
									</div>									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		
		});


		myStorage = window.localStorage;
		function loadUserToken(){
			return localStorage.getItem('user_token');
		}
		function saveUserToken(val){
			return localStorage.setItem('user_token', val);
		}

		const UserToken = loadUserToken() ?? "";
		function autoLogin(){
			if( UserToken != "" ) {
				console.log("토큰 : " + UserToken);

				var formData = new FormData();
				formData.append("mode", "token");
				var url = '/api/user'
				$.ajax({
					url: url,
					
					headers: {
						'Accept' :'application/json',
						'Authorization': 'Bearer ' + UserToken
					},
					processData: false,
					contentType: false,
					data: formData,
					type: 'POST',
					success: function (res) {
						console.log(res);
						if (res.result == true) {


						} else {
							$("#auth_msg").html(res.message);

						}
					},
					error: function (request, textStatus, errorThrown) {
						console.log(request);
						console.log(textStatus);
						console.log(errorThrown);
					}
				});

			}

		}

		function login(){			
			$('#form1').submit();
			return;
			var form = $('#form1')[0];
			var formData = new FormData(form);
			var url = '/api/loginok'
			$.ajax({
				url: url,
				processData: false,
				contentType: false,
				data: formData,
				type: 'POST',
				success: function (res) {
					console.log(res);
					if (res.result == true) {
						//document.location.href = "/mobile";
						saveUserToken(res.token);
						console.log("저장된토큰 : " + res.token);
					} else {
						$("#auth_msg").html(res.message);

					}
				},
				error: function (request, textStatus, errorThrown) {
					console.log(request);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		}

		function check_phone(){

			var form = $('#form2')[0];
			var formData = new FormData(form);
			var url = '/api/login/phone/checkPhoneNo'
			console.log(url);
			$.ajax({
				url: url,
				processData: false,
				contentType: false,
				data: formData,
				type: 'POST',
				success: function (res) {
					console.log(res);
					if (res.result == true) {
						$("#auth_msg").html(res.message);
					} else {
						$("#auth_msg").html(res.message);
					}
				},
				error: function (request, textStatus, errorThrown) {
					console.log(request);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		}		

		function check_phone_auth(){

			var form = $('#form2')[0];
			var formData = new FormData(form);
			var url = '/api/login/phone/checkPhoneAuth'
			$.ajax({
				url: url,
				processData: false,
				contentType: false,
				data: formData,
				type: 'POST',
				success: function (res) {
					console.log(res);
					if (res.result == true) {
						$("#auth_msg").html("인증번호가 일치합니다.");
					} else {
						$("#auth_msg").html(res.message);
					}
				},
				error: function (request, textStatus, errorThrown) {
					console.log(request);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		}	

		function login_phone(){

			var form = $('#form2')[0];
			var formData = new FormData(form);
			var url = '/api/loginok'
			$.ajax({
				url: url,
				processData: false,
				contentType: false,
				data: formData,
				type: 'POST',
				success: function (res) {
					console.log(res);
					if (res.result == true) {
						//document.location.href = "/mobile";
					} else {
						$("#auth_msg").html(res.message);

					}
				},
				error: function (request, textStatus, errorThrown) {
					console.log(request);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		}	
				
	</script>




@section('javascript')

    <script>
        // $(document).ready(function() {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        // });



    </script>

@endsection


</body>

</html>