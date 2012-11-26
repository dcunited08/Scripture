<?php # licence: gpl-signature.txt
$memory_start=memory_get_usage();
if(!isset($uid)){require('init.php');}
if ($uid == '1')  {
      //$modedisplaydata = '1';
      $time=explode(' ',microtime());$time=$time[1] + $time[0];$start=$time;
      //error_reporting(E_ALL);
      error_reporting(E_ERROR | E_PARSE); // | E_WARNING
}
$dial=stripslashes($_GET['dial']);
$book=urldecode(stripslashes($_GET['bk']));
//echo '<body  bgcolor="'.$fontbackground.'"><font size="'.$fontsize.'" color="'.$fontcolor.'" face="'.$fontface.'">';
    if ($uid!=='1'){$sql='SELECT * FROM bible_super_dial WHERE global=1 or uid=\''.$uid.'\';';}
    else {$sql='SELECT * FROM bible_super_dial';}
    $sql=mysql_query_s($sql);$n=mysql_numrows($sql);
    $sbook=array();$smid=array();$smidc=array();
    if (!isset($_GET['dial'])and!isset($_GET['newmap'])){echo'<table border="1"><td><u>Topic Maps</u><br>';}
    $i2=0;
    for($i=0;$i<=$n; ++$i) {
        ++$i2;
        $smid[$i]=mysql_result($sql,$i,'mid');$mid=$smid[$i];$sbook[$mid]=mysql_result($sql,$i,'title');
        $suid[$mid]=mysql_result($sql,$i,'uid');$smidc[$mid]=mysql_result($sql,$i,'midc');
        $sglobal[$mid]=mysql_result($sql,$i,'global');$sshared[$mid]=mysql_result($sql,$i,'shared');
        $sreadwrite[$mid]=mysql_result($sql,$i,'readwrite');$slevels[$mid]=mysql_result($sql,$i,'levels');
        if (!isset($_GET['dial'])and!isset($_GET['newmap'])and!empty($mid)) {
            if ($i2>=14){echo'</td><td>'.N;$i2=0;}
            echo '<a href="/?topic&b='.$b.'&dial='.$mid.'">'.$mid.' '.$sbook[$mid].'</a>'.N;
        }
    }
    if (!isset($_GET['dial']) && !isset($_GET['newmap'])) {echo'</td></table>';}
    
    $superuser=$suid[$dial];
    if(($superuser==$uid)or($uid=='1')){$dosuperuser='1';}
     
if(isset($_GET['setsettings'])) {
    if (!empty($_GET['dial'])){$dial=stripslashes($_GET['dial']);}else{$dial="";}
    if (!empty($_POST['title'])){$utitle=stripslashes($_POST['title']);$utitle_ =" ,title='$utitle' ";}
    if (!empty($_POST['levels'])){$ulevels=stripslashes($_POST['levels']);$ulevels_ =" ,levels='$ulevels' ";}
    else{$ulevels_ =" ,levels='' ";}
    if (!empty($_POST['global'])){$uglobal=stripslashes($_POST['global']);$uglobal_ =" ,`global`='$uglobal' ";}
    if (!empty($_POST['shared'])){$ushared=stripslashes($_POST['shared']);$ushared_ =" ,shared='$ushared' ";}
    if (!empty($_POST['readwrite'])){$ureadwrite=stripslashes($_POST['readwrite']);$ureadwrite_ =" ,readwrite='$ureadwrite' ";}
    if (!empty($_POST['mapto'])){$umapto=stripslashes($_POST['mapto']);$umapto_ =" ,midc='$umapto' ";}
    if (!empty($_POST['owner'])){$uowner=stripslashes($_POST['owner']);$uowner_ =" ,uid='$uowner' ";}
    echo$_POST['title'].N;
    $setsettings="";
    if (($u !== 'demo')and((($uid==$suid[$dial])or($uid=='1')))or(empty($dial))) {
        if (!empty($dial)) {
            mysql_query_s("UPDATE bible_super_dial SET mid=$dial $utitle_ $ulevels_ $uglobal_ $ushared_ $umapto_ $uowner_ WHERE mid=$dial;");
        } else { mysql_query_s("INSERT INTO bible_super_dial (title, levels, `global`, shared,readwrite,midc,uid)
                 VALUES ('$utitle', '$ulevels', '$uglobal', '$ushared', '$ureadwrite','$umapto',$uid);");
        } // title,levels,global,shared,readwrite,mapto
        echo'Map edited<p></p>';
    } else { echo'Please login to edit maps<p></p>';}
}
elseif(isset($_GET['post'])){
    //bible_super_dial_contextpidmiduidbooktype date trioargcontexttitleverses,firstyear,lastyear
    if($u=='demo'){die('access denied');}
    if(!empty($dial)){
    $date=time();
    $mysqldo = 'INSERT INTO bible_super_dial_context (pid,mid,uid,book,type,date,trioarg,title,context,verses,firstyear,lastyear)
	VALUES (NULL,'.$dial.','.$uid.',\''.$_POST['book'].'\','.$_POST['type'].','.$date.',\''.$_POST['trioarg'].'\',\''.str_replace('\'',"\'",$_POST['title']).'\',\''.str_replace('\'',"\'",$_POST['context']).'\',\''.str_replace('\'',"\'",str_replace(';',"\;",$_POST['verses'])).'\',\''.$_POST['firstyear'].'\',\''.$_POST['lastyear'].'\')';
    mysql_query_s($mysqldo) or die(mysql_error());
  }
}
elseif(isset($_GET['settings']) or isset($_GET['newmap'])){
    if((!empty($dial) and ($suid[$dial]!==$uid) and ($uid!=='1'))or(empty($dial) && ($u=='demo'))){die('access denied');}
    echo '<form action="/?topic&b='.$b.'&dial='.$dial.'&setsettings=1" method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title" value="'.$sbook[$dial].'"><br>
    Limit to jump/s: <input type="text" name="levels" value="'.$slevels[$dial].'">'.N;
    if (empty($suid[$dial])){$owner=$uid;}else{$owner=$suid[$dial];}
if ($uid=='1'){echo 'Owner: <input style="width:40" type="text" name="owner" value="'.$owner.'"><br><select style="width:60" name="global"><option selected  value="">Global</option><option value="1">Yes</option><option value="0">No</option></select>';}
echo'
<select style="width:64" name="shared"><option selected  value="">Shared</option><option value="1">Yes</option><option value="0">No</option></select>
<select style="width:68" name="readwrite"><option selected  value="">Allow Write Access</option><option value="1">Yes</option><option value="0">No</option></select>
<select style="width:100" name="mapto"><option selected  value="">Connect map to</option>';
foreach($smid as $smids) {
    if (!empty($smids)&&($smids!==$dial)){echo '<option value="'.$smids.'">'.$smids.' '.$sbook[$smids].'</option>';}
}
echo'</select><input type="submit" value="Go"><p>Help</p>Jumps - How many connections to go through from connected target(Keep empty for all)</form>';
}
elseif (!empty($dial)) {
    if(!isset($_GET['new'])){$newentry=' <a href="/?topic&b='.$b.'&new=1&dial='.$dial.'&bk='.urlencode($book).'">New Entry</a>';}
    $connect=$smidc[$dial];
    $connect2=$connect;
    if(empty($slevels[$dial])){$slevels[$dial]='1000';}
    $slevelupper=$slevels[$dial];
    if(!empty($connect)){
        for($i=0;$i<$slevelupper;++$i){
            $connect2=$smidc[$connect2];
            if(!empty($connect2)){$connect=$connect2.','.$connect; }
            else {break;}
        }
        $connect=$connect.','.$dial;
        $connect2=$connect;
        $connect=explode(',',$connect);
    }else{$connect=$dial;$connect2=$connect;}
    $i=0;
    if (!isset($_GET['bk']) && !isset($_GET['new'])){
        echo '<b>'.$sbook[$dial].'</b>'.N;
        $sql=mysql_query_s('SELECT distinct book FROM bible_super_dial_context WHERE mid in('.$connect2.') order by pid ASC;');
        $n=mysql_numrows($sql);
        $sbook2=array();
        for($i=0;$i<=$n; ++$i){$sbook2[$i]=mysql_result($sql,$i,'book');}
        echo'<table border="1"><td>';
        $i=1;
        foreach ($sbook2 as $kb) {
          ++$i;
          $kb=strtoupper($kb);
	  
            if ($kb=='GEN'){echo'</td><td valign="top">OT'.N;$i=1;}
            elseif ($kb=='MAT'){echo'</td><td valign="top">NT'.N;$i=1;}
            if (($i==4)and (strlen($kb)==1)){echo'</td><td valign="top">'.N;$i=0;}
	    elseif(($i>=14)and (strlen($kb)==3)){echo'</td><td valign="top">'.N;$i=0;}
            if(!empty($kb)){echo '<a href="/?topic&b='.$b.'&bk='.$kb.'&dial='.$dial.'">'.$kb.'</a>'.N;}
	  
	}
        echo'</td></table>';
    } elseif(!isset($_GET['new'])) {
        $sql="SELECT * FROM bible_super_dial_context where book='$book' and mid in($connect2) order by type,title;";
        $sql=mysql_query_s($sql);
	$thetype=mysql_result($sql,0,'type');
	if($thetype==5){
	    $anamer=1;
	    $sqllistgen=mysql_query_s('SELECT distinct(title) FROM bible_super_dial_context where book='."'$book' and mid in($connect2) order by type,title;");
	    $nlg=mysql_numrows($sqllistgen);
	    echo'<table><tr>';
	    $i=0;$i2=0;while($i<=$nlg){
	      ++$i2;
	      $aname=mysql_result($sqllistgen,$i,'title');
	      if(!empty($aname)){
		if($i2==7){echo'</tr><tr>';$i2=0;}
		echo'<td><A href="#'.$aname.'">'.$aname.'</a></td>';
	      }
		++$i;
	    }
	    echo'</tr></table>';
	}
        $n=mysql_numrows($sql);
	#$numtotake=round($n / 3); #for vertical rows /use rowspan=" "
        $sbook3="";$sbook2="";
	if(isset($anamer)){echo'<table align="top" border="1" valign="top"><tr><td>';$i2=0;}
	
        $i=0;while($i<=$n){
            $sbook3=mysql_result($sql,$i,'title');$smidt=mysql_result($sql,$i,'mid');$suid2=mysql_result($sql,$i,'uid');
            if(!empty($smidt)){
            $stype=mysql_result($sql,$i,'type');$scontext=mysql_result($sql,$i,'context');$ssubcontext=mysql_result($sql,$i,'subcontext');
	    
	    $sl=mysql_result($sql,$i,'l');$sl2=mysql_result($sql,$i,'l2');
	    $sbook4=mysql_result($sql,$i,'book');
	    $sverses=mysql_result($sql,$i,'verses');$se3=explode('.',$sverses);if(count($se3)==1){$sverses=str_replace('.',"",$sverses);}
            $strioarg=mysql_result($sql,$i,'trioarg');$sfirstyear=mysql_result($sql,$i,'firstyear');$slastyear=mysql_result($sql,$i,'lastyear');
	    if(preg_match('/(www.)|(http\:)/i',$scontext)){
		$externallink_context='1';
		if(!strstr($scontext,'http://')){$scontext='http://'.$scontext;}
	    }
	    if(preg_match('/(www.)|(http\:)/i',$sverses)){
		$externallink_verses='1';
		if(isset($externallink_context)){$dospace=NN;}
		if(!strstr($sverses,'http://')){$sverses='http://'.$sverses;}
	    }
            if(($stype=='3')or($stype=='3')){$smidc2=mysql_result($sql,$i,'midc');}
            if($smidt!==$smidt2){if($i!==0){echo'</p>';}echo'<p><b>'.$sbook[$smidt].'</b>'.N;$smidt2="";}
            if(empty($scontext)and!empty($sverses)){
		if(!isset($externallink_verses)){echo'<a href="/?b='.$b.'&bk='.$kb.'&s='.urlencode($sverses).'">'.$sbook3.'</a>'.N;}
		else{echo'<a href="'.$sverses.'">'.$sbook3.'</a>'.N;}
	    }
            elseif($sbook3!==$sbook2){
		if(isset($anamer)and!empty($sbook3)){++$i2;if($i2==3){$dotd2='</td><td> <a href="/?topic'.$bl.'&bk='.substr($sbook3,0,1).'&dial='.$smidt.'#">TOP</a></td></tr><tr><td>';$i2=0;}else{$dotd2='</td><td>';}echo $dotd2.'<a name="'.$sbook3.'"><u>'.$sbook3.'</u></a>'.N;unset($dotd2);}
		else{echo$sbook3.N;}
	    }
            if(!empty($dosuperuser)or($suid2==$uid)){
                $spid=mysql_result($sql,$i,'pid');
                if(!empty($spid)){echo'<a href="/?topic&b='.$b.'&dial='.$dial.'&delete='.$spid.'">˟</a> ';}
            }     
            if(($stype=='1')and!empty($scontext)){
		if(($sbook3==$sbook3_t)and($scontext_t==$scontext)){$sub_linked=1;}
		if(!isset($externallink_verses)and!isset($sub_linked)){echo'<a href="/?b='.$b.'&bk='.$kb.'&s='.urlencode($sverses).'">'.$scontext.'</a> '.$ssubcontext.N;}
		elseif(!isset($sub_linked)){echo'<a href="'.$sverses.'">'.$scontext.'</a> '.$ssubcontext.N;}
		elseif(!isset($externallink_verses)){
		    if(empty($ssubcontext)){$ssubcontext='[_]';}
		    echo'-<a href="/?b='.$b.'&bk='.$kb.'&s='.urlencode($sverses).'">'.$ssubcontext.'</a>'.N;
		}
		else{if(empty($ssubcontext)){$ssubcontext='[_]';}
		echo'-<a href="'.$sverses.'">'.$ssubcontext.'</a> '.N;}
		$sbook3_t=$sbook3;$scontext_t=$scontext;unset($sub_linked);
	    }
            elseif(($stype=='2')and!empty($scontext)){
		if(!isset($externallink_context)){echo'<a href="/?b='.$b.'&bk='.urlencode($book).'&s='.urlencode($scontext).'">'.$scontext.'</a>';}
		else{echo'<a href="'.$scontext.'">'.$scontext.'</a>'.$dospace;}
                if($strioarg=='1'){echo' Fulfilled: ';}
                if($strioarg=='2'){echo' Unfulfilled: ';}
		if($strioarg=='3'){echo' For: ';}
		if($strioarg=='4'){echo' Against: ';}
		if($strioarg=='5'){echo' True: ';}
		if($strioarg=='6'){echo' False: ';}
		if(!isset($externallink_verses)){echo'<a href="/?b='.$b.'&bk='.urlencode($book).'&s='.urlencode($sverses).'">'.$sverses.'</a>'.N;}
                else{echo'<a href="'.$sverses.'">'.$sverses.'</a>'.N;}
            }elseif(($stype=='3')and!empty($smidc2)){echo'<a href="/?topic&b='.$b.'&dial='.$smidc2.'">'.$scontext.'</a>'.N;}
	    elseif(($stype=='4')and!empty($smidc2)){echo'<a href="/?topic&b='.$b.'&dial='.$smidc2.'&bk='.urlencode($book).'">'.$scontext.'</a>'.N;}
            elseif(($stype=='5')){
		if(!empty($sl)){$slput=' See '.$sl;$slput2=$sl;$slput3=' <a href="/?topic'.$bl.'&bk='.substr($sl,0,1).'&dial='.$smidt.'#'.$sl.'">[ See "'.$sl.'" ]</a> ';}
		elseif(!empty($sl2)){$slput=' Also called '.$sl2;$slput2=$sl2;$slput3=' <a href="/?topic'.$bl.'&bk='.substr($sl2,0,1).'&dial='.$smidt.'#'.$sl2.'">[ Also Called "'.$sl2.'" ]</a> ';}
		if(!empty($slput)){echo $slput3.N;}
		if(($sbook3==$sbook3_t)and($scontext_t==$scontext)){$sub_linked=1;}
		if(!isset($externallink_verses)and!isset($sub_linked)and!empty($scontext)){echo'<a href="/?b='.$b.'&bk='.$kb.'&s='.urlencode($sverses).'">'.$scontext.'</a> '.$ssubcontext.N;}
		elseif(!isset($sub_linked)and!empty($scontext)){echo'<a href="'.$sverses.'">'.$scontext.'</a> '.$ssubcontext.N;}
		elseif(!isset($externallink_verses)and!empty($sverses)){
		    if(empty($ssubcontext)){
			if(empty($sl)and empty($sl2)){$ssubcontext='[_]';}#else{$subcontext=$slput;}
		    }
		    echo'-<a href="/?b='.$b.'&bk='.$kb.'&s='.urlencode($sverses).'">'.$ssubcontext.'</a>'.N;
		}
		else{if(empty($ssubcontext)){
		    if(empty($sl)and empty($sl2)){$ssubcontext='[_]';}
		    #else{$subcontext=$slput;}
		 }
		 if(!empty($sverses)){echo'-<a href="'.$sverses.'">'.$ssubcontext.'</a> '.N;}
		 elseif(!empty($ssubcontext)){echo $ssubcontext.N;}
		 #elseif(!empty($slput3)){echo' -'.$slput3.N;}
		}
		if(!empty($scontext)){$sbook3_t=$sbook3;$scontext_t=$scontext;unset($sub_linked);}
		unset($slput,$slput2,$slput3);
		
	    }
	    if(!empty($sfirstyear)){
                if(empty($slastyear)){echo'Year '.$sfirstyear.N;}
                else{echo'Years('.$sfirstyear.'-'.$slastyear.')'.N;}
            }
            $sbook2=$sbook3;$smidt2=$smidt;
            }
	    ++$i;
        }if(isset($anamer)){echo'</td></tr></table>';}
        echo'</p>';
        /*foreach($connect as $m){
            echo 'connect: '.$m.N;
        }*/
    } else {
        //mid,midc,uid,global,shared,readwrite,title
        //bible_super_dial_contextpidmiduid date  |book |title type |trioarg|context |verses,| firstyear,| lastyear
        echo '<form action="/?topic&b='.$b.'&dial='.$dial.'&post=1" method="post" enctype="multipart/form-data">
        Menu item<input type="text" name="book" value="'.$book.'">(Subject)<br>
        Title    <input type="text" name="title" value="">(Headline or Description)<br>
        Context  <input type="text" name="context" value="">(Part, Description or verses)<br>
        Verses   <input type="text" name="verses" value=""> (Example: .GEN 3:15 .GEN 1:34-35)<br>
        Year     <input type="text" name="firstyear" value="">(Example: -2000 for 2000bc)<br>
        Last Year<input type="text" name="lastyear" value=""><br>
        Goto map<input type="text" name="midc" value="">(If type=3 "Jump to map by context as link", context will be linked to another map)<br>
        <select style="width:64" name="trioarg"><option selected  value="">Trioarg</option><option value="1">Fulfilled</option><option value="2">Unfulfilled</option><option value="3">For</option><option value="4">Against</option><option value="5">True</option><option value="6">False</option></select>
        <select style="width:68" name="type"><option selected  value="">Type</option>
        <option value="1">Verses is link</option>
        <option value="2">Context and verses are links</option>
        <option value="3">Jump to map by context as link</option>
        <option value="4">Jump to map with menu item by context as link</option></select>
        <input type="submit" value="Go"></form>';
    }
    if(!empty($dosuperuser)){echo'<a href="/?topic&b='.$b.'&dial='.$dial.'&settings=1">Settings</a> ';}
    if($u!='demo'){echo'<a href="/?topic&b='.$b.'&newmap=1">New Map</a>'.$newentry.N;}
}
unset($sbook,$sbook2);
#if($uid=='1'){echo N;require('inc/benchmark.php');}
/*
    $sql=mysql_query_s("SELECT count(distinct chapter) AS C FROM bible_context WHERE book='$book' AND bid='$b';");
    $sccount=mysql_result($sql,0,'C');
    $i2=1;
    echo '<table align="left"><td>';
    $i3=0;
    if($book=='PS'){$bmax=22;}
    else {$bmax=12;}
    $dialt="b=$b&bk=$book&cs";
    for($i=0;$i<$sccount; ++$i){
        ++$i3;
        echo "<a href='$subd/?$dialt=$i3&bdial$row_mid'>$i3</a>".N;
        if ($i2>$bmax) {echo'</td><td valign="top">';$i2=0;}
        ++$i2;
    }
    echo'</td></table>';
*/
?>