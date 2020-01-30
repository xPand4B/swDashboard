const mix = require('laravel-mix');

// module.exports = {
//     optimization: {
//         splitChunks: {
//             chunks: 'all'
//         }
//     }
// };

mix
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/svgs', 'public/svgs')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/sprites', 'public/sprites')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
