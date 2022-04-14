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
<div class="container" style="background-color: #F9F9FA;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">공지사항</div>
			</article>
		</div>
	</header>

	<section class="board-type1">

		<div class="inner wrap">
			<article class="board-type1-group">

				<div class="board-type1-view">

					<div class="head-box">

						<div class="subject-box">
							서비스 이용약관 개정안내
						</div>
						<div class="sub-box">
							2021.12.01
						</div>
					</div>

					<div class="body-box">

						<div class="txt-box">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a mi tincidunt, pellentesque velit quis, sodales orci. Sed elementum pretium dolor vel pellentesque. Curabitur aliquam pulvinar libero, et sodales mauris egestas vel. Aenean sollicitudin tristique sapien non tempus. Cras eleifend enim sed aliquam porta. Quisque facilisis diam nisi, sit amet facilisis quam ornare at. Vestibulum at erat ut tortor semper dictum et eget nunc.<br/><br/>

							Nam dictum ante dolor, sed fermentum purus maximus eget. Nullam a metus maximus, mollis mi quis, auctor felis. Suspendisse ac vehicula justo, ac fermentum lacus. Vestibulum dictum vel est in volutpat. Aliquam sollicitudin quis orci vitae luctus. Aenean iaculis eu erat sed congue.<br/><br/>

							Duis euismod aliquet varius. Phasellus sed condimentum mauris. Aliquam sollicitudin nunc orci, vitae elementum velit ultrices a. Fusce eu arcu dignissim purus dignissim feugiat. Praesent ullamcorper volutpat est. Praesent sit amet diam nec libero euismod lacinia ut aliquet turpis. Suspendisse ac mauris id tellus porttitor ultrices vitae vitae dolor. Ut non sollicitudin sapien, et finibus arcu.
						</div>

					</div>





				</div>

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

<script src="/mobile/js/jquery-3.1.1.min.js"></script>
<script src="/mobile/js/jquery-ui-1.12.1.js"></script>
<script src="/mobile/js/swiper.min.js"></script>
<script src="/mobile/js/ui.js"></script>
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