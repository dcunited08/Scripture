<?php // licence: gpl-signature.txt
$memory_start=memory_get_usage();
require('init.php');
//echo '<body  bgcolor="'.$fontbackground.'"><font size="'.$fontsize.'" color="'.$fontcolor.'" face="'.$fontface.'">';
$w="";if(empty($ismultib)){if(($b != '*')and($b != 'all')){$w .= ' AND bid=\''.$b.'\' ';}}
elseif($b != 'all'){$k=array_keys($ismultib);$sz=sizeOf($k);$w.=' AND (';for($nu=0;$nu<$sz;++$nu){if($nu!==0){$w.=' OR ';}$w.='(bid='.$ismultib[$k[$nu]].')';}$w.=') ';}
  
$biblespec_check=mysql_result(mysql_query('SELECT distinct bid FROM bible_headlines where bid='.$b),0,'bid');//dialhl
if(!empty($biblespec_check)){$bibspec=' where 1'.$w;$bibspec2=$w;}
elseif(!empty($mysettings[17])){$bibspec=' where bid='.$mysettings[17];$bibspec2=' and bid='.$mysettings[17];}
else{$bibspec=' where bid=1';$bibspec2=' and bid=1';}
if(!isset($_GET['bk'])) {
    if(isset($_GET['hl'])){$hl='&hl';$sql=mysql_query('SELECT distinct book FROM bible_headlines '.$bibspec.' ORDER BY hid ASC;');}
    else{$sql=mysql_query('SELECT distinct book FROM bible_context WHERE 1'.$w.' ORDER BY vsid ASC;');}
    $n=mysql_numrows($sql);
    $sbook=array();
    if(($l=='n')or($b==6)or($b==11)){$dolbd=1;$sbookl=array();}
    for($i=0;$i<=$n; ++$i) {
        $sbook[$i]=mysql_result($sql,$i,'book');
        if(isset($dolbd)){$sbookl[$i]=mysql_result(mysql_query('SELECT book from bible_book_name where sname=\''.mysql_result($sql,$i,'book').'\' and bid=6;'),0,'book');}
    }

    //require('inc/Languages/Filter_drupal.php');
    echo'<table ><td>'; //align="left"
    $i=1;$i2=0;
    foreach ($sbook as $kb) {
        ++$i;
        $kb=strtoupper($kb);
        //if ($i==7){echo'<p></p>';$i=0;}
        if ($kb=='GEN'){echo'</td><td valign="top">OT<br>';$i=1;}
        elseif ($kb=='MAT'){echo'</td><td valign="top">NT<br>';$i=1;}
        if ($i>=14){echo'</td><td valign="top"><br>';$i=0;}
        
        if(!empty($kb)and!isset($dolbd)){echo '<a href="bible_dial.php?b='.$b.'&bk='.$kb.$hl.'">'.$kb.'</a>'.N;++$i2;}
        elseif(!empty($kb)){echo '<a href="bible_dial.php?b='.$b.'&bk='.$kb.$hl.'">'.$sbookl[$i2].'</a>'.N;++$i2;}
        //if ($kb =='mat') {echo'</p><p>';$i=1;}
        //if ($kb =='mat') {echo'</td><td>';$i=1;}
    }
    //echo'</p>';
    echo'</td></table>';
}
elseif(isset($_GET['hl'])){
    $sql=mysql_query('SELECT * FROM bible_headlines WHERE BOOK=\''.$book.'\' '.$bibspec2.' ORDER BY hid ASC;');
    $n=mysql_numrows($sql);
    for($i=0;$i<=$n; ++$i) {
        $stit=mysql_result($sql,$i,'title');
        $schap=mysql_result($sql,$i,'chap');
        $sverse=mysql_result($sql,$i,'verse');
        $dialt="b=$b&s=".urlencode($book.' '.$schap.':'.$sverse);
        if(!empty($sverse)){echo"<a href='$subd/?$dialt'>$stit</a>".N;}
    }
}
else {
    $sql=mysql_query('SELECT count(distinct chapter) AS C FROM bible_context WHERE book=\''.$book.'\' '.$w.';');
    $sccount=mysql_result($sql,0,'C');
    $i2=1;$i3=0;
    echo'<table ><td>';//align="left"
    if($book=='PS'){$bmax=22;}
    else {$bmax=12;}
    $dialt="b=$b&bk=$book&cs";
    for($i=0;$i<$sccount; ++$i){
        ++$i3;
        echo"<a href='$subd/?$dialt=$i3&bdial'>$i3</a>".N;
        if($i2>$bmax){echo'</td><td valign="top">';$i2=0;}
        ++$i2;
    }
    echo'</td></table>';
}
if($uid==='1'){require('inc/benchmark.php');}
if(!empty($referer)and!isset($fp)and!isset($didback)){$didback=1;echo'<p><a href="'.$referer.'">Back</a> <a href="index.php?fp=1'.$bl.'">Menu</a></p>';}
//if(isset($_GET['largelist'])){$largelist=1;require('inc/bible_list.php');}
//elseif(!isset($_GET['hl'])and!isset($_GET['bk'])){echo NN.'<a href="?'.$_SERVER['QUERY_STRING'].'&largelist">List all bibles by language</a>';}
?>