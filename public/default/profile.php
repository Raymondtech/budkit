<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
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
        <body  class="responsive-body dark-bg">
            <div class="container-fluid">
                <tpl:import layout="navbar" />
            </div>
            <div class="container large"> 
                <tpl:block data="page.block.alerts" />  
                <tpl:block data="page.block.banner">Banner</tpl:block>
                <section class="layout-block boxed has-bg has-aside-block">
                    <div class="aside-block right-pad">  
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
                    <div class="main-block">
                        <div class="top-pad left-pad right-pad">
                            <div class="page-header no-margin">
                                <h2>Livingstone K. F. Fultang <small> (@drstonyhills)</small></h2>
                            </div>
                        </div>
                        <tpl:block data="page.block.body" return="1">What? Content</tpl:block>
                        
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