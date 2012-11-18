<?php // licence: gpl-signature.txt
if (isset($_POST['reconfiguredatabase'])) {
  $username=$_POST['username'];$password=$_POST['password'];$database=$_POST['database'];$database_host=$_POST['$database_host'];$sqlconnect = "1";
  require('updater.php');
}
if(isset($_GET['reconfiguredatabase'])) { $reconfiguredatabase=urldecode($_GET['reconfiguredatabase']); }
  elseif(isset($_POST['reconfiguredatabase'])) { $reconfiguredatabase=urldecode($_POST['reconfiguredatabase']); }
if (empty($_POST['reconfiguredatabase']) && ($username == 'databaseusername')) {
	    echo "Welcome to Scripture4PHP. Enter your database settings to continue, and click install.<br>
		<form action='index.php' method='post'><input type='hidden' name='tools' value='1'><input type='hidden' name='mydata' value='4'><input type='hidden' name='reconfiguredatabase' value='1'><input type='hidden' name='install' value='1'>
		Adress:<input type='text' name='database_host'>
		<br>Database:<input type='text' name='database'>
		<br>Username:<input type='password' name='username'>
		<br>Password:<input type='password' name='password'>
		<br>Website email:<input type='text' name='website_email'>
		<br>Website email name:<input type='text' name='mailer_name'>
		<br>Check to create database:<input type='checkbox' name='create' value='1'>
		<br>If SMTP, type in the following:
		<br>SMTP Host:<input type='text' name='smtphost'>
		<br>SMTP Username:<input type='text' name='smtpuser'>
		<br>SMTP Password:<input type='password' name='smtppass'>
		";
		
	    if (!empty($firsttime)) {
	      echo "<br>Your administration accunt:
		    <br>Username:<input type='text' name='usernameadmin'>
		    <br>Password:<input type='password' name='passwordadmin'>
		    <br>Email:<input type='password' name='emailadmin'>";
	    }
	    echo "<br><input type='submit' value='Install'></form>";
	    $no_sqlconnect = '1';
	    //echo "Database update downloaded: <a href='".$_SERVER['PHP_SELF']."?tools=1&mydata=4&reconfiguredatabase=1'>Database needs to be reconfigured, click here to do so</a><br>";
}

?>