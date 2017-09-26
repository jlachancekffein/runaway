var elixir = require("laravel-elixir");


elixir(function(mix) {

    // starting scripts
    mix.combine([
        "./node_modules/jquery/dist/jquery.min.js",
        "./node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js",
        "./node_modules/select2/dist/js/select2.min.js",
        "./node_modules/select2/dist/js/i18n/fr.js",
        "./node_modules/simplemde/dist/simplemde.min.js",
        "./node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js",
        "./node_modules/sticky-kit/dist/sticky-kit.min.js",
        "./node_modules/accounting/accounting.js",
        "./node_modules/card/dist/card.js",
        "./node_modules/vue/dist/vue.min.js",
        "./node_modules/vue-resource/dist/vue-resource.js"
    ], "public/js/starting.js");

    // ending scripts
    mix.combine("resources/assets/js", "public/js/ending.js");

    // combine scripts
    mix.scripts([
        "./public/js/starting.js",
        "./public/js/ending.js"
    ], "public/js/app.js");

    mix.sass("app.scss");

    mix.version([
        "css/app.css",
        "js/app.js"
    ]);
});