<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <ul class="nav nav-tabs admin-main-tabs" id="navigationPreferences">
        <?php $menus = $this->get('menus'); foreach($menus as $group ) : ?>
        <?php if($group['menu_group_iscore'] > 0 ): ?>
        <li><a data-target="#<?php echo $group['menu_group_uid']; ?>-nav" data-toggle="tab"><?php echo $group['menu_group_title']; ?></a></li>
        <?php endif; ?>
        <?php endforeach; ?> 
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-plus"></i></a>
            <ul class="dropdown-menu">
                <?php $menus = $this->get('menus'); foreach($menus as $group ) : ?>
                <?php if($group['menu_group_iscore'] < 1 ): ?>
                <li><a data-target="#<?php echo $group['menu_group_uid']; ?>-nav" data-toggle="tab"><?php echo $group['menu_group_title']; ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </li>
    </ul>
    <div class="row-fluid">
        <div class="span8">
            <div class="tab-content">
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
            <form action="/" class="clearfix">
                <fieldset class="no-margin">
                    <div class="control-group">
                        <label class="control-label" for="appearance[navigation-name]"> <?php echo _('Add Navigation Group Name'); ?></label>
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

                
                <div class="btn-toolbar">        
                    <button type="submit" class="btn pull-left">Add Custom Navigation Group</button>
                </div>
            </form>
            <hr />
            <form action="/">
                <fieldset class="no-margin">
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
    <script type="text/javascript">
        $(function(){
        //alert('woot');
        $("#navigationPreferences a:first").tab('show');
    });
    </script>
</tpl:layout>