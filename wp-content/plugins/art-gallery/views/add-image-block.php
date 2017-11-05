<div class="image-container col-12 col-md-4 add-image-block">
    <form action="admin-post.php" method="post" id="uploadForm">
        <input type="hidden" name="action" value="ag_add_image">
        <input type="hidden" name="ag_gallery" value="<?php echo $gallery_name; ?>">
        <?php wp_nonce_field('ag_add_image_action', 'ag_input_nonce') ?>
        <div class="button-container">
            <input type="text" name="ag_file" id="ag-file" class="add-button input-file" />
            <label for="ag-file">
                <figure></figure>
                <p>Choose file...</p>
                <div class="invalid-feedback"></div>
            </label>
        </div>
        <button type="submit" class="btn btn-primary" name="upload-image">Upload</button>
    </form>
</div>