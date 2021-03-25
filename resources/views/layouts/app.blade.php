<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">       
</head>

<body>
    <div class="wrapper">

        @yield('content');

        <div id="main_menu" class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-top">
            <div>&#169; 2021 Цимбалюк Наталія в рамках курсу "PHP DEVELOPER - КОМП'ЮТЕРНА АКАДЕМІЯ HASHTAG" </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>

</html>