document.addEventListener('DOMContentLoaded', function() {

    var uploadForm = document.getElementById('uploadForm'),
        fileInput = document.getElementById('ag-file'),
        error = document.getElementsByClassName('invalid-feedback')[0],
        label	 = fileInput.nextElementSibling,
        labelVal = label.innerHTML,
        fileName;


    var frame = wp.media({
        title: 'Upload image',
        button: {
            text: 'Use this media'
        },
        multiple:false
    });

    uploadForm.addEventListener('submit', function() {
        if (!fileName) {
            event.preventDefault();
        }
    });

    fileInput.addEventListener('click', function(e){
        e.preventDefault();
        frame.open();
    });
    frame.on('select', function () {
        var attachment = frame.state().get('selection').first().toJSON();
        fileInput.value = attachment.url;
        fileName = fileInput.value.split('\\').pop();
        if(checkFile()) {
            label.querySelector('p').innerHTML = fileName;
        }
        else{
            fileName = null;
            label.querySelector('p').innerHTML = '';
        }
    });

    // function getFileSize() {
    //     if (typeof (fileInput.files) !== "undefined") {
    //         return parseFloat(fileInput.files[0].size / 1024).toFixed(2);
    //     } else {
    //         return false;
    //     }
    // }

    function checkFileExtension(){
        return fileName.match(/^.*\.(jpg|JPG|png|PNG)$/);
    }


    function checkFile() {
        // if (getFileSize() > 2000){
        //     error.classList.add('visible');
        //     error.innerHTML = "Image size should be less than 2Mb";
        //     return false;
        // }
        if (!checkFileExtension()){
            error.classList.add('visible');
            error.innerHTML = "Upload only PNG or JPG";
            return false;
        }
        else{
            error.classList.remove('visible');
            error.innerHTML = "";
        }
        return true;
    }


    var imgName, gallery,
        checkbox = document.getElementsByClassName('form-check-input');
    $('#delete-image-popup', '#delete-image-popup2', '#delete-image-popup3').on('shown.bs.modal', function (e) {
        var input = this.getElementsByTagName('input')[0],
            form = this.getElementsByTagName('form')[0];
        if (e.relatedTarget.classList.contains('delete-selected')){
            var imgsArray = [];
            for (var i = 0; i < checkbox.length; i++){
                if (checkbox[i].checked){
                    imgsArray.push(checkbox[i].value);
                }
            }
            input.setAttribute('value',imgsArray);
        }
        else if (e.relatedTarget.classList.contains('delete-one-image')){
            imgName = e.relatedTarget.getAttribute('data-name');
            input.setAttribute('value',imgName);
        }
    });



    var zoomPopup = document.getElementById('zoom-container'),
        zoomBtn = document.getElementsByClassName('zoom-button'),
        closeBtn = document.getElementsByClassName('close-button')[0],
        img = zoomPopup.getElementsByTagName('img')[0];


    for (var i = 0;i < zoomBtn.length; i++) {
        zoomBtn[i].addEventListener('click', openZoomPopup)
    }

    function openZoomPopup() {
        document.body.classList.add('modal-open');
        zoomPopup.classList.add('open');
        img.src = this.getAttribute('data-src');
    }

    closeBtn.addEventListener('click', function(){
        document.body.classList.remove('modal-open');
        zoomPopup.classList.remove('open');
    });
    
});

