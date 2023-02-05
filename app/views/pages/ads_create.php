<div class="w3-bar newBulletin">
    <h3>New bulletin</h3>
</div>
<?php session_start()?>
<?php if(!empty($_SESSION['errorsList'])):?>
    <?php $errorsList = $_SESSION['errorsList']?>
    <?php unset($_SESSION['errorsList'])?>
<?php endif;?>
<div class="w3-container newAdBox">
    <div class="w3-card-4">
        <div class="w3-container w3-green">
            <h2>Create new bulletin</h2>
        </div>

        <form class="w3-container" action="<?= url('ads', 'store') ?>" method="post" enctype="multipart/form-data">
            <label for="headline">Title of bulletin</label>
            <input class="w3-input" type="text" name="headline" id="headline"/>
            <div class="error"><?php if(!empty($errorsList['headline'])){echo $errorsList['headline'];}?></div>
            <label for="description">Description</label>
            <textarea class="w3-input" name="description" id="description"></textarea>
            <div class="error"><?php if(!empty($errorsList['description'])){echo $errorsList['description'];}?></div>
            <label for="author">Author</label>
            <input class="w3-input" type="text" name="author" id="author"/>
            <div class="error"><?php if(!empty($errorsList['author'])){echo $errorsList['author'];}?></div>
            <label for="phone">Phone number</label>
            <input class="w3-input" type="tel" name="phone" id="phone"/>
            <div class="error"><?php if(!empty($errorsList['phone'])){echo $errorsList['phone'];}?></div>
            <div class="error"><?php if(!empty($errorsList['countNumbersInPhone']) && empty($errorsList['phone'])){echo $errorsList['countNumbersInPhone'];}?></div>
            <label>Photos</label>
            <input class="w3-input" type="file" name="photos[]" accept="image/*" multiple/>
            <div class="error"><?php if(!empty($errorsList['no_photo'])){echo $errorsList['no_photo'];}?></div>
            <div class="error"><?php if(!empty($errorsList['error'])){echo $errorsList['error'];}?></div>
            <div class="error"><?php if(!empty($errorsList['extension'])){echo $errorsList['extension'];}?></div>
            <div class="error"><?php if(!empty($errorsList['size'])){echo $errorsList['size'];}?></div>
            <input class="w3-btn w3-green" type="submit" value="Add"/>
        </form>
    </div>
</div>
<div class="w3-bar w3-green backBox">
    <a href="<?= url('ads', 'index') ?>" class="w3-bar-item w3-button"><i class="fa fa-arrow-left"></i></a>
</div>
