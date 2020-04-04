var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('js/custom', './build/js/custom.js')
    .addStyleEntry('css/custom', ['./build/css/custom.css'])
    .addStyleEntry('css/bootstrap', ['./build/css/bootstrap.css'])
// .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
