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
<div class="container page-with-btn" style="background-color: #F9F9FA;">

	<header>
		<div class="wrap">
			<article class="header-page-group" style="background-color: #F9F9FA">
				<a href="javascript:popupOpen('back')" class="back-btn"></a>
				<div class="page-txt"></div>
			</article>
		</div>
	</header>

	<section class="voucher-time">

		<div class="inner wrap">

			<article class="voucher-time-group">
				<div class="group-tit-box">시간 추가하기</div>

				<div class="time-select-list">
					<a href="#none" class="time-btn">30분</a>
					<a href="#none" class="time-btn">1시간</a>
					<a href="#none" class="time-btn on">2시간</a>
					<a href="javascript:popupOpen('alert')" class="time-btn type-off">3시간</a>
					<a href="javascript:timeSelect();" class="time-btn">직접선택</a>
					<input class="time-select" type="time" style="position: absolute; left:-999px">
				</div>

				<div class="time-select-price">
					<div class="subject">추가 결제 요금</div>
					<div class="con">4,000원</div>
				</div>

				<div class="time-select-info">

					<div class="row">
						<div class="subject">최대 연장가능한 시간:</div>
						<div class="con">2시간</div>
					</div>

					<div class="row">
						<div class="subject">이용권 기간</div>
						<div class="con">8월 29일 14:00 - 9월 1일 수요일 <span class="time">20:00</span></div>
					</div>

				</div>

				<div class="time-select-msg">
					<div class="msg-tit">[시간 추가 유의사항]</div>

					<div class="msg-list">
						<div class="msg-box">시간 추가시 쿠폰가는 적용되지 않습니다. </div>
						<div class="msg-box">시간연장 후 취소 시, 변경된 예약시간에 맞추어 취소수수료가 적용됩니다.</div>

					</div>

				</div>


			</article>
		</div>

	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="/voucher_qr1" class="menu-btn">변경하기</a>
		</article>
	</article>


	<article class="popup popup-alert" style="">

		<div class="popup-wrap">

			<div class="popup-msg-group">

				<div class="msg-contents-box">

					<div class="ic-box">
						<i class="ic ic-alert"></i>
					</div>
					<div class="contents-box">
						<div class="txt-box type-center">
							<div class="accent-box">
								선택한 시간은 추가할 수 없습니다.
							</div>
							다른시간을 선택해 주세요.
						</div>
					</div>

				</div>

				<div class="msg-btn-box">
					<a href="#none" class="msg-btn" onclick="popupDirectClose(this);">확인</a>
				</div>

			</div>
		</div>

	</article>

	<article class="popup popup-back" style="">

		<div class="popup-wrap">

			<div class="popup-msg-group">

				<div class="msg-contents-box">

					<div class="ic-box">
						<i class="ic ic-warning"></i>
					</div>
					<div class="contents-box">
						<div class="txt-box">
							입력한 정보가 모두 사라집니다.<br/>
							정말 나가시겠어요?
						</div>
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
<script src="/mobile/js/jquery.ui.touch-punch.min.js"></script>

<script>

	function timeSelect(){
		$('input.time-select').trigger('click');
	}

	$('.time-select-list .time-btn').on('click',function (){

		if($(this).hasClass('type-off')) return false;
		$('.time-select-list .time-btn').removeClass('on');
		$(this).addClass('on');

	})

</script>

</body>
</html>