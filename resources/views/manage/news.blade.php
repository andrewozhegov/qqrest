@extends('layouts/manage')

@section('page_name', 'Управление новостями')

@section('css')
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
    <button data-toggle="modal" data-target="#addModal" class="btn btn-warring">Добавить новость</button>
    <h2>Список новостей:</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Дата</th>
            <th>Заголовок</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($news as $new)
            <tr id="row{{ $new->id }}">
                <td class="rowDate">{{ $new->updated_at }}</td>
                <td class="rowTitle">{{ $new->title }}</td>
                <td class="btn-group-xs">
                    <button class="btn btn-info" onclick="show_item('news', {{ $new->id }})">Открыть</button>
                    <button class="btn btn-warning" onclick="edit_item('news', {{ $new->id }})">Изменить</button>
                    <button class="btn btn-danger" onclick="delete_item('news', {{ $new->id }})">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



@section('name-of-open-modal', 'Просмотр новости')

@section('body-of-open-modal')
    <div class="news">
        <h3 id="openModalTitle"></h3>
        <img id="openModalImage" src="" alt="" />
        <p id="openModalText"></p>
        <h6 id="openModalDate" class="text-right"></h6>
    </div>
@endsection



@section('name-of-add-modal', 'Добавить новость')

@section('body-of-add-modal')
    <form onsubmit="add_item('news')" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
        {{ csrf_field() }}

        <input type="hidden" name="name" value="">

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_topic">Тема сообщения</label>
                <input type="text" class="form-control" name="title" value="" id="form_topic" placeholder="Тема сообщения">
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
                <label for="form_message">Сообщение</label>
                <textarea class="form-control" name="text" id="form_message" rows="3"
                          placeholder="Сообщение"></textarea>
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

        <input type="hidden" name="name_upd" value="">

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalTitle">Тема сообщения</label>
                <input id="editModalTitle" type="text" class="form-control" name="title_upd" value="" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalImage">Фотография</label>
                <img id="editModalImage" src="" alt="" style="max-width:100%; margin-bottom:7px;">
                <input id="editModalImageNew" type="file" accept=".png,.jpeg,.jpg" name="photo">
            </div>
        </div>
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
@endsection