const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.config.hmr) {
    mix.webpackConfig({
        output: {
            chunkFilename: '[name].js',
        }
    });
} else {
    mix.webpackConfig({
        output: {
            publicPath: '/',
            chunkFilename: '[name].[chunkhash].js',
        }
    });
}

mix.setPublicPath('public');
mix.setResourceRoot('../');
