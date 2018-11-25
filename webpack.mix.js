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

mix.js(['resources/assets/frontend/js/app.js'], 'public/js')
   .sass('resources/assets/frontend/sass/app.scss', 'public/css', {
    precision: 5
    })
    mix.webpackConfig({
        output: {
            publicPath: "http://localhost:8080/", // Development Server
            // publicPath: "http://example.com/", // Production Server
          }
    })
    ;
    if (mix.config.inProduction) {
        mix.version();
     }
