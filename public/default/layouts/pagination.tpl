<tpl:layout name="navbar" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition data="pagination" test="isset" value="1">
    <div class="pagination">
        <ul>
            <tpl:condition data="pagination.previous" test="isset" value="1">
                <li><a href="${pagination.previous}">Previous</a></li>
            </tpl:condition>
            <tpl:condition data="pagination.previous" test="isset" value="0">
                <li class="disabled"><a>Previous</a></li>
            </tpl:condition>
            <tpl:loop data="pagination.pages" id="pagination-items">
                <li  class="page ${state}"><a href="${link}"><tpl:element type="text" data="title" /></a></li>
            </tpl:loop>
            <tpl:condition data="pagination.next" test="isset" value="1">
                <li><a href="${pagination.next}">Next</a></li>
            </tpl:condition>
            <tpl:condition data="pagination.next" test="isset" value="0">
                <li  class="disabled"><a>Next</a></li>
            </tpl:condition>
        </ul>
    </div>
    </tpl:condition>
</tpl:layout>