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
<div class="container footer-none" style="background-color: #F9F9FA;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">알림</div>
			</article>
		</div>
	</header>

	<section class="alarm">

		<div class="inner wrap">

			<div class="alarm-list">

				<div class="alarm-box type-1">
					<a href="#none" class="remove-btn" onclick="$(this).parent().remove();"></a>
					<div class="top-box">
						<div class="top-txt">예약 시간이 지났어요. 빨리 입실해 주세요.</div>
					</div>

					<div class="mid-box">
						<div class="mid-txt">예약 시간이 30분 지났습니다. 남은 시간은 3시간 30분 입니다.</div>
					</div>

					<div class="bottom-box">
						<div class="bottom-txt">3일 전</div>
					</div>

				</div>

				<div class="alarm-box type-2">
					<a href="#none" class="remove-btn" onclick="$(this).parent().remove();"></a>
					<div class="top-box">
						<div class="top-txt">입실 1시간 전이에요!</div>
					</div>

					<div class="mid-box">
						<div class="mid-txt">입실 시간은 오전 8시 입니다. 잊지말고 입실해 주세요.</div>
					</div>

					<div class="bottom-box">
						<div class="bottom-txt">3일 전</div>
					</div>

				</div>

				<div class="alarm-box type-3">
					<a href="#none" class="remove-btn" onclick="$(this).parent().remove();"></a>
					<div class="top-box">
						<div class="top-txt">캐시 충전 완료</div>
					</div>

					<div class="mid-box">
						<div class="mid-txt">캐시 50,000원을 충전했어요. 보유 캐시는 54,350원이에요.</div>
					</div>

					<div class="bottom-box">
						<div class="bottom-txt">10일 전</div>
					</div>

				</div>

				<div class="alarm-box type-0">
					<a href="#none" class="remove-btn" onclick="$(this).parent().remove();"></a>
					<div class="top-box">
						<div class="top-txt">ABC 스터디 까페 이용권 취소 처리가 완료되었습니다.</div>
					</div>

					<div class="mid-box">
						<div class="mid-txt">취소 된 충전권을 보려면 클릭하세요.</div>
					</div>

					<div class="bottom-box">
						<div class="bottom-txt">10일 전</div>
					</div>

				</div>

			</div>

		</div>

	</section>



</div>

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/swiper.min.js"></script>
<script src="/mobile/js/ui.js"></script>
<script>

</script>

</body>
</html>