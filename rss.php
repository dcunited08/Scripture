<?php // licence: gpl-signature.txt
$notype=1;
require('init.php');
$subdomain=strstr($_SERVER['PHP_SELF']);
if($subdomain>=2){$subd=preg_match('(\/.*/)',$subd);}
$server=stripslashes($_SERVER['HTTP_HOST']).$subd;
//header("Content-type: text/xml");
if($link!==false){
if(!file_exists('rss')){
    mkdir('rss');chmod('rss',0755);
    $fh=fopen('rss/.htaccess','a+');
    fwrite($fh,'Options +Indexes');fclose($fh);
}
$ntypes=mysql_query('SELECT * FROM bible_node_types;');
$numtypes=mysql_numrows($ntypes);
$it=0;while($it<=$numtypes){
    $feedtype=mysql_result($ntypes,$it,'name');
    if(!empty($feedtype)){$dotype='type=\''.$feedtype.'\'';}
    $st='1';
    if($feedtype=='fc'){$dotype='type NOT IN(\'fc\')';$ft='All content';$feedtype='feed';}
    elseif($feedtype=='ne'){$ft='News';$feedtype='news';}
    elseif($feedtype=='ft'){$ft='Forum Topics';$feedtype='forum';}
    elseif($feedtype=='ct'){$st='0';$ft='Comments';$feedtype='comments';}
    elseif($feedtype=='ar'){$ft='Articles';$feedtype='articles';}
    elseif($feedtype=='bl'){$ft='Blogs';$feedtype='blogs';}
    elseif($feedtype=='po'){$ft='Podcasts';$feedtype='podcasts';}
    elseif($feedtype=='ev'){$ft='Events';$feedtype='event';}
    elseif($feedtype=='do'){$ft='Documentation';$feedtype='documentation';}
    elseif($feedtype=='li'){$ft='Links';$feedtype='links';}
    else{$ft=$feedtype;}
    $s=mysql_query('SELECT * FROM bible_nodes WHERE status='.$st.' AND '.$dotype.' ORDER BY created DESC LIMIT 0,30;');
    $n=mysql_numrows($s);
    if(!empty($n)and!empty($ft)and($n!==0)){
        echo$ft.' '.$n.N;
        $fh=fopen('rss/'.$feedtype.'.rss','w+');
        fwrite($fh,'<?xml version=\'1.0\' encoding=\'UTF-8\'?>
        <rss version=\'2.0\'><channel>
        <title>'.$ft.' | '.$server.'</title>
        <link>http://'.$server.'</link>
        <description>'.$server.' Feeds</description>
        <language>en-us</language>');

        $i=0;while($i<$n){
            //$svisitors=mysql_result($s,$i,'visitors');$supcate=mysql_result($s,$i,'uppercat');$scate=mysql_result($s,$i,'category');
            $sdata=mysql_result($s,$i,'data');
            if(strstr($sdata,'<![CDATA[')){$sdata=str_replace(']]>',"",$sdata);$sdata=preg_replace('/(<\!\[[^\[].*\[)/i',"",$sdata);} 
            fwrite($fh,'<item>
            <title>'.mysql_result($s,$i,'title').'</title>
            <link>http://'.$server.'?forum&amp;nid='.mysql_result($s,$i,'nid').'</link>
            <description><![CDATA['.$sdata.'<p></p>By uid['.mysql_result($s,$i,'uid').']]]></description>
            <pubDate>'.date('r',mysql_result($s,$i,'created')).'</pubDate>
            <category>'.mysql_result($s,$i,'type').'</category>
            </item>');
            ++$i;
        }
        fwrite($fh,'</channel></rss>');
        fclose($fh);
    }
    ++$it;
}

echo'<a href="http://'.$server.'/rss">generation complete; you may now find them here</a>';
}
?>