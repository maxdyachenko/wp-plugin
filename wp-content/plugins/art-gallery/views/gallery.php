

<div class="content">
    <section class="container news-container content-container">
        <div class="row justify-content-between buttons-group">
            <button type="button" class="btn btn-danger delete-all" data-toggle="modal" data-target="#delete-image-popup" data-name="">Delete All</button>
            <!--            delete-all -> this class to handle this button in js and set coorect action in form popup-->
            <button type="button" class="btn btn-danger delete-selected" data-toggle="modal" data-target="#delete-image-popup">Delete Selected</button>
            <!--            delete-selected -> this class to handle this button in js and set coorect action in form popup-->

        </div>
        <div class="row justify-content-between images-wrapper">
<!--            content here-->
            <?php include(PLUGIN_DIR . 'views/add-image-block.php'); ?>
            <div class="image-container col-12 col-md-4">
                <div class="image">
                    <img src="" alt="Your image" class="rounded">
                </div>
                <div class="custom-popover">
                    <button type="button" class="btn btn-primary zoom-button" data-src="">Zoom</button>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="chk[]" value="">
                        </label>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-image-popup" data-name=">">Delete image</button>
                </div>
            </div>
        </div>

        <!--to do pagination here -->
    </section>
</div>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="name">
                    <input type="hidden" name="gallery" value="">
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
