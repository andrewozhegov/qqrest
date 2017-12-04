@extends('layouts/main')

@section('page_name', 'Корзина')

@section('css')
@endsection

@section('js')
    <script src="js/cart.js"></script>
    {{--<script>--}}
        {{--$(document).ready( function() {--}}
            {{--$(function () {--}}
                {{--var sum = 0;--}}
                {{--$('.table').live(function() {--}}
                    {{--$('tr').each(function()--}}
                    {{--{--}}
                        {{--//sum += parseInt($('.prc').val()) * parseInt($('.cnt').val());--}}
                        {{--//sum = 5;--}}
                        {{--var ppp = $('.prc').html() * $('.cnt').html();--}}
                        {{--console.log(ppp);--}}
                        {{--console.log('sdsds');--}}
                        {{--sum += $('.prc').html() * $('.cnt').html();--}}
                    {{--});--}}
                {{--});--}}
                {{--//$('#res').html(sum);--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection

@section('content')
    <div class="container">
        <div class="article">
            <img src="images/article.png"/>
        </div>

        <section>
              <h2>Товары в вашей корзине:</h2>
              <table class="table">
                  <thead>
                  <tr>
                      <th>Название</th>
                      <th>Цена за ед.</th>
                      <th>Количество</th>
                      <th>Регулировать</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)
                      <tr class="itm">
                          <td>{{ $product->name }}</td>
                          <td class="prc">{{ $product->price }}</td>
                          <td class="cnt prod{{ $product->id }}">
                              {{ $cart[$product->id] }}
                          </td>
                          <td>
                              <button type="button" class="btn btn-xs btn-default button-to-cart" data-to-cart="{{ $product->id }}" data-count-of="minus"><span class="glyphicon glyphicon-minus"></span></button>
                              <button type="button" class="btn btn-xs btn-default button-to-cart" data-to-cart="{{ $product->id }}" data-count-of="plus"><span class="glyphicon glyphicon-plus"></span></button>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
            <h1>Итог: <my id="res">{{ Session::get('cart.price', 0) }}</my> р.</h1>
            <h5>Ваша заявка будет рассмотрена в течение 15 минут!</h5>
            <div class="container">
                <form enctype="multipart/form-data" class="form-horizontal" method="post">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Ваша Фамилия и Имя:</label>
                            <input type="text" class="form-control" name="name" id="name" value="@if(Auth::check()) {{ Auth::user()->name }} @endif">
                        </div>
                        <div class="form-group">
                            <label for="ph">Введите контактный номер телфона:</label>
                            <input type="tel" class="form-control" name="phone" id="ph" value="@if(Auth::check()) {{ Auth::user()->phone }} @endif">
                        </div>
                        <button type="submit" class="btn btn-default">Отправить заявку</button>
                </form>
            </div>

        </section>

        <div class="article">
            <img src="images/article.png"/>
        </div>

    </div>
@endsection