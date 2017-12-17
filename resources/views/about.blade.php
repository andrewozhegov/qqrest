@extends('layouts/main')

@section('page_name', 'О нас')

@section('css')
@endsection

@section('js')
@endsection

@section('content')

    <div class="container">

        <div class="article">
            <img src="images/article.png"/>
        </div>

        @if(count($branches) > 0)
            <section>
                <h1 class="text-center">ФИЛЛИАЛЫ</h1>
                <div class="row text-center">
                    @foreach($branches as $branch)
                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <img src="{{ $branch->image() }}" alt="{{ $branch->name }}" width="400" height="300">
                                <div class="">
                                    <p><strong>{{ $branch->name }}</strong></p>
                                    <p>{{ $branch->address }}</p>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if(count($services) > 0)
            <section>
                <h1 class="text-center">ОБСЛУЖИВАНИЕ КЛИЕНТОВ</h1>


                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner heigdht-800">
                        @foreach($services as $service)
                            <div class="item @if ($service->id == 1) active @endif">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <img src="{{ $service->image() }}" alt="{{ $service->title }}" style="width:100%;">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <h3 class="text-right text" style="font-size: 40px">{{ $service->title }}</h3>
                                        <br/>
                                        <p class="text-right" style="font-size: 20px">{{ $service->text }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Left and right controls-->
                    <a class="left carousel-control hidden" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control hidden" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
        @endif

        @if(count($services) > 0)
            <section>
                <h1 class="text-center">НАШИ ПОБЕДЫ</h1>
                <div class="row text-center">
                    @foreach($awards as $award)
                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <img src="{{ $award->image() }}" alt="{{ $award->name }}" width="400" height="300">
                                <div class="">
                                    <br />
                                    <p><strong>{{ $award->name }}</strong></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if(count($staffs) > 0)
            <section>
                <h1 class="text-center">ПЕРСОНАЛ</h1>
                <div class="container text-center">
                    <div class="row">
                        @foreach($staffs as $staff)
                            <div class="col-sm-4">
                                <a href="#demo{{ $staff->id }}" data-toggle="collapse">
                                    <img src="{{ $staff->image() }}" class="img-circle person" alt="{{ $staff->name }}" width="255" height="255">
                                </a>
                                <div id="demo{{ $staff->id }}" class="collapse">
                                    <strong>{{ $staff->name }}</strong>
                                    <p>{{ $staff->role->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section>
            @foreach($reviews as $review)
                <div class="media">
                    <div class="media-left">
                        <img src="{{ $review->user->image() }}" class="img-circle media-object" alt="" style="width:60px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $review->user->name }}</h4>
                        <p>{{ $review->text }}</p>
                        <h6>{{ $review->created_at }}</h6>
                    </div>
                </div>
            @endforeach

            @if(Auth::check())
                <form enctype="multipart/form-data" class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="comment">Оставить комментарий:</label>
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Отправить</button>
                </form>
            @else
                <div>Войдите или зарегистрируйтесь, чтобы оставить коментарий!</div>
            @endif
        </section>
    </div>

    <div class="article">
        <img src="images/article.png"/>
    </div>

@endsection