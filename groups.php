<?php // licence: gpl-signature.txt
if (empty($uid)){require('index.php');}
echo'Under construction<br>';
if (empty($_GET['create']) && empty($_GET['createcat'])) {
    echo '<a href="index.php?groups=3&create=1">Create group</a>';
    if($uid=='1'){ echo ' <a href="index.php?groups=3&createcat=1">Create category</a>'; }
}
elseif (!empty($_GET['create'])) {
    echo'creategroup<form action="index.php?groups=2" method="post" enctype="multipart/form-data">
        <input type="hidden" name="b" value="'.$b.'">
        <input type="hidden" name="s" value="'.$se.'">
        <input type="text" name="groupname"><br>
        <select style="width:150" name="cy"><option selected  value="">Category</option>';
        $fsqlq=mysql_query('SELECT * FROM bible_groups WHERE type = \'gc\'');
        $n=mysql_numrows($fsqlq);
        $i=0;while($i<$n){
            $sgname=mysql_result($fsqlq,$i,'group_name');
            $sgid=mysql_result($fsqlq,$i,'group_id');
            
            echo'<option selected  value="'.urlencode($sgname).'">'.$sgname.'</option><br>';++$i;
        }
        echo'</select><input type="submit" value="Create"></form>';
} //dfkj 
elseif (!empty($_GET['createcat'])) {
    echo'Createcat<form action="index.php?groups=3" method="post" enctype="multipart/form-data">
        <input type="hidden" name="b" value="'.$b.'">
        <input type="hidden" name="s" value="'.$se.'">
        <input type="text" name="groupname"><br>
        <input type="submit" value="Create"></form>';
}
elseif (!empty($_GET['groups']) && ($_GET['groups'] == '2')) {
    $upsql="INSERT INTO bible_groups (group_id,group_name,type,category,founder,group_parent,admins,num_users,users,founded,lastactivity,settings) VALUES
                                            ('',group_name,'g',category,founder,group_parent,admins,num_users,users,founded,lastactivity,settings)";

}
elseif (!empty($_GET['groups']) && ($_GET['groups'] == '3')) {
    $upsql="INSERT INTO bible_groups (group_id,group_name,type,category,founder,group_parent,admins,num_users,users,founded,lastactivity,settings) VALUES
                                            ('',group_name,'gc',category,founder,group_parent,admins,num_users,users,founded,lastactivity,settings)";

}
//if (!empty($upsql)) { $fsqlq=mysql_query($upsql); }
/*
 
 group_id,group_name,type,category,founder,group_parent,admins,num_users,users,founded,lastactivity,settings
 
 founder group_parent admins 
num_users users founded 
lastactivity settings
*/
// licence: gpl-signature.txt?>
