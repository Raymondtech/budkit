<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <ul class="nav nav-tabs admin-main-tabs" id="systemPreferences">
        <li class="active"><a data-target="#lists" data-toggle="tab">All Members</a></li>
        <li><a data-target="#types" data-toggle="tab">Member Types</a></li>
        <li><a data-target="#attributes" data-toggle="tab">Attributes</a></li>
        <li><a data-target="#connectionrules" data-toggle="tab">Relationships</a></li>
        <li><a data-target="#definitions" data-toggle="tab">Definitions</a></li>
    </ul>

    <form class="form-horizontal">
        <fieldset class="no-margin">
            <div class="content-list">

                <ul class="grid-list grid-list-striped">

                    <li class="row-fluid grid-list-head">
                        <div class="span left-pad" align="center"><input type="checkbox" data-check="member" /></div>
                        <div class="span1">&nbsp;</div>
                        <div class="span6">Full Name</div>
                        <div class="span2">User Name</div>
                        <div class="span2">Actions</div>
                    </li>

                    <?php for ($i = 0; $i < 30; $i++): ?>
                    <li class="row-fluid">
                        <div class="span left-pad" align="center"><input type="checkbox" data-selector="member" /></div>
                        <div class="span1"><img class="profile-avatar" src="https://si0.twimg.com/profile_images/1734672571/logo_normal.png" alt="Livingstone Fultang" width="48" height="48" /></div>
                        <div class="span6"><a href="#">Livingstone Kimbi Fatele Fultang</a></div>                  
                        <div class="span2">Category</div>
                        <div class="span2">Tags</div>
                    </li>
                    <?php endfor ; ?>
                </ul>
            </div>
            <div class="row-fluid">
                <div class="span2">
                    <div class="btn-group pull-left">
                        <button class="btn">Apply Actions</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Edit</a></li>
                            <li><a href="#">Delete</a></li>
                            <li><a href="#">Move Somewhere</a></li>
                        </ul>
                    </div>
                </div>
                <div class="span8">
                    <div class="pagination no-margin" align="center">
                        <ul>
                            <li class="disabled"><a href="#">«</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">6</a></li>
                            <li><a href="#">7</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>

                <div class="span2">
                    <div class="pagination no-margin pull-right">
                        <ul>
                            <li class="active"><a href="#"><i class="icon  icon-th-list"></i> List</a></li>
                            <li><a href="#"><i class="icon  icon-th"></i> Grid</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</tpl:layout>
