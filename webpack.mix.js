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

mix.options({
    processCssUrls: false,
});

mix.copyDirectory('vendor/tabler/tabler/dist/assets', 'public/admin/assets');

mix.version([
    'public/admin/assets/css/dashboard.css',
    'public/admin/assets/js/require.min.js',
    'public/admin/assets/js/dashboard.js'])
   .sourceMaps();

mix.js('resources/js/app.js', 'public/js')
   .extract()
   .version()
   .sourceMaps();
