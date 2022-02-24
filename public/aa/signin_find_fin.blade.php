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

	<section class="sign-in-find-fin">

		<div class="inner wrap">
			<div class="tit-box">아이디를 찾았어요</div>

			<article class="callout-box">

				<div class="top-box">jess@eodilo.com</div>
				<div class="bottom-box">가입일: 2021.12.01</div>
			</article>

			<a href="/signin" class="certify-btn">로그인 하기</a>

		</div>




	</section>





</div>

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/ui.js"></script>

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