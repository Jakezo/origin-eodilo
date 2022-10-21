<!doctype html>
<html lang="ko">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/common.js?time={{ time() }}"></script>


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

<!--end wrapper-->

<!-- Bootstrap JS -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>

<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>


<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@yield('javascript')

</body>

</html>
