<h2>Create new task</h2>
<form action="<?= url('task', 'store') ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name"/>
    <input type="submit"/>
</form>