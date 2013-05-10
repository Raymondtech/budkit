<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="margin-top-double">
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
                    <label class="control-label"  for="profile[user_headline]">Profile Title</label>
                    <div class="controls">
                        <div class="input-append">
                            <input class="input-xxlarge" id="user_headline" name="profile[user_headline]" size="30" type="text" placeholder="E.g PhD Student, or Chief Executive Officer at Company X" value="${profile.user_headline}" />
                            <div class="btn-group">
                                <tpl:import layout="privacylist" />
                            </div>
                        </div>
                    </div>
                </div><!-- /control-group -->
                <div class="control-group">
                    <label class="control-label"  for="profile[user_biography]">Biography</label>
                    <div class="controls">
                        <div class="input-append">
                            <textarea class="input-xxlarge pull-left" id="user_biography" name="profile[user_biography]" rows="7" ><tpl:element type="text" data="profile.user_biography" /></textarea>  
                            <div class="btn-group">
                                <tpl:import layout="privacylist" />
                            </div>
                        </div>
                    </div>
                </div><!-- /control-group --> 
                <div class="control-group">
                    <label class="control-label"  for="profile[user_website]">Website</label>
                    <div class="controls">
                        <div class="input-append">
                            <input class="input-xlarge" id="user_website" name="profile[user_website]" size="30" type="text" placeholder="http://yourwebsite.com" value="${profile.user_website}" />
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