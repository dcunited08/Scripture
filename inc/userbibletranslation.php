<?php // licence: gpl-signature.txt
$edmode=stripslashes($_GET['edmode']);
$checkowner=mysql_result(mysql_query('Select owner from bible_list where bid='.$b),0,'owner');
if(isset($_GET['newbible'])){$myowntranslation=stripslashes($_GET['newbible']);}
elseif($checkowner==$uid){$myowntranslation=$b;}
elseif(!empty($doeditb)){$myowntranslation=$doeditb;}
else{$myowntranslation=$myowntranslation=mysql_result(mysql_query('Select max(bid) from bible_list where owner='.$uid),0,'bid');}
$checkowner=mysql_result(mysql_query('Select owner from bible_list where bid='.$myowntranslation),0,'owner');
if($checkowner!==$uid){die('Access Denied');}
if(empty($edmode)and!isset($_GET['addbook'])){
    echo'<form action="index.php?mydata=6&edmode=1" method="post">
    Shortname: <input type="text" name="shortname"><br>
    Longname:<input type="text" name="longname"><br>
    Language:<input type="text" name="language"><br>
    <input type="hidden" name="mydata" value="6">
    <input type="submit" value="create">
    </form>';
}
elseif($edmode=='1'){
    $mysqldo_check = mysql_query("SELECT * FROM bible_list WHERE bsn='".$_POST['shortname']."'");
    $mysqldo_check=mysql_result($mysqldo_check,0,'bid');
    if($uid<1){die('Please login to start your own translation');}
    elseif(empty($mysqldo_check)){
	$edmode2='1';
	mysql_query("INSERT INTO bible_list (bsn, bname, lang, serialversion,owner) VALUES
		    ('".$_POST['shortname']."', '".$_POST['longname']."', '".$_POST['language']."','','$uid')");
	 $myowntranslation=mysql_result(mysql_query('Select bid from bible_list where bsn=\''.$_POST['shortname'].'\' AND owner='.$uid),0,'bid');
	 $newbible='&newbible='.$myowntranslation;
    }
    else{echo'Bible name in use; go back and try another.<br>';}
    //$mysqldo_update = "UPDATE bible_list SET bsn = '".substr($data[0],0,5)."' WHERE bname = '".$data[1]."'";
    
}elseif($edmode=='2'){$edmode2='1';}
elseif($edmode=='3'){
    if($uid<1){die('Please login to start your own translation');}
    $bookscheme=mysql_query('SELECT * from bible_book_name WHERE bid=1 and book=\''.$_GET['bk'].'\'');
    mysql_query('INSERT INTO bible_book_name (bid, bkid, book, fname, sname, chap) VALUES ('.$myowntranslation.', '.mysql_result($bookscheme,0,'bkid').', \''.mysql_result($bookscheme,0,'book').'\', \''.mysql_result($bookscheme,0,'fname').'\', \''.mysql_result($bookscheme,0,'sname').'\', \''.mysql_result($bookscheme,0,'chap').'\');');
}
if(isset($edmode2)or(isset($_GET['addbook']))){
    if($uid<1){die('Please login to start your own translation');}
    if(isset($edmode2)){$hl='&hl';$sql=mysql_query('SELECT distinct book FROM bible_headlines ORDER BY hid ASC;');}//if(isset($_GET['hl'])){
    else{$sql=mysql_query('SELECT distinct book FROM bible_context WHERE bid=1 ORDER BY vsid ASC;');}
    $n=mysql_numrows($sql);
    $sbook=array();
    for($i=0;$i<=$n; ++$i) {
        $sbook[$i]=mysql_result($sql,$i,'book');
    }
    echo'Click on the book you wish to translate:<table ><td>'; //align="left"
    $i=1;
    foreach ($sbook as $kb) {
        ++$i;
        $kb=strtoupper($kb);
        if ($kb=='GEN'){echo'</td><td valign="top">OT<br>';$i=1;}
        elseif ($kb=='MAT'){echo'</td><td valign="top">NT<br>';$i=1;}
        if ($i>=14){echo'</td><td valign="top"><br>';$i=0;}
        if(!empty($kb)){echo '<a href="index.php?b='.$myowntranslation.'&mydata=6&edmode=3&bk='.$kb.$newbible.'">'.$kb.'</a>'.N;}
    }
    echo'</td></table>';
}
echo'translation editor (under construction)';
?> 