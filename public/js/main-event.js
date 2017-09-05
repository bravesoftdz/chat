eventRequestSend = function (data) {
    if (data.user.id == $('#user_id').data('id')) {
        chat.incCounter($('#navbar-brand-centered span#request-count'));
    }
};

eventRequestDecline = function (data) {
    if (data.user.id == $('#user_id').data('id')) {
        var obj = $('.panel-users .table-users .user-id-' + data.decline_id);
        obj.addClass('btn-send-user-request');

        var span = obj.find('span');
        span.removeClass('glyphicon-ok');
        span.addClass('glyphicon-plus');
    }
};

eventFriendRemove = function (data) {
    // TODO:  != can be except wrong wiyj logic work
    if (data.user.id != $('#user_id').data('id')) {
        chat.messageDialog.close();
        chat.moveFriendToUserList(data.user);
    }
};

eventFriendAccept = function(data){
    // TODO:  != can be except wrong wiyj logic work
    if (data.user.id != $('#user_id').data('id')) {
        chat.moveUserToFriendList(data.user);
    }
};

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;
var pusher = new Pusher('ecde41c460ac287cc3bc', {encrypted: true});
var channel = pusher.subscribe('chat-channel');

channel.bind('request-send-event', eventRequestSend);
channel.bind('request-decline-event', eventRequestDecline);
channel.bind('friend-remove-event', eventFriendRemove);
channel.bind('friend-accept-event', eventFriendAccept);