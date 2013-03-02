<tpl:layout xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta charset="utf-8"/>
            <title><tpl:element type="text" data="page.title">SocialKit</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <meta name="keywords" content="" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <!-- Le styles -->
            <link href="/${config|general.template}/themes/${config|profile.theme}/style.css" rel="stylesheet" />
<!--            <link href="/${config|general.template}/assets/css/bootstrap-responsive.css" rel="stylesheet" />-->

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="<?php echo $this->getTemplatePath() ?>/assets/js/html5shiv.js"></script>
            <![endif]-->

            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/${config|general.template}/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/${config|general.template}/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/${config|general.template}/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="/${config|general.template}/assets/ico/apple-touch-icon-57-precomposed.png" />
            <link rel="shortcut icon" href="/${config|general.template}/assets/ico/favicon.png" />
        </head>
        <body>
            <div class="navbar navbar-inverse">
                <div class="navbar-inner">
                    <div class="container" style="width: 940px;">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        
                        <div class="nav-collapse">
                            <tpl:menu id="profilemenu" type="nav"></tpl:menu>
                            
                            <ul class="nav pull-right">
                                <li><a href="/system/start/index">Dashboard</a></li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </div>
                </div><!-- /navbar-inner -->
            </div>
            <div class="container">
        
                <tpl:block data="page.block.alerts" /> 
                
                <div class="jumbotron">
                    <h1 >Livingstone Fultang</h1>
                    <p class="lead">PhD Student in the Medical Molecular Biosciences</p>  
                    <a class="btn btn-success" href="#">Follow</a> 
                    <a class="btn" href="#">Message</a>
                    <a class="btn" href="#">1110 Posts</a>
                    <a class="btn" href="#">116 Following</a>
                    <a class="btn" href="#">380 Followers</a>
                </div>
                <hr />

                <h3>Timeline    </h3>
                <tpl:block data="page.block.body">Content</tpl:block>
                <hr />
                <h3>Photos</h3>
                <ul class="thumbnails media-grid media-gallery">
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/1/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/3/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/5/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/4/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>

                <!--                <div class="row-fluid marketing">
                                    <div class="span6">
                                        <h4>Subheading</h4>
                                        <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
                
                                        <h4>Subheading</h4>
                                        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>
                
                                        <h4>Subheading</h4>
                                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                                    </div>
                
                                    <div class="span6">
                                        <h4>Subheading</h4>
                                        <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
                
                                        <h4>Subheading</h4>
                                        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>
                
                                        <h4>Subheading</h4>
                                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                                    </div>
                                </div>-->

                <hr >
                <h3>Videos</h3>
                <ul class="thumbnails media-grid media-gallery">
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/1/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/3/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/5/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumbnail">
                                <div class="feature column"><img src="http://lorempixel.com/210/150/sports/4/" /></div>                      
                                <div class="description column">
                                    This is the description of this image
                                </div>
                                <div class="caption column">  
                                    <span><i class="icon-heart"></i> 2678</span> <span><i class="icon-time"></i> 10 days ago</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="footer">
                    <p>© Company 2013</p>
                </div>

            </div>
            <!-- Le javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="/${config|general.template}/assets/js/jquery.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-transition.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-alert.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-modal.js"></script>
            <script src="/${config|general.template}/assets/js/budkit-container.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-dropdown.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-scrollspy.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-tab.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-tooltip.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-popover.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-button.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-collapse.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-carousel.js"></script>
            <script src="/${config|general.template}/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>
