<tpl:layout  name="start" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">SocialKit</tpl:element></a>
        </div>
    </div>
    <div class="padding gridrowwidth">
        <div class="row-fluid">
            <div class="span8">
                
                <div class="widget-bucket" id="widget-bucket-1">
                    <div class="widget">
                        <div class="widget-head"><span class="widget-title">overview</span><a class="widget-close" data-dismiss="widget"><i class="icon-remove"></i></a></div>
                        <div class="widget-body">
                            <div class="row-fluid">
                                <div class="dials">
                                    <div class="span3" ontablet="span4" ondesktop="span2">
                                        <div class="dial red">
                                            <i class="icon-heart"></i>
                                            <span class="unit">%</span>   
                                            <input type="text" value="5" class="reddial" data-linecap="round"  />
                                        </div>
                                        <div class="dial-title">Liked</div>
                                    </div>
                                    <div class="span3" ontablet="span4" ondesktop="span2">
                                        <div class="dial green">
                                            <i class="icon-user"></i>
                                            <span class="unit">%</span>   
                                            <input type="text" value="50" class="greendial" data-linecap="round"  />
                                        </div>
                                        <div class="dial-title">Popularity</div>
                                    </div>
                                    <div class="span3" ontablet="span4" ondesktop="span2">
                                        <div class="dial red">
                                            <i class="icon-comments"></i>
                                            <span class="unit">%</span>   
                                            <input type="text" value="10" class="reddial" data-linecap="round"  />
                                        </div>
                                        <div class="dial-title">Discussed</div>
                                    </div>
                                    <div class="span3" ontablet="span4" ondesktop="span2">
                                        <div class="dial blue">
                                            <i class="icon-thumbs-up"></i>
                                            <span class="unit">%</span>   
                                            <input type="text" value="35" class="bluedial" data-linecap="round"  />
                                        </div>
                                        <div class="dial-title">Content fans</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />
                

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-bucket" id="widget-bucket-3">
                            <div class="widget">
                                <div class="widget-head">Your Network</div>
                                <div class="widget-body">Widget Body</div>
                                <div class="widget-footer">Widget Footer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="widget-bucket" id="widget-bucket-2">
                    <div class="widget">
                        <div class="widget-head"><span class="widget-title">Happening Now</span><a class="widget-close" data-toggle="widget-async"><i class="icon-pause"></i></a></div>
                        <div class="widget-body padding-zero">
                            <ul class="stream">
                                <?php for ($i = 0; $i < 10; $i++): ?>
                                <li class="has-thumbnail">
                                    <a class="thumbnail" href="#">
                                        <img class="profile-avatar" src="http://placeskull.com/50/50/999999" alt="" width="50" height="50" />                         
                                    </a>
                                    <a href="#" class="link">
                                        <div class="title">
                                            <span class="subject">Livingstone Fultang</span>
                                            <span class="time">10 hrs ago</span>
                                        </div>
                                        <div class="content">
                                            And here are the contents of this message. Maximum of two lines allowed
                                        </div>
                                    </a>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>                
    </div>
    <script type="text/javaScript" src="<?php echo $this->getTemplatePath() ?>/assets/js/plugins/jquery.knob.js"></script>
    <script type="text/javaScript">
            <![CDATA[ 
                    !function($){
                $(".greendial").knob({'min':0,'max':100,'readOnly': true,'width': 100,'height': 100,'fgColor': '#4EA209','inputColor':'#4EA209','dynamicDraw': true,'thickness': 0.2,'tickColorizeValues': true});
                $(".reddial").knob({'min':0,'max':100,'readOnly': true,'width': 100,'height': 100,'fgColor': '#B94848','inputColor':'#B94848','dynamicDraw': true,'thickness': 0.2,'tickColorizeValues': true});
                $(".bluedial").knob({'min':0,'max':100,'readOnly': true,'width': 100,'height': 100,'fgColor': '#4884C0','inputColor':'#4884C0','dynamicDraw': true,'thickness': 0.2,'tickColorizeValues': true})
            }( window.jQuery );
        ]]> 
    </script>
</tpl:layout>