$(document).ready(function(){
    var CSRF_TOKEN = $('input[name="_token"]').val();

    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token='+CSRF_TOKEN,
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='+CSRF_TOKEN
    };

    $('textarea').ckeditor(options);

    $('.admin-degree').on('change', function() {
        var degree_id = this.value;
        if(degree_id > 1) {
            $('.admin-sphere').css('display', 'block');
        } else{
            $('.admin-sphere').css('display', 'none');
        }
    });

    $('.admin-direction').on('change', function() {
        var direction_id = this.value;

        if(direction_id != '') {
            $.ajax({
                type: "POST",
                url: "/ajax/subdirection",
                dataType: "json",
                data: {_token: CSRF_TOKEN, 'direction_id': direction_id},
                success: function (data) {
                    $('#subdirection').css('display', 'block');
                    $(".subdirection option").remove();
                    $('.subdirection').append(data);
                },
                error: function () {
                    console.log('error!');
                }
            });
        } else{
            $('#subdirection').css('display', 'none');
        }
    });

    $(".university_find").autocomplete({
        source: function (request, response) {
            $.ajax({
                type: "POST",
                url: "/ajax/university",
                dataType: "json",
                data: {_token: CSRF_TOKEN, name: request.term},
                success: function (data) {
                    response(data);
                },
                error: function () {
                    $(".ui-autocomplete").css('display', 'none');
                    console.log('ERROR!!!')
                }
            });
        },
        select: function (event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
            $("#university_id").val(ui.item.value);
        }
    });

});
