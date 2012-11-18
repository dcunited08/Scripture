<?php
/*
if (($countingto == 'Context')or($contentmode == 'bw')) {
if ((!empty($bid) && !empty($data[4])  && !empty($bkid))or(($contentmode == 'bw') and !empty($bid))) {
 $mysqldo ='INSERT INTO bible_tri_context (bid2, bid, bk, c, v, ec, ev, lm, m, tx)
 VALUES ('.$bid.','.$bidt.', \''.$data[0].'\', '.$data[1].', '.$data[2].', '.$data[3].', '.$data[4].', \''.$data[5].'\',2, \''.$data[6].'\')';
 $mysqldo_check = "SELECT vsid FROM bible_tri_context WHERE
 bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
 $mysqldo_update = "UPDATE bible_tri_context SET tx = '".$data[6]."' WHERE
 bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
}
}

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
  $fileData=preg_replace('/(\r?\n?)/',"",str_replace('\'','`',$fileData));
  if(substr_count($fileData,'|') >= 3){$data=explode('|',addslashes($fileData));}
  #else{$data=explode(' ',$fileData); } #not in this case.
  if ((!empty($bid) && !empty($data[4])  && !empty($bkid))or(($contentmode == 'bw') and !empty($bid))) {
    $mysqldo ='INSERT INTO bible_tri_context (bid2, bid, bk, c, v, ec, ev, lm, m, tx)
    VALUES ('.$bid.','.$bidt.', \''.$data[0].'\', '.$data[1].', '.$data[2].', '.$data[3].', '.$data[4].', \''.$data[5].'\',2, \''.$data[6].'\')';
    $mysqldo_check = "SELECT vsid FROM bible_tri_context WHERE
    bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
    $mysqldo_update = "UPDATE bible_tri_context SET tx = '".$data[6]."' WHERE
    bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
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
?>