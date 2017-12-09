@extends('layouts/manage')

@section('page_name', 'Управление персоналом')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/material-switch.css') }}" />
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
    <h2>Список зарегистрированых пользователей:</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Статус</th>
            <th>Отобразить</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($users as $user)
            <tr id="row{{ $user->id }}">
                <td class="rowName">{{ $user->name }}</td>
                <td class="rowTitle">{{ $user->role->name }}</td>
                <td>
                    <div class="material-switch pull-left">
                        <input type="checkbox" id="switch{{ $user->id }}" onclick="change_board('staffboard', {{ $user->id }})" @if (\App\StaffBoard::is_on_board($user)) checked="true" @endif/>
                        <label for="switch{{ $user->id }}" class="label-success"></label>
                    </div>
                </td>
                <td class="btn-group-xs">
                    <button class="btn btn-info" onclick="show_item('staff', {{ $user->id }})">Открыть</button>
                    <button class="btn btn-warning" onclick="edit_item('staff', {{ $user->id }})">Назначить</button>
                    <button class="btn btn-danger" onclick="delete_item('staff', {{ $user->id }})">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



@section('name-of-open-modal', 'Просмотр профиля')

@section('body-of-open-modal')
        <div class="media">
            <div class="media-left">
                <img id="openModalImage" src="" class="img-circle media-object" alt="" style="width:60px">
            </div>
            <div class="media-body">
                <h4 id="openModalName" class="media-heading"></h4>
                <h5 id="openModalTitle"></h5>
            </div>
        </div>
@endsection



@section('name-of-add-modal', 'Добавить награду')

@section('body-of-add-modal')
    <form onsubmit="add_item('awards')" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);" >
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



@section('name-of-edit-modal', 'Изменить статус пользоватея')

@section('body-of-edit-modal')
    <form onsubmit="update_item()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
        {{ csrf_field() }}

        <input type="hidden" name="title_upd" value="">
        <textarea style="display:none;" name="text_upd"></textarea>
        <input style="display:none;" type="text" class="form-control" name="name_upd" value="" id="editModalName" placeholder="Название продукта">
        <input style="display:none;" type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
        <input style="display:none;" type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
        <input style="display:none;" type="number" class="form-control" name="count_upd" value="" id="editModalCount">
        <input style="display:none;" type="number" class="form-control" name="price_upd" value="" id="editModalPrice">

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalType">Полномочия</label>
                <select class="form-control" name="type_upd" id="editModalType">
                    @foreach($roles as $role)
                        <option id="editModalType{{ $role->id }}" value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
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