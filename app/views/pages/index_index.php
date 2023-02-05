<link rel="stylesheet" href="/css/ads.css">
<div class="mainPageIndexWrapper">
    <?php if (count($allAdsForIndexPage) != 0):?>
        <?php $iterationCount = 0?>
        <?php foreach ($allAdsForIndexPage as $ad):?>
            <?php $iterationCount++?>
            <div class="<?= 'box'.$iterationCount?> box">
                <div class="slider-wrapper">
                    <ul>
                        <?php foreach ($allPhotos as $photo):?>
                            <?php if($photo['name'] === $ad['name']):?>
                                <li><img src="<?= DIRECTORY_SEPARATOR.$photo['url']?>" alt=""/></li>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="w3-container w3-green">
                <div class="name"><?= $ad['name']?></div>
                </div>
                <div class="aboutAd">
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
                        <div class="description"><?= $ad['description']?></div>
                    </div>
                </div>
                </div>

        <?php endforeach;?>
    <?php endif;?>
</div>
<div>
    <?= $pagesLinks; ?>
</div>