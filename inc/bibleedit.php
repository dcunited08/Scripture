<?php # licence: gpl-signature.txt
$ssecurity=mysql_query_s('select * from bible_list where bid='.$doeditb);
if(($uid==1)or(mysql_result($ssecurity,0,'owner')==$uid)or preg_match('/(^'.$uid.'\s)|(\s'.$uid.'\s)|(\s'.$uid.'$)/i',mysql_result($ssecurity,0,'edituids'))){
    $scontentcheck=mysql_query_s('select max(rev),revuid,revdate,bid,book,chapter,verse,context,vsid,mode from bible_context where book=\''.$book.'\' AND chapter='.$chap.' AND bid='.$doeditb.'  group by bid,book,chapter,verse');
    //echo'select * from bible_context where book=\''.$book.'\' AND chapter='.$chap.' AND bid='.$doeditb.N;
    $edcount=stripslashes($_GET['cedits']);
    $i2=0;$i=1;while($i<=$edcount){
        $sqtmp=mysql_result($scontentcheck,$i2,'context');
        $checkchange=stripslashes($_POST[$book.'_'.$chap.'_'.$i]);
        $checkchange=str_replace('&lt;','<',$sc);
        $checkchange=str_replace('&gt;','>',$sc);
        $checkchange=strcasecmp(trim($sqtmp,"\r\n"),trim($checkchange,"\r\n"));
        if(($checkchange!==0)or empty($sqtmp)){
            if(!isset($revinfo)){
                $upuptime=time();
                $toprevs=mysql_query_s('SELECT max(rev) from bible_revision_information where bid='.$doeditb);
                $toprev==mysql_result($toprevs,0,'rev');
                $revi=stripslashes($_POST['revinfo']);
                if(empty($revi)){$revi='No Information';}
                $sqtmp='INSERT INTO bible_revision_information (rid,bid,rev,revuid,revdate,ip,geodata,uid,description)
                VALUES(\'\','.$doeditb.','.($toprev +1).','.$uid.','.$upuptime.',\''.$remoteaddr.'\',\''.$geodata.'\','.$uid.',\''.$revi.'\');';
                mysql_query_s($sqtmp);
                $supupdescription=mysql_query_s('SELECT rid from bible_revision_information where revdate='.$upuptime);
                $revinfo=mysql_result($supupdescription,0,'rid');
                //echo$sqtmp.N.$revinfo.N.'SELECT rid from bible_revision_information where revdate='.$upuptime;
            }
            //if($i<2){echo'Changed From: '.htmlentities(trim(mysql_result($scontentcheck,$i2,'context'),"\r\n")).N.'Changed To__: '.htmlentities(trim($_POST[$book.'_'.$chap.'_'.$i],"\r\n")).N;}
            $rev=mysql_result($scontentcheck,$i2,'rev');
            $sqledit=str_replace("'","\'",$_POST[$book.'_'.$chap.'_'.$i]);
            $sqledit=str_replace('&lt;','<',$sc);
	    $sqledit=str_replace('&gt;','>',$sc);
            if(!empty($sqledit)and!empty($revinfo)){
              $sqledit='INSERT INTO bible_context (bid, book, chapter, verse,mode, context ,rev , revuid, revdate,revinfoid) VALUES
              ('.$doeditb.', \''.$book.'\', '.$chap.', '.$i.',2, \''.$sqledit.'\','.($rev +1).', '.$uid.','.$upuptime.','.$revinfo.');';
              //echo N.$sqledit.N;
              mysql_query_s($sqledit);
            }
            #if($uid==1){echo$sqledit.N;}
            //echo$i.'changed'.N;
        }
        //else{echo$i.'no change'.N;}
        //else{echo'Changed From: '.trim(mysql_result($scontentcheck,$i2,'context'),"\r\n").N.'Changed To__: '.trim($_POST[$book.'_'.$chap.'_'.$i],"\r\n").N;}
        
        //echo.$book.'_'.$chap.'_'.$i.N;
        ++$i;++$i2;
    }
    $eddone='Bible Revision Updated'.NN;
}
?>