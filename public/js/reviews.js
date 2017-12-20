function add_review() {
    if (tinymce.activeEditor === null) { // выход, если нет текущего активного редактора
        return;
    }
    tinyMCE.triggerSave();
    var text = unescape(encodeURI(tinyMCE.activeEditor.getContent())); // получение значения ТЕКСТ текущего открытого редактора
    //tinymce.activeEditor = null; // сброс указателя на текущий активный редактор (чтоб не было багов с focus())

    var form_data = new FormData();
    form_data.append('comment', text); // NEWS REVIEWS

    console.log(text);

    $.ajax({
        url: 'about',
        type: "POST",
        data: form_data,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function($response) {
            alert($response);
            var html = '<div class="media">\n' +
                '                        <div class="media-left">\n' +
                '                            <img src="' + $response['user_image'] + '" class="img-circle media-object" alt="" style="width:60px">\n' +
                '                        </div>\n' +
                '                        <div class="media-body">\n' +
                '                            <h4 class="media-heading">' + $response['user_name'] + '</h4>\n' +
                '                            <p>' + $response['review_text'] + '</p>\n' +
                '                            <h6>' + $response['review_created_at'] + '</h6>\n' +
                '                        </div>\n' +
                '                    </div>';

            $("#reviews_block").append(html);
            $('#form_add_item')[0].reset();
            $('.close').click();
        },
        error: function(req, text, error) {
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        },
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false // важно - убираем преобразование строк по умолчанию
    });
}

function edit_review(id) {
    var path = 'reviews/' + id + '/edit';
    $.ajax({
        url: path,
        type: 'GET',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function($response) {
            tinyMCE.activeEditor.setContent(unescape($response['text']));

            $('#form_edit_item').attr('onsubmit', 'update_review(' + $response['id'] + ')'); // NEWS AWARD REVIEWS PRODUCTS

            $('#editModal').modal();
        },
        error: function(req, text, error) {
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        }
    });
}

function update_review(id) {
    if (tinymce.activeEditor === null) { // выход, если нет текущего активного редактора
        return;
    }
    tinyMCE.triggerSave();

    var text = unescape(encodeURI(tinyMCE.activeEditor.getContent())); // получение значения ТЕКСТ текущего открытого редактора
    //tinymce.activeEditor = null; // сброс указателя на текущий активный редактор (чтоб не было багов с focus())
    var path = 'reviews/' + id;

    var form_data = new FormData();
    form_data.append("_method", "PUT");
    form_data.append('text',  text); // NEWS REVIEWS

    $.ajax({
        url: path,
        type: "POST",
        data: form_data,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function ($response) {
            console.log($response);
            var row = 'row' + $response['id'];

            $("#" + row + " .rowDate").html($response['updated_at']);
            $("#" + row + " .rowText").html(unescape($response['text']));

            $('.close').click();
        },
        error: function(req, text, error) {
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        },
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false // важно - убираем преобразование строк по умолчанию
    });
}