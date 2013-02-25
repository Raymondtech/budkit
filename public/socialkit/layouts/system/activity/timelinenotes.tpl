<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <ul class="stream">
        <tpl:loop data="activities.items">
        <li class="has-thubmnail">
            <a href="#" class="link">
                <div class="title">
                    <span class="subject">Livingstone Fultang</span>
                    <span class="time">10 hrs ago</span>
                </div>
                <div class="content">
                    New comment on blah photo
                </div>
            </a>
        </li>
        </tpl:loop>
    </ul>
</tpl:layout>