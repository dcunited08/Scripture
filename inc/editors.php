<?php // licence: gpl-signature.txt
    $jedit="";
  if ($mysettings[10]=='2'){
    if(!empty($gzip)){
    $jedit.='<script type="text/javascript" src="tiny_mce/tmcegzipcomb.js"></script>
<script type="text/javascript">
tinyMCE_GZ.init({
  themes : "advanced",
    width : "80%",
    height : "300",
    plugins : "fullpage,ccSimpleUploader,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
  theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
  theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,ccSimpleUploader,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
  theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
  theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_resizing : true,
    verify_html : false,
    cleanup : false,
    cleanup_on_startup : false,
    entity_encoding : "named",
    languages : "en",
    disk_cache : true,
    debug : false,
  relative_urls : false,
  file_browser_callback: "ccSimpleUploader",
  plugin_ccSimpleUploader_upload_path: "../../uploads/",                 
  plugin_ccSimpleUploader_upload_substitute_path: "tiny_mce/uploads/",
  mode : "textareas"});
</script>';}
else{
  $jedit.='<script type="text/javascript" src="tiny_mce/tmcecomb.js"></script>';
}
//$lim_size='class="tinymce"'; //combined_
  $jedit.='<script type="text/javascript">tinyMCE.init({
  theme : "advanced",
  width : "80%",
    height : "300",
  plugins : "fullpage,ccSimpleUploader,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
  theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
  theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,ccSimpleUploader,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
  theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
  theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_resizing : true,
    verify_html : false,
    cleanup : false,
    cleanup_on_startup : false,
    entity_encoding : "named",
  disk_cache : true,
  debug : false,
  relative_urls : false,
  file_browser_callback: "ccSimpleUploader",
  plugin_ccSimpleUploader_upload_path: "../../uploads/",                 
  plugin_ccSimpleUploader_upload_substitute_path: "tiny_mce/uploads/",
   mode : "textareas"});</script>';
   //$ckedit=' class="tinymce"  ';
   // ckeditor_comb.js ckeditor.js
  } elseif($mysettings[10]=='3') {
    $jedit2='<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>';
    $jedit='<script type="text/javascript">CKEDITOR.replace(\'content2\',{
	filebrowserBrowseUrl : \'ckeditor/ckfinder/ckfinder.html\',
	filebrowserImageBrowseUrl : \'ckeditor/ckfinder/ckfinder.html?type=Images\',
	filebrowserFlashBrowseUrl : \'ckeditor/ckfinder/ckfinder.html?type=Flash\',
	filebrowserUploadUrl : \'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files\',
	filebrowserImageUploadUrl : \'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images\',
	filebrowserFlashUploadUrl : \'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash\'
})</script>';
  //$editor.='<script type="text/javascript" src="tiny_mce/jquery-1.6.1.min.js"></script>';
  //$ckedit=' class="ckeditor" ';
  }
  ?>