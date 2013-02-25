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
            <!-- jQuery here because if placed at bottom, in-line scripts (i.e script tags in .tpl files) won't work -->
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/jquery.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/budkit.js"></script>
        </head>
        <body>
            <div id="wrap">
                <div class="container-menu-box">
                    <div class="navbar margin-bottom-zero nav-home-page">
                        <div class="navbar-inner padding-zero no-margin">
                            <ul class="nav no-margin">
                                <li><a href="/" class="nav-home-page-link"><i class="icon-home"></i></a></li>  
                            </ul>
                        </div>
                    </div>
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
                        <ul class="nav nav-stacked nav-menugroups no-margin" id="menutabs">
                            <li class="active"><a data-target="#dashboardmenuview" data-toggle="tab"><i class="icon-dashboard"></i><small>Dashboard</small></a></li>  
                            <li><a data-target="#favouritesmenuview" data-toggle="tab"><i class="icon-heart"></i><small>Media</small></a></li>   
                            <li><a data-target="#messagesmenuview" data-toggle="tab"><i class="icon-comments-alt"></i><small>Messages</small></a></li>                                                   
                            <li><a data-target="#settingsmenuview" data-toggle="tab"><i class="icon-cogs"></i><small>Settings</small></a></li>                            
                            <li><a data-target="#peoplemenuview" data-toggle="tab"><i class="icon-group"></i><small>People</small></a></li>     <!--Use  class="highlighted" on new notifications-->
                            <li><a href="/member/session/stop"><i class="icon-signout"></i><small>Sign Out</small></a></li>
                        </ul>
                    </tpl:condition>
                    <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
                        <ul class="nav nav-stacked nav-menugroups no-margin"> 
                            <li><a href="/member/session/start"><i class="icon-signin"></i><small>Sign In</small></a></li>
                        </ul> 
                    </tpl:condition> 
                </div>
                <div class="container-box has-left has-menu-box">
                    <div class="container-left">                 
                        <tpl:import layout="sidebar" />
                    </div>
                    <div class="container-right has-aside">
                        <div class="container-aside">
                            <tpl:import layout="asidebar" />
                        </div>
                        <div class="container-content">
                            <tpl:import layout="navbar" />
                            <div class="container-bucket">
                                <tpl:block data="page.block.alerts" /> 
                                <tpl:block data="page.block.body">Content</tpl:block>
                            </div>
                            <a href="#" class="container-box-toggle toggler" data-toggle="container-left"><i class="icon-chevron-left"></i></a>
                            <a href="#" class="container-right-toggle toggler" data-toggle="container-aside"><i class="icon-chevron-right"></i></a>
                        </div>
                    </div>
                </div><!--/.fluid-container-->
            </div>
            <!-- Le javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-transition.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-alert.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-modal.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/budkit-container.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/budkit-mediagrid.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-dropdown.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-scrollspy.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-tab.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-affix.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-tooltip.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-popover.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-button.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-collapse.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-carousel.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>
