<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav margin-bottom">
        <div class="navbar-inner padding-left-half">
            <ul class="nav" id="permissionsmenu">
                <li class="active"><a href="#members" data-toggle="tab"><i class="icon-people icon icon-16"></i>Members</a></li>
                <li><a href="/system/admin/network/add/member.raw" data-target="#addnew" data-toggle="tab"><i class="icon-person-add icon icon-16"></i>Add Member</a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane  active" id="members"> <div class="box-padding">Members lists</div></div>
        <div class="tab-pane" id="addnew">Add New members</div>
        <div class="tab-pane" id="search">Search</div>
    </div>
</tpl:layout>
