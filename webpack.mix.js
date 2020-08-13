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

mix.browserSync('myblog.test')
  // .sass('resources/assets/sass/app.scss', 'public/app.css')

  // .sass('resources/assets/sass/style.scss', 'public/css/style.css')
   // assets/sass配下のstyle.scssを、public/css配下にstyle.cssとしてコンパイル

   .sass('resources/assets/sass/style.scss', 'public/css')

  // assets/sass配下のstyle.scssを、public/css配下にstyle.cssとしてコンパイル
  .js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/js/main.js', 'public/js')

  // .js('resources/js/bootstrap.js', 'public/js')
  .version();