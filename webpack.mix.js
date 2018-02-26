let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/bootstrap.js', 'public/js')
    .js('resources/assets/js/cargaShow.js', 'public/js')
    .js('resources/assets/js/datetime.js', 'public/js')
    .js('resources/assets/js/iziModal.js', 'public/js')
    .js('resources/assets/js/loading.js', 'public/js')
    .js('resources/assets/js/map.js', 'public/js')
    .js('resources/assets/js/paginationEvents.js', 'public/js')
    .js('resources/assets/js/paginationMyEvents.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/home.css', 'public/css')
    .sass('resources/assets/sass/iziModal.css', 'public/css');
