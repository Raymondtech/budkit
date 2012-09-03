<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <html lang="en">
        <head>
            <title><tpl:element type="text" data="page.title">Profile</tpl:element></title>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="<?php echo $this->getPageDescription(); ?>" />
            <meta name="author" content="<?php echo $this->getPageAuthor(); ?>" />
            <meta name="keywords" content="<?php echo $this->getPageAuthor(); ?>" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <!-- Le fav and touch icons -->
            <link rel="shortcut icon" href="images/favicon.ico" />
            <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
            <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png" />
            <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png" />

            <link rel="stylesheet" href="<?php echo $this->getTemplatePath() ?>/css/bootstrap.css" type="text/css" media="screen" />

        </head>

        <body>
            <tpl:import layout="navbar" />

            <div class="container"> 
                <tpl:block data="page.block.alerts" />  
                <tpl:block data="page.block.banner">Banner</tpl:block>
                <section class="layout-block boxed has-bg">
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="profile-header">
                                <h1>Livingstone K. F. Fultang <small> (@drstonyhills)</small></h1>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="left-pad"> 
                                <div class="btn-toolbar no-top-margin">
                                    <div class="btn-group">
                                        <button class="btn" tpl:i18n="">View As</button>
                                        <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" tpl:i18n="">Action</a></li>
                                            <li><a href="#" tpl:i18n="">Another action</a></li>
                                            <li><a href="#" tpl:i18n="">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" tpl:i18n="">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn" tpl:i18n="">Edit Info</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn">
                                            <i class="icon icon-lock"></i> <tpl:i18n>Privacy</tpl:i18n>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-cover">
                        <a href="#" class="cover"><img  src="http://www.number10.gov.uk/wp-content/uploads/2012/07/Olympic-stadium-940.jpg" width="940" height="300" /></a>
                        <div class="profile-avatar">
                            <a href="#">
                                <img  src="http://placehold.it/260x250" width="260" height="250" />
                            </a>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12"> 
                            <div class="row-fluid">
                                <div class="span8">
                                    
                                    <div id="control-panel" class="top-pad">
                                        <div class="row-fluid text-centered clearfix"> 
                                            <a href="/content/article/create" class="thumbnail-icon text-centered text-grey" data-original-title="New Article" rel="tooltip">
                                                <i class="icon icon-32 icon-edit icon-block"></i>
                                            </a>
                                            <a href="/content/photo/create" class="thumbnail-icon text-centered text-orange" data-original-title="Upload Photos" rel="tooltip">
                                                <i class="icon icon-32 icon-camera-retro icon-block"></i>
                                            </a>
                                            <a href="/content/event/create" class="thumbnail-icon text-centered text-green" data-original-title="Create Event" rel="tooltip">
                                                <i class="icon icon-32 icon-calendar icon-block"></i>
                                            </a>
                                            <a href="/content/question/create" class="thumbnail-icon text-centered text-purple" data-original-title="Ask Question" rel="tooltip">
                                                <i class="icon icon-32 icon-question-sign icon-block"></i>
                                            </a>
                                            <a href="/content/audio/create" class="thumbnail-icon text-centered" data-original-title="Add Audio" rel="tooltip">
                                                <i class="icon icon-32 icon-music icon-block"></i>
                                            </a>
                                            <a href="/content/video/create" class="thumbnail-icon text-centered" data-original-title="Add Video" rel="tooltip">
                                                <i class="icon icon-32 icon-film icon-block"></i>
                                            </a>
                                            <a href="/content/location/checkin" class="thumbnail-icon text-centered text-red" data-original-title="New Check-In" rel="tooltip">
                                                <i class="icon icon-32 icon-map-marker icon-block"></i>
                                            </a>
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="span4">
                                    <div class="left-pad top-pad bottom-pad">
                                        <ul class="page-info">
                                            <li class="signup-date">Member since 10 months ago</li>
                                            <li class="signin-date">Last logged in about 6 days ago</li>
                                            <!-- Date of Birth -->
                                            <li class="company-element">Born on the <a href="#">14th of March</a></li>
                                            <!-- Contact Information -->
                                            <li class="company-element">Works at <a href="#">Stonyhills LLC</a></li>
                                            <li class="email-element"><a href="mailto:livingstonefultang@gmail.com">livingstonefultang@gmail.com</a></li>
                                            <!--CUSTOM SOCIAL INFORMATION-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span8">

                                    <tpl:block data="page.block.body" return="1">
                                        What content?
                                    </tpl:block>



                                </div>
                                <div class="span4">
                                    <div class="left-pad">

                                        <tpl:menu id="profilemenu" type="nav-block" />

                                        <div class="widget top-pad">
                                            <h4 tpl:i18n="">Badges and Rewards</h4> 
                                            <div class="widget-body top-pad">

                                                <ul class="thumbnails">
                                                    <?php for ($i = 0; $i < 15; $i++): ?>
                                                        <li>
                                                            <a href="#">
                                                                <img class="thumbnail" src="http://placehold.it/32x32" alt="" width="32" height="32" />
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
                                                    <?php for ($i = 0; $i < 15; $i++): ?>
                                                        <li>
                                                            <a href="#">
                                                                <img class="thumbnail" src="http://placehold.it/32x32" alt="" width="32" height="32" />
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
                                                    <?php for ($i = 0; $i < 15; $i++): ?>
                                                        <li>
                                                            <a href="#">
                                                                <img class="thumbnail" src="http://placehold.it/32x32" alt="" width="32" height="32" />
                                                            </a>
                                                        </li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </div>
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <tpl:import layout="footer" />    
            </div>

            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-1.7.1.min.js' type="text/javascript"></script>
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-ui.min.js' type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/libs/modernizr-2.0.6.min.js" type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/bootstrap.js" type="text/javascript"></script>
        </body>
    </html>
</tpl:layout>