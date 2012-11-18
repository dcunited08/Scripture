<?php // licence: gpl-signature.txt
if(!file_exists('mydata')) {mkdir('mydata');chmod('mydata',0755);}
if(!file_exists($htfile)) {fwrite(fopen($htfile, 'a'),"\n");}
      //.htaccess
      $userstamp = ' #%date: '.date("Y-m-d H:i:s").' %user: '.$u;
      $fh = fopen($htfile, 'a+') or die('can\'t open .htaccess');
      $personal_file = $u.'.bpsd';
      //$f_arr = file($htfile); echo fread($fh,count($f_arr));
      fwrite($fh, "\n<FilesMatch \"".$personal_file."$\">".$userstamp."\nOrder deny,allow\nDeny from all\nAllow from ".$remoteaddr."\n</FilesMatch>\n".$userstamp);
      fclose($fh);
      // <- .htaccess
      if (file_exists('mydata/'.$personal_file)) { unlink('mydata/'.$personal_file); }
      $fh = fopen('mydata/'.$personal_file, 'a+') or die('Unable to open target location');
      $personal_dbs = array('bible_xrefs', 'bible_notes', 'bible_favorites', 'bible_bookmarks');
      fwrite($fh, pack('CCC',0xef,0xbb,0xbf)); 
      foreach($personal_dbs as $get_pdb) {
	if	($get_pdb == 'bible_xrefs') {fwrite($fh,"*pxrefs\n#verse 	group 	mode 	user 	datetime 	refs\n");}
	elseif	($get_pdb == 'bible_notes') {fwrite($fh,"*pnotes\n#verse 	group 	mode 	user 	datetime 	note\n");}
	elseif	($get_pdb == 'bible_favorites') {fwrite($fh,"*pfavs\n#pfavverse group 	mode 	user 	datetime\n");}
	elseif	($get_pdb == 'bible_bookmarks') {fwrite($fh,"*pbmarks\n#pbookmark 		user 	datetime\n");}
	$get_psql = 'SELECT * FROM '.$get_pdb.' WHERE user=\''.$u."'"; 
	$result_mydata = mysql_query($get_psql);
	$num_mydata = 	 mysql_numrows($result_mydata);
	for($imd=0;$imd<$num_mydata;$imd++) {
	  $mdata_verse = mysql_result($result_mydata,$imd,'verse');
	  $mdata_group = mysql_result($result_mydata,$imd,'group');
	  $mdata_mode =  mysql_result($result_mydata,$imd,'mode');
	  //$mdata_user = mysql_result($result_mydata,$imd,'user');
	  $mdata_datetime = mysql_result($result_mydata,$imd,'datetime');
	  $mdata_refs	  = mysql_result($result_mydata,$imd,'refs');
	  $mdata_note	  = mysql_result($result_mydata,$imd,'note');
	  $mdata_favoriteverse  = mysql_result($result_mydata,$imd,'favoriteverse');
	  $mdata_bookmark	= mysql_result($result_mydata,$imd,'bookmark');
	  //echo "<br>".$mdata_verse.$mdata_favoriteverse.$mdata_bookmark."<br>";
	  if (empty($mdata_group)) { $mdata_group = '_'; }
	  if (empty($mdata_mode)) { $mdata_mode = '_'; }
	  $pdtw = $mdata_verse.$mdata_favoriteverse.$mdata_bookmark.' '.$mdata_group.' '.$mdata_mode.' '.$u.' '.$mdata_datetime.' '.$mdata_refs.$mdata_note;
	  $pdtw = str_replace(array("\r", "\r\n", "\n"), '/r/n', $pdtw);
	  fwrite($fh,$pdtw."\n");
	}
      }
    fclose($fh);
    echo '<a href=\'mydata/'.$personal_file.'\'>Generation complete, click here to download.</a><br>';
// licence: gpl-signature.txt?>