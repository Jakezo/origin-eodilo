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
<div class="container page-with-btn">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">지도에서 보기</div>
			</article>
		</div>
	</header>

	<section class="map">

		<article class="gps-box" style="bottom:83px; right:16px;">
			<a href="#none" class="gps-btn"></a>
		</article>


		<article class="map-where-item" style="top:220px; left:195px;">
			<div class="where-item">
				<img src="../img/ic_map_where.svg" alt="이미지">
			</div>
		</article>



		<img src="../img/img_map_dummy.png" alt="이미지" style="height: 100%; width: 100%;">


		<article class="map-where-info">

			<div class="inner wrap">
				<div class="img-box">
					<img src="../img/ic_map_where_mini.svg" alt="이미지">
				</div>

				<div class="info-box">
					<div class="top-box">마포구 대흥로 360 2층</div>
					<div class="bottom-box">마포구 대흥동 17-9 상가 203호 어디로 스터디 카페</div>
				</div>

			</div>




		</article>

	</section>



</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/swiper.min.js"></script>
<script src="../js/ui.js"></script>

<script>

	$('section.main-filter .filter-item').on('click',function (){

		$('section.main-filter .filter-item').removeClass('on');
		$(this).addClass('on');

		if($(this).hasClass('type-map')){
			$('section.shop-list .map-choice-box').show();
		}else{
			$('section.shop-list .map-choice-box').hide();
		}

	})

	$('.shop-list article.item-more-toggle-box a').on('click', function () {
		$(this).toggleClass('on')
		$('.shop-list article.list-group1').toggleClass('type-more-off');
	});

	var visualSwiper = new Swiper('.main-visual .swiper-container', {
		loop: true,
		slidesPerView: '1',
		slidesPerGroup: 1,
		observer: true,
		observeParents: true,
		autoplay: true,

		pagination: {
			el: '.swiper-pagination'
		}
	});

	var currentSwiper = new Swiper('.current-shop .swiper-container', {
		loop: true,
		cssWidthAndHeight: true,
		slidesPerView: '3.3',
		slidesPerGroup: 1,
		observer: true,
		observeParents: true,
		autoplay: true,
		spaceBetween: 20,
	});


</script>

</body>
</html>