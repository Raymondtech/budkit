<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <div class="clearfix">
            <h1 class="margin-bottom-zero pull-left"><tpl:element type="text" data="page.title" /></h1>
            <form class="pull-right no-margin form-horizontal" action="/settings/system/permissions/authorities/edit" method="POST">   
                <input type="text" name="authority-title" class="span2" placeholder="Group Name" />
                <select name="authority-parent" id="authority-parent">
                    <option value="">Select Parent</option>
                    <tpl:loop data="authorities" id="authorities">
                        <option value="${authority_id}">
                            <tpl:loop limit="indent"><span class="indenter">|--</span></tpl:loop>
                            <span><tpl:element type="text" data="authority_title" /></span>
                        </option>
                    </tpl:loop>
                </select>
                <input type="hidden" name="authority-description" />
                <button type="submit" class="btn">Add New Group</button>
            </form>
        </div>
        <hr />
        <div class="widget">
            <div class="widget-head"><span class="widget-title"><tpl:element type="text" data="page.title">Group Permissions</tpl:element></span></div>
            <div class="widget-body">

                <div class="accordion" id="authority-group-collapse">
                    <tpl:loop data="authorities" id="authority-groups">
                        <div class="accordion-group" id="authority-group-collapse">
                            <div class="accordion-heading">
                                <div class="accordion-toggle" data-toggle="collapse" data-parent="#authority-group-collapse" href="#group${authority_id}">
                                    <tpl:loop limit="indent"><span class="indenter">|--</span></tpl:loop>
                                    <a href="/settings/system/permissions/authority/${authority_id}"><span><tpl:element type="text" data="authority_title" /></span></a>
                                    <a href="/settings/system/permissions/authority/edit/${authority_id}"><span class="pull-right">Edit</span></a>
                                    <span class="pull-right margin-right">0 members</span>
                                </div>
                            </div>
                            <div id="group${authority_id}" class="accordion-body collapse">
                                <div class="accordion-inner" style="padding-left: ${indent}5px">
                                    <table class="table no-margin">
                                        <thead>
                                            <th class="span1">Type</th>
                                            <th class="span2">Description</th>
                                            <th class="span6">Area</th>
                                            <th class="span2">Permission</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <tpl:loop data="permissions" id="authority-permissions">
                                                <tr>
                                                    <td><tpl:element type="text" data="permission_type" /></td>
                                                    <td><tpl:element type="text" data="permission_title" /></td>
                                                    <td><tpl:element type="text" data="permission_area_uri" /></td>
                                                    <td class="span2"><tpl:element type="text" data="permission" /></td>
                                                    <td class="span1"><a href="#">Revoke</a></td>
                                                </tr> 
                                            </tpl:loop>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <form method="POST" action="/settings/system/permissions/addrule" class="no-margin">
                                                    <input type="hidden" name="area-authority" value="${authority_id}" />
                                                    <input type="hidden" name="authority-id"  value="${authority_id}" />
                                                    <td>
                                                        <select name="area-action">
                                                            <option value="view">View</option>
                                                            <option value="execute">Execute</option>
                                                            <option value="modify">Modify</option>
                                                            <option value="special">Special</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="area-title"  placeholder="e.g Marketplace" class="span2" />
                                                    </td>                                        
                                                    <td class="control-group">
                                                        <input type="text" name="area-uri" placeholder="e.g /marketplace/*" class="span6" />
                                                    </td>                         
                                                    <td>
                                                        <select name="area-permission">
                                                            <option value="inherit">Inherited</option>
                                                            <option value="allow">Allowed</option>
                                                            <option value="deny" selected="selected">Denied</option>
                                                        </select> 
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn">Add</button>
                                                    </td>
                                                </form>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </tpl:loop>
                </div>
            </div>            
        </div>
    </div>
</tpl:layout>
