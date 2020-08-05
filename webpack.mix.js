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

mix.styles([
        'resources/js/plantilla/css/bootstrap.min.css',
        'resources/js/plantilla/css/jquery.steps.css',
        'resources/js/plantilla/css/jquery-jvectormap-2.0.3.min.css',
        'resources/js/plantilla/css/plugin.css',
        'resources/js/plantilla/css/morris.min.css',
        'resources/js/plantilla/css/style.min.css',
        'resources/js/plantilla/css/footable.standalone.min.css',
        'resources/js/plantilla/css/footable.bootstrap.min.css',
        'resources/js/plantilla/css/sweetalert.css',
    ], 'public/css/plantilla.css').version()
    .scripts([
        'resources/js/plantilla/js/libscripts.bundle.js',
        'resources/js/plantilla/js/vendorscripts.bundle.js',
        'resources/js/plantilla/js/jquery.validate.js',
        'resources/js/plantilla/js/jquery.steps.js',
        'resources/js/plantilla/js/sweetalert.min.js',
        'resources/js/plantilla/js/jvectormap.bundle.js',
        'resources/js/plantilla/js/sparkline.bundle.js',
        'resources/js/plantilla/js/c3.bundle.js',
        'resources/js/plantilla/js/mainscripts.bundle.js',
        'resources/js/plantilla/js/form-wizard.js',
        'resources/js/plantilla/js/index.js',
        'resources/js/plantilla/js/footable.bundle.js',
        'resources/js/plantilla/js/footable.js',
        'resources/js/plantilla/js/bootstrap-notify.js',
        'resources/js/plantilla/js/notifications.js',
        'resources/js/plantilla/js/sweetalert.js',
    ], 'public/js/plantilla.js').version()
    .js(['resources/js/app.js'], 'public/js/app.js').version();