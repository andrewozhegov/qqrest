<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('page_name') - Ресторан QQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
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
                <!-- если не авторизирован -->
                @if(Auth::check())
                    <li><img class="navbar-img img-circle" src="{{ asset(Auth::user()->image()) }}" alt="{{ Auth::user()->name }}" /></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->name }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile">Профиль</a></li>
                            @if (Auth::user()->is_moder())
                            <li>
                                <a href="/manage/news">Управление @if( $notifies['count'] > 0) <span class="text-right badge">{{ $notifies['count'] }}</span> @endif</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Войти</a></li>
                @endif
                <li><a class="navbar-btn-a" href="/cart"><button class="btn btn-success navbar-btn"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина <span class="badge" id="cart">{{ Session::get('cart.count', 0) }}</span></button></a></li>
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
                    <h3>МЕНЮ</h3>
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Меню</a></li>
                        <li><a href="#">Корзина</a></li>
                        <li><a href="#">Мероприятия</a></li>
                        <li><a href="#">Бронирование</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4 col-md-push-3">
                    <h3>КОНТАКТЫ</h3>
                    <ul>
                        <li><a href="#">тел. +79788854322</a></li>
                        <li><a href="#">ВКонтакте</a></li>
                        <li><a href="#">Телеграм</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Google+</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4 col-md-push-3">
                    <h3>НАШИ ПАРТНЕРЫ</h3>
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
                    <h3>QQ</h3>
                    {{--<div class="fh5co-footer-logo"><a href="index.html">QQ</a></div>--}}
                    <p><small>&copy; 2017. Все права защищены.</small></p>
                    <br />
                    <div id="ytWidget"></div>
                </div>

            </div>
        </div>
    </div>
</footer>

<script src="{{ asset("/js/jquery.min.js") }}"></script>
<script src="{{ asset("/js/bootstrap.min.js") }}"></script>
<script src="https://translate.yandex.net/website-widget/v1/widget.js?widgetId=ytWidget&pageLang=ru&widgetTheme=light&autoMode=false" type="text/javascript"></script>

@yield('js')

</body>
</html>