clickSendRequest = function(e) {
    var userId = $(this).data('user');
    var btn = $(this);
    $.ajax({
        url: "request/add",
        cache: false,
        type: "POST",
        data: {id: userId},
        dataType: 'json',
        success: function(data) {
            if(data.success) {
                $(btn).removeClass('btn-send-user-request');
                var span = $(btn).find('span');
                span.removeClass('glyphicon-plus');
                span.addClass('glyphicon glyphicon-ok');
            }
        }
    });
    e.preventDefault();
};

$(function() {
    $(document).on('click', '.btn-send-user-request', clickSendRequest);
});
