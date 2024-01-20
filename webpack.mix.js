const mix = require('laravel-mix');

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


// Guest
mix.js('resources/js/guest.js', 'public/js')
    .sass('resources/sass/guest.scss', 'public/css');

// Admin
mix.js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/admin.scss', 'public/css');