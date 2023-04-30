
$(document).ready(function() {
    $('form').submit(function(event) {
        var json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                json = jQuery.parseJSON(result);
                if (json.url) {
                    window.location.href = '/' + json.url;
                } else {
                    swal(json.title, json.message, json.status);
                }
            },
        });
    });
});



$(document).ready(function() {
    $('#form').submit(function(event) {
        var json;
        event.preventDefault();
        var formData = new FormData(this);
        var contenteditable = $('.editor').html();
        formData.append('text', contenteditable);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                json = jQuery.parseJSON(result);
                if (json.url) {
                    window.location.href = '/' + json.url;
                } else {
                    swal(json.title, json.message, json.status);
                }
            },
        });
    });
});