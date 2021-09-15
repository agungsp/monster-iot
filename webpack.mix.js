const mix = require("laravel-mix");
mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy(
        "node_modules/@fortawesome/fontawesome-free/webfonts",
        "public/webfonts"
    )
    .copy("node_modules/leaflet/dist/images", "public/images")
    .copy("node_modules/datatables.net-bs5/images", "public/images")
    .sourceMaps()
    .disableNotifications();
