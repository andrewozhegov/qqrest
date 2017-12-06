@extends('layouts/main')

@section('page_name', 'Управление наградами')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/material-switch.css') }}" />
@endsection

@section('js')
    <script src="{{ asset("js/manage.js") }}"></script>
@endsection

@section('content')
    <div class="container">
        <section>
            <div class="row">

                @include('manage.includes.manage-nav')

                <div class="col-md-9 col-sm-8 col-md-push-0">

                    {{-- Секция с таблицей --}}

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
                                        <input type="checkbox" id="switch{{ $award->id }}" onclick="change_board('awards', {{ $award->id }})" @if (\App\AwardBoard::is_on_board($award)) checked="true" @endif/>
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

                    {{-- КОНЕЦ Секция с таблицей --}}

                </div>
            </div>
        </section>

        <div class="modal fade" id="openModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Просмотр награды</h4> {{-- Название модального открытия --}}

                    </div>
                    <div class="modal-body">

                        {{-- Тело модального открытия--}}

                        <div class="news">
                            <h3 id="openModalName"></h3>
                            <img id="openModalImage" src="" alt="" />
                            <h6 id="openModalDate" class="text-right"></h6>
                        </div>

                        {{-- КОНЕЦ Тело модальноо открытия --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Добавить награду:</h4> {{-- Название модального добавления --}}

                    </div>
                    <div class="modal-body">

                        {{-- Тело модального добавления --}}

                        <form onsubmit="add_item()" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_item" action="javascript:void(null);" >
                            {{ csrf_field() }}
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
                        </form>

                        {{-- КОНЕЦ Тело модального добавления --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Изменить награду</h4>    {{-- Название модального изменения --}}

                    </div>
                    <div class="modal-body">

                        {{-- Тело модального изменения --}}

                        <form onsubmit="update_item()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_item" action="javascript:void(null);" >
                            {{-- форма добавления новой записи --}}
                            {{ csrf_field() }}
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
                        </form>

                        {{-- КОНЕЦ Тело модального изменения --}}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection