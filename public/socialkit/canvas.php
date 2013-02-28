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
            <link href="<?php echo $this->getTemplatePath() ?>/assets/css/prettify.css" rel="stylesheet" />
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
                <div class="container-box">
                    <div class="container-right">
                        <div class="container-content scroll-y">
                            <div class="container-startup canvas">
                                <div class="startup-header">
                                    <h3><tpl:element type="text" data="page.title">SocialKit</tpl:element></h3>
                                </div>
                                <tpl:block data="page.block.alerts" />
                                <div class="startup-body">
                                    <tpl:block data="page.block.body" /> 
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
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/prettify.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-dropdown.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-scrollspy.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-tab.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-tooltip.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-popover.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-button.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-collapse.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-carousel.js"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/assets/js/bootstrap-typeahead.js"></script>
            <script>
            // @prettify
            !function ($) {
              $(function(){
              window.prettyPrint && prettyPrint()   
              })
            }(window.jQuery);
            // #prettify
            </script>
        </body>
    </html>
</tpl:layout>
