<?php
/*
 *
 *
    if($biblex==52){#require('../../Languages/utf16_encode.php');
      #$input=preg_replace('#u([0-9a-f]+)#ie','unicode2utf8(0x$1)',$input);
      if($uid==1){echo'<rs>'.$input.'</rs>';}
      #$input=utf16_to_utf8($input);
      /*
       
    $str=$input;
    $c0=ord($str[0]);
    $c1=ord($str[1]);

    if($c0==0xFE&&$c1==0xFF){$be=true;}
    elseif($c0==0xFF&&$c1==0xFE){$be=false;}
    else{return $str;}

    $str=substr($str,2);
    $len=strlen($str);
    $dec="";
    $i=0;while($i<$len){
     $c=($be)?ord($str[$i])<<8|ord($str[$i+1]):ord($str[$i+1])<<8|ord($str[$i]);
     if($c>=0x0001&&$c<=0x007F){$dec.=chr($c);}
     elseif($c>0x07FF) {
      $dec.=chr(0xE0|(($c>12)&0x0F));
      $dec.=chr(0x80|(($c>>6)&0x3F));
      $dec.=chr(0x80|(($c>>0)&0x3F));
     }else{
      $dec.=chr(0xC0|(($c>>6)&0x1F));
      $dec.=chr(0x80|(($c>>0)&0x3F));
     }
     $i+=2;
    }
    $input=$dec;
    
    
    function unicode2utf8($c)
	{
    $output="";
    if($c<0x80){return chr($c);}
    elseif($c<0x800){return chr(0xc0 | ($c >> 6) ).chr(0x80 | ($c & 0x3f) );}
    elseif($c<0x10000){return chr(0xe0 | ($c >> 12) ).chr(0x80 | (($c >> 6) & 0x3f)).chr(0x80 | ($c & 0x3f));}
    elseif($c<0x200000){return chr(0xf0 | ($c >> 18)).chr(0x80 | (($c >> 12) & 0x3f)).chr(0x80 | (($c >> 6) & 0x3f)).chr(0x80 | ($c & 0x3f));}
    return false;
	}
    $input=preg_replace('#u([0-9a-f]+)#ie','unicode2utf8(0x$1)',utf8_encode($input));
      
      
      if($uid==1){echo'<rs>'.($input).'</rs>';}
       }*/
 
 *
 *
function unicode2utf8($c)
{
    $output="";
    if($c<0x80){return chr($c);}
    elseif($c<0x800){return chr(0xc0 | ($c >> 6) ).chr(0x80 | ($c & 0x3f) );}
    elseif($c<0x10000){return chr(0xe0 | ($c >> 12) ).chr(0x80 | (($c >> 6) & 0x3f)).chr(0x80 | ($c & 0x3f));}
    elseif($c<0x200000){return chr(0xf0 | ($c >> 18)).chr(0x80 | (($c >> 12) & 0x3f)).chr(0x80 | (($c >> 6) & 0x3f)).chr(0x80 | ($c & 0x3f));}
    return false;
}
*/
function utf16_to_utf8($str) {
    $c0=ord($str[0]);
    $c1=ord($str[1]);

    if($c0==0xFE&&$c1==0xFF){$be=true;}
    elseif($c0==0xFF&&$c1==0xFE){$be=false;}
    else{return $str;}

    $str=substr($str,2);
    $len=strlen($str);
    $dec="";
    $i=0;while($i<$len){
     $c=($be)?ord($str[$i])<<8|ord($str[$i+1]):ord($str[$i+1])<<8|ord($str[$i]);
     if($c>=0x0001&&$c<=0x007F){$dec.=chr($c);}
     elseif($c>0x07FF) {
      $dec.=chr(0xE0|(($c>12)&0x0F));
      $dec.=chr(0x80|(($c>>6)&0x3F));
      $dec.=chr(0x80|(($c>>0)&0x3F));
     }else{
      $dec.=chr(0xC0|(($c>>6)&0x1F));
      $dec.=chr(0x80|(($c>>0)&0x3F));
     }
     $i+=2;
    }
    return $dec;
}

?>