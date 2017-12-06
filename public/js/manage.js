function show_item(page, id) {
    var path = page + '/' + id;
    $.ajax({
        url: path,
        type: 'GET',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function($response) {
            $('#openModalName').html($response['name']); // AWARDS
            $('#openModalTitle').html($response['title']); // NEWS
            $('#openModalImage').attr('src', $response['image']); // NEWS AWARDS
            $('#openModalText').html($response['text']); // NEWS
            $('#openModalDate').html($response['updated_at']);// NEWS AWARDS

            $('#openModal').modal();

        },
        error: function(req, text, error){
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        }
    });
}

function add_item(page) {
    var path = page;

    var form_data = new FormData();
    form_data.append('name', $('input[name=name]')[0].value); // AWARDS
    form_data.append('title', $('input[name=title]')[0].value); // NEWS
    form_data.append('photo', $('input[type=file]')[0].files[0]); // NEWS AWARDS
    form_data.append('text',  $('textarea[name=text]')[0].value); // NEWS

    $.ajax({
        url: path,
        type: "POST",
        data: form_data,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function ($response)
        {
            var html = '';
            switch (page)
            {
                case 'news': {
                    html = '<tr id="row' + $response['id'] + '">\n' +
                               '<td>' + $response['created_at'] + '</td>\n' +
                               '<td>' + $response['title'] + '</td>\n' +
                               '<td class="btn-group-xs">\n' +
                                   '<button class="btn btn-info" onclick="show_item(\'' + page + '\', ' + $response['id'] + ')">Открыть</button>\n' +
                                   '<button class="btn btn-warning" onclick="edit_item(\'' + page + '\', ' + $response['id'] + ')">Изменить</button>\n' +
                                   '<button class="btn btn-danger" onclick="delete_item(\'' + page + '\', ' + $response['id'] + ')">Удалить</button>\n' +
                               '</td>\n' +
                           '</tr>';
                    break;
                }
                case 'awards': {
                    html = '<tr id="row' + $response['id'] + '">\n' +
                               '<td class="rowDate">' + $response['created_at'] + '</td>\n' +
                               '<td class="rowTitle">' + $response['name'] + '</td>\n'+
                               '<td>\n' +
                                   '<div class="material-switch pull-left">\n'+
                                       '<input type="checkbox" id="switch' + $response['id'] + '" onclick="change_board(\'' + page + '\', ' + $response['id'] + ')" />\n' +
                                       '<label for="switch' + $response['id'] +'" class="label-success"></label>\n' +
                                   '</div>\n' +
                               '</td>\n' +
                               '<td class="btn-group-xs">\n' +
                                   '<button class="btn btn-info" onclick="show_item(\'' + page + '\', ' + $response['id'] + ')">Открыть</button>\n' +
                                   '<button class="btn btn-warning" onclick="edit_item(\'' + page + '\', ' + $response['id'] + ')">Изменить</button>\n' +
                                   '<button class="btn btn-danger" onclick="delete_item(\'' + page + '\', ' + $response['id'] + ')">Удалить</button>\n' +
                               '</td>\n' +
                           '</tr>\n';
                    break;
                }
            }

            $("#items_table").append(html);
            $('#form_add_item')[0].reset();
            $('.close').click();

        },
        error: function(req, text, error){
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        },
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false // важно - убираем преобразование строк по умолчанию
    });
}

function edit_item(page, id) {
    var path = page + '/' + id + '/edit';
    $.ajax({
        url: path,
        type: 'GET',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function($response) {
            $('#editModalName').attr('value', $response['name']); // AWARD
            $('#editModalTitle').attr('value', $response['title']); // NEWS
            $('#editModalImage').attr('src', $response['image']); // NEWS AWARD
            $('#editModalText').html($response['text']); // NEWS REVIEWS
            $('#form_edit_item').attr('onsubmit', 'update_item(\'' + page + '\', ' + $response['id'] + ')'); // NEWS AWARD REVIEWS

            $('#editModal').modal();
        },
        error: function(req, text, error) {
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        }
    });
}

function update_item(page, id) {
    var path = page + '/' + id;

    var form_data = new FormData();
    form_data.append("_method", "PUT");
    form_data.append('name', $('input[name=name_upd]')[0].value); // AWARD
    form_data.append('title', $('input[name=title_upd]')[0].value); // NEWS
    form_data.append('photo', $('input[type=file]')[1].files[0]); // NEWS AWARD
    form_data.append('text',  $('textarea[name=text_upd]')[0].value); // NEWS REVIEWS

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

            $("#" + row + " .rowName").html($response['name']); // AWARD
            $("#" + row + " .rowDate").html($response['updated_at']); // NEWS AWARD REVIEWS
            $("#" + row + " .rowTitle").html($response['title']); // NEWS
            $("#" + row + " .rowText").html($response['text']); // NEWS

            $('.close').click();
        },
        error: function(req, text, error) {
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        },
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false // важно - убираем преобразование строк по умолчанию
    });
}

function delete_item(page, id) {
    var path = page + '/' + id;
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

function change_board(page, id) {
    var path = page + '/' + id;

    var checkbox_id = '#switch' + id;
    var checkbox = document.querySelector(checkbox_id);

    var form_data = new FormData();
    var method;

    if(checkbox.checked) {
        method = 'POST';
        form_data.append("_method", "PUT");
    } else {
        method = 'DELETE';
        form_data.append("_method", "DELETE");
    }

    $.ajax({
        url: path,
        type: method,
        data: form_data,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() { },
        error: function(req, text, error) {
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        },
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false // важно - убираем преобразование строк по умолчанию
    });
}