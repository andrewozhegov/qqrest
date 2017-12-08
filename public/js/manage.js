function show_item(page, id) {
    var path = page + '/' + id;
    $.ajax({
        url: path,
        type: 'GET',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function($response) {
            $('#openModalName').html($response['name']); // AWARDS PRODUCTS BRANCHES
            $('#openModalTitle').html($response['title']); // NEWS BRANCHES(address)
            $('#openModalType').html($response['type']); // PRODUCTS
            $('#openModalPrice').html($response['price']); // PRODUCTS ORDERS
            $('#openModalImage').attr('src', $response['image']); // NEWS AWARDS PRODUCTS BRANCHES
            $('#openModalImage1').attr('src', $response['image1']); // PRODUCTS BRANCHES
            $('#openModalText').html($response['text']); // NEWS
            $('#openModalDate').html($response['updated_at']);// NEWS AWARDS
            $('#openModalTable').html($response['check']); // ORDERS

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
    form_data.append('name', $('input[name=name]')[0].value); // AWARDS PRODUCT BRANCHES
    form_data.append('title', $('input[name=title]')[0].value); // NEWS BRANCHES(address)
    form_data.append('photo', $('input[type=file]')[0].files[0]); // NEWS AWARDS PRODUCT BRANCHES
    form_data.append('photo1', $('input[type=file]')[1].files[0]); // PRODUCT BRANCHES
    form_data.append('text',  $('textarea[name=text]')[0].value); // NEWS
    form_data.append('type',  $('select[name=type]')[0].value); // PRODUCT
    form_data.append('count',  $('input[name=count]')[0].value); // PRODUCT
    form_data.append('price',  $('input[name=price]')[0].value); // PRODUCT

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
                case 'menu': {
                    html = '<tr id="row' + $response['id'] + '">\n' +
                        '                <td class="rowName">' + $response['name'] + '</td>\n' +
                        '                <td class="rowCount">' + $response['count'] + '</td>\n' +
                        '                <td>\n' +
                        '                    <div class="material-switch pull-left">\n' +
                        '                        <input type="checkbox" id="switch' + $response['id'] + '" onclick="change_board(\'' + page + '\', ' + $response['id'] + ')"/>' +
                        '                        <label for="switch' + $response['id'] + '" class="label-success"></label>\n' +
                        '                    </div>\n' +
                        '                </td>\n' +
                        '                <td class="btn-group-xs">\n' +
                        '                    <button class="btn btn-info" onclick="show_item(\'' + page + '\', ' + $response['id'] + ')">Открыть</button>\n' +
                        '                    <button class="btn btn-warning" onclick="edit_item(\'' + page + '\', ' + $response['id'] + ')">Изменить</button>\n' +
                        '                    <button class="btn btn-danger" onclick="delete_item(\'' + page + '\', ' + $response['id'] + ')">Удалить</button>\n' +
                        '                </td>\n' +
                        '            </tr>'
                }
                case 'branches': {
                    html = '<tr id="row' + $response['id'] + '">\n' +
                        '                <td class="rowName">' + $response['name'] + '</td>\n' +
                        '                <td class="rowTitle">' + $response['address'] + '</td>\n' +
                        '                <td>\n' +
                        '                    <div class="material-switch pull-left">\n' +
                        '                        <input type="checkbox" id="switch' + $response['id'] + '" onclick="change_board(\'' + page + '\', ' + $response['id'] + ')"/>\n' +
                        '                        <label for="switch{{ $branch->id }}" class="label-success"></label>\n' +
                        '                    </div>\n' +
                        '                </td>\n' +
                        '                <td class="btn-group-xs">\n' +
                        '                    <button class="btn btn-info" onclick="show_item(\'' + page + '\', ' + $response['id'] + ')">Открыть</button>\n' +
                        '                    <button class="btn btn-warning" onclick="edit_item(\'' + page + '\', ' + $response['id'] + ')">Изменить</button>\n' +
                        '                    <button class="btn btn-danger" onclick="delete_item(\'' + page + '\', ' + $response['id'] + ')">Удалить</button>\n' +
                        '                </td>\n' +
                        '            </tr>';
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
            $('#editModalName').attr('value', $response['name']); // AWARD PRODUCTS
            $('#editModalTitle').attr('value', $response['title']); // NEWS
            $('#editModalImage').attr('src', $response['image']); // NEWS AWARD PRODUCTS
            $('#editModalImage1').attr('src', $response['image1']); // PRODUCTS
            $('#editModalText').html($response['text']); // NEWS REVIEWS
            $('#editModalType' + $response['type']).attr('selected', ''); // PRODUCTS
            $('#editModalCount').attr('value', $response['count']); // PRODUCTS
            $('#editModalPrice').attr('value', $response['price']); // PRODUCTS

            $('#form_edit_item').attr('onsubmit', 'update_item(\'' + page + '\', ' + $response['id'] + ')'); // NEWS AWARD REVIEWS PRODUCTS

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
    form_data.append('name', $('input[name=name_upd]')[0].value); // AWARD PRODUCTS BRANCHES
    form_data.append('title', $('input[name=title_upd]')[0].value); // NEWS BRANCHES(address)
    form_data.append('photo', $('input[type=file]')[2].files[0]); // NEWS AWARD PRODUCTS BRANCHES
    form_data.append('photo1', $('input[type=file]')[3].files[0]); // PRODUCTS BRANCHES
    form_data.append('text',  $('textarea[name=text_upd]')[0].value); // NEWS REVIEWS
    form_data.append('type',  $('select[name=type_upd]')[0].value); // PRODUCTS
    form_data.append('count', $('input[name=count_upd]')[0].value); // PRODUCTS
    form_data.append('price', $('input[name=price_upd]')[0].value); // PRODUCTS

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

            $("#" + row + " .rowName").html($response['name']); // AWARD PRODUCTS
            $("#" + row + " .rowDate").html($response['updated_at']); // NEWS AWARD REVIEWS
            $("#" + row + " .rowTitle").html($response['title']); // NEWS
            $("#" + row + " .rowText").html($response['text']); // NEWS
            $("#" + row + " .rowCount").html($response['count']); // PRODUCTS

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

function done_item(page, id) {
    var path = page + '/' + id;

    var form_data = new FormData();
    form_data.append("_method", "PUT");

    $.ajax({
        url: path,
        type: "POST",
        data: form_data,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function ($id) {
            console.log($id);
            var row = 'row' + $id;
            $("#" + row + " .rowDone").html('<span class="glyphicon glyphicon-ok"></span>');
        },
        error: function(req, text, error) {
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        },
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false // важно - убираем преобразование строк по умолчанию
    });
}