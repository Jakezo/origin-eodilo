<!doctype html>
<html lang="ko">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />



    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!--link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"-->
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="/assets/css/header-colors.css" />
    <link rel="stylesheet" href="/assets/css/style.css">

        
    <title>관리자</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">

    @yield('content')

</div>
<!--end wrapper-->
<div class="modal fade" id="errorInfoModal" tabindex="-2" aria-labelledby="errorInfoModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
    <div class="modal-dialog modal- md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seatStatusModalLabel">알림</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">



            </div>
            <div class="modal-footer">
                <button type="button" id="errorInfoModalConfirm" class="btn btn-primary d-none" data-bs-dismiss="modal">확인</button>
                <button type="button" id="errorInfoModalClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 




   
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<!--script src="/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script-->
<!--script src="/assets/js/index5.js"></script-->
<!--app JS-->
<script src="/assets/js/common.js?time={{ time() }}"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


@yield('javascript')
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd", // 텍스트 필드에 입력되는 날짜 형식.
            changeMonth: true, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
            changeYear: true, // 년을 바꿀 수 있는 셀렉트 박스를 표시한다.
            nextText: '다음 달', // next 아이콘의 툴팁.
            prevText: '이전 달', // prev 아이콘의 툴팁.
            yearRange: 'c-10:c+2', // 년도 선택 셀렉트박스를 현재 년도에서 이전, 이후로 얼마의 범위를 표시할것인가.
            numberOfMonths: [1,1], // 한번에 얼마나 많은 월을 표시할것인가. [2,3] 일 경우, 2(행) x 3(열) = 6개의 월을 표시한다.
            dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'], // 요일의 한글 형식.
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식.
            showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다.
            currentText: '오늘 날짜' , // 오늘 날짜로 이동하는 버튼 패널
            closeText: '닫기',  // 닫기 버튼 패널
            /*
              minDate: '-100y', // 현재날짜로부터 100년이전까지 년을 표시한다.
              showButtonPanel: true, // 캘린더 하단에 버튼 패널을 표시한다.
                buttonImage: "images/cal.jpg", // 버튼 이미지
            */
        });

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 5,
            //minTime: '5',
            //maxTime: '6:00pm',
            //defaultTime: '11',
            //startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });        
    });    
</script>
</body>

</html>
