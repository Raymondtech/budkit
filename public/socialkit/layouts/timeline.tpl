<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="stream-box row-fluid activity-box">
        <div class="stream-list">
            <div class="navbar navbar-subnav no-margin">
                <div class="navbar-inner padding-left-half padding-right-half no-margin">
                     <p class="navbar-text "><strong>Network Activity</strong></p>
                </div>
            </div>
            <ul class="stream">
                <?php for ($i = 0; $i < 15; $i++): ?>
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
        <div class="stream-view">
            <div class="stream-thread">
               
                <div class="stream-body padding" id="timeline">
                    <tpl:import layout="input" />
                    <tpl:import layout="activity/timeline" />
                </div>
            </div>
        </div>
    </div>
</tpl:layout>