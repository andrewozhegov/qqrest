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

        <section>
            <h1 class="text-center">ФИЛЛИАЛЫ</h1>
            <div class="row text-center">
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="images/ava.jpg" alt="Paris" width="400" height="300">
                        <div class="">
                            <p><strong>Paris</strong></p>
                            <p>Friday 27 November 2015</p>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="images/ava.jpg" alt="New York" width="400" height="300">
                        <div>
                            <p><strong>Paris</strong></p>
                            <p>Friday 27 November 2015</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="images/ava.jpg" alt="San Francisco" width="400" height="300">
                        <div>
                            <p><strong>Paris</strong></p>
                            <p>Friday 27 November 2015</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h1 class="text-center">ОБСЛУЖИВАНИЕ КЛИЕНТОВ</h1>

            <div class="container row">
                <div class="col-md-6 col-sm-12">

                </div>
                <div class="col-md-6 col-sm-12">
                    <p class="text-right">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
            </div>

        </section>

        <section>
            <h1 class="text-center">НАШИ ПОБЕДЫ</h1>
            <div class="row text-center">
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="images/ava.jpg" alt="Paris" width="400" height="300">
                        <div class="">
                            <br />
                            <p>Оскар</p>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="images/ava.jpg" alt="New York" width="400" height="300">
                        <div>
                            <p><strong>Paris</strong></p>
                            <p>Friday 27 November 2015</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="images/ava.jpg" alt="San Francisco" width="400" height="300">
                        <div>
                            <p><strong>Paris</strong></p>
                            <p>Friday 27 November 2015</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h1 class="text-center">ПЕРСОНАЛ</h1>
            <div class="container text-center">
                <p><em>We love music!</em></p>
                <p>We have created a fictional band website. Lorem ipsum..</p>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="text-center"><strong>Name</strong></p><br>
                        <a href="#demo" data-toggle="collapse">
                            <img src="images/ava.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
                        </a>
                        <div id="demo" class="collapse">
                            <p>Guitarist and Lead Vocalist</p>
                            <p>Loves long walks on the beach</p>
                            <p>Member since 1988</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-center"><strong>Name</strong></p><br>
                        <a href="#demo2" data-toggle="collapse">
                            <img src="images/ava.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
                        </a>
                        <div id="demo2" class="collapse">
                            <p>Drummer</p>
                            <p>Loves drummin'</p>
                            <p>Member since 1988</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-center"><strong>Name</strong></p><br>
                        <a href="#demo3" data-toggle="collapse">
                            <img src="images/ava.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
                        </a>
                        <div id="demo3" class="collapse">
                            <p>Bass player</p>
                            <p>Loves math</p>
                            <p>Member since 2005</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <!-- Отзывы -->
            <div class="media">
                <div class="media-left">
                    <img src="images/ava.jpg" class="img-circle media-object" alt="Имя пользователя" style="width:60px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Имя Фамилия</h4>
                    <p>The biggest problem most people face in learning a new language is their own fear.</p>
                    <h6>28.11.2017</h6>
                </div>
            </div>
            @if(Auth::check())
                <form>
                    <div class="form-group">
                        <label for="comment">Оставить комментарий:</label>
                        <textarea class="form-control" rows="3" id="comment"></textarea>

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