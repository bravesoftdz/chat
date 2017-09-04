<div class="col-sm-6 block-users">
    <div class="panel panel-default panel-users">
        <div class="panel-heading">
            <h3 class="panel-title">Users List <span id="users-list-count" class="badge pull-right""><?= count($this->usersList) ?></span>
            </h3>
        </div>
        <div class="panel-body">
            <div class="table-container">
                <table class="table-users table" border="0">
                    <tbody>
                    <?php foreach ($this->usersList as $user) { ?>
                        <tr>
                            <td width="10">
                                <img class="pull-left img-circle nav-user-photo" width="50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxhcCYW4QDWMOjOuUTxOd50KcJvK-rop9qE9zRltSbVS_bO-cfWA"/>
                            </td>
                            <td>
                                <?= $user['name'] ?><br><i class="fa fa-envelope"></i>
                            </td>
                            <td align="center">
                                <?php if ($this->session->get('user')) { ?>
                                    <small class="text-muted">
                                        <?php if (is_null($user['accepted'])): ?>
                                            <button type="button"
                                                    class="btn btn-default btn-send-user-request user-id-<?= $user['id'] ?>"
                                                    data-user="<?= $user['id'] ?>">
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


<script type="html/tpl" id="new-user-item">
    <tr>
        <td width="10">
            <img class="pull-left img-circle nav-user-photo" width="50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxhcCYW4QDWMOjOuUTxOd50KcJvK-rop9qE9zRltSbVS_bO-cfWA">
        </td>
        <td>
            {name}<br><i class="fa fa-envelope"></i>
        </td>
        <td align="center">
            <small class="text-muted">
                <button type="button" class="btn btn-default btn-send-user-request user-id-{id}" data-user="{id}">
                    <span class="glyphicon glyphicon-plus"></span></button>
            </small>
        </td>
    </tr>
</script>
