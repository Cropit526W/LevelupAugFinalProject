<h2>Here we will see all bulletins in the table with actions edit and del</h2>
<a href="<?= url('ads', 'create')?>">Create new bulletin</a><br>
<a href="<?= url('admin', 'index')?>">Back</a>
<table>
    <thead>
    <tr>
        <th>Headline</th>
        <th>Author</th>
        <th>№ tel</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php if (count($adsList)>0):?>
            <?php foreach($adsList as $ad):?>
                <tr>
                    <th><?= $ad['name']?></th>
                    <th><?= $ad['author']?></th>
                    <th><?= $ad['phone']?></th>
                    <th><?= $ad['created_at']?></th>
                    <th>
                        <form action="<?= url('ads', 'destroy')?>" method="post">
                            <input type="hidden" name="id" value="<?= $ad['id']?>">
                            <input type="submit" value="delete"/>
                        </form>
                    </th>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>