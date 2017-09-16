<?php
use \Core\View as View;
use \Configuration\Config as Config;

?>

<!DOCTYPE html>
<html lang="en">
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
    <link href="<?=Config::path()->Content?>content/themes/"<?=Config::generalProperties()->Theme?>"/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=Config::path()->Content?>content/scripts/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="<?=Config::path()->Content?>content/scripts/plugins/jquery/jquery-ui.1.11.2.custom.min.js" type="text/javascript"></script>

    <link runat="server" rel="shortcut icon" href="<?=Config::path()->Content?>content/images/favicon.ico" type="image/x-icon" />
    <link runat="server" rel="icon" href="<?=Config::path()->Content?>content/images/favicon.ico" type="image/ico" />

    <style type="text/css"></style>
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
    <script type="text/javascript">   
    </script>
  </body>
</html>
