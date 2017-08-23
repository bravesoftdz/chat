$(function () {

    $('.btn-send-user-request').click(function (e) {
        var userId = $(this).data('user');
        var btn = $(this);
        $.ajax({
            url: "index/request",
            cache: false,
            type: "POST",
            data: {id: userId},
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                if (obj.success) {
                    $(btn).removeClass('btn-send-user-request');
                    var span = $(btn).find('span');
                    span.removeClass('glyphicon-plus');
                    span.addClass('glyphicon glyphicon-ok');
                }
            }
        });
        e.preventDefault();
    });
});
