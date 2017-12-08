@extends('layouts/manage')

@section('page_name', 'Управление заказами')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/material-switch.css') }}" />
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
    <h2>Список заказов:</h2>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Дата</th>
            <th>Заказчик</th>
            <th>Номер телефона</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($orders as $order)
            <tr id="row{{ $order->id }}">
                <th class="rowDone">@if($order->done == 1)<span class="glyphicon glyphicon-ok"></span>@endif</th>
                <td class="rowDate">{{ $order->created_at }}</td>
                <td class="rowName">{{ $order->client_name }}</td>
                <td class="rowPhone">{{ $order->client_phone }}</td>
                <td class="btn-group-xs">
                    <button class="btn btn-info" onclick="show_item('orders', {{ $order->id }})">Открыть</button>
                    <button class="btn btn-success" onclick="done_item('orders', {{ $order->id }})">Готово</button>
                    <button class="btn btn-danger" onclick="delete_item('orders', {{ $order->id }})">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



@section('name-of-open-modal', 'Просмотр продукта')

@section('body-of-open-modal')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="thumbnail">
                <div class="">
                    <div id="openModalTable"></div>
                    <h4 id="openModalPrice"></h4>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('name-of-add-modal', '')

@section('body-of-add-modal')
    <form onsubmit="" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);">
        {{ csrf_field() }}

        <input type="hidden" name="title" value="">
        <textarea style="display:none;" name="text"></textarea>
        <input type="text" class="form-control" name="name" value="" id="form_topic" placeholder="Название продукта">
        <input type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
        <input type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
        <select class="form-control" name="type" id="form_select"></select>
        <input type="number" class="form-control" name="count" value="" id="form_topic" placeholder="">
        <input type="number" class="form-control" name="price" value="" id="form_num1" placeholder="">

    </form>
@endsection



@section('name-of-edit-modal', 'Изменить новость')

@section('body-of-edit-modal')
    <form onsubmit="" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
        {{ csrf_field() }}

        <input type="hidden" name="title_upd" value="">
        <textarea style="display:none;" name="text_upd"></textarea>
        <input type="text" class="form-control" name="name_upd" value="" id="editModalName" placeholder="Название продукта">
        <input type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
        <input type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
        <select class="form-control" name="type_upd" id="editModalType"></select>
        <input type="number" class="form-control" name="count_upd" value="" id="editModalCount">
        <input type="number" class="form-control" name="price_upd" value="" id="editModalPrice">
    </form>
@endsection