<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition data="gallery.hidetitle" test="boolean" value="0">
        <div class="navbar navbar-subnav no-margin">
            <div class="navbar-inner padding-left-half no-margin">
                <a class="topic"><tpl:element type="text" data="page.title">Authorities</tpl:element></a>
            </div>
        </div>
    </tpl:condition>
    <div class="padding">  
        <div class="clearfix">
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
            <ul class="nav nav-pills no-margin">
                <li class="highlighted"><a href="/settings/system/permissions/add" >Add Permission Rule</a></li>
            </ul>
        </div>
        <hr />
        <div class="widget">
            <div class="widget-head"><span class="widget-title">Groups</span></div>
            <div class="widget-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="span10">Name</th>    
                            <th class="span1" align="center">Members</th>
                            <th class="span1" align="center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tpl:loop data="authorities" id="authority-groups">
                            <tr>
                                <td class="authority-name">
                                    <tpl:loop limit="indent"><span class="indenter">|--</span></tpl:loop>
                                    <a href="#"><tpl:element type="text" data="authority_title" /></a>
                                </td>
                                <td align="center">0 members</td>
                                <td align="center"><a href="#">Edit</a></td>
                            </tr> 
                        </tpl:loop>
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
</tpl:layout>

<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <?php $authorities = $this->get("authorities"); ?>
    <div class="navbar navbar-subnav margin-bottom">
        <div class="navbar-inner padding-left-half">
            <ul class="nav" id="permissionsmenu">
                <li><a data-target="#addauthority" data-toggle="tab"><i class="icon-plus icon icon-16"></i>New Authority Group</a></li>               
                <li  class="active"><a data-target="#authorities" data-toggle="tab"><i class="icon-user-group icon icon-16"></i>Authorities</a></li>
                <li><a data-target="#permissionsDemography" data-toggle="tab"><i class="icon-pie icon icon-16"></i>Permissions by Demography</a></li>
                <li><a data-target="#permissions" data-toggle="tab"><i class="icon-lock-opened icon icon-16"></i>Permissions by Authority</a></li> 
                <li><a data-target="#addauthorityrole" data-toggle="tab"><i class="icon-plus icon icon-16"></i>Add Permission</a></li>             
            </ul>
        </div>
    </div>

    <div class="tab-content top-pad left-pad bottom-pad">
        <div class="tab-pane" id="permissions">
            <form class="form-horizontal"> 

                <fieldset>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($this->get("authorities") as $e):
                            if (is_array($e['authority']['permissions'])) :
                            foreach ($e['authority']['permissions'] as $permission): ?>
                            <tr>
                                <td class="span1 permission-<?php echo $permission['permission'] ?>"><div ><?php echo _(ucfirst($permission['permission'])) ?></div></td>
                                <td class="span5 authority-name"><?php echo str_repeat('|--', (int) $e['authority']['indent']) . sprintf(_("<span>%s</span>"), $e['authority']['authority_title']); ?></td>
                                <td class="span1"><?php echo _(ucfirst($permission['permission_type'])) ?></td>
                                <td class="span4"><a href="/system/admin/network/authorities.json" rel="modal" title="<?php echo _('Areas affected by this permission') ?>"><span title="<?php echo $permission['permission_title'] ?>" rel="tooltip"><?php echo $permission['permission_area_uri'] ?></span></a></td>             
                                <td class="span1"><a href="#"><?php echo _('Revoke'); ?></a></td>
                            </tr>
                            <?php endforeach;
                            endif;
                            endforeach;
                            ?>         
                        </tbody>
                    </table>
                </fieldset>
            </form>

        </div>
        <div class="tab-pane active" id="authorities">
            <!--                    <div class="alert alert-block alert-info">
                                    <p><?php echo _("An authority is a role in an area of responsibility (AoR). A curator is the head of an authority, who can create and grant permissions to users in that authority, or sub authority. A permission is an authorization to, access, modify or execute an object or operation, granted to an authority or user by a curator. Some authorities are automatically generated. For instance geographical and age authorities, can be used to limit permission by location, and age respectively.") ?></p>
                                                    <a data-toggle="tab" data-target="#addauthority" class="btn">Add Authority Group</a>
                                </div>-->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="span11">Authority Name</th>
                        <th class="span1">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->get("authorities") as $i): ?>
                    <tr>
                        <td class="authority-name"><?php echo str_repeat('|--', (int) $i['authority']['indent']) . sprintf(_("<span>%s</span>"), $i['authority']['authority_title']); ?></td>
                        <td><a href="#"><?php echo _('Edit'); ?></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="tab-pane" id="permissionsDemography">Set Permissions by Demography</div>
        <div class="tab-pane" id="permissionsConsole">Test permission settings</div>
        <div id="addauthority" class="tab-pane">

            <form method="POST" action="/system/admin/network/authorities/edit" class="form-horizontal">
                <fieldset class="no-margin">

                    <div class="control-group">
                        <label class="control-label" for="authority-title"> <?php echo _('Authority Name'); ?></label>
                        <div class="controls">
                            <input type="text" name="authority-title" class="input-xxlarge" placeholder="<?php echo _('e.g Global Investors'); ?>" />
                            <span class="help-block"><?php echo _('A name to identify this group of members'); ?></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="authority-description"> <?php echo _('Authority Description'); ?></label>
                        <div class="controls">
                            <textarea name="authority-description" class="input-xxlarge" placeholder="<?php echo _('e.g All the users who invested in our groups'); ?>" rows="8"></textarea>
                            <span class="help-block"><?php echo _('Optional description'); ?></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="authority-parent"> <?php echo _('Authority Parent'); ?></label>
                        <div class="controls">
                            <select name="authority-parent" id="authority-parent" class="input-xxlarge">
                                <?php foreach ($authorities as $e): ?>
                                <option value="<?php echo $e['authority']['authority_id'] ?>">
                                    <?php echo str_repeat('|--', (int) $e['authority']['indent']) . ' ' . $e['authority']['authority_title'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"><?php echo _('Make this a sub-authority child of another to inherit parent permissions?'); ?></span>
                        </div>
                    </div>
                    <input type="hidden" name="authority-id"  value="" />

                    <div class="form-actions">
                        <button type="submit" class="btn">Add New Authority</button>
                        <button class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div> 

        <div  id="addauthorityrole" class="tab-pane">

        </div>
    </div>

</tpl:layout>