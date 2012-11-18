<?php // licence: gpl-signature.txt
    // under development (haven't really found any usage for these yet; anyone got any database to test these with?)
    for($i=0;$i<$count;$i++) {
    $t_line = str_replace('    ', ' ', $f_arr[$i]);
    //if ($i > 90) { break; }    //temp
    $a_t_line = explode(' ', $t_line);
    $sum = sizeof($a_t_line);
    if ($import_mode == 'ignorenamechapabove') {
        if (isset($a_t_line[4]) && !strpos($t_line, '||')) {
            if(preg_match('/\d+/', $a_t_line[1] . $a_t_line[2])) {
                if(preg_match('/\d+/',$a_t_line[2])) {
                    $t_book = $a_t_line[0].$a_t_line[1];
                    if(preg_match('/\:/',$a_t_line[2])) { $t_versenum = $a_t_line[2]; }
                    else { $t_versenum = '1|'.$a_t_line[2]; }
                    $subset = array_slice($a_t_line, 3, $sum);
                    $t_verse = implode(' ',$subset);
                }
                elseif(preg_match('/\d+/',$a_t_line[1],$regmatch)) {
                    if($regmatch[0] < 200) {
                        $t_book = $a_t_line[0];
                        if(preg_match('/\:/',$a_t_line[1])) { $t_versenum = $a_t_line[1]; }
                        else { $t_versenum = '1|'.$t_line[1]; }
                        $subset = array_slice($a_t_line, 2, $sum);
                        $t_verse = implode(' ',$subset);
                    }
                }
                if (!empty($t_verse)) {
                    $token = array_search(strtolower($t_book), $a_books);
                    if ($token !== FALSE) { $b_name = $a_shortdrupal[$token + 39]; } //+39 to make it the nt books
                    else { $b_name = $t_book; }
                    $t_verse = str_replace(array(':','{','}'), array('|','[',']'),$t_verse);
                    $t_linec = $b_name.'|'.str_replace(':','|',$t_versenum).'||'.$t_verse;
                    if (($t_linec == $t_check) && !empty($t_check)) { $t_check = $t_linec; unset($t_linec); }
                    else { $t_check = $t_linec; }
                }
               
            }
           
        }
    }
    elseif ($import_mode == 'namechapabove') { //mode namechapabove is not fully completed, require a verse-number-system, and verse-output.
        if (!strpos($t_line, '||')) {
            if (!$separatorfound && strpos($t_line, '$separator')) { $separatorfound = '1'; }
            elseif ($separatorfound == '1') { $token = array_search(strtolower($t_line), $a_books);$separatorfound = '2'; }
            elseif ($separatorfound == '2') {
                if ($sum == '1') { $bookfound = $t_line; }
                else { $bookfound = $t_line[0].$t_line[1]; }
                $separatorfound = '0'; }
            elseif (($chaptersep == $t_line[0]) && !$t_line[2]) { $Cnumber = $t_line[1]; }
           
        }
    }
    if (isset($t_linec)) { fwrite($fh2,$t_linec); }
    unset($a_t_line,$t_line,$t_verse,$t_linec);
    }

 ?>