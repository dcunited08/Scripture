on *:START: {
  /hmake kjv 9000
  /hload -n kjv drupal/kjv.txt
  /hmake kja 9000
  /hload -n kja drupal/kja.txt
  /hmake kjg 9000
  /hload -n kjg drupal/kjg.txt
  /hmake kjvs 9000
  /hload -n kjvs drupal/kjvs.txt
  /hmake lxe 9000
  /hload -n lxe drupal/lxe.txt
  /hmake tnt 9000
  /hload -n tnt drupal/tnt.txt
  ;INSTALLING:
  ;1-Download this file and load it with /load -rs <location> (if mIRC directory /load -rs scripture.mrc), or hit alt+r and paste this code.
  ;Make a folder in your mIRC directory that's called drupal, and place the files you want to use with mIRC.
  ;2-In order for kjv to work here, with the following code, you must rename the kjv you want to use to kjv.txt inside the mIRC/drupal folder.
  ;(where to find content): http://bibel.thruhere.net/downloads and http://drupalbible.mikelee.idv.tw/?q=node/2
  ;3-How to use this: type for example //drupal mat 5:1-11 kjv gjdfgj
  ;Also the following word can be whatever, it is if you want to remove numbers.(the gjdfgj)
  :note: don't forget to come to /server -m irc.vbirc.com/bible or irc://irc.vbirc.com/bible :)
  %dbbooks = GEN EXO LEV NUM DEU JOS JUG RUT 1SM 2SM 1KG 2KG 1CH 2CH EZR NEH EST JOB PS PRO ECC SON ISA JER LAM EZE DAN HOS JOE AMO OBA JON MIC NAH HAB ZEP HAG ZEC MAL MAT MAK LUK JHN ACT ROM 1CO 2CO GAL EPH PHL COL 1TS 2TS 1TM 2TM TIT PHM HEB JAM 1PE 2PE 1JN 2JN 3JN JUD REV
  %dbbooksorg = Gen Exo Lev Num Deu Jos Jud Rut 1Sa 2Sa 1Ki 2Ki 1Ch 2Ch Ezr Neh Est Job Psa Pro Ecc Son Isa Jer Lam Eze Dan Hos Joe Amo Oba Jon Mic Nah Hab Zep Hag Zec Mal Mat Mar Luk Joh Act Rom 1Co 2Co Gal Eph Phili Col 1Th 2Th 1Ti 2Ti Tit Phile Heb Jam 1Pe 2Pe 1Jo 2Jo 3Jo Jud Rev
}
alias messagesplitter {
  %tempdata = $3-
  if ($len(%tempdata) > 440) {
    while ($len(%tempdata) > 440) {

      %vcharsearch = a
      %vcharsearchingnumber = 440
      %vcharsearch = $asc($mid(%tempdata,%vcharsearchingnumber,%vcharsearchingnumber))
      if (%vcharsearch != $chr(32)) {
        while ((%vcharsearch != 32) && (%vcharsearchingnumber > 350)) {
          %vcharsearch = $asc($mid(%tempdata,%vcharsearchingnumber,%vcharsearchingnumber))
          dec %vcharsearchingnumber
        }
      }
      if ($2 == m) /msg $1 $mid(%tempdata,0,%vcharsearchingnumber)
      if ($2 == n) .notice $1 $mid(%tempdata,0,%vcharsearchingnumber)
      %tempdata = $mid(%tempdata,$calc(%vcharsearchingnumber + 1))
    }
    if (($len(%tempdata) > 0) && ($2 == m)) { /msg $1 %tempdata }
    elseif (($len(%tempdata) > 0) && ($2 == n)) { .notice $1 %tempdata }
  }
  elseif ($2 == m) { /msg $1 %tempdata }
  elseif ($2 == n) { .notice $1 %tempdata }
  unset %tempdata %spacepos %chan %vcharsearchingnumber %vcharsearch %vcharsearch %rand %verse* %set*
}

alias drupal {
  unset %verse* %dverse* %x4 %dtemp*
  %bfbook = $left($1,3)
  if (%bfbook == phi) { %bfbook = $left($1,5) }
  %drbook = $gettok(%dbbooks,$findtok(%dbbooksorg, %bfbook,1,32),32)
  if (!%drbook) { %drbook = %bfbook }
  %dfile = $lower($3)
  if (!%chan) { set %chan $iif($nick,$nick,$iif($chan,$chan,$active)) }
  %bbv = . $+ %bfbook $2 $+ 
  %bbv5 = $3
  if (- isin $2) {
    %dtempline = $hfind(%dfile,$(*,) $+ %drbook $+ $(|,) $+ $replace($gettok($2,1,45),$(:,),$(|,)) $+ $(|,) $+ $(|,) $+ $(*,),1,w).data
    %dtempline2 = $calc(%dtempline + $gettok($2,2,45) - $gettok($gettok($2,1,45),2,58))
    while (%dtempline <= %dtempline2) {
      %dtempline3 = $hget(%dfile,%dtempline)
      %dverse = $iif(%dverse,%dverse,$null) $remove($gettok(%dtempline3,3,124),$(|,)) $gettok(%dtempline3,4-,124)
      %dtempline = $calc(%dtempline + 1)
    }
  }
  else {
    %dtempline3 = $hget(kjv,$hfind(%dfile,* $+ %drbook $+ $(|,) $+ $replace($2,$(:,),$(|,)) $+ $(|,) $+ $(|,) $+ *,1,w).data)
    %dverse = $gettok(%dtempline3,3,124) $gettok(%dtempline3,4-,124)
  }
  if (($4) || (- !isin $2)) { var %x4,%y = $regsub(%dverse,/\d+/gi,$null,%x4) | %dverse = %x4 }
  messagesplitter %chan $iif(%versenotice,%versenotice,m) %bbv $iif(%dverse,%dverse,No Verse Found) ( $+ $upper(%bbv5) $+ )
}

alias drupalsearch {
  ;//echo -a $findfile(drupal\,*.txt,0)
  ;//var %s = was without form | say $hget(kjv,$hfind(kjv,* $+ %s $+ *,1,w).data)
  unset %dverse %dnum*
  %dfile = $lower($1)
  %dsearch = * $+ $2- $+ *
  if (!%chan) { %chan = $iif($nick,$nick,$me) }
  if ($regex(drsb,$3-,(\w{1,3}\(\d{0,4}\))$)) {
    %dsm1 = $regml(drsb,1)
    %dfile = $gettok(%dsm1,1,40)
    %dsearch = * $+ $remove($3-,%dsm1) $+ *
    %dnumresults = $hfind(%dfile,%dsearch,0,w).data
    %dft1 = 1
    while (%dft1 <= %dnumresults) {
      %dtempline3 = $hget(%dfile,$hfind(%dfile,%dsearch,%dft1,w).data)
      echo -a " %dtempline3 "
      %dverse = $iif(%dverse,%dverse,$null) %dfilen $+ ( $+ %dtempline3 $+ )
      %dft1 = $calc(%dft1 + 1)
    }
  }
  elseif (.a == $1) {
    %dfnum = $findfile(drupal\,*.txt,0)
    %dft1 = 1
    while (%dft1 <= %dfnum) {
      %dfile = $findfile(drupal\,*.txt,%dft1)
      %dfilen = $gettok($gettok(%dfile,$numtok(%dfile,92),92),1,46)
      %dtempline3 = $hfind(%dfilen,%dsearch,0,w).data
      echo -a " %dfilen %dsearch %dtempline3 "
      %dverse = $iif(%dverse,%dverse,$null) %dfilen $+ ( $+ %dtempline3 $+ )
      %dft1 = $calc(%dft1 + 1)
    }  
  }
  else {
    %dft1 = 1
    %dnumresults = $hfind(%dfile,%dsearch,0,w).data
    while (%dft1 <= %dnumresults) {
      %dtempline3 = $hfind(%dfile,%dsearch,%dft1,w).data
      echo -a " " %chan %dtempline3 "
      ;%dverse = $iif(%dverse,%dverse,$null) %dfilen $+ ( $+ %dtempline3 $+ )
      %dft1 = $calc(%dft1 + 1)
    }
    ;%dnumresult1 = $hfind(%dfile,%dsearch,1,w).data
    ;echo -a " %dnumresults %dfile %dsearch "
    ;%dtempline3 = $hget(%dfile,%dnumresult1).data
    ;%dverse = $remove($gettok(%dtempline3,3,124),$(|,)) $gettok(%dtempline3,4-,124)
    ;if (($4) || (- !isin $2)) { var %x4,%y = $regsub(%dverse,/\d+/gi,$null,%x4) | %dverse = %x4 }
  }
  if (%dfile == kjg) { %dverse = " %dverse " }
  messagesplitter %chan n $iif(%dverse,%dverse,No results)
  unset %chan
}