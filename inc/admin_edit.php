<?php
if($uid!=1){die('Access denied!');}
echo'<form action="index.php" method="get"><input type="hidden" name="edf" value="1"><select name="main"><option value="">/</option>';
$darr=array();$farr=array();$i=0;$i2=0;
if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if (is_dir($entry) === true){
                $darr[$i]=$entry;++$i;
            }else{
                $farr[$i2]=$entry;++$i2;
            }
        }
    }
    closedir($handle);
}
asort($darr);asort($farr);
foreach($darr as $dpo){echo "<option>DIRECTORY: ".$dpo."</option>";}
foreach($farr as $fpo){echo "<option value=\"$fpo\">FILE: ".$fpo."</option>";}
unset($farr,$darr);$darr=array();$farr=array();$i=0;$i2=0;
echo'</select><select name="inc"><option value="">inc</option>';
if ($handle = opendir('./inc')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if (is_dir($entry) === true){
                $darr[$i]=$entry;++$i;
            }else{
                $farr[$i2]=$entry;++$i2;
            }
        }
    }
    closedir($handle);
}
asort($darr);asort($farr);
foreach($darr as $dpo){echo "<option>DIRECTORY: ".$dpo."</option>";}
foreach($farr as $fpo){echo "<option value=\"$fpo\">FILE: ".$fpo."</option>";}
echo'</select><input type="submit" value="Go"></form>';
if(!empty($_GET['main'])or!empty($_GET['inc'])){
  if(!empty($_GET['main'])){$thef='./'.$_GET['main'];}
  elseif(!empty($_GET['inc'])){$thef='inc/'.$_GET['inc'];}
  echo'<form action="index.php/?edf&sf" method="post">'.$thef.' Opened<br>
  <textarea name="f" id="cp1" class="codepress php" style="width:100%;height:650px;" >';#wrap="off"
  $file_handle=fopen($thef,"r");
  while(!feof($file_handle)) {
   $line = fgets($file_handle);
   echo htmlentities($line);
  }
  fclose($file_handle);
  echo'</textarea><br><input type="submit" value="Save">
  <input type="hidden" name="tf" value="'.$thef.'"></form>';
}
if(isset($_GET['sf'])){
    $fp=fopen($_POST['tf'],'w');
    fwrite($fp,html_entity_decode($_POST['f']));
    fclose($fp);
    echo $_POST['tf'].' Saved'.N;
}
?>