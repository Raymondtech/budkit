<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar-vertical" align="center">
        <tpl:condition data="page.block.side" test="isset" value="1">
            <ul icons="true" label="false" class="nav nav-list margin-top-half">
                <li><a data-toggle="container-left"><i class="nav-icon icon-menu"></i></a></li>
            </ul>
        </tpl:condition>
        <tpl:condition data="page.block.side" test="isset" value="0">
            <ul icons="true" label="false" class="nav nav-list margin-top-half">
                <li><a data-target="#quickstatus" data-toggle="modal"><i class="nav-icon icon-plus"></i></a></li>
            </ul>
        </tpl:condition>
        <tpl:menu id="dashboardmenu" type="nav-list" icons="true" label="false" />
        <ul icons="true" label="false" class="nav nav-list">
            <li><a href="/system/notifications/list" data-toggle="tooltip" data-placement="right" title="Notifications" data-original-title="Notifications"><i class="nav-icon icon-bell-alt"></i></a></li>
            <li><a href="/settings/member/account" data-toggle="tooltip" data-placement="right" title="Settings" data-original-title="Settings"><i class="nav-icon icon-cog"></i></a></li>
            <tpl:condition data="config|server.error-console" test="boolean" value="1">
                <li><a data-target="#systemconsole" data-toggle="modal"><i class="nav-icon icon-fire"></i></a></li>
            </tpl:condition>
            <li><a href="/system/authenticate/logout" data-toggle="tooltip" data-placement="right" title="Logout" data-original-title="Log-Out"><i class="nav-icon icon-off"></i></a></li>
        </ul>
        <div id="quickstatus" class="modal hide fade" tabindex="-1" role="dialog">
            <div class="modal-body">
                <tpl:import layout="forms/status" app="system" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click.container.data-api', '[data-toggle="container-left"]', function(e) {
        e.preventDefault();
        $('.container-left').toggleClass('active');
        });
    </script>
</tpl:layout>