<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/css/app.css" rel="stylesheet">
    <style>
        body {
            background-color: #EDEBEC;
        }

        .wrapper {
            margin: 10px auto;
            max-width: 1100px;
        }

        #main_menu {
            height: 100px;
        }

        #main_menu .main_logo {
            height: 80px;
        }

        .search_package_block,
        .info_block {
            height: 57vh;
            margin-bottom: 25px;
            border-radius: 30px;
            background-color: #3490DC;
            padding: 30px;
        }
        .search_package_block{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .search_package_block div{
            margin-bottom: 20px;
        }
        .search_package_block h2{
            color: white;
            font-weight: 500;
        }
        .search_package_block p{
            color: #002B80;
        }
        .search_package_input{
            margin-right: 5px;
        }
        .baner_text{
            font-size: 32px;
            color: white;
            text-align: center;
        }
        .info_block{
            position: relative;
        }
        .info_block:after{
            content: "";
            position: absolute;
            top: 115px;
            left: 60px;
            width:100%;
            height: 100%;
            background-image: url(/img/post.png);
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <div id="main_menu" class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom">
            <a class="my-0 mr-md-auto font-weight-normal" href="#"><img src="/img/main_logo.png" alt="company_logo" class="main_logo"></a>

            <nav class="my-2 my-md-0 mr-md-3">
                <a class="btn btn-primary" href="#" role="button">Відділення</a>
                <a class="btn btn-primary" href="#" role="button">Розрахунок вартості</a>


                <button type="button" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg>
                    Мій кабінет
                </button>
            </nav>
            <!-- <a class="btn btn-outline-primary" href="#">Sign up</a> -->
        </div>
        <div class="container main_content">
            <div class="row">
                <div class="col-4 search_package_block">
                    <div>
                        <h2>Детальна інформація про вашу посилку:</h2>
                    </div>
                    <div>
                        <p>Дізнайтеся статус посилки та дату її прибуття</p>
                    </div>
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded search_package_input" placeholder="Введіть номер посилки" aria-label="Search" aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="col-1">

                </div>
                <div class="col-7 info_block">
                    <p class="baner_text"> Отримуйте посилки вчасно і за найнижчими цінами!</p>
                </div>
            </div>
        </div>
        <div id="main_menu" class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-top">
            <div>&#169; 2021 Цимбалюк Наталія в рамках курсу "PHP DEVELOPER - КОМП'ЮТЕРНА АКАДЕМІЯ HASHTAG" </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>

</html>