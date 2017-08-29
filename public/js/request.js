clickDecline = function (e) {
    var userId = $(this).data('user');
    $.ajax({
        url: "request/decline",
        cache: false,
        type: "POST",
        data: {id: userId},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('.request-id-' + userId).remove();
                var tmp = $('#request-list-count');
                tmp.text(parseInt(tmp.html()) - 1);
            }
        }
    });
    e.preventDefault();
};

clickAddFriend = function (e) {
    var userId = $(this).data('user');
    $.ajax({
        url: "request/accept",
        cache: false,
        type: "POST",
        data: {id: userId},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('.request-id-' + userId).remove();
                var tmp = $('#request-list-count');
                tmp.text(parseInt(tmp.html()) - 1);
            }
        }
    });
    e.preventDefault();
};

clickSendRequest = function (e) {
    var userId = $(this).data('user');
    var btn = $(this);
    $.ajax({
        url: "request/add",
        cache: false,
        type: "POST",
        data: {id: userId},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $(btn).removeClass('btn-send-user-request');
                var span = $(btn).find('span');
                span.removeClass('glyphicon-plus');
                span.addClass('glyphicon glyphicon-ok');
            }
        }
    });
    e.preventDefault();
};


$(function () {
    $('.table-request .btn-decline-user').click(clickDecline);
    $('.table-request .btn-add-user-to-friends').click(clickAddFriend);
});
