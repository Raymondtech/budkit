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
                        <div class="navbar navbar-inverse margin-bottom">
                            <div class="navbar-inner padding-zero">
                                <ul class="nav">
                                    <li><a href="#contact"> @drstonyhills</a></li>
                                </ul>
                            </div>
                        </div>

                        <ul class="nav nav-list">
                            <li class="nav-header">Profile</li>
                            <li><a href="#">Dashboard</a></li>
                            <li class="active"><a href="#">Information</a></li>
                            <li><a href="#">Timeline <span class="badge pull-right">23</span></a></li>
                            <li><a href="#">Achievements</a></li>
                            <li><a href="#">Network</a></li>
                            <li class="nav-header">Socialize</li>
                            <li><a href="#">Messages <span class="badge badge-important pull-right">1</span></a></li>
                            <li><a href="#">Events  <span class="badge badge-important pull-right">6</span></a></li>
                            <li><a href="#">Photos</a></li>
                            <li><a href="#">Favorites</a></li>
                            <li class="nav-header">Settings</li>
                            <li><a href="#">Account</a></li>
                            <li><a href="#">System</a></li>
                            <li><a href="#">Extensions</a></li>
                            <li><a href="#">Moderation <span class="badge pull-right">3</span></a></li>
                            <li><a href="#">Experience</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </div>
                    <div class="container-right has-aside">

                        <div class="container-aside">
                            <div class="navbar navbar-inverse margin-bottom">
                                <div class="navbar-inner  padding-left-half padding-right-half">
                                    <ul class="nav">
                                        <li class="active"><a href="#"><i class="icon-home"></i></a></li>
                                        <li><a href="#about"><i class="icon-cogs"></i></a></li>
                                        <li><a href="#contact"><i class="icon-group"></i></a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <ul class="nav nav-list">
                                <li class="nav-header">Recently Online</li>
                                <li><a href="#">
                                        <i class="icon-circle" style="color: green"></i>
                                        Peter Chater
                                    </a>
                                </li>
                                <li><a href="#"><i class="icon-circle" style="color: green"></i> Tanya Vyland</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: green"></i> Joshua Fultang</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: orange"></i> Rudolf Sanchez</a></li>                  
                                <li><a href="#"><i class="icon-circle" style="color: green"></i>  Peter Rachmore</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: green"></i>  Esteban Morackash</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: red"></i>  Tatiana Menandez</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: green"></i> Sophia Young</a></li>                      
                                <li><a href="#"><i class="icon-circle" style="color: green"></i> Rita Derry</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: orange"></i> Ophelia Bains</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: red"></i> Stanislas Kopyov</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: green"></i> Bronco Cho</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: orange"></i> Feng Cheng</a></li>
                                <li><a href="#"><i class="icon-circle" style="color: red"></i> Barry Burst</a></li>
                            </ul>
                        </div>
                        <div class="container-content">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>                         
                                    <div class="nav-collapse collapse right-padding">
                                        <form class="navbar-search pull-right">
                                            <input type="text" class="search-query" placeholder="Search..." />
                                        </form>
                                    </div><!--/.nav-collapse -->
                                    <a class="topic">Here is the title of this page</a>
                                </div>
                            </div>
                            <div class="container-bucket">
                                <div class="tiles">
                                    <div class="tile2">
                                        <div id="profilepictures" class="carousel slide profilepics-carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#profilepictures" data-slide-to="0" class="active"></li>
                                                <li data-target="#profilepictures" data-slide-to="1"></li>
                                                <li data-target="#profilepictures" data-slide-to="2"></li>
                                            </ol>
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                                <div class="active item"><img src="http://placeskull.com/390/585/7E2217" /></div>
                                                <div class="item"><img src="http://placeskull.com/390/585/8F2217" /></div>
                                                <div class="item"><img src="http://placeskull.com/390/585/ff4500" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tile1" style="background: orange"></div>
                                    <div class="tile1" style="background: red"></div>
                                    <div class="tile1" style="background: mediumseagreen"></div>
                                    <div class="tile1" style="background: purple"></div>
                                    <div class="tile1" style="background: green"></div>
                                    <div class="tile1" style="background: chocolate"></div>
                                    <div class="tile1" style="background: blue"></div>
                                    <div class="tile1" style="background: red"></div>
                                    <div class="tile1" style="background: mediumseagreen"></div>
                                    <div class="tile1" style="background: purple"></div>
                                    <div class="tile1" style="background: green"></div>
                                    <div class="tile1" style="background: chocolate"></div>
                                    <div class="tile1" style="background: blue"></div>
                                    <div class="tile1" style="background: green"></div>
                                    <div class="tile1" style="background: chocolate"></div>
                                    <div class="tile1" style="background: blue"></div>
                                    <div class="tile1" style="background: red"></div>
                                    <div class="tile1" style="background: mediumseagreen"></div>
                                    <div class="tile1" style="background: red"></div>
                                    <div class="tile1" style="background: mediumseagreen"></div>
                                    <div class="tile1" style="background: purple"></div>
                                    <div class="tile1" style="background: green"></div>
                                    <div class="tile1" style="background: chocolate"></div>
                                    <div class="tile1" style="background: blue"></div>
                                    <div class="tile1" style="background: olive"></div>

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
