<?php // licence: gpl-signature.txt
if(!empty($_GET['advsn'])){
   $advsn=stripslashes($_GET['advsn']);
   $advsn=preg_replace('/\s{2,6}/',' ',$advsn);
   preg_match('/(^[\.]?([bseropmwt])\:)/i', $se4,$match);
   //egne produserte lister for ord-alternativer/or
   $advsn_e=explode(' ',$advsn);$advsno=$advsn;
   if(count($advsn_e)>0){$advsn="";foreach($advsn_e as $advsn_tmp){$advsn.=' -'.$advsn_tmp;}}
   else{$advsn=' -'.$advsn;}
  }
  unset($se3);$se3=array();$se3[0]=preg_replace('/(^\.?'.$match[2].':\s?)/',"",$se4);$simplified_mode=$match[2];
  $sqextra='context,verse,chapter,book,';
  $mode_enabled=$simplified_mode.': ';$reg_ena=urlencode($simplified_mode.':');
  if($simplified_mode=='m'){$simplified_mode='p';}
  if($simplified_mode=='s'){$simplified_mode='b';}
  $optword=stripslashes($_GET['o']);
  if(!empty($optword)){$optw='&o='.$optword;$optword='(?:\s?[\S]*\s?){0,'.$optword.'}';
   $doop='&o='.$_GET['o'];
  }
  if(!empty($_GET['w'])){$wildcard=stripslashes($_GET['w']);}
  else{$wildcard='w1';}
   if(($simplified_mode!=='r')and($wildcard!=='w4')){
    $wcu='&w='.$wildcard;
    if(!empty($_GET['wl'])){$wl=stripslashes($_GET['wl']);$dowl='&wl='.$_GET['wl'];}
    else{$wl=9;}
    $wc='[\S]{0,'.$wl.'}';
    //$wc='[\S^$]{0,9}'; //use this?
    if(($wildcard=='w1')or($wildcard=='w3')){$wcr=$wc;}
    if(($wildcard=='w2')or($wildcard=='w3')){$wcl=$wc;}
   }
  //if($simplified_mode=='r'){$sr=$se;unset($simplified_mode);$regex_enabled='r:';}
  $setmp=preg_replace('/\s?\w{1,3}\(\d{1,5}\)/i',"",$se3[0]);
  if(empty($advsno)){$advsno=preg_match('/\-(.*)/i',$setmp,$excludes);$advsno=$excludes[1];}
  $setmp=preg_replace('/(\s?\-.*)/i',"",$setmp);
  $spacec=count(explode(' ',$setmp));
  if($spacec>1){$setmp=$wcl.$setmp.$wcr;}
  if(($simplified_mode=='o')or($simplified_mode=='t')){$wtmp=$setmp;}
  else{$setmp=preg_replace('/(\s)/i',$wcr.'\]?\.?\,?\s\[?'.$wcl,$setmp);}
  if(($simplified_mode=='p')or($simplified_mode=='b')or($simplified_mode=='e')){
   //INPUT PARAPHRASER  ->
   if(strstr($setmp,'|')){$setmp=str_replace('|',')|(','('.$setmp.')');}
  }
  if($simplified_mode=='p'){$sr='((\s|^|\])\s?'.$setmp.'\.?\s?(\s|\{|$))';}
  elseif($simplified_mode=='b'){$sr='(((\S?\[.*?\])|^)\s?'.$optword.$setmp.'(\s|$))';}
  elseif($simplified_mode=='e'){$sr='((\s|^)'.$setmp.'\.?\s?'.$optword.'(\{|$))';}
  elseif($simplified_mode=='o'){
   $wtmp=explode(' ',$wtmp);
   $sr='(\b';
   $i=1;$end=count($wtmp);
   foreach($wtmp as $wtpm2){//INPUT PARAPHRASER  ->
    if(!empty($wtpm2)and strstr($wtpm2,'|')){$wtpm2=str_replace('|',')|(','('.$wtpm2.')');$ored=')';}
    #elseif(isset($ored)){unset($ored);}
    if(!empty($wtpm2)and($i!==$end)){$sr.=$wcl.$wtpm2.$wcr.'\W+(?:[\w;&]+\W+){0,7}';}
    elseif(!empty($wtpm2)and($i==$end)){$sr.=$wcl.$wtpm2.$wcr;}
    /*if(!empty($wtpm2)and($i!==1)and($i!==$end)){$sr.=$wcl.$wtpm2.$wcr.'\W+(?:[\w;&]+\W+){0,6}';}
    elseif(!empty($wtpm2)and($i!==$end)){$sr.=$wtpm2.$wcr.'\W+(?:[\w;&]+\W+){0,6}';}
    elseif(!empty($wtpm2)){$sr.=$wcl.$wtpm2.'\W+(?:[\w;&]+\W+){0,6}';}*/
    ++$i;
   }
   $sr.='\b)';
  }
  elseif($simplified_mode=='t'){
   $wtmp=explode(' ',$wtmp);
   $sr="";# (?=.*\bword1\b)(?=.*\bword2\b)(?=.*\bword3\b).*$
   $i=1;$end=count($wtmp);
   foreach($wtmp as $wtpm2){
    if(!empty($wtpm2)){//INPUT PARAPHRASER  ->
      if(strstr($wtpm2,'|')){$wtpm2=str_replace('|',$wcr.')|('.$wcl,'(('.$wtpm2.'))');$ored=')';}
      //elseif(isset($ored)){unset($ored);}
      $sr.='(?=.*\b'.$wcl.$wtpm2.$wcr.'\W+(?:[\w;&]+\W+){0,7}\b)';}
    ++$i;
   }
   $sr.='.*$';
  }
  elseif($simplified_mode=='t_experiment'){
   $wtmp=explode(' ',$wtmp);
   $sr='^(';
   $i=1;$end=count($wtmp);
   foreach($wtmp as $wtpm2){
    if(!empty($wtpm2)and($i!==$end)and($i!==1)){$sr.='|^('.$wcl.$wtpm2.$wcr.'\W+(?:[\w;&]+\W+){0,7})';}
    elseif(!empty($wtpm2)and($i!==$end)and($i==1)){$sr.='^('.$wcl.$wtpm2.$wcr.'\W+(?:[\w;&]+\W+){0,7})';}
    elseif(!empty($wtpm2)and($i==$end)){$sr.='|^('.$wcl.$wtpm2.$wcr.')';}
    ++$i;
   }
   $sr.=')';
  }
  elseif($simplified_mode=='r'){$sr=$se3[0];$advs=$se3[0];$sv=1;}
  $se3[0].=$advsn;
  #if($uid==1){echo print_r($se3).' num '.count($se3).N;}
  //if($uid==1){echo $sr;}
?>