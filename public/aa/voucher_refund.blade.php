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
	<link href="/mobile/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/datepicker.min.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div class="container page-with-btn" style=";">

	<header>
		<div class="wrap">
			<article class="header-page-group" style="">
				<div class="page-txt">환불</div>
				<div class="right-menu-box">
					<a href="#none" class="close-btn"></a>
				</div>
			</article>
		</div>
	</header>

	<section class="voucher-calendar">

		<div class="inner wrap">

			<article class="history-detail-head" style="padding-bottom: 15px;">
				<div class="detail-head-box">
					<div class="head-txt">어디로 스터디 까페 대흥점</div>
				</div>
				<div class="detail-sub-box">
					<div class="accent-txt">1회 이용권 사용중</div>
				</div>
			</article>


			<article class="voucher-refund-form">

				<div class="info-list">
					<div class="row">
						<div class="subject">결제금액 합계</div>
						<div class="con"><span class="price">6,000</span><span class="unit">원</span></div>
					</div>

					<div class="row">
						<div class="subject">차감 합계</div>
						<div class="con accent"><span class="price">0</span><span class="unit">원</span></div>
					</div>

					<div class="row">
						<div class="subject">취소 수수료</div>
						<div class="con accent"><span class="price">0</span><span class="unit">원</span></div>
					</div>

				</div>

				<div class="info-list" style="border:none;">
					<div class="row">
						<div class="subject"><b>환불 금액</b></div>
						<div class="con accent bold"><span class="price bold">6,000</span><span class="unit">원</span></div>
					</div>
				</div>

				<div class="input-box">
					<textarea placeholder="예약을 취소하시려는 사유를 입력해주세요"></textarea>
				</div>

				<div class="rule-info-box">

					<div class="tit-box">취소/환불 규정 안내</div>

					<div class="con-box">
						<div class="row">취소 수수료 없이 취소 가능한 기한은 <b>2021년 11월 14일까지</b> 입니다.</div>
						<div class="row">취소 후 <b>최대 3~5 영업일 이내</b> 카드 승인 취소 됩니다.</div>
					</div>
				</div>



			</article>

		</div>

	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="voucher_refund_fin" class="menu-btn off">환불하기</a>
		</article>
	</article>



</div>

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/swiper.min.js"></script>
<script src="/mobile/js/ui.js"></script>
<script src="/mobile/js/jquery.ui.touch-punch.min.js"></script>
<script src="/mobile/js/datepicker.min.js"></script>
<script src="/mobile/js/datepicker.ko.js"></script>


<script>

	$('.input-box textarea').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).parents('.input-box').removeClass('type-error').removeClass('type-success');
		}else{
			$(this).parents('.input-box').removeClass('type-error').addClass('type-success');
		}
	});


</script>

</body>
</html>