<?php // licence: gpl-signature.txt
    if(!empty($tmpfilename)){
	if(function_exists('curl_open')){
        $ch = curl_init();
	$timeout = 5; // set to zero for no timeout
	curl_setopt ($ch, CURLOPT_URL, $tmpfilename);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$file_contents = curl_exec($ch);
	curl_close($ch);
	}
	if(empty($file_contents)and function_exists('file_get_contents')){$file_contents = file_get_contents($tmpfilename);} //if curl is unsupported
	if(empty($file_contents)){die($tmpfilename.'<br>Error - No data or connection (Some PHP settings might unables(ex. curl)');}
	$lines = array();
	$lines = explode("\n", $file_contents);
	$countfilel=count($lines);
    }
?>