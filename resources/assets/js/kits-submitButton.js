(function ($, undefined) {

    var submitButtonText = {
        "draft": "SAUVEGARDER LE KIT",
        "submit": "ENVOYER LE KIT"
    };

    $('.js-kits-status').bind('change', function () {
        $('.js-kits-submitButton').html(submitButtonText[$(this).val()]);
    });

})(jQuery);