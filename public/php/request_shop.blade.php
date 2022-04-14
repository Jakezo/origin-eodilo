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
	<link href="../css/ui.css" rel="stylesheet" type="text/css"/>
	<link href="../css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../css/swiper.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container footer-none" style="background-color: #F9F9FA;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">매장 추가 요청하기</div>
			</article>
		</div>
	</header>


	<section class="request-shop">

		<div class="inner wrap">

			<div class="request-form">

				<div class="row">
					<div class="top-box">
						<div class="txt-box">
							매장명<span class="ess">(필수)</span>
						</div>
					</div>
					<div class="bottom-box">
						<article class="map-search-box">
							<input type="text" placeholder="주소를 입력하세요">
							<i class="ic ic-search"></i>
						</article>
					</div>
				</div>

				<div class="row">
					<div class="top-box">
						<div class="txt-box">
							위치<span class="ess">(필수)</span>
						</div>
					</div>
					<div class="bottom-box">
						<div class="textbox">
							<textarea placeholder="매장의 주소나 위치를 설명해 주세요."></textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<article class="menu-btn-box">
						<a href="/request_shop_fin" class="menu-btn off">보내기</a>
					</article>
				</div>
			</div>
		</div>


	</section>


</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/swiper.min.js"></script>
<script src="../js/ui.js"></script>
<script>

	$('.map-search-box input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).removeClass('type-success');
		}else{
			$(this).addClass('type-success');
		}
	});



</script>

</body>
</html>