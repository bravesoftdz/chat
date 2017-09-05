clickChangeStatus = function (e) {
    var statusId = $(this).data('id');
    chat.status.clear();
    $.ajax({
        url: "index/changeStatus",
        cache: false,
        type: "POST",
        data: {id: statusId},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                chat.status.set(statusId);
            }
        }
    });
};

clickDialogUserRemove = function () {
    var user = $(this).data('user');
    chat.messageDialog.close();
    $.ajax({
        url: "index/removeFriend",
        cache: false,
        type: "POST",
        data: {id: user.id, name: user.name},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                var friend_count = $('#friend-list-count');
                if (parseInt(friend_count.html()) > 0) {
                    chat.moveFriendToUserList(user);
                }
            }
        }
    });
    dialog.modal('hide');
};

clickOpenDialogUserRemove = function () {
    var user = $(this).data('user');
    dialog.find('.modal-footer .btn-remove').data('user', user);
    dialog.find('.modal-body').html('Break ties with ' + user.name + '?');
    dialog.modal('show');
};

$(function () {
    dialog = $('#modal-user-remove');
    chat.status.set($('#user_id').data('status'));
    $(document).on('click', '#modal-user-remove .btn-remove', clickDialogUserRemove);
    $(document).on('click', '.btn-remove-user', clickOpenDialogUserRemove);
    $('#dropdown-status-menu li').click(clickChangeStatus);
});
