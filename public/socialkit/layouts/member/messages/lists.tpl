<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box row-fluid">
        <div class="message-list">
            <div class="navbar navbar-subnav no-margin">
                <div class="navbar-inner padding-left-half padding-right-half no-margin">
                    <form class="navbar-form">
                        <div class="no-bottom-margin message-search">
                            <input type="text" class="span12" placeholder="Search message threads.." />
                        </div>
                    </form>
                </div>
            </div>
            <ul class="stream">
                <?php for ($i = 0; $i < 15; $i++): ?>
                <li class="has-thumbnail">
                    <a class="thumbnail" href="#">
                        <img class="profile-avatar" src="http://profile.ak.fbcdn.net/hprofile-ak-snc6/203280_100003630780902_1928341789_q.jpg" alt="" width="50" height="50" />                         
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
        <div class="message-view">
            <div class="message-thread">
                <div class="navbar navbar-subnav no-margin">
                    <div class="navbar-inner padding-left-half no-margin">
                        <p class="navbar-text "><strong>The title of this thread</strong></p>
                    </div>
                </div>
                <div class="message-body padding" id="timeline">
                    <tpl:import layout="input" />
                    <ol class="timeline-item-index">
                        <tpl:loop data="activities.items">
                            <li class="timeline-item-li">
                                <div class="timeline-item-container">
                                    <div class="timeline-item-header">
                                        <div class="timeline-item-icon"><a href="#"><i class="icon-${verb}"></i></a></div>
                                        <a class="publisher-profile" href="#">
                                            <img class="profile-avatar thumbnail" src="${actor.image.url}" alt="${actor.displayName}" width="${actor.image.width}" height="${actor.image.height}" />
                                            <strong class="profile-name"><tpl:element type="text" data="actor.displayName" /></strong>                              
                                        </a>
                                        <a href="/system/activity/view/${uri}" title="${published}" class="published-time"><tpl:element type="time" data="published" /></a>
                                        <ul class="actions">
                                            <li class="action-like"><a href="/system/activity/favourite/${uri}"><span class="like" title="Like">Like</span></a></li>
                                            <li class="action-reply"><a href="/system/activity/reply/${uri}"><span class="reply" title="Reply">Reply</span></a></li>
                                            <li class="action-delete"><a href="/system/activity/delete/${uri}"><span class="delete" title="Delete">Delete</span></a></li>
                                        </ul>
                                        <div class="timeline-item-title"><tpl:element type="text" data="content" /></div>
                                    </div>
                                </div>
                            </li>
                        </tpl:loop>  
                    </ol>
                    <!--                    <div  class="timeline-more-items">
                                            <button class="btn input-100pct">Load more</button>
                                        </div>-->
                </div>
            </div>
        </div>
    </div>
</tpl:layout>