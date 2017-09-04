<?php  require_once ('menu.php');  ?>


<div class="container">
    <div class="row">
        <?php  require_once ('users_list.php');  ?>
        <?php  require_once ('friends_list.php');  ?>
    </div>
</div>
    <?php  require_once ('dialog/chat.php');  ?>
    <?php  require_once ('dialog/model_user_remove.php');  ?>

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
            var obj = $('.panel-users .table-users .user-id-'+data.decline_id).find('span');
            obj.removeClass('glyphicon-ok');
            obj.addClass('glyphicon-plus');
        }
    });

    channel.bind('request-friend-remove', function (data) {
        if (data.user.id != $('#user_id').data('id')) {
            $('.panel-friend .table-friends .user-id-' + data.user.id).remove();
            var new_user = renderTemplate('new-user-item', {id: data.user.id, name: data.user.name});
            $('.panel-users .table-users tbody').append(new_user);
        }
    });

</script>

