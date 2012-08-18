<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://tuiyo.co.uk/tpl">
    <ul class="nav nav-tabs admin-main-tabs" id="systemPreferences">
        <li class="active"><a data-target="#aPanel" data-toggle="tab"><i class="icon icon-ok-sign"></i> Published <span class="label label-important">34</span></a></li>
        <li><a data-target="#notifications" data-toggle="tab"><i class="icon icon-plus-sign"></i> Drafts <span class="label label-important">2</span></a></li>
        <li><a data-target="#moderation" data-toggle="tab"><i class="icon icon-question-sign"></i> Pending Review <span class="label label-important">5</span></a></li>
        <li><a data-target="#live" data-toggle="tab"><i class="icon icon-trash"></i> Trash <span class="label label-important">97</span></a></li>
    </ul>
    <form class="form-horizontal">
        <fieldset class="no-margin">
            <div class="content-list">
                
                <table class="table table-striped">
                    <!-- Colgroup -->  
                    <colgroup>  
                        <col class="col-odd" />  
                        <col class="col-even" />  
                        <col class="col-odd" />  
                        <col class="col-even" />  
                    </colgroup> 
                    <thead>
                        <tr>
                            <th scope="col" id="post_selector"><input type="checkbox" data-check="content" /></th>
                            <th scope="col" id="post_title">Title</th>
                            <th scope="col" id="post_author">Author</th>
                            <th scope="col" id="post_comments">Comments</th>
                            <th scope="col" id="post_date">Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < 30; $i++): ?>
                        <tr>
                            <td width="1%"><input type="checkbox"  data-selector="content" /></td>
                            <td class="span7"><a href="#">This is a quite relatively long but yet simple, and minimal Post Title and a summary</a></td>
                            <td class="span2"><a href="#">Livingstone Fultang</a></td>
                            <td class="span1">43</td>
                            <td class="span1">Date</td>
                        </tr>
                        <?php endfor ; ?>
                    </tbody>
                </table>
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

