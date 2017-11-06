<div class="content">
    <div class="row justify-content-between images-wrapper">
        <?php foreach ($gallery_data as $item): ?>
            <div class="image-container col-12 col-md-4">
                <div class="image">
                    <img src="<?php echo $item->img_name; ?>" alt="Your image" class="rounded">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
