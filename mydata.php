<?php  # licence: gpl-signature.txt
if (($mydata !== '1')and($mydata !== 'settings')) {
 //utf8 encoder 
 function utfencoder($teksten) {
    $characterEncoding = mb_detect_encoding($teksten, 'UTF-8, UTF-16, ISO-8859-1, ISO-8859-15, Windows-1252, ASCII');  
    switch ($characterEncoding) {
      case 'UTF-8': break;      
      case 'ISO-8859-1': $teksten = utf8_encode($teksten); break;
      default: $teksten = mb_convert_encoding($teksten,'UTF-8',$characterEncoding); break;
    } return $teksten;
  } //<- utf8 encoder
}
  if(is_file('mydata/.htaccess')) {$htfile = 'mydata/.htaccess'; unlink($htfile);} // file security v1
  if ($mydata == '1') {
	if($uid==1){
	  ini_set('max_execution_time', '600');
	  ini_set('post_max_size', '40M');
	  ini_set('max_file_uploads', '40M');
	  ini_set('max_input_time', '400');
	}
    ////<input type='hidden' name='b' value='".$ismultib."'> // split (is this really nessesary?)
    echo'<br><u>Upload database content</u><br>
    <form action="?tools=1&mydata=3" method="post" enctype="multipart/form-data">
    <input type="hidden" name="tools" value="1">
    <input type="hidden" name="mydata" value="3">
    File: <input type="file" name="uploaded_file">
    Or url: <input type="text" name="filetoupload"> Tribid: <input type="text" name="bid">';
    if ($uid == '1') {require('inc/RemoteDataFiles.php');}
    echo'<input type="submit" value="Upload">
    </form><a href="'.$_SERVER['PHP_SELF'].'?tools=1&mydata=2'.$bl.'">Download my database content</a>
    <a href="'.$_SERVER['PHP_SELF'].'?mydata=6'.$bl.'">Create New Bible Translation</a>
    <a href="'.$_SERVER['PHP_SELF'].'?mydata=6&addbook=1'.$bl.'">Add book to my translation</a>
    <a href="'.$_SERVER['PHP_SELF'].'?para=1'.$bl.'">My Paraphrases</a>'.NN;
    
    // Updater (checks for updates, and makes them available for automatic update(wanted?))
    if ($uid == '1') {#require('inc/UpdateCheck.php'); //updater deactivated (not under maintenance at the moment)
    echo'<br><u>Remove database content</u><br>
    <form action="?tools=1&mydata=5" method="post" enctype="multipart/form-data">
    <select name="removebible"><option value="">Remove Global Bible</option>';
    $result3=mysql_query_s('SELECT DISTINCT bid FROM '.$database.'.bible_context;');
    $num3=mysql_numrows($result3);
    for($i=0;$i<$num3; ++$i) {
      $sbid=mysql_result($result3,$i,'bid');
      $result4=mysql_query_s("SELECT bsn,bname FROM $database.bible_list WHERE bid='$sbid';");
      $sbsn=mysql_result($result4,0,'bsn');
      $sbname=mysql_result($result4,0,'bname');
      if (empty($sbname)) { $sbname=$sbid; }
      echo'<option value="'.$sbid.'">'.$sbsn.' '.$sbname.'</option>';
    }
    echo '</select><input type="submit" value="Delete">';
    }
  }
  elseif ($mydata == '2'){require('exporters.php');}//backup tools
  elseif ($mydata == '3'){
   if($uid==1){
      ini_set('max_execution_time', '600');
      ini_set('post_max_size', '40M');
      ini_set('max_file_uploads', '40M');
      ini_set('max_input_time', '400');
      }#preg_replace('/([\\]?\')/',"\'",$abc);
      require('importers.php');
  }// content uploader/importer// <- myData database backup/restore and soon also user-settings
  elseif ($mydata == '4') {require('updater.php');}// <- Updater Continued (now downloading,replacing and backing up old files)
  elseif ($mydata == 'settings'){require('settings.php'); }
  elseif ($mydata == '5') {
   if($uid==1) {
    if(!empty($_POST['removebible'])) {
     $delbib=stripslashes($_POST['removebible']);
     mysql_query_s("DELETE FROM $database.bible_list WHERE bid=$delbib;");
     mysql_query_s("DELETE FROM $database.bible_context WHERE bid=$delbib;");
     mysql_query_s("DELETE FROM $database.bible_book_name WHERE bid=$delbib;");
     echo 'Bible '.$delbib.' removed. ';
    }
   }
  }
  elseif ($mydata == '6') {require('inc/userbibletranslation.php');}
  //elseif (($mydata == 'updatedb') && ($uid == '1')) { require('database.php'); }
# licence: gpl-signature.txt?>