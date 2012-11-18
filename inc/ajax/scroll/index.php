<?php
if(isset($_GET['sspeed'])){$sspeed=$_GET['sspeed'];}
else{$sspeed=9000;}
$headex='<script type="text/javascript">function pageScroll() {
    	window.scrollBy(0,50); // horizontal and vertical scroll increments
    	scrolldelay = setTimeout(\'pageScroll()\','.$sspeed.');
}
function stopScroll() {
    	clearTimeout(scrolldelay);
}</script>';# // scrolls every 100 milliseconds
if(!isset($password)){require('../../../index.php');}
$scrollstart='<a href="javascript:pageScroll()">Scroll Page</a>';
#<input type="button" onClick="pageScroll()" value="Scroll Page">
$scrollbload=' onLoad="pageScroll()"';
$scrollstop='<a href="javascript:stopScroll()">Stop Scrolling</a>';
$scrolll='&scroll';
$scrollcheck=' checked';
/*
//Scroll Directly to a Particular Point

function jumpScroll() {
   	window.scroll(0,150); // horizontal and vertical scroll targets
}

<a href="javascript:jumpScroll()">Jump to another place on the page</a> 
 
*/

?>