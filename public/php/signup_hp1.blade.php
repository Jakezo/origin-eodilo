<!DOCTYPE html>
<html lang="ko">
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"
	  name="viewport">
<head>
	<meta charset="UTF-8">
	<title>어디로</title>
	<link href="../css/reset.css" rel="stylesheet" type="text/css"/>
	<link href="../css/swiper.min.css" rel="stylesheet" type="text/css"/>
	<link href="../css/ui.css" rel="stylesheet" type="text/css"/>
	<link href="../css/style.css" rel="stylesheet" type="text/css"/>



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

	<section class="signup">

		<div class="inner wrap">

			<div class="tit-box">어디로 앱 회원가입</div>

			<div class="hp-signup-group">
				<div class="hp-des-box">
					<div class="main-box">휴대폰 인증</div>
					<div class="sub-box">어디로는 안전한 예약과 결제를 위해 본인인증을 진행하고 있어요.</div>
				</div>

				<div class="hp-input-box">
					<select>
						<option>+82</option>
					</select>
					<input placeholder="휴대폰 번호를 입력해주세요" inputmode="numeric">
				</div>

				<div class="hp-certify-box">

					<div class="hp-certify-txt-box">인증번호</div>
					<div class="hp-certify-input-box">
						<input type="text" inputmode="numeric" placeholder="인증번호 입력">
						<div class="timer-box">03:59</div>
					</div>

					<div class="hp-certify-resend-box">
						<div class="resend-txt">코드를 받지 못하였나요?</div>
						<a href="#none" class="resend-btn">다시 보내기</a>
					</div>

				</div>

				<div class="hp-btn-box">
					<article class="menu-btn-box">
						<a href="#none" class="menu-btn off">인증번호 전송</a>
					</article>

					<article class="menu-btn-box">
						<a href="/signup_email1" class="menu-btn">다음</a>
					</article>
				</div>
			</div>





		</div>




	</section>



</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/ui.js"></script>
<script>

	$('.agree-list input[type=checkbox]').on('change',function (){

		if($(this).hasClass('all')){
			if($(this).prop('checked')){
				$('.agree-list input[type=checkbox]').prop('checked',true);
			}else{
				$('.agree-list input[type=checkbox]').prop('checked',false);
			}
		}else{
			var _chk = $('.agree-list input.normal:checked').length;
			var _cnt = $('.agree-list input.normal').length;
			if(_chk != _cnt){
				$('.agree-list input.all').prop('checked',false);
			}else if(_chk == _cnt){
				$('.agree-list input.all').prop('checked',true);

			}
		}
	})

	$('.hp-input-box input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).parents('.hp-input-box').removeClass('type-error').removeClass('type-success');
		}else{
			$(this).parents('.hp-input-box').removeClass('type-error').addClass('type-success');
		}
	});

	$('.hp-certify-box input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).parents('.hp-certify-box').removeClass('type-error').removeClass('type-success');
		}else{
			$(this).parents('.hp-certify-box').removeClass('type-error').addClass('type-success');
		}
	});


</script>

</body>
</html>