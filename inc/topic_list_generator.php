<?php
/*
bible_topic_list (
  id int(10) NOT NULL AUTO_INCREMENT,
  tid int(10),
  tcid int(10),
  uid int(10),
  title varchar(200),
  PRIMARY KEY (id),
  
  
 
  
*/
if($uid!==1){die('Access denied!');}
 $sql=mysql_query_s('Select * from bible_super_dial_context');
 $n=mysql_numrows($sql);
 $countup=0;
 $sbook3="";$sbook2="";
 $i=0;while($i<=$n){
    $stitle=addslashes(mysql_result($sql,$i,'title'));$stid=addslashes(mysql_result($sql,$i,'tid'));
    if($stid != $stidt){$sqlcheck=mysql_result(mysql_query_s('select tid from '.$database.'.bible_topic_list where tid='.$stid),0,'tid');}
    if(empty($sqlcheck)and!empty($stid)and($stid != $stidt)and!empty($stitle)){$stidt=$stid;++$countup;mysql_query_s('insert into '.$database.'.bible_topic_list (id,tid,tcid,uid,title) values
		  '."('',$stid,'',$uid,'$stitle');");}
    else{unset($sqlcheck);}
    unset($stid);++$i;
  }
  echo N.$countup.' Generated'.N;
?>