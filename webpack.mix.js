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

mix.less('resources/assets/less/admin/admin.less', 'public/css/admin.css')
    .scripts([
        'resources/assets/components/library/jquery/jquery.min.js',
        'resources/assets/components/library/jquery-ui/js/jquery-ui.min.js',
        'resources/assets/components/plugins/ajaxify/script.min.js',
        'resources/assets/components/library/modernizr/modernizr.js',
        'resources/assets/components/library/bootstrap/js/bootstrap.min.js',
        'resources/assets/components/library/jquery/jquery-migrate.min.js',
        'resources/assets/components/plugins/nicescroll/jquery.nicescroll.min.js',
        'resources/assets/components/plugins/breakpoints/breakpoints.js',
        'resources/assets/components/plugins/ajaxify/davis.min.js',
        'resources/assets/components/plugins/ajaxify/jquery.lazyjaxdavis.min.js',
        'resources/assets/components/plugins/preload/pace/pace.min.js',
        'resources/assets/components/plugins/moment/moment.js',
        'resources/assets/components/modules/admin/modals/assets/js/bootbox.min.js',
        'resources/assets/components/plugins/less-js/less.min.js',
        'resources/assets/components/core/js/preload.pace.init.js',
        'resources/assets/components/core/js/sidebar.main.init.js',
        'resources/assets/components/core/js/sidebar.collapse.init.js',
        'resources/assets/components/core/js/sidebar.kis.init.js',
        'resources/assets/components/core/js/core.init.js',
        'resources/assets/components/core/js/animations.init.js',
        'resources/assets/components/core/js/hack768-1024.js',
        'resources/assets/components/core/js/ajaxHeader.js',
        'resources/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.min.js',
        'resources/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/additional-methods.min.js',
        'resources/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.form.js',
        'resources/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/validaciones.js',
        'resources/assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js',
        'resources/assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/locales/bootstrap-datepicker.es.js',
        'resources/assets/components/common/forms/elements/select2/assets/lib/js/select2.js',
        'resources/assets/components/common/forms/elements/fuelux-radio/fuelux-radio.js',
        'resources/assets/components/common/forms/elements/fuelux-checkbox/fuelux-checkbox.js',
        'resources/assets/components/modules/admin/modals/assets/js/source/jquery.fancybox.js',
        'resources/assets/components/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',
        'resources/assets/components/modules/admin/calendar/assets/lib/js/fullcalendar.min.js',
        'resources/assets/components/common/gallery/image-crop/assets/lib/js/jquery.Jcrop.js',
        'resources/assets/components/common/tables/datatables/DataTables-1.10.12/media/js/jquery.dataTables.min.js',
        'resources/assets/components/common/tables/datatables/DataTables-1.10.12/media/js/dataTables.bootstrap.min.js',
        'resources/assets/components/common/forms/ajax.js',
        'resources/assets/components/common/forms/validaciones.js'
    ], 'public/js/base-scripts.js')
    .styles([
        'resources/assets/components/library/bootstrap/css/bootstrap.min.css',
        'resources/assets/components/modules/admin/modals/assets/js/source/jquery.fancybox.css',
        'resources/assets/components/library/icons/fontawesome/assets/css/font-awesome.min.css',
        'resources/assets/components/library/icons/glyphicons/assets/css/glyphicons_filetypes.css',
        'resources/assets/components/library/icons/glyphicons/assets/css/glyphicons_regular.css',
        'resources/assets/components/library/icons/glyphicons/assets/css/glyphicons_social.css',
        'resources/assets/components/library/jquery-ui/css/jquery-ui.min.css',
        'resources/assets/components/modules/admin/notifications/gritter/assets/lib/css/jquery.gritter.css',
        'resources/assets/components/modules/admin/notifications/notyfy/assets/lib/css/jquery.notyfy.css',
        'resources/assets/components/modules/admin/notifications/notyfy/assets/lib/css/notyfy.theme.default.css',
        'resources/assets/components/modules/admin/page-tour/assets/css/pageguide.css',
        'resources/assets/components/plugins/prettyprint/assets/css/prettify.css',
        'resources/assets/components/library/animate/animate.min.css',
        'resources/assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/css/bootstrap-datepicker.css',
        'resources/assets/components/common/forms/elements/select2/assets/lib/css/select2.css',
        'resources/assets/components/modules/admin/calendar/assets/lib/css/fullcalendar.css',
        'resources/assets/components/common/gallery/image-crop/assets/lib/css/jquery.Jcrop.css',
        'resources/assets/components/library/icons/pictoicons/css/picto.css',
        'resources/assets/components/library/icons/pictoicons/css/picto-foundry-general.css',
        ], 'public/css/base-styles.css')
    .copy([
        'resources/assets/components/library/icons/fontawesome/assets/fonts',
        'resources/assets/components/library/icons/glyphicons/assets/fonts',
        'resources/assets/components/library/icons/pictoicons/fonts',
        'resources/assets/components/core/fonts/',
    ], 'public/fonts')
    .copy([
        'resources/assets/components/common/gallery/image-crop/assets/lib/css/Jcrop.gif',
        'resources/assets/components/common/forms/elements/select2/assets/lib/css/select2.png',
        'resources/assets/components/common/forms/elements/select2/assets/lib/css/select2-spinner.gif',
        'resources/assets/components/common/forms/elements/select2/assets/lib/css/select2x2.png'
    ], 'public/css')
    .copy([
        'resources/assets/img/'
    ], 'public/img');