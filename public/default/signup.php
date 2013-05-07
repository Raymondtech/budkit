<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title><tpl:element type="text" data="page.title">Create New Account</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="${page.description}" />
            <meta name="author" content="${page.author}" />
            <meta name="keywords" content="${page.author}" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <!-- Le styles -->
            <link href="/${config|design.template}/assets/css/bootstrap.css" rel="stylesheet" />
            <link href="/${config|design.template}/assets/css/bootstrap-responsive.css" rel="stylesheet" />
            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="/${config|design.template}/assets/js/html5shiv.js"></script>
            <![endif]-->
            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/${config|design.template}/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/${config|design.template}/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/${config|design.template}/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="/${config|design.template}/assets/ico/apple-touch-icon-57-precomposed.png" />
            <link rel="shortcut icon" href="/${config|design.template}/assets/ico/favicon.png" />
            <tpl:output type="head" />
        </head>
        <body>
            <div id="wrap">                
                <div class="container-box">
                    <div class="container-right">
                        <div class="container-content scroll-y">
                            <div class="container-fluid">
                                <div class="container-startup signup">
                                    <form class="form-horizontal" name="form" method="post" action="/sign-up">
                                        <!--                                        <div class="startup-header">
                                                                                    <h3>Register a new account</h3>
                                                                                </div>-->
                                        <tpl:block data="page.block.alerts" />
                                        <div class="startup-alternatives">
                                            <ul class="unstyled no-margin no-bottom-margin">
                                                <li><a href="/system/authenticate/login">Already have an account? Sign-in</a></li>
                                            </ul>
                                        </div>                                      
                                        <div class="startup-body">
                                            <div class="control-group">
                                                <label class="control-label" for="user_first_name"><tpl:i18n>First Name</tpl:i18n><em class="mandatory">*</em></label>
                                                <div class="controls">
                                                    <input class="input-large focused" id="first_name" name="user_first_name" type="text" placeholder="First Name" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="user_last_name"><tpl:i18n>Last Name</tpl:i18n><em class="mandatory">*</em></label>
                                                <div class="controls">
                                                    <input class="input-large focused" id="last_name" name="user_last_name" type="text" placeholder="Last Name" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="user_name_id"><tpl:i18n>Unique Username</tpl:i18n><em class="mandatory">*</em></label>
                                                <div class="controls">
                                                    <input class="input-large focused" id="user_name_id" name="user_name_id" type="text" placeholder="JohnDoe1976" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="user_email"><tpl:i18n>Email address</tpl:i18n><em class="mandatory">*</em></label>
                                                <div class="controls">
                                                    <input class="input-large focused" id="user_email" name="user_email" type="text" placeholder="<?php echo _('e.g john.doe@example.com'); ?>" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="user_password"><tpl:i18n>Password</tpl:i18n><em class="mandatory">*</em></label>
                                                <div class="controls">
                                                    <input class="input-large focused" id="user_password" name="user_password" type="password" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="user_password_2"><tpl:i18n>Verify Password</tpl:i18n><em class="mandatory">*</em></label>
                                                <div class="controls">
                                                    <input class="input-large focused" id="user_password_2" name="user_password_2" type="password" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="user_accepted_terms" value="1" />
                                                        You agree to our <a href="#">terms and conditions</a>
                                                    </label>
                                                    <input type="hidden" name="user_accepted_terms_2" value="2" />                                                      
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn">Create an Account</button> 
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
            <script src="/${config|design.template}/assets/js/jquery.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-transition.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-alert.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-modal.js"></script>
            <script src="/${config|design.template}/assets/js/budkit-container.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-dropdown.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-scrollspy.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tab.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tooltip.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-popover.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-button.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-collapse.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-carousel.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>

