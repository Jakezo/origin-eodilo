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
<div class="container">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">이벤트</div>
			</article>
		</div>
	</header>

	<section class="board-type2">

		<article class="board-type2-group">

			<div class="board-type2-view">

				<div class="img-box">
					<img src="../img/img_event_view_dummy1.png" alt="이미지">
				</div>

				<div class="event-box">

					<div class="event-wrap">
						<div class="head-box">EVENT</div>

						<div class="body-box">
							<div class="row">
								<div class="subject">즉석 추첨</div>
								<div class="con">10만원 이상 어디로 캐시 충전 후 어디로까페 예약 시</div>
							</div>

							<div class="row">
								<div class="subject">당첨률 2배</div>
								<div class="con">20만원 이상 캐시 충전 후 예약 시</div>
							</div>

							<div class="row">
								<div class="subject">현장 수령</div>
								<div class="con">어디로 까페에서 굿즈 현장 수령<br/>
									(이벤트 당첨자는 앱 공지사항 확인)</div>
							</div>
						</div>
					</div>


				</div>


				<div class="info-box">

					<div class="info-tit-box">이벤트 유의사항</div>
					<div class="info-txt-box">Duis euismod aliquet varius. Phasellus sed condimentum mauris. Aliquam sollicitudin nunc orci, vitae elementum velit ultrices a. Fusce eu arcu dignissim purus dignissim feugiat. Praesent ullamcorper volutpat est. Praesent sit amet diam nec libero euismod lacinia ut aliquet turpis. Suspendisse ac mauris id tellus porttitor ultrices vitae vitae dolor. Ut non sollicitudin sapien, et finibus arcu<br/><br/>Duis euismod aliquet varius. Phasellus sed condimentum mauris. Aliquam sollicitudin nunc orci, vitae elementum velit ultrices a. Fusce eu arcu dignissim purus dignissim feugiat. Praesent ullamcorper volutpat est. Praesent sit amet diam nec libero euismod lacinia ut aliquet turpis. Suspendisse ac mauris id tellus porttitor ultrices vitae vitae dolor. Ut non sollicitudin sapien, et finibus arcu</div>

				</div>

			</div>

		</article>



	</section>


	<aside class="floating-menu">
		<div class="floating-menu-box">
			<a class="floating-btn setting-btn" href="#none"></a>
		</div>

		<div class="floating-menu-box">
			<a class="floating-btn chat-btn" href="#none"></a>
		</div>
	</aside>

	<article class="page-footer">
		<div class="page-nav-group">

			<div class="nav-list">
				<a class="nav-btn " href="#none">
					<div class="ic-box"><i class="ic ic-home"></i></div>
					<div class="txt-box">홈</div>
				</a>

				<a class="nav-btn " href="#none">
					<div class="ic-box"><i class="ic ic-search"></i></div>
					<div class="txt-box">매장 찾기</div>
				</a>

				<a class="nav-btn " href="#none">
					<div class="ic-box"><i class="ic ic-like"></i></div>
					<div class="txt-box">찜 목록</div>
				</a>

				<a class="nav-btn  " href="#none">
					<div class="ic-box"><i class="ic ic-my"></i></div>
					<div class="txt-box">마이페이지</div>
				</a>

				<a class="nav-btn on" href="#none">
					<div class="ic-box"><i class="ic ic-more"></i></div>
					<div class="txt-box">더보기</div>
				</a>
			</div>

		</div>

	</article>



</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/swiper.min.js"></script>
<script src="../js/ui.js"></script>
<script>

	var currentSwiper = new Swiper('.voucher-have .swiper-container', {
		loop: true,
		cssWidthAndHeight: true,
		slidesPerView: '1.1',
		slidesPerGroup: 1,
		observer: true,
		observeParents: true,
		autoplay: true,
		spaceBetween: 12,

		pagination: {
			el: '.swiper-pagination'
		}
	});

</script>

</body>
</html>