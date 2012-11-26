<?php
# licence: gpl-signature.txt
// Check if a file has been uploaded or url given
//ini_set('upload_max_filesize', '800M');
if(!isset($password)){require('init.php');}

/*function utfencoder($teksten) {
 $characterEncoding = mb_detect_encoding($teksten, 'UTF-8, UTF-16, ISO-8859-1, ISO-8859-15, Windows-1252, ASCII');
 switch ($characterEncoding) {
 case "UTF-8": break;
 case "ISO-8859-1": $teksten = utf8_encode($teksten); break;
 default: $teksten = mb_convert_encoding($teksten,"UTF-8",$characterEncoding); break;
 } return $teksten;
}*/
//phpinfo();
    if(!empty($_FILES['uploaded_file']['name'])) {
        if($_FILES['uploaded_file']['error'] == 0) {
	  $tmpfilename = $_FILES['uploaded_file']['name'];
	  $tmpfile = $_FILES['uploaded_file']['tmp_name'];
	} else { echo'An error accured while the file was being uploaded. Error code: '. intval($_FILES['uploaded_file']['error']); }
    } elseif (!empty($_POST['filetoupload'])) {
      $tmpfile =stripslashes($_POST['filetoupload']);$tmpfilename = $tmpfile;
    } elseif (!empty($_POST['sitetouploadfrom'])) {
      $tmpfile =stripslashes($_POST['sitetouploadfrom']);$tmpfilename = $tmpfile;
    } elseif (!empty($_POST['sitetoupload'])) { // Generator UNDER CONSTRUCTION
      require('generators.php');
    } elseif (!empty($_GET['file'])){$tmpfilename=stripslashes($_GET['file']);require('generators.php');}
      else { echo'Error! No database reference found!'.N.'If you get this error, you might want to try uploading the file to the web directory; and then enter the filename into the url'; }
	/*  // This function may be used to save data in the future to a upload directory, (note) using .htaccess to secure it.
	if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], 'uploads/' . $_FILES['uploaded_file']['name'])) { // Move the file
	  echo("<p>File uploaded successfully!</p>\r\n");
	} else { echo("<p>There was an error moving the file.</p>\r\n"); }
	*/
	if(!empty($_POST['bid'])){$bidt=stripslashes($_POST['bid']);}
      if ($uid==0) {die('Access denied for demo account.');}
      if (!empty($_POST['global'])) { $isglobal = ', global';$isglobal2 = ",'".$_POST['global']."'";$global=stripslashes($_POST['global']); }
      $tmpfilename=str_replace(' ',"",$tmpfilename);
      //$tmpfile=str_replace(' ','',$tmpfile);
      if (!preg_match('/(\.(bc|sn|txt|bw|bpsd|bmap|btc|hsn)($|\s$))/i',$tmpfilename,$fileextension)) {die($fileextension[0].' is an invalid file type for '.$tmpfilename.'<br>');}
      //if (preg_match('/(^http\:)|(^www\.)/i',$tmpfilename)){$tmpfile = $tmpfilename;}
      $filemode = $fileextension[0];
      if ($filemode =='bw') { //bibleworks exports transformer
	$whatsite='bibleworks';$import_mode=$whatsite; require('generators.php');
	if (!empty($tmpfile)) {
	    $a_tmpfilename=explode('.',$tmpfilename);
	    if ($uid !== '1') { $contentuser=$uid; }
	    $mysqldo ="INSERT INTO bible_list (bsn, bname, lang, serialversion,owner$isglobal) VALUES ('".$a_tmpfilename[0]."$contentuser', '".$a_tmpfilename[1]."$contentuser', '".$a_tmpfilename[2]."','','$uid'$isglobal2)";
	    $mysqldo_check = "SELECT * FROM bible_list WHERE bsn='".$a_tmpfilename[0]."$contentuser'";
	    $mysqldo_update = "UPDATE bible_list SET bname = '".$a_tmpfilename[1]."$contentuser' WHERE bsn = '".$a_tmpfilename[0]."$contentuser'";
	    $checkcontent=mysql_query_s($mysqldo_check);
	    $checkcontent=mysql_result($result2,0,'bname');
	    if (!empty($checkcontent)){mysql_query_s($mysqldo_update);}
	    else{mysql_query_s($mysqldo);}
	    $contentmode='bw';
	    $result_bid= mysql_query_s("SELECT bid FROM bible_list WHERE bsn='".$a_tmpfilename[0].$contentuser."'") or die();
	    $row_bid = mysql_fetch_object($result_bid);
	    $bid = $row_bid->bid;
	}
      }
      if(is_readable($tmpfile)){}else{echo$tmpfile.' is not readable<br>';}
      if (preg_match('/(^http\:)|(^www\.)/i',$tmpfilename)) {
	$tmpfilename=preg_replace('/(^www\.)/i','http://www.',$tmpfilename);
	require('inc/RemoteDownload.php');
	$nf='1';
      } else {$countfilel = count(file($tmpfile));$filePointer=fopen($tmpfile,'r');}
      //Need some better fix?
      if($countfilel==1){
	$nf='1'; $lines=file_get_contents($tmpfile);
	$lines=explode("\r",$lines);
	if(count($lines)<2){$lines=file($tmpfile);}
	if(count($lines)<2){$tmpfilename=$tmpfile;require('inc/RemoteDownload.php');}
	else{$countfilel=count($lines);}
      }
      $xrid='1';$xrmode='1';$bkid=1;
      //$tmpfile;
      require('inc/tag_filter.php');unset($bid);
      $personal_dbs = array('bible_xrefs', 'bible_notes', 'bible_favorites', 'bible_bookmarks');
      if (($filePointer!=false)or(isset($nf))){
	$countfilel_perc=round($countfilel);$countfilel_25=round($countfilel_perc * 0.25);$countfilel_50=round($countfilel_perc * 0.5);$countfilel_75=round($countfilel_perc * 0.75);
        //for($i=0;$i<=$countfilel; ++$i) {
	$i=0;while($i<=$countfilel){
	    if($i===$countfilel_25){echo'|||25%';}
	    elseif($i===$countfilel_50){echo'|||50%';}
	    elseif($i===$countfilel_75){echo'|||75%'.N;}
	    if(!empty($fileData)){unset($mysqldo);}
	    if(!isset($nf)){$fileData = fgets($filePointer);} //, 4096
	    else{$fileData=$lines[$i];}
	    if(empty($utf8found)){$fileData = utfencoder($fileData);}
	    if ($uid!=='1') {$fileData = preg_replace($tag_filter,'',$fileData);}
	    //$fileData = htmlentities($fileData,ENT_QUOTES,'UTF-8');
	    //if ($i=='4'){break;}else{echo htmlentities($fileData).N;} //tmp //str_replace('\'','\\\'',$fileData)
	    //$fileData=preg_replace('/([^\\])\'/i','\1\\\'',$fileData);
		$fileData=str_replace('\'','`',$fileData);
		$fileData=preg_replace('/(\r)|(\n)/',"",$fileData);
	    if ($i == '0') {
		  if(substr($fileData, 0,3) == pack('CCC',0xef,0xbb,0xbf)) {
		    $fileData=substr($fileData, 3); //remove byte order marks
		    $utf8found='1';
		    $fileData=str_replace(array('﻿',' '),"",$fileData);
		  }
	    }
		if ((substr_count($fileData, '|') >= 2) and ($countingto !=='xref')) { $data = explode('|',$fileData); }
	    else { $data = explode(' ',$fileData); }
	    if(empty($data[1])){$firstchar=mb_substr($fileData,0,1,'UTF-8');}//echo'_'.htmlentities($firstchar).'_';
	    else{$firstchar=mb_substr($data[0],0,1,'UTF-8');}
            if (empty($countingto)and($firstchar !== '#')and($firstchar !== '*')) {
                $nosepchars = '1';
                $data2 = explode(' ', substr($fileData,0,26));
                if (!empty($data2[1]) or empty($data2[0])) {
		  $firstcharto = substr($countingto,0,1); //check if personal data
                    if(($firstcharto != 'p') && ($countingto != 'xref') && preg_match('/\d\:\d/i',$data2[1])) {
		      $countingto = 'xref'; //this allows import of files with syntax for example "mat 4:3 somedescription some-reference 1:4" to be automatically imported as xref
		    }
                }
		//else { die('file: '.htmlentities($fileData).$i.'error in file'); }
            }
            elseif($firstchar === '*') {
		if(substr($fileData,0,7) == '*pxrefs') {$countdown = '1';$countingto = 'pxrefs';}
		elseif(substr($fileData,0,7) == '*pnotes') {$countdown = '1';$countingto = 'pnotes';}
		elseif(substr($fileData,0,6) == '*pfavs') {$countdown = '1';$countingto = 'pfavs';}
		elseif(substr($fileData,0,8) == '*pbmarks') {$countdown = '1';$countingto = 'pbmarks';}
		elseif(substr($fileData,0,4) == '*HSN') {require('inc/file/importers/hsn.php');}
                elseif (substr($fileData,0,6) == '*Bible') {    //check if bible content file
		    if ($uid != '1') { die('Access Denied to bible database.'); }
                    else { $countdown = '2';$countingto = 'Bible';$contentmode = 'Bible'; }
                }
		 elseif (substr($fileData,0,9) == '*TriBible') {    //check if tri bible content file
		    if ($uid != '1') { die('Access Denied to bible database.'); }
                    else { $countdown = '2';$countingto = 'TriBible';$contentmode = 'TriBible'; }
                }
                elseif ((($contentmode == 'Bible')or($contentmode == 'TriBible')) and substr($fileData,0,8) == '*Chapter') { $countdown = '2';$countingto = 'Chapter'; }
                elseif ((($contentmode == 'Bible')or($contentmode == 'TriBible')) and substr($fileData,0,8) == '*Context') { $countdown = '2';$countingto = 'Context'; }
                elseif (substr($fileData,0,5) == '*xRef') {
		  if ($uid != '1') { die('Access Denied to xrefs database.'); }
		  $countdown = '1';$countingto = 'xref';
		  $xrname = $data[2];
		  $result_xrid = mysql_query_s("select xrid from bible_xrefs_list where xrname='$xrname'") or die();
		  $row_xrid = mysql_fetch_object($result_xrid);
		  $xrid = $row_xrid->xrid;
		  $xrgroup ="";
		  $xrmode = '1';
		}
		elseif (preg_match('/^\*\w\d{1,12}/i',substr($fileData,0,15),$snmatch)) {
		    $countingto = 'snw'; //$stw = substr($snmatch[0],1,14);
		    $stw = trim($snmatch[0],' *');
		    if(isset($stw_tmp)){$writesn='1';}
		    else{$stw_tmp=$stw;}
		}
		elseif(substr($fileData,0,3) == '*SN') {$countdown = '2';$countingto = 'sn';}
		elseif(substr($fileData,0,5) == '*BMAP') {
		    $countdown = '2';$countingto = 'bmap'; unset($mid);
		    $bmap_title=str_replace(array('*bmap ','*BMAP ','*Bmap ','*bmap','*BMAP','*Bmap'),'',$fileData);
		    if (($global == '1')or($uid !='1')) {$shared='1';} //need some update when making shares available for bmaps.
		    $mysqldo_check = "SELECT mid FROM bible_super_dial WHERE uid=$uid AND title='$bmap_title'";
		    $mysqldo_update = $mysqldo_check; // quickfix
		    $mysqldo ="INSERT INTO bible_super_dial (mid,midc,uid,global,shared,readwrite,title) VALUES (NULL, '','$uid','$global','$shared', '','$bmap_title')";
		}
            }
            elseif($firstchar == '#') { $countdown--; }
	    elseif (($countingto=='sn')and!isset($sndataid)) {
	      $data = explode(',', $fileData);$countdown--;
	      $mysqldo_check = 'SELECT snid FROM bible_sn_list WHERE snname=\''.$data[0].'\';';
	      $mysqldo = 'INSERT INTO bible_sn_list (snname, lang) VALUES (\''.$data[0].'\', \''.$data[1].'\');';
	      $mysqldo_update = $mysqldo_check; // quickfix
	    }
	    elseif(!empty($writefsn)){unset($writefsn);}//echo$fileData;
            else {
	      if (($countingto != 'Context') && in_array($countingto,$personal_dbs)) {
		$p_verse_ref = $data[0].' '.$data[1];
		$p_group = $data[2];$p_mode = $data[3];$p_user = $data[4];$p_datetime = $data[5];
		$sum = sizeof($data);
		$subset = array_slice($data, 4, $sum);
                $p_data = implode(' ',$subset);
		if ($p_group == '_') {$p_group ="";} if ($p_mode == '_') {$p_mode ="";} if ($p_user == '_') {$p_user ="";} if ($p_datetime == '_') {$p_datetime ="";}
		//if ($uid != '1') { } // no need yet
		//$mdata_verse.$mdata_favoriteverse.$mdata_bookmark." ".$mdata_group." ".$mdata_mode." ".$u." ".$mdata_datetime." ".$mdata_refs.$mdata_note;
	      }
		if ($countingto == 'pxrefs') {
		  //if ($p_mode == '1') { die("Access denied to global mode on line: ".$countfilel); } // makes users unable to publish their crossreferences
		    if (!empty($p_verse_ref) && !empty($p_data)) {
		     $mysqldo_check = "SELECT id FROM bible_xrefs WHERE verse='$p_verse_ref' AND user='$u'";
		     $mysqldo ="INSERT INTO `bible_xrefs (id, verse,xrid,`group`,mode,user, datetime,refs) VALUES (NULL, '$p_verse_ref','$p_xrid','$p_group','$p_mode', '$u', NOW() ,'$p_data')";
		     $mysqldo_update = "UPDATE bible_xrefs SET xrid = '1',refs = '$p_data' WHERE verse = '$p_verse_ref' AND user='$u'";
		    }
		}
		elseif ($countingto == 'pnotes') {
		    if (!empty($p_verse_ref) && !empty($p_data)) {
		     $mysqldo_check = "SELECT id FROM bible_notes WHERE verse='$p_verse_ref' AND user='$u'";
		     $mysqldo = "INSERT INTO bible_notes (id, verse, `group`, mode , user, datetime,note) VALUES (NULL, '$p_verse_ref', '$p_group', '$p_mode', '$u', NOW() ,'$p_data')";
		     $mysqldo_update = "UPDATE bible_notes SET note = '$p_data' WHERE verse = '$p_verse_ref' AND user='$u'";
		    }
		}
		elseif ($countingto == 'pfavs') {
		    if (!empty($p_verse_ref)) {
		     $mysqldo_check = "SELECT id FROM `bible_favorites` WHERE favoriteverse='$setfavorite' AND user='$u'";
		     $mysqldo_update = $mysqldo_check; //quickfix
		     $mysqldo ="INSERT INTO `bible_favorites` (id, favoriteverse, `group`, mode, user, datetime) VALUES (NULL, '$p_verse_ref', '$p_group', '$p_mode', '$u', NOW())";
		    }
		}
		elseif ($countingto == 'pbmarks') {
		    if (!empty($p_verse_ref)) {
		     $mysqldo_check = "SELECT id FROM bible_bookmarks WHERE bookmark='$p_verse_ref' AND user='$u'";
		     $mysqldo_update = $mysqldo_check; //quickfix
		     $mysqldo = "INSERT INTO bible_bookmarks (id, bookmark, user, datetime) VALUES (NULL, '$p_verse_ref', '$u', NOW())";
		    }
		}
                elseif (($contentmode == 'Bible')or($contentmode == 'bw')) {
		  #require('inc/file/importers/bible.php');
		  if (($countingto == 'Context')or($contentmode == 'bw')) {
if ((!empty($bid) && !empty($data[4])  && !empty($bkid))or(($contentmode == 'bw') and !empty($bid))) {
 $mysqldo ='INSERT INTO bible_context (bid, book, chapter, verse, linemark, mode, context) VALUES ('.$bid.', \''.$data[0].'\', '.$data[1].', '.$data[2].', \''.$data[3].'\',2, \''.$data[4].'\')';
 $mysqldo_check = "SELECT vsid FROM bible_context WHERE bid=$bid AND book='".$data[0]."' AND chapter=".$data[1]." AND verse=".$data[2]."";
 $mysqldo_update = "UPDATE bible_context SET context = '".$data[4]."' WHERE bid=$bid AND book='".$data[0]."' AND chapter=".$data[1]." AND verse=".$data[2]."";
}
}elseif ($countingto == 'Chapter') {
if (!empty($bid) && !empty($data[1])  && !empty($bkid)) {
 $mysqldo ="INSERT INTO bible_book_name (bid, bkid, book, fname, sname, chap) VALUES ($bid, '$bkid', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."')";
 $mysqldo_check = "SELECT book FROM bible_book_name WHERE bid=".$bid."  AND sname='".$data[2]."'";
 $mysqldo_update = "UPDATE bible_book_name SET book = '".$data[0]."' WHERE bid = '$bid' AND sname='".$data[2]."'";
 $bkid++;
}
}elseif ($countingto == 'Bible') {
if (!empty($data[1]) && !empty($data[0])) {
 if(strlen($data[0]) > 6){$datatemp=$data[0];$data[0]=$data[1];$data[1]=$datatemp;}
 if(!empty($bidt)){$bid=$bidt;}
 else{
 $mysqldo ="INSERT INTO bible_list (bsn, bname, lang, serialversion,owner$isglobal) VALUES ('".substr($data[0],0,5)."', '".$data[1]."', '".preg_replace('/(\r)|(\n)/i',"",$data[2])."','','$uid'$isglobal2)";
 $mysqldo_check = "SELECT * FROM bible_list WHERE bsn='".substr($data[0],0,5)."'";
 $mysqldo_update = "UPDATE bible_list SET bsn = '".substr($data[0],0,5)."' WHERE bname = '".$data[1]."'";
 }
 //echo htmlentities($mysqldo);
}
}
		}
		elseif ($contentmode == 'TriBible') {
		  #require('inc/file/importers/tribible.php');
		  if (($countingto == 'Context')or($contentmode == 'bw')) {
if ((!empty($bid) && !empty($data[4])  && !empty($bkid))or(($contentmode == 'bw') and !empty($bid))) {
 $mysqldo ='INSERT INTO bible_tri_context (bid2, bid, bk, c, v, ec, ev, lm, m, tx)
 VALUES ('.$bid.','.$bidt.', \''.$data[0].'\', '.$data[1].', '.$data[2].', '.$data[3].', '.$data[4].', \''.$data[5].'\',2, \''.$data[6].'\')';
 $mysqldo_check = "SELECT vsid FROM bible_tri_context WHERE
 bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
 $mysqldo_update = "UPDATE bible_tri_context SET tx = '".$data[6]."' WHERE
 bid2=$bid AND bk='".$data[0]."' AND c=".$data[1]." AND v=".$data[2]." AND ec=".$data[3]." AND ev=".$data[4]."";
}
}elseif ($countingto == 'Chapter') {
if (!empty($bid) && !empty($data[1])  && !empty($bkid)) {
 $mysqldo ="INSERT INTO bible_tri_book_name (bid2, bkid, book, fname, sname, chap) VALUES ($bid, '$bkid', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."')";
 $mysqldo_check = "SELECT fname FROM bible_tri_book_name WHERE bid2=".$bid." and bkid='$bkid'";
 $mysqldo_update = "UPDATE bible_tri_book_name SET fname = '".$data[1]."' WHERE bid2 = '$bid' AND bkid='$bkid'";
 $bkid++;
}
}elseif (($countingto == 'TriBible')and empty($bid)) {
if (!empty($data[1]) && !empty($data[0])) {
 if(strlen($data[0]) > 6){$datatemp=$data[0];$data[0]=$data[1];$data[1]=$datatemp;}
 $mysqldo ="INSERT INTO bible_tri_list (bid, bsn, bname, lang, serialversion,owner$isglobal) VALUES ($bidt,'".substr($data[0],0,5)."', '".$data[1]."', '".preg_replace('/(\r)|(\n)/i',"",$data[2])."','','$uid'$isglobal2)";
 $mysqldo_check = "SELECT * FROM bible_tri_list WHERE bsn='".substr($data[0],0,5)."'";
 $mysqldo_update = "UPDATE bible_tri_list SET bsn = '".substr($data[0],0,5)."' WHERE bname = '".$data[1]."'";
 //echo htmlentities($mysqldo);
 
 # bible_tri_context (bid2, bid, bk, c, v, ec, ev, lm, m, tx)
 # bible_tri_book_name (bid, bkid, book, fname, sname, chap)
 # bible_tri_list (bsn, bname, lang, serialversion,owner
}
}
		  }
                elseif ($countingto == 'xref') {
                    //if (!empty($nosepchars)) { unset($nosepchars); }
                    //else { $data = $fileData; } //unnessesary
		    $p_verse_ref = $data[0].' '.$data[1];
		    //echo$p_verse_ref.'<br>';
		    $sum = sizeof($data);
		    $subset = array_slice($data, 2, $sum);
                    $t_verse = implode(' ',$subset); // sets xref data
		    if (!empty($t_verse) && !empty($xrid) && !empty($p_verse_ref) && !empty($xrmode)) {
		     $mysqldo ="INSERT INTO bible_xrefs (id,verse,xrid,`group`,mode,user,datetime,refs) VALUES ('', '$p_verse_ref','$xrid','$xrgroup','$xrmode','1', NOW(),'$t_verse')";
		     $mysqldo_check = "SELECT id FROM bible_xrefs WHERE verse='$p_verse_ref' AND mode='$xrmode' AND xrid = '$xrid'";
		     $mysqldo_update = "UPDATE bible_xrefs SET refs = '$t_verse',xrid = '$xrid' WHERE verse = '$p_verse_ref' AND mode='$xrmode'";
		    }
		}
		elseif ($countingto == 'snw') {
		    
		    if (!empty($sndataid)) {
			  if((!empty($writesn))or($i==$countfilel)){
			    if(!empty($stw_tmp)){
				 $mysqldo_check = "SELECT sn FROM bible_strongnumber WHERE sn='".$stw_tmp."' AND snid=$sndataid";
				 $mysqldo = "INSERT INTO bible_strongnumber (snid, sn, content) VALUES ($sndataid, '$stw_tmp', '$fileData_tmp')";
				 //$mysqldo_update = "UPDATE bible_strongnumber SET content = '$fileData_tmp' WHERE snid = $sndataid AND sn='$stw_tmp'";
				 $mysqldo_update=$mysqldo_check; // is a updater needed ?
			    }
			    unset($writesn);
			    $stw_tmp=$stw;$fileData_tmp=$fileData;
			  }
			else{
			    $fileData_tmp.=$fileData;
			    $stw_tmp=$stw;
			  }
		    }
		}
		--$countdown;
            }
	    if (isset($mysqldo)) {
	      #echo $countingto.' '.$mysqldo.'<br>'.$mysqldo_check.'<br>';
	      //echo$mysqldo_check.';'.N;
	      $result_check=mysql_query_s($mysqldo_check);
	      #echo$mysqldo_check.'<br>';
	      $num_check=mysql_numrows($result_check);
	      if ($num_check>=1) {$results_db_up = mysql_query_s($mysqldo_update);}
	      else { mysql_query_s($mysqldo) or die(mysql_error().' line: '.$i.' sql: <br>'.htmlentities($mysqldo).' <br>'.$fileData); }
	      #echo $mysqldo.'<br>';
	    }
	     if (empty($bid)and($countingto == 'Bible')) {
		if(strlen($data[0]) > 6){$tempdata='bname';}else{$tempdata='bsn';}
		$bid=mysql_result(mysql_query_s("SELECT bid FROM bible_list WHERE $tempdata='".substr($data[0],0,5)."' AND lang='".str_replace(' ','',preg_replace('/(\r)|(\n)/i',"",$data[2]))."';"),0,'bid');
		if(!empty($bidt)){$bid=$bidt;$dofast='biblecontext';break;}
	      }
	      elseif (empty($bid)and($countingto == 'TriBible')) {
		if(strlen($data[0]) > 6){$tempdata='bname';}else{$tempdata='bsn';}
		$bid=mysql_result(mysql_query_s("SELECT bid2 FROM bible_tri_list WHERE $tempdata='".substr($data[0],0,5)."' AND lang='".str_replace(' ','',preg_replace('/(\r)|(\n)/i',"",$data[2]))."';"),0,'bid2');
	      }
	      elseif (($countingto == 'bmap')and empty($mid) && !empty($countdown)) {$mid=mysql_result(mysql_query_s("SELECT mid FROM bible_super_dial WHERE title='$bmap_title' AND uid=$uid"),0,'mid');unset($countdown);$dofast='bmap';break;}
	      elseif (($countingto == 'sn')and empty($sndataid)) {
		  if(!empty($result_check)){--$countdown;$sndataid = mysql_result(mysql_query_s($mysqldo_check),0,'snid');}
	      }
	    unset($mysqldo,$mysqldo_check,$mysqldo_update);
	    ++$i;
        }
	if(isset($dofast)){
	  if($dofast=='bmap'){require('inc/importers/bmap.php');}
	  elseif($dofast=='biblecontext'){require('inc/importers/bcontext.php');}
	  
	}
	echo 'File uploaded'.N;
        fclose($filePointer);
    } else { echo'file not found'; }
    //$dbLink->close(); //unused
# licence: gpl-signature.txt?>