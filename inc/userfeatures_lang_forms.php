<?php // licence: gpl-signature.txt
$ln=stripslashes($_GET['ln']);echo'"'.$ln.'"';$te="";$lne=explode('-',$ln);
$wb='<a href="http://google.com/search?q=define%3A+';$wb2='">';$wb3='</a>';
if($lne[0]!='V'){
  if(preg_match('/^(ADV|CONJ|COND|PRT|PREP|INJ|ARAM|HEB|N-PRI|A-NUI|N-LI|N-OI)/i',$ln,$m5)){
    $uf='1';
    echo' <u>UNDECLINED FORMS</u>'.N;
    if($m5[1]=='ADV'){$te.=$m5[0].') _Adverb_ or adverb and particle combined'.N;}
    elseif($m5[1]=='CONJ'){$te.=$m5[1].') CONJunction or _conjunctive particle_ '.N;}
    elseif($m5[1]=='COND'){$te.=$m5[1].') _Conditional particle_ or conjunction '.N;}
    elseif($m5[1]=='PRT'){$te.=$m5[1].') PaRTicle, _disjunctive particle_ '.N;}
    elseif($m5[1]=='PREP'){$te.=$m5[1].') _PREPosition_ '.N;}
    elseif($m5[1]=='INJ'){$te.=$m5[1].') _INterJection_ '.N;}
    elseif($m5[1]=='ARAM'){$te.=$m5[1].') ARAMaic _transliterated_ word (indeclinable)'.N;}
    elseif($m5[1]=='HEB'){$te.=$m5[1].')   HEBrew _transliterated_ word (indeclinable)'.N;}
    elseif($m5[1]=='N-PRI'){$te.=$m5[1].') _Indeclinable PRoper Noun_ '.N;}
    elseif($m5[1]=='A-NUI'){$te.=$m5[1].') _Indeclinable NUmeral_ (Adjective)'.N;}
    elseif($m5[1]=='N-LI'){$te.=$m5[1].') _Indeclinable Letter_ (Noun)'.N;}
    elseif($m5[1]=='N-OI'){$te.=$m5[1].') _Indeclinable Noun_ of Other type'.N;}
    //echo preg_replace('/_[^_]*_/i',$wb.urlencode("$1").'">'."$1".'</a>');
    $m2=preg_match_all('/_([^_]*)_/i',$te,$m3,PREG_OFFSET_CAPTURE);
    foreach($m3[0] as $m4){$te=str_replace($m4[0],$wb.urlencode($m4[0]).$wb2.$m4[0].$wb3,$te);$te=str_replace('_',"",$te);}echo$te;$te="";
  }
  elseif(preg_match('/^(N|A|R|C|D|T|K|I|X|Q|F|S|P)\-/i',$ln,$m5)){
    $df='1';
    echo N.' <u>DECLINED FORMS</u>'.N.' All follow the order: prefix-case-number-gender-(suffix) )'.N;
    if($m5[1]=='N'){$te.=$m5[0].'-) _Noun_'.N;}
    elseif($m5[1]=='A'){$te.=$m5[0].') _Adjective_'.N;}
    elseif($m5[1]=='R'){$te.=$m5[0].') _Relative pronoun_'.N;}
    elseif($m5[1]=='C'){$te.=$m5[0].') _reCiprocal pronoun_'.N;}
    elseif($m5[1]=='D'){$te.=$m5[0].') _Demonstrative pronoun_'.N;}
    elseif($m5[1]=='T'){$te.=$m5[0].') _definite arTicle_'.N;}
    elseif($m5[1]=='K'){$te.=$m5[0].') _correlative pronoun_'.N;}
    elseif($m5[1]=='I'){$te.=$m5[0].') _Interrogative pronoun_'.N;}
    elseif($m5[1]=='X'){$te.=$m5[0].') _indefinite pronoun_'.N;}
    elseif($m5[1]=='Q'){$te.=$m5[0].') _correlative or interrogative pronoun_'.N;}
    elseif(preg_match('/(^F\-([\d]?))/i',$ln,$m)){if($m[2]>0){$tet=$m[2].'.Person';}$te.=$m[0].') _reFlexive pronoun_ '.$tet.N;}
    elseif(preg_match('/(^S\-([\d]?))/i',$ln,$m)){if($m[2]>0){$tet=$m[2].'.Person';}$te.=$m[0].') _poSsessive pronoun_ '.$tet.N;}
    elseif(preg_match('/(^P\-([\d]?))/i',$ln,$m)){if($m[2]>0){$tet=$m[2].'.Person';}$te.=$m[0].') _Personal pronoun_ '.$tet.N;}
    $m2=preg_match_all('/_([^_]*)_/i',$te,$m3,PREG_OFFSET_CAPTURE);
    foreach($m3[0] as $m4) {$te=str_replace($m4[0],$wb.urlencode($m4[0]).$wb2.$m4[0].$wb3,$te);$te=str_replace('_',"",$te);}echo$te;$te="";
  
    if(preg_match('/^[^-]*-\d?(N|V|G|D|A)/i',$ln,$m5)){
     if(!empty($m5[1])){echo N.'Cases,'.N.' (Note: 1st and 2nd personal pronouns have no gender) )'.N;}
      if($m5[1]=='N'){$te.='-'.$m5[1].') _Nominative_ (5-case system)'.N;}
      elseif($m5[1]=='V'){$te.='-'.$m5[1].') _Vocative_ '.N;}
      elseif($m5[1]=='G'){$te.='-'.$m5[1].') _Genitive_ '.N;}
      elseif($m5[1]=='D'){$te.='-'.$m5[1].') _Dative_ '.N;}
      elseif($m5[1]=='A'){$te.='-'.$m5[1].') _Accusative_ '.N;}
    }
    $m2=preg_match_all('/_([^_]*)_/i',$te,$m3,PREG_OFFSET_CAPTURE);
    foreach($m3[0] as $m4) {$te=str_replace($m4[0],$wb.urlencode($m4[0]).$wb2.$m4[0].$wb3,$te);$te=str_replace('_',"",$te);}echo$te;$te="";
  
    if(preg_match('/^[^-]*-\d?[\w]?(P|S)/i',$ln,$m5)){
        if(!empty($m5[1])){echo'Number,'.N;}
        if($m5[1]=='P'){echo'-.P)'.$wb.'Plural'.$wb2.'Plural'.$wb3.N;}
        elseif($m5[1]=='S'){echo'-.S)'.$wb.'Singular'.$wb2.'Singular'.$wb3.N;}
    }
    if(preg_match('/^[^-]*-\d?[\w][\w]?(M|F|N)/i',$ln,$m5)){
        if(!empty($m5[1])){echo'Gender,'.N;}
        if($m5[1]=='M'){echo'-.M)'.$wb.'Masculine'.$wb2.'Masculine'.$wb3.N;}
        elseif($m5[1]=='F'){echo'-.F)'.$wb.'Feminine'.$wb2.'Feminine'.$wb3.N;}
        elseif($m5[1]=='N'){echo'-.N)'.$wb.'Neuter'.$wb2.'Neuter'.$wb3.N;}
    }
    if(preg_match('/^\w{1,5}-\w{1,5}-\d?[\w]?(S|C|ABB|I|N|K|ATT)/i',$ln,$m5)){
        if(!empty($m5[1])){echo'Suffixes,'.N;}
        if($m5[1]=='S'){echo'--.S)'.$wb.'Superlative'.$wb2.'Superlative'.$wb3.' (used primarily with adjectives and some adverbs)'.N;}
        elseif($m5[1]=='C'){echo'--.C)'.$wb.'Comparative'.$wb2.'Comparative'.$wb3.' (used primarily with adjectives and some adverbs)'.N;}
        elseif($m5[1]=='ABB'){echo'--.ABB)'.$wb.'ABBreviated'.$wb2.'ABBreviated form'.$wb3.' (used  only  with  certain  numbers  in  Revelation  as printed in some early editions)'.N;}
        
        elseif($m5[1]=='I'){echo'--.I)'.$wb.'Interrogative'.$wb2.'Interrogative'.$wb3.N;}
        elseif($m5[1]=='N'){echo'--.N)'.$wb.'Negative+adverb'.$wb2.'Negative'.$wb3.' (used with some particles, adverbs, adjectives, and conjunctions)'.N;}
        elseif($m5[1]=='K'){echo'--.K)'.$wb.'καὶ'.$wb2.htmlentities('καὶ').$wb3.htmlentities(' (CONJ) merged by crasis with forms of the demonstrative pronoun 
                  ἐκεῖνός or the first person personal pronoun ἐγὼ; also, the neuter 
                  definite article τὸ merged by crasis with a second word. Declension 
                  follows that of the second word.').N;}
        elseif($m5[1]=='ATT'){echo'--.ATT)'.$wb.'ATTic+greek'.$wb2.'ATTic Greek form'.$wb3.N;}
    }
    
    //if((!empty($df)or!empty($uf))and($uid=='1')){echo$df.'test'.$uf;}
    
    //if(preg_match('/^[^-]*-\d?(N)/i',$ln,$m)){$te.='-'.$m[1].') _Nominative_ (5-case system)'.N;};
  }
}else{
    echo' <u>PARSED VERB FORMS</u>'.N;
    if(preg_match('/^([\d]?\w)([\w]?)([\w]?)/i',$lne[1],$m5)){
        if($m5[1]=='P'){$de='-P)'.$wb.'Present+tense+verb'.$wb2.'Present'.$wb3;}
        elseif($m5[1]=='I'){$de='-I)'.$wb.'Imperfect+tense+verb'.$wb2.'Imperfect'.$wb3;}
        elseif($m5[1]=='A'){$de='-A)'.$wb.'Aorist+tense+verb'.$wb2.'Aorist'.$wb3;}
        elseif($m5[1]=='2A'){$de='-2A)'.$wb.'Aorist+tense+verb'.$wb2.'Second Aorist'.$wb3;}
        elseif($m5[1]=='F'){$de='-F)'.$wb.'Future+tense+verb'.$wb2.'Future'.$wb3;}
        elseif($m5[1]=='2F'){$de='-2F)'.$wb.'Future+tense+verb'.$wb2.'Second Future'.$wb3;}
        elseif($m5[1]=='R'){$de='-R)'.$wb.'peRfect+tense+verb'.$wb2.'peRfect'.$wb3;}
        elseif($m5[1]=='2R'){$de='-2R)'.$wb.'peRfect+tense+verb'.$wb2.'Second peRfect'.$wb3;}
        elseif($m5[1]=='L'){$de='-L)'.$wb.'pLuperfect+tense+verb'.$wb2.'Aorist'.$wb3;}
        elseif($m5[1]=='2L'){$de='-2L)'.$wb.'pLuperfect+tense+verb'.$wb2.'Second Aorist'.$wb3;}
        if(!empty($de)){echo'Tense,'.N.$de.N;}unset($de);
        
        if($m5[2]=='A'){$de='-.A)'.$wb.'Active+voice+verb'.$wb2.'Active'.$wb3;}
        elseif($m5[2]=='M'){$de='-.M)'.$wb.'Middle+voice+verb'.$wb2.'Middle'.$wb3;}
        elseif($m5[2]=='P'){$de='-.P)'.$wb.'Passive+voice+verb'.$wb2.'Passive'.$wb3;}
        elseif($m5[2]=='E'){$de='-.E)'.$wb.'Passive+voice+verb'.$wb2.'Either middle or passive'.$wb3;}
        elseif($m5[2]=='D'){$de='-.D)'.$wb.'middle+Deponent+voice+verb'.$wb2.'middle Deponent'.$wb3;}
        elseif($m5[2]=='O'){$de='-.O)'.$wb.'passive+depOnent+voice+verb'.$wb2.'passive depOnent'.$wb3;}
        elseif($m5[2]=='N'){$de='-.N)'.$wb.'Passive+voice+verb'.$wb2.'middle or passive depoNent'.$wb3;}
        if(!empty($de)){echo'Voice,'.N.$de.N;}unset($de);
        
        if($m5[3]=='I'){$de='-..I)'.$wb.'Indicative+mood+verb'.$wb2.'Indicative'.$wb3;}
        elseif($m5[3]=='S'){$de='-..S)'.$wb.'Subjunctive+mood+verb'.$wb2.'Subjunctive'.$wb3;}
        elseif($m5[3]=='O'){$de='-..O)'.$wb.'Optative+mood+verb'.$wb2.'Optative'.$wb3;}
        elseif($m5[3]=='M'){$de='-..M)'.$wb.'iMperative+mood+verb'.$wb2.'iMperative'.$wb3;}
        elseif($m5[3]=='N'){$de='-..N)'.$wb.'iNfinitive+mood+verb'.$wb2.'iNfinitive'.$wb3;}
        elseif($m5[3]=='P'){$de='-..P)'.$wb.'Participle+mood+verb'.$wb2.'Participle'.$wb3;}
        if(!empty($de)){echo'Mood,'.N.$de.N;}unset($de);
    }
    if(preg_match('/^([\d]?)([\w]?[\w]?)([\w]?)/i',$lne[2],$m5)){
        //Person:
        if($m5[1]=='1'){$de='--1)'.$wb.'first+person+verb'.$wb2.'First Person'.$wb3;}
        elseif($m5[1]=='2'){$de='--2)'.$wb.'second+person+verb'.$wb2.'Second Person'.$wb3;}
        elseif($m5[1]=='3'){$de='--3)'.$wb.'third+person+verb'.$wb2.'Third Person'.$wb3;}
        if(!empty($de)){echo N.$de;}$de="";
        //Case:
        if(strstr($m5[2],'N')){$de.='--N)'.$wb.'Nominative+verb'.$wb2.'Nominative'.$wb3.'(5-case system; no Vocative in verbal forms)'.N;}
        if(strstr($m5[2],'G')){$de.='--G)'.$wb.'Genitive+verb'.$wb2.'Genitive'.$wb3.N;}
        if(strstr($m5[2],'D')){$de.='--D)'.$wb.'Dative+verb'.$wb2.'Dative'.$wb3.N;}
        if(strstr($m5[2],'A')){$de.='--A)'.$wb.'Accusative+verb'.$wb2.'Accusative'.$wb3.N;}
        //Number:
        if(strstr($m5[2],'S')){$de.='--.S)'.$wb.'Singular+verb'.$wb2.'Singular'.$wb3.N;}
        if(strstr($m5[2],'P')){$de.='--.P)'.$wb.'Plural+verb'.$wb2.'Plural'.$wb3.N;}
        //Gender:
        if(strstr($m5[3],'M')){$de.='--..M)'.$wb.'Masculine+verb'.$wb2.'Masculine'.$wb3.N;}
        if(strstr($m5[3],'F')){$de.='--..F)'.$wb.'Feminine+verb'.$wb2.'Feminine'.$wb3.N;}
        if(strstr($m5[3],'N')){$de.='--..N)'.$wb.'Neuter+verb'.$wb2.'Neuter'.$wb3.N;}
        
        if(!empty($de)){echo N.$de;}$de="";
    }
    if(strstr($ln,'-ATT')){echo N.'---ATT)'.$wb.'Attic+Greek+form'.$wb2.'Attic Greek form'.$wb3;}
    //echo N.'Under Construction'.N.'<a href="?forum&b=2&s=&nid=18">Look here for more information</a>';
}
?>