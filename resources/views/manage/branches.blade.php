@extends('layouts/manage')

@section('page_name', 'Управление филиалами')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/material-switch.css') }}" />
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
    <button data-toggle="modal" data-target="#addModal" class="btn btn-warring">Добавить филиал</button>
    <h2>Список филиалов:</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Название</th>
            <th>Адрес</th>
            <th>Отобразить</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($branches as $branch)
            <tr id="row{{ $branch->id }}">
                <td class="rowName">{{ $branch->name }}</td>
                <td class="rowTitle">{{ $branch->address }}</td>
                <td>
                    <div class="material-switch pull-left">
                        <input type="checkbox" id="switch{{ $branch->id }}" onclick="change_board('branchboard', {{ $branch->id }})" @if (\App\BranchBoard::is_on_board($branch)) checked="true" @endif/>
                        <label for="switch{{ $branch->id }}" class="label-success"></label>
                    </div>
                </td>
                <td class="btn-group-xs">
                    <button class="btn btn-info" onclick="show_item('branches', {{ $branch->id }})">Открыть</button>
                    <button class="btn btn-warning" onclick="edit_item('branches', {{ $branch->id }})">Изменить</button>
                    <button class="btn btn-danger" onclick="delete_item('branches', {{ $branch->id }})">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



@section('name-of-open-modal', 'Просмотр филиала')

@section('body-of-open-modal')
    <div class="news">
        <h3 id="openModalName"></h3>
        <h3 id="openModalTitle"></h3>
        <img id="openModalImage" src="" alt="" />
        <label>Фото для выставки</label>
        <img id="openModalImage1" src="" alt="" />
    </div>
@endsection



@section('name-of-add-modal', 'Добавить филиал')

@section('body-of-add-modal')
    <form onsubmit="add_item('branches')" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);" >
        {{ csrf_field() }}

        <textarea style="display:none;" name="text"></textarea>
        <select style="display:none;" class="form-control" name="type" id="form_select"></select>
        <input style="display:none;" type="number" class="form-control" name="count" value="" id="form_topic" placeholder="">
        <input style="display:none;" type="number" class="form-control" name="price" value="" id="form_num1" placeholder="">

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_topic">Название</label>
                <input type="text" class="form-control" name="name" value="" id="form_topic" placeholder="Название">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label for="form_adr">Адрес</label>
                <input type="text" class="form-control" name="title" value="" id="form_adr" placeholder="Адрес">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label for="form_photo">Изображение</label>
                <img src="" alt="">
                <input type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label for="form_photo1">Изображение для выставки</label>
                <img src="" alt="">
                <input type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
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



@section('name-of-edit-modal', 'Изменить филиал')

@section('body-of-edit-modal')
    <form onsubmit="update_item()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
        {{ csrf_field() }}

        <textarea style="display:none;" name="text_upd"></textarea>
        <select style="display:none;" class="form-control" name="type_upd" id="editModalType"></select>
        <input style="display:none;" type="number" class="form-control" name="count_upd" value="" id="editModalCount">
        <input style="display:none;" type="number" class="form-control" name="price_upd" value="" id="editModalPrice">

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalName">Название</label>
                <br />
                <input id="editModalName" type="text" class="form-control" name="name_upd" value="" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalTitle">Адрес</label>
                <input type="text" class="form-control" name="title_upd" value="" id="editModalTitle" placeholder="Адрес">
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
            <div class="col-md-8">
                <input id="submit" class="form-control btn btn-block btn-primary"  type="submit" value="Отправить">
            </div>
            <div class="col-md-4">
                <input class="form-control btn btn-block btn-default" type="reset" value="Очистить">
            </div>
        </div>
    </form>
@endsection