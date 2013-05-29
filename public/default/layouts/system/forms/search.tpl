<tpl:layout name="search" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <form class="search-form margin-bottom-zero form-vertical inline-block" action="/system/search/graph" method="post"> 
        <div class="controls input-append margin-bottom-zero">
            <input type="text" class="input-xxxlarge" name="query" placeholder="Search" value="${query}" />
            <button type="submit" class="add-on"><i class="icon-search"></i> Search</button>
        </div>
    </form>
</tpl:layout>


