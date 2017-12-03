@extends('layouts/main')

@section('page_name', 'Меню')

@section('css')
    <link rel="stylesheet" href="css/menu.css">
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myDIV div").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script src="js/cart.js"></script>

@endsection

@section('content')
    <div class="container">
        <section class="row menu-title">
            <ul class="menu clearfix">
                <li class="parent">
                    <a href="">БЛЮДА</a>
                    <ul class="children">
                        <li><a href="">Первые</a></li>
                        <li><a href="">Вторые</a></li>
                        <li><a href="">Диетические</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="">НАПИТКИ</a>
                    <ul class="children">
                        <li><a href="">Алкогольные</a></li>
                        <li><a href="">Безалкогольные</a></li>
                    </ul>
                </li>
                <li><a href="">ДЕСЕРТЫ</a></li>
            </ul>
        </section>

        <div class="article-menu">
            <h1> М Е Н Ю</h1>
            <br />
            <input  class="form-control" id="myInput" type="text" placeholder="Search..">
        </div>

        <section>
            <div class="container">
                <div id="myDIV" class="row text-center menu-items">
                    @foreach($products as $product)
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img src="{{ $product->image() }}" alt="" width="400">
                                <div class="">
                                    <p><strong>{{ $product->name }}</strong></p>
                                    <p>Тип: {{ $product->type->type_name }}</p>
                                    <h4>Цена: {{ $product->price }} р.</h4>
                                    <button type="button" class="btn btn-success navbar-btn button-to-cart" data-to-cart="{{ $product->id }}" data-count-of="plus">
                                        <span class="glyphicon glyphicon-shopping-cart"></span>
                                        В корзину
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
    </div>

    <div class="container">
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
    </div>

    <div class="article">
        <img src="images/article.png"/>
    </div>
@endsection