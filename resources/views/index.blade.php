@extends('layouts/main')

@section('page_name', 'Главная страница')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner heigdht-800">
            <div class="item active">
                <img src="img/img1.jpg" alt="Los Angeles" style="width:100%;">
                <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>The atmosphere in New York is lorem ipsum.</p>
                </div>
            </div>

            <div class="item">
                <img src="img/img2.jpg" alt="Chicago" style="width:100%;">
                <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>The atmosphere in New York is lorem ipsum.</p>
                </div>
            </div>

            <div class="item">
                <img src="img/img3.jpg" alt="New york" style="width:100%;">
                <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>The atmosphere in New York is lorem ipsum.</p>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="article">
        <img src="images/article.png"/>
    </div>

    <div class="container">
        <section>
            <h1 class="text-center">СВЕЖИЕ НОВОСТИ</h1>
            <div class="news">
                <h3>Ресторан QQ ждет своих клиентов!</h3>
                <img src="images/news/nw1.jpg" alt="Картинка новости" />
                <p>The biggest problem most people face in learning a new language is their own fear. They worry that they won’t say things correctly or that they will look stupid so they don’t talk at all. Don’t do this. The fastest way to learn anything is to do it – again and again until you get it right. Like anything, learning English requires practice. Don’t let a little fear stop you from getting what you want. </p>
                <h6 class="text-right">28.11.2017</h6>
            </div>

        </section>
    </div>

    <div class="article">
        <img src="images/article.png"/>
    </div>

    <section>
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Abe569007edac4aaf6f5c4ea61a7faac0774a10a0a4c2490796b98eba58c275a0&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
    </section>
@endsection


