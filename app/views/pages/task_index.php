<h2>All task</h2>
<a href="<?= url('task', 'create') ?>">Create new task</a>
<table class="w3-table w3-striped w3-border">
    <thead>
        <tr class="w3-green">
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($tasks) > 0) :?>
            <?php foreach ($tasks as $task) : ?>
            <tr>
                <td><?= $task['id'] ?></td>
                <td><?= $task['name'] ?></td>
                <td>
                    <form action="<?= url('task', 'destroy') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>"/>
                        <button class="w3-button w3-red w3-round"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif;?>
    </tbody>
</table>