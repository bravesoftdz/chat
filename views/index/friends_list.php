<div class="col-sm-6 block-friends">
    <?php if ($this->session->get('user')) { ?>
        <div class="panel panel-default panel-friend">
            <div class="panel-heading">
                <h3 class="panel-title">Friends List <span id="friend-list-count" class="badge pull-right""><?= count($this->friendsList) ?></span></h3>
            </div>
            <div class="panel-body">
                <div class="table-container">
                    <table class="table-friends table" border="0">
                        <tbody>
                        <?php foreach ($this->friendsList as $user) { ?>
                            <tr class="user-id-<?= $user['id'] ?>">
                                <td width="10">
                                    <img class="pull-left img-circle nav-user-photo" width="50"  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxhcCYW4QDWMOjOuUTxOd50KcJvK-rop9qE9zRltSbVS_bO-cfWA"/>
                                </td>
                                <td>
                                    <?= $user['name'] ?><br><i class="fa fa-envelope"></i>
                                </td>
                                <td align="center">
                                    <small class="text-muted">Last Active: <?= date("m.d.y", strtotime($user['last_active'])) ?></small>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <button type="button" class="btn btn-warning btn-write-user-message" data-name="<?= $user['name'] ?>" data-user="<?= $user['id'] ?>"> <span class="glyphicon glyphicon-pencil"></span></button>
                                    </small>
                                    <small class="text-muted">
                                        <button type="button" class="btn btn-danger btn-remove-user" data-user='<?= $this->toJson($user,['id','name']) ?>'> <span class="glyphicon glyphicon-remove"></span></button>
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