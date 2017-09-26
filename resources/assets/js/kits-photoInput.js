(function ($, undefined) {

    $('.js-kits-editImageLabel').hide();

    $('.js-kits-photoInput').each(function () {
        var $element = $(this);

        $element.on("change", function() {
            var reader = new FileReader();

            if (this.files && this.files[0]) {
                $('.js-kits-editImageLabel').show();
                reader.onload = function (e) {
                    $element.parent().find('.js-kits-photo').remove();
                    $element.after($('<img class="kits-photo js-kits-photo">').attr("src", e.target.result));
                    $element.hide();
                    $element.prev().hide()
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

})(jQuery);