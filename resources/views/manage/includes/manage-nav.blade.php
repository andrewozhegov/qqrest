<div class="col-md-3 col-sm-4 col-md-push-0">
    <div class="panel panel-default">
        <div class="panel-heading">Управление</div>
        <div class="list-group">
            <a href="news" class="list-group-item">Новости</a>
            <a href="awards" class="list-group-item">Награды</a>
            <a href="reviews" class="list-group-item">Отзывы @if( $notifies['reviews'] > 0) <span class="badge">{{ $notifies['reviews'] }}</span> @endif </a>

            <a href="menu" class="list-group-item">Товары</a>
            <a href="orders" class="list-group-item">Заказы @if($notifies['orders'] > 0) <span class="badge">{{ $notifies['orders'] }}</span> @endif </a>
            <a href="reservations" class="list-group-item">Бронирование @if($notifies['reservations'] > 0) <span class="badge">{{ $notifies['reservations'] }}</span> @endif </a>
            <a href="events" class="list-group-item">Мероприятия @if($notifies['events'] > 0) <span class="badge">{{ $notifies['events'] }}</span> @endif </a>

            <a href="branches" class="list-group-item">Филлиалы</a>
            <a href="staff" class="list-group-item">Персонал</a>
        </div>
    </div>
</div>