<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box row-fluid">
        <div class="message-list">
            <div class="navbar navbar-subnav no-margin">
                <div class="navbar-inner padding-left-half no-margin">
                    <form class="navbar-form">
                        <div class="no-bottom-margin message-search">
                            <input type="text" class="span12" placeholder="Search message threads.." />
                        </div>
                    </form>
                </div>
            </div>
            <div class="">
                <table class="table table-hover">
                    <!--                    <thead>
                                            <tr>
                                                <th class="span1"><input type="checkbox" /></th>
                                                <th class="span2">From</th>
                                                <th class="span2"></th>
                                                <th class="span9">Message</th>
                                                <th class="span2">Time</th>
                                            </tr>
                                        </thead>-->
                    <tbody>
                        <?php for ($i = 0; $i < 10; $i++): ?>
                        <tr>
                            <td>
                                <a class="publisher-profile" href="#">
                                    <img class="profile-avatar thumbnail" src="http://placeskull.com/50/50/999999" alt="" width="50" height="50" />                         
                                </a>
                            </td>
                            <td>
                                <strong class="profile-name display-block">Livingstone Fultang</strong> 
                                No censoring.Commit to interaction absent personal.
                            </td>
                        </tr>

                        <?php endfor ;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="message-view">
            <div class="message-thread">
                <div class="navbar navbar-subnav no-margin">
                    <div class="navbar-inner padding-left-half no-margin">
                        <p class="navbar-text "><strong>The title of this thread</strong></p>
                    </div>
                </div>
                <div class="message-body padding" id="timeline">
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
                    <tpl:import layout="input" />
                    <!--                    <div  class="timeline-more-items">
                                            <button class="btn input-100pct">Load more</button>
                                        </div>-->
                </div>
            </div>
        </div>
    </div>
</tpl:layout>