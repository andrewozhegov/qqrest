@extends('layouts/main')

@section('page_name', 'Зарезервировать столик')

@section('css')
@endsection

@section('js')
@endsection

@section('content')

    <div class="article">
        <img src="images/article.png"/>
    </div>

    <h1 class="text-center">ЗАРЕЗЕРВИРОВАТЬ СТОЛИК</h1>

    <div class="container">
        <form enctype="multipart/form-data" class="form-horizontal" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Ваша Фамилия и Имя:</label>
                <input type="text" class="form-control" name="name" id="name" value="@if(Auth::check()) {{ Auth::user()->name }} @endif">
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
                <input type="tel" class="form-control" name="phone" id="ph" value="@if(Auth::check()) {{ Auth::user()->phone }} @endif">
            </div>
            <button type="submit" class="btn btn-default">Отправить заявку</button>
        </form>
    </div>

    <div class="article">
        <img src="images/article.png"/>
    </div>

@endsection