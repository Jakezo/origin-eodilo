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

	<section class="sign-in-hp">

		<div class="inner wrap">

			<div class="tit-box">
				<div class="main-box">인증번호 확인</div>
				<div class="sub-box">+82 010-1234-5555로 전송된 4자리 코드를 입력해 주세요.</div>
			</div>


			<div class="num-input-box type-error">
				<div class="msg-box">잘못된 코드 입니다. 다시 입력해 주세요.</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>
			</div>

			<div class="num-input-box">
				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>
			</div>

			<div class="num-input-box type-success">
				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>

				<div class="num-box">
					<input inputmode="numeric" maxlength="1">
				</div>
			</div>

			<div class="resend-box">
				<div class="txt">코드를 받지 못하였나요?</div>
				<a href="#none" class="resend-btn">다시 보내기</a>
			</div>

			<div class="certify-box">

				<div class="agree-box">
					<div class="cbox small">
						<label>
							<input type="checkbox"><i></i>
							<span class="txt">마케팅 문자 수신 동의</span>
						</label>
					</div>
				</div>

				<a href="#none" class="certify-btn">인증하기</a>
				<a href="/main_type2" class="certify-btn on">인증하기</a>

			</div>

		</div>




	</section>





</div>

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/ui.js"></script>

<script>

	$('.num-input-box input').on('keyup',function (){
		$(this).parents('.num-box').next().find('input').focus()
	})

</script>

</body>
</html>