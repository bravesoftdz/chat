<?php require_once('menu.php'); ?>


<div class="container">
    <div class="row">
        <?php require_once('users_list.php'); ?>
        <?php require_once('friends_list.php'); ?>
    </div>
</div>
<?php require_once('dialog/chat.php'); ?>
<?php require_once('dialog/model_user_remove.php'); ?>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('ecde41c460ac287cc3bc', {encrypted: true});
    var channel = pusher.subscribe('chat-channel');

    channel.bind('request-send-event', function (data) {
        if (data.user.id == $('#user_id').data('id')) {
            var tmp = $('#navbar-brand-centered span#request-count');
            var old_val = parseInt(tmp.html());
            old_val = isNaN(old_val) ? 0 : old_val;
            tmp.text(old_val + 1);
        }
    });

    channel.bind('request-decline-event', function (data) {
        if (data.user.id == $('#user_id').data('id')) {
            var obj = $('.panel-users .table-users .user-id-' + data.decline_id).find('span');
            obj.removeClass('glyphicon-ok');
            obj.addClass('glyphicon-plus');
        }
    });

    channel.bind('friend-remove-event', function (data) {
        if (data.user.id != $('#user_id').data('id')) {
            chat.messageDialog.close();
            chat.moveFriendToUserList(user);
            chat.decCounter($('#friend-list-count'));
            chat.incCounter($('#users-list-count'));
        }
    });

    channel.bind('friend-accept-event', function (data) {
        if (data.user.id != $('#user_id').data('id')) {
            chat.moveUserToFriendList(data.user);
            chat.incCounter($('#friend-list-count'));
            chat.decCounter($('#users-list-count'));
        }
    });

</script>

