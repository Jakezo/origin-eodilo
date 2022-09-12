<!doctype html>
<html lang="ko">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

<!-- Bootstrap JS -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>

@yield('javascript')
<script>
function ajax_error(jsonData){
    
    console.log(jsonData);
    if( typeof jsonData.errors != 'undefined' ){
        // console.log(jsonData.errors)
        $('.feedback_red').remove()
        $.each(jsonData.errors, function(k,v){
            $('#'+k).after("<div class='feedback_red'>"+v[0]+"</div>")
        })

        return true
    }
    else if( typeof jsonData.message != 'undefined' ){
        switch(jsonData.message){
            case "Unauthenticated.":
                location.href="/"
            break;

            default:
            alert("An unknown error has occurred.")
        }
    }
}
</script>
</body>

</html>
