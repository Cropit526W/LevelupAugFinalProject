<div class="w3-bar newBulletin">
    <h3>New bulletin</h3>
</div>
<div class="w3-container newAdBox">
    <div class="w3-card-4">
        <div class="w3-container w3-green">
            <h2>Create new bulletin</h2>
        </div>
        <form class="w3-container" action="<?= url('ads', 'store') ?>" method="post" enctype="multipart/form-data">
            <label for="headline">Title of bulletin</label>
            <input class="w3-input" type="text" name="headline" id="headline"/>
            <label for="description">Description</label>
            <textarea class="w3-input" name="description" id="description"></textarea>
            <label for="author">Author</label>
            <input class="w3-input" type="text" name="author" id="author"/>
            <label for="phone">Phone number</label>
            <input class="w3-input" type="tel" name="phone" id="phone"/>
            <label>Photos</label>
            <input class="w3-input" type="file" name="photos[]" accept="image/*" multiple/>
            <input class="w3-btn w3-green" type="submit" value="Add"/>
        </form>
    </div>
</div>

<div class="w3-bar w3-green backBox">
    <a href="<?= url('ads', 'index') ?>" class="w3-bar-item w3-button"><i class="fa fa-arrow-left"></i></a>
</div>