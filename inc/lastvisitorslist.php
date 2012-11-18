<?php // licence: gpl-signature.txt
if(!isset($password)){require('../init.php');}
if($uid!=='1'){die('access denied');}
else{
    echo'datetime _|_ uid _|_ user _|_ ip _|_ url _|_ referer _|_ agent<br>';
    //echo'<table border="1" width="100%"><tr><td>uid</td><td>user</td><td>ip</td>
    //<td>new</td><td>url path</td>
    //<td>referer</td><td>datetime______</td><td>agent</td></tr>';
    $wwwdel=array('http://scripture.sourceforge.net/','http://','www.','http://googleads.g.doubleclick.net/pagead/ads?client=');
    echo'<div id="updatevis"></div>';
}
?>