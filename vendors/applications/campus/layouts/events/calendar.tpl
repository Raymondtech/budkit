<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">
                <div class="clearfix">
            <ul class="nav nav-pills  pull-right nav-mediagrid no-margin" id="calendartoggler">
                <li class="active"><a data-target=".media-gallery"  data-toggle="media-grid" title="Grid"><i class="icon-calendar icon-16"></i></a></li>
                <li><a data-target=".media-gallery"  data-toggle="media-list" title="List"><i class="icon-th-list icon-16"></i></a></li>
            </ul>
            <ul class="nav nav-pills no-margin">
                <li class="highlighted"><a href="/system/media/create" >Add New Event</a></li>
            </ul>
        </div>
        <hr />
        <div class="widget">      
            <div class="widget-body">
                <div id="month-calendar"></div>
            </div>
        </div>
    </div> 
    <script type="text/javaScript">
        <![CDATA[
            !function($){
                $('#month-calendar').fullCalendar({ header:{ left: 'prev,next today',center: 'title',right: 'month,basicWeek,basicDay'},editable: true, events:[] });
            }( window.jQuery );
        ]]> 
    </script>
</tpl:layout>