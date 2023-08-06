$(function() {

    $('.browse-image').on("change", function() {

        var file = $(this).get(0).files[0];

        if(file) {

            var reader = new FileReader();

            reader.onload = function() {
                $('.preview-image').attr("src", reader.result);
            }
            reader.readAsDataURL(file);

            $('.browse-image-label').text(file.name);

        }
    });

});