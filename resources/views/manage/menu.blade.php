@extends('layouts/manage')

@section('page_name', 'Управление товаром')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/material-switch.css') }}" />
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
    <button data-toggle="modal" data-target="#addModal" class="btn btn-warring">Добавить товар</button>
    <h2>Список товаров:</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Название</th>
            <th>Количество</th>
            <th>Отобразить</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($products as $product)
            <tr id="row{{ $product->id }}">
                <td class="rowName">{{ $product->name }}</td>
                <td class="rowCount">{{ $product->count }}</td>
                <td>
                    <div class="material-switch pull-left">
                        <input type="checkbox" id="switch{{ $product->id }}" onclick="change_board('productboard', {{ $product->id }})" @if (\App\ProductBoard::is_on_board($product)) checked="true" @endif/>
                        <label for="switch{{ $product->id }}" class="label-success"></label>
                    </div>
                </td>
                <td class="btn-group-xs">
                    <button class="btn btn-info" onclick="show_item('menu', {{ $product->id }})">Открыть</button>
                    <button class="btn btn-warning" onclick="edit_item('menu', {{ $product->id }})">Изменить</button>
                    <button class="btn btn-danger" onclick="delete_item('menu', {{ $product->id }})">Удалить</button>
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
                <img id="openModalImage" src="" alt="" width="400">
                <div class="">
                    <p><strong id="openModalName"></strong></p>
                    <p id="openModalType"></p>
                    <h4 id="openModalPrice"></h4>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('name-of-add-modal', 'Добавить продукт')

@section('body-of-add-modal')
    <form onsubmit="add_item('menu')" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);">
        {{ csrf_field() }}

        <input type="hidden" name="title" value="">
        <textarea style="display:none;" name="text"></textarea>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_topic">Название продукта</label>
                <input type="text" class="form-control" name="name" value="" id="form_topic" placeholder="Название продукта">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_photo">Фотография</label>
                <img src="" alt="">
                <input type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_photo1">Фото для галлереи</label>
                <img src="" alt="">
                <input type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_select">Тип продукта</label>
                <select class="form-control" name="type" id="form_select">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_num">Количество</label>
                <input type="number" class="form-control" name="count" value="" id="form_topic" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_num1">Цена</label>
                <input type="number" class="form-control" name="price" value="" id="form_num1" placeholder="">
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
@endsection



@section('name-of-edit-modal', 'Изменить новость')

@section('body-of-edit-modal')
    <form onsubmit="update_item()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
        {{ csrf_field() }}

        <input type="hidden" name="title_upd" value="">
        <textarea style="display:none;" name="text_upd"></textarea>

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalName">Название продукта</label>
                <input type="text" class="form-control" name="name_upd" value="" id="editModalName" placeholder="Название продукта">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_photo">Фотография</label>
                <img id="editModalImage" src="" alt="" style="max-width:100%; margin-bottom:7px;">
                <input type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_photo1">Фото для галлереи</label>
                <img id="editModalImage1" src="" alt="" style="max-width:100%; margin-bottom:7px;">
                <input type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalType">Тип продукта</label>
                <select class="form-control" name="type_upd" id="editModalType">
                    @foreach($types as $type)
                        <option id="editModalType{{ $type->id }}" value="{{ $type->id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalCount">Количество</label>
                <input type="number" class="form-control" name="count_upd" value="" id="editModalCount">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalPrice">Цена</label>
                <input type="number" class="form-control" name="price_upd" value="" id="editModalPrice">
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
@endsection