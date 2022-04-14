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
	<link href="/mobile/css/swiper.min.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/ui.css" rel="stylesheet" type="text/css"/>
	<link href="/mobile/css/style.css" rel="stylesheet" type="text/css"/>



</head>
<body>
<div class="container" style=";">

	<header style="">
		<div class="wrap" >
			<article class="header-page-group" style="">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">나의리뷰</div>
			</article>
		</div>
	</header>

	<section class="my-review">

		<div class="inner wrap">

			<article class="my-review-list-group">
				<div class="review-current-box">
					<div class="review-current-txt">
						작성한 리뷰 0건
					</div>
				</div>

				<ul class="review-list">
					<li class="review-item">

						<div class="review-top-box">

							<div class="img-box">
								<img src="/mobile/img/img_recommend_dummy4.png" alt="이미지">
							</div>

							<div class="info-box">

								<div class="menu-box">
									<a href="#none" class="menu-btn">수정</a>
									<a href="javascript:popupOpen('alarm')" class="menu-btn">삭제</a>
								</div>

								<div class="shop-box">어디로 스터디 카페 대흥점</div>
								<div class="seat-box">자유석 이용</div>
								<div class="rate-box">

									<article class="rate-view">
										<div class="rate rate-5"></div>
									</article>

									<div class="rate-date">1개월 전 작성</div>
								</div>

							</div>

						</div>

						<div class="review-bottom-box">
							<div class="txt-box">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam elementum ultricies magna at finibus. Praesent faucibus luctus libero eget elementum. Maecenas nec nibh pretium, mollis lorem...Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam elementum ultricies magna at finibus. Praesent faucibus luctus libero eget elementum. Maecenas nec nibh pretium, mollis lorem... 더보기 텍스트 더보기 텍스트더보기 텍스트더보기 텍스트더보기 텍스트더보기 텍스트더보기 텍스트더보기 텍스트
							</div>

							<div class="more-btn-box">
								<a href="#none" class="more-btn" onclick="moreTxt(this)">더보기</a>

							</div>
						</div>

					</li>

					<li class="review-item">

						<div class="review-top-box">

							<div class="img-box">
								<img src="/mobile/img/img_recommend_dummy4.png" alt="이미지">
							</div>

							<div class="info-box">

								<div class="menu-box">
									<a href="#none" class="menu-btn">수정</a>
									<a href="javascript:popupOpen('alarm')" class="menu-btn">삭제</a>
								</div>

								<div class="shop-box">어디로 스터디 카페 대흥점</div>
								<div class="seat-box">자유석 이용</div>
								<div class="rate-box">

									<article class="rate-view">
										<div class="rate rate-5"></div>
									</article>

									<div class="rate-date">1개월 전 작성</div>
								</div>

							</div>

						</div>

						<div class="review-bottom-box">
							<div class="txt-box">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam elementum ultricies magna at finibus. Praesent faucibus luctus libero eget elementum. Maecenas nec nibh pretium, mollis lorem...Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam elementum ultricies magna at finibus. Praesent faucibus luctus libero eget elementum. Maecenas nec nibh pretium, mollis lorem...
							</div>

							<div class="more-btn-box">
								<a href="#none" class="more-btn" onclick="moreTxt(this)">더보기</a>

							</div>
						</div>

					</li>

				</ul>

			</article>


		</div>




	</section>

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

				<a class="nav-btn on" href="#none">
					<div class="ic-box"><i class="ic ic-my"></i></div>
					<div class="txt-box">마이페이지</div>
				</a>

				<a class="nav-btn" href="#none">
					<div class="ic-box"><i class="ic ic-more"></i></div>
					<div class="txt-box">더보기</div>
				</a>
			</div>

		</div>

	</article>

	<article class="popup popup-alarm" style="">

		<div class="popup-wrap">

			<div class="popup-msg-group">

				<div class="msg-contents-box">

					<div class="ic-box">
						<i class="ic ic-warning"></i>
					</div>
					<div class="contents-box">
						<div class="txt-box">
							리뷰를 삭제하면 재작성이 불가능 해요.<br/>
							정말 삭제하시겠어요?
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
<script src="/mobile/js/ui.js"></script>
<script>


	function moreTxt(e){
		$(e).parent().siblings('.txt-box').addClass('type-more');
		$(e).hide();
	}


</script>

</body>
</html>