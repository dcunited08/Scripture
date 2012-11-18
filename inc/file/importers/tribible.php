<?php
if (($countingto == 'Context')or($contentmode == 'bw')) {
if ((!empty($bid) && !empty($data[4])  && !empty($bkid))or(($contentmode == 'bw') and !empty($bid))) {
 $mysqldo ='INSERT INTO bible_tri_context (bid2, bid, bk, c, v, ec, ev, lm, m, tx)
 VALUES ('.$bid.','.$bidt.', \''.$data[0].'\', '.$data[1].', '.$data[2].', '.$data[3].', '.$data[4].', \''.$data[5].'\',2, \''.$data[6].'\')';
 $mysqldo_check = "SELECT vsid FROM bible_tri_context WHERE
 bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
 $mysqldo_update = "UPDATE bible_tri_context SET tx = '".$data[6]."' WHERE
 bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
}
}elseif ($countingto == 'Chapter') {
if (!empty($bid) && !empty($data[1])  && !empty($bkid)) {
 $mysqldo ="INSERT INTO bible_tri_book_name (bid2, bkid, book, fname, sname, chap) VALUES ($bid, '$bkid', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."')";
 $mysqldo_check = "SELECT fname FROM bible_tri_book_name WHERE bid2=".$bid." and bkid='$bkid'";
 $mysqldo_update = "UPDATE bible_tri_book_name SET fname = '".$data[1]."' WHERE bid2 = '$bid' AND bkid='$bkid'";
 $bkid++;
}
}elseif (($countingto == 'TriBible')and empty($bid)) {
if (!empty($data[1]) && !empty($data[0])) {
 if(strlen($data[0]) > 6){$datatemp=$data[0];$data[0]=$data[1];$data[1]=$datatemp;}
 $mysqldo ="INSERT INTO bible_tri_list (bid, bsn, bname, lang, serialversion,owner$isglobal) VALUES ($bidt,'".substr($data[0],0,5)."', '".$data[1]."', '".preg_replace('/(\r)|(\n)/i',"",$data[2])."','','$uid'$isglobal2)";
 $mysqldo_check = "SELECT * FROM bible_tri_list WHERE bsn='".substr($data[0],0,5)."'";
 $mysqldo_update = "UPDATE bible_tri_list SET bsn = '".substr($data[0],0,5)."' WHERE bname = '".$data[1]."'";
 //echo htmlentities($mysqldo);
 
 # bible_tri_context (bid2, bid, bk, c, v, ec, ev, lm, m, tx)
 # bible_tri_book_name (bid, bkid, book, fname, sname, chap)
 # bible_tri_list (bsn, bname, lang, serialversion,owner
}
}
?>