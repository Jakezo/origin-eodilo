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

	<section class="sign-in-find">

		<div class="inner wrap">
			<div class="tit-box">가입하신 휴대폰 번호 또는 이메일 주소를 입력해주세요!</div>

			<div class="find-tabs-menu">
				<a href="#none" class="tabs-btn on" data-tabs="tabs1">휴대폰 번호</a>
				<a href="#none" class="tabs-btn" data-tabs="tabs2">이메일 주소</a>
			</div>

			<div class="find-tabs-box">

				<div class="tabs-box" data-tabs="tabs1">

					<div class="hp-input-box">
						<select>
							<option>+82</option>
						</select>
						<input placeholder="휴대폰 번호를 입력해주세요">
					</div>

				</div>
				<div class="tabs-box" data-tabs="tabs2">
					<div class="input-form">
						<div class="row">
							<div class="subject">이메일</div>
							<div class="con">
								<div class="input-box">
									<input placeholder="이메일 주소를 입력하세요">
								</div>
								<div class="msg-box">이메일과 비밀번호가 일치하지 않아요. 다시 시도해 주세요.</div>
							</div>
						</div>
					</div>
				</div>
			</div>



			<a href="#none" class="login-btn">다음</a>
			<a href="/signin_find_certify" class="login-btn on">다음</a>


		</div>




	</section>





</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/ui.js"></script>

<script>

	$('.find-tabs-menu .tabs-btn').on('click',function (){

		var _order = $(this).data('tabs')
		$('.find-tabs-menu .tabs-btn').removeClass('on');
		$(this).addClass('on');

		$('.find-tabs-box .tabs-box').hide();
		$('.find-tabs-box .tabs-box[data-tabs='+_order+']').show();
	});

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