<?php
require_once("config.php");
$id = stripslashes($_COOKIE["id"]);
$name = stripslashes($_POST["name"]);
$mail = stripslashes($_POST["mail"]);
$skype = stripslashes($_POST["skype"]);
$post = stripslashes($_POST["post"]);
$exp = stripslashes($_POST["exp"]);
$test = stripslashes($_POST["test"]);
$text = stripslashes($_POST["text"]);

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$text = strtr($text, [
  'Ș' => '&#536;',
  'ș' => '&#537;',
  'Ț' => '&#538;',
  'ț' => '&#539;',
  'Ă' => '&#258;',
  'ă' => '&#259;',
  'Â' => '&#194;',
  'â' => '&#226;',
  'Î' => '&#206;',
  'î' => '&#238;',
]);
	if($post == "traducator")
		$result = $sql->query("select * from `traducere` where `testid`='$test'");
	elseif($post == "verificator")
		$result = $sql->query("select * from `verificare` where `testid`='$test'");
	else
		$result  = 0;
	if($result->num_rows > 0)
	{
		$row = $result->fetch_row();
		$data = $row["2"];
	}
	else
	{
		$data = "null";
	}

	$to  =  "naihaz@wien-subs.ro";
	$headers = "From: facebook@wien-subs.ro" . "\r\n" .
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'Cc: florinmohican@wien-subs.ro' . "\r\n";
	$headers .= 'Bcc: harvujr@gmail.com' . "\r\n";
	$subject = "Cerere $name";
	$message = "<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
</head>";
	$message .= "id: $id <br/>";
	$message .= "name: $name <br/>";
	$message .= "mail: $mail <br/>";
	$message .= "skype: $skype <br/>";
	$message .= "postul dorit: $post <br/>";
	$message .= "experienta: $exp <br/>";
	$message .= "IP-Address: ".get_client_ip()." <br/>";
    // general data
	if($post == "traducator" || $post == "verificator")
	{
		$message .= "Testul : $test <br/>";
		$message .= "<hr/><hr/>$data<hr/><hr/>";
		$message .= "<h1>Testul tradus</h1><hr/>";
		$message .= "<pre>$text</pre>";
	}
	$message .= "<center>====End Of MAIL====</center>";
	mail($to, $subject, $message, $headers);
if(isset($mail))
{
	$header = "From: recrutare@wien-subs.ro" . "\r\n" .
	$header .= 'MIME-Version: 1.0' . "\r\n";
	$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$subjec = "Cerere $name";
	$messag = "<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
</head>";
	$messag .= "Poti intra pe https://wien-subs.ro/recrutare/show.php <br/>Pentru a vedea statusul cerereri, trebuie sa folosesti aceasta cheia pentru a te loga <br/><center>$id</center>";
	mail($mail, $subjec, $messag, $header);
}
	setcookie("already", true, time() + (86400 * 999), "/" );
	setcookie("specialkey", $id, time() + (86400 * 999), "/" );
  //die("insert into `teste` (`nume`, `mail`, `skype`, `post`, `exp`, `key`, `testid`, `testresult`) values ('$name', '$mail', '$skype', '$post', '$exp', '$id', '$test', \"$text\");");
	$sql->query("insert into `teste` (`nume`, `mail`, `skype`, `post`, `exp`, `key`, `testid`, `testresult`) values ('$name', '$mail', '$skype', '$post', '$exp', '$id', '$test', \"$text\");");
  addlog("System", "sent mail to $mail", "recrutare");
	header("Location: index.php?status=complet");

?>