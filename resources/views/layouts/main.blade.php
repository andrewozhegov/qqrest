<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('page_name') - Ресторан QQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @yield('css')

</head>

<body>
<header>
    <nav class="navbar navbar-inverse ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">QQ</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Главная страница</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">О нас
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/about">Филлиалы</a></li>
                        <li><a href="/about">Достижения</a></li>
                        <li><a href="/about">Достижения</a></li>
                        <li><a href="/about">Отзывы</a></li>
                    </ul>
                </li>
                <li><a href="/menu">Меню</a></li>
                <li><a href="/table">Заказ столика</a></li>
                <li><a href="/event">Мероприятие</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="navbar-btn-a" href="/cart"><button class="btn btn-success navbar-btn"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина</button></a></li>
                <!-- если не авторизирован -->
                @if(Auth::check())
                    <li><img class="navbar-img img-circle" src="images/ava.jpg" alt="Имя пользователя" /></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Имя Фамилия
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile">Профиль</a></li>
                            <li><a href="/merge/news">Управление</a></li>
                            <li><a href="#">Выйти</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Войти</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>

<main>
    @yield('content')

    <section>
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Abe569007edac4aaf6f5c4ea61a7faac0774a10a0a4c2490796b98eba58c275a0&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
    </section>

</main>

<footer>
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-md-push-3">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">Tour</a></li>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">New Features</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4 col-md-push-3">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Security</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">More Apps</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4 col-md-push-3">
                    <h3>More Links</h3>
                    <ul>
                        <li><a href="#">Feedback</a></li>
                        <li><a href="#">Frequently Ask Questions</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">More Apps</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-12 col-md-pull-9">
                    <div class="fh5co-footer-logo"><a href="index.html">QQ</a></div>
                    <p><small>&copy; 2017. Все права защищены.</small></p>
                </div>

            </div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield('js')

</body>
</html>