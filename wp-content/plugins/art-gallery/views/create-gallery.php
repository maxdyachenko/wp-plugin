<div class="content">
    <section class="container news-container content-container">
        <h2>Create your gallery:</h2>
        <div class="invalid-feedback" id="limitError"></div>
        <form class="create-gallery-form" enctype="multipart/form-data">
            <label class="custom-file">
                <input type="file" id="file2" name="file" class="custom-file-input" required>
                <span class="custom-file-control"></span>
            </label><br>
            <div class="invalid-feedback" id="fileError"></div>
            <input type="text" class="form-control" id="galleryName" name="galleryName" placeholder="Enter Gallery Name" required>
            <div class="invalid-feedback"></div>
            <button type="button" class="btn btn-primary" id="create-gallery-btn" name="submit">Submit</button>
        </form>
    </section>
</div>
