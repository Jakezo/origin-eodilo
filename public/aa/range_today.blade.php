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
</head>
<body>
<div class="container page-with-btn" style="background-color: #FCFCFC;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<div class="page-txt">오늘 예약하기</div>
				<div class="right-menu-box">
					<a href="#none" class="txt-btn2">취소</a>
				</div>
			</article>
		</div>
	</header>

	<section class="my-shop-history-detail">

		<div class="inner wrap">

			<article class="history-detail-head" style="padding-bottom: 15px;">
				<div class="detail-head-box">
					<div class="head-txt">어디로 스터디 카페 대흥점</div>
				</div>
				<div class="detail-sub-box">
					<div class=""><b>사용 시작 시간, 이용기간, 위치</b>를 선택해 주세요!</div>
				</div>
			</article>


			<article class="voucher-locker-option-group">

				<div class="option-box">
					<div class="subject-box">예약 시작 시간</div>
					<div class="con-box">
						<div class="sbox">
							<a href="#none" class="set active"><div class="txt">9:00</div></a>
							<ul class="select-menu">
								<li><a href="#none"><span class="txt">10:00</span></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="option-box">
					<div class="subject-box">예약 종료 시간</div>
					<div class="con-box">
						<div class="sbox">
							<a href="#none" class="set active"><div class="txt">18:00</div></a>
							<ul class="select-menu">
								<li><a href="#none"><span class="txt">18:00</span></a></li>
							</ul>
						</div>
					</div>
				</div>

			</article>



		</div>


	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="javascript:popupOpen('alarm')" class="menu-btn">다음</a>
		</article>
	</article>


	<article class="popup popup-alarm" style="">

		<div class="popup-wrap">

			<div class="popup-msg-group">

				<div class="msg-contents-box">

					<div class="msg-check-box">

						<div class="check-item">
							<div class="top-box">이용권</div>
							<div class="bottom-box">B석 / 하루 이용권 / 9월 1일 토요일</div>
						</div>

						<div class="check-item">
							<div class="top-box">사물함</div>
							<div class="bottom-box">A-9 / 1회 이용권 / 9월 1일 오전 9시부터</div>
						</div>

						<div class="check-msg">예약내용을 다시 한 번 확인해 주세요!</div>

					</div>

				</div>

				<div class="msg-btn-box">
					<a href="#none" class="msg-btn type-off" onclick="popupDirectClose(this);">취소</a>
					<a href="#none" class="msg-btn" onclick="popupDirectClose(this);">확인</a>
				</div>

			</div>
		</div>

	</article>

</div>

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/swiper.min.js"></script>
<script src="/mobile/js/ui.js"></script>
<script>

	$('article.information-toggle-list .toggle-head').on('click',function (){
		$(this).toggleClass('on');
	})


</script>

</body>
</html>