<?php // licence: gpl-signature.txt
$mobl=strtolower($_SERVER['HTTP_USER_AGENT']);
/*

if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i',$mobl)){unset($no_mobile);}
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0)or
    ((isset($_SERVER['HTTP_X_WAP_PROFILE'])or
      isset($_SERVER['HTTP_PROFILE'])))) {
    unset($no_mobile);
}
if(in_array(substr($mobl, 0, 4),array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-'))) {unset($no_mobile);}*/
if((strpos($mobl,'safari')>0)or(strpos($mobl,'windows')>0)or(strpos($mobl,'linux')>0)){$no_mobile='1';}
if ((strpos($mobl,' ppc;')>0)or
    (strpos($mobl,'windows ce')>0)or
    (strpos($mobl,'iemobile')>0)or
    (strpos(strtolower($_SERVER['ALL_HTTP']),'operamini')>0)){unset($no_mobile);}

//if(!isset($no_mobile)) {$frameheight = "13%";} else {$frameheight = "24%";}
?>