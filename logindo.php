<?php
require_once("config.php");
$status = @$_POST["status"];
if($status == "dologin")
{
	$user = $sql->real_escape_string($_POST['user']);
	$pass = $sql->real_escape_string($_POST['pass']);
	$pass = hash("md5", $pass);
	$result = $sql->query("SELECT * FROM `user` WHERE `username`='$user' AND `password`='$pass'");
	if($result->num_rows == 1)
	{
        $key = rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).$user.rand(1,9).rand(1,9).rand(1,9).$pass.rand(1,9).rand(1,9).rand(1,9);
        $key = md5($key);
		setcookie("auth", true, time() + (86400 * 2), "/" );
		setcookie("key", $key, time() + (86400 * 2), "/" );
        $sql->query("UPDATE `user` SET `session`='$key' WHERE `username`='$user'");
        header("Location: admin.php");
		echo '<meta http-equiv="refresh" content="1; url='.$url.'/admin.php" />';
	}
	else
    {
        header("Location: $url/login.php?status=error");
		echo '<meta http-equiv="refresh" content="1; url='.$url.'/login.php?status=error" />';
    }
}
?>