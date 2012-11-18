<?php
 require('../init.php');
 if($uid!=='1'){die('access denied');}
 echo'uploading geodata to database...'.NN;
 ini_set('max_execution_time', '900');
 ini_set('post_max_size', '400M');
 ini_set('max_file_uploads', '400M');
 ini_set('max_input_time', '900');
 $geofiles=array('GeoLiteCity-Blocks.csv','GeoLiteCity-Location.csv');
 foreach($geofiles as $thefile){
 if($thefile=='GeoLiteCity-Blocks.csv'){$filenum='1';}else{unset($filenum);}
 $geofile = fopen($thefile,"r") or die('error opening file(may be too large)');
$i=0;$size=1024;
while(!feof($geofile)){
 //++$i;
 //if($i>10){break;}
 if(isset($filenum)){mysql_query('INSERT INTO geoblocks (startIpNum,endIpNum,locId) VALUES('.fgets($geofile,$size).');');
  //if($i<10){echo'INSERT INTO geoblocks (startIpNum,endIpNum,locId) VALUES('.$tmp.');'.NN;}
 }
 else{mysql_query('INSERT INTO geolocation (locId,country,region,city,postalCode,latitude,longitude,dmaCode,areaCode) VALUES('.preg_replace(array('/(\s{1,3})$/','/(\,\,)$/','/(\,)$/'),array("",",'',''",",''"),fgets($geofile,$size)).');');
   //if($i<10){echo'INSERT INTO geolocation (locId,country,region,city,postalCode,latitude,longitude,dmaCode,areaCode) VALUES('.preg_replace(array('/(\s{1,3})$/','/(\,\,)$/','/(\,)$/'),array("",",'',''",",''"),$tmp).');'.NN;}
 }
}
fclose($f);
 
 /*
   $f_arr = file($geofile);
   $count = count($f_arr);
 echo $thefile.' num: '.$count.N;
  $i=0;while($i<=$count){
    if(isset($filenum)){mysql_query('INSERT INTO geoblocks (startIpNum,endIpNum,locId) VALUES('.$f_arr[$i].');');}
    else{mysql_query('INSERT INTO geolocation (locId,country,region,city,postalCode,latitude,longitude,dmaCode,areaCode) VALUES('.$f_arr[$i].');');}
    ++$i;
  }
  fclose($geofile);*/
 }
 echo'Upload Complete'.N;
 ?>