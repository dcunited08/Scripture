<?php // licence: gpl-signature.txt
    $extra_secu="SELECT uid FROM sessions WHERE hostname='$remoteaddr' AND sid LIKE '".md5($user_extra_sec.session_id())."'";
    //echo md5($user_extra_sec.session_id()).'<br>'.$remoteaddr;
    $row_secu=mysql_query($extra_secu);
    $found_secu=mysql_result($row_secu,0,'uid');
    if(empty($found_secu)) {
	$u = 'demo';$uid='0';
	$extrasecf='1';
    //sleep(604800);
    }
?>