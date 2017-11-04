document.addEventListener('DOMContentLoaded', function() {
    var formCreate = document.getElementsByClassName('create-gallery-form')[0],
        buttonCreate = document.getElementById('create-gallery-btn'),
        fileInput = document.getElementById('ag_file'),
        galleryName = document.getElementById('ag_name'),
        fileError = document.getElementById('fileError'),
        fileLabel = document.getElementsByClassName('custom-file')[0],
        limitError = document.getElementById('limitError');

    formCreate.addEventListener('submit', validateCreateForm);

    var frame = wp.media({
        title: 'Upload logo',
        button: {
            text: 'Use this media'
        },
        multiple:false
    });
    fileInput.addEventListener('click', function (e) {
        e.preventDefault();
        frame.open();
    });
    
    frame.on('select', function () {
        var attachment = frame.state().get('selection').first().toJSON();
        fileInput.value = attachment.url;
    });

    function validateCreateForm() {
        if (!checkAvatar(fileError) || !checkName()){
            event.preventDefault();
        }
    }
    function checkName() {
        if (galleryName.value.length > 0){
            galleryName.nextElementSibling.classList.remove('visible');
            return true;
        }
        else {
            showError(galleryName.nextElementSibling, "Should not be empty");
            return false;
        }
    }

    function checkAvatar(error){
        // if (!checkEmptyFile()){
        //     showError(error, "Should not be empty");
        //     return false;
        // }
        // if (getFileSize() > 2000){
        //     showError(error, "Image size should be less than 2Mb");
        //     return false;
        // }
        if (!checkFileExtension()){
            showError(error, "Upload only PNG or JPG");
            return false;
        }
        else{
            error.classList.remove('visible');
            error.innerHTML = "";
            return true;
        }
    }
    function showError(error, text) {
        error.classList.add('visible');
        error.innerHTML = text;
    }
    // function checkEmptyFile() {
    //     return fileInput.files.length > 0;
    // }
    // function getFileSize() {
    //     if (typeof (fileInput.files) !== "undefined") {
    //         return parseFloat(fileInput.files[0].size / 1024).toFixed(2);
    //     } else {
    //         return false;
    //     }
    // }

    function checkFileExtension(){
        return fileInput.value.match(/^.*\.(jpg|JPG|png|PNG)$/);
    }
});