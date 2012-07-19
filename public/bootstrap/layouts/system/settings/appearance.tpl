<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <ul class="nav nav-tabs admin-main-tabs" id="apperancePreferences">
        <li class="active"><a data-target="#themes" data-toggle="tab">Themes</a></li>
        <li><a data-target="#navigation" data-toggle="tab">Navigations</a></li>
        <li><a data-target="#widgets" data-toggle="tab">Widgets</a></li>
        <li><a data-target="#layouts" data-toggle="tab">Layouts</a></li>
        <li><a data-target="#optimization" data-toggle="tab">Optimization</a></li>
        <li><a data-target="#scripts" data-toggle="tab">Scripts</a></li>
        <li><a data-target="#banners" data-toggle="tab">Banners</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="navigation">
            <form>
                <fieldset>
                    <table class="table table-striped">
                        <thead>
                            <th class="span1"><input type="checkbox" /></th>
                            <th class="span4"><strong>Title</strong></th>
                            <th class="span2"><strong>Unique ID</strong></th>
                            <th class="span4">Position</th>
                            <th class="span1">&nbsp;</th>
                        </thead>
                        <tbody>

                            <?php $menus = $this->get('menus'); foreach($menus as $group ) : ?>
                            <tr>

                                <td class="span1"><input type="checkbox" /></td>
                                <td class="span4"><span><?php echo htmlentities($group['menu_group_title']); ?></span></td>
                                <td class="span2"><?php echo htmlentities($group['menu_group_uid']); ?></td>
                                <td class="span4">
                                    <select>
                                        <option>Menu Position 1</option>
                                        <option>Menu Position 2</option>
                                    </select>
                                </td>
                                <td class="span1"><a href="/system/admin/settings/navigation#<?php echo $group['menu_group_uid']; ?>">Edit</a></td>

                            </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                    <hr />
                      
                </fieldset>
                <div class="btn-toolbar">
                    <button class="btn pull-left btn-danger" type="reset">Reset Form</button>
                    <button type="submit" class="btn btn-success pull-right">Save Theme Navigation settings</button>
                </div>
            </form> 
        </div>
    </div>
</tpl:layout>