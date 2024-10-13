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
        <link rel="shortcut icon" href="<?= base_url() ?>public/img/favicon.png">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?= base_url() ?>public/img/icon180.png" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?= base_url() ?>public/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?= base_url() ?>public/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        <?php if ($template['theme']) { ?><link id="theme-link" rel="stylesheet" href="<?= base_url() ?>public/css/themes/<?php echo $template['theme']; ?>.css"><?php } ?>

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?= base_url() ?>public/css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (enables responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="<?= base_url() ?>/public/js/vendor/modernizr-respond.min.js"></script>
        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="<?= base_url() ?>/public/js/vendor/jquery-1.11.3.min.js"></script>
        <script src="<?= base_url() ?>/public/js/vendor/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>/public/js/vendor/sweetalert2010.js"></script>
        <script src="<?= base_url() ?>/public/js/plugins.js"></script>
        <script src="<?= base_url() ?>/public/js/app.js"></script>

        <!-- Style and script of Kendo -->
        <link rel="stylesheet" href="<?= base_url() ?>public/css/kendo.common.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>public/css/kendo.bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>public/css/kendo.common-bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>public/css/kendo.bootstrap.mobile.min.css">
        <script src="<?= base_url() ?>/public/js/vendor/kendo.all.min.js"></script>
        <script src="<?= base_url() ?>/public/js/vendor/jszip.min.js"></script>
        <script type="text/javascript">
            $('#page-wrapper').addClass('page-loading');
            setTimeout(function () {
                $('#page-wrapper').removeClass('page-loading');
            }, 3000);
        </script>
        <style type="text/css">
            .backgroud-error{
                /*background: rgb(180,170,58);*/
                /*background-image: linear-gradient(to right top, #6891f0, #6d95ef, #739aed, #789eec, #7ea2ea, #76acf0, #6eb6f5, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1);*/
            }
        </style>
    </head>
    <body class="backgroud-error">