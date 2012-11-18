<?php
if (($countingto == 'Context')or($contentmode == 'bw')) {
if ((!empty($bid) && !empty($data[4])  && !empty($bkid))or(($contentmode == 'bw') and !empty($bid))) {
 $mysqldo ='INSERT INTO bible_context (bid, book, chapter, verse, linemark, mode, context) VALUES ('.$bid.', \''.$data[0].'\', '.$data[1].', '.$data[2].', \''.$data[3].'\',2, \''.$data[4].'\')';
 $mysqldo_check = "SELECT vsid FROM bible_context WHERE bid=$bid AND book='".$data[0]."' AND chapter=".$data[1]." AND verse=".$data[2]."";
 $mysqldo_update = "UPDATE bible_context SET context = '".$data[4]."' WHERE bid=$bid AND book='".$data[0]."' AND chapter=".$data[1]." AND verse=".$data[2]."";
}
}elseif ($countingto == 'Chapter') {
if (!empty($bid) && !empty($data[1])  && !empty($bkid)) {
 $mysqldo ="INSERT INTO bible_book_name (bid, bkid, book, fname, sname, chap) VALUES ($bid, '$bkid', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."')";
 $mysqldo_check = "SELECT book FROM bible_book_name WHERE bid=".$bid." and AND sname='".$data[2]."'";
 $mysqldo_update = "UPDATE bible_book_name SET book = '".$data[0]."' WHERE bid = '$bid' AND sname='".$data[2]."'";
 $bkid++;
}
}elseif ($countingto == 'Bible') {
if (!empty($data[1]) && !empty($data[0])) {
 if(strlen($data[0]) > 6){$datatemp=$data[0];$data[0]=$data[1];$data[1]=$datatemp;}
 if(!empty($bidt)){$bid=$bidt;}
 else{
 $mysqldo ="INSERT INTO bible_list (bsn, bname, lang, serialversion,owner$isglobal) VALUES ('".substr($data[0],0,5)."', '".$data[1]."', '".preg_replace('/(\r)|(\n)/i',"",$data[2])."','','$uid'$isglobal2)";
 $mysqldo_check = "SELECT * FROM bible_list WHERE bsn='".substr($data[0],0,5)."'";
 $mysqldo_update = "UPDATE bible_list SET bsn = '".substr($data[0],0,5)."' WHERE bname = '".$data[1]."'";
 }
 //echo htmlentities($mysqldo);
}
}
?>