<?php // licence: gpl-signature.txt
$ifed=stripslashes($_GET['edit']);
if(empty($getcomm)){$getcomm=stripslashes($_GET['comment']);}
if(empty($ifed)and empty($new)) { $ifed=$getcomm; }
if (empty($_POST['addnode'])) {
    //$fsql="SELECT title FROM bible_nodes WHERE type = 'fc' AND category = '$cat' AND uppercat = '$uc';"; // $ifed
    if (empty($uc)) {$uc=$scat;}
    if (!empty($nid)) {
        $fsqle="SELECT * FROM bible_nodes WHERE nid='$nid';";
        $fsqlqe=mysql_query($fsqle);
        $stitlee=mysql_result($fsqlqe,0,'title');
        $scate=mysql_result($fsqlqe,0,'category');
        $stypee=mysql_result($fsqlqe,0,'type');
        $slanguagee=mysql_result($fsqlqe,0,'language');
        $suppercate=mysql_result($fsqlqe,0,'uppercat');
        $sstatuse=mysql_result($fsqlqe,0,'status');
        $screatede=mysql_result($fsqlqe,0,'created');
        if (!empty($screatede)) {$screatede=date('dMy H:i', $screatede); } else {unset($screatede);}
        $ssdatee=mysql_result($fsqlqe,0,'sdate');
        if (!empty($ssdatee)) {$ssdatee=date('dMy H:i', $ssdatee); } else {unset($ssdatee);}
        $sedatee=mysql_result($fsqlqe,0,'edate');
        if (!empty($sedatee)) {$sedatee=date('dMy H:i', $sedatee); } else {unset($sedatee);}
        $scommente=mysql_result($fsqlqe,0,'comment');
        $ssubnodee=mysql_result($fsqlqe,0,'subnode');
        $spromotee=mysql_result($fsqlqe,0,'promote');
        $smoderatee=mysql_result($fsqlqe,0,'moderate');
        $sstickye=mysql_result($fsqlqe,0,'sticky');
        $seditgroupse=mysql_result($fsqlqe,0,'editgroups'); // this needs some attention
        $ssendnote=mysql_result($fsqlqe,0,'sendnot');
        $suidse=mysql_result($fsqlqe,0,'uids');
        $slange=mysql_result($fsqlqe,0,'language');
        $sgmape=mysql_result($fsqlqe,0,'gmap');
        if (strlen($sgmape) < 16) {unset($sgmape);}
        $slinke=mysql_result($fsqlqe,0,'link');
        $slinkavie=mysql_result($fsqlqe,0,'linkavi');
        $slinkflae=mysql_result($fsqlqe,0,'linkflv');

        $ssnde=mysql_result($fsqlqe,0,'snd');
        $sdatae=stripslashes(mysql_result($fsqlqe,0,'data'));
        $uuide=mysql_result($fsqlqe,0,'uid');
        
        $sbook1=mysql_result($fsqlqe,0,'nodeb1');
        $schapter1=mysql_result($fsqlqe,0,'nodec1');
        $sverse1=mysql_result($fsqlqe,0,'nodev1');
        
        $sbook2=mysql_result($fsqlqe,0,'nodeb2');
        $schapter2=mysql_result($fsqlqe,0,'nodec2');
        $sverse2=mysql_result($fsqlqe,0,'nodev2');
        
        $sbook3=mysql_result($fsqlqe,0,'nodeb3');
        $schapter3=mysql_result($fsqlqe,0,'nodec3');
        $sverse3=mysql_result($fsqlqe,0,'nodev3');
        
        $cat=$suppercate;$uc=$scat;
        if($uid==1){$uuide='1';}
        if (empty($getcomm) and ($uid !== $uuide) and (preg_match('/(^'.$uid.'\s)|(\s'.$uid.'\s)|(\s'.$uid.'$)/',$suidse) !== TRUE)) { die('Access denied.'); }
        if($stypee==='ct') { $getcomm = $nid; }
    }
    if(!empty($_GET['edit'])){$createcontent='&nonew';}
    echo'<form action="index.php?forum&createcontent=1'.$createcontent.'&b='.$b.'&uc='.urlencode($uc).'&cy='.urlencode($cat).'" method="post" enctype="multipart/form-data">';
  if (empty($getcomm)) {
    //echo'scat '.$scat.' uc '.$uc.' cat '.$cat;
    echo'<select style="width:105" name="categoryup">';
    $fsql="SELECT * FROM bible_nodes WHERE type = 'fc' AND category = '$cat' AND uppercat='$scat';";
    $fsqlq=mysql_query($fsql);
    $n=mysql_numrows($fsqlq);
    if (empty($n)) {
        $fsql="SELECT * FROM bible_nodes WHERE type = 'fc' AND category = '$uc' AND uppercat='$scat';";
        $fsqlq=mysql_query($fsql);
        $n=mysql_numrows($fsqlq);
    }
    $i=0;while($i<$n){
        $stitle=mysql_result($fsqlq,$i,'title');
        if ($stitle == $cat) {$catsel=' selected ';}
        echo'<option'.$catsel.' value="'.urlencode($stitle).'">'.$stitle.'</option>';
        unset($catsel);++$i;
    }
    if (!empty($ifed)) { echo'<option selected  value="'.$scate.'">*'.$scate.'</option>'; }
    elseif (empty($cat)) {$catsel='selected '; }
    echo'<option '.$catsel.' value="">*Category</option></select>
    <select style="width:107" name="type"><option value="">*Content Type</option>';
    $fsql="SELECT * FROM bible_node_types order by type;";
    $fsqlq=mysql_query($fsql);
    $n=mysql_numrows($fsqlq);
    $i=0;while($i<$n){
        $sntn=mysql_result($fsqlq,$i,'name');
        $sntt=mysql_result($fsqlq,$i,'type');
        if ($sntn == $stypee) {$catsel=' selected  ';}
        echo'<option '.$catsel.' value="'.$sntn.'">'.$sntt.'</option>';
        unset($catsel);++$i;
    }
    
    $echopub='<select style="width:85" name="published"><option value="">Published</option><option selected  value="1">Yes</option><option value="0">No</option></select>';
    $echocom='<select style="width:85" name="comments"><option value="">Allow Comments</option><option selected  value="y">Yes</option><option value="n">No</option></select>'.N;
    $echosti='<select style="width:85" name="stick"><option value="">Sticky on top?</option><option value="y">Yes</option><option value="n"  selected >No</option></select>';
    $echofro='<select style="width:85" name="front"><option value="">Show on frontpage?</option><option selected  value="1">Yes</option><option value="2">No</option></select>'.N;
    $echolan='<select style="width:85" name="language"><option value="">Language</option><option selected  value="eng">English</option><option value="nor">Norwegian</option></select>'.N;
    
    $echoedg='<select name="editgroups" style="width:70"><option value=""><u>Allowed groups for edit</u></option><option value="1">Everyone</option>
    <option value="2">Groups</option><option selected  value="3">Default(None)</option></select>';
    $echosno='<select name="sendnot" style="width:70"><option value=""><u>Send notifications</u></option><option value="1" selected >Yes</option>
    <option value="2">No</option><option value="3">If wanted</option></select><br></select>';
    $echonre=' <select name="norem" style="width:70"><option value=""><u>Disallow removal of content</u></option><option value="1">Yes</option>
    <option value="2" selected >No</option><option value="3"></option></select>';
  }
    if (!empty($ifed)) {
        $echopub = str_replace('selected ','',$echopub);
        $echopub = str_replace('value="'.$sstatuse.'"','value="'.$sstatuse.'" selected ',$echopub);
        $echocom = str_replace('selected ','',$echocom);
        $echocom = str_replace('value="'.$scommente.'"','value="'.$scommente.'" selected ',$echocom);
        $echosti = str_replace('selected ','',$echosti);
        $echosti = str_replace('value="'.$sstickye.'"','value="'.$sstickye.'" selected ',$echosti);
        $echofro = str_replace('selected ','',$echofro);
        $echofro = str_replace('value="'.$spromotee.'"','value="'.$spromotee.'" selected ',$echofro);
        $echolan = str_replace('selected ','',$echolan);
        $echolan = str_replace('value="'.$slange.'"','value="'.$slange.'" selected ',$echolan);
        $echoedg = str_replace('selected ','',$echoedg);
        $echoedg = str_replace('value="'.$seditgroupse.'"','value="'.$seditgroupse.'" selected ',$echoedg);
        $echosno = str_replace('selected ','',$echosno);
        $echosno = str_replace('value="'.$ssendnote.'"','value="'.$ssendnote.'" selected ',$echosno);
        $echonre = str_replace('selected ','',$echonre);
        $echonre = str_replace('value="'.$smoderatee.'"','value="'.$smoderatee.'" selected ',$echonre);
        $echonre .= '<input type="hidden" name="edit" value="'.$uuide.'">';
    }
    #if (empty($jedit)) {$lim_size='rows="14" cols="29"';}
    $lim_size='style="width:100%;height:500px;"';
    echo'</select><br>
    *Title: <input type="text" value="'.$stitlee.'" name="addnode"><br>
    <textarea name="content2" id="content2" '.$lim_size.'>'.$sqlnote.$sdatae.'</textarea>'.$jedit.N.
    '<input type="hidden" name="nid" value="'.$nid.'"><input type="hidden" name="uppercatup" value="'.$scat.$suppercate.'">';
  if (empty($getcomm)) {
    echo'Link to verses<br>
    <select name="nodeb1" style="width:54">';//49firefox
if(strstr($b,',')){$bks=' IN(';$bks2=')';}else{$bks='=';}
if($l=='ru'){$bla=52;}
elseif($l=='n'){$bla=6;}
else{$bla=$b;}
$rbk=mysql_query_s('SELECT DISTINCT book,sname FROM bible_book_name WHERE bid'."$bks$bla$bks2");
//if($uid==1){echo'<option value="'.$a_shortdrupal[1].'"></option>';}
$numrbk=mysql_numrows($rbk);
$i=0;while($i<$numrbk){
  $sqbook=mysql_result($rbk,$i,'sname');
  if(!empty($sqbook)){
   $bk2=mysql_result($rbk,$i,'book');
   if(empty($b_name4)and(strtolower($sqbook)===strtolower($sbook1))){$b_name4=$sqbook;$ssbible2=' selected';}elseif(isset($ssbible2)){$ssbible2="";}
   //$b_name2=$sqbook; olduse before </option>
   echo"<option value='$sqbook'$ssbible2>".mysql_result($rbk,$i,'book')."</option>";
  }++$i;
}echo'</select>Chapter:<input type="text" value="'.$schapter1.'" name="nodec1">Verse:<input type="text" value="'.$sverse1.'" name="nodev1"><br>
    <select name="nodeb2" style="width:54">';
    $i=0;while($i<$numrbk){
  $sqbook=mysql_result($rbk,$i,'sname');
  if(!empty($sqbook)){
   $bk2=mysql_result($rbk,$i,'book');
   if(empty($b_name4)and(strtolower($sqbook)===strtolower($sbook2))){$b_name4=$sqbook;$ssbible2=' selected';}elseif(isset($ssbible2)){$ssbible2="";}
   //$b_name2=$sqbook; olduse before </option>
   echo"<option value='$sqbook'$ssbible2>".mysql_result($rbk,$i,'book')."</option>";
  }++$i;
}echo'</select>Chapter:<input type="text" value="'.$schapter2.'" name="nodec2">Verse:<input type="text" value="'.$sverse2.'" name="nodev2"><br>
    <select name="nodeb3" style="width:54">';
    $i=0;while($i<$numrbk){
  $sqbook=mysql_result($rbk,$i,'sname');
  if(!empty($sqbook)){
   $bk2=mysql_result($rbk,$i,'book');
   if(empty($b_name4)and(strtolower($sqbook)===strtolower($sbook3))){$b_name4=$sqbook;$ssbible2=' selected';}elseif(isset($ssbible2)){$ssbible2="";}
   //$b_name2=$sqbook; olduse before </option>
   echo"<option value='$sqbook'$ssbible2>".mysql_result($rbk,$i,'book')."</option>";
  }++$i;
}echo'</select>Chapter:<input type="text" value="'.$schapter3.'" name="nodec3">Verse:<input type="text" value="'.$sverse3.'" name="nodev3"><br>
    '.N.'
    Link(url): <input type="text" value="'.$slinke.'" name="link">'.N.'
    Link(avi): <input type="text" value="'.$slinkavie.'" name="linkavi">'.N.'
    Link(flv): <input type="text" value="'.$slinkflae.'" name="linkflv">'.N.
    $echopub.$echocom.$echosti.$echofro.$echolan.
    'Edit Users(uids): <input type="text" value="'.$suidse.'" name="editusers"><br>
    Map Link: <input type="text" value="'.$sgmape.'" name="gmap"><br>
    Start date: <input type="text" value="'.$ssdatee.'" name="sdate"><br>
    End date: <input type="text" value="'.$sedatee.'" name="edate"><br>
    Publish date: <input type="text" value="'.$screatede.'" name="pdate"><br>
    Sub node: <input type="text" value="'.$ssnde.'" name="snd"><br>'.
    $echoedg.$echosno.$echonre;
  } else { echo'<input type="hidden" name="comment" value="'.$getcomm.'"><input type="hidden" name="type" value="ct">';}
    if (!empty($_GET['new'])or!empty($new)) { echo'<input type="hidden" name="new" value="1">'; }
    echo'<input type="submit" value="Save"></form>';
}
if ((!empty($_POST['addnode']) && !empty($_POST['type']))or !empty($_GET['createcontent'])) {
 function utfencoder($teksten) {//utf8 encoder
    $characterEncoding = mb_detect_encoding($teksten, 'UTF-8, UTF-16, ISO-8859-1, ISO-8859-15, Windows-1252, ASCII');  
    switch ($characterEncoding) {
      case 'UTF-8': break;      
      case 'ISO-8859-1': $teksten = utf8_encode($teksten); break;
      default: $teksten = mb_convert_encoding($teksten,'UTF-8',$characterEncoding); break;
    } return $teksten;
  } //<- utf8 encoder
if(!isset($tag_filter)){require('inc/tag_filter.php');}
$titleup=str_replace('\'','&#39',urldecode(stripslashes($_POST['addnode'])));$titleup=preg_replace($tag_filter,'',$titleup); //$titleup=htmlentities($titleup);$titleup=utfencoder(stripslashes($_POST['addnode']));
$linkup=str_replace('\'','&#39',urldecode(stripslashes($_POST['link'])));$linkup=preg_replace($tag_filter,'',$linkup); //$linkup=htmlentities($linkup);$linkup=utfencoder(stripslashes($_POST['link']));
$content=str_replace('\'','&#39',stripslashes($_POST['content2']));$content=preg_replace($tag_filter,'',$content); //$content=str_replace('\'','"',$content); //$content=htmlentities($content); //$content=utfencoder(stripslashes($_POST['content']));
if(empty($jedit)and!strstr($content,'<br>')and(strstr($content,"\r")or strstr($content,"\n"))){$content=preg_replace('/(\r\n?)|(\n)/i','<br>',$content);}// 'href="http://'.$host.'?url='.urlencode($match[1]).'"';
$callback = function ($match) use ($host) {
    if(strstr($match[0],'/a') == FALSE){
        $match[2]=str_replace(',',':',$match[0]);
        return '<a href="/?s='.urlencode($match[0]).'">'.$match[0].'</a>';
    }else{return $match[0];}
};
if(!isset($tag_filter)){require('inc/tag_filter.php');}
$content=preg_replace_callback('/(?=(\s|>|))([^:>\s\d)]\d?\w{1,20}[^\d]\s\d{1,3}[\:\,]\d{1,3}(\-\d{1,3})?(<\/a)?)/i', $callback, $content);
$gmapup=str_replace('\'','"',urldecode(stripslashes($_POST['gmap'])));$gmapup=preg_replace($tag_filter,'',$gmapup); //$gmapup=htmlentities($gmapup);$gmapup=utfencoder(stripslashes($_POST['gmap']));
if (!empty($gmapup)) {$gmapup.='&output=embed';}
$languageup=stripslashes($_POST['language']);$publishedup=stripslashes($_POST['published']);$cat=stripslashes($_POST['categoryup']);
$commentsup=stripslashes($_POST['comments']);$sndup=stripslashes($_POST['snd']);$frontup=stripslashes($_POST['front']);$noremup=stripslashes($_POST['norem']);$stickup=stripslashes($_POST['stick']);
$editgroupsup=stripslashes($_POST['editgroups']);$sendnotup=stripslashes($_POST['sendnot']);$editusersup=stripslashes($_POST['editusers']);$typeup=stripslashes($_POST['type']);
if (!empty($_POST['pdate'])) { $pdup=strtotime(stripslashes($_POST['pdate'])); $pdup2=", created='".$pdup."'";} else { $pdup = time(); }
if (!empty($_POST['sdate'])) { $sdateup=strtotime(stripslashes($_POST['sdate'])); }
if (!empty($_POST['edate'])) { $edateup=strtotime(stripslashes($_POST['edate'])); }
if (!empty($_POST['nodev1'])) { $nodeb1up=stripslashes($_POST['nodeb1']);$nodec1up=stripslashes($_POST['nodec1']);$nodev1up=stripslashes($_POST['nodev1']); }
if (!empty($_POST['nodev2'])) { $nodeb2up=stripslashes($_POST['nodeb2']);$nodec2up=stripslashes($_POST['nodec2']);$nodev2up=stripslashes($_POST['nodev2']); }
if (!empty($_POST['nodev3'])) { $nodeb3up=stripslashes($_POST['nodeb3']);$nodec3up=stripslashes($_POST['nodec3']);$nodev3up=stripslashes($_POST['nodev3']); }
if (!empty($_POST['linkavi'])) { $slinkaviup=stripslashes($_POST['linkavi']);}
if (!empty($_POST['linkflv'])) { $slinkflvup=stripslashes($_POST['linkflv']); }
if (!empty($_POST['comment'])) { $cat=stripslashes($_POST['comment']);$uc=$cat; }
elseif (!empty($_POST['uppercatup'])) { $uc=stripslashes($_POST['uppercatup']); }
else {
  $fsqldoublecheck="SELECT title FROM bible_nodes WHERE uppercat = '$uc' AND category = '$cat' AND title='$titleupd';";
  $fsqldoublecheck=mysql_query($fsqldoublecheck);
  $ndoublecheck=mysql_numrows($fsqldoublecheck);
} //check if exists(if not being comment)
if ((empty($_POST['comment']) && empty($_POST['edit']) && ($ndoublecheck < '1'))or(!empty($_POST['new']))or(!empty($_GET['createcontent'])and!isset($_GET['nonew']))) {
$uuid=$uid;
if(!empty($typeup)and(strlen($titleup)>2)and(strlen($content)>3)){$upsql="INSERT INTO bible_nodes (nid,vid,type,language,title,category,uppercat,uid,status,created,changed,sdate,edate,comment,subnode,promote,moderate,rating,visitors,sticky,tnid,translate,editgroups,sendnot,uids,settings,gmap,link,linkavi,linkflv,data,nodeb1,nodec1,nodev1,nodeb2,nodec2,nodev2,nodeb3,nodec3,nodev3) VALUES
                                            ('','','$typeup','$languageup','".urldecode($titleup)."','$cat','$uc','$uuid','$publishedup','$pdup', '".time()."','$sdateup','$edateup','$commentsup','$sndup','$frontup','$noremup','','','$stickup','','','$editgroupsup','$sendnotup','$editusersup','','$gmapup','$linkup','$slinkaviup','$slinkflvup','$content','$nodeb1up','$nodec1up','$nodev1up','$nodeb2up','$nodec2up','$nodev2up','$nodeb3up','$nodec3up','$nodev3up')";
}

if ($typeup=='bl'){unset ($uc,$cat);}
if ($typeup =='ct') { echo'<a href ="?forum&b='.$b.'&nid='.$cat.'">Back to viewer</a><p></p>'; }
else { echo'<a href ="?forum&b='.$b.'&uc='.urlencode($uc).'&cy='.urlencode($cat).'&ti='.urlencode($ti).'">Back to viewer</a><p></p>'; }
} else {
    if (!empty($_POST['edit'])) { $uuid=stripslashes($_POST['edit']); } // , uppercat='$uc'
    if($uid!=='1'){$checkuid="AND uid='$uid'";}
    
    if($uc!==$cat){$upextra=",category='$cat'";}
    if($uid==1){echo'do up'.N;}
    $upsql="UPDATE bible_nodes SET vid='',type='$typeup',language='$languageup',title='$titleup'$upextra,status='$publishedup'$pdup2,changed='".time()."',sdate='$sdateup',edate='$edateup',comment='$commentsup',subnode='$sndup',promote='$frontup',
        moderate='$noremup',sticky='$stickup',tnid='',translate='',editgroups='$editgroupsup',sendnot='$sendnotup',uids='$editusersup',settings='',gmap = '$gmapup',link = '$linkup',linkavi = '$slinkaviup',linkflv = '$slinkflvup',data='$content'
        ,nodeb1 = '$nodeb1up',nodec1 = '$nodec1up',nodev1 = '$nodev1up',nodeb2 = '$nodeb2up',nodec2 = '$nodec2up',nodev2 = '$nodev2up',nodeb3 = '$nodeb3up',nodec3 = '$nodec3up',nodev3 = '$nodev3up' WHERE bible_nodes.nid='$nid'$checkuid;";
    echo'<a href ="?forum&ti=1&b='.$b.'&uc='.urlencode($uc).'&cy='.urlencode($cat).'&nid='.$nid.'">Click here to see the changes</a><p></p>';
}
if(!empty($upsql)){if($uid==1){echo htmlentities($upsql);}$upupsql=mysql_query($upsql,$link) or die('A MySQL error has occurred.<br>Your Query: '.$upsql.N.' Error: ('.mysql_errno().') '.mysql_error());echo'Content saved.'.N;}

}
/*
        $sqlnote=explode("_",$sqlnote);
        $setsettings="";
        for($i=0;$i<10; ++$i) {
            if(!empty($sqlnote[$i]) && empty($p_modes[$i])) { $p_modes[$i]=$sqlnote[$i]; }
            $setsettings .= '_'.$p_modes[$i];
        }
 
 
 
 $content = preg_replace($tag_filter,"",$content);
$content = htmlentities($content);
htmlentities($var) - for showing html under edit
vid version control id. tnid translation id - multilanguage control.
*/
?>