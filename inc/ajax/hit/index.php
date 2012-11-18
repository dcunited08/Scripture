<?php
if(!isset($password)){$hitreqextra=1;
$notype=1;require('../../../init.php');
#if(!empty($_GET['m'])){require('../../../inc/advanced search.php');}
echo'<!doctype html><html>
<head>
<title>Ajax auto-suggest / auto-complete | Bible Way</title>

<script type="text/javascript" src="js/bsn.Ajax.js"></script>
<script type="text/javascript" src="js/bsn.DOM.js"></script>
<script type="text/javascript" src="js/bsn.AutoSuggest.js"></script>
</head><body>';
}else{$shootextra='<input type="hidden" name="shoot">';
#if(!empty($_GET['m'])){$se4=$_GET['m'].':'.$_GET['s2'];
#echo'test';require('inc/advanced search.php');}
}
if(!isset($no_mobile)){$thesize='70';}else{$thesize='140';}
$dosel[$_GET['m']]=' selected';
if(isset($_GET['tri'])){$trisel='  checked';}
echo'<b>Bible shooter</b>
<form method="get" action="">'.$shootextra.'<select name="m">
<option value="p" '.$dosel[p].'>Exact Phrase</option>
<option value="o" '.$dosel[o].'>This Order</option>
<option value="t" '.$dosel[t].'>These Words</option>
<option value="b" '.$dosel[b].'>Begins With</option>
<option value="e" '.$dosel[e].'>Ends With</option>
</select>Change the bible.<br>Between verses <input type="checkbox" name="tri"'.$trisel.'>';
if(isset($hitreqextra)){$largelist=1;require('../../../inc/bible_list.php');$shootfile='hit.php';}
else{require('inc/bible_list.php');$shootfile='inc/ajax/hit/hit.php';}
echo'</form><form method="get" action="">Type for example "love not":<br>
<input type="text" size="'.$thesize.'" id="s2" name="s2" value="" />
<input type="hidden" name="b" value="'.$_GET['b'].'">
</form>';
#if(isset($_GET['m'])){$sm='mode:'.$_GET['m'].',';}

#echo'</form>';
if(isset($hitreqextra)){
    if(isset($_GET['b'])){$hbi='bible:'.$_GET['b'].',';}
    if(!empty($_GET['m'])){$hcm='cmode:'.$_GET['m'].',';}
    if(isset($_GET['tri'])){$htm='tri:1,';}
    elseif(isset($fp)){$hcm='cmode:1,';}
    echo'<script type="text/javascript">
	var options = {
		script:"'.$shootfile.'?",
		varname:"input",
		minchars:1,'.$hbi.$hcm.$htm.'
	};
	var as = new AutoSuggest(\'s2\', options);
</script>';}
echo'</body></html>';
?>