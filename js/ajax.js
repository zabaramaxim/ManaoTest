
$(document).ready(function(){
    $("#form").submit(function(e) {
        e.preventDefault();
        var msg = $("#form").serialize();
        $('input').removeClass('is-invalid');
        $.ajax({
            type: "POST", //Метод отправки
            dataType: "json",
            data: msg,
            success: function(data, jqHXR) {
                // $("my_message").text(data);
                location.reload();
            },
            error: function(response, status, jqHXR){
                let errors = response.responseJSON;
                console.log(errors)
                if (errors.errors) {
                    errors.errors.forEach(function(data, index) {
                        var field = Object.getOwnPropertyNames (data);
                        var value = data[field];
                        var div = $("#"+field[0]).closest('div');
                        var input = $("#"+field[0]).closest('input');
                        input.addClass('is-invalid');
                        div.children('.invalid-feedback').text(value);
                    });
                }
            }
        });
    });
});


