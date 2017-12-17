@extends('layouts/manage')

@section('page_name', 'Управление наградами')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/material-switch.css') }}" />
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection



@section('table-items')
     <button data-toggle="modal" data-target="#addModal" class="btn btn-warring">Добавить награду</button>
     <h2>Список наград:</h2>
     <table class="table">
         <thead>
         <tr>
             <th>Дата</th>
             <th>Название</th>
             <th>Отобразить</th>
             <th>Управление</th>
         </tr>
         </thead>
         <tbody id="items_table">
         @foreach($awards as $award)
             <tr id="row{{ $award->id }}">
                 <td class="rowDate">{{ $award->created_at }}</td>
                 <td class="rowName">{{ $award->name }}</td>
                 <td>
                     <div class="material-switch pull-left">
                         <input type="checkbox" id="switch{{ $award->id }}" onclick="change_board('awardboard', {{ $award->id }})" @if (\App\AwardBoard::is_on_board($award)) checked="true" @endif/>
                         <label for="switch{{ $award->id }}" class="label-success"></label>
                     </div>
                 </td>
                 <td class="btn-group-xs">
                     <button class="btn btn-info" onclick="show_item('awards', {{ $award->id }})">Открыть</button>
                     <button class="btn btn-warning" onclick="edit_item('awards', {{ $award->id }})">Изменить</button>
                     <button class="btn btn-danger" onclick="delete_item('awards', {{ $award->id }})">Удалить</button>
                 </td>
             </tr>
         @endforeach
         </tbody>
     </table>
@endsection



@section('name-of-open-modal', 'Просмотр награды')

@section('body-of-open-modal')
    <div class="news">
        <h3 id="openModalName"></h3>
        <img id="openModalImage" src="" alt="" />
        <h6 id="openModalDate" class="text-right"></h6>
    </div>
@endsection



@section('name-of-add-modal', 'Добавить награду')

@section('body-of-add-modal')
    <form onsubmit="add_item('awards')" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);" >
        {{ csrf_field() }}

        <!-- ПУСТЫЕ ПОЛЯ -->
        <input type="hidden" name="title" value="">
        <textarea style="display:none;" name="text"></textarea>
        <select class="form-control hidden" name="type" id="form_select"></select>
        <input type="number" class="form-control hidden" name="count" value="" id="form_topic" placeholder="">
        <input type="number" class="form-control hidden" name="price" value="" id="form_num1" placeholder="">
        <!-- -->

        <div class="form-group">
            <div class="col-md-12">
                <label for="form_topic">Название награды</label>
                <input type="text" class="form-control" name="name" value="" id="form_topic" placeholder="Название награды">
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
            <div class="col-md-8">
                <input id="submit" class="form-control btn btn-block btn-primary"  type="submit" value="Отправить">
            </div>
            <div class="col-md-4">
                <input class="form-control btn btn-block btn-default" type="reset" value="Очистить">
            </div>
        </div>

            <!-- ПУСТЫЕ ПОЛЯ -->
            <input class="hidden" type="file" accept=".png,.jpeg,.jpg" name="photo1" id="form_photo1">
            <!-- -->

    </form>
@endsection



@section('name-of-edit-modal', 'Изменить награду')

@section('body-of-edit-modal')
    <form onsubmit="update_item()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
        {{-- форма добавления новой записи --}}
        {{ csrf_field() }}

        <!-- ПУСТЫЕ ПОЛЯ -->
        <input type="hidden" name="title_upd" value=""/>
        <textarea style="display:none;" name="text_upd"></textarea>
        <select class="form-control hidden" name="type_upd" id="form_select"></select>
        <input type="number" class="form-control hidden" name="count_upd" value="" id="form_topic" placeholder="" />
        <input type="number" class="form-control hidden" name="price_upd" value="" id="form_num1" placeholder="" />
        <!-- -->

        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalName">Название</label>
                <br />
                <input id="editModalName" type="text" class="form-control" name="name_upd" value="" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label for="editModalImage">Изображение</label>
                <img id="editModalImage" src="" alt="" style="max-width:100%; margin-bottom:7px;">
                <input id="editModalImageNew" type="file" accept=".png,.jpeg,.jpg" name="photo">
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

            <!-- ПУСТЫЕ ПОЛЯ -->
            <input class="hidden" id="editModalImageNew" type="file" accept=".png,.jpeg,.jpg" name="photo1" />
            <!-- ПУСТЫЕ ПОЛЯ -->

    </form>
@endsection