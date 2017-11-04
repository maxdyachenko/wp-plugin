
    <div class="content"><section class="container news-container content-container">
        <a href="<?php echo admin_url() . 'admin.php?page=ag-create-gallery'; ?>" class="btn btn-primary">Create gallery</a>
            <?php foreach ($gallerylist_data as $item): ?>
                <div class="card card-custom">
                    <img class="card-img-top" src="<?php echo $item->gallery_img; ?>" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title"><?php echo $item->gallery_name; ?></h4>
                        <div class="buttons-group">
                            <a href="<?php  echo admin_url() . 'admin.php?page=ag-gallery' . '&name=' . $item->gallery_name; ?>" class="btn btn-primary">Open Gallery</a>
                            <button type="button" class="btn btn-danger delete-all" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $item->gallery_name; ?>">Delete Gallery</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>

    <div id="delete-image-popup" class="modal fade show" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="admin-post.php" class="del-gallery-form">
                        <input type="hidden" name="action" value="ag_delete_gallery">
                        <?php wp_nonce_field('ag_verify_del_gallery', 'ag_input_nonce') ?>
                        <input type="hidden" name="name" class="gallery-name">
                        <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>