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
	<link href="../css/swiper.min.css" rel="stylesheet" type="text/css"/>
	<link href="../css/ui.css" rel="stylesheet" type="text/css"/>
	<link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container page-with-btn" style="background-color: #F9F9FA;">

	<header style="">
		<div class="wrap" >
			<article class="header-page-group" style="">
				<a href="#none" class="back-btn"></a>
				<div class="page-txt">캐시충전</div>
				<div class="right-menu-box">
					<a href="#none" class="close-btn"></a>
				</div>
			</article>
		</div>
	</header>



	<section class="my-cash">

		<div class="inner wrap">

			<article class="cash-charge-info">

				<div class="summary-box">

					<div class="row">
						<div class="subject"><b>충전할 금액</b></div>
						<div class="con"><b>충전할 금액</b></div>
					</div>

					<div class="row">
						<div class="subject">충전후금액</div>
						<div class="con">54,150</div>
					</div>
				</div>

				<div class="way-box">

					<div class="tit-box">결제 수단</div>

					<div class="way-list">

						<a href="#none" class="way-btn">카카오페이</a>
						<a href="#none" class="way-btn on">신용/체크카드</a>
						<a href="#none" class="way-btn">간편계좌이체</a>
					</div>

				</div>

				<div class="agree-box">
					<div class="agree-txt">할인 및 결제정보</div>

					<div class="agree-list">

						<div class="item-box" style="">
							<div class="cbox">
								<label>
									<input type="checkbox" class="normal"><i></i>
									<span class="txt">결제 이용약관 동의 <span class="ess">(필수)</span></span>
								</label>
							</div>
							<a href="#none" class="link-btn"></a>
						</div>

						<div class="item-box">
							<div class="cbox">
								<label>
									<input type="checkbox" class="normal"><i></i>
									<span class="txt">매장 이용약관 동의 <span class="ess">(필수)</span></span>
								</label>
							</div>
							<a href="#none" class="link-btn"></a>

						</div>

						<div class="item-box">
							<div class="cbox">
								<label>
									<input type="checkbox" class="normal"><i></i>
									<span class="txt">개인정보 제3자 제공 동의 <span class="ess">(필수)</span></span>
								</label>
							</div>
							<a href="#none" class="link-btn"></a>

						</div>


						<div class="item-box">
							<div class="cbox">
								<label>
									<input type="checkbox" class="all"><i></i>
									<span class="txt" style="font-weight: 700;">전체동의</span>
								</label>
							</div>
						</div>



					</div>

				</div>

			</article>



		</div>




	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="#none" class="menu-btn">충전하기</a>
		</article>
	</article>



</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/ui.js"></script>
<script>

	$('.way-list .way-btn').on('click',function (){
		$('.way-list .way-btn').removeClass('on');
		$(this).addClass('on');
	});

	$('.agree-list input[type=checkbox]').on('change',function (){

		if($(this).hasClass('all')){
			if($(this).prop('checked')){
				$('.agree-list input[type=checkbox]').prop('checked',true);
			}else{
				$('.agree-list input[type=checkbox]').prop('checked',false);
			}
		}else{
			var _chk = $('.agree-list input.normal:checked').length;
			var _cnt = $('.agree-list input.normal').length;
			if(_chk != _cnt){
				$('.agree-list input.all').prop('checked',false);
			}else if(_chk == _cnt){
				$('.agree-list input.all').prop('checked',true);

			}

		}
	})


</script>

</body>
</html>