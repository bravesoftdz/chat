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
                <li><a href="/">Main</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-friend-list">
                <li><a href="<?= $this->session->get('id') ? '/request' : '' ?>">Request <span id="request-count" class="badge"><?= $this->request['count'] > 0 ? $this->request['count'] : '' ?></span></a></li>
                <? if (!empty($this->session->get('user'))) : ?>
                    <li id="user_id" data-id="<?= $this->session->get('id') ?>" data-status="<?= $this->user['status_id'] ?>" style="top: 15px;">
                            <span class="dropdown-toggle" data-toggle="dropdown"><?= $this->session->get('user') ?>
                                <span class="user-status-icon glyphicon glyphicon-ok-sign"></span>
                            </span>
                        <ul class="dropdown-menu" id="dropdown-status-menu">
                            <li class="dropdown-header">Status</li>
                            <li data-id="1"><a href="#"><span class="glyphicon glyphicon-ok-sign text-success"></span> Online</a></li>
                            <li data-id="2"><a href="#"><span class="glyphicon glyphicon-ok-sign text-warning"></span> Went away</a></li>
                            <li data-id="3"><a href="#"><span class="glyphicon glyphicon-ok-sign text-danger"></span> Do not disturb</a></li>
                            <li class="divider"></li>
                            <li><a href="login/logout">Exit</a></li>
                        </ul>
                    </li>

                <? else: ?>
                    <li><a href="login">Login</a></li>
                <? endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container">
    <div class="row">
        <div class="col-sm-12 request-users">
            <div class="panel panel-default panel-request">
                <div class="panel-heading">
                    <h3 class="panel-title">Request List <span id="request-list-count" class="badge pull-right""><?= count($this->requestList) ?></span>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <table class="table-request table" border="0">
                            <tbody>
                            <?php foreach ($this->requestList as $user) { ?>
                                <tr class="request-id-<?= $user['sender_id'] ?>">
                                    <td width="10">
                                        <img class="pull-left img-circle nav-user-photo" width="50"
                                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxhcCYW4QDWMOjOuUTxOd50KcJvK-rop9qE9zRltSbVS_bO-cfWA"/>
                                    </td>
                                    <td>
                                        <?= $user['name'] ?><br><i class="fa fa-envelope"></i>
                                    </td>
                                    <td align="right">
                                        <small class="text-muted">
                                            <button type="button" class="btn btn-success btn-add-user-to-friends" data-user="<?= $user['sender_id'] ?>">
                                                <span class="glyphicon glyphicon-ok-circle"></span>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-decline-user" data-user="<?= $user['sender_id'] ?>">
                                                <span class="glyphicon glyphicon-remove-circle"></span>
                                            </button>
                                        </small>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <a href="/" type="button" class="btn btn-primary pull-right">❮ Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

            // refresh page or add new position
        }
    });
</script>
