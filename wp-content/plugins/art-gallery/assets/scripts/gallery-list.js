document.addEventListener('DOMContentLoaded', function() {
    $('#delete-image-popup').on('shown.bs.modal', function (e) {
        var input = this.getElementsByClassName('gallery-name')[0],
            galleryName,
            form = this.getElementsByClassName('del-gallery-form')[0];
        galleryName = e.relatedTarget.getAttribute('data-name');
        input.setAttribute('value', galleryName);
    });
});