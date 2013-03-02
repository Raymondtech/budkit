<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">

    <tpl:condition  data="user.isauthenticated" test="boolean" value="1" >
        <ul class="nav nav-list">
            <li class="nav-header">Trending</li>
            <li><a href="#"><i class="icon-caret-up" style="color: green"></i>Some item</a></li>
            <li><a href="#"><i class="icon-caret-up" style="color: green"></i>PSG vs OM</a></li>
            <li><a href="#"><i class="icon-caret-up" style="color: green"></i>Some item</a></li>
            <li><a href="#"><i class="icon-caret-down" style="color: red"></i>Joey Barton</a></li>
            <li><a href="#"><i class="icon-caret-up" style="color: green"></i>The Oscars</a></li>
            <li><a href="#"><i class="icon-caret-down" style="color: red"></i>ShutUpAndDrive</a></li>
        </ul>
       
        <ul class="nav nav-list">
            <li class="nav-header">Recently Online</li>
            <li><a href="#">
                    <i class="icon-circle" style="color: green"></i>
                    Peter Chater
                </a>
            </li>
            <li><a href="#"><i class="icon-circle" style="color: green"></i> Tanya Vyland</a></li>
            <li><a href="#"><i class="icon-circle" style="color: green"></i> Joshua Fultang</a></li>
            <li><a href="#"><i class="icon-circle" style="color: orange"></i> Rudolf Sanchez</a></li>                  
            <li><a href="#"><i class="icon-circle" style="color: green"></i>  Peter Rachmore</a></li>
            <li><a href="#"><i class="icon-circle" style="color: green"></i>  Esteban Morackash</a></li>
            <li><a href="#"><i class="icon-circle" style="color: red"></i>  Tatiana Menandez</a></li>
            <li><a href="#"><i class="icon-circle" style="color: green"></i> Sophia Young</a></li>                      
            <li><a href="#"><i class="icon-circle" style="color: green"></i> Rita Derry</a></li>
            <li><a href="#"><i class="icon-circle" style="color: orange"></i> Ophelia Bains</a></li>
            <li><a href="#"><i class="icon-circle" style="color: red"></i> Stanislas Kopyov</a></li>
            <li><a href="#"><i class="icon-circle" style="color: green"></i> Bronco Cho</a></li>
            <li><a href="#"><i class="icon-circle" style="color: orange"></i> Feng Cheng</a></li>
            <li><a href="#"><i class="icon-circle" style="color: red"></i> Barry Burst</a></li>
        </ul>
    </tpl:condition>
    <tpl:block data="page.block.aside">Asidebar</tpl:block>
</tpl:layout>


