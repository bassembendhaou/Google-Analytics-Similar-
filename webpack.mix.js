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

mix.js('resources/js/users.js', 'public/js/users.js')
    .js('resources/js/visitors.js', 'public/js/visitors.js')
    .js('resources/js/dashboard.js', 'public/js/dashboard.js')
    .vue()
    .sass('resources/sass/dashboard.scss', 'public/css/dashboard.css')
    .sass('resources/sass/users.scss', 'public/css/users.css')
    .sass('resources/sass/visitors.scss', 'public/css/visitors.css')
    .sass('resources/sass/app.scss', 'public/css/app.css');
