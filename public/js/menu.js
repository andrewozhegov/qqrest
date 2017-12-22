function sample(name) {
    var value = name.toLowerCase();
    $("#myDIV div").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
}

$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myDIV div").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

function add_to_search(name) {
    $("#myInput").attr('value', name);
    sample(name);
}