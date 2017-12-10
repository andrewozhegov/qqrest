@extends('layouts/manage')

@section('page_name', 'Управление мероприятиями')

@section('css')
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
    <h2>Заявки на проведение мероприятий:</h2>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Время проведения</th>
            <th>Заказчик</th>
            <th>Номер телефона</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($events as $event)
            <tr id="row{{ $event->id }}">
                <th class="rowDone">@if($event->done == 1)<span class="glyphicon glyphicon-ok"></span>@endif</th>
                <td class="rowDate">{{ $event->date_time }}</td>
                <td class="rowName">{{ $event->order->client_name }}</td>
                <td class="rowPhone">{{ $event->order->client_phone }}</td>
                <td class="btn-group-xs">
                    <button class="btn btn-info" onclick="show_item('events', {{ $event->id }})">Открыть</button>
                    <button class="btn btn-success" onclick="done_item('events', {{ $event->id }})">Готово</button>
                    <button class="btn btn-danger" onclick="delete_item('events', {{ $event->id }})">Удалить</button>
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
                    <my>Адрес: <h4 id="openModalTitle"></h4></my>
                    <br/>
                    <div id="openModalTable"></div>
                    <br/>
                    <my>Итоговая цена: <h4 id="openModalPrice"></h4></my>
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