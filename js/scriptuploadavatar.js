function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').style.backgroundImage = "url(" + e.target.result + ")";
            document.getElementById('imagePreview').style.backgroundSize = "cover"; // Optional: to cover the entire area
            document.getElementById('imagePreview').style.backgroundPosition = "center"; // Optional: to center the image
        }
        reader.readAsDataURL(input.files[0]);
    }
}
document.getElementById("imageUpload").addEventListener('change', function() {
    readURL(this);
});