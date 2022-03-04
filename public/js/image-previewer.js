function previewImage() {
    const imgInput = document.querySelector('.img-input');
    const imgPreview = document.querySelector('.img-preview');
    console.log(imgPreview);
    imgPreview.style.display = 'block';
    imgPreview.style.marginBottom = '15px';
    const reader = new FileReader();

    reader.readAsDataURL(imgInput.files[0]);

    reader.addEventListener('load', readerEvent => {
        imgPreview.src = readerEvent.target.result
    })
}
