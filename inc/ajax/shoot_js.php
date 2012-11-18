<?php
if(isset($_GET['a'])){$listagenstjs='?a';}
echo'<html><script>
var auto_refresh=setInterval(
function()
{$(\'#updatevis\').load(\'inc/ajax/admin_lastvisitor.php'.$listagenstjs.'\');}, 7000);
$(document).ready(function(){$(\'#updatevis\').load(\'inc/ajax/admin_lastvisitor.php'.$listagenstjs.'\')})
</script></html>';?>