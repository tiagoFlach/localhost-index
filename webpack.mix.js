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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .scripts('node_modules/jquery/dist/jquery.min.js', 'public/app-assets/vendor/jquery/jquery.min.js')
    .scripts('node_modules/jquery-easing/dist/jquery-easing.1.3.umd.min.js', 'public/app-assets/vendor/jquery-easing/jquery-easing.min.js')
    //.copy('node_modules/directory-tree/lib/directory-tree.js', 'public/app-assets/js/directory-tree.js');