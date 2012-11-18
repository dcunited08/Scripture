<?php // licence: gpl-signature.txt
    /*
    This function isn't fully complete, still needs some clearing up; not anyone of you wich are expert at regex?
    I might have made it better, but i don't see any reason to do it for myself, as i used other editors to clear up the file generated here with regex.
    But atleast here it is for others if they want a partly automatic importer.
    */
    global $booktowrite, $a_books; //$books,
    ini_set('max_execution_time', '0');
    error_reporting(E_ALL);
      function biblestudyripper ($url) {
        $tmpfilename=preg_replace('/(^www\.)/i','http://www.',$url);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$tmpfile = curl_exec($ch);
	curl_close($ch);
	if(empty($tmpfile)){$tmpfile = file_get_contents($url);} //if curl is unsupported
	if(empty($tmpfile)){die($url.'<br>Error - No data or connection (Some PHP settings might be disabled or disallowed; for example curl)');}
        
        if ($raw===false) { 
            $token = array_search(strtolower($GLOBALS['booktowrite']),array_map('strtolower',$GLOBALS['a_books']));
            if ($token !== FALSE) { echo $GLOBALS['booktowrite'];$GLOBALS['booktowrite'] = $GLOBALS['a_books'][$token + 1];$GLOBALS['chapter'] = 0; }
            else die('is it done?!');
            return "break";
        }
        $newlines = array('\t','\n','\r','\x20\x20','\0','\x0B');
        $content = str_replace($newlines, '', html_entity_decode($raw));
        $regex ='/\<a href="[^>]*id="NextLink"/i';
        $regex2 = '/"([^"]*)"/i';
        $matching = preg_match($regex,$content,$match);
        if (!empty($match[0])) { $match_temp = $match[0]; }
        $start = strpos($content,'<div class="Text"');
        $end = strpos($content,'</div>',$start);
        $table = substr($content,$start,$end-$start);
        $table = preg_replace('/(<TABLE.*<\/TABLE>)/i','',$table);
        $table = preg_replace('/(<span><b>)/i','|',$table);
        $table = preg_replace('/(<[^>]*>)|(\[.]\])/',' ',$table);
        $table = preg_replace('/\([^|]*\|/',' ',$table);
        $table = preg_replace('/(\|Treasury of Scripture Knowledge \|)/i','',$table);
        $table = preg_replace('/\(King James Version\)\s+\S+(?:\s\S+)*/i','',$table);
        $table = preg_replace('/('.$GLOBALS['booktowrite'].'.*There are no entries for this verse!.*)/i','',$table);
        $table = preg_replace('/(\xa0)/i','',$table);
        if (preg_match('/('.$GLOBALS['booktowrite'].'\s\d?\d?\d?\d:)\d?\d?\d.*\s\s(\d?\d?\d)\s\s/',$table,$result1)) {
            $table = preg_replace('/\s\s'.$result1[1].'\s\s/','/  '.$result1[1].''.$result1[2].'  /',$table);
            $regnum = 1;$regnum2 = 2;
            for($i2=0;$i2<50; ++$i2) {
                    $regnum = $regnum + 2;
                    $regnum2 = $regnum2 + 2;
                    if (!empty($result1[$regnum2])) {
                        $table = preg_replace('/\s\s'.$result1[$regnum].'\s\s/','/  '.$result1[$regnum].''.$result1[$regnum2].'  /',$table);
                    } else { break; }
            }
        }
        if (preg_match('/('.$GLOBALS['booktowrite'].')\s\d?\d?\d?\d:\d?\d?\d.*\s\s(\d?\d?\d:\d?\d?\d)\s\s/',$table,$result1)) {
            $table = preg_replace('/\s\s'.$result1[1].'\s\s/','/  '.$result1[1].''.$result1[2].'  /',$table);
            $regnum = 1;$regnum2 = 2;
            for($i2=0;$i2<50; ++$i2) {
                $regnum = $regnum + 2;
                $regnum2 = $regnum2 + 2;
                if (!empty($result1[$regnum2])) {
                    $table = preg_replace('/\s\s'.$result1[$regnum].'\s\s/','/  '.$result1[$regnum].''.$result1[$regnum2].'  /',$table);
                } else { break; }
            }
    }
    $myFile = 'TSK.txt'; //$myFile = $GLOBALS['booktowrite'].".txt";
    $fh = fopen($myFile, 'a') or die('can\'t open file');
    fwrite($fh, $table.'\n');
    fclose($fh);
    if (!empty($match_temp)) { $matching2 = preg_match($regex2,$match_temp,$match2, PREG_OFFSET_CAPTURE); }
    else { return 'break'; }
    $url = $match2[1][0];
    return $url;
    }
    for($i=0;$i<40000; ++$i) {
        if (!isset($url)) { 
        global $booktowrite, $url, $chapter; 
        $booktowrite = 'Genesis';
        $url = 'http://www.biblestudytools.com/concordances/treasury-of-scripture-knowledge/'.$booktowrite.'-1-1.html';$chapter = 1; }
        //echo $url;
        $url=biblestudyripper($url);
        if ($url == 'error') { echo'done!'; break; }
        if ($url == 'break') { 
            $chapter = $chapter + 1;
            $url = 'http://www.biblestudytools.com/concordances/treasury-of-scripture-knowledge/'.$booktowrite.'-'.$chapter.'-1.html';
        }
    }
?>