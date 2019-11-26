var Encore = require('@symfony/webpack-encore');

Encore
// directory where compiled assets will be stored
    .setOutputPath('web/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('web_site', './assets/js/web_site.js')
    .addEntry('login', './assets/js/login.js')
    .addEntry('register', './assets/js/register.js')
    .addEntry('profile', './assets/js/profile.js')
    // .addEntry('curriculum_theme_01', './assets/js/curriculum_theme_01.js')
    .addEntry('exception', './assets/js/exception.js')

    .addStyleEntry('curriculum_theme_01', './assets/css/curriculum/theme_01/styles.css')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

// uncomment if you use Sass/SCSS files
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