<?php // licence: gpl-signature.txt
    // $pageURL = 'http'; //redirect to position function //empty($sectionhtml) && 
    //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";} $pageURL .= "://";
    unset($fp);
    $pageURL = ''.$_SERVER["REQUEST_URI"];
    if(!empty($_GET['s'])){$checkv=stripslashes($_GET['s']);}
    elseif(!empty($_POST['lookup'])){$checkv=stripslashes($_POST['lookup']);$lookupv='&lookup='.$checkv;}
    elseif(!empty($_GET['bookmark'])){$checkv=stripslashes($_GET['bookmark']);}
    elseif(!empty($_GET['note'])){$checkv=stripslashes($_GET['note']);}
    elseif(!empty($_GET['favorite'])){$checkv=stripslashes($_GET['favorite']);}
    else{$checkv='?b='.$_GET['b'].'&bk='.$_GET['bk'].'&cs='.$_GET['cs'].'&bdial';}
    $se3=explode('.',$checkv);
    if(count($se3)==1){$checkv=str_replace('.',"",$checkv);}
    if(count($se3)>1){$nohighlight = '1';}
    //if ($_SERVER["SERVER_PORT"] != "80") { $pageURL .= '/'.$_SERVER["REQUEST_URI"];
    //} else {$pageURL .= '/'.$_SERVER["REQUEST_URI"];} // $_SERVER["SERVER_NAME"] before / //":".$_SERVER["SERVER_PORT"].
    if (preg_match('/\d/',$checkv) && empty($nohighlight)) {header('Location: '.$pageURL.'&pos=1'.$lookupv.'&#v',false); exit;}
?>