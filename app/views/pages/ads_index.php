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
                            <button><i class="fa fa-trash" style="font-size:24px"></i></button>
                        </form>
                    </th>
                    <th>
                        <div class="modal_dialog" id="<?= $ad['id']?>">
                            <a href="" class="close"><i class="fa fa-close"></i></span></a>
                            <form action="<?= url('ads', 'edit') ?>" method="get">
                                <input type="hidden" name="id" value="<?= $ad['id'] ?>"/>
                                <div class="label"><label for="headline">Create a new title for ad:</label></div><br>
                                <input type="text" class="input_new_headline" name="headline" value="<?= $ad['name'] ?>"/>
                                <div class="label"><label for="description">Create a new description:</label></div><br>
                                <textarea class="input_new_description" name="description"><?= $ad['description'] ?></textarea>
                                <div class="label"><label for="name">Enter an author:</label></div><br>
                                <input type="text" class="input_new_author" name="author" value="<?= $ad['author'] ?>"/>
                                <div class="label"><label for="phone">Enter a new phone:</label></div><br>
                                <input type="text" class="input_new_phone" name="phone" value="<?= $ad['phone'] ?>"/>
                                <div class="label"><label for="photoList">Update photos:</label></div><br>
                                <div class="photoList">
                                    <?php foreach ($allPhotos as $photo):?>
                                        <?php if ($photo['name'] === $ad['name']):?>
                                            <div class="photosForUpdating">
                                                <img src="<?= DIRECTORY_SEPARATOR.$photo['url']?>"/>
                                                <form action="<?= url('ads', 'destroy')?>" method="post">
                                                    <input type="hidden" name="<?= $ad['id']?>" value="<?= $photo['url']?>">
                                                    <button><i class="fa fa-trash" style="font-size:24px"></i></button>
                                                </form>
                                            </div>
                                        <?php endif;?>
                                    <?php endforeach;?>
<!--                                    --><?php //if(count($allPhotos) < 10):?>

<!--                                    --><?php //endif;?>
                                </div>
                                <br> <!--del br-->
                                <input type="submit" value="Apply"/>
                            </form>
                            <div class="plusFormForAddNewPhoto">
                                <i class="fa fa-plus"></i>
                                <div class="addNewPhoto">
                                    <form class="addForm" action="<?= url('ads', 'store') ?>" method="post" enctype="multipart/form-data">
                                        <input class="add" type="file" name="photos[]" accept="image/*" multiple onchange="this.form.submit()"/>
                                        <?php session_start();?>
                                        <?php $_SESSION['vendor_code'] = $ad['vendor_code']?>
                                        <?php $_SESSION['ad_id'] = $ad['id']?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </th>
                    <th>
                        <a href="#<?= $ad['id']?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a>
                    </th>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
