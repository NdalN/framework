<?php 
    use \Core\View as View;
    use \Utilities\Helper as Helper;
    use \Utilities\HttpHelper as HttpHelper;
    use \Configuration\Config as Config;
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>makemakecode | User Roles Advanced Example</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="User Roles Advanced Example, simple User Management Tool is helping to protect your PHP sites. The User Roles application performs users and roles management and helps to support Single Sign On (SSO) concept."/>
        <meta name="author" content="MakeMakeCode">
        <link rel="canonical" href="http://www.makemakecode.com" />

        <meta property="og:url" content="http://www.makemakecode.com">
        <meta property="og:title" content="Simple User Management Tool is helping to protect your PHP sites">
        <meta property="og:description" content="User Roles Advanced Example. User Roles Advanced Example. The User Roles application performs users and roles management and helps to support Single Sign On (SSO) concept.">
        <meta property="og:image" content="content/images/images/favicons/android-chrome-192x192.png">
        
        <link rel="apple-touch-icon" sizes="57x57" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=Config::path()->Content?>content/images/favicons/default/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="<?=Config::path()->Content?>content/images/favicons/default/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?=Config::path()->Content?>content/images/favicons/default/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="<?=Config::path()->Content?>content/images/favicons/default/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?=Config::path()->Content?>content/images/favicons/default/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?=Config::path()->Content?>content/images/favicons/default/manifest.json">
        <link rel="mask-icon" href="<?=Config::path()->Content?>content/images/favicons/default/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="<?=Config::path()->Content?>content/images/favicons/default/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="/content/images/favicons/default/mstile-144x144.png">
        <meta name="msapplication-config" content="/content/images/favicons/default/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

        <?php View::renderView('common/layout/_layout_header.php', $model, $context) ?>
    </head>    
    <body data-spy="scroll" data-target=".subnav" data-offset="50">        
        <!-- Page layout header position -->
        <?php View::renderView('common/layout/_layout_navbar.php', $model, $context) ?>
        <div class="wrapper">
            <div class="container">

                <!-- Page layout body position -->
                <?php View::renderView($body, $model, $context) ?>

            </div><!--/.fluid-container-->
            <div class="push"><!--//--></div>
        </div>
        <!-- Page layout position -->
        <?php View::renderView('common/layout/_layout_footer.php', $model, $context) ?>
        <script src="<?=Config::path()->Content?>content/scripts/app.js" type="text/javascript"></script>
    </body>
</html>