<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div id="extensionInstaller" class="workspace-head">
        <ul class="nav icon-tabs left no-margin no-bottom-border docked-bottom">
            <li class="active"><a data-target="#allextensions" data-toggle="tab">All Extensions</a></li>
            <li><a data-target="#installedapps" data-toggle="tab">Applications</a></li>
            <li><a data-target="#installedplugins" data-toggle="tab">Plug-ins</a></li>
            <li><a data-target="#installedthemes" data-toggle="tab">Themes</a></li>
            <li><a data-target="#updateapps" data-toggle="tab">Updates</a></li>
        </ul>
    </div>
    <div class="tab-content box-padding">
        <div class="tab-pane active" id="allextensions">
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
                                    <th scope="col" id="post_selector"><input type="checkbox" /></th>
                                    <th scope="col" id="post_title">Title</th>
                                    <th scope="col" id="post_author">Author</th>
                                    <th scope="col" id="post_category">Category</th>
                                    <th scope="col" id="post_tags">Tags</th>
                                    <th scope="col" id="post_comments">Comments</th>
                                    <th scope="col" id="post_date">Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                <?php for ($i = 0; $i < 30; $i++): ?>
                                <tr>
                                    <td><input type="checkbox" /></td>
                                    <td>Post Title and a summary</td>
                                    <td>Author</td>
                                    <td>Category</td>
                                    <td>Tags</td>
                                    <td>Comments</td>
                                    <td>Date</td>
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
        </div>
        <div class="tab-pane" id="installedthemes">Themes</div>
        <div class="tab-pane" id="installedapps">Applications</div>
        <div class="tab-pane" id="installedplugins">Plugins</div>
        <div class="tab-pane" id="updateapps">Updates</div>
    </div>
</tpl:layout>

