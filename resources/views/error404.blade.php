<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <title>Ошибка</title>
    <style>
        .page-404 a {
            background: #0d6aad;
            width: 60%;
        }
        .page-404 img {
            width: 400px;
        }
        .page-404 div.text-secondary {
            padding: 0 10rem;
        }
        @media (max-width: 769px) {
            .page-404 div.text-secondary {
                padding: 0 2rem;
            }
            .page-404 img {
                width: 80%;
            }
        }
    </style>
</head>
<body>
<div style="height: 100vh" class="container">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="page-404">
            <div class="d-flex justify-content-center"><img src="/img/logo.png"></div>
            <div class="mt-5"><h2 class="text-center font-weight-normal">Страница не найдена.</h2></div>
            <div class="text-secondary">
                <p class="text-center">Возможно, вы воспользовались недействительной ссылкой <br> или ссылка была удалена <br><br>
                    Попробуйте вернуться на предыдущую страницу <br> или начать все сначала</p>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a class="p-3 text-white text-center"
                   href="{{route('index')}}">Главная страница</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>