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
<div class="container page-with-btn" style="">

	<header>
		<div class="wrap">
			<article class="header-page-group" style="">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">이용권 구매</div>
				<div class="right-menu-box">
					<a href="#none" class="txt-btn2">취소</a>
				</div>
			</article>
		</div>
	</header>

	<section class="voucher-calendar">

		<div class="inner wrap">

			<article class="history-detail-head" style="padding-bottom: 10px;">
				<div class="detail-head-box">
					<div class="head-txt">어디로 스터디 카페 대흥점</div>
					<div class="state-box"></div>
				</div>
				<div class="detail-sub-box">예약하고 싶은 <b>시작 시간</b>과 <b>날짜</b>를 선택해 주세요!</div>

			</article>


			<article class="voucher-calendar-group">

				<div class="voucher-time-select-box" style="padding-top: 0; margin-top: 0; border:0; border-bottom:2px solid #EFF0F7">

					<div class="time-box">
						<div class="time-tit-box">예약 시작 시간</div>
						<a href="javascript:timeSelectOn();" class="time-btn">9:00</a>
					</div>

				</div>



				<div class="voucher-calendar-box" style="padding:35px 0 26px;">
					<div class="date-calendar"></div>
				</div>



			</article>

		</div>

	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="#none" class="menu-btn off">변경하실 날짜와 시간을 선택해 주세요</a>
		</article>
	</article>

	<article class="time-foot-item">

		<div class="wrap">

			<a href="#none" class="bar"></a>

			<div class="item-wrap">

				<div class="tit-box">예약 시작 시간</div>
				<div class="item-list">
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn">9:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn type-off">10:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn type-off">11:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn type-off">12:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn">13:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn">14:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn">15:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn">16:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn">17:00</a></div>
					<div class="item-box"><a href="javascript:timeSelectOff();" class="item-btn">18:00</a></div>
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
<script src="/mobile/js/datepicker.min.js"></script>
<script src="/mobile/js/datepicker.ko.js"></script>


<script>
	$('.date-calendar').datepicker(
		{
			autoClose: true,
			language: 'ko',
			inline: true,
			navTitles: {
				days: '<i>yyyy</i>.MM'
			},
			onChangeYear: false,
		}
	);



	var w = $(document).innerWidth();
	var h = $(document).innerHeight();

	$(function() {
		$( ".time-foot-item" ).resizable({
			maxWidth : w,
			minWidth : w,
			minHeight : 30,
			maxHeight : h / 1.5,
			handles: 'n',
		});
	});

	function timeSelectOn(){
		$('.container').addClass('overlay');
		scrollDisable();
		$('.time-foot-item').addClass('on');
	}

	function timeSelectOff(){
		$('.container').removeClass('overlay');
		scrollAble();
		$('.time-foot-item').removeClass('on');
	}

	$(function (){

		if($('.time-foot-item').length){

			$(document).on('click',function (){
				if($('.time-foot-item').hasClass('on')){

					if($(event.target).parents('.time-foot-item').length){

					}else{
						timeSelectOff();
					}
				}
			})
		}

	})

</script>

</body>
</html>