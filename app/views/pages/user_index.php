<h2>User Main Page</h2>

<a href="<?= url('user', 'create') ?>">Create new user</a>

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
                    <td><?= $user['login'] ?></td>
                    <td>
                        <form action="<?= url('user', 'destroy') ?>" method="post">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
                            <button class="w3-button w3-red w3-round"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif;?>
    </tbody>
</table>