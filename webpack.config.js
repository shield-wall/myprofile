var Encore = require('@symfony/webpack-encore');

Encore
// directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')

    .addEntry('app', './assets/js/app.js')
    .addEntry('web_site', './assets/js/web_site.js')
    .addEntry('web_site_profile', './assets/js/profile.js')
    .addEntry('login', './assets/js/login.js')
    .addEntry('curriculum_theme_01', './assets/js/curriculum_theme_01.js')
    .addEntry('exception', './assets/js/exception.js')
    .addEntry('request-style', './assets/js/request-style.js')
    .addEntry('reset-password', './assets/js/reset-password.js')

    .addStyleEntry('style', './assets/css/style.scss')
    .addStyleEntry('profile', './assets/css/profile.scss')

    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .copyFiles([
        { from: './assets/images', to: 'images/[path][name].[ext]',},
    ])
    .configureFilenames({
        images: '[path][name].[hash:8].[ext]',
    })

// uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })
;

module.exports = Encore.getWebpackConfig();
