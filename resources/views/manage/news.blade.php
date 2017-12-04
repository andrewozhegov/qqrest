@extends('layouts/main')

@section('page_name', 'Управление новостями')

@section('css')
@endsection

@section('js')
    <script type="text/javascript">
        function show_news(id) {
            var path = 'news/' + id;
            $.ajax({
                url: path,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function($news) {
                    $('#openModalTitle').html($news['title']);
                    $('#openModalImage').attr('src', $news['image']);
                    $('#openModalText').html($news['text']);
                    $('#openModalDate').html($news['updated_at']);

                    $('#openModal').modal();

                },
                error: function(req, text, error){
                    console.error('Упс! Ошибочка: ' + text + ' | ' + error);
                }
            });
        }

        function add_news() {
            var form_data = new FormData();

            form_data.append('title', $('input[name=title]')[0].value);
            form_data.append('photo', $('input[type=file]')[0].files[0]);
            form_data.append('text',  $('textarea[name=text]')[0].value);

            $.ajax({
                url: 'news',
                type: "POST",
                data: form_data,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function ($new) {
                    var html = '<tr id="row' + $new['id'] + '">\n' +
                        '           <td>' + $new['created_at'] + '</td>\n' +
                        '           <td>' + $new['title'] + '</td>\n' +
                        '           <td class="btn-group-xs">\n' +
                        '               <button class="btn btn-info" onclick="show_news(' + $new['id'] + ')">Открыть</button>\n' +
                        '               <button class="btn btn-warning" onclick="edit_news(' + $new['id'] + ')">Изменить</button>\n' +
                        '               <button class="btn btn-danger" onclick="delete_news(' + $new['id'] + ')">Удалить</button>\n' +
                        '           </td>\n' +
                        '       </tr>';
                    $("#news_table").append(html);
                    $('#form_add_news')[0].reset();
                    $('.close').click();

                },
                error: function(req, text, error){
                    console.error('Упс! Ошибочка: ' + text + ' | ' + error);
                },
                contentType: false, // важно - убираем форматирование данных по умолчанию
                processData: false // важно - убираем преобразование строк по умолчанию
            });
        }

        function edit_news(id) {
            var path = 'news/' + id + '/edit';
            $.ajax({
                url: path,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function($news) {
                    $('#editModalTitle').attr('value', $news['title']);
                    $('#editModalImage').attr('src', $news['image']);
                    $('#editModalText').html($news['text']);
                    $('#form_edit_news').attr('onsubmit', 'update_news(' + $news['id'] + ')');

                    $('#editModal').modal();

                },
                error: function(req, text, error){
                    console.error('Упс! Ошибочка: ' + text + ' | ' + error);
                }
            });
        }

        function update_news(id) {
            var path = 'news/' + id;
            var form_data = new FormData();

            form_data.append("_method", "PUT");
            form_data.append('title', $('input[name=title_upd]')[0].value);
            form_data.append('photo', $('input[type=file]')[1].files[0]);
            form_data.append('text',  $('textarea[name=text_upd]')[0].value);

            $.ajax({
                url: path,
                type: "POST",
                data: form_data,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function ($new) {
                    console.log($new);
                    var row = 'row' + $new['id'];

                    $("#" + row + " .rowDate").html($new['updated_at']);
                    $("#" + row + " .rowTitle").html($new['title']);

                    $('.close').click();
                },
                error: function(req, text, error) {
                    console.error('Упс! Ошибочка: ' + text + ' | ' + error);
                },
                contentType: false, // важно - убираем форматирование данных по умолчанию
                processData: false // важно - убираем преобразование строк по умолчанию
            });
        }

        function delete_news(id) {
            var path = 'news/' + id;
            $.ajax({
                url: path,
                type: 'DELETE',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    var row_to_delele = '#row' + id;
                    $(row_to_delele).remove();
                },
                error: function(req, text, error){
                    console.error('Упс! Ошибочка: ' + text + ' | ' + error);
                }
            });
        }

    </script>
@endsection

@section('content')
    <div class="container">
        <section>
            <div class="row">

                @include('manage.includes.manage-nav')

                <div class="col-md-9 col-sm-8 col-md-push-0">
                    <button data-toggle="modal" data-target="#addModal" class="btn btn-warring">Добавить новость</button>
                    <h2>Список новостей:</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Заголовок</th>
                        </tr>
                        </thead>
                        <tbody id="news_table">
                            @foreach($news as $new)
                                <tr id="row{{ $new->id }}">
                                    <td class="rowDate">{{ $new->updated_at }}</td>
                                    <td class="rowTitle">{{ $new->title }}</td>
                                    <td class="btn-group-xs">
                                        <button class="btn btn-info" onclick="show_news({{ $new->id }})">Открыть</button>

                                        <button class="btn btn-warning" onclick="edit_news({{ $new->id }})">Изменить</button>

                                        <button class="btn btn-danger" onclick="delete_news({{ $new->id }})">Удалить</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <div class="modal fade" id="openModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Просмотр новости</h4>
                    </div>
                    <div class="modal-body">
                        <div class="news">
                            <h3 id="openModalTitle"></h3>
                            <img id="openModalImage" src="" alt="" />
                            <p id="openModalText"></p>
                            <h6 id="openModalDate" class="text-right"></h6>
                        </div>
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
                        <h4 class="modal-title">Добавить новость</h4>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="add_news()" enctype="multipart/form-data" class="form-horizontal" method="post" id="form_add_news" action="javascript:void(null);" >
                            {{-- форма добавления новой записи --}}
                            {{ csrf_field() }}
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
                                    <input id="submit" class="form-control btn btn-block btn-primary btn-add-news"  type="submit" value="Отправить">
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control btn btn-block btn-default" type="reset" value="Очистить">
                                </div>
                            </div>

                        </form>
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
                        <h4 class="modal-title">Изменить новость</h4>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="update_news()" enctype="multipart/form-data" class="form-horizontal" method="put" id="form_edit_news" action="javascript:void(null);" >
                            {{-- форма добавления новой записи --}}
                            {{ csrf_field() }}
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
                                    <input id="submit" class="form-control btn btn-block btn-primary btn-add-news"  type="submit" value="Отправить">
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control btn btn-block btn-default" type="reset" value="Очистить">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection