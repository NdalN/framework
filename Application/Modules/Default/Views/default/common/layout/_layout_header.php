<?php 
    use \Core\View as View;
    use \Utilities\Helper as Helper;
    use \Utilities\HttpHelper as HttpHelper;
    use \Configuration\Config as Config;

?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?=Config::path()->Content?>content/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=Config::path()->Content?>content/themes/<?=Config::generalProperties()->Theme?>/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=Config::path()->Content?>content/scripts/plugins/bootstrap3-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=Config::path()->Content?>content/scripts/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="<?=Config::path()->Content?>content/scripts/plugins/jquery/jquery-ui.1.11.2.custom.min.js" type="text/javascript"></script>
    
    <link href="<?=Config::path()->Content?>content/bootstrap-social/assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?=Config::path()->Content?>content/bootstrap-social/bootstrap-social.css" rel="stylesheet"> 

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
