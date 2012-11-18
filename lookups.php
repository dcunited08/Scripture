<?php // licence: gpl-signature.txt
echo 'Search or lookup strongs:
<form action="index.php" method="get" enctype="multipart/form-data">
<input type="hidden" name="b" value="'.$b.'">
<input type="hidden" name="bk" value="'.$book.'">
<input type="hidden" name="c" value="'.$chap.'">
<input type="hidden" name="lookups" value="1">
<input type="text" name="stse"><br>
Search forum<br>
<input type="text" name="sf" value="'.stripslashes($_GET['sf']).'"><br>
<input type="submit" value="Go"></form>';
//if(!empty($listerdata)) {  }
if (!empty($_GET['stse'])) {
    $limitstrong=" AND snid='$gstrong'";
    if (($gstrong == 'All') or empty($gstrong)) { unset($limitstrong); }
    if (preg_match('/\w{1,20}\d{1,4}/',$_GET['stse'])){$sql="SELECT * FROM bible_strongnumber WHERE sn LIKE '".stripslashes($_GET['stse'])."';"; unset($limitstrong);}
    else { $sql="SELECT * FROM bible_strongnumber WHERE content LIKE '%".$_GET['stse']."%' $limitstrong;"; }
    echo 'Results from search "'.$_GET['stse'].'"'.NN;
    $fsqlq=mysql_query($sql);
    $n=mysql_numrows($fsqlq);
    
    for($i=0;$i<$n; ++$i) {
      $s_sn=mysql_result($fsqlq,$i,'sn');
      $s_content=mysql_result($fsqlq,$i,'content');
      $s_content=preg_replace('(\r\n)','<br>',$s_content);
      if (empty($limitstrong)){$s_snid=mysql_result($fsqlq,$i,'snid').'.';}
      $s_content = preg_replace('/'.$_GET['stse'].'/i','<font color=\''.$versehighlightcolor.'\'>'.$_GET['stse'].'</font>',$s_content);
      echo $s_snid.$s_sn.N.$s_content.N;
    }
}elseif(!empty($_GET['sf'])){
  $sf=stripslashes($_GET['sf']);
  $nolatest='1';
  $s=mysql_query("SELECT nid,title,data,type,uid,created,category,uppercat FROM bible_nodes WHERE uppercat like '%$sf%' or category like '%$sf%' or data like '%$sf%'");
  require('inc/forum_view.php');
  // $s=mysql_query('SELECT nid,title,data,type,uid,created,category,uppercat FROM bible_nodes WHERE '.$s.' ORDER BY type,sticky,created DESC LIMIT 0,21;');
}elseif (!empty($_GET['st'])) {
  
    #$limitstrong=" AND snid='$gstrong'";
    #if (($gstrong == 'All') or empty($gstrong)) { unset($limitstrong); }
    $sql="SELECT * FROM bible_super_dial_context WHERE title LIKE '%".stripslashes($_GET['st'])."%' or context like '%".stripslashes($_GET['st'])."%' or subcontext like '%".stripslashes($_GET['st'])."%';";
    echo 'Results from search "'.$_GET['st'].'"'.NN;
    $fsqlq=mysql_query($sql);
    $n=mysql_numrows($fsqlq);
    
    for($i=0;$i<$n; ++$i) {
      $s_title=mysql_result($fsqlq,$i,'title');
      $s_content=mysql_result($fsqlq,$i,'context');
      $ssub=mysql_result($fsqlq,$i,'subcontext');
     if(!empty($s_title)){
        $s_title=preg_replace('(\r\n)','<br>',$s_title);
        $s_title = preg_replace('/'.$_GET['sf'].'/i','<font color=\''.$versehighlightcolor.'\'>'.$_GET['sf'].'</font>',$s_title);
        echo 'Title: '.$s_title.N;}
      if(!empty($s_content)){
        $s_content=preg_replace('(\r\n)','<br>',$s_content);
        $s_content = preg_replace('/'.$_GET['sf'].'/i','<font color=\''.$versehighlightcolor.'\'>'.$_GET['sf'].'</font>',$s_content);
        echo 'Context: '.$s_content.N;}
      if(!empty($ssub)){
        $ssub=preg_replace('(\r\n)','<br>',$ssub);
        $ssub = preg_replace('/'.$_GET['sf'].'/i','<font color=\''.$versehighlightcolor.'\'>'.$_GET['sf'].'</font>',$ssub);
        echo 'Subcontext: '.$ssub.N;}
      echo N;
    }
}
// licence: gpl-signature.txt?>
