<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta charset="utf-8"/>
            <title><tpl:element type="text" data="page.title">SocialKit</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="<?php echo $this->getPageDescription(); ?>" />
            <meta name="author" content="<?php echo $this->getPageAuthor(); ?>" />
            <meta name="keywords" content="<?php echo $this->getPageAuthor(); ?>" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <!-- Le styles -->
            <link href="<?php echo $this->getTemplatePath() ?>/assets/css/bootstrap.css" rel="stylesheet" />
            <link href="<?php echo $this->getTemplatePath() ?>/assets/css/bootstrap-responsive.css" rel="stylesheet" />

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="<?php echo $this->getTemplatePath() ?>/assets/js/html5shiv.js"></script>
            <![endif]-->

            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->getTemplatePath() ?>/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->getTemplatePath() ?>/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->getTemplatePath() ?>/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="<?php echo $this->getTemplatePath() ?>/assets/ico/apple-touch-icon-57-precomposed.png" />
            <link rel="shortcut icon" href="<?php echo $this->getTemplatePath() ?>/assets/ico/favicon.png" />
        </head>
        <body>
            <div id="wrap">
                <tpl:import layout="navbar" />
                <div class="container-box">
                    <div class="container-right">
                        <div class="container-content scroll-y">
                            <div class="container-fluid">
                                <div class="container">
                                    <form id="form" name="login_form" method="post" action="/system/authenticate/login">                       
                                        <div class="container-startup signin">
                                            <div class="startup-header">
                                                <h3>Sign in to your account</h3>
                                            </div>
                                            <tpl:block data="page.block.alerts" />
                                            <div class="startup-alternatives">
                                                <ul class="unstyled no-margin no-bottom-margin">
                                                    <li><a href="/system/authenticate/create">Don't have an account?</a></li>
                                                </ul>
                                            </div>
                                            <div class="startup-body">                                               
                                                <div class="control-group">
                                                    <label class="control-label" for="user_name_id"><?php echo _('Registered Username or Email'); ?><em class="mandatory">*</em></label>
                                                    <div class="controls row-fluid">
                                                        <input class="input-xxxlarge focused span12" id="user_name_id" name="user_name_id" type="text" placeholder="JohnDoe1976" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="user_password"><tpl:i18n>Password or API Key</tpl:i18n><em class="mandatory">*</em></label>
                                                    <div class="controls row-fluid">
                                                        <input class="input-xxxlarge focused span12" id="user_password" name="user_password" type="password" />
                                                    </div>
                                                </div>
                                                <ul class="unstyled">
                                                    <li><a href="/index.php">Forgot your password?</a></li>
                                                </ul>
                                                <input type="hidden" name="auth_handler" value="dbauth" />
                                                <input type="hidden" name="redirect" value="" />

                                                <div class="margin-bottom">                                                  
                                                       <button type="submit" class="btn margin-top margin-bottom input-xxxlarge" >Sign-in to Account</button> 
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.fluid-container-->
            </div>
            <!-- Le javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/jquery.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-transition.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-alert.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-modal.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/budkit-container.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-dropdown.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-scrollspy.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-tab.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-tooltip.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-popover.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-button.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-collapse.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-carousel.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>

