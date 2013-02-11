<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="workspace-head">
        <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom">
            <li class="active"><a href="#members" data-toggle="tab"><i class="icon-people icon icon-16"></i>Members</a></li>
            <li><a href="/system/admin/network/add/member.raw" data-target="#addnew" data-toggle="tab"><i class="icon-person-add icon icon-16"></i>Add Member</a></li>
        </ul>
        <ul class="nav icon-tabs right no-margin no-bottom-border docked-bottom">
            <li>
                <form class="search pull-right box-padding">
                    <input type="text" class="span3" placeholder="Search" />
                </form>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane  active" id="members"> <div class="box-padding">Members lists</div></div>
        <div class="tab-pane" id="addnew">Add New members</div>
        <div class="tab-pane" id="search">Search</div>
    </div>
</tpl:layout>
