<tpl:layout name="console" xmlns:tpl="http://budkit.org/tpl">
    <tpl:condition data="debug.displaylog" test="boolean" value="1"> 
        <div class="console padding">
            <div class="console-inner">
                <div class="body">
                    <tpl:loop data="debug.log">
                        <div class="alert-message block-message ${type}">
                            <strong><tpl:element type="text" data="title" /></strong>
                            <p><pre class="prettyprint linenums php"><tpl:element type="text" data="string" /></pre></p>
                        </div>
                    </tpl:loop>         
                </div>
                <div class="footer top-pad">
                    <ul class="unstyled">
                        <li><tpl:element type="text" formatting="sprintf" data="debug.speed">Request completed in %s ms. </tpl:element></li>
                        <li><tpl:element type="text" formatting="sprintf" data="debug.queries">%s database queries executed. </tpl:element></li>
                        <li><tpl:element type="text" formatting="sprintf" data="debug.memory">Memory usage %s</tpl:element></li>
                    </ul>
                </div>
            </div>
        </div>
    </tpl:condition>
</tpl:layout>
