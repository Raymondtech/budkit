<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    
    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
        <div class="tab-content">
            <div class="tab-pane active" id="dashboardmenuview">
                <tpl:menu id="dashboardmenu" type="nav-list" />
            </div>
            <div class="tab-pane" id="contentmenuview">           
                <tpl:menu id="contentmenu" type="nav-list" />
            </div>
            <div class="tab-pane" id="peoplemenuview">           
                <tpl:menu id="peoplemenu" type="nav-list" />
            </div>
            <div class="tab-pane" id="settingsmenuview">
                <tpl:menu id="settingsmenu" type="nav-list" />
            </div>
            <div class="tab-pane" id="messagesmenuview">
                <tpl:menu id="messagesmenu" type="nav-list" />
            </div>
        </div>  
    </tpl:condition>
    <tpl:condition  data="user.isauthenticated" test="boolean" value="0" >
        <div class="padding-half">
            <p class="alert alert-info">Login to Personalize your experience</p>
        </div>
    </tpl:condition>
    <tpl:block data="page.block.side">Sidebar</tpl:block>
</tpl:layout>


