@extends('layouts/main')

@section('page_name', 'Мероприятие')

@section('css')
@endsection

@section('js')
    <script>
        function event_calc() {
            var event_count = 5000;
            var guest_count = 500;
            var cart_count = parseInt($('#cart_price').text());
            var num_guest = $('input[name=guests]')[0].value;

            var price_all = event_count + (guest_count * num_guest) + cart_count;

            $("#price_all").html(price_all);
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="article">
            <img src="images/article.png"/>
        </div>

        <section>
            <h1 class="text-center">ОФОРМЛЕНИЕ МЕРОПРИЯТИЯ</h1>
            <h3><span class="glyphicon glyphicon-shopping-cart"></span> Корзина: <my id="cart_price">{{ Session::get('cart.price', 0) }}</my> р.</h3>
            <br/>
            <p><span class="glyphicon glyphicon-pushpin"></span> Для того, чтобы добавить товар, перейдите в 'Меню'</p>
            <p><span class="glyphicon glyphicon-pushpin"></span> Для того, чтобы регулировать количество товара, перейдите в 'Корзину'</p>
            <p><span class="glyphicon glyphicon-pushpin"></span> Аренда помещения ресторана для банкета - 5000 р.</p>
            <p><span class="glyphicon glyphicon-pushpin"></span> Стоимость места для одного человека - 500 р.</p>
            <br/>
            <h5><span class="glyphicon glyphicon-pushpin"></span> Ваша заявка будет рассмотрена в течение 15 минут!</h5>
            <br/>
            <div class="container">
                <form enctype="multipart/form-data" class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="dt">Количество человек:</label>
                        <input onchange="event_calc()" type="number" class="form-control" name="guests" id="guests">
                    </div>
                    <div class="form-group">
                        <label for="name">Ваша Фамилия и Имя:</label>
                        <input type="text" class="form-control" name="name" id="name" value="@if(Auth::check()){{ Auth::user()->name }}@endif">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Выберите адрес филиала ресторана:</label>
                        <select class="form-control" name="address" id="sel1">
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}, {{ $branch->address }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dt">Выберите дату:</label>
                        <input type="date" class="form-control" name="date" id="dt">
                    </div>
                    <div class="form-group">
                        <label for="tm">Выберите время:</label>
                        <input type="time" class="form-control" name="time" id="tm">
                    </div>
                    <div class="form-group">
                        <label for="ph">Введите контактный номер телфона:</label>
                        <input type="tel" class="form-control" name="phone" id="ph" value="@if(Auth::check()){{ Auth::user()->phone }}@endif">
                    </div>
                    <h2>Итого: <my id="price_all">0</my> р.</h2>
                    <button type="submit" class="btn btn-default">Отправить заявку</button>
                </form>
            </div>

        </section>

        <div class="article">
            <img src="images/article.png"/>
        </div>

    </div>
@endsection