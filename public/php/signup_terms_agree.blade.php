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
<div class="container with-btn" style="padding-bottom: 0;">

	<header>
		<div class="wrap">
			<article class="header-page-group">
				<a href="#none" class="back-btn"></a>
			</article>
		</div>
	</header>

	<section class="signup">

		<div class="inner wrap">

			<div class="tit-box">어디로 앱 회원가입</div>

			<div class="agree-box">
				<div class="agree-txt">안녕하세요, 당신의 <span class="col_success">약관동의</span>가 필요해요!</div>

				<div class="agree-list">

					<div class="item-box">
						<div class="cbox">
							<label>
								<input type="checkbox" class="all"><i></i>
								<span class="txt" style="font-weight: 700;">전체동의</span>
							</label>
						</div>
					</div>

					<div class="item-box" style="margin-top: 25px;">
						<div class="cbox">
							<label>
								<input type="checkbox" class="normal"><i></i>
								<span class="txt">어디로 이용약관 동의 (필수)</span>
							</label>
						</div>
						<a href="#none" class="link-btn"></a>
					</div>

					<div class="item-box">
						<div class="cbox">
							<label>
								<input type="checkbox" class="normal"><i></i>
								<span class="txt">전자금융거래 이용약관 동의 (필수)</span>
							</label>
						</div>
						<a href="#none" class="link-btn"></a>

					</div>

					<div class="item-box">
						<div class="cbox">
							<label>
								<input type="checkbox" class="normal"><i></i>
								<span class="txt">개인정보 수집 이용 동의 (필수)</span>
							</label>
						</div>
						<a href="#none" class="link-btn"></a>

					</div>

					<div class="item-box">
						<div class="cbox">
							<label>
								<input type="checkbox" class="normal"><i></i>
								<span class="txt">개인정보 수집 이용 동의 (선택)</span>
							</label>
						</div>
						<a href="#none" class="link-btn"></a>

					</div>

					<div class="item-box">
						<div class="cbox">
							<label>
								<input type="checkbox" class="normal"><i></i>
								<span class="txt">개인정보 제3자 제공 동의 (선택)</span>
							</label>
						</div>
						<a href="#none" class="link-btn"></a>

					</div>

					<div class="item-box">
						<div class="cbox">
							<label>
								<input type="checkbox" class="normal"><i></i>
								<span class="txt">마케팅 정보 메일, SMS 수신 동의 (선택)</span>
							</label>
						</div>
						<a href="#none" class="link-btn"></a>

					</div>



				</div>

			</div>


		</div>




	</section>

	<article class="page-with-btn">
		<article class="menu-btn-box">
			<a href="/signup_hp1" class="menu-btn">다음</a>
		</article>
	</article>


</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/ui.js"></script>
<script>

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