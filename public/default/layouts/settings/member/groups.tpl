<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">  
        <div class="clearfix">
            <form class="pull-right no-margin form-horizontal" action="/settings/member/privacy/groups/edit" method="POST">   
                <input type="text" name="group-title" class="span2" placeholder="Group Title" />
                <tpl:condition data="groups" test="isset" value="1">
                    <select name="group-parent" id="authority-parent">
                        <option value="">No Parent (Root)</option>
                        <tpl:loop data="groups" id="authorities">
                            <option value="${group_id}">
                                <tpl:loop limit="indent"><span class="indenter">|--</span></tpl:loop>
                                <span><tpl:element type="text" data="group_title" /></span>
                            </option>
                        </tpl:loop>
                    </select>
                </tpl:condition>
                <input type="hidden" name="group-description" />
                <button type="submit" class="btn">Add Privacy Group</button>
            </form>
            <div class="btn-toolbar pull-left no-margin">
                <a class="btn-important btn" href="/settings/member/privacy" >Privacy Setting</a>
            </div>
        </div>
        <hr />
        <tpl:condition data="groups" test="isset" value="0">
            <p class="placeholder-text">You have not created any privacy groups. Categorizing your followers into groups helps control the people with whom you share stuff.</p>
        </tpl:condition>
        <tpl:condition data="groups" test="isset" value="1">
            <div class="widget">
                <div class="widget-head"><span class="widget-title"><tpl:element type="text" data="page.title">Privacy Groups</tpl:element></span></div>
                <div class="widget-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="span8">Name</th>    
                                <th class="span2" align="center">Members</th>
                                <th class="span2" align="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tpl:loop data="groups" id="authority-groups">
                                <tr>
                                    <td class="authority-name">
                                        <tpl:loop limit="indent"><span class="indenter">|--</span></tpl:loop>
                                        <a href="/settings/member/privacy/group/${group_id}"><tpl:element type="text" data="group_title" /></a>
                                    </td>
                                    <td align="center">0 members</td>
                                    <td class="text-center"><a href="/settings/member/privacy/edit/${group_id}">Edit</a></td>
                                </tr> 
                            </tpl:loop>
                        </tbody>
                    </table>
                </div>            
            </div>
        </tpl:condition>
    </div>
</tpl:layout>
