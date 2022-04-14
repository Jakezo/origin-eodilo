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
<div class="container page-with-btn" style="background-color: #F9F9FA;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a class="back-btn" href="#none"></a>
				<div class="page-txt">예약 상세</div>
			</article>
		</div>
	</header>

	<section class="my-shop-history-detail">

		<div class="inner wrap">

			<article class="history-detail-head">
				<div class="detail-head-box">
					<div class="head-txt">어디로 스터디 카페 대흥점</div>
					<div class="state-box">
						<div class="state-txt type-off">만료됨</div>
					</div>
				</div>
			</article>

			<article class="history-detail-body">
				<div class="detail-body-box">
					<div class="top-box">No.1234dsd3</div>
					<div class="mid-box">1일 이용권</div>
					<div class="bottom-box">
						<div class="time-box type-off">취소됨</div>
					</div>
				</div>
			</article>

			<article class="history-detail-foot">
				<div class="detail-foot-box">

					<div class="item-list">
						<div class="row">
							<div class="subject">예약</div>
							<div class="con">
								<div class="txt-box">2021.09.01 (수)</div>
								<div class="link-box"><a href="#none" class="link-btn type-off">예약 변경</a></div>
							</div>
						</div>

						<div class="row">
							<div class="subject">좌석</div>
							<div class="con">
								<div class="txt-box">2층 E15</div>
								<div class="link-box"><a href="#none" class="link-btn type-off">좌석 변경</a></div>
							</div>
						</div>

						<div class="row">
							<div class="subject">사물함</div>
							<div class="con">
								<div class="txt-box">1층 복도 A-7, 1일 이용권</div>
								<div class="link-box"><a href="#none" class="link-btn type-off">사물함 변경</a></div>
							</div>
						</div>
					</div>

					<div class="item-menu type-off">

						<a href="#none" class="item-btn type-1">퇴실하기</a>
						<a href="#none" class="item-btn type-2">환불하기</a>

					</div>

				</div>
			</article>

		</div>


	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="#none" class="menu-btn">확인</a>
		</article>
	</article>


</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/swiper.min.js"></script>
<script src="../js/ui.js"></script>
<script>

	$('.map-search-box input').on('keyup', function () {

		if ($(this).val().length == 0) {
			$(this).removeClass('type-success');
		} else {
			$(this).addClass('type-success');
		}
	});

	$('article.category-list-group .category-btn').on('click', function () {

		$('article.category-list-group .category-btn').removeClass('on');
		$(this).addClass('on');

		if ($(this).hasClass('type-inquiry')) {
			$('.help-item-group').hide();
			$('.help-inquiry-group').show();

		} else {
			$('.help-inquiry-group').hide();
			$('.help-item-group').show();

		}

	})

</script>

</body>
</html>