// create product

document.getElementById('image').addEventListener('change', function (e) {
    const previewWrapper = document.getElementById('image-preview-wrapper');
    const previewImage = document.getElementById('image-preview');
    const file = e.target.files[0];

    if (file) {
        if (!file.type.startsWith('image/')) {
            alert('please select a valid image file');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewWrapper.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        previewWrapper.classList.add('hidden');
    }
});

