<tpl:layout  name="timeline" xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <div class="padding">
        <div class="clearfix">
            <h1 class="margin-bottom-zero pull-left"><tpl:element type="text" data="page.title" /></h1>
            <div class="btn-group pull-right no-margin">
                <a class="btn-important btn" href="/system/appointments/event/create" >Add New Event</a>
            </div>
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