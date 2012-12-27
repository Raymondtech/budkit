<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <?php $authorities = $this->get("authorities"); ?>
    <div class="workspace-head">
        <ul id="permissions-tab" class="nav icon-tabs left no-margin no-bottom-border docked-bottom">
            <li  class="active"><a data-target="#authorities" data-toggle="tab">Authorities</a></li>
            <li><a data-target="#permissionsDemography" data-toggle="tab">Permissions by Demography</a></li>
            <li><a data-target="#permissions" data-toggle="tab">Permissions by Authority</a></li> 
            <li><a data-target="#permissionsConsole" data-toggle="tab">Console</a></li>
        </ul>
    </div>
    <div class="row-fluid">
        <div class="span8">
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
                    <div class="alert alert-info">          
                        <ol>
                            <li>Permission heiracchy is "Special" > "Modify" > "Execute" > "View", implying an authority with Special permissions can "View", "Execute" and "Modify" objects in an area of responsibility (AoR).</li>
                            <li>By default, unless explicitly denied, all "View" permission are allowed (and inheritted) for every AoR to every authority. All other permissions ("Execute", "Modify" and "Special") are denied unless explicitly allowed</li>
                            <li>Special permission will always be granted to the owner of an object</li>
                            <li>All Permissions defined for the parent authority group, will be inherited by child authority groups.</li>
                            <li>Use the Regular expression <kbd>(/[a-z0-9-]*)*</kbd> to represent zero or more optional segments in are uri</li>
                        </ol>
                    </div>
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


            </div>

        </div>
        <div class="span4">
            <div id="addauthority-widget" class="well">
                <legend>Add New Authority Group</legend>
                <form method="POST" action="/system/admin/network/authorities/edit">
                    <fieldset class="no-margin">

                        <div class="control-group">
                            <label class="control-label" for="authority-title"> <?php echo _('Authority Name'); ?></label>
                            <div class="controls row-fluid">
                                <input type="text" name="authority-title" class="input-xxxlarge" placeholder="<?php echo _('e.g Global Investors'); ?>" />
                                <span class="help-block"><?php echo _('A name to identify this group of members'); ?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="authority-description"> <?php echo _('Authority Description'); ?></label>
                            <div class="controls row-fluid">
                                <textarea name="authority-description" class="input-xxxlarge" placeholder="<?php echo _('e.g All the users who invested in our groups'); ?>" rows="8"></textarea>
                                <span class="help-block"><?php echo _('Optional description'); ?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="authority-parent"> <?php echo _('Authority Parent'); ?></label>
                            <div class="controls row-fluid">
                                <select name="authority-parent" id="authority-parent" class="input-xxxlarge">
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
            <hr />
            <div  id="addauthorityrole-widget" class="well">
                <legend>Add New Permission</legend>
                <form method="POST" action="/system/admin/network/authorities/permissions/add">

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="area-authority"> <?php echo _('Authority (Group)'); ?></label>
                            <div class="controls">
                                <select name="area-authority"  class="input-xxxlarge">
                                    <?php foreach ($this->get("authorities") as $e): ?>
                                    <option value="<?php echo $e['authority']['authority_id'] ?>"><?php echo str_repeat('|--', (int) $e['authority']['indent']) . ' ' . $e['authority']['authority_title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="area-uri"> <?php echo _('Area URI'); ?></label>
                            <div class="controls">
                                <input type="text" name="area-uri" class="input-xxxlarge" placeholder="e.g /marketplace/*" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="area-title"> <?php echo _('Description'); ?></label>
                            <div class="controls">
                                <input type="text" name="area-title" class="input-xxxlarge" placeholder="e.g Marketplace" />
                            </div>
                        </div>            
                        <div class="control-group">
                            <label class="control-label"><?php echo _('Role / Permission'); ?></label>
                            <div class="controls">
                                <div class="row-fluid">
                                    <select name="area-action" class="span5">
                                        <option value="view"><?php echo _('View'); ?></option>
                                        <option value="execute"><?php echo _('Execute'); ?></option>
                                        <option value="modify"><?php echo _('Modify'); ?></option>
                                        <option value="special"><?php echo _('Special'); ?></option>
                                    </select>
                                    <select name="area-permission" class="span5">
                                        <option value="inherit"><?php echo _('Inherited'); ?></option>
                                        <option value="allow"><?php echo _('Allowed'); ?></option>
                                        <option value="deny" selected="selected"><?php echo _('Denied'); ?></option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" name="authority-id"  value="" />
                    <div class="form-actions">
                        <button type="submit" class="btn">Add New Permission</button>
                        <button class="btn">Cancel</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</tpl:layout>