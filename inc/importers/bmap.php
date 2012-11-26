<?php
/*
elseif ($countingto == 'bmap') {
  if (!empty($data[3])) {
    //bible_super_dial_contextpidmiduidbooktype date trioargcontexttitleverses,firstyear,lastyear
    $mysqldo_check = 'SELECT pid FROM bible_super_dial_context WHERE uid='.$uid.' AND title=\''.addslashes($title).'\' AND mid='.$mid.' AND type=\''.addslashes($title).'\';';
    $mysqldo_update = $mysqldo_check; //quickfix
    $date=$data[6];
    if(strlen($date)<5){$date=time();}//preg_replace('/([^\\])\'/i','\1\\\'',
    $mysqldo = 'INSERT INTO bible_super_dial_context (pid,mid,uid,book,type,date,trioarg,title,context,verses,firstyear,lastyear,subcontext,l,l2,tid)
    VALUES (NULL,'.$mid.','.$uid.',\''.addslashes($data[2]).'\',\''.addslashes($data[0]).'\','.$date.',\''.
    addslashes($data[1]).'\',\''.addslashes($data[3]).'\',\''.addslashes($data[4]).'\',\''.addslashes($data[5]).'\',\''.
    addslashes($data[7]).'\',\''.addslashes($data[8]).'\',\''.addslashes($data[10]).'\',\''.addslashes($data[11]).'\',\''.
    addslashes($data[12]).'\',\''.addslashes($data[13]).'\')';
    $mysqldo_update = $mysqldo; //bad fix
    #echo$mysqldo.'<br>'; ##type|1fulfilled,2not fulfilled|Book|title|context|verses|date||||subcontext  #|Linked[See also]|Linked[Also Called]|topicid
  }
}

//bible_super_dial_contextpidmiduidbooktype date trioargcontexttitleverses,firstyear,lastyear
*/
++$i;
while($i<=$countfilel){
  if($i==$countfilel_25){echo'|||25%';}
  elseif($i==$countfilel_50){echo'|||50%';}
  elseif($i==$countfilel_75){echo'|||75%'.N;}
  if(!empty($fileData)){unset($mysqldo);}
  if(!isset($nf)){$fileData=fgets($filePointer);} //, 4096
  else{$fileData=$lines[$i];}
  if(empty($utf8found)){$fileData=utfencoder($fileData);}
  if($uid!=='1'){$fileData=preg_replace($tag_filter,'',$fileData);}
  $fileData=preg_replace('/(\r)|(\n)/',"",str_replace('\'','`',$fileData));
  if(substr_count($fileData,'|') >= 10){$data=explode('|',addslashes($fileData));}
  #else{$data=explode(' ',$fileData); } #not in this case.
  if (!empty($data[3])) {
    $mysqldo_check = 'SELECT pid FROM bible_super_dial_context WHERE uid='.$uid.' AND title=\''.addslashes($title).'\' AND mid='.$mid.' AND type=\''.addslashes($title).'\';';
    $mysqldo_update = $mysqldo_check; //quickfix
    $date=$data[6];
    if(strlen($date)<5){$date=time();}//preg_replace('/([^\\])\'/i','\1\\\'',
    /*$mysqldo = 'INSERT INTO bible_super_dial_context (pid,mid,uid,book,type,date,trioarg,title,context,verses,firstyear,lastyear,subcontext,l,l2,tid)
    VALUES (NULL,'.$mid.','.$uid.',\''.$data[2].'\',\''.$data[0].'\','.$date.',\''.
    $data[1].'\',\''.$data[3].'\',\''.$data[4].'\',\''.$data[5].'\',\''.
    $data[7].'\',\''.$data[8].'\',\''.$data[10].'\',\''.$data[11].'\',\''.
    $data[12].'\',\''.$data[13].'\')'; #OLD */
    if(empty($data[12])){$dtid=mysql_result(mysql_query_s('SELECT tid FROM bible_topic_list WHERE title=\''.$data[3].'\';'),0,'tid');}
    else{$dtid=$data[12];}
    $mysqldo = 'INSERT INTO bible_super_dial_context (pid,mid,uid,book,type,date,trioarg,title,context,verses,firstyear,lastyear,subcontext,l,l2,tid)
    VALUES (NULL,'.$mid.','.$uid.',\''.$data[2].'\',\''.$data[0].'\','.$date.',\''.
    $data[1].'\',\''.$data[3].'\',\''.$data[4].'\',\''.$data[5].'\',\''.
    $data[7].'\',\''.$data[8].'\',\''.$data[9].'\',\''.$data[10].'\',\''.$data[11].'\',\''.$dtid.'\')';
    $mysqldo_update = $mysqldo; //bad fix
  }
  if(isset($mysqldo)){
    $result_check=mysql_query_s($mysqldo_check);
    $num_check=mysql_numrows($result_check);
    if ($num_check>=1) {$results_db_up = mysql_query_s($mysqldo_update);}
    else { mysql_query_s($mysqldo) or die(mysql_error().' line: '.$i.' sql: <br>'.htmlentities($mysqldo).' <br>'.$fileData); }
  }
  unset($mysqldo,$mysqldo_check,$mysqldo_update);
  ++$i;
}
#echo$mysqldo.'<br>'; ##type|1fulfilled,2not fulfilled|Book|title|context|verses|date||||subcontext  #|Linked[See also]|Linked[Also Called]|topicid
?>