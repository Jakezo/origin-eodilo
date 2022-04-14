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
			<article class="header-page-group" style="">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">이용권 구매</div>
				<div class="right-menu-box">
					<a href="#none" class="txt-btn2">취소</a>
				</div>
			</article>
		</div>
	</header>

	<section class="seat">

		<div class="inner wrap">

			<article class="seat-head-box">
				<div class="head-box">
					<div class="main-txt">어디로 스터디 까페 대흥점</div>
					<div class="sub-txt">구매하고 싶은 정액권을 선택해 주세요!</div>
				</div>
			</article>

			<article class="seat-extend">

				<div class="extend-list" style="padding-top: 22px;">
					<div class="extend-box">
						<label>
							<input type="radio" name="extend">
							<span class="txt">2시간</span>
						</label>
					</div>

					<div class="extend-box">
						<label>
							<input type="radio" name="extend">
							<span class="txt">4시간</span>
						</label>
					</div>

					<div class="extend-box">
						<label>
							<input type="radio" name="extend">
							<span class="txt">6시간</span>
						</label>
					</div>

					<div class="extend-box">
						<label>
							<input type="radio" name="extend">
							<span class="txt">8시간</span>
						</label>
					</div>

					<div class="extend-box">
						<label>
							<input type="radio" name="extend">
							<span class="txt">12시간</span>
						</label>
					</div>

				</div>


			</article>
		</div>
	</section>



	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="#none" class="menu-btn off" onclick="popupEvent(this);">정액권을 선택해 주세요</a>
		</article>
	</article>


	<article class="popup popup-msg" style="">

		<div class="popup-wrap">

			<div class="popup-msg-group">

				<div class="msg-contents-box">

					<div class="contents-box">
						<div class="txt-box">
							<b>정액권 좌석 및 날짜선택</b>은 이용권 구매 후<br/>
							메인화면에서 설정할 수 있어요!
						</div>
					</div>

				</div>

				<div class="msg-btn-box">
					<a href="#none" class="msg-btn type-off" onclick="popupDirectClose(this);">취소</a>
					<a href="#none" class="msg-btn" onclick="popupDirectClose(this); popupOpen('check');">확인</a>
				</div>

			</div>
		</div>

	</article>

	<article class="popup popup-check" style="">

		<div class="popup-wrap">

			<div class="popup-msg-group">

				<div class="msg-contents-box">

					<div class="msg-check-box">

						<div class="check-item">
							<div class="top-box">이용권</div>
							<div class="bottom-box">5만원 정액권</div>
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

	$('input[name=extend]').on('change',function (){
		if($('input[name=extend]:checked').length){
			pageWithBtnActive('다음');
		}else{
			pageWithBtnDisabled('정액권을 선택해주세요');
		}
	});

	function popupEvent(e){
		if($(e).hasClass('off')) return false;
		popupOpen('msg');
	}





</script>

</body>
</html>