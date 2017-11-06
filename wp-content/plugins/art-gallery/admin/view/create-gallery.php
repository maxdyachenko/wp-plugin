<div class="content">
    <section class="container news-container content-container">
        <h2>Create your gallery:</h2>
        <div class="invalid-feedback <?php if (isset($limit) && $limit) echo 'visible';?>" id="limitError"><?php if (isset($limit) && $limit) echo "You are not allowed to create more than 5 galleries" ?></div>
        <form method="post" action="admin-post.php" class="create-gallery-form">
            <input type="hidden" name="action" value="ag_save_gallery">
            <?php wp_nonce_field('ag_verify_gallery', 'ag_input_nonce') ?>
            <label class="custom-file">
                <input type="text" id="ag_file" name="ag_file" class="custom-file-input" required>
                <span class="custom-file-control"></span>
            </label><br>
            <div class="invalid-feedback" id="fileError"></div>
            <input type="text" class="form-control" id="ag_name" name="ag_name" placeholder="Enter Gallery Name" required>
            <!-- make here mistake if gallery name already exist -->
            <!-- <div class="invalid-feedback <?php //if (isset($invalid_name) && $invalid_name) echo 'visible' ?>"><?php //if (isset($invalid_name) && $invalid_name) echo 'Such gallery already exist';?></div> -->
            <button type="submit" class="btn btn-primary" id="create-gallery-btn" name="submit">Submit</button>
        </form>
    </section>
</div>
