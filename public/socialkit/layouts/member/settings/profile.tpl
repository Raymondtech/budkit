<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="navbar navbar-subnav margin-bottom">
        <div class="navbar-inner padding-left-half">
            <ul class="nav" id="profileeditmenu">
                <li class="active"><a data-target="#appearance" data-toggle="tab"><i class="icon-camera-retro icon icon-16"></i>Appearance</a></li>                 
                <li><a data-target="#biography" data-toggle="tab"><i class="icon-user icon icon-16"></i>Biography</a></li> 
                <li><a data-target="#contact" data-toggle="tab"><i class="icon-globe icon icon-16"></i>Contact</a></li>
                <li><a data-target="#external" data-toggle="tab"><i class=" icon-plus-sign-alt icon icon-16"></i>Linked Profiles</a></li>

            </ul>
        </div>
    </div>
    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="/member/settings/profile/update">
        <div class="tab-content">
            <div class="tab-pane active" id="appearance">
                <div class="control-group">
                    <label class="control-label"  for="middle-name">Photo</label>
                    <div class="controls">
                        <div class="input-append"> 
                            <input type="file" name="profilephoto" data-label="Select Photo..." data-target="budkit-uploader" /> 
                            <a class="add-on btn">Chose from existing</a>
                            <div class="btn-group">
                                <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <tpl:condition data="profile.user_photo" test="isset" value="1">
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Current</label>
                        <div class="controls">
                            <img class="add-on thumbnail" src="/system/object/${profile.user_photo}/resize/200/200" />
                        </div>
                    </div>
                </tpl:condition>
            </div>
            <div class="tab-pane" id="biography">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Biography</label>
                        <div class="controls">
                            <div class="input-append">
                                <textarea class="input-xxlarge pull-left" id="middle-name" name="middle-name" rows="7" ></textarea>                              
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group --> 
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Website</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where have you worked?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <span class="help-block">Website privacy</span>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Education</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where did you go to school?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                </fieldset>
                <hr />
                <fieldset>
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Occupation</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="what do you do?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /control-group -->
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Employment</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where have you worked?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Education</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where did you go to school?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                </fieldset>
            </div>
            <div class="tab-pane" id="contact">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label"  for="email">Email address</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="email" name="email" size="100" type="text" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                            <a  href="#" class="help-block">Add more</a>
                        </div>
                    </div><!-- /control-group -->
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Phone Number</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where did you go to school?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                    <hr />
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Address</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="what do you do?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /control-group -->
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">City/Town</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where have you worked?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Zip/Postal Code</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where did you go to school?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                    <hr />
                    <div class="control-group">
                        <label class="control-label"  for="middle-name">Website</label>
                        <div class="controls">
                            <div class="input-append">
                                <input class="input-xxlarge" id="middle-name" name="middle-name" size="30" type="text" placeholder="Where did you go to school?" />
                                <div class="btn-group">
                                    <a class="add-on btn dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> Public <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /control-group -->
                </fieldset>
            </div>
        </div>
        <div class="form-actions">
            <input type="submit" class="btn primary" value="Save changes" />&#160;<button type="reset" class="btn">Cancel</button>
        </div>

    </form>

</tpl:layout>