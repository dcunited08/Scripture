<?php // licence: gpl-signature.txt
require('../init.php');
if($uid!=='1'){die('Access Denied');}
$dirPath='../ico';//echo '<img src="data:image/png;base64,'.base64_encode(file_get_contents($dirPath.'/'.$file)).'"><br>';
if ($handle = opendir($dirPath)) {
   while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != "..") {
         if (is_dir("$dirPath/$file")) {
            echo "[$file]<br>";
         } else {
            $fn=explode('.',$file);
            $img=base64_encode(file_get_contents($dirPath.'/'.$file));
            mysql_query('INSERT INTO bible_node_ico(name, img)VALUES(\''.$fn[0].'\',\''.$img.'\')ON DUPLICATE KEY UPDATE img=\''.$img.'\';');
         }
      }
   }
   closedir($handle);echo'Image/s Uploaded</body>';
}
?>