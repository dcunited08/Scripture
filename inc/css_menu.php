<?php
echo'
#menuh-container {position: absolute;top: 1em;left: 1em;}
#menuh {font-size: small;font-family: arial, helvetica, sans-serif;
width:100%;float:left;margin:2em;margin-top: 1em;}

#menuh a {text-align: center;display:block;
border: 1px solid #0040FF;white-space:nowrap;
margin:0;padding: 0.3em;}

#menuh a:link, #menuh a:visited, #menuh a:active {color: white;background-color: #0040FF;text-decoration:none;}
#menuh a:hover {color: white;background-color: #668CFF;text-decoration:none;}
#menuh a.top_parent, #menuh a.top_parent:hover {background-image: url(navdown_white.gif);
background-position: right center;background-repeat: no-repeat;}

#menuh a.parent, #menuh a.parent:hover {background-image: url(nav_white.gif);
background-position: right center;background-repeat: no-repeat;}

#menuh ul {list-style:none;margin:0;padding:0;float:left;width:9em;}
#menuh li {position:relative;min-height: 1px;vertical-align: bottom;}
#menuh ul ul {position:absolute;z-index:500;top:auto;display:none;padding: 1em;margin:-1em 0 0 -1em;}
#menuh ul ul ul {top:0;left:100%;}

div#menuh li:hover {cursor:pointer;z-index:100;}
div#menuh li:hover ul ul,
div#menuh li li:hover ul ul,
div#menuh li li li:hover ul ul,
div#menuh li li li li:hover ul ul
{display:none;}

div#menuh li:hover ul,
div#menuh li li:hover ul,
div#menuh li li li:hover ul,
div#menuh li li li li:hover ul
{display:block;}';
?>