<?php
if(($uid==1)and isset($_GET['myownlink'])){$themidd=' mid=7 '; }
elseif($uid==1){$themidd=' uid='.$uid;}#.' and type=2'
elseif($uid!==0){$themidd=' uid='.$uid;}
else{die('Please login to generate your own topic links');}
 $sql=mysql_query_s('Select * from bible_super_dial_context where '.$themidd.';');
 $n=mysql_numrows($sql);
 $countup=0;
 $sbook3="";$sbook2="";
  $i=0;while($i<=$n){
    $sbook3=addslashes(mysql_result($sql,$i,'title'));$smidt=mysql_result($sql,$i,'mid');$suid=mysql_result($sql,$i,'uid');
    $stype=mysql_result($sql,$i,'type');$sverses=addslashes(mysql_result($sql,$i,'verses'));$ssubcontext=addslashes(mysql_result($sql,$i,'subcontext'));
    $sbook=addslashes(mysql_result($sql,$i,'book')); $scontext=addslashes(mysql_result($sql,$i,'context'));
    if(!empty($sverses)){
     $ex_v=explode('.',$sverses);
     if(count($ex_v)<1){$ex_v=explode('.','.'.$sverses);}
     foreach($ex_v as $upv){
      $vex=explode(' ',$upv);
      $sb=$vex[0];
      if(empty($sb)){$sb=$sbook;}
      if(strstr($vex[1],':')){
       $vexcv=explode(':',$vex[1]);$sc=$vexcv[0];
       if(strstr($vexcv[1],'-')){$vrex=explode('-',$vexcv[1]);$sv=$vrex[0];$sv2=$vrex[1];}
       else{$sv=$vexcv[1];}
      }
      else{$sc=$vex[1];}
      $checkq='SELECT pid FROM bible_topic_link WHERE uid='.$suid.' and book=\''.$sbook.'\' and type=\''.$stype.'\' and
		    title=\''.$sbook3.'\' and context=\''.$scontext.'\' and subcontext=\''.$ssubcontext.'\' and b=\''.$sb.'\' and
		    c='.$sc.' and v='.$sv.' and v2='.$sv2.';';
      #if($uid==1){echo$checkq.N;}
      $sqlcheck=mysql_result(mysql_query_s($checkq),0,'pid');
#echo $sqlcheck.' '.$checksql.'<br>';
      if(empty($sqlcheck)){++$countup;mysql_query_s('insert into '.$database.'.bible_topic_link (tid,mid,uid,book,type,title,mode,b,c,v,v2,context,subcontext) values
		  '."('',$smidt,$suid,'$sbook',$stype,'$sbook3',1,'$sb',$sc,$sv,$sv2,'$scontext','$ssubcontext');");}
      unset($sv,$sb,$sv2,$sc);
     }
     unset($ssubcontext,$scontext,$sbook3,$sbook);
    }
    ++$i;
  }
echo'done uploading '.$countup.'<br>';

/*
 *
 *
if(!empty($smidt)){# $scontext=mysql_result($sql,$i,'context');$ssubcontext=mysql_result($sql,$i,'subcontext');
      $stype=mysql_result($sql,$i,'type');$sverses=mysql_result($sql,$i,'verses');
      #$strioarg=mysql_result($sql,$i,'trioarg');$sfirstyear=mysql_result($sql,$i,'firstyear');$slastyear=mysql_result($sql,$i,'lastyear');

 *
 
  tid int(10) NOT NULL AUTO_INCREMENT,
  mid int(10),
  uid int(10),
  book varchar(80) NOT NULL,
  type int(3) unsigned NOT NULL,
  title varchar(200),
  mode int(3),
  b varchar(3) NOT NULL,
  c int(10) NOT NULL,
  v int(10) NOT NULL,
 
*/
?>