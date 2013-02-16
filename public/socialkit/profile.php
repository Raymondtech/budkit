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
                <div class="container-box has-left">
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
                                <div class="tiles">
                                    <div class="tile1">
                                        <div class="row-fluid">
                                            <div class="profile-avatar bottom-pad">
                                                <a href="/member/profile/view">
                                                    <img  src="http://placeskull.com/170/170/<?php echo \Platform\Framework::getRandomColor() ?>" width="170" height="170" />
                                                </a>
                                            </div>
                                            <ul class="page-info unstyled bottom-pad">
                                                <li class="signup-date">Member since 10 months ago</li>
                                                <li class="signin-date">Last logged in 6 days ago</li>
                                                <!-- Date of Birth -->
                                                <li class="company-element">Born on the <a href="#">14th of March</a></li>
                                                <!-- Contact Information -->
                                                <li class="company-element">Works at <a href="#">Stonyhills LLC</a></li>
                                                <li class="email-element"><a href="mailto:livingstonefultang@gmail.com">livingstonefultang@gmail.com</a></li>
                                                <!--CUSTOM SOCIAL INFORMATION-->
                                            </ul>

                                            <tpl:menu id="profilemenu" type="nav-block" />
                                            <div class="widget top-pad">
                                                <h4 tpl:i18n="">Badges and Rewards</h4> 
                                                <div class="widget-body top-pad">
                                                    <ul class="thumbnails">
                                                        <?php for ($i = 0; $i < 12; $i++): ?>
                                                            <li>
                                                                <a href="#">
                                                                    <img class="thumbnail" src="http://placeskull.com/170/170/<?php echo \Platform\Framework::getRandomColor() ?>" alt="" width="32" height="32" />
                                                                </a>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </div>
                                                <hr />
                                            </div>
                                            <div class="widget">
                                                <h4>Followers</h4> 
                                                <div class="widget-body top-pad">

                                                    <ul class="thumbnails">
                                                        <?php for ($i = 0; $i < 12; $i++): ?>
                                                            <li>
                                                                <a href="#">
                                                                    <img class="thumbnail" src="http://placeskull.com/170/170/<?php echo \Platform\Framework::getRandomColor() ?>" alt="" width="32" height="32" />
                                                                </a>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </div>
                                                <hr />
                                            </div>
                                            <div class="widget">
                                                <h4>Following</h4> 
                                                <div class="widget-body top-pad">
                                                    <ul class="thumbnails">
                                                        <?php for ($i = 0; $i < 12; $i++): ?>
                                                            <li>
                                                                <a href="#">
                                                                    <img class="thumbnail" src="http://placeskull.com/170/170/<?php echo \Platform\Framework::getRandomColor() ?>" alt="" width="32" height="32" />
                                                                </a>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tile4">
                                        <tpl:block data="page.block.body">Content</tpl:block>
                                    </div>
                                </div>
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
