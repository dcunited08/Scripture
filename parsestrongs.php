<?php # licence: gpl-signature.txt
if(!isset($strong_char)){if(preg_match('/<([^>]\d{4})>/i',$x)){$strong_char='1';}else{$strong_char='2';}}//\d
if(!empty($mysettings[3])and($mysettings[3]<3)){
if($strong_char=='2'){$strongsearcher=preg_match_all('/&lt;([^&]\d{4})&gt;/i',$x,$getstrongi);}
else{$strongsearcher=preg_match_all('/<([^>]\d{4})>/i',$x,$getstrongi);}
$getstrongi3=array_unique($getstrongi[1]);
if(empty($strdef2)){
  $rarr1=array('"','\'','=');$rarr2=array('&#34;','&#39;','&#61;');
}
foreach($getstrongi3 as $gestro){
  //.str_replace(array("<", ">"), "",	// <- cache function
  $s1=mysql_query_s('SELECT * FROM '.$database.'.bible_strongnumber WHERE sn=\''.$gestro.'\' AND snid='.$gstrong);
  $num6=mysql_numrows($s1);$s1c=mysql_result($s1,0,'content');
  if(!empty($s1c)){
    if($mysettings[3]==='1'){$strdef2='<select class="ss" name="'.$gestro.'">';} // note: selected=\"selected\"//
    else{$strdef2='<a href="?uf=1&gs='.$gestro.'" title="';}
    
    //for($i2=0;$i2<$num6;$i2++){
    $i2=0;while($i2<$num6){
      $strdef=mysql_result($s1,$i2,'content');
      if($i2=='0'){}//$strdef=htmlentities($strdef);
        $strdef=str_replace($rarr1,$rarr2,$strdef);
	if($mysettings[3]==='1'){
          $strdef=str_replace('<br>','\r\n',strip_tags($strdef));
	  $a_sqlstrongdef=preg_split('/[\r\n]+/', $strdef, -1, PREG_SPLIT_NO_EMPTY);
	  //$a_sqlstrongdef=preg_replace('/(?<=\w{400}\s)/','',$a_sqlstrongdef); //under construction/looking at css alternatives using wordwrap...
	  //$a_sqlstrongdef=explode('\r\n', $strdef);
	  foreach($a_sqlstrongdef as $strongselput){$strongselput=trim($strongselput);if(!empty($strongselput)){$strdef2 .= '<option>'.$strongselput.'</option>';}}  //value=""
        }
        else{$strdef2 .= preg_replace('/(<br>)|(\r\n)/i','&#xD;',$strdef);}//&#10; &#xD; &#13;
      ++$i2;
    }
     if($mysettings[3]==='1'){$strdef2 .= '</select>';}else{$strdef2 .= '">&#8226;</a>';} //next: $x=str_replace('<'.$gestro.'>',$strdef2,$x);
     /*// the following uses more system resources, but is more userfriendly: (also not quite ready)
      $x=preg_replace('/(?<=\s|^)(([\xc0-\xdf]{1,20}|\w{1,20})[\,\.\:\;]?)[\s]?(\&lt\;|<)($gestro)(\&gt\;|>)/iu','<a href="?uf=1&b='.$b.'&gs=\4">\1</a>',$x); //\s[^\s] [\s]?
     */
     if($strong_char!=='2'){$x=str_replace('<'.$gestro.'>',$strdef2,$x);}
     else{$strongdefinition2 .= '">&#8226;</a>';$x=str_replace('&lt;'.$gestro.'&gt;',$strdef2,$x);}// old $strdef2 .= ""; //next: $x=str_replace('<'.$gestro.'>',$strdef2,$x);}
     //if($uid==1){echo'<br>strdef2'.$strdef2.'<p></p>gestro'.$gestro.'<br>';}
     //unset($strdef2,$gestro);
     
    }
  }
 }
 else{ //if your php server is updated; you may use \X instead of [\xc0-\xdf] below for better experience
  //$x=preg_replace('/(?<=\s|^)(([\xc0-\xdf]{1,20}|\w{1,20})[\,\.\:\;]?)[\s]?(\&lt\;|<)([^\&]\d{4})(\&gt\;|>)/iu','<a href="?uf=1&b='.$b.'&gs=\4">\1</a>',$x); //\s[^\s] [\s]?
  $x=preg_replace('/[^>](?<=\s|^)([&;\w\~\.\[\]\æøå(\'\\\)\!\X]{1,140}[,\.:;]?)[\s]?(&lt;|<)([^\&]\d{4})(&gt;|>)/iu',' <a href="?uf=1&b='.$b.'&gs=\3">\1</a>',$x); //\s[^\s] [\s]?
  if($strong_char=='2'){$x=preg_replace('/&lt;([^&]\d{4})&gt;/i',' <a href="?uf=1&b='.$b.'&gs=\1">&#8226;</a>',$x);}//[^\d\;\&]
  else{$x=preg_replace('/<([^>]\d{4})>/i','<a href="?uf=1&b='.$b.'&gs=\1">&#8226;</a>',$x);} //old target: middleframe // target=\'_self\'
//if($uid==1){$x.='hey';}
}
if(!empty($lann)){$x=preg_replace('/\{((?:\w{1,20}-?){1,4})\}/i','<a href="?uf=1&b='.$b.'&ln=\1">&#9834;</a>',$x);}
if(!empty($geneva)){$x=preg_replace('/(?:[\{])([^\}<]*)/i','<sup>\1</sup>',$x);}
if($mysettings[3]==='1'){echo'<style>#elementId select.ss {width:1.5em;}</style>';}
# licence: gpl-signature.txt?>