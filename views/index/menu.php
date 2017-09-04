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
                <? if (!empty($this->session->get('id'))) : ?>
                    <li><a href="/request">Request <span id="request-count" class="badge"><?= $this->requestCount > 0 ? $this->requestCount : '' ?></span></a></li>

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