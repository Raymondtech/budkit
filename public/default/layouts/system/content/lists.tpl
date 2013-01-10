<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="left-pad right-pad top-pad">
        <div class="page-header">
            <h1>Moderation Queue</h1>
        </div>
        <div class="btn-toolbar">
            <div class="btn-group  pull-right">
                <button class="btn">Content Type...</button>
                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <button class="btn">Apply Actions</button>
                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                    <li><a href="#">Move Somewhere</a></li>
                </ul>
            </div>
        </div>
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
                                <th scope="col" id="post_comments">Flags</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                            <?php for ($i = 0; $i < 10; $i++): ?>
                            <tr>
                                <td width="1%"><input type="checkbox"  data-selector="content" /></td>
                                <td class="span7"><a href="#">This is a quite relatively long but yet simple, and minimal Post Title and a summary</a></td>
                                <td class="span2"><a href="#">Livingstone Fultang</a></td>
                                <td class="span1">1</td>
                            </tr>
                            <?php endfor ; ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </form>
    </div>
</tpl:layout>

