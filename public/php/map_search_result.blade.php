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
<div class="container footer-none" style="background-color: #F9F9FA;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">지도에서 보기</div>
			</article>
		</div>
	</header>

	<section class="map-search">

		<div class="inner wrap">

			<div class="search-area">
				<article class="map-search-box">
					<input type="text" placeholder="주소를 입력하세요">
					<i class="ic ic-search"></i>
				</article>
			</div>

			<div class="result-search">

				<div class="filter-box">
					<div class="sbox">
						<select>
							<option>지도중심</option>
						</select>
					</div>
				</div>

				<ul class="result-list">

					<li>
						<a href="/detail">
							<div class="top-box"><b>어디로</b> 스터디 카페</div>
							<div class="bottom-box">
								<div class="meter-box">500m</div>
								<div class="addr-box">서울 마포구 마포대로 92(도화동)</div>
							</div>
						</a>
					</li>

					<li>
						<a href="/detail">
							<div class="top-box"><b>어디로</b> 스터디 카페</div>
							<div class="bottom-box">
								<div class="meter-box">500m</div>
								<div class="addr-box">서울 마포구 마포대로 92(도화동)</div>
							</div>
						</a>
					</li>


				</ul>


				<div class="request-box">

					<div class="request-txt">원하는 매장이 없나요?</div>
					<div class="request-btn-box">
						<a href="/request_shop" class="request-btn">매장 추가 요청하러 가기</a>
					</div>
				</div>


			</div>




		</div>

	</section>



</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/swiper.min.js"></script>
<script src="../js/ui.js"></script>
<script>

	$('.hp-certify-box input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).parents('.hp-certify-box').removeClass('type-error').removeClass('type-success');
		}else{
			$(this).parents('.hp-certify-box').removeClass('type-error').addClass('type-success');
		}
	});

	$('.map-search-box input').on('keyup',function (){

		if($(this).val().length == 0){
			$(this).removeClass('type-success');
		}else{
			$(this).addClass('type-success');
		}


	})
</script>

</body>
</html>