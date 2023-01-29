<div class="w3-panel">
    <h2>User Main Page</h2>
</div>

<div class="w3-panel">
    <a class="w3-bar-item w3-button w3-round w3-green" href="<?= url('user', 'create') ?>">Create new user</a>
</div>

<div class="w3-panel">
    <table class="w3-table w3-striped w3-border">
        <thead>
        <tr class="w3-green">
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($users) > 0) :?>
            <?php foreach ($users as $user) :?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['login'];?></td>
                    <?php if (!$user['main']) :?>
                        <td>
                            <form action="<?= url('user', 'destroy') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
                                <button class="w3-button w3-red w3-round"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif;?>
        </tbody>
    </table>
    <a href="<?= url('admin', 'index')?>">Back</a>
</div>
