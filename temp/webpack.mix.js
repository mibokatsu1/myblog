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
  .sass('resources/assets/sass/app.scss', 'public/css')
  // .sass('resources/assets/sass/_base.scss', '../resources/assets/build/css')
   // importファイルは逐一追加する(しないとwatch-pollで監視できない)
  .sass('resources/assets/sass/style.scss', 'public/css/style.css') // assets/sass配下のstyle.scssを、public/css配下にstyle.cssとしてコンパイル
  // .js('resources/assets/js/app.js', 'public/js')
  
  // .js('resources/assets/sass/style.scss', 'public/js')
  .js('resources/js/app.js', 'public/js')
  .version();