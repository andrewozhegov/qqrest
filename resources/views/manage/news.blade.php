@extends('layouts/main')

@section('page_name', 'Управление новостями')

@section('css')
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $('.button-open').on('click', function() {
                var $title = $(this).attr('new-title');
                var $img = $(this).attr('new-img');
                var $text = $(this).attr('new-text');
                var $date = $(this).attr('new-data');

                $('#openModalTitle').html($title);
                $('#openModalImage').attr('src', $img);
                $('#openModalText').html($text);
                $('#openModalDate').html($date);

                $('#openModal').modal();
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <section>
            <div class="row">
                <div class="col-md-3 col-sm-4 col-md-push-0">
                    <div class="panel panel-default">
                        <!-- Обычное содержимое панели -->
                        <div class="panel-heading">Управление</div>
                        <div class="list-group">
                            <a href="#" class="list-group-item">Новости <span class="badge"></span></a>
                            <a href="#" class="list-group-item">Награды <span class="badge"></span></a>
                            <a href="#" class="list-group-item">Отзывы <span class="badge">1</span></a>

                            <a href="#" class="list-group-item">Товары <span class="badge"></span></a>
                            <a href="#" class="list-group-item">Заказы <span class="badge">1</span></a>
                            <a href="#" class="list-group-item">Бронирование <span class="badge">1</span></a>
                            <a href="#" class="list-group-item">Мероприятия <span class="badge">1</span></a>

                            <a href="#" class="list-group-item">Филлиалы <span class="badge"></span></a>
                            <a href="#" class="list-group-item">Персонал <span class="badge"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-md-push-0">
                    <button class="btn btn-warring">Добавить новость</button>
                    <h2>Список новостей:</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Заголовок</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $new)
                                <tr>
                                    <td>{{ $new->updated_at }}</td>
                                    <td>{{ $new->title }}</td>
                                    <td class="btn-group-xs">
                                        <button type="button" class="btn btn-info button-open" new-title="{{ $new->title }}" new-img="{{ asset($new->image()) }}" new-text="{{ $new->text }}" new-data="{{ $new->updated_at }}">Открыть</button>

                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal" data-backdrop="{{ $new->id }}">Изменить</button>
                                        <button class="btn btn-danger">Удалить</button>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection