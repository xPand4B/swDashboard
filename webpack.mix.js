const mix = require('laravel-mix');

/**
 * --------------------------------------------------------------------------
 * | Application
 * --------------------------------------------------------------------------
 */
mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

/**
 * --------------------------------------------------------------------------
 * | Configuration Stuff
 * --------------------------------------------------------------------------
 */
if (mix.inProduction()) {
    mix.version();
    mix.sourceMaps();
}

mix.setPublicPath('public');
mix.setResourceRoot('../');
