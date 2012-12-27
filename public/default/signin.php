<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html lang="en">
        <head>
            <title><tpl:element type="text" data="page.title">Sign In</tpl:element></title>
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

            <!-- Scripts -->
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-1.7.1.min.js' type="text/javascript"></script>
            <script src='<?php echo $this->getTemplatePath() ?>/js/libs/jquery-ui.min.js' type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/libs/modernizr-2.0.6.min.js" type="text/javascript"></script>
            <script src="<?php echo $this->getTemplatePath() ?>/js/bootstrap.js" type="text/javascript"></script>  
            <script src="<?php echo $this->getTemplatePath() ?>/js/libs/budkit-1.0.0.min.js" type="text/javascript"></script>
        </head>
        <body>
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
                    <tpl:import layout="console" />                
                </section>
            </div>
        </body>
    </html>
</tpl:layout>

