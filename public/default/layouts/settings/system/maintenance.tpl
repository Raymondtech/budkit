<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form class="form-horizontal padding-top">
        <div class="control-group">
            <label class="control-label" ><i class="icon-user-md icon-2x"></i></label>
            <div class="controls">
               
                <span class="help-block">It is important that you keep your site healthy.</span>
                <p class="margin-top-half"><strong>Performing a system check will..</strong></p>
                <ol class="help-block margin-top-half">
                    <li>Check for new versions of the platform as well as installed extensions</li>
                    <li>Clear the <em>/downloads</em> folder.</li>
                    <li>Check for any database inconsistencies</li>
                </ol> 
                <a href="/settings/system/maintenance/check" class="btn btn-success margin-top-half" >Check Now</a>
            </div>
        </div>
        <hr />
       <div class="control-group">
            <label class="control-label"><i class="icon-cogs icon-2x"></i></label>
            <div class="controls">
                <span class="help-block">Use this if for some reasons you want to clear all sessions on the system...</span>
                <p class="margin-top-half"><strong>Closing all sessions will</strong></p>
                <ol class="help-block margin-top-half">
                    <li>Delete all enteries in the sessions table</li>
                    <li>Force all user's to sign in again</li>
                </ol> 
                <a href="/settings/system/maintenance/check" class="btn btn-danger margin-top-half" >End All Sessions</a>
            </div>
        </div>
        <hr />
        <div class="control-group">
            <label class="control-label"><i class="icon-cogs icon-2x"></i></label>
            <div class="controls">
                <p class="margin-top-quater"><strong>To Manually Reset...</strong></p>
                <ol class="help-block">
                    <li>Rename the setup.ini file in your config folder to setup.ini.old</li>
                    <li>Delete your database manually if required. BK won't delete it for you</li>
                    <li>Delete the contents of the <em>/users</em> folder.</li>
                </ol>
                <p class="margin-top-half"><strong>Are you sure you want to do this?</strong></p>
                 <p class="help-block">If you are then click the button below. We will ask you for your password to confirm this</p>
                <a href="/settings/system/maintenance/check" class="btn btn-danger margin-top-half" >Factory Reset</a>
            </div>
        </div>
    </form>
</tpl:layout>

