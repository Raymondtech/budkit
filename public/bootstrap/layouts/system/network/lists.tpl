<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
   
    
     <div class="btn-toolbar">
        <div class="btn-group">
            <a class="btn" href="/system/admin/content/lists/filter/pending">Active</a>
            <a class="btn" href="/system/admin/content/lists/filter/drafts">Deactivated</a>
            <a class="btn" href="/system/admin/content/lists/filter/pending">Blocked</a>
            <a class="btn" href="/system/admin/content/lists/filter/trash">Deleted</a>
        </div>
        <div class="btn-group ">
            <button class="btn">Member Type...</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>

        <div class="btn-group pull-right">
            <button class="btn">Apply Actions</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Edit</a></li>
                <li><a href="#">Delete</a></li>
                <li><a href="#">Move Somewhere</a></li>
            </ul>
        </div>
         
         <div class="btn-group pull-right">
             <button class="btn"><i class="icon icon-plus"></i> New Member</button>
         </div>
    </div>

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
            <hr class="no-margin" />
            <div class="row-fluid">
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
        </fieldset>
    </form>
</tpl:layout>
