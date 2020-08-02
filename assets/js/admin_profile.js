var uploadInput = document.getElementsByClassName('file-input');

for (var i = 0; i < uploadInput.length; i++) {
    uploadInput[i].onchange = function (event) {
        var inputId = event.target.id;
        var elementFile = document.getElementById( 'file-' + inputId);
        var elementFileIcon = document.getElementById( 'file-icon-' + inputId);
        var elementFileLabel = document.getElementById('file-label-' + inputId);

        elementFile.classList.add('is-primary');
        elementFileLabel.classList.add('has-text-white');
        elementFileIcon.classList.remove('fa-upload');
        elementFileIcon.classList.add('fa-check-circle');
    };
}