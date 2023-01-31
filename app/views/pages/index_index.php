<div class="mainPageIndexWrapper">
    <?php if (count($allAdsForIndexPage) != 0):?>
        <?php $iterationCount = 0?>
            <?php foreach ($allAdsForIndexPage as $ad):?>


                <?php $iterationCount++?>
                    <div class="<?= 'box'.$iterationCount?>">
                        <div><?= $ad['name']?></div>
                        <div>
                            <label for="author">Author:</label>
                            <span><?= $ad['author']?></span>
                        </div>
                        <div>
                            <label for="phone">№ Tel:</label>
                            <span><?= $ad['phone']?></span>
                        </div>
                        <div>
                            <label for="created_at">Created:</label>
                            <span><?= $ad['created_at']?></span>
                        </div>
                        <div class="detailsAboutAd-wrapper">
                            <label for="description">Show more</label>
                            <div class="detailsAboutAd"><?= $ad['description']?></div>
                        </div>
                        <div>

                            <label>URL:</label>
                            <?php foreach ($allPhotos as $photo):?>
                                <?php if($photo['name'] === $ad['name']):?>
                                <img style="width: 90px; border: 1px solid #000" src="<?= DIRECTORY_SEPARATOR.$photo['url']?>"/>
                                <?php endif;?>
                            <?php endforeach;?>
                        </div>
                    </div>
            <?php endforeach;?>
    <?php endif;?>
</div>
