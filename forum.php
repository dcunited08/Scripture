<?php # licence: gpl-signature.txt
#testadd
$nid=$_GET['nid'];$ti=$_GET['ti'];
$thisyear=date('y',time());
if (empty($nid)) { $nid=$_POST['nid']; }
if (empty($_POST['category'])) { $cat=$_GET['cy']; } else {$cat=$_POST['category'];$cat2=urldecode($_GET['cy']);} $cat=urldecode($cat);
if (!empty($_GET['uc'])) { $uc=$_GET['uc']; } else { $uc=$_POST['uc']; } $uc=urldecode($uc);
if (!empty($cat)) {
    $fsqlqc=mysql_query_s('SELECT uppercat FROM '.$database.'.bible_nodes WHERE type = \'fc\' AND title=\''.urlencode($cat).'\' AND category=\''.urlencode($cat).'\';');
    $scat=mysql_result($fsqlqc,0,'uppercat');
}
if (empty($_GET['createcontent']) && empty($_GET['edit'])) {
    $fsqlq=mysql_query_s('SELECT * FROM '.$database.'.bible_nodes WHERE type = \'fc\' AND category = \''.urlencode($cat).'\' AND uppercat=\''.urlencode($uc).'\' order by title;');
    #if($uid=1){echo'SELECT * FROM '.$database.'.bible_nodes WHERE type = \'fc\' AND category = \''.urlencode($cat).'\' AND uppercat=\''.urlencode($uc).'\' order by title;';}
    $n=mysql_numrows($fsqlq);
    $stitle=mysql_result($fsqlq,0,'title');
    if(!isset($no_mobile)){
          echo'<form action="index.php" method="get" enctype="multipart/form-data">
            <input type="hidden" name="b" value="'.$b.'"><input type="hidden" name="forum" value="1">
            <input type="hidden" name="s" value="'.$se.'">
            <input type="hidden" name="uc" value="'.$cat.'">
            <select style="width:150" name="cy"><option selected value="">Category</option>';
          for($i=0;$i<$n; ++$i) {
            $stitle=mysql_result($fsqlq,$i,'title');
            echo'<option value="'.urlencode($stitle).'">'.$stitle.'</option>'.N;
          }
          echo'</select><input type="submit" value="Go"></form>';
        }else{
            for($i=0;$i<$n; ++$i) {
              $stitle=mysql_result($fsqlq,$i,'title');
              echo'<a href="/?forum=1&b='.$b.'&s='.$se.'&uc='.$cat.'&cy='.$stitle.'">'.$stitle.'</a> ';
            }
            echo N;
        }
        echo'<form action="index.php" method="get" enctype="multipart/form-data">
        <input type="hidden" name="b" value="'.$b.'">
        <input type="hidden" name="bk" value="'.$book.'">
        <input type="hidden" name="c" value="'.$chap.'">
        <input type="hidden" name="lookups" value="1">
        <input type="text" name="sf" value="'.$_GET['sf'].'">
        <input type="submit" value="Search Forum"></form>
        Forum Menu <form action="index.php?forum&createcontent=1&uc='.urlencode($uc).'&cy='.urlencode($cat).'&b='.$b.'&s='.urlencode($se).'" method="post">
        <input type="submit" value="Create Content">  <a href="/rss">RSS</a>  <a href="rss.php">Update RSS</a>  <a href="'.$subd.'?tv'.$bl.$bookli.'">TV</a>  <a href="/chat">'.$l_m15.'</a>  <a href="'.$subd.'?geo'.$bl.$bookli.'">Stats</a></form><hr width="100%"><div id="forum">';
        $fdiv2='</div>';
    if (!empty($stitle)) {
        #forum menu was here before
    }
    if (empty($_GET['ti']) && empty($_GET['comments']) && empty($_GET['comment']) && empty($nid)) {
        if (!empty($_GET['page'])) { $pagenum=$_GET['page'];$p_sel=1+$pagenum;} else { $p_sel='1';$pagenum='0'; }
        $page_low=0 + ($pagenum * 12);$page_high=12 + ($pagenum * 12);
        if (empty($cat)){$fsqldisp=' promote=1 and status=1 AND type NOT IN(\'fc\')';} //NOT IN('container')
        else {$fsqldisp=" status=1 AND category='".urlencode($cat)."' AND type NOT IN('fc') AND uppercat='".urlencode($uc)."'";}
        
        $fsqlq_c=mysql_query_s('SELECT count(*) AS C FROM '.$database.'.bible_nodes WHERE '.$fsqldisp);
        $s_count=mysql_result($fsqlq_c,0,'C');
        $s_count_pages=ceil($s_count/12);
        $fsqlq=mysql_query_s('SELECT uid,created,visitors,title,data,type,category,uppercat FROM '.$database.'.bible_nodes WHERE '.$fsqldisp.' ORDER BY created DESC LIMIT '."$page_low,$page_high;");
        $n=mysql_numrows($fsqlq);
        for($i=0;$i<$n; ++$i) {
            $stitle=mysql_result($fsqlq,$i,'title');
            $stype=mysql_result($fsqlq,$i,'type');
            $scate=mysql_result($fsqlq,$i,'category');$suid=mysql_result($fsqlq,$i,'uid');
            $supcate=mysql_result($fsqlq,$i,'uppercat');$svisitors=mysql_result($fsqlq,$i,'visitors');
            if(!empty($svisitors)){$sreads=' '.$svisitors.'Reads';}
            elseif(isset($sreads)){unset($sreads);}
            $screated=mysql_result($fsqlq,$i,'created');
            if($thisyear===date('y',$screated)){$datedisp='jM';}else{$datedisp='jMy';}
            $sdata=substr(strip_tags(mysql_result($fsqlq,$i,'data')),0,120);
            //<img src="ico/'.$stype.'.png'.'">
            //<img src="data:image/png;base64,'.base64_encode(file_get_contents('ico/'.$stype.'.png')).'">
            echo'<a href="?forum&cy='.urlencode($scate).'&uc='.urlencode($supcate).'&ti='.urlencode($stitle).'&b='.$b.'&s='.$se.'"><img src="ico/'.$stype.'.png'.'">'.$stitle.'</a>'.N.
                preg_replace('/(http\:[^\s]*(\s|\||$))|(\swww\.[^\s]*(\s|\||$))/i','<a href="\1">Link</a>',$sdata).N.'<sup>uid('.$suid.') '.date($datedisp, $screated).$sreads.'</sup>'.N;
        } unset($sdata);
        if ($s_count_pages >= '2') {
            echo '<form action="index.php" method="get">
                <input type="hidden" name="b" value="'.$b.'">
                <input type="hidden" name="s" value="'.urlencode($se).'">
                <input type="hidden" name="forum" value="1">
                <input type="hidden" name="uc" value="'.urlencode($uc).'">
                <input type="hidden" name="cy" value="'.urlencode($cat).'">
                <select name="page">';
            for($i=0;$i<$s_count_pages; ++$i) {
                if($p_sel == $i) {$p_s='selected ';}
                elseif(!empty($p_s)) {unset($p_s);}
                if (($i == '0') && ($_GET['page'] !== '0')) {echo '<option value="0">0</option>'; }
                else { echo '<option value="'.$i.'" '.$p_s.'>'.$i.'</option>'; }
            }
            echo'</select><input type="submit" value="Goto page"></form>';
        }
    }
    else {require('view_node.php');if(isset($_GET['comments'])){$csid='&nid='.$snid;}else{$uc=$scate;$cat=$supcate;}}
    if (!empty($ti)) { $scat=$uc;$uc=$cat; }
    //echo'ti '.$ti.' scat '.$scat.' cat '.$cat.' uc '.$uc;
    if (empty($_GET['comment'])) { unset($ti); }
    echo'<form action="index.php?forum'.$csid.'&uc='.urlencode($scat).'&cy='.urlencode($uc).'&ti='.urlencode($ti).'&b='.$b.'&s='.urlencode($se).'" method="post">
        <input type="submit" value="Back"></form>'.$fdiv2.NN;
}
else { require('new_node.php'); }
# licence: gpl-signature.txt?>