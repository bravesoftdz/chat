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
    var user = $(this).data('user');
    console.log(user);
    $.ajax({
        url: "request/accept",
        cache: false,
        type: "POST",
        data: {id: user.sender_id, name: user.name},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('.request-id-' + user.sender_id).remove();
                var tmp = $('#request-list-count');
                tmp.text(parseInt(tmp.html()) - 1);
            }
        }
    });
    e.preventDefault();
};

$(function () {
    $('.table-request .btn-decline-user').click(clickDecline);
    $('.table-request .btn-add-user-to-friends').click(clickAddFriend);
});
