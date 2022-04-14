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

		<article class="progress-box">
			<div class="progress-bar" style="width: 100%;"></div>
		</article>

		<div class="inner wrap">
			<div class="tit-box step-tit-box" style="padding-bottom: 22px;">
				<i class="ic ic-success"></i>
				<div class="txt">마지막이에요!<br/>
					닉네임을 작성해 주세요. (선택사항)</div>
			</div>

			<div class="hp-signup-group">
				<div class="hp-certify-box">
					<div class="hp-certify-txt-box">닉네임</div>
					<div class="hp-certify-input-box">
						<input type="text" placeholder="ex) 지니">
					</div>
				</div>

				<div class="hp-skip-box">
					<a href="/signup_finish" class="skip-btn">건너뛰기</a>
				</div>

				<div class="hp-btn-box">
					<article class="menu-btn-box">
						<a href="/signup_nickname2" class="menu-btn off">다음</a>
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

	$('.hp-certify-box input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).parents('.hp-certify-box').removeClass('type-error').removeClass('type-success');
			$('.hp-btn-box .menu-btn').addClass('off');
		}else{
			$(this).parents('.hp-certify-box').removeClass('type-error').addClass('type-success');
			$('.hp-btn-box .menu-btn').removeClass('off');
		}
	});


</script>

</body>
</html>