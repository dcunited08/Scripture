<?php

$cat=addslashes($_GET['cat']);

if(isset($_GET['create_new_category'])){
    $stitle=addslashes($_POST['newtitle']);
    if($uid==0){die('Please login.');}
    $sqlcheck=mysql_result(mysql_query_s('select tid from '.$database.'.bible_topic_list where title="'.$stitle.'"'),0,'tid');
    if(empty($sqlcheck)){
        $tid=mysql_result(mysql_query_s('SELECT max(tid) as C FROM '.$database.'.bible_topic_list'),0,'C');
        ++$tid;
        mysql_query_s('insert into '.$database.'.bible_topic_list (id,tid,tcid,uid,title) values
		  '."('','$tid','',$uid,'$stitle');");}
    else{$tid=$sqlcheck;}

    $sqlcheck=mysql_result(mysql_query_s('select mindid from '.$database.'.bible_mind_topics where conid="'.$cat.'" and tid="'.$tid.'"'),0,'mindid');
    if(empty($sqlcheck)){mysql_query_s('INSERT INTO '.$database.'.bible_mind_topics (mindid,conid,tid,uid) values'."('','$cat',$tid,$uid);");}
}elseif(isset($_GET['upload'])){
    if($uid==0){die('Please login.');}
    $tmpfile=$_FILES['file']['name'];
    $tomove=$_FILES['file']['tmp_name'];
    if(strlen($tmpfile)>20){die('filename too long. 20 chars max.<br>');}
    if (!preg_match('/(\.(mm)($|\s$))/i',$tmpfile,$fe)) {die($fe[0].' is an invalid file type for '.$tmpfile.'<br>');}
    $tofile=getcwd().'/Mindmap/'.$uid;
    if(!file_exists($tofile)){@mkdir($tofile,0775);}
    $tofile=$tofile.'/'.$tmpfile;
    if(file_exists($tofile)){echo'Replacing previous map<br>Unique file names for each user<br>';}
    $sqlcheck=mysql_result(mysql_query_s('select mid from '.$database.'.bible_mindset where title="'.$tmpfile.'" and uid='.$uid),0,'mid');
    if(empty($sqlcheck)){
        mysql_query_s('INSERT INTO '.$database.'.bible_mindset (mid,mindid,uid,title,mode) values'."('','$cat',$uid,'".addslashes($tmpfile)."','');");
    }
    move_uploaded_file($tomove,$tofile);
    if(!file_exists($tofile)){echo'Error while uploading mindmap. Please notify the web administrator.';}
    unlink($tomove);
}

if(!isset($_GET['new_category'])){
    echo '<u>Categories</u><br>';
    $sql=mysql_query_s('SELECT tid FROM '.$database.'.bible_mind_topics WHERE conid='."'$cat';");
    $n=mysql_numrows($sql);$cats=array();#$catids=array();
    $i=0;while($i<$n){
        $catid=mysql_result($sql,$i,'tid');
        $cats[$catid]=mysql_result(mysql_query_s('select title from '.$database.'.bible_topic_list where tid="'.$catid.'"'),0,'title');
        ++$i;
    }
    asort($cats);$i2=0;
    foreach($cats as $thecatkey=>$printcat){
        echo'<a href="?mind&cat='.$thecatkey.'">'.$printcat.'</a>  ';
        if($i2>=6){echo N;$i2=0;}
        ++$i2;
    }

    /*

bible_mindset (
  mid int(10) NOT NULL AUTO_INCREMENT,
  mindid int(10),
  uid int(10),
  title varchar(20),
  mode int(2),

*/
    if(!empty($cat)){$listcat=' WHERE mindid='.$cat;}
    $sql=mysql_query_s('SELECT * FROM '.$database.'.bible_mindset'.$listcat);
    $n=mysql_numrows($sql);
    echo NN.'<table border="1">';
    $i=0;while($i<$n){
        $dfile=mysql_result($sql,$i,'uid').'/'.mysql_result($sql,$i,'title');
        echo'<tr><td>'.$dfile.'</td><td><a href="Mindmap/?f='.urlencode($dfile).'">View</a></td><td><a href="Mindmap/'.$dfile.'">Download</a></td></tr>';
        ++$i;
    }
    echo'</table>'.NN.'<form enctype="multipart/form-data" action="?mind&upload&cat='.$cat.$bl.'" method="POST">
<u>Upload MindMap File(.mm)</u><br><input name="file" type="file"><input type="submit" value="Upload File">
</form><a href="?mind&new_category&cat='.$cat.$bl.'">Create New Category</a>';
}elseif(isset($_GET['new_category'])){
    echo'<form enctype="multipart/form-data" action="?mind&create_new_category&cat='.$cat.$bl.'" method="POST">
Title:<input name="newtitle" id="newtitle" type="text"><input type="submit" value="Create">
</form><script type="text/javascript" src="inc/ajax/hit/js/bsn.Ajax.js"></script>
  <script type="text/javascript" src="inc/ajax/hit/js/bsn.AutoSuggest.js"></script>
  <script type="text/javascript" src="inc/ajax/hit/js/bsn.DOM.js"></script>';
if(isset($_GET['b'])){$hbi='bible:'.$bsel.',';}
if(!isset($dosho)){$dosho='s';}
if(isset($_GET['b'])){$hbi='bible:'.$b.',';}
if(!empty($_GET['m'])){$hcm='cmode:"'.$_GET['m'].'",';}
if(isset($_GET['tri'])){$htm='tri:1,';}
//elseif(isset($fp)){$hcm='cmode:1,';}
//if(isset($_GET['m'])){$sm='mode:'.$_GET['m'].',';}
echo'<script type="text/javascript">var options = {script:"inc/ajax/hit/topic.php?",varname:"input",minchars:1,'.$hbi.$hcm.$htm.'};
var as = new AutoSuggest(\'newtitle\', options);
</script>
</body></html>';
}

/*

bible_mind_topics (
  mindid int(10) NOT NULL AUTO_INCREMENT,
  conid int(10),
  tid int(10),
  uid int(10),

*/
?>