<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="messages-box">
        <div class="message-list">
            <tpl:condition data="gallery.hideheader" test="boolean" value="0">
                <tpl:import layout="media/gallery/title" />
            </tpl:condition>
            <div class="section-menu">
                <tpl:menu id="mediamenu" type="nav-pills" />
            </div>
            <div class="section-body">
                <tpl:condition data="gallery" test="isset" value="1">
                    <tpl:import layout="media/gallery/widget" />
                </tpl:condition>
                <tpl:condition data="gallery" test="isset" value="0">
                    <p class="placeholder-text padding">There are no items to display in this gallery.</p>
                </tpl:condition>
            </div>
        </div>
        <div class="message-view">
            <div class="stream-thread">              
                <tpl:condition test="isset" data="activities.items" value="0">
                    <div class="stream-body padding"><tpl:import layout="forms/form" app="system" /></div>
                </tpl:condition>
                <tpl:condition test="isset" data="activities.items" value="1">
                    <div class="stream-body padding" id="timeline"> 
                        <tpl:import layout="media/timeline" />                             
                        <div class="stream-more margin-top">
                            <tpl:import layout="media/comments" /> 
                            <tpl:import layout="forms/comment" /> 
                            <div class="row-fluid margin-top">
                                <button class="btn">Load more</button>
                            </div>
                        </div> 
                    </div>
                </tpl:condition>
            </div>
        </div>
    </div>
</tpl:layout>
