<?php // licence: gpl-signature.txt
$ti=urldecode($_GET['ti']);$removeid=$_GET['remove'];
if (empty($_GET['comment'])) {
  if (!empty($_GET['page'])) { $pagenum=$_GET['page']; } else { $pagenum='0'; }
  $page_low=0 + ($pagenum * 12);$page_high=12 + ($pagenum * 12);
  if (empty($cat)){$fsqldisp=" promote=1 and status=1 ";}
  else {$fsqldisp=" status='1' AND category='".urlencode($cat)."' AND uppercat='".urlencode($uc)."' AND title='".urldecode($ti)."'";}
  if (!empty($nid)) {$fsqldisp=" status=1 AND nid=$nid";}
  if (!empty($_GET['comments'])or!empty($comments)) { $fsqldisp=" uppercat=$nid AND category=$nid";$commentshtml='&comments=1'; }
  $fsqlq=mysql_query("SELECT * FROM bible_nodes WHERE $fsqldisp ORDER BY created ASC LIMIT $page_low,$page_high;");
  $n=mysql_numrows($fsqlq);
  $i=0;while($i<$n){
    $stitle=mysql_result($fsqlq,$i,'title');
    $sdata=mysql_result($fsqlq,$i,'data');
    //$sdata=preg_replace('(\r\n)','<br>',$sdata);
    $sgmap=mysql_result($fsqlq,$i,'gmap');
    $slink=mysql_result($fsqlq,$i,'link');
    $ssdate=mysql_result($fsqlq,$i,'sdate');
    $sedate=mysql_result($fsqlq,$i,'edate');
    $schanged=mysql_result($fsqlq,$i,'changed');
    $screated=mysql_result($fsqlq,$i,'created');
    $scate=mysql_result($fsqlq,$i,'category');
    $supcate=mysql_result($fsqlq,$i,'uppercat');
    $snid=mysql_result($fsqlq,$i,'nid');
    if (empty($_GET['comments'])) {
        $fsqlq2=mysql_query("SELECT count(*) AS C FROM bible_nodes WHERE uppercat='$snid' AND category='$snid';");
        $sccount=mysql_result($fsqlq2,0,'C');
    }
    $lastvisitor=mysql_result($fsqlq,$i,'lastvisitor');
    $visitors=mysql_result($fsqlq,$i,'visitors');
    if($lastvisitor != ip2long($remoteaddr)and($uid !== '1')){mysql_query('UPDATE bible_nodes SET visitors='.($visitors + 1).',lastvisitor='.ip2long($remoteaddr).' WHERE bible_nodes.nid='.$snid);}
    $suid=mysql_result($fsqlq,$i,'uid');
    $suids=mysql_result($fsqlq,$i,'uids');
    $stype=mysql_result($fsqlq,$i,'type');
    if ($removeid===$snid) {
        if (($uid!=='1') && ($suid==='1')) {break;}
        elseif (($suid===$uid)or($uid==='1')) {
            $fsql2="DELETE FROM bible_nodes WHERE nid=$snid;"; mysql_query($fsql2);
            $fsql2="DELETE FROM bible_nodes WHERE category=$snid AND uppercat=$snid;"; mysql_query($fsql2);
            break;
        } // $fsqlq2=mysql_query($fsql2);
    }
    //(nid,vid,type,language,title,category,uppercat,uid,status,created,changed,sdate,edate,comment,subnode,
    //promote,moderate,rating,visitors,sticky,tnid,translate,editgroups,sendnot,uids,settings,gmap,link,data)
    if (empty($ti)and($scate!==$supcate)) { echo'<a href="?forum&cy='.urlencode($scate).'&uc='.urlencode($supcate).'&ti='.urlencode($stitle).'&b='.$b.'&s='.urlencode($se).'">'.$stitle.'</a>'; }
    elseif(empty($ti)){echo'<a href="?forum&nid='.$scate.'&b='.$b.'&s='.urlencode($se).'">'.$stitle.'</a>';}
    else { echo '<u>'.$stitle.'</u><small> by uid('.$suid.') '.date('dMy H:i', $screated).'</small>'; }
    if (($suid===$uid)or(preg_match('/(^'.$uid.'\s)|(\s'.$uid.'\s)/',$suids))or($uid==='1')) {
        echo N.'<a href ="?forum&edit=1'.$commentshtml.'&cy='.urlencode($scate).'&uc='.urlencode($supcate).'&nid='.$snid.'&b='.$b.'&s='.urlencode($se).'">Edit</a>';
        if (!preg_match('/(^'.$uid.'\s)|(\s'.$uid.'\s)/',$suids)) { echo' <a href ="?forum'.$commentshtml.'&remove='.$snid.'&cy='.urlencode($scate).'&uc='.urlencode($supcate).'&ti='.urlencode($stitle).'&nid='.$nid.'&b='.$b.'&s='.urlencode($se).'">Remove</a>'; }
    }
    if (($stype != 'ct') && !empty($sccount)) { echo' <a href ="?forum&comments=1&cy='.urlencode($scate).'&uc='.urlencode($supcate).'&ti='.urlencode($stitle).'&nid='.$snid.'&b='.$b.'&s='.urlencode($se).'">Comments('.$sccount.')</a>'; }
    echo'<p>'.$sdata.'</p>';
    // <a href='http://google.com' target='middleframe'>IframeLinkTest</a>"
    if (!empty($sedate) && !empty($ssdate)) { echo'From '.date('dMy H:i', $ssdate).' To '.date('dMy H:i', $sedate).N; }
    if (strlen($sgmap) >'16') { echo'<iframe name="middleframe" src="'.$sgmap.'" width="100%" height="200" frameborder="0"></iframe>'.N;  }
    if (!empty($slink)){
        if($stype=='po') {
            //$lindata=file_get_contents($slink);
            if (stripos($slink,'http://')===FALSE){$slink='http://'.$slink;}
            if (stripos($slink,'amazingdiscoveries.tv') > '1') { echo '<script type="text/javascript" src="'.preg_replace('/(media\/(\d{1,5}).*)/i',"embed?id=$2",$slink).'"></script>'; }
            elseif(stripos($slink,'youtube.com') > '1') {
                $slink=str_replace('/watch?v=','/embed/',$slink);
                echo '<iframe width="425" height="349" src="'.$slink.'" frameborder="0" allowfullscreen></iframe>';
            }
            elseif(preg_match('/(\.(mp3|m3u)($|\s$))/i',$slink,$fileextension)){
              //echo'<script type="text/javascript" src="http://static.delicious.com/js/playtagger.js"></script><a href="'.$slink."\">$slink</a>";
              /*print_r(file_get_contents($slink));
              echo'<script src="inc/flowplayer/flowplayer-3.2.6.min.js"></script>
              
              <div id="player" style="display:block;width:600px;height:453px;"></div>
              <!-- install flowplayer into container -->
              <script>
              $f("player", "inc/flowplayer/flowplayer-3.2.7.swf", {
                clip: { 
                url: \''.urlencode($slink).'\',
                coverImage: { url: \'http://releases.flowplayer.org/data/national.jpg\', scaling: \'orig\' } 
              }
              });
              </script>';*/
              echo'<object type="application/x-shockwave-flash" data="inc/player_mp3.swf" width="200" height="20">
                  <param name="movie" value="inc/player_mp3.swf"><param name="bgcolor" value="#ffffff">
                  <param name="FlashVars" value="mp3='.urlencode($slink).'&amp;autoplay=1&amp;volume=65&amp;showstop=1&amp;showinfo=1"></object><br><a href="'.$slink.'">[File]</a>';
              
              /*
              echo'<audio controls>
                  <source src="'.$slink.'"></audio>';*/
            }
            else { echo '<iframe width="425" height="349" src="'.$slink.'" frameborder="0" allowfullscreen></iframe>'; }
        }
        else { echo'<br><a href="'.$slink.'">'.$slink.'</a>'; }
    } ++$i;
  } unset($sdata);
}
if (!empty($_GET['comment']) or ($stype=='ft')) {
    if (empty($uc)and empty($cat)) { $uc=$nid;$cat=$nid;  }
    else{$uc=$snid;$cat=$snid;$nid=$snid;}
    $t2='1';
}
else{$t1='1';}
if(($stype=='ft')or(isset($t1))) {
    if (!empty($_GET['comments'])or($stype=='ft')) { $getcomm=$snid; $snid=$nid; $new='1'; unset($nid);$comments='1';}
    echo'<hr width="100%"><form action="index.php?b='.$b.'&s='.urlencode($se).'&forum&new=1&comment='.$snid.'&uc='.urlencode($uc).'&cy='.urlencode($cat).'&ti='.urlencode($ti).'" method="post">
        <input type="submit" value="Comment"></form>';
}
if(isset($t2)){require('new_node.php');}
?>