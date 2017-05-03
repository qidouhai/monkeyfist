const { mix } = require('laravel-mix');

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
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
    'public/bower_components/moment/moment.js',
    'public/bower_components/angular/angular.js',
    'public/bower_components/angular-resource/angular-resource.js',
    'public/bower_components/angular-sanitize/angular-sanitize.js',
    'public/js/main.js',
    'public/js/services/feedService.js',
    'public/js/filters/mediaEmbed.js',
    'public/js/filters/util.js',
    'public/js/controllers/FeedController.js'
], 'public/js/dashboard.js');
