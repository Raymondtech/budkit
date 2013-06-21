<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title><tpl:element type="text" data="page.title">Sign In</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
            <tpl:utility type="head" />
        </head>
        <body>
            <div id="wrap">

                <div class="container-box">
                    <div class="container-right">
                        <div align="center"><tpl:block data="page.block.alerts" /></div>
                        <div class="container-content scroll-y">
                            <div class="container-fluid">
                                <div class="container">
                                    <div class="container-startup signin">

                                        <div class="startup-body"> 
                                            <form id="form" name="login_form" method="post" class="margin-bottom-zero" action="/system/authenticate/login">  
                                                <tpl:condition data="alternatives" test="isset" value="1">
                                                    <div class="control-group">
                                                        <span class="help-block margin-bottom-half">Sign In with..</span>
                                                        <div class="controls row-fluid margin-bottom">
                                                            <tpl:loop data="alternatives" id="login-alt">
                                                                <tpl:condition data="link" test="isset" value="1">
                                                                    <a href="${link}" class="btn btn-${uid} btn-medium margin-bottom-half span6"><tpl:element type="text" data="title" /></a>
                                                                </tpl:condition>
                                                            </tpl:loop>
                                                        </div>
                                                    </div>
<!--                                                    <hr />-->
                                                </tpl:condition>

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
                                                <ul class="unstyled margin-top margin-bottom-zero nav nav-pills">

                                                    <li class="pull-right"><a href="/index.php">Forgot your password?</a></li>
                                                    <li>
                                                        <button type="submit" class="btn margin-bottom-zero" >Sign In</button>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="handler" value="dbauth" />
                                                <input type="hidden" name="redirect" value="${lasturl}" />

                                                <div class="clearfix">                                                  

                                                </div>
                                            </form>
                                        </div>
                                        <tpl:condition test="boolean" data="config|general.site-allow-registration" value="1">
                                            <div class="startup-alternatives bottom">
                                                <ul class="unstyled no-margin">
                                                    <li><a href="/system/authenticate/create">Don't have an account?</a></li>
                                                </ul>
                                            </div>
                                        </tpl:condition>
                                    </div>
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

