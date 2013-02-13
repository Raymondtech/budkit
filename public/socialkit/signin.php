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
            <!--            <div class="wrap">
                            <div class="container navbar canvas" style="width: 135px; margin: auto">
                                <a class="brand logo" href="/">Budkit</a>
                            </div>
                            <div class="container mini top-pad">
            
            
                                <tpl:block data="page.block.banner">Banner</tpl:block>
                                <tpl:block data="page.block.alerts" /> 
                                <section class="layout-block boxed box-padding">
            
                                    <form id="form" name="login_form" method="post" action="/member/session/start">                       
                                        <fieldset class="no-margin">
                                            <legend tpl:i18n="">Sign in to your account</legend>
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
            
                                        </fieldset>
            
                                        <div class="btn-toolbar top-pad">
                                            <div class="row-fluid">
                                                <button type="submit" class="btn btn-success span4" tpl:i18n="">Sign in</button> 
                                                <button type="submit" class="btn span4 btn-facebook" tpl:i18n="">Facebook</button> 
                                                <button type="submit" class="btn span4 btn-twitter" tpl:i18n="">Twitter</button>
                                            </div>
                                        </div>
                                        <hr />
                                        <input type="hidden" name="auth_handler" value="dbauth" />
                                        <input type="hidden" name="redirect" value="" />
                                        <ul class="top-pad">
                                            <li><a href="/index.php" tpl:i18n="">Alternative ways to sign in</a></li>
                                            <li><a href="/index.php" tpl:i18n="">Forgot your password?</a></li>
                                            <li><a href="/member/account/create" tpl:i18n="">Don't have an account?</a></li>
                                        </ul>
                                    </form>
                                    <tpl:block data="page.block.body" />    
                                </section>
                                <section role="footer"> 
                                    <tpl:block data="page.block.footer">Footer</tpl:block>                
                                </section>
                            </div>
                        </div>-->

            <div id="wrap">
                <div class="container-box">

                    <div class="container-right">


                        <div class="container-content">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>                         
                                    <div class="nav-collapse collapse">
                                        <form class="form-inline form-horizontal pull-right" name="login_form" method="post" action="/member/session/start">
                                            <div class="row-fluid">
                                                <input type="text" id="user_name_id" name="user_name_id" class="input-large" placeholder="Email or Username" />
                                                <input type="password" class="input-large" id="user_password" name="user_password" placeholder="Password or API Key" />
                                                <input type="hidden" name="auth_handler" value="dbauth" />
                                                <input type="hidden" name="redirect" value="" />
                                                <button type="submit" class="btn">Sign in</button>
                                            </div>
                                            <div class="row-fluid">
                                                <label class="checkbox">
                                                    <input type="checkbox" /> Remember me
                                                </label>
                                            </div>
                                        </form>
                                    </div><!--/.nav-collapse -->
                                    <a class="topic">Sign In</a>
                                </div>
                            </div>
                            <div class="container-bucket">
                                SignUpForm
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

