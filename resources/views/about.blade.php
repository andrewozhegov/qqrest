@extends('layouts/main')

@section('page_name', 'О нас')

@section('css')
@endsection

@section('js')
    <script src="{{ asset("js/reviews.js") }}"></script>
    <script src="{{ asset("tinymce/tinymce.min.js") }}"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            height: 500,
            plugins: 'image link save',
            entity_encoding : "raw"
        });
    </script>
@endsection

@section('content')

    <div class="container">

        <div class="article">
            <img src="images/article.png"/>
        </div>

        @if(count($branches) > 0)
            <section>
                <h1 class="text-center"><a name="branches">ФИЛЛИАЛЫ</a></h1>
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
            <section >
                <h1 class="text-center"><a name="services">ОБСЛУЖИВАНИЕ КЛИЕНТОВ</a></h1>

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
                <h1 class="text-center"><a name="awards">НАШИ ПОБЕДЫ</a></h1>
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
                <h1 class="text-center"><a name="staff">ПЕРСОНАЛ</a></h1>
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
            <h1 class="text-center"><a name="reviews">ОТЗЫВЫ</a></h1>
            <div id="reviews_block">
                @foreach($reviews as $review)
                    <div class="media">
                        <div class="media-left">
                            <img src="{{ $review->user->image() }}" class="img-circle media-object" alt="" style="width:60px">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $review->user->name }}</h4>
                            <p>{!! $review->text !!} </p>
                            <h6>{{ $review->created_at }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(Auth::check())
                    <button type="button" class="btn btn-danger btn-lg article" data-toggle="modal" data-target="#editModal">Оставить отзыв</button>
            @else
                <p>Войдите или зарегистрируйтесь, чтобы оставить коментарий!</p>
            @endif
        </section>
    </div>

    <div class="article">
        <img src="images/article.png"/>
    </div>

    <div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Добавить отзыв</h4>    {{-- Название модального изменения --}}
                </div>
                <div class="modal-body">
                    <form onsubmit="add_review()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_add_item" action="javascript:void(null);" >
                        {{-- форма добавления новой записи --}}
                        {{ csrf_field() }}
                        <input type="hidden" name="title_upd" value="">
                        <input type="text" class="form-control hidden" name="name_upd" value="" id="editModalName" placeholder="Название продукта">
                        <input class="hidden" type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
                        <input class="hidden" type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
                        <select class="form-control hidden" name="type_upd" id="editModalType"></select>
                        <input type="number" class="form-control hidden" name="count_upd" value="" id="editModalCount">
                        <input type="number" class="form-control hidden" name="price_upd" value="" id="editModalPrice">

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="editModalText">Сообщение</label>
                                <textarea id="editModalText" class="form-control" name="text_upd" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <input id="submit" class="form-control btn btn-block btn-primary"  type="submit" value="Отправить">
                            </div>
                            <div class="col-md-4">
                                <input class="form-control btn btn-block btn-default" type="reset" value="Очистить">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection