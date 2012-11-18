<?php # licence: gpl-signature.txt
$memory_start_adv=memory_get_usage();$time=explode(' ',microtime());$start_adv=$time[1] + $time[0];
if(empty($password)){require('init.php');echo'<a class="tme" href="'."$subd/?fp$bl&bk=$book".'">Back to Menu</a>';}
if ($uid == '1')  {
      //error_reporting(E_ALL);
      error_reporting(E_ERROR | E_PARSE); // | E_WARNING
}
$bkn=$_GET['bkn'];$bkl=$_GET['bkl'];$advsn=$_GET['advsn'];
$largelist='2';
if(empty($sv)){$sv=strtolower($_GET['sv']);}
if(!empty($_GET['advs'])){$advs=$_GET['advs'];}
if(isset($_GET['advsb'])){$advsb=$_GET['advsb'];}
//else{$advsb=$sr;} //function for future boolean searches
echo '<div><u>Simplified Search</u><form action="index.php" method="get" enctype="multipart/form-data">
<select name="m">
<option value="o" selected>This Order</option>
<option value="t">These Words</option>
<option value="p">Exact Phrase</option>
<option value="b">Begins With</option>
<option value="e">Ends With</option>
<option value="r">Regex</option></select>
<input type="hidden" name="b" value="'.$b.'">
<input type="text" name="advs">
<select name="w">
<option value="w1" selected>Wildcard*</option>
<option value="w2">*Wildcard</option>
<option value="w3">*Wildcard*</option>
<option value="w4">None</option>
</select><br>Not Containing: 
<input type="text" name="advsn" value="'.$advsn.'"> Word1 Word2.. (Wildcard)
<br><select name="wl">';
$i=2;while($i<21){
      if($i==14){$doselect='selected';}
      elseif(isset($doselect)){unset($doselect);}
      echo'<option value="'.$i.'" '.$doselect.'>'.$i.'</option>';
      ++$i;     
}
if(empty($advs)){$advsal=$sr;}
echo'</select>Wildcard Length<br><select name="o">';
$i=0;while($i<18){
      if($i==5){$doselect='selected';}
      elseif(isset($doselect)){unset($doselect);}
      echo'<option value="'.$i.'" '.$doselect.'>'.$i.'</option>';
      ++$i;     
}
if(empty($advs)){$advsal=$sr;}
echo'</select>Optional Words Before Or After<br>Bible: ';
$largelist=1;require('inc/bible_list.php');
echo'<input type="submit" value="Go"><br></form></div>
<form action="advanced_search.php" method="get" enctype="multipart/form-data">
<input type="hidden" name="b" value="'.$b.'"><br>
<div><u>Extended Search</u><br>
Regex: <input type="text" name="advs" value="'.$advs.$advsal.'"> example: (^God) <a href="http://gskinner.com/RegExr">Learn more regex here</a> <a href="http://www.regular-expressions.info/reference.html">And Here</a> <a href="http://txt2re.com">Helpful tool</a><br>
<p>Not Containing: 
<input type="text" name="advsn" value="'.$advsn.'"></p>
<p>Bible:';//Boolean: <input type="text" name="advsb" value="'.$advsb.'">(Under Construction)
$notallbibles='1';
$largelist=1;require('inc/bible_list.php');
echo'</p>Proximity:<br>
Search between <input type="text" name="sv" style="width:60" value="'.$sv.'"> Verses (Default 2 verses; type all for all verses)<br>
Limit Search to <input type="text" style="width:60" value="'.$bkn.'" name="bkn"> Books (default all) After:<select name="bkl" style="width:54">';
if(strstr($b,',')){$bks=' IN(';$bks2=')';}else{$bks='=';}
$rbk=mysql_query_s('SELECT DISTINCT book FROM '.$database.'.bible_book_name WHERE bid'."$bks$b$bks2");
$numrbk=mysql_numrows($rbk);
$i=0;while($i<$numrbk){
  $sqbook=mysql_result($rbk,$i,'book');
  if(strtolower($sqbook)===strtolower($bkl)){$b_num3=$i;$b_name3=$book;$ssbible2=' selected';}elseif(isset($ssbible2)){$ssbible2="";}
  //$b_name2=$sqbook; olduse before </option>
  echo"<option value='$sqbook'$ssbible2>$sqbook</option>";
  ++$i;
}echo'</select><br><input type="submit" value="Go"></form></div>';
if($sv !== 'all'){if(empty($sv)){$sv=2;}}else{$sva='1';}
if(!empty($advsb)){
      $advs=preg_replace(' ','\s',$advsb);
}
if(!empty($advs)){
      echo'<div>';
      require('inc/Languages/Filter_drupal.php');
      if(empty($bkn)){$bkn=65;}
      $token=array_search(strtolower($bkl),$a_shortdrupal);
      $bklimit=' AND book in(';
      $ibk=0;while($ibk<$bkn){
	    $ibktmp=$ibk + $token;
            $ibktmp2=$ibk + 1;
	    if($ibktmp2 < $bkn){$endc=',';}else{unset($endc);}
	    $bklimit.="'".$a_shortdrupal[($ibktmp)]."'".$endc;
	    ++$ibk;
      }$bklimit.=') ';
    $w="";
    $sql='SELECT * FROM '.$database.'.bible_context WHERE bid='.$b.$bklimit.' order by vsid;';
    //echo$sql.N;
    $sql=mysql_query_s($sql);$n=mysql_numrows($sql);
    if(empty($bkl)){$bkl='GEN';}
	echo NN.'Searching for: '.$advs.' ;Between '.$sv.' Lines and '.$bkn.' books after '.$bkl.NN;
        $hlc='<font color="'.$versehighlightcolor.'">';$hlr='</font>';
    $ir=0;$i=0;while($i<$n){
        if(!isset($sva)){
            $ipx=1; $w=mysql_result($sql,$i,'context');
            while($ipx<$sv){
	        $itmp=$i + $ipx;
                $w.=' '.mysql_result($sql,$itmp,'context');
                ++$ipx;
            }
            if(preg_match('/'.$advs.'/i',$w,$match)){
		  $tmpv=mysql_result($sql,$i,'verse');
		  $v=mysql_result($sql,$i,'book').' '.mysql_result($sql,$i,'chapter').':'.$tmpv;
                if($sv > 1){$v.='-'.($tmpv + $sv - 1);}
                if(strlen($w > 500)){$w=substr($w,0,500).'..';}
                ++$ir;
                if($ir>1000){echo'Limit Exceeded; Please Specify Your Search Better.'.NN;break;}
                
                foreach($match as $m){
                  $w=str_replace($m,$hlc.$m.$hlr,$w);
                }
                echo'<a href="index.php?&b='.$b.'&s='.urlencode($v).'">'.$v.'</a> '.$w.N;
            }
        }else{$w.=' '.mysql_result($sql,$i,'context');}
        ++$i;
    }
    if(isset($sva)){
        if(preg_match('/'.$advs.'/i',$w,$match)){
            if(strlen($match[0] > 1000)){$match[0]=substr($match[0],0,1000).'..';}
            echo$match[0];
        }
    }
    $time=explode(' ',microtime());$stop_adv=$time[1] + $time[0];
    $endtime_adv=$stop_adv - $start_adv;
    $memory_tot_adv = memory_get_usage() - $memory_start_adv;
    echo N.$n.' verses with : '.$ir.' results; in time: '.$endtime_adv.'; memory usage: '.$memory_tot_adv.'</div>';
}
?>