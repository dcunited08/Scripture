<?php # licence: gpl-signature.txt
if(isset($no_mobile)){echo'<u>Color Picker</u><br>
R<input id="red" size="5">  G<input id="grn" size="5">  B<input id="blu" size="5">  - - -
H<input id="hue" size="5">  S<input id="sat" size="5">  V<input id="val" size="5">
<p>Choose any color: <input class="color{hash:true,required:false}" id="myColor" onchange="
	document.getElementById(\'red\').value = this.color.rgb[0]*100 + \'%\';
	document.getElementById(\'grn\').value = this.color.rgb[1]*100 + \'%\';
	document.getElementById(\'blu\').value = this.color.rgb[2]*100 + \'%\';
	document.getElementById(\'hue\').value = this.color.hsv[0]* 60 + \'&deg;\';
	document.getElementById(\'sat\').value = this.color.hsv[1]*100 + \'%\';
	document.getElementById(\'val\').value = this.color.hsv[2]*100 + \'%\';"></p>';}
    if(($_POST['s']=='Go')or($_POST['s']=='Copy')){
        $sqe=mysql_query_s('SELECT * FROM bible_themes where tid='.$_POST['edtheme']);
        $edti=mysql_result($sqe,0,'tid');$edt=mysql_result($sqe,0,'theme');
        $edtm=mysql_result($sqe,0,'mode');$edtf=mysql_result($sqe,0,'font');
        $edtfs=mysql_result($sqe,0,'fontsize');$edtfb=mysql_result($sqe,0,'fontbackground');
        $edtfh=mysql_result($sqe,0,'versehighlightcolor');$edtfc=mysql_result($sqe,0,'fontcolor');
        $edtvlc=mysql_result($sqe,0,'visitedlinkcolor');$edtalc=mysql_result($sqe,0,'activelinkcolor');$edtlc=mysql_result($sqe,0,'linkcolor');$edtlh=mysql_result($sqe,0,'lhover');
        $edtldis=mysql_result($sqe,0,'ldisp');$edtlba=mysql_result($sqe,0,'lback');$edtlwe=mysql_result($sqe,0,'lfweight');
        $icol=mysql_result($sqe,0,'icol');$idisp=mysql_result($sqe,0,'idisp');$iback=mysql_result($sqe,0,'iback');
        $ucol=mysql_result($sqe,0,'ucol');$hcol=mysql_result($sqe,0,'hcol');$gcol=mysql_result($sqe,0,'gcol');
        $gdec=mysql_result($sqe,0,'gdec');$gback=mysql_result($sqe,0,'gback');$scol=mysql_result($sqe,0,'scol');
        $boardcol=mysql_result($sqe,0,'boardcol');$divback=mysql_result($sqe,0,'divback');$ufp=mysql_result($sqe,0,'ufp');
        $tableback=mysql_result($sqe,0,'tableback');$alfp=mysql_result($sqe,0,'alfp');
	$bmcol=mysql_result($sqe,0,'bmcol');$favcol=mysql_result($sqe,0,'favcol');$notcol=mysql_result($sqe,0,'notcol');
        if($_POST['s']=='Go'){$doed='<input type="hidden" name="doed" value="'.$edti.'">';}
    }
    if(empty($edti)){$edti=$_POST['edtheme'];}
    echo'<u>Theme editor:</u>';
    $r=mysql_query_s('SELECT theme,tid,uid FROM bible_themes where (uid=1 AND mode=2)or(uid='.$uid.')');
    $num2=mysql_numrows($r);
    echo '<form action="index.php?mydata=settings&tea" method="post" enctype="multipart/form-data">'.$doed.
    '</select><select name="edtheme" style="width:130"><option value="">Edit Theme</option>';
        $r=mysql_query_s('SELECT theme,tid,uid FROM bible_themes where (uid=1 AND mode=2)or(uid='.$uid.')');
        $num2=mysql_numrows($r);
        for($i=0;$i<$num2; ++$i){
          $sqmid=mysql_result($r,$i,'tid');
          if($edti===$sqmid){$sel=' selected  ';}
          elseif(!empty($sel)){unset($sel);}
          echo "<option value='$sqmid'$sel>".$sqmid.' '.mysql_result($r,$i,'uid').'_'.mysql_result($r,$i,'theme').'</option>';
        }
    echo'</select><input type="submit" Name="s" value="Go"><input type="submit" Name="s" value="Copy"><br>

        Theme Name <input type="text" name="t_name" value="'.$edt.'" size="11">
        <input type="hidden" name="tools" value="1">
        <input type="hidden" name="mydata" value="settings">
        <input type="hidden" name="formcalltheme" value="1">';
    if($edtm !== '2'){$selmode=' selected  ';}
    if($uid==='1'){echo'<select name="globalmode" style="width:70"><option value="2">Global(Default Yes)</option><option value="1"'.$selmode.'>No</option></select>';}
    $r=mysql_query_s('SELECT name FROM bible_fonts where type=\'general\' ORDER BY name ASC');
    $num2=mysql_numrows($r);
    echo '<select name="v_pfont" style="width:50"><option value=""><u>Font</u></option>';
    for($i=0;$i<$num2; ++$i){
        $sqbook=mysql_result($r,$i,'name');
        if($edtf===$sqbook){$sel=' selected  ';}
        elseif(!empty($sel)){unset($sel);}
        echo "<option value='$sqbook'$sel>$sqbook</option>";
    }
    echo'</select>';
    $r=mysql_query_s('SELECT name FROM bible_fonts where type=\'iphone\' ORDER BY name ASC');
    $num2=mysql_numrows($r);
    echo '<select name="v_pfontip" style="width:70"><option value=""><u>Font iphone</u></option>';
    for($i=0;$i<$num2; ++$i){
        $sqbook=mysql_result($r,$i,'name');
        if($edtf===$sqbook){$sel=' selected  ';}
        elseif(!empty($sel)){unset($sel);}
        echo "<option value='$sqbook'$sel>$sqbook</option>";
    }
    echo'</select>'.
        ' Background <input type="text" class="color{hash:true,required:false}" name="v_pfcolb" value="'.$edtfb.'" size="5">  Font: Color <input type="text" class="color{hash:true,required:false}" name="v_pfcol" value="'.$edtfc.'" size="5"> Highlight <input type="text" class="color{hash:true,required:false}" name="v_pfcolh" value="'.$edtfh.'" size="5"> Size <input type="text" name="v_pfsz" value="'.$edtfs.'" size="1">%<br>
        Link Color: <input type="text" class="color{hash:true,required:false}" name="l_col" value="'.$edtlc.'" size="5"> Visited <input type="text" class="color{hash:true,required:false}" name="vl_col" value="'.$edtvlc.'" size="5"> Active <input type="text" class="color{hash:true,required:false}" name="al_col" value="'.$edtalc.'" size="5"> Hover <input type="text" class="color{hash:true,required:false}" name="alh_col" value="'.$edtlh.'" size="5"> Background <input type="text" class="color{hash:true,required:false}" name="al_back" value="'.$edtlba.'" size="5"><br>
        Link Display <input type="text" name="al_disp" value="'.$edtldis.'" size="5"> Weight <input type="text" name="lfweight" value="'.$edtlwe.'" size="5"><br>

        Menu Display <input type="text" name="idisp" value="'.$idisp.'" size="5"> Color <input type="text" class="color{hash:true,required:false}" name="icol" value="'.$icol.'" size="5"> Background <input type="text" class="color{hash:true,required:false}" name="iback" value="'.$iback.'" size="5"><br>
        Go Declaration <input type="text" name="gdec" value="'.$gdec.'" size="5"> Color <input type="text" class="color{hash:true,required:false}" name="gcol" value="'.$gcol.'" size="5"> Background <input type="text" class="color{hash:true,required:false}" name="gback" value="'.$gback.'" size="5"><br>
        Underline Color <input type="text" class="color{hash:true,required:false}" name="ucol" value="'.$ucol.'" size="5"> Horizontal line color <input type="text" class="color{hash:true,required:false}" name="hcol" value="'.$hcol.'" size="5">Small text color:  <input type="text" class="color{hash:true,required:false}" name="scol" value="'.$scol.'" size="5"><br>
        Frontpage Specific Colors(under construction): Underline Background: <input type="text" class="color{hash:true,required:false}" name="ufp" value="'.$ufp.'" size="5"> Boarder color <input type="text" class="color{hash:true,required:false}" name="boardcol" value="'.$boardcol.'" size="5"> Div Background <input type="text" class="color{hash:true,required:false}" name="divback" value="'.$divback.'" size="5"> Table Background <input type="text" class="color{hash:true,required:false}" name="tableback" value="'.$tableback.'" size="5"> Active Link <input type="text" class="color{hash:true,required:false}" name="alfp" value="'.$alfp.'" size="5"><br>
        Bookmark color: <input type="text" class="color{hash:true,required:false}" name="bmcol" value="'.$bmcol.'" size="5"> Favorites: <input type="text" class="color{hash:true,required:false}" name="favcol" value="'.$favcol.'" size="5"> Notes: <input type="text" class="color{hash:true,required:false}" name="notcol" value="'.$notcol.'" size="5"> xRefs: <input type="text" class="color{hash:true,required:false}" name="xrefcol" value="'.$xrefcol.'" size="5"> topics: <input type="text" class="color{hash:true,required:false}" name="tocol" value="'.$tocol.'" size="5"><br>
        <input type="submit" Name="s" value="Save Theme"></form>'; //Example "5" "white" "gold" "yellow" //bmcol favcol notcol
    if(isset($_POST['formcalltheme'])and($_POST['s']!='Go')){
        $t_name=$_POST['t_name'];$globalmode=$_POST['globalmode'];
        $v_pfont=$_POST['v_pfont'];$v_pfont=$_POST['v_pfontip'];
        $v_pfsz=$_POST['v_pfsz'];$v_pfcol=$_POST['v_pfcol'];
        $v_pfcolb=$_POST['v_pfcolb'];$v_pfcolh=$_POST['v_pfcolh'];
        $l_col=$_POST['l_col'];$vl_col=$_POST['vl_col'];
        $al_col=$_POST['al_col'];$doed=$_POST['doed'];$scol=$_POST['scol'];
        $icol=$_POST['icol'];$idisp=$_POST['idisp'];$iback=$_POST['iback'];$ucol=$_POST['ucol'];$hcol=$_POST['hcol'];$gcol=$_POST['gcol'];
        $gdec=$_POST['gdec'];$gback=$_POST['gback'];$al_col=$_POST['al_col'];$doed=$_POST['doed']; //
        $alh_col=$_POST['alh_col'];$al_disp=$_POST['al_disp'];$al_back=$_POST['al_back'];$lfweight=$_POST['lfweight'];
        $boardcol=$_POST['boardcol']; $divback=$_POST['divback']; $ufp=$_POST['ufp'];$tableback=$_POST['tableback'];$alfp=$_POST['alfp'];
	$bmcol=$_POST['bmcol']; $favcol=$_POST['favcol']; $notcol=$_POST['notcol']; $xrefcol=$_POST['xrefcol']; $tocol=$_POST['tocol'];
        if(!empty($doed)){$sqe=mysql_query_s('SELECT uid FROM bible_themes where tid='.$doed);$edti=mysql_result($sqe,0,'uid');} // icol idisp iback ucol hcol gcol gdec gback
        if(!empty($doed) and (($edti===$uid)or($uid==1))){$sql='UPDATE bible_themes SET gen=0,genfp=0,theme=\''.$t_name.'\',mode=\''.$globalmode.'\',fontcolor=\''.$v_pfcol.'\',fontbackground=\''.$v_pfcolb.'\',fontsize=\''.$v_pfsz.'\',versehighlightcolor=\''.$v_pfcolh.'\',font=\''.$v_pfont.'\',linkcolor=\''.$l_col.'\',visitedlinkcolor=\''.$vl_col.'\',activelinkcolor=\''.$al_colh.'\',lhover=\''.$alh_col.'\',ldisp=\''.$al_disp.'\',lback=\''.$al_back.'\',lfweight=\''.$lfweight.'\',icol=\''.$icol.'\',idisp=\''.$idisp.'\',iback=\''.$iback.'\',ucol=\''.$ucol.'\',hcol=\''.$hcol.'\',gcol=\''.$gcol.'\',gdec=\''.$gdec.'\',gback=\''.$gback.'\',scol=\''.$scol.'\',boardcol=\''.$boardcol.'\',divback=\''.$divback.'\',ufp=\''.$ufp.'\',tableback=\''.$tableback.'\',alfp=\''.$alfp.'\',bmcol=\''.$bmcol.'\',notcol=\''.$notcol.'\',favcol=\''.$favcol.'\',xrefcol=\''.$xrefcol.'\',tocol=\''.$tocol.'\' WHERE bible_themes.tid='.$doed;}
        else{$sql='INSERT INTO bible_themes (tid,theme,mode,uid,fontcolor,fontbackground,fontsize,versehighlightcolor,font,linkcolor,visitedlinkcolor,activelinkcolor,lhover,ldisp,lback,lfweight,icol,idisp,iback,ucol,hcol,gcol,gdec,gback,scol,boardcol,divback,ufp,tableback,alfp,bmcol,favcol,notcol,xrefcol,tocol)
            VALUES (NULL,\''.$t_name.'\',\''.$globalmode.'\','.$uid.',\''.$v_pfcol.'\',\''.$v_pfcolb.'\',\''.$v_pfsz.'\',\''.$v_pfcolh.'\',\''.$v_pfont.'\',\''.$l_col.'\',\''.$vl_col.'\',\''.$al_colh.'\',\''.$alh_col.'\',\''.$al_disp.'\',\''.$al_back.'\',\''.$lfweight.'\',\''.$icol.'\',\''.$idisp.'\',\''.$iback.'\',\''.$ucol.'\',\''.$hcol.'\',\''.$gcol.'\',\''.$gdec.'\',\''.$gback.'\',\''.$scol.'\',\''.$boardcol.'\',\''.$divback.'\',\''.$ufp.'\',\''.$tableback.'\',\''.$alfp.'\',\''.$bmcol.'\',\''.$favcol.'\',\''.$notcol.'\',\''.$xrefcol.'\',\''.$tocol.'\');';}
        if(!empty($t_name)){if($u != 'demo'){$upup=mysql_query_s($sql);echo'Theme saved '.N;}else{echo'Please login to set settings'.NN;}}
        elseif($_POST['s']!='Copy'){echo'Theme Name is a required field';}
    }
?>