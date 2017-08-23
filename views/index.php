<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- pusher -->
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <!--  script  -->
    <script src="js/index.js"></script>
    <script src="js/users.js"></script>
    <script src="js/chat.js"></script>
    <!-- css -->
    <link href="css/index.css" rel="stylesheet" media="all">
    <link href="css/users.css" rel="stylesheet" media="all">
    <link href="css/chat.css" rel="stylesheet" media="all">
</head>

<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand navbar-brand-centered">Chat</div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
            <ul class="nav navbar-nav">
                <li><a href="#">Main</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-friend-list">
                <li><a href="#">Friends <span id="friend-list-count" class="badge"><?= $this->request['count'] ?></span></a>
                </li>
                <? if (isset($_SESSION['user'])) : ?>
                    <li id="user_id" data-id="<?= $_SESSION['id'] ?>"><a href=""><?= $_SESSION['user'] ?></a></li>
                    <li><a href="login/logout">Exit</a></li>
                <? else: ?>
                    <li><a href="login">Login</a></li>
                <? endif; ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container">
    <div class="row">
        <div class="col-sm-6 block-users">
            <div class="panel panel-default panel-users">
                <div class="panel-heading">
                    <h3 class="panel-title">Users List <span id="friend-list-count" class="badge pull-right""><?= count($this->usersList) ?></span></h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <table class="table-users table" border="0">
                            <tbody>
                            <?php foreach ($this->usersList as $user) { ?>
                                <tr>
                                    <td width="10">
                                        <img class="pull-left img-circle nav-user-photo" width="50"
                                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxhcCYW4QDWMOjOuUTxOd50KcJvK-rop9qE9zRltSbVS_bO-cfWA"/>
                                    </td>
                                    <td>
                                        <?= $user['name'] ?><br><i class="fa fa-envelope"></i>
                                    </td>
                                    <td align="center">
                                        <?php if ($_SESSION['user']) { ?>
                                            <small class="text-muted">
                                                <?php if (is_null($user['accepted'])): ?>
                                                <button type="button" class="btn btn-default btn-send-user-request"  data-user="<?= $user['id'] ?>">
                                                    <span class="glyphicon glyphicon-plus"></span></button>
                                                <? else: ?>
                                                    <button type="button" class="btn btn-default btn-send-user-request">
                                                        <span class="glyphicon glyphicon glyphicon-ok"></span>
                                                    </button>
                                                <? endif ?>
                                            </small>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 block-friends">
            <?php if ($_SESSION['user']) { ?>
                <div class="panel panel-default panel-friend">
                    <div class="panel-heading">
                        <h3 class="panel-title">Friends List <span id="friend-list-count" class="badge pull-right""><?= count($this->friendsList) ?></span></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-container">
                            <table class="table-friends table" border="0">
                                <tbody>
                                <?php foreach ($this->friendsList as $user) { ?>
                                    <tr>
                                        <td width="10">
                                            <img class="pull-left img-circle nav-user-photo" width="50"
                                                 src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxhcCYW4QDWMOjOuUTxOd50KcJvK-rop9qE9zRltSbVS_bO-cfWA"/>
                                        </td>
                                        <td>
                                            <?= $user['name'] ?><br><i class="fa fa-envelope"></i>
                                        </td>
                                        <td align="center">
                                            <small class="text-muted">Last
                                                Active: <?= date("m.d.y", strtotime($user['last_active'])) ?></small>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <button type="button" class="btn btn-warning btn-write-user-message"
                                                        data-user="<?= $user['id'] ?>">
                                                    <span class="glyphicon glyphicon-pencil"></span></button>
                                            </small>
                                        </td>
                                    </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</div>


<div class="chat_window hidden">
    <div class="top_menu">
        <div class="buttons">
            <div class="button close"></div>
            <div class="button minimize"></div>
            <div class="button maximize"></div>
        </div>
        <div class="title">Chat</div>
    </div>
    <ul class="messages"></ul>
    <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
            <input class="message_input" placeholder="Type your message here..."/>
        </div>
        <div class="send_message">
            <div class="icon"></div>
            <div class="text">Send</div>
        </div>
    </div>
</div>
<div class="message_template">
    <li class="message">
        <div class="avatar"></div>
        <div class="text_wrapper">
            <div class="text"></div>
        </div>
    </li>
</div>

</body>


<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('ecde41c460ac287cc3bc', {encrypted: true});
    var channel = pusher.subscribe('chat-channel');
    channel.bind('request-event', function (data) {
        if (data.user.id == $('#user_id').data('id')) {
            var tmp = $('#navbar-brand-centered span#friend-list-count');
            tmp.text(parseInt(tmp.html()) + 1);
        }
    });
</script>

</html>