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
	<link href="/mobile/css/ui.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/swiper.min.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container footer-none">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">매장 찾기</div>
			</article>
		</div>
	</header>

	<section class="map">
		<div class="map-search-area">
			<article class="map-search-box">
				<a href="#none" class="map-search-btn">
					<i class="ic ic-search"></i>
					<div class="search-txt">매장을 검색해주세요.</div>
				</a>
			</article>
		</div>


		<article class="gps-box" style="top:84px; right:16px;">
			<a href="#none" class="gps-btn"></a>
		</article>

		<article class="current-box" style="top:200px; right:160px;">
			<i class="ic-current"></i>
		</article>


		<article class="map-place-item" style="top:151px; left:24px;">
			<a href="#none" class="map-place-btn">
				<i class="ic ic-place"></i>
				<div class="place-txt">ABC 카페</div>
			</a>
		</article>

		<article class="map-place-item" style="top:257px; left:86px;">
			<a href="#none" class="map-place-btn">
				<i class="ic ic-place"></i>
				<div class="place-txt">파파 카페</div>
			</a>
		</article>

		<article class="map-count-box" style="top:142px; left:211px;">
			<a href="#none" class="count-txt">2</a>
		</article>


		<img src="/mobile/img/img_map_dummy.png" alt="이미지" style="height: 100%; width: 100%;">

	</section>

	<article class="map-foot-item">

		<div class="wrap">

			<a href="#none" class="bar"></a>


			<div class="item-wrap">

				<a href="#none" class="item-box">

					<div class="img-box">
						<img src="/mobile/img/img_recommend_dummy.png" alt="이미지">
					</div>
					<div class="info-box">

						<div class="top-box">
							<div class="txt">마포구 창전동</div>
							<div class="txt">300m</div>
						</div>
						<div class="mid-box">어디로 스터디 카페</div>
						<div class="rate-box">
							<i class="ic ic-rate"></i>
							<span class="rate-txt">4.5</span>
						</div>

					</div>
				</a>

			</div>


		</div>


	</article>



</div>

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/swiper.min.js"></script>
<script src="/mobile/js/ui.js"></script>
<script src="/mobile/js/jquery.ui.touch-punch.min.js"></script>

<script>

	var w = $(document).innerWidth();
	var h = $(document).innerHeight();

	$(function() {
		$( ".map-foot-item" ).resizable({
			maxWidth : w,
			minWidth : w,
			minHeight : 30,
			maxHeight : $( ".map-foot-item" ).innerHeight(),
			handles: 'n',
		});
	});


	$('.map-place-btn').on('click',function (){
		$('.map-foot-item').addClass('on');
	})


</script>

</body>
</html>