const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js("resources/js/app.js", "public/js")
 .sass("resources/sass/app.scss", "public/css")
 .sourceMaps(true, "source-maps")
 .browserSync({
     proxy: "127.0.0.1:8000",
     port: 3100,
     ghostMode: false,
     notify: false
 });

// Copy plugin files to public folder
mix.copyDirectory("node_modules/@mdi", "public/assets/plugins/@mdi")
    .copyDirectory(
        [
         "node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js",
         "node_modules/perfect-scrollbar/css/perfect-scrollbar.css"
        ],
        "public/assets/plugins/perfect-scrollbar"
    );
