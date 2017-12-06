@extends('layouts/manage')

@section('page_name', 'Модерация отзывов')

@section('css')
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
    <h2>Отзывы:</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Дата</th>
            <th>Текст</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($reviews as $review)
            <tr id="row{{ $review->id }}">
                <td class="rowDate">{{ $review->created_at }}</td>
                <td class="rowText">{{ $review->text }}</td>
                <td class="btn-group-xs">
                    {{--<button class="btn btn-success" onclick="edit_item('reviews', {{ $review->id }})">Одобрить</button>--}}
                    <button class="btn btn-warning" onclick="edit_item('reviews', {{ $review->id }})">Изменить</button>
                    <button class="btn btn-danger" onclick="delete_item('reviews', {{ $review->id }})">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



@section('name-of-open-modal', '')

@section('body-of-open-modal')
    <div class="news">
        <h3 id="openModalTitle"></h3>
        <img id="openModalImage" src="" alt="" />
        <p id="openModalText"></p>
        <h6 id="openModalDate" class="text-right"></h6>
    </div>
@endsection



@section('name-of-add-modal', '')

@section('body-of-add-modal')
    <form onsubmit="add_item('news')" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
        {{ csrf_field() }}

        <input type="hidden" name="name" value="">
        <input type="text" class="form-control" name="title" value="" id="form_topic" placeholder="Тема сообщения">
        <input type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
        <textarea class="form-control" name="text" id="form_message" rows="3" placeholder="Сообщение"></textarea>

    </form>
@endsection



@section('name-of-edit-modal', 'Редактировать отзыв')

@section('body-of-edit-modal')
    <form onsubmit="update_item()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
        {{ csrf_field() }}

        <input type="hidden" name="title_upd" value="">
        <input type="hidden" name="name_upd" value="">
        <input type="file" name="photo" value="" style="display:none;">

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