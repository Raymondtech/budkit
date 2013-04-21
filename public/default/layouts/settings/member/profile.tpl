<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding-top">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="/settings/member/profile/update">

            <div class="control-group">
                <label class="control-label"  for="middle-name">Profile photo</label>
                <div class="controls">
                    <tpl:condition data="profile.user_photo" test="isset" value="1">
                        <img class="add-on thumbnail pull-left margin-right" src="/system/object/${profile.user_photo}/resize/200/200" />
                    </tpl:condition>
                    <input type="file" name="profilephoto" data-label="Select Photo..." data-target="budkit-uploader" /> 
                </div>
            </div>
            <hr />
            <fieldset>
                <div class="control-group">
                    <label class="control-label"  for="middle-name">Biography</label>
                    <div class="controls">
                        <div class="input-append">
                            <textarea class="input-xxlarge pull-left" id="middle-name" name="middle-name" rows="7" ></textarea>  
                            <div class="btn-group">
                                <tpl:import layout="privacylist" />
                            </div>
                        </div>
                    </div>
                </div><!-- /control-group --> 
                <div class="control-group">
                    <label class="control-label"  for="middle-name">Website</label>
                    <div class="controls">
                        <div class="input-append">
                            <input class="input-xlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where have you worked?" />
                            <div class="btn-group">
                                <tpl:import layout="privacylist" />
                            </div>
                        </div>
                    </div>
                </div><!-- /control-group -->
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn">Save changes</button>
            </div>
        </form>
    </div>
</tpl:layout>