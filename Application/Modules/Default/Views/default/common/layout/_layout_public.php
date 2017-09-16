<?php
    use \Core\View as View;
    use \Configuration\Config as Config;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
  <head>
    <meta charset="utf-8">
    <title>Roles & Users</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?=Config::path()->Content?>content/style.public.css" rel="stylesheet" type="text/css" />
    <link href="<?=Config::path()->Content?>content/themes/<?=Config::generalProperties()->Theme?>/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=Config::path()->Content?>content/scripts/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="<?=Config::path()->Content?>content/scripts/plugins/jquery/jquery-ui.1.11.2.custom.min.js" type="text/javascript"></script>

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

  </head>

  <body>

    <div class="">
      <div class="">        
            <!-- Page layout body position -->
            <?php View::renderView($body, $model, $context) ?>
      </div><!--/row-->
    </div><!--/.fluid-container-->

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-xs-12" style="text-align:center">
                <p>© Company 2016 User Roles Management Tool  <span class="muted">Version: 1.0</span></p>
            </div>
        </div>
    </div>
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->   

    <script src="<?=Config::path()->Content?>content/scripts/plugins/bootstrap.3.3.7/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=Config::path()->Content?>content/scripts/plugins/bootstrap3-dialog/js/bootstrap-dialog.min.js" type="text/javascript"></script>
    <script src="<?=Config::path()->Content?>content/scripts/app.js" type="text/javascript"></script>
  </body>
</html>
