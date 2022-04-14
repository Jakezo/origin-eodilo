<!DOCTYPE html>
<html lang="ko">
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"
	  name="viewport">
<head>
	<meta charset="UTF-8">
	<title>어디로</title>
	<link href="/mobile/css/reset.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/swiper.min.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/ui.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/style.css" rel="stylesheet" type="text/css"/>



</head>
<body>
<div class="container" style="padding-bottom: 0;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
			</article>
		</div>
	</header>

	<section class="sign-in-email">

		<div class="inner wrap">
			<div class="tit-box">어디로 앱 로그인</div>


			<div class="input-form">

				<div class="row type-success">
					<div class="subject">이메일</div>
					<div class="con">
						<div class="input-box">
							<input placeholder="이메일 주소를 입력하세요">
						</div>
						<div class="msg-box">이메일과 비밀번호가 일치하지 않아요. 다시 시도해 주세요.</div>
					</div>
				</div>

				<div class="row type-error">
					<div class="subject">비밀번호</div>
					<div class="con">
						<div class="input-box">
							<input placeholder="비밀번호를 입력하세요" value="테스트">
						</div>
						<div class="msg-box">이메일과 비밀번호가 일치하지 않아요. 다시 시도해 주세요.</div>
					</div>
				</div>
			</div>

			<a href="#none" class="login-btn">로그인</a>
			<a href="/main_type2" class="login-btn on">로그인</a>

			<div class="find-menu">
				<a href="#none" class="find-btn">이메일 찾기</a>
				<a href="/signin_find" class="find-btn">비밀번호 찾기</a>
			</div>



			<div class="sign-up-box">
				<div class="txt-box">혹시, 어디로 앱이 처음이신가요?</div>
				<div class="link-box">
					<a href="/signup_terms_agree." class="link-btn">회원가입 하기</a>
				</div>
			</div>
		</div>




	</section>





</div>

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/ui.js"></script>

<script>

	$('.input-form input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).parents('.row').removeClass('type-error').removeClass('type-success');
		}else{
			$(this).parents('.row').removeClass('type-error').addClass('type-success');
		}
	});

</script>

</body>
</html>