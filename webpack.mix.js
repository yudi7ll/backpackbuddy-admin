const mix = require("laravel-mix");
const fs = require("fs");

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
    hmrOptions: {
        host: "localhost",
        port: 443
    }
});

mix.webpackConfig({
    devServer: {
        https: {
            key: fs.readFileSync("nginx/localhost-key.pem"),
            cert: fs.readFileSync("nginx/localhost.pem")
        }
    }
});

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .browserSync("https://localhost");
