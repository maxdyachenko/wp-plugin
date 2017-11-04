
    <div class="content"><section class="container news-container content-container">
            <a href="<?php echo admin_url() . 'admin.php?page=ag-create-gallery'; ?>" class="btn btn-primary">Create gallery</a>

                <div class="card card-custom">
                    <img class="card-img-top" src="" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title"></h4>
                        <div class="buttons-group">
                            <a href="/gallery/" class="btn btn-primary">Open Gallery</a>
                            <button type="button" class="btn btn-danger delete-all" data-toggle="modal" data-target="#delete-image-popup" data-name="">Delete Gallery</button>
                        </div>
                    </div>
                </div>
        </section>

    </div>

    <div id="delete-image-popup" class="modal fade show" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="/delete-gallery">
                        <input type="hidden" name="name">
                        <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>