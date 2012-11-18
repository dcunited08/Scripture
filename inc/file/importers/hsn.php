<?php
/*
la heb:14
*HSN Ancient Hebrew,eng
Type 0|Strong 1|Modern 2|Ancient 3|Translit 4|Definition 5|AHLB 6
*/
echo'starting..';
$data=explode(',', str_replace('*',"",$fileData));
$mysqldo_check='SELECT snid FROM bible_sn_list WHERE snname=\''.$data[0].'\';';
$mysqldo='INSERT INTO bible_sn_list (snname, lang) VALUES (\''.$data[0].'\', \''.$data[1].'\');';
$mysqldo_update = $mysqldo_check; // quickfix
mysql_query_s($mysqldo);++$i;

$sndataid=mysql_result(mysql_query_s($mysqldo_check),0,'snid');
while($i<=$countfilel){
    $hdab=stripslashes($lines[$i]);
    $hda=explode('|',$hdab);
    $mysqldo_check="SELECT sn FROM bible_strongnumber WHERE sn='".$stw_tmp."' AND snid=$sndataid";#Type 0|Strong 1|Modern 2|Ancient 3|Translit 4|Definition 5|AHLB 6
    $mysqldo='INSERT INTO bible_strongnumber (snid,sn,content,type,modern,ancient,translit,ahlb) VALUES ('.$sndataid.', \''.$hda[1].'\',\''.$hda[5].'\','.$hda[0].',\''.$hda[2].'\',\''.$hda[3].'\',\''.$hda[4].'\',\''.$hda[6].'\')';
    //$mysqldo_update = "UPDATE bible_strongnumber SET content = '$fileData_tmp' WHERE snid = $sndataid AND sn='$stw_tmp'";
    $mysqldo_update=$mysqldo_check; // is a updater needed ?
 if(!empty($hda[4])){mysql_query_s($mysqldo);}
 ++$i;
}
echo'Upload Compelte';
break;
?>