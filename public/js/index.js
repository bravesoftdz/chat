clearStatus = function (e) {
    var status = $('#user_id .user-status-icon');
    status.removeClass('text-success');
    status.removeClass('text-warning');
    status.removeClass('text-danger');
};

setStatus = function (new_status) {
    var obj = $('#user_id .user-status-icon');
    switch (new_status) {
        case 1:
            obj.addClass('text-success');
            break;
        case 2:
            obj.addClass('text-warning');
            break;
        case 3:
            obj.addClass('text-danger');
            break;
    }
};

clickChangeStatus = function (e) {
    var statusId = $(this).data('id');
    clearStatus();
    $.ajax({
        url: "index/changeStatus",
        cache: false,
        type: "POST",
        data: {id: statusId},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                setStatus(statusId);
            }
        }
    });
    e.preventDefault();
};

clickDialogUserRemove = function () {
    var userId = $(this).data('user');
    $('.chat_window').addClass('hidden');
    $.ajax({
        url: "index/removeFriend",
        cache: false,
        type: "POST",
        data: {id: userId},
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                var friend_count = $('#friend-list-count');
                if (parseInt(friend_count.html()) > 0) {
                    friend_count.html(parseInt(friend_count.html() - 1));
                    $('.panel-friend .table-friends .user-id-' + userId).remove();
                }
            }
        }
    });
    var dialog = $('#modal-user-remove');
    dialog.modal('hide');
};

clickOpenDialogUserRemove = function () {
    var dialog = $('#modal-user-remove');
    dialog.find('.modal-footer .btn-remove').data('user', $(this).data('user'));
    dialog.find('.modal-body').html('Break ties with ' + $(this).data('name') + '?');
    dialog.modal('show');
};

$(function () {
    setStatus($('#user_id').data('status'));
    $('#modal-user-remove .btn-remove').click(clickDialogUserRemove);
    $('.btn-remove-user').click(clickOpenDialogUserRemove);
    $('#dropdown-status-menu li').click(clickChangeStatus);
});
