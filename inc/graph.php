<?php // licence: gpl-signature.txt
	# ------- The graph values in the form of associative array

 
	$img_width=380;
	$img_height=200;; 
	$margins=20;

 
	# ---- Find the size of graph by substracting the size of borders
	$graph_width=$img_width - $margins * 2;
	$graph_height=$img_height - $margins * 2; 
	$img=imagecreate($img_width,$img_height);

 
	$bar_width=20;
	$total_bars=count($d)+count($d2);
	$gap= ($graph_width- $total_bars * $bar_width ) / ($total_bars +1);

 
	# -------  Define Colors ----------------
	$bar_color=imagecolorallocate($img,0,64,128);
        $bar_color2=imagecolorallocate($img,170,20,20);
	$background_color=imagecolorallocate($img,180,180 ,180);
	$border_color=imagecolorallocate($img,200,200,200);
	$line_color=imagecolorallocate($img,220,220,220);
 
	# ------ Create the border around the graph ------

	imagefilledrectangle($img,1,1,$img_width-2,$img_height-2,$border_color);
	imagefilledrectangle($img,$margins,$margins,$img_width-1-$margins,$img_height-1-$margins,$background_color);

 
	# ------- Max value is required to adjust the scale	-------
	$max_value=max($d);
        if($max_value<max($d2)){$max_value=max($d2);}
	$ratio= $graph_height/$max_value;

 
	# -------- Create scale and draw horizontal lines  --------
	$horizontal_lines=8;
	$horizontal_gap=$graph_height/$horizontal_lines;

	for($i=1;$i<=$horizontal_lines;$i++){
		$y=$img_height - $margins - $horizontal_gap * $i ;
		imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
		$v=intval($horizontal_gap * $i /$ratio);
		imagestring($img,0,5,$y-5,$v,$bar_color);

	}
 
	# ----------- Draw the bars here ------
	for($i=0;$i< $total_bars; $i++){ 
		# ------ Extract key and value pair from the current pointer position
		list($key,$value)=each($d);
		$x1= $margins + $gap + $i * ($gap+$bar_width) ;
		$x2= $x1 + $bar_width; 
		$y1=$margins +$graph_height- intval($value * $ratio) ;
		$y2=$img_height-$margins;
		imagestring($img,0,$x1+3,$y1-10,$value,$bar_color);
		imagestring($img,0,$x1+3,$img_height-15,$key,$bar_color);		
		imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color);
                if(is_array($d2)){
                    ++$i;
                    list($key,$value)=each($d2);
                    $x1= $margins + $gap + $i * ($gap+$bar_width) ;
                    $x2= $x1 + $bar_width; 
                    $y1=$margins +$graph_height- intval($value * $ratio) ;
                    $y2=$img_height-$margins;
                    imagestring($img,0,$x1+3,$y1-10,$value,$bar_color2);
                    imagestring($img,0,$x1+3,$img_height-15,$key,$bar_color2);		
                    imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color2);
                }
	}
	//header("Content-type:image/png");
        
        //imagepng($img)
        //imagepng($img,$imgdir."tmpgraph.png");
        //imagedestroy($img);
        //echo'<img src="'.$imgdir.'tmpgraph.png">';
        
        
        ob_start();
        imagepng($img);
        $imagevariable = ob_get_contents();
        ob_end_clean();
        
        echo'<img src="data:image/png;base64,'.base64_encode($imagevariable).'">';
?>