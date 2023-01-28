<h2>New bulletin</h2>
<form action="" method="post" enctype="multipart/form-data">
    <label for="headline">Title of bulletin</label>
    <input type="text" name="headline" id="headline"/>
    <label for="description">Description</label>
    <textarea name="description" id="description"></textarea>
    <label>Photos</label>
    <input type="file" name="photo" accept="image/*" multiple/>
    <input type="submit"/>
</form>
<a href="<?= url('ads', 'index')?>">Back</a>