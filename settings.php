<?php # licence: gpl-signature.txt
if(isset($_GET['tea'])){echo'<a href="'.$subd.'?mydata=settings'.$bl.$bookli.'">Back to settings</a> | ';}
else{echo'<a href="/?tools=1&mydata=settings&tea">Theme Editor</a> | ';}
if($uid==1){echo'<a href="/?edf">File Editor</a> | ';}
if($l=='n'){require('inc/Languages/Menu_Norwegian.php');}
else{require('inc/Languages/Menu_English.php');}
echo'<a href="'.$subd.'?mydata=1'.$bl.$bookli.'">'.$l_m10.'</a>'.NN;
$r1=mysql_query_s('SELECT title,mid FROM '.$database.'.bible_super_dial where (uid=1 AND global=1)or(uid='.$uid.')');$n1=mysql_numrows($r1);
$r2=mysql_query_s('SELECT * FROM '.$database.'.bible_list'.$nosuper.' ORDER BY bid ASC');$n2=mysql_numrows($r2);
  if(!isset($_POST['formcallglob'])and!isset($_POST['regroup'])and!isset($_POST['rename'])and!isset($_GET['tea'])){
    echo'<u>Personal settings</u><br>
        <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="tools" value="1">
        <input type="hidden" name="mydata" value="settings">
        <input type="hidden" name="formcall" value="1">';
    $r=mysql_query_s('SELECT theme,tid FROM '.$database.'.bible_themes where (uid=1 AND mode=2)or(uid='.$uid.')');
    $num2=mysql_numrows($r);
    echo '<form action="index.php" method="post" enctype="multipart/form-data">'.$doed.
    '</select><select name="theme" style="width:130"><option value="">Change Theme</option>';
    for($i=0;$i<$num2; ++$i){
        $sqbook=mysql_result($r,$i,'theme');
        $sqmid=mysql_result($r,$i,'tid');
        if($edti===$sqmid){$sel=' selected  ';}
        elseif(!empty($sel)){unset($sel);}
        echo "<option value='$sqmid'$sel>$sqbook</option>";
    }
    echo'</select><select name="v_verse" style="width:105"><option value=""><u>Verse display</u></option><option value="1">Mat 28:20</option>
            <option value="2">28:20</option><option value="3">*</option><option value="4">Default(20)</option></select>

        <select name="v_dmode" style="width:105"><option value=""><u>Verse Modes</u></option><option value="1">Compact</option>
            <option value="2">Extra Spaced</option><option value="3">Default(Spaced)</option></select>

        <select name="d_strongs" style="width:108"><option value=""><u>Strong display</u></option><option value="1">List boxes</option>
            <option value="2">Tooltip</option><option value="3">Default(as link)</option></select>
            
        <select name="fp" style="width:100"><option value=""><u>Front Page</u></option><option value="1">Default(Mobile Navigation)</option>
            <option value="2">Latest Threads</option><option value="3">Combination</option></select>

        <select name="menty" style="width:100"><option value=""><u>Menu Type</u></option><option value="1">Default(Determined)</option>
            <option value="2">Table</option><option value="3">CSS</option><option value="4">Plain</option></select>
            Default Hebrew Font';
            
$r=mysql_query('SELECT name FROM bible_fonts where type=\'general\' ORDER BY name ASC');
    $num2=mysql_numrows($r);
    echo '<select name="v_phfont" style="width:50"><option value=""><u>Font</u></option>';
    for($i=0;$i<$num2; ++$i){
        $sqbook=mysql_result($r,$i,'name');
        if($edtf===$sqbook){$sel=' selected  ';}
        elseif(!empty($sel)){unset($sel);}
        echo "<option value='$sqbook'$sel>$sqbook</option>";
    }
    echo'</select>';
      echo'<br>Hide Bibles from list:<input type="text" name="hide" value="'.$mysettings[22].'" size="50">[id of bible] (multiple seperate by comma) example: 1,4<br>

        <br>Sources:
        <select name="d_xrefs" style="width:99"><option value=""><u>Xrefs</u></option><option value="1">Groups,Server,Public</option>
            <option value="2">Groups,Server</option><option value="3">Default(Server)</option></select>

        <select name="d_notes" style="width:105"><option value=""><u>Notes</u></option><option value="1">Groups,Server,Public</option>
            <option value="2">Groups,Server</option><option value="3">Default(Server)</option></select>

        <select name="d_favs" style="width:105"><option value=""><u>Favorites</u></option><option value="1">Groups,Own,Public</option>
            <option value="2">Groups,Own</option><option value="3">Default(Own)</option></select>

        <select name="d_topic" style="width:105"><option value=""><u>Topics</u></option><option value="1">Groups,Own,Public</option>
            <option value="2">Groups,Own</option><option value="3">Default(Own)</option></select>
            
        <select name="ds_strongs" style="width:115"><option value="" selected><u>Strongs</u></option>';
         $r3=mysql_query_s('SELECT * FROM '.$database.'.bible_sn_list');
        $num3=mysql_numrows($r3);
        for($i=0;$i<$num3; ++$i){ 	 	
          $snname=mysql_result($r3,$i,'snname');
          $snid=mysql_result($r3,$i,'snid');
          $lang=mysql_result($r3,$i,'lang');
        echo "<option value='$snid'>$snname ( $lang)</option>";
        }
        echo'<option value="All">All</option></select>
        <select name="d_para" style="width:105"><option value=""><u>Paraphrases</u></option><option value="1">Groups,Own,Public,Server</option>
            <option value="2">Groups,Own,Server</option><option value="3">Default(Own),Server</option></select>
        <br>Share:
        <select name="dp_notes" style="width:77"><option value=""><u>MyNotes</u></option><option value="1">Everyone</option>
            <option value="2">Groups</option><option value="3">Default(None)</option></select>

        <select name="dp_xrefs" style="width:70"><option value=""><u>MyXrefs</u></option><option value="1">Everyone</option>
            <option value="2">Groups</option><option value="3">Default(None)</option></select>

        <select name="dp_favs" style="width:70"><option value=""><u>MyFavs</u></option><option value="1">Everyone</option>
            <option value="2">Groups</option><option value="3">Default(None)</option></select>

        <select name="dp_para" style="width:70"><option value=""><u>MyParaphrases</u></option><option value="1">Everyone</option>
            <option value="2">Groups</option><option value="3">Default(None)</option></select>

        <select name="dp_topic" style="width:70"><option value=""><u>MyTopicMaps</u></option><option value="1">Default(Everyone)</option>
            <option value="2">Groups</option><option value="3">None</option></select> 

        <br><select name="ed" style="width:100"><option value=""><u>Text editor</u></option><option value="1">Default(None)</option>
            <option value="2">Java editor(Tinymce, mobile)</option><option value="3">Java editor(CKeditor, faster)</option></select>

        <select name="ab" style="width:100"><option value=""><u>Audio Bible</u></option><option value="1">Default(On)</option>
            <option value="2">Disabled</option></select>';
        //mid,midc,uid,global,shared,readwrite,title
        echo '<select name="dsd" style="width:130"><option value=""><u>Default SuperDial</u></option>';	//TEMP
        for($i=0;$i<$n1; ++$i){echo '<option value="'.mysql_result($r1,$i,'mid').'">'.mysql_result($r1,$i,'title').'</option>';}
        echo'</select>
        <select name="defscript" style="width:100"><option value="">Default Bible</option>';
        if($uid!=='1'){$nosuper=' WHERE ((global=1 or global is null)or(owner='.$uid.')) ';}
        $toedit=array();$ie=0;
        for($i=0;$i<$n2; ++$i){
            $sqname=mysql_result($r2,$i,'bname');$sqsnid=mysql_result($r2,$i,'bid');
            $sedituids=mysql_result($r2,$i,'edituids');$sowner=mysql_result($r2,$i,'owner');
            if(($uid==1)or($sowner==$uid)or preg_match('/(^'.$uid.'\s)|(\s'.$uid.'\s)|(\s'.$uid.'$)/i',$sedituids)){$toedit[$ie]=$sqsnid;++$ie;}
            echo "<option value='$sqsnid'>$sqsnid $sqname</option>";
        }
        echo'</select>';
        if(!empty($toedit)){
          echo'<br><select name="eb" style="width:100"><option value="">Edit Bible</option><option value="n">None</option>';
          foreach($toedit as $editb){
            echo'<option value="'.$editb.'">'.$editb.'</option>';
          }
          echo'</select>';
        }
        echo'<select name="dialhl" style="width:115"><option value="" selected><u>Headline dial base</u></option>';
         $r4=mysql_query_s('SELECT distinct bid FROM '.$database.'.bible_headlines');
        $num4=mysql_numrows($r4);
        for($i=0;$i<$num4; ++$i){ 	 	
          $hlbid=mysql_result($r4,$i,'bid');
        echo "<option value='$hlbid'>$hlbid</option>";
        }
        echo'</select><select name="paramode" style="width:115"><option value="" selected><u>Paraphrase Level</u></option>';
        for($i=1;$i<4;++$i){echo "<option value='$i'>$i</option>";}
        echo'</select><input type="submit" value="Save"></form>';
            /* List of personal settings
             |   |  | 
            v_verse Verse display | v_dmode Verse Modes | d_strongs Strong display
            d_xrefs  Xref Sources | d_notes Note Sources | ds_strongs Strong Sources
            np_g MyNotes | dp_xrefs MyXrefs | dp_favs MyFavs */
  }
    if (isset($_POST['formcall'])){
        if (!empty($_POST['theme'])){$utheme=$_POST['theme'];$uthemes=" ,theme=$utheme ";}
        //modes
        $p_modes=array();
        if (!empty($_POST['v_verse'])){$p_modes[1]=$_POST['v_verse'];}       //1 v_verse 1 Mat 28:20 2 28:20 3 * 4 Default(20)
        if (!empty($_POST['v_dmode'])){$p_modes[2]=$_POST['v_dmode'];}       //2 Verse Modes v_dmode 1 Compact 2 Extra Spaced 3 Default(Spaced)
        if (!empty($_POST['d_strongs'])){$p_modes[3]=$_POST['d_strongs'];}   //3 Strong display d_strongs 1 List boxes 2 Tooltip 3 Default(as link)
        if (!empty($_POST['d_xrefs'])){$p_modes[4]=$_POST['d_xrefs'];}       //4 Xref Sources d_xrefs 1 Groups,Server,Public  2 Groups,Server  3 default(Server)
        if (!empty($_POST['d_notes'])){$p_modes[5]=$_POST['d_notes'];}       //5 Note Sources d_notes 1 Groups,Server,Public  2 Groups,Server  3 default(Server)
        if (!empty($_POST['ds_strongs'])){$p_modes[6]=$_POST['ds_strongs'];} //6 Strong a=all
        if (!empty($_POST['dp_notes'])){$p_modes[7]=$_POST['dp_notes'];}     //7 MyNotes dp_notes 1 Everyone 2 Groups  3 default(none)
        if (!empty($_POST['dp_xrefs'])){$p_modes[8]=$_POST['dp_xrefs'];}     //8 MyXrefs dp_xrefs 1 Everyone 2 Groups  3 default(none)
        if (!empty($_POST['dp_favs'])){$p_modes[9]=$_POST['dp_favs'];}       //9 MyFavs dp_favs 1 Everyone 2 Groups  3 default(none)
        if (!empty($_POST['ed'])){$p_modes[10]=$_POST['ed'];}               //10 Editor 1 None 2 Java editor
        if (!empty($_POST['fp'])){$p_modes[11]=$_POST['fp'];}               //11 Frontpage 1 Mobile navigation 2 Latest threads 3 combination
        if (!empty($_POST['dsd'])){$p_modes[12]=$_POST['dsd'];}             //12 Default Super Dial
        if (!empty($_POST['defscript'])){$p_modes[13]=$_POST['defscript'];} //13 Default Bible
        if (!empty($_POST['ab'])){$p_modes[14]=$_POST['ab'];}               //14 Audio bible <2 on, 2=off
        if (!empty($_POST['d_favs'])){$p_modes[15]=$_POST['d_favs'];}       //15 Favs Sources d_favs 1 Groups,Own,Public  2 Groups,Own  3 default(Own)
        if (!empty($_POST['eb'])){$p_modes[16]=$_POST['eb'];}               //16 Edit Bible(If owner or added as edit-user).
        if (!empty($_POST['dialhl'])){$p_modes[17]=$_POST['dialhl'];}       //17 Headline dial bible base
        if (!empty($_POST['menty'])){$p_modes[18]=$_POST['menty'];}         //18 Menu type 1 table,2 css,3 plain
        if (!empty($_POST['d_para'])){$p_modes[19]=$_POST['d_para'];}       //19 Paraphrase Sources 1 Groups,Own,Public,Server 2 Groups,Own,Server 3 Default(Own),Server
        if (!empty($_POST['dp_para'])){$p_modes[20]=$_POST['dp_para'];}     //20 Paraphrase Shares 1 Everyone 2 Groups 3 Default(None)
        if (!empty($_POST['paramode'])){$p_modes[21]=$_POST['paramode'];}   //21 Paraphrase Level 1, 2, 3
        if (!empty($_POST['hide'])){$p_modes[22]=str_replace(' ',"",$_POST['hide']);} //22 Hide Bibles
        if (!empty($_POST['dp_topic'])){$p_modes[23]=$_POST['dp_topic'];}   //22 MyTopicMaps dp_topic 1 Everyone(Default), 2 Groups, 3 None
        if (!empty($_POST['d_topic'])){$p_modes[24]=$_POST['d_topic'];}     //23 Topic Sources 1 Groups,Own,Public,Server 2 Groups,Own,Server 3 Default(Own),Server

        if (!empty($_POST['v_phfont'])){$sethebfont=',hebfont=\''.$_POST['v_phfont'].'\'';}
        $setsettings="";
        
        if($p_modes[7]==='1'){mysql_query_s("UPDATE $database.bible_notes SET mode=3 WHERE (user='$u' or uid='$uid');");} //share personal notes
        elseif(!empty($p_modes[7])){mysql_query_s("UPDATE $database.bible_notes SET mode=2 WHERE (user='$u' or uid='$uid');");}
        
        if($p_modes[8]==='1'){mysql_query_s("UPDATE $database.bible_xrefs SET mode=3 WHERE (user='$u' or uid='$uid');");} //share personal crossreferences
        elseif(!empty($p_modes[8])){mysql_query_s("UPDATE $database.bible_xrefs SET mode=2 WHERE (user='$u' or uid='$uid');");}
        
        if($p_modes[9]==='1'){mysql_query_s("UPDATE $database.bible_favorites SET mode=3 WHERE (user='$u' or uid='$uid');");} //share personal favorites
        elseif(!empty($p_modes[9])){mysql_query_s("UPDATE $database.bible_favorites SET mode=2 WHERE user='$u';");}
        
        if(!empty($p_modes[23])){mysql_query_s("UPDATE $database.bible_super_dial_context SET mode=".$p_modes[23]." WHERE uid='$uid';);
                                           UPDATE bible_super_dial SET mode=".$p_modes[23]." WHERE uid='$uid';");} //share personal topic maps
        
        $result8=mysql_query_s('SELECT * FROM '.$database.'.bible_user_settings WHERE user_id='.$uid);
        $sqlnote=mysql_result($result8,'0','settings');$sqlnote2=mysql_result($result8,'0','user_id');$sqlnote=explode('_',$sqlnote);
        $setsettings="";
        for($i=1;$i<28; ++$i){
            if(!empty($sqlnote[$i]) && empty($p_modes[$i])){$p_modes[$i]=$sqlnote[$i];}
            $setsettings .= '_'.$p_modes[$i];
        }
        if ($u != 'demo'){
            if (!empty($sqlnote2)){
                $setsettings = " ,settings='$setsettings'$uthemes";
                mysql_query_s("UPDATE $database.bible_user_settings SET user_id=$uid $setsettings $sethebfont WHERE user_id=$uid;");
            } else { mysql_query_s("INSERT INTO $database.bible_user_settings (user_id,lasturl,lastip,settings,theme,hebfont)
                    VALUES ('$uid','','".$remoteaddr."','$setsettings','$utheme','".$_POST['v_phfont']."');");
            }
            echo'Settings Saved'.NN;
        } else { echo'Please login to set settings'.NN;}
    }
    
    if (($uid == '1')and!isset($_GET['tea'])){
        if (isset($_POST['formcallglob'])){//setting default settings node: not yet made for various browser languages
            $r=mysql_query_s('SELECT * FROM '.$database.'.bible_settings WHERE setting=1;');// lang = '3', settings = '11' //no use yet
            $sqcheck=mysql_result($r,0,'strong');
            if (empty($sqcheck)){$sqcheck2='1';} else {$sqcheck2=$sqcheck;}
            $sqcheck2="strong='$sqcheck2'";
            if (!empty($_POST['defstrong'])){$defstrong=$_POST['defstrong'];$defstrongs="strong='$defstrong' ";}
            else {$defstrongs=$sqcheck2;$defstrong=$sqcheck;}
            if (!empty($_POST['defscript'])){$defscript=$_POST['defscript'];$defscripts=" ,bible='$defscript' ";}
            if (!empty($_POST['dsd'])){$defdsd=$_POST['dsd'];$defdsds=" ,defaultsuper='$defdsd' ";}
            if (!empty($_POST['glth'])){$glth=$_POST['glth'];$glths=" ,theme='$glth' ";}
            // unused by mysqldo_update: setting = '2',
            $mysqldo='INSERT INTO '.$database.".bible_settings (setting,strong,bible,defaultsuper,theme) VALUES ('','$defstrong','$defscript','$defdsd',$glth)";
            $mysqldo_update = 'UPDATE '.$database.".bible_settings SET $defstrongs$defscripts$v_pfcols$v_pfcolbs$v_pfszs$v_pfcolhs$v_pfonts$defdsds$glths WHERE bible_settings.setting = '1';";
            if(empty($sqcheck)){mysql_query_s($mysqldo);}
            else{mysql_query_s($mysqldo_update);}
            echo'Settings Saved'.N.$mysqldo_update.N;
        }
        elseif (isset($_POST['regroup'])){
            mysql_query_s('UPDATE '.$database.'.bible_list SET bid='.$_POST['nb'].' WHERE bid='.$_POST['cb'].';');
            mysql_query_s('UPDATE '.$database.'.bible_context SET bid='.$_POST['nb'].' WHERE bid='.$_POST['cb'].';');
            mysql_query_s('UPDATE '.$database.'.bible_book_name SET bid='.$_POST['nb'].' WHERE bid='.$_POST['cb'].';');
            mysql_query_s('ALTER TABLE '.$database.'.bible_list AUTO_INCREMENT='.($n2 + 2).';');
        }
        elseif (isset($_POST['rename'])){
          if(!empty($_POST['headgen'])){
            echo'...headgen...';
            $r4=mysql_query_s('SELECT * FROM '.$database.'.bible_headlines where bid='.$_POST['headgen']);
            $dotb=$_POST['cb'];
             $n4=mysql_numrows($r4);
             for($i=0;$i<$n4;++$i){
              $shv=mysql_result($r4,$i,'verse');
              $shc=mysql_result($r4,$i,'chap');
              $shb=mysql_result($r4,$i,'book');
              $sht=mysql_result($r4,$i,'title');
              $hdcon=mysql_result(mysql_query_s('SELECT context FROM '.$database.'.bible_context where bid='.$dotb.' and book='."'$shb' and chapter='$shc' and verse=$shv;"),0,'context');
              $squp='update '.$database.'.bible_context set context=\''.stripslashes('['.$sht.'] '.$hdcon).'\' where bid='.$dotb.' and book='."'$shb' and chapter=$shc and verse=$shv";
              mysql_query_s($squp);
              if($i<20){echo N.htmlentities($squp);}
             }
          }
          if(!isset($_POST['bsn'])){
            $r=mysql_query_s('SELECT * FROM '.$database.'.bible_list WHERE bid='.$_POST['cb']);$n=mysql_numrows($r);
            // bid bsn bname uids global owner lang serialversion
            $edbid=mysql_result($r,0,'bid');$edbsn=mysql_result($r,0,'bsn');$edbname=mysql_result($r,0,'bname');$eduids=mysql_result($r,0,'uids');
            $edglobal=mysql_result($r,0,'global');$edowner=mysql_result($r,0,'owner');$edlang=mysql_result($r,0,'lang');$edfont=mysql_result($r,0,'font');$edserialversion=mysql_result($r,0,'serialversion');
            $changename='1';
          }else{
            mysql_query_s('UPDATE '.$database.'.bible_list SET bsn=\''.$_POST['bsn'].'\',bname=\''.$_POST['bname'].'\',`global`=\''.$_POST['global'].'\',owner=\''.$_POST['owner'].'\',lang=\''.$_POST['lang'].'\',serialversion=\''.$_POST['serialversion'].'\',font=\''.$_POST['font'].'\' WHERE bid='.$_POST['cb']);
          }
        }
      if(!isset($changename)and!isset($_POST['regroup'])){
        echo N.'<u>Global settings</u><br>
        <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="tools" value="1">
        <input type="hidden" name="mydata" value="settings">
        <input type="hidden" name="formcallglob" value="1">
        
        <select name="v_verse" style=\"width:105\"><option value=""><u>Verse display</u></option><option value="1">Mat 28:20</option>
            <option value="2">28:20</option><option value="3">*</option><option value="4">Default(20)</option></select>
            
        <select name="v_dmode" style=\"width:105\"><option value=""><u>Verse Modes</u></option><option value="1">Compact</option>
            <option value="2">Extra Spaced</option><option value="3">Default(Spaced)</option></select>
            
        <select name="defstrong" style="width:120"><option value="">Default Strong</option>';
        
        $r=mysql_query_s('SELECT * FROM '.$database.'.bible_sn_list ORDER BY snname ASC');$num2=mysql_numrows($r);
        for($i=0;$i<$num2; ++$i){echo'<option value="'.mysql_result($r,$i,'snid').'">'.mysql_result($r,$i,'snname').'</option>';}
        echo '<option value="All">All</option></select><select name="defscript" style="width:100"><option value="">Default Bible</option>';
        for($i=0;$i<$n2; ++$i){
            $sqsnid=mysql_result($r2,$i,'bid');
            echo "<option value='$sqsnid'>$sqsnid ".mysql_result($r2,$i,'bname').'</option>';
        }
        //mid,midc,uid,global,shared,readwrite,title
        echo '</select><select name="dsd" style="width:130"><option value=""><u>Default TopicDial</u></option>';	//TEMP
        for($i=0;$i<$n1; ++$i){echo '<option value="'.mysql_result($r1,$i,'mid').'">'.mysql_result($r2,$i,'bsn').'</option>';}
        echo '</select><select name="glth" style="width:130"><option value="">Default Theme</option>';
        $r=mysql_query_s('SELECT theme,tid,uid FROM '.$database.'.bible_themes where (uid=1 AND mode=2)or(uid='.$uid.')');
        $num2=mysql_numrows($r);
        for($i=0;$i<$num2; ++$i){
          $sqmid=mysql_result($r,$i,'tid');
          if($edti===$sqmid){$sel=' selected  ';}
          elseif(!empty($sel)){unset($sel);}
          echo "<option value='$sqmid'$sel>".$sqmid.' '.mysql_result($r,$i,'uid').'_'.mysql_result($r,$i,'theme').' ['.$sqmid.']</option>';
        }
        echo'</select><input type="submit" value="Set"></form>';
      }
        echo'<br><form action="index.php?mydata=settings" method="post" enctype="multipart/form-data">
        <input type="hidden" name="tools" value="1">
        <input type="hidden" name="mydata" value="settings">
        <input type="hidden" name="regroup" value="1">
        <select name="cb" style="width:140"><option value="">Bible to regroup</option>';
        //<form action="index.php" method="post" enctype="multipart/form-data">'.$doed.'</select>
        $bids="";
        for($i=0;$i<$n2; ++$i){
            $sqsnid=mysql_result($r2,$i,'bid');
            $bids.='_'.$sqsnid.'_';
            echo "<option value='$sqsnid'>$sqsnid ".mysql_result($r2,$i,'bname')."</option>";
        }
        echo'</select><select name="nb"><option value=""></option>';$n2_=($n2+1);
        $maxbid=mysql_result(mysql_query_s('select max(bid) as C from '.$database.'.bible_list'),0,'C')+1;
        for($i=1;$i<=$n2_; ++$i){if(strstr($bids,'_'.$i.'_')==FALSE){echo'<option value="'.$i.'">'.$i.'</option>';}}
        echo'<option value="'.$maxbid.'">'.$maxbid.'</option></select><input type="submit" value="Set"></form><br>
        <form action="index.php?mydata=settings" method="post" enctype="multipart/form-data">
        <input type="hidden" name="tools" value="1">
        <input type="hidden" name="mydata" value="settings">
        <input type="hidden" name="rename" value="1">';
        if(!isset($changename)){
        echo'<select name="cb" style="width:140"><option value="">Bible to edit</option>';
        //<form action="index.php" method="post" enctype="multipart/form-data">'.$doed.'</select>
        for($i=0;$i<$n2;++$i){
            $sqsnid=mysql_result($r2,$i,'bid');
            echo "<option value='$sqsnid'>$sqsnid ".mysql_result($r2,$i,'bname')."</option>";
        }
        echo'</select>';}
        else{// bid bsn bname uids global owner lang serialversion
            echo'<input type="hidden" name="cb" value="'.$edbid.'">
                bsn<input type="text" name="bsn" value="'.$edbsn.'"><br>
                bname<input type="text" name="bname" value="'.$edbname.'"><br>
                uids<input type="text" name="uids" value="'.$eduids.'"><br>
                global<input type="text" name="global" value="'.$edglobal.'"><br>
                owner<input type="text" name="owner" value="'.$edowner.'"><br>
                lang<input type="text" name="lang" value="'.$edlang.'"><br>
                serialversion<input type="text" name="serialversion" value="'.$edserialversion.'"><br>
                font <input type="text" name="font" value="'.$edfont.'"><br>
                <select name="headgen"><option>Insert headline from</option>';
             $r3=mysql_query_s('SELECT distinct bid FROM '.$database.'.bible_headlines ORDER BY bid ASC');
             $n3=mysql_numrows($r3);
             for($i=0;$i<$n3;++$i){
              $sqsnid=mysql_result($r3,$i,'bid');
              echo "<option value='$sqsnid'>$sqsnid</option>";
             }
             
        }
        echo'<input type="hidden" name="bib" value=""><input type="submit" value="Go"></form>';
        
      echo N.'<a href="/?alv'.$bl.$bookli.'">List last 100visitors.</a>'.N;
    }
    if(!isset($_POST['formcallglob'])and!isset($_POST['regroup'])and!isset($_POST['rename'])and isset($_GET['tea'])){require('inc/theme_editor.php');}
# licence: gpl-signature.txt?>