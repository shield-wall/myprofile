var Encore = require('@symfony/webpack-encore');

Encore
// directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    // TODO let localhost as default.
    .setPublicPath('https://assets-stage.myprofile.pro/assets')
    .setManifestKeyPrefix('build/')

    .addEntry('main', './assets/js/main.js')
    .addEntry('web_site_profile', './assets/js/profile.js')
    .addEntry('admin_profile', './assets/js/admin_profile.js')

    .addStyleEntry('exception', './assets/css/exception.scss')
    .addStyleEntry('style', './assets/css/style.scss')
    .addStyleEntry('profile', './assets/css/profile.scss')
    .addStyleEntry('web-site', './assets/css/web-site.scss')
    .addStyleEntry('curriculumBundle', './assets/css/curriculum.scss')

    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .copyFiles([
        {
            from: './assets/images',
            to: 'images/[path][name].[hash:8].[ext]',
        },
    ])

// uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })
;

module.exports = Encore.getWebpackConfig();
