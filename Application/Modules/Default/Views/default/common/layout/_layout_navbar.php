<?php
    use \Core\View as View;
    use \Core\UserIdentity as UserIdentity;
    use \Utilities\Helper as Helper;
    use \Utilities\HttpHelper as HttpHelper;
    use \Configuration\Config as Config;

?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=Config::path()->App?>"><b>Example App</b></a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php if (UserIdentity::isAuthenticated()) {?>
                     <li class="visible-xs"><a href="<?=\Utilities\HttpHelper::getUserProfileUrl()?>" title="&lt;<?=$context->userIdentity->user->Email?>&gt;"><img src="<?=$context->userIdentity->getUserPhotoUrl()?>" style="width:30px;height:30px" class="img-circle" /> <?=$context->userIdentity->user->Name?></a></li>
                     <hr class="visible-xs" style="margin:0px" />
                    <?php } ?>
                    <li class="<?=Helper::isActive($context, 'home')?>"><a href="<?=Config::path()->AppVirtual?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                    <li class="<?=Helper::isActive($context, 'about')?>"><a href="<?=Config::path()->AppVirtual?>about"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>  About</a></li>
                    <li class="<?=Helper::isActive($context, 'contact')?>"><a href="<?=Config::path()->AppVirtual?>contact"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Contact</a></li>                        
                    <?php if (UserIdentity::isAuthenticated()) {?>
                        <hr class="visible-xs" style="margin:0px" />
                        <li class="visible-xs"><a href="<?=\Utilities\HttpHelper::getUserProfileUrl()?>"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Profile</a></li>
                        <?php if (\Core\userIdentity::isInRole('admins')) { ?>
                        <hr class="visible-xs" style="margin:0px" />
                        <li class="visible-xs"><a href="<?=\Utilities\HttpHelper::getAdminControlPanelUrl()?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Admin Control Panel</a></li>
                        <li class="visible-xs"><a href="<?=\Utilities\HttpHelper::getAuditUrl()?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Audit Events</a></li>
                        <?php } ?>
                        <hr class="visible-xs" style="margin:0px" />
                        <li class="visible-xs">                                                   
                            <a href="<?=\Utilities\HttpHelper::getSignOutUrl()?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sign Out</a>
                        </li>
                    <?php } else { ?>
                        <hr class="visible-xs" style="margin:0px" />
                        <li class="visible-xs" style="margin-top:10px;margin-bottom: 3px;">
                            <div style="vertical-align: top;margin-left:15px;margin-bottom: 10px;">Sign in with:</div>
                            <a class="btn-social-icon btn-twitter" style="display:inline-block !important;margin-left:15px;color:#ccc;" href="<?=\Utilities\HttpHelper::getSocialSignInUrl('twitter')?>"><span class="fa fa-twitter"></span></a>
                            <a class="btn-social-icon btn-facebook" style="display:inline-block !important;color:#ccc;" href="<?=\Utilities\HttpHelper::getSocialSignInUrl('facebook')?>"><span class="fa fa-facebook"></span></a>
                            <a class="btn-social-icon btn-google" style="display:inline-block !important;color:#ccc;" href="<?=Utilities\HttpHelper::getSocialSignInUrl('google')?>"><span class="fa fa-google"></span></a>
                            <a class="btn-social-icon btn-yahoo" style="display:inline-block !important;color:#ccc;" href="<?=\Utilities\HttpHelper::getSocialSignInUrl('yahoo')?>"><span class="fa fa-yahoo"></span></a>
                        </li>
                        <hr class="visible-xs" style="margin:0px" />
                        <li class="visible-xs"><a href="<?=\Utilities\HttpHelper::getSingInUrl()?>"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Sign In</a></li>
                        <li class="visible-xs"><a href="<?=\Utilities\HttpHelper::getSignUp()?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign Up</a></li>
                        <li class="visible-xs"><a href="<?=\Utilities\HttpHelper::getForgotPasswordlUrl()?>"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Forgot password?</a></li>
                    <?php } ?>
                    </li>
                </ul>
                 <?php if (UserIdentity::isAuthenticated()) {?>
                <div class="btn-group pull-right-sm visible-sm visible-md visible-lg pull-right">
                    <a style="color:#888" class="btn dropdown-toggle btn button-top" data-toggle="dropdown" href="#" title="&lt;<?=$context->userIdentity->user->Email?>&gt;"><img src="<?=$context->userIdentity->getUserPhotoUrl()?>" style="width:30px;height:30px" class="img-circle" /> <?=$context->userIdentity->user->Name?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="<?=\Utilities\HttpHelper::getUserProfileUrl()?>"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Profile</a></li>
                    <?php if (\Core\userIdentity::isInRole('admins')) { ?>
                    <li class="divider"></li>
                    <li><a href="<?=\Utilities\HttpHelper::getAdminControlPanelUrl()?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Admin Control Panel</a></li>
                    <li><a href="<?=\Utilities\HttpHelper::getAuditUrl()?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Audit Events</a></li>
                    <?php } ?>
                    <li class="divider"></li>
                    <li><a href="<?=\Utilities\HttpHelper::getSignOutUrl()?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sign Out</a></li>
                </ul>
                <?php } else { ?>
                <div class="pull-right visible-sm visible-md visible-lg " style="padding-left:20px;margin-top:8px">
                    <span style="color:#777">Sign in with:&nbsp;&nbsp;</span>
                    <a class="btn btn-social-icon btn-twitter" href="<?=\Utilities\HttpHelper::getSocialSignInUrl('twitter')?>"><span class="fa fa-twitter"></span></a>
                    <a class="btn btn-social-icon btn-facebook" href="<?=\Utilities\HttpHelper::getSocialSignInUrl('facebook')?>"><span class="fa fa-facebook"></span></a>
                    <a class="btn btn-social-icon btn-google" href="<?=Utilities\HttpHelper::getSocialSignInUrl('google')?>"><span class="fa fa-google"></span></a>
                    <a class="btn btn-social-icon btn-yahoo" href="<?=\Utilities\HttpHelper::getSocialSignInUrl('yahoo')?>"><span class="fa fa-yahoo"></span></a>
                </div>
                <li class="visible-sm">
                    <div class="btn-group" style="margin-top:8px">
                        <a style="color:white" class="btn btn-info dropdown-toggle btn" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=\Utilities\HttpHelper::getSingInUrl()?>"> Sign In</a></li>
                            <li><a href="<?=\Utilities\HttpHelper::getSignUp()?>">Sign Up</a></li>
                            <li><a  href="<?=\Utilities\HttpHelper::getForgotPasswordlUrl()?>">Forgot password?</a></li>
                        </ul>
                    </div>
                </li>
                <a class="btn pull-right btn-info btn-sm visible-md visible-lg" style="margin-left:5px;margin-top:10px" href="<?=\Utilities\HttpHelper::getSingInUrl()?>">Sign In</a>
                <a class="btn pull-right btn-info btn-sm visible-md visible-lg" style="margin-left:5px;margin-top:10px" href="<?=\Utilities\HttpHelper::getSignUp()?>">Sign Up</a>
                <a class="btn pull-right btn-info btn-sm visible-md visible-lg" style="margin-left:5px;margin-top:10px" href="<?=\Utilities\HttpHelper::getForgotPasswordlUrl()?>">Forgot password?</a>
                <?php } ?>
        </div>
    </div>
</nav>
    
