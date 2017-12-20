@extends('layouts/manage')

@section('page_name', 'Модерация отзывов')

@section('css')
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
    <script src="{{ asset("js/reviews.js") }}"></script>
    <script src="{{ asset("tinymce/tinymce.min.js") }}"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            height: 500,
            plugins: 'image link save'
        });
    </script>
@endsection



@section('table-items')
    <h2>Отзывы:</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Дата</th>
            <th>Автор</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody id="items_table">
        @foreach($reviews as $review)
            <tr id="row{{ $review->id }}">
                <td class="rowDate">{{ $review->created_at }}</td>
                <td class="rowText">{{ $review->user->name }}</td>
                <td class="btn-group-xs">
                    <button class="btn btn-warning" onclick="edit_review({{ $review->id }})">Изменить</button>
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
    <form onsubmit="add_item('')" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
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



@section('name-of-edit-modal', 'Редактировать отзыв')

@section('body-of-edit-modal')
    <form onsubmit="update_review()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
        {{ csrf_field() }}

        <input type="hidden" name="title_upd" value="">
        <input type="text" class="form-control hidden" name="name_upd" value="" id="editModalName" placeholder="Название продукта">
        <input class="hidden" type="file" accept=".png,.jpeg,.jpg" name="photo" id="form_photo">
        <input class="hidden" type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
        <select class="form-control hidden" name="type_upd" id="editModalType"></select>
        <input type="number" class="form-control hidden" name="count_upd" value="" id="editModalCount">
        <input type="number" class="form-control hidden" name="price_upd" value="" id="editModalPrice">

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