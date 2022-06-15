<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!--link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"-->
    <link href="/assets/css/icons.css" rel="stylesheet">

    <title>관리자</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">

    @yield('content')


    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2021. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->

<!-- Bootstrap JS -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>


@yield('javascript')

</body>

</html>
