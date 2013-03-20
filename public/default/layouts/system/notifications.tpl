<tpl:layout  name="start" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav no-margin">
        <div class="navbar-inner no-margin">
            <a class="topic"><tpl:element type="text" data="page.title">Notifications</tpl:element></a>
        </div>
    </div>
    <div class="padding">
        <div class="row-fluid">
            <div class="span8">           
               Hurrah! There are no new notifications at this time
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

</tpl:layout>