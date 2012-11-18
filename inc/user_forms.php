<?php // licence: gpl-signature.txt <input type="submit" name="log" value="Recover">
echo '<form action="" method="post" enctype="multipart/form-data"><u>Login</u><br>
        Username: <input type="text" name="loguser" value="">
        Password: <input type="password" name="logpass" value="">
        <input type="submit" name="log" value="Login"></form>'.

        '<form action="" method="post" enctype="multipart/form-data"><u>Register</u><br>
        <input type="hidden" name="regipass" value="'.$passwd.'">
        Username: <input type="text" name="regiuser" value="">
        Email: <input type="text" name="regiemail" value="">
        <input type="submit" value="Register"></form>'.

        '<form action="" method="post" enctype="multipart/form-data"><u>Lost Password</u><br>
        <input type="hidden" name="forgot" value="1">
        Username: <input type="text" name="regiuser" value="">
        Or Email: <input type="text" name="regiemail" value="">
        <input type="submit" value="Forgot Password"></form>';
?>