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

mix .copyDirectory('node_modules/startbootstrap-sb-admin-2/vendor', 'public/vendor')
    .copyDirectory('node_modules/startbootstrap-sb-admin-2/css', 'public/css')
    .copyDirectory('node_modules/startbootstrap-sb-admin-2/js', 'public/js')
    .copy([
        'node_modules/startbootstrap-sb-admin-2/404.html',
        'node_modules/startbootstrap-sb-admin-2/blank.html',
        'node_modules/startbootstrap-sb-admin-2/buttons.html',
        'node_modules/startbootstrap-sb-admin-2/cards.html',
        'node_modules/startbootstrap-sb-admin-2/charts.html',
        'node_modules/startbootstrap-sb-admin-2/forgot-password.html',
        'node_modules/startbootstrap-sb-admin-2/index.html',
        'node_modules/startbootstrap-sb-admin-2/login.html',
        'node_modules/startbootstrap-sb-admin-2/register.html',
        'node_modules/startbootstrap-sb-admin-2/tables.html',
        'node_modules/startbootstrap-sb-admin-2/utilities-animation.html',
        'node_modules/startbootstrap-sb-admin-2/utilities-border.html',
        'node_modules/startbootstrap-sb-admin-2/utilities-color.html',
        'node_modules/startbootstrap-sb-admin-2/utilities-other.html'
    ], 'public/html/')
    .copyDirectory('node_modules/jquery-treegrid', 'public/vendor/jquery-treegrid');

    // // Bootstrap
    // .styles('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/vendor/bootstrap/css/bootstrap.min.css')
    // .scripts('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/vendor/bootstrap/js/bootstrap.min.js') 
    // .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/vendor/bootstrap/js/bootstrap.bundle.min.js')

    // // Charts.js
    // .scripts('node_modules/chart.js/dist/Chart.min.js', 'public/vendor/chart.js/Chart.min.js')

    // // Data Tables
    // .scripts('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/vendor/datatables/js/jquery.dataTables.min.js')
    // .scripts('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'public/vendor/datatables/js/dataTables.bootstrap4.min.js')
    // .styles('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'public/vendor/datatables/css/dataTables.bootstrap4.min.css')

    // // Starbootstrap Sb Admin 2
    // .styles('node_modules/startbootstrap-sb-admin-2/css/sb-admin-2.min.css', 'public/vendor/startbootstrap-sb-admin-2/css/sb-admin-2.min.css')
    // .scripts('node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.min.js', 'public/vendor/startbootstrap-sb-admin-2/js/sb-admin-2.min.js')
    // .scripts('node_modules/startbootstrap-sb-admin-2/js/demo/chart-area-demo.js', 'public/vendor/startbootstrap-sb-admin-2/js/demo/chart-area-demo.js')
    // .scripts('node_modules/startbootstrap-sb-admin-2/js/demo/chart-bar-demo.js', 'public/vendor/startbootstrap-sb-admin-2/js/demo/chart-bar-demo.js')
    // .scripts('node_modules/startbootstrap-sb-admin-2/js/demo/chart-pie-demo.js', 'public/vendor/startbootstrap-sb-admin-2/js/demo/chart-pie-demo.js')
    // .scripts('node_modules/startbootstrap-sb-admin-2/js/demo/datatables-demo.js', 'public/vendor/startbootstrap-sb-admin-2/js/demo/datatables-demo.js')

    // // Font Awesome
    // .scripts('node_modules/startbootstrap-sb-admin-2/vendor/fontawesome-free/js/fontawesome.min.js', 'public/vendor/fontawesome-free/js/fontawesome.min.js')
    // .styles('node_modules/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/fontawesome.min.css', 'public/vendor/fontawesome-free/css/fontawesome.min.css')
    // .styles('node_modules/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css', 'public/vendor/fontawesome-free/css/all.min.css')

    // // Jquery
    // .scripts('node_modules/jquery/dist/jquery.min.js', 'public/vendor/jquery/jquery.min.js')
    
    // // Jquery Easing
    // .scripts('node_modules/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js', 'public/vendor/jquery-easing/jquery.easing.min.js');