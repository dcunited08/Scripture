<?php // licence: gpl-signature.txt
$site='http://scripture.cvs.sourceforge.net/viewvc/scripture/scripture_content/';
//file_get_contents('http://scripture.cvs.sourceforge.net/viewvc/scripture/scripture_content/') or $site='http://79.143.177.152/m/downloads/';
echo'Online: <select name="sitetouploadfrom"><option value="">Online Databases</option>
<option value="'.$site.'Bible_Maps/Jesus_Prophecies.bmap">(bmap)Jesus Prophecies</option>

<option value="'.$site.'English/KJV_LackingCommas-en.bc">(en)KJaV (Lack some end-commas)</option>
<option value="'.$site.'English/KJV_wStrongsAndGenevaNotes_eng.bc">(en)KJV w/Geneva and Strongs</option>
<option value="'.$site.'English/KJV_wStrongs_eng.bc">(en)KJV w/Strongs</option>
<option value="'.$site.'English/LXE.bc">(en)LXE,English Septuagint(lxx)Brenton</option>
<option value="'.$site.'English/T_NT+-+Tyndale+New+Testament+(1534)-eng.bc">(en)Tyndale New Testament(1534)</option>
<option value="'.$site.'English/Tyndale.bc">(en)Tyndale(1534)</option>
<option value="'.$site.'English/YLT_YoungsLiteralTranslation_eng.bc">(en)YLT YoungsLiteralTranslation</option>
<option value="'.$site.'English/Geneva_Bible(1599)_eng.bc">(en)Geneva Bible(1599)</option>
<option value="'.$site.'English/Etheridge_NT_Peshitta(1849)_eng.bc">(en)Etheridge NT Peshitta(1849)</option>
<option value="'.$site.'English/Lewis_OT_Peshitta(1896)_eng.bc">(en)Lewis OT Peshitta(1896)</option>
<option value="'.$site.'English/Murdock_NT_Peshitta(1851)_eng.bc">(en)Murdock NT Peshitta(1851)</option>
<option value="'.$site.'English/Norton_NT_Peshitta(1851)_eng.bc">(en)Norton NT Peshitta(1851)</option>

<option value="'.$site.'German/Luther_Bibel_1545_l45_de.bc">(de)Luther Bibel(1545)</option>
<option value="'.$site.'German/Luther_Bibel_1912_l12_strongs_de.bc">(de)Luther Bibel(1912) w/Strongs</option>
<option value="'.$site.'German/luther_bibel_1912_l12_de.bc">(de)Luther Bibel(1912)</option>

<option value="'.$site.'Greek/Robinson_wStrongs_grk.bc">(gr)Robinson w/Strongs</option>
<option value="'.$site.'Greek/Greek_critical_comparison_grk.bc">(gr)Greek critical comparison</option>
<option value="'.$site.'Greek/SeptuagintAndGreekNT1550_TR-grk.bc">(gr)LXX and TR1550</option>
<option value="'.$site.'Greek/TR_1550_1894_wStrong_wLangNotes.grk.bc">(gr)TR(1894)Scrivener w/Strong and LangNotes</option>
<option value="'.$site.'Greek/TR_1550_Stephanus_wStrong.grk.bc">(gr)(TR)Textus Receptus(1550)Stephanus w/Strong</option>
<option value="'.$site.'Greek/TR_1550_Stephanus_wStrong_wLangNotes.grk.bc">(gr)TR(1550)Stephanus w/Strong and LangNotes</option>

<option value="'.$site.'Arabic/Smith_VanDyke-ar.bc">(ar) Vandyke</option>

<option value="'.$site.'Aramaic/Peshitta_arc.bc">(ac) Peshitta</option>

<option value="'.$site.'Strongs/eng3.sn">(strongs) English w/words1</option>
<option value="'.$site.'Norwegian/N30B-no.bc">(no)NBS1930(be aware)</option>
</select>
<select name="sitetoupload"><option value="">Generator</option>
<option value="tsk">TSK-crossreferences</option></select>
<select name="global"><option selected  value="1">Make Global?(Yes)</option><option value="2">No</option></select>';

//<option value="'.$site.'Modern_greek_translation-grk.bc">Modern greek translation</option>
?>