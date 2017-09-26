(function($, baseUrl, undefined) {

    $(".js-memberSearch").select2({
        placeholder: "Sélectionner un client",
        language: "fr",
        ajax: {
            url: baseUrl + "/admin/customers/search",
            dataType: "json",
            delay: 250,
            minimumInputLength: 1,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

})(jQuery, baseUrl);