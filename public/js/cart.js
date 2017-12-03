$(function() {
    $('.button-to-cart').on('click', function() {
        var $product = $(this);
        $.ajax({
            url: 'cart',
            type: "POST",
            data: {
                product_id: $product.attr('data-to-cart'),
                count: $product.attr('data-count-of')
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function ($resp) {
                $('#cart').html($resp['count_all']);
                var $class = '.prod' + $resp['product_id'];
                $($class).html($resp['count']);
                $('#res').html($resp['cart_count']);
            },
            error: function () {
                alert('Не удалось добавить товар в корзину!');
            }
        });
    });
});