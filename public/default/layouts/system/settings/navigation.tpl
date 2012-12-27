<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="workspace-head">
    <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom" id="navigationPreferences">
        <?php $menus = $this->get('menus'); foreach($menus as $group ) : ?>
        <?php if($group['menu_group_iscore'] > 0 ): ?>
        <li><a data-target="#<?php echo $group['menu_group_uid']; ?>-nav" data-toggle="tab"><?php echo $group['menu_group_title']; ?></a></li>
        <?php endif; ?>
        <?php endforeach; ?> 
    </ul>
    </div>
    <div class="row-fluid">
        <div class="span8">
            <div class="tab-content top-pad left-pad bottom-pad">
                <?php $menus = $this->get('menus'); foreach($menus as $group ) : ?>
                <div class="tab-pane" id="<?php echo $group['menu_group_uid']; ?>-nav">
                    <ul class="admin-menu-lists">
                        <?php foreach( $group['nodes'] as $menu ): ?>
                        <li>
                            <div class="row-fluid">
                                <div class="span1"><input type="checkbox" /></div>
                                <div class="span8"><span><?php echo htmlentities($menu['menu_title']); ?></span></div>
                                <div class="span2"><a href="#">Permissions</a></div>
                                <div class="span1"><a href="#">Edit</a></div>
                            </div>
                        </li>
                        <?php if(sizeof($menu['children'])>0): ?>
                        <ul>
                            <?php foreach( $menu['children'] as $_menu ): ?>
                            <li>
                                <div class="row-fluid">
                                    <div class="span1"><input type="checkbox" /></div>
                                    <div class="span8"><?php echo htmlentities($_menu['menu_title']); ?></div>
                                    <div class="span2"><a href="#">Permissions</a></div>
                                    <div class="span1"><a href="#">Edit</a></div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="span4">
            <div class="well">
                <form action="/" class="clearfix">
                    <fieldset class="no-margin">
                        <legend>Add New Menu Item</legend>
                        <div class="control-group">
                            <label class="control-label" for="appearance[navigation-name]"> <?php echo _('Title'); ?></label>
                            <div class="controls">
                                <input type="text" name="appearance[navigation-name]"  class="input-xxxlarge" />
                                <span class="help-block">Keep it short and descriptive</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="options[site-page-title]"> <?php echo _('Type'); ?></label>
                            <div class="controls">
                                <select name="options[site-page-title]" class="input-xxxlarge">
                                    <option value="0"><?php echo _('Link'); ?></option>
                                    <option value="1"><?php echo _('Method/Callback'); ?></option>
                                    <option value="2"><?php echo _('Placeholder'); ?></option>
                                    <option value="2"><?php echo _('Divider'); ?></option>
                                </select>
                                <span class="help-block">By default the page title is the website name.</span>
                            </div>
                        </div> 
                        <div class="control-group">
                            <label class="control-label" for="appearance[navigation-name]"> <?php echo _('URL or Callback'); ?></label>
                            <div class="controls">
                                <input type="text" name="appearance[navigation-name]"  class="input-xxxlarge" />
                                <span class="help-block">A page or other resource link</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="appearance[navigation-name]"> <?php echo _('Classes'); ?></label>
                            <div class="controls">
                                <input type="text" name="appearance[navigation-name]"  class="input-xxxlarge" />
                                <span class="help-block">Some themes require additional classes for your links</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="options[site-page-title]"> <?php echo _('Add to Menu'); ?></label>
                            <div class="controls">
                                <select name="options[site-page-title]" class="input-xxxlarge">
                                    <?php $menus = $this->get('menus'); foreach($menus as $group ) : ?>
                                        <option value="<?php echo $group['menu_group_uid']; ?>"><?php echo $group['menu_group_title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block">The menu group to add item to. If Item is child of another, you will only be able to set its parent, by dragging to parent after the item has been saved</span>
                            </div>
                        </div>
                    </fieldset>

                    <hr />
                    <div class="btn-toolbar">        
                        <button type="submit" class="btn pull-left">Add Menu Item</button>
                    </div>
                </form>
            </div>
            <hr />
            <div class="well clearfix">
                <form action="/">
                    <fieldset class="no-margin">
                        <legend>Add New Menu Group</legend>
                        <div class="control-group">
                            <label class="control-label" for="appearance[navigation-name]"> <?php echo _('Add Menu Item'); ?></label>
                            <div class="controls">
                                <input type="text" name="appearance[navigation-name]"  class="input-xxxlarge" />
                                <span class="help-block">To create a new navigation group, enter its name/title here. To add multiple navigations use comma seperators, e.g Menu1 Title, Menu2 Title, etc</span>
                            </div>
                        </div>   

                        <hr />
                        <div class="control-group">
                            <label class="control-label">Maintenance mode</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="options[site-offline]" id="site-offline1" value="1" />
                                    Put site offline for maintenance
                                </label>
                                <label class="radio">
                                    <input type="radio" name="options[site-offline]" id="site-offline2" value="0" checked="" />
                                    Make site accessible to all
                                </label>
                                <span class="help-block">NOTE: An offline site is not accessible by anyone except special users.</span>
                            </div>
                        </div>  
                    </fieldset>

                    <hr />
                    <div class="btn-toolbar">        
                        <button type="submit" class="btn pull-left">Add Custom Navigation Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
        //alert('woot');
        $("#navigationPreferences a:first").tab('show');
    });
    </script>
</tpl:layout>