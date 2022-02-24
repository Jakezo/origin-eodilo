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
<div class="container page-with-btn" style="background-color: #F9F9FA;">

	<header style="">
		<div class="wrap" >
			<article class="header-page-group" style="">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">캐시충전</div>
				<div class="right-menu-box">
					<a href="#none" class="close-btn"></a>
				</div>
			</article>
		</div>
	</header>

	<section class="my-cash">

		<div class="inner wrap">

			<article class="cash-charge">

				<div class="input-box">
					<input placeholder="충전할 금액을 입력해 주세요.">
				</div>

				<div class="quick-list">

					<a href="#none" class="quick-btn" data-charge="10000">+1만원</a>
					<a href="#none" class="quick-btn" data-charge="50000">+5만원</a>
					<a href="#none" class="quick-btn" data-charge="100000">+10만원</a>
					<a href="#none" class="quick-btn" data-charge="1000000">+100만원</a>

				</div>

			</article>



		</div>




	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="#none" class="menu-btn">저장하기</a>
		</article>
	</article>



</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/ui.js"></script>
<script>

	$('.input-box input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).parents('.input-box').removeClass('type-error').removeClass('type-success');
		}else{
			$(this).parents('.input-box').removeClass('type-error').addClass('type-success');
		}
	});


</script>

</body>
</html>