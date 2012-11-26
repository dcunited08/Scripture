<?php
if($l=='n'){require('inc/Languages/Menu_Norwegian.php');}
else{require('inc/Languages/Menu_English.php');}
if(!isset($password)){require('init.php');}
echo'<a href="index.php?fp=1'.$bl.'">Menu</a><p></p>
<a href="'.$subd.'/bible_dial.php?bd'.$bl.'">'.$l_m6.'</a><p></p>
<a href="'.$subd.'/bible_dial.php?bd'.$bl.'&hl">'.$l_m7.'</a><p></p>
<a href="'.$subd.'/?para'.$bl.'&hl">Paraphrase Editor</a><p></p>
<a href="'.$subd.'/?mypage=1'.$bl.'">MyPage</a><p></p>
<a href="/?topic'.$bl.'">'.$l_m5.'</a><p></p>
<a href="/?mind'.$bl.'">MindMap</a><p></p>
<form action="index.php" method="get">';
require('inc/user_tools.php');
echo'<br><input type="submit" value="'.$l_m3.'"></form><p></p>
<a href="http://Ekklesia.mobi">Ekklesia</a>';

if(!empty($referer)and!isset($fp)and!isset($didback)){$didback=1;echo'<p><a href="'.$referer.'">Back</a></p>';}
if($uid==1){echo NN.NN.'<a href="/?alv'.$bl.$bookli.'">Latest Visitors</a>';}
?>