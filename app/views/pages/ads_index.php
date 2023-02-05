<div class="w3-bar w3-green adsBox">
    <a href="<?= url('ads', 'create')?>" class="w3-bar-item w3-button">Create new bulletin</a><br>
</div>
<table class="w3-table-all">
    <thead>
        <tr class="w3-green">
            <th>Headline</th>
            <th>Author</th>
            <th>№ tel</th>
            <th>Date</th>
            <th colspan="3">Action</th>
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
                            <div class="w3-container">
                                <div class="w3-card-4">
                                    <div class="w3-container w3-green">
                                        <h2>Create new bulletin</h2>
                                    </div>
                                    <form id="editForm" action="<?= url('ads', 'edit') ?>" method="get">
                                        <input class="w3-input" type="hidden" name="id" value="<?= $ad['id'] ?>"/>
                                        <div class="label"><label for="headline">Create a new title for ad:</label></div>
                                        <input class="w3-input" type="text" class="input_new_headline" name="headline" value="<?= $ad['name'] ?>" />
                                        <div class="label"><label for="description">Create a new description:</label></div>
                                        <textarea class="w3-input" class="input_new_description" name="description"><?= $ad['description'] ?></textarea>
                                        <div class="label"><label for="name">Enter an author:</label></div>
                                        <input class="w3-input" type="text" class="input_new_author" name="author" value="<?= $ad['author'] ?>"/>
                                        <div class="label"><label for="phone">Enter a new phone:</label></div>
                                        <input class="w3-input" type="text" class="input_new_phone" name="phone" value="<?= $ad['phone'] ?>"/>
                                        <input class="w3-btn w3-green" type="submit" value="Apply"/>
                                    </form>
                                </div>
                            </div>
                            <div class="label"><label for="photoList">Update photos:</label></div><br>
                            <?php session_start(); ?>
                            <?php if (!empty($_SESSION['errorsList'])): ?>
                                <?php $errorsList = $_SESSION['errorsList'];?>
                                <?php unset($_SESSION['errorsList']);?>
                                <div>
                                    <?php foreach ($errorsList as $error):?>
                                        <span class="errors"><?=$error?></span>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>
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
                                    <!-- TODO validation of count of photos -->
                                </div>
                                <div class="plusFormForAddNewPhoto">
                                    <i class="fa fa-plus"></i>
                                    <div class="addNewPhoto">
                                        <form class="addForm" action="<?= url('ads', 'store') ?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $ad['id']?>" value="<?= $ad['vendor_code']?>">
                                            <input class="add" type="file" name="photos[]" accept="image/*" multiple oninput="this.form.submit()"/>
                                        </form>
                                    </div>
                                </div>


                        </div>
                    </th>
                    <th>
                        <a href="#<?= $ad['id']?>" ><button><i class="fa fa-pencil-square-o" style="font-size:24px"></i></button></a>
                    </th>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
<div class="w3-bar w3-green backBox">
    <a href="<?= url('admin', 'index')?>" class="w3-bar-item w3-button"><i class="fa fa-arrow-left"></i></a>
</div>