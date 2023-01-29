<h2>New bulletin</h2>
<form action="<?= url('ads', 'store') ?>" method="post" enctype="multipart/form-data">
    <label for="headline">Title of bulletin</label>
    <input type="text" name="headline" id="headline"/>
    <label for="description">Description</label>
    <textarea name="description" id="description"></textarea>
    <label for="author">Author</label>
    <input type="text" name="author" id="author"/>
    <label for="phone">Phone number</label>
    <input type="tel" name="phone" id="phone"/>
    <label>Photos</label>
    <input type="file" name="photos[]" accept="image/*" multiple/>
    <input type="submit"/>
</form>
<a href="<?= url('ads', 'index')?>">Back</a>