<?php
if(!empty($_POST['p'])and($_POST['p']!=='List All')){$peidg=$_POST['p'];}
else{$paselall=' selected';}
echo'<u>Paraphrase Editor</u><br>
<form action="?para" method="post" enctype="multipart/form-data">';

if(isset($_POST['sw'])and($uid!=='0')){
    $theN_=str_replace('Save ',"",$_POST['sw']);
    $theN__=explode('_',$theN_);
    if(empty($theN__[0])){$theN="";}//group access card  () !) ) !) !(!)!((! )!) !()
    else{$theN=$theN__[0];}
    $theN2=$theN__[1];
    //echo'do "'.$_POST['sw'].'": "'.$_POST["a$theN"].'" theN: "'.$theN.'"'.$theN2;
/*
bible_psem (  wid int(10) NOT NULL,cid int(4),did int(5),w varchar(50),uid int(10),lang int(40),m int(2),
a int(10),b int(10),c int(10),
d int(10),e int(10),f int(10),
g int(10),h int(10),i int(10),j int(10),

<input type="submit" value="save ">
*/
    $r=mysql_query('SELECT * FROM bible_psem_name where uid='.$uid.' AND peid='.$theN2);
    $uidcheck=mysql_result($r,0,'uid');

    if(!empty($uidcheck)){
    $wtc=array('a','b','c','d','e','f','g','h','i','j','w');
    $w_arr=array();
    $wtcl=mysql_result($r,0,'lang');
        foreach($wtc as $cwo){  
            $pwtc=$_POST[$cwo.$theN];
            if(strstr($pwtc,"'")){$pwtc=str_replace("'","\'",$pwtc);}
            if(strstr($pwtc,';')){$pwtc=str_replace(";","\;",$pwtc);}
            if(strstr($pwtc,')')){$pwtc=str_replace(")","\)",$pwtc);}
            if(strstr($pwtc,'.')or strstr($pwtc,':')){if(preg_match('/(www\.)|(http\:)|(\.com)|(\.no)|(\.us)|(\.eu)|(\.ru)|(\.de)|(\.dk)|(\.net)|(\.org)/i',$pwtc)){die('access denied');}}
            $w_arr[$cwo]=mysql_result(mysql_query('SELECT wid FROM bible_psew where w=\''.$pwtc.'\' AND lang='.$wtcl),0,'wid');
            if(empty($w_arr[$cwo])and!empty($pwtc)){
                mysql_query('INSERT INTO bible_psew (wid,w,lang) VALUES '."('','$pwtc','$wtcl');");
                //echo$pwtc.'_'.$w_arr[$cwo].N.$sql.N;
                $w_arr[$cwo]=mysql_result(mysql_query('SELECT wid FROM bible_psew where w='."'$pwtc' AND lang=$wtcl"),0,'wid');
            }//elseif(!empty($pwtc)){echo'found:'.$w_arr[$cwo];}
        }
    }
    if(empty($theN)and!empty($uidcheck)){
        mysql_query('INSERT INTO '.".bible_psem (wid,cid,did,w,uid,lang,m,a,b,c,d,e,f,g,h,i,j) VALUES
                    ('','$theN2','$descid','".$w_arr['w']."','$uid','$wtcl','$psemmode','".$w_arr['a']."','".
                    $w_arr['b']."','".$w_arr['c']."','".$w_arr['d']."','".$w_arr['e']."','".$w_arr['f'].
                    "','".$w_arr['g']."','".$w_arr['h']."','".$w_arr['i']."','".$w_arr['j']."')");
        echo'<br><b>'.$_GET['pn'].' Created</b><br>';
    }elseif(!empty($theN)){
        mysql_query('UPDATE bible_psem SET'." w='".$w_arr['w']."',a='".$w_arr['a']."',b='".$w_arr['b']."',c='".$w_arr['c'].
                    "',d='".$w_arr['d']."',e='".$w_arr['e']."',f='".$w_arr['f']."',g='".$w_arr['g'].
                    "',h='".$w_arr['h']."',i='".$w_arr['i']."',j='".$w_arr['j']."' WHERE wid=$theN");
        echo'<br><b>'.$_GET['pn'].' Updated</b><br>';
        //wid,cid,did,w,uid,lang,m,a,b,c,d,e,f,g,h,i,j,
    }
}elseif($uid!=='0'){
    echo'Only users have access<br>';
}
elseif(isset($_POST['dw'])){
    $theN_=str_replace('Delete ',"",$_POST['dw']);
    $theN__=explode('_',$theN_);
    if(empty($theN__[0])){$theN="";}//group access card  () !) ) !) !(!)!((! )!) !()
    else{$theN=$theN__[0];}
    $theN2=$theN__[1];
    $r=mysql_query('SELECT * FROM bible_psem_name where uid='.$uid.' AND peid='.$theN2);
    $uidcheck=mysql_result($r,0,'uid');

    if(!empty($uidcheck)and!empty($theN)){mysql_query('DELETE FROM bible_psem WHERE wid='.$theN);}
}
/*
bible_psew (
  wid int(10) NOT NULL,
  w varchar(80),
  lang int(6),
*/
echo'Select your list<select name="p">';
$r=mysql_query('SELECT * FROM bible_psem_name where uid='.$uid.' order by name ASC');$num=mysql_numrows($r);
$pedarr=array();
$i=0;while($i<$num){
    $peid=mysql_result($r,$i,'peid');
    $cid=mysql_result($r,$i,'cid');
    $name=mysql_result($r,$i,'name');
    if($peidg===$peid){$pedsel= ' selected';}elseif(isset($pedsel)){unset($pedsel);}
    echo "<option value='$peid' name='$peid'$pedsel>$name</option>";
    $pedarr[$peid]=$name;
    ++$i;
}
/*
 peid int(10) NOT NULL,
  cid int(4),
  name varchar(50),
  m int(2),
  uid int(10),
*/
echo'<option '.$paselall.'>List All</option></select><input type="submit" name="cpn" value="Go">
<table><tr><td>Word</td><td>Level 1</td><td>Level 2</td><td>Level 3</td></tr>';
if(isset($peidg)){$peidgs=' AND cid='.$peidg;}
else{$peidg=$peid;}
$r=mysql_query('SELECT * FROM bible_psem where uid='.$uid.$peidgs);$num=mysql_numrows($r)+1;
//echo$sql.NN;

/*
bible_psem (  wid int(10) NOT NULL,cid int(4),did int(5),w varchar(50),uid int(10),lang int(40),m int(2),
a int(10),b int(10),c int(10),
d int(10),e int(10),f int(10),
g int(10),h int(10),i int(10),j int(10),

<input type="submit" value="save ">
*/
$sqlw='Select * from bible_psew where wid=';
$i=0;while($i<$num){
    $wid=mysql_result($r,$i,'wid');$cid=mysql_result($r,$i,'cid');
    if(empty($cid)){$cid=$peidg;}
    echo '<tr><td>'.$wid.' <input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'w')),0,'w').'" name="w'.$wid.
    '"><br><input type="submit" name="sw" value="Save '.$wid.'_'.$cid.'">
    <input type="submit" name="dw" value="Delete '.$wid.'_'.$cid.'"></td><td><input type="text" value="'.
    mysql_result(mysql_query($sqlw.mysql_result($r,$i,'a')),0,'w').'" name="a'.$wid.'"><input type="text" value="'.
    mysql_result(mysql_query($sqlw.mysql_result($r,$i,'b')),0,'w').
    '" name="b'.$wid.'"><input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'c')),0,'w').
    
    '" name="c'.$wid.'"></td><td><input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'d')),0,'w').
    '" name="d'.$wid.'"><input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'e')),0,'w').
    '" name="e'.$wid.'"><input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'f')),0,'w').
    
    '" name="f'.$wid.'"></td><td><input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'g')),0,'w')
    .'" name="g'.$wid.'"><input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'h')),0,'w').
    '" name="h'.$wid.'"><input type="text" value="'.mysql_result(mysql_query($sqlw.mysql_result($r,$i,'i')),0,'w').'" name="i'.$wid.'"><input type="text" value="'.
    mysql_result(mysql_query($sqlw.mysql_result($r,$i,'j')),0,'w').'" name="j'.$wid.'"></td></tr>';
    ++$i;
}
echo'</tr></table></form>';
if($_GET['para']=='create'){
    echo'<br><u><b>Create Your List</b></u>
    <form action="" method="get" enctype="multipart/form-data">
    <u>Name of list</u><br><input type="text" name="pn">
    <input type="hidden" name="para"><br>
    <u>Select Language</u><br><select name="lang" >';
    $rl=mysql_query('SELECT * FROM bible_la');
    $nl=mysql_numrows($rl);
    $bla=substr(strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']),0,2);
    unset($ct1);
    $i=0;while($i<$nl){
        $bla2=mysql_result($rl,$i,'lc');
        if(empty($ct1)and($bla == $bla2)){$cn1=$i;$ct1=1;$ssc=' selected';}
        elseif(isset($cn1)){$ssc="";}
        echo"<option value='".mysql_result($rl,$i,'lid')."'$ssc>".mysql_result($rl,$i,'la').'</option>';
        ++$i;
    }
    echo'</select><br>
    <input type="submit" value="Create"></form>';
}elseif(isset($_GET['pn'])){
/*
 bible_psem_name (
  peid int(10) NOT NULL,
  cid int(4),
  name varchar(50),
  lang int(40),
  m int(2),
  uid int(10),
 */
    mysql_query('INSERT INTO '.".bible_psem_name (peid,cid,name,lang,m,uid) VALUES ('','','".$_GET['pn']."','".$_GET['lang']."','',$uid)");
    echo'<br><b>'.$_GET['pn'].' Created</b><br>';
}
else{echo' OR <a href="'.$_SERVER['PHP_SELF'].'?para=create'.$bl.'">Create Paraphrase List</a><br>';}

?>