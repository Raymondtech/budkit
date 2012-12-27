<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="page-header">
        <!--    <h1><?php echo _('Additional Details') ; ?></h1><br />-->
        <small><?php echo _('Please provide details for the superadmin User account. ' ) ; ?></small>
    </div>
    <div class="row-fluid">
        <div class="control-group span6">
            <label class="control-label" for="user_name"><tpl:i18n>First Name</tpl:i18n><em class="mandatory">*</em></label>
            <div class="controls row-fluid">
                <input class="input-xxlarge focused span11" id="first_name" name="user_first_name" type="text" placeholder="Johnatan" />
            </div>
        </div>
        <div class="control-group span6">
            <label class="control-label" for="user_name"><tpl:i18n>Last Name</tpl:i18n><em class="mandatory">*</em></label>
            <div class="controls row-fluid">
                <input class="input-xxlarge focused span11" id="last_name" name="user_last_name" type="text" placeholder="Johnatan" />
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"  for="user_name_id">Username</label>
        <div class="controls">
            <input class="input-xlarge" id="user_name_id" name="user_name_id" size="20" type="text" value="<?php echo $this->user->get('username') ; ?>" />
            <span class="help-block">Alpha-numeric only (aA-zZ,0-9)</span>
        </div>
    </div><!-- /control-group -->
    <div class="control-group">
        <label class="control-label"  for="user_email">Email address</label>
        <div class="controls">
            <div class="input-prepend">
                <input class="input-xxlarge" id="user_email" name="user_email" size="100" type="text" value="<?php echo $this->user->get('email'); ?>" />
            </div>
            <span class="help-block">Its important that this be valid</span>
        </div>
    </div><!-- /control-group -->



    <div class="control-group">
        <label class="control-label"  for="user_password">New password</label>
        <div class="controls">
            <input class="input-xlarge" id="user_password" name="user_password" size="30" type="password" />
        </div>
    </div><!-- /control-group -->
    <div class="control-group">
        <label class="control-label"  for="user_password_2">Verify new password</label>
        <div class="controls">
            <input class="input-xlarge" id="user_password_2" name="user_password_2" size="30" type="password" />
        </div>
    </div><!-- /control-group -->

</tpl:layout>
