<?php require_once('menu.php'); ?>


<div class="container">
    <div class="row">
        <?php require_once('users_list.php'); ?>
        <?php require_once('friends_list.php'); ?>
    </div>
</div>
<?php require_once('dialog/chat.php'); ?>
<?php require_once('dialog/model_user_remove.php'); ?>

<script src="/js/main-event.js"></script>