<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <ul class="nav nav-tabs admin-main-tabs" id="maintenancePreferences">
        <li class="active"><a data-target="#config" data-toggle="tab">Maintenance</a></li>
        <li><a data-target="#messages" data-toggle="tab">Alert Messages</a></li>
        <li><a data-target="#scheduled" data-toggle="tab">Scheduled Maintenance</a></li>
        <li><a data-target="#logs" data-toggle="tab">Maintenance Logs</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="config">
            <form>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="options[site-name]"> <?php echo _('Offline Page Title'); ?></label>
                        <div class="controls">
                            <input type="text" name="options[site-name]"  class="input-xxxlarge" placeholder="e.g MySocialNetwork will be back online in a Jiffy" />
                            <span class="help-block">A Title to be displayed on offline Pages</span>
                        </div>
                    </div>                   
                    <div class="control-group">
                        <label class="control-label" for="options[site-offline-message]"> <?php echo _('Offline message'); ?></label>
                        <div class="controls">
                            <textarea name="options[site-offline-message]" class="wysiwyg input-xxxlarge" rows="6" placeholder="<?php echo _('This message will be displayed when the site is offline'); ?>" ></textarea>
                            <span class="help-block"><?php echo _('Brief maintenance message to be displayed to all other users'); ?></span>
                        </div>
                    </div>
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
            </form>
        </div>
    </div>
</tpl:layout>