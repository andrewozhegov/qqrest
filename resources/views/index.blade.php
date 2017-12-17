@extends('layouts/main')

@section('page_name', 'Главная страница')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    @if(count($branches) > 0)
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner heigdht-800">
                @foreach($branches as $branch)
                <div class="item @if ($branch->id == 1) active @endif">
                    <img src="{{ $branch->img_big() }}" alt="{{ $branch->name }}" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>{{ $branch->name }}</h3>
                        <p>{{ $branch->address }}</p>
                    </div>
                </div>
                @endforeach
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
    @endif
    <div class="article">
        <img src="images/article.png"/>
    </div>

    @if(isset($news))
        <div class="container">
            <section>
                <h1 class="text-center">СВЕЖИЕ НОВОСТИ</h1>
                @foreach($news as $new)
                    <div class="news">
                        <h3>{{ $new->title }}</h3>
                        <img src="{{ $new->image() }}" alt="" />
                        <p>{{ $new->text }}</p>
                        <h6 class="text-right">{{ $new->created_at }}</h6>
                    </div>
                @endforeach
                {{--<ul class="pagination">--}}
                    {{--<li><a href="#">1</a></li>--}}
                    {{--<li><a href="#">2</a></li>--}}
                    {{--<li><a href="#">3</a></li>--}}
                    {{--<li><a href="#">4</a></li>--}}
                    {{--<li><a href="#">5</a></li>--}}
                {{--</ul>--}}
            </section>
        </div>
    @endif

    <div class="article">
        <img src="images/article.png"/>
    </div>
@endsection


