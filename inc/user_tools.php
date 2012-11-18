<?php // licence: gpl-signature.txt
		// Bookmark list
		$r=mysql_query('SELECT bookmark,id FROM bible_bookmarks WHERE (user=\''.$u.'\' or uid='.$uid.') ORDER BY id DESC;');
		$num_bk=mysql_numrows($r);
		$i2=$num_bk;
		if($num_bk>0){
		        $i=0;while($i<=$num_bk){
			//for($i=0;$i<$num_bk;++$i) {
				if($i == 0){ echo'<select name="bookmark" style="width:92"><option value="">'.$l_m20.'</option>';$bookmarkset='1';}
				$bookmark=mysql_result($r,$i,'bookmark');
				if(empty($bookmark)){
					if(isset($sql_v2e)){unset($sql_v2e,$sql_b);}
					$sql_v2=mysql_result($r,$i,'v2');if(!empty($sql_v2)){$sql_v2e='-'.$sql_v2;}
					$sql_b=mysql_result($r,$i,'b');
					if(!empty($sql_b)){$bookmark=mysql_result($r,$i,'b').' '.mysql_result($r,$i,'c').':'.mysql_result($r,$i,'v').$sql_v2e;}
				}
				$sql_bookmark_id=mysql_result($r,$i,'id');
				if(!empty($bookmark)){echo"<option value='$bookmark'>".($i2)." $bookmark</option>";$x1='1';}
				--$i2;++$i;
			}
			if (isset($bookmarkset)) { echo'</select><br>'; }
		}
		$r=mysql_query('SELECT * FROM bible_favorites WHERE (user=\''.$u.'\' or uid='.$uid.') ORDER BY id DESC'); // Favorite list
		$num_fav=mysql_numrows($r);
		$i2=$num_fav;
		if($num_fav>0){
		         $i=0;while($i<=$num_fav){
			//for($i=0;$i<$num_fav;++$i){
				if ($i == 0) { echo '<select name="favorite" style="width:79"><option value="">'.$l_m21.'</option>';$favoriteset='1';$x1='1';}
				$sql_favoriteverse=mysql_result($r,$i,'favoriteverse');
				if(empty($sql_favoriteverse)){
					if(isset($sql_v2e)){unset($sql_v2e,$sql_b);}
					$sql_v2=mysql_result($r,$i,'v2');if(!empty($sql_v2)){$sql_v2e='-'.$sql_v2;}
					$sql_b=mysql_result($r,$i,'b');
					if(!empty($sql_b)){$sql_favoriteverse=mysql_result($r,$i,'b').' '.mysql_result($r,$i,'c').':'.mysql_result($r,$i,'v').$sql_v2e;}
				}
				$sql_favorite_id=mysql_result($r,$i,'id');
				if (!empty($sql_favoriteverse)) { echo '<option value="'.$sql_favoriteverse.'">'.($i2)." $sql_favoriteverse".'</option>';}
				--$i2;++$i;
			}
			if (isset($favoriteset)){echo'</select><br>';}
		}
		$r=mysql_query('SELECT * FROM bible_notes WHERE (user=\''.$u.'\' or uid='.$uid.')'); // Note list
		$num_note=mysql_numrows($r);
		$i2=$num_note;
		if($num_note>0){
		        $i=0;while($i<=$num_note){
			//for($i=0;$i<$num_note;++$i){
				if($i == 0){echo '<select name="note" style="width:59"><option value="">'.$l_m22.'</option>';$notesset='1';$x1='1';}
				$sql_note_verse=mysql_result($r,$i,'verse');
				if(empty($sql_note_verse)){
					if(isset($sql_v2e)){unset($sql_v2e,$sql_b);}
					$sql_v2=mysql_result($r,$i,'v2');if(!empty($sql_v2)){$sql_v2e='-'.$sql_v2;}
					$sql_b=mysql_result($r,$i,'b');
					if(!empty($sql_b)){$sql_note_verse=mysql_result($r,$i,'b').' '.mysql_result($r,$i,'c').':'.mysql_result($r,$i,'v').$sql_v2e;}
				}
				$sql_note_id=mysql_result($r,$i,'id');
				if(!empty($sql_note_verse)){echo '<option value="'."$sql_note_verse\">".($i2)." $sql_note_verse</option>";}
				--$i2;++$i;
			}
			if(isset($notesset)){echo'</select>';}
		}
		if($mysettings[15]==='1'){
		  $r=mysql_query('SELECT distinct favoriteverse, id FROM bible_favorites WHERE (user!=\''.$u.'\' AND mode=3) ORDER BY id'); // Favorite list
		  $num_fav=mysql_numrows($r);
		  $i2=$num_fav;
		  if($num_fav>0){
		        $i=0;while($i<=$num_fav){
			//for($i=0;$i<$num_fav;++$i){
				if ($i == 0) { echo '<select name="favorite" style="width:79"><option value="">Global Favorites</option>';$favoriteset='1';$x1='1';}
				$sql_favoriteverse=mysql_result($r,$i,'favoriteverse');
				$sql_favorite_id=mysql_result($r,$i,'id');
				if (!empty($sql_favoriteverse)) { echo '<option value="'.$sql_favoriteverse.'">'.($i2)." $sql_favoriteverse".'</option>';}
				--$i2;++$i;
			}
			if (isset($favoriteset)){echo'</select>';}
		  }
		} 
?>
