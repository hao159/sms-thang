<?php
/**
 * template_start.php
 *
 * Author: pixelcave
 *
 * The first block of code used in every page of the template
 *
 */
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php echo $template['active_name'] .' | '. $template['title'] ?></title>

        <meta name="description" content="<?php echo $template['description'] ?>">
        <meta name="author" content="<?php echo $template['author'] ?>">
        <meta name="robots" content="<?php echo $template['robots'] ?>">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?= base_url() ?>public/img/favicon.ico" type="image/x-icon" />
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="/public/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="/public/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="/public/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        <?php if ($template['theme']) { ?><link id="theme-link" rel="stylesheet" href="/public/css/themes/<?php echo $template['theme']; ?>.css"><?php } ?>

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="/public/css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (enables responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="/public/js/vendor/modernizr-respond.min.js"></script>
        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="/public/js/vendor/jquery-1.11.3.min.js"></script>
        <script src="/public/js/vendor/bootstrap.min.js"></script>
        <script src="/public/js/vendor/sweetalert2010.js"></script>
        <script src="/public/js/plugins.js"></script>
        <script src="/public/js/helpers/utils.js?ver=1.2.1"></script>
        <script src="/public/js/app.js?ver=1.2.1"></script>

        <!-- Style and script of Kendo -->
        <link rel="stylesheet" href="/public/css/kendo.common.min.css">
        <link rel="stylesheet" href="/public/css/kendo.bootstrap.min.css">
        <link rel="stylesheet" href="/public/css/kendo.common-bootstrap.min.css">
        <link rel="stylesheet" href="/public/css/kendo.bootstrap.mobile.min.css">
        <script src="/public/js/vendor/kendo.all.min.js"></script>
        <script src="/public/js/vendor/kendo.messages.vi-VN.min.js"></script>
        <script src="/public/js/vendor/kendo.culture.vi-VN.min.js"></script>
        <script src="/public/js/vendor/jszip.min.js"></script>
        <script type="text/javascript">
            $('#page-wrapper').addClass('page-loading');
            setTimeout(function () {
                $('#page-wrapper').removeClass('page-loading');
            }, 3000);
        </script>
    </head>
    <body>
