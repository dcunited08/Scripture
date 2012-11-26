<?php # licence: gpl-signature.txt
if ($user == 'demo') { die('Login required to use this feature'); }
if(!empty($_POST['notedelete']) && !empty($_POST['lookupnote'])) {
    $mysqldo2 = "DELETE FROM bible_quicknotes WHERE nid = ".$_POST['lookupnote']." AND uid=$uid"; echo'Note removed<br>';
}
elseif(!empty($_POST['notetitle']) && empty($_POST['lookupnote']) && empty($_POST['newnote'])) {
    echo'Note Saved'.N;
    if(empty($jedit)){$noteset=preg_replace('/(\r\n)/','<br>',$_POST['setmynote']);}
    else{$noteset=stripslashes($_POST['setmynote']);}
    require('inc/tag_filter.php');
    $noteset = htmlentities(preg_replace($tag_filter,"",$noteset),ENT_QUOTES,'UTF-8');
    $titleset = htmlentities(preg_replace($tag_filter,"",$_POST['notetitle']),ENT_QUOTES,'UTF-8');
    if ($_POST['notetitle'] ==stripslashes($_POST['noted'])) { $mysqldo2 = "UPDATE bible_quicknotes SET note = '$noteset',updated= UNIX_TIMESTAMP() WHERE nid = ".$_POST['notenid']." AND uid=$uid";}
    else { $mysqldo2 ="INSERT INTO bible_quicknotes (nid, title, uid, status, created, updated, note) VALUES (NULL, '$titleset',$uid,1,  UNIX_TIMESTAMP(), UNIX_TIMESTAMP() ,'$noteset')"; }
}
if (!empty($mysqldo2)) { mysql_query_s($mysqldo2); }
if (empty($_POST['newnote'])) {
    if(!empty($_POST['lookupnote'])) {$mysqldo = "SELECT * FROM bible_quicknotes WHERE nid='".$_POST['lookupnote']."' AND uid=$uid;";}
    else { $mysqldo = 'SELECT * FROM bible_quicknotes WHERE uid='.$uid.' ORDER BY updated DESC LIMIT 1;'; }
    //  $mysqldo ="INSERT INTO ".".bible_quicknotes (nid, title, uid, status, created, updated, note) VALUES (NULL, '".$_GET['notetitle']."',$uid,'1',  NOW(), NOW() ,'".$_GET['setmynote']."')";
    $result8=mysql_query_s($mysqldo);$sqlnote=mysql_result($result8,0,'note');
    if(empty($ckedit)){$sqlnote=str_replace(htmlentities('<br>'),"\r\n",$sqlnote);$sqlnote=str_replace(htmlentities('<p></p>'),"\r\n\r\n",$sqlnote);}
    $sqlnid=mysql_result($result8,0,'nid');$sqltitle=mysql_result($result8,0,'title'); //these following need some tweaks
    //if (!empty($jedit)and (preg_match('/(<br[\\]?\>)|(<p><\/p>)/i',$sqlnote)===FALSE)){$sqlnote = preg_replace('/(\r\n)/','<br>',$sqlnote);}//\G(?!.*<body>).* //needs better fix
    if (empty($jedit)and preg_match('/(<br\\?>)|(<p><\/p>)/i',$sqlnote)){echo'hey2';$sqlnote = preg_replace('/\G(?!.*<body>).*(<p><\/p>|<br[\\]?\>)\r/i','\r\n',$sqlnote);}
}
echo $jedit.'<form action="index.php?mypage=1&b='.$b.'" method="post" enctype="multipart/form-data">
<input type="hidden" name="noted" value="'.$sqltitle.'">
<input type="hidden" name="notenid" value="'.$sqlnid.'">
    <select style="width:91" name="lookupnote">
<option selected  value="">Quicknotes</option>';
$result8=mysql_query_s('SELECT nid,title FROM bible_quicknotes WHERE uid='.$uid.' ORDER BY updated DESC;');
$num8=mysql_numrows($result8);if($uid==0){$num8=20;}
for($i=0;$i<$num8; ++$i) {
    $sqlnid2=mysql_result($result8,$i,'nid');
    $sqltitle2=mysql_result($result8,$i,'title');
    if(!empty($sqlnid2)){echo'<option value="'.$sqlnid2.'">'.$sqltitle2.'</option>';}
}
echo'</select>Title: <input type="text" name="notetitle" value="'.$sqltitle.'"><br><textarea'.$ckedit.' name="setmynote" style="width:100%;height:300px;">'.$sqlnote.'</textarea><br>
<input type="submit" value="Go"><input type="submit" name="notedelete" value="Delete"><input type="submit" name="newnote" value="New"></form>';

if(!empty($_GET['listdelete']) && (!empty($_GET['s']) or !empty($_GET['s2']))) {
    $linetodel=stripslashes($_GET['s']).$_GET['s2'];
    mysql_query_s("DELETE FROM bible_userlists WHERE line = '$linetodel' AND uid=$uid"); 
    mysql_query_s("DELETE FROM bible_userlisthist WHERE line = '$linetodel' AND uid=$uid"); echo'List removed'.N;
}
elseif(!empty($_POST['addlist']) && !empty($_POST['addlistname'])) {
    echo'List Saved'.N;
    if(!isset($tag_filter)){require('inc/tag_filter.php');}
    mysql_query_s("INSERT INTO bible_userlists (nid, title, uid, status, created, updated, line) VALUES (NULL, '".htmlentities(preg_replace($tag_filter,'',$_POST['addlistname']),ENT_QUOTES,'UTF-8')."',$uid,1,  UNIX_TIMESTAMP(), UNIX_TIMESTAMP() ,'".htmlentities(preg_replace($tag_filter,'',$_POST['addlist']))."')"); 
}

//my list
echo'<form action="index.php" method="get" enctype="multipart/form-data">
    <input type="hidden" name="b" value="'.$b.'">
    <select style="width:85" name="s"><option selected  value="">My list</option>';
    $result8=mysql_query_s('SELECT * FROM bible_userlists WHERE uid='.$uid.' ORDER BY updated DESC;');
    $num8=mysql_numrows($result8);if($uid==0){$num8=20;}
    for($i=0;$i<$num8; ++$i) {
        $listhisttitle=substr(mysql_result($result8,$i,'title'),0,100);
         if(!empty($listhisttitle)){echo'<option value="'.mysql_result($result8,$i,'line').'">'.$listhisttitle.'</option>';}
    }
echo'</select><select style="width:85" name="s2"><option selected  value="">History</option>';
    $result8=mysql_query_s('SELECT * FROM bible_userlisthist WHERE uid='.$uid.' ORDER BY updated DESC;');
    $largehis=array();$i3=0;
    $num8=mysql_numrows($result8);if($uid==0){$num8=20;}
    for($i=0;$i<$num8; ++$i) {
        $sqlnote=mysql_result($result8,$i,'line');
        if(!empty($sqlnote)){
        $sqltitle=date('dMy H:i', mysql_result($result8,$i,'updated'));
        if(count(explode('.',$sqlnote))>2){$largehis[$i3]='<option value="'.$sqlnote.'">'.substr($sqlnote,0,100).'&nbsp;|&nbsp;'.$sqltitle.'</option>';++$i3;}
        else{ echo'<option value="'.$sqlnote.'">'.substr($sqlnote,0,100).'&nbsp;|&nbsp;'.$sqltitle.'</option>'; }
        }
    }
echo'</select><br><select style="width:85" name="s3"><option selected  value="">Large History</option>';
foreach($largehis as $thelargeh){echo$thelargeh;}
echo'</select><input type="submit" name="listgo" value="Go"><input type="submit" name="listdelete" value="Delete"></form>
    <form action="index.php?mypage=1&b='.$b.'" method="post" enctype="multipart/form-data">
    New list: <input type="text" name="addlist">Name: <input type="text" name="addlistname">
    </select><input type="submit" value="Save"></form>'; //insert where oldest min()
unset($sqlnote,$sqltitle,$mysqldo2,$mysqldo);
# licence: gpl-signature.txt?>