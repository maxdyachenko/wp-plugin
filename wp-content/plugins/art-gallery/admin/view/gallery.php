

<div class="content">
    <section class="container news-container content-container">
        <div class="row justify-content-between buttons-group">
            <button type="button" class="btn btn-danger delete-all" data-toggle="modal" data-target="#delete-image-popup2" data-name="">Delete All</button>
            <!--            delete-all -> this class to handle this button in js and set coorect action in form popup-->
            <button type="button" class="btn btn-danger delete-selected" data-toggle="modal" data-target="#delete-image-popup3">Delete Selected</button>
            <!--            delete-selected -> this class to handle this button in js and set coorect action in form popup-->

        </div>
        <div class="row justify-content-between images-wrapper">
            <?php include(PLUGIN_DIR . 'views/add-image-block.php'); ?>
            <?php foreach ($gallery_data as $item): ?>
                <div class="image-container col-12 col-md-4">
                    <div class="image">
                        <img src="<?php echo $item->img_name; ?>" alt="Your image" class="rounded">
                    </div>
                    <div class="custom-popover">
                        <button type="button" class="btn btn-primary zoom-button" data-src="<?php echo $item->img_name; ?>">Zoom</button>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="chk[]" value="<?php echo $item->img_name; ?>">
                            </label>
                        </div>
                        <button type="button" class="btn btn-danger delete-one-image" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $item->img_name; ?>">Delete image</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php $pagination->get(); ?>
    </section>
</div>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="admin-post.php">
                    <input type="hidden" name="action" value="ag_delete_image">
                    <?php wp_nonce_field('ag_del_image', 'ag_input_nonce') ?>
                    <input class="image-name" type="hidden" name="ag_img">
                    <input type="hidden" name="ag_gallery" value="<?php echo $gallery_name; ?>">
                    <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="delete-image-popup2" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="admin-post.php">
                    <input type="hidden" name="action" value="ag_delete_all_images">
                    <?php wp_nonce_field('ag_del_all_images', 'ag_input_nonce') ?>
                    <input type="hidden" name="ag_gallery" value="<?php echo $gallery_name; ?>">
                    <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="delete-image-popup3" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="admin-post.php">
                    <input type="hidden" name="action" value="ag_delete_selected">
                    <?php wp_nonce_field('ag_del_selected', 'ag_input_nonce') ?>
                    <input class="image-name" type="hidden" name="ag_name">
                    <input type="hidden" name="ag_gallery" value="<?php echo $gallery_name; ?>">
                    <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="zoom-container">
    <div class="zoom-popup">
        <span class="fa fa-remove fa-2x close-button"></span>
        <img src="" alt="">
    </div>
</div>
