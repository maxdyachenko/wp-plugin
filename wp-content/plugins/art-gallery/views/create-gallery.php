<div class="content">
    <section class="container news-container content-container">
        <h2>Create your gallery:</h2>
        <div class="invalid-feedback" id="limitError"></div>
        <form method="post" action="admin-post.php" class="create-gallery-form">
            <input type="hidden" name="action" value="ag_save_gallery">
            <?php wp_nonce_field('ag_verify_gallery', 'ag_input_nonce') ?>
            <label class="custom-file">
                <input type="file" id="ag_file" name="ag_file" class="custom-file-input" required>
                <span class="custom-file-control"></span>
            </label><br>
            <div class="invalid-feedback" id="fileError"></div>
            <input type="text" class="form-control" id="ag_name" name="ag_name" placeholder="Enter Gallery Name" required>
            <div class="invalid-feedback"></div>
            <button type="submit" class="btn btn-primary" id="create-gallery-btn" name="submit">Submit</button>
        </form>
    </section>
</div>
