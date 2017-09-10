<?php
require_once("config.php");
$id = stripslashes($_COOKIE["id"]);
$name = stripslashes($_POST["name"]);
$mail = stripslashes($_POST["mail"]);
$skype = stripslashes($_POST["skype"]);
$post = stripslashes($_POST["post"]);
$exp = stripslashes($_POST["exp"]);
$key = stripslashes($_POST["key"]);
$key1 = $_COOKIE["id"];
if($key !== $key1)
{
	header("Location:index.php?status=nokey");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recrutare</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<center style="margin-top: 10px;"><img src="img/logo.png" /></center>
		<div id='bs'>
			<div id='hide'><center>
			<pre><b>
Pentru a da proba pentru alt/e post/uri esti rugat sa îi anunti pe urmatorii:
Naihaz - pentru traducator (skype - dinu.marian90)
Harvu - pentru verificator (skype - harvujr)
Fmohican - pentru encoder si uploader (skype - fmohican12)
			</b></pre></center>
<?
echo "<h3>Bun, te numesti $name si vrei sa fii $post . Sa vedem ce poti face.</h3><hr/>";
if($post == "traducator")
{
	$test = rand(1,3);
	$result = $sql->query("select * from `traducere` where `testid`='$test'");
	if($result->num_rows > 0)
	{
		$row = $result->fetch_row();
		$test = $row["1"];
		$text = strtr($row["2"], [
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
		echo "Bun am dat cu zaru si a picat testul ".$row["1"].". Mult success!";
		echo "<center><h2>Folositi diactitice!</h2></center>";
		echo "<div style='word-break: keep-all;'>".$text."</div>";
		echo "
			<form action='mail.php' method='POST'>
				<div class='form-group'>
				<label for='exampleInputEmail1'>Traducere:</label>
				<textarea class='form-control' rows='3' name='text' type='text' required='required' autocomplete='off' required></textarea>
				</div>
				<input type='hidden' name='id' value='$id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='mail' value='$mail'>
				<input type='hidden' name='skype' value='$skype'>
				<input type='hidden' name='post' value='$post'>
				<input type='hidden' name='exp' value='$exp'>
				<input type='hidden' name='test' value='$test'>
				<button type='submit' class='btn btn-default btn-danger'>Trimite Aplicatia</button>
			</form>
			";
	}
	else
		echo "<h1>NO DATA</h1>";
}
if($post == "verificator")
{
	$test = rand(1,3);
	$result = $sql->query("select * from `verificare` where `testid`='$test'");
	if($result->num_rows > 0)
	{
		$row = $result->fetch_row();
		$test = $row["1"];
		$text = strtr($row["2"], [
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
		echo "Bun am dat cu zaru si a picat testul ".$row["1"].". Mult success!";
		echo "<center><h2>Folositi diactitice!</h2></center>";
		echo "<p class='help-block'>Nota: Greselile de ortografie, exprimare si lipsa diacritice sunt facute intentionat. NU ESTE O EROARE. Ati aplicat pentru verificator.</p>";
		echo "<div style='word-break: keep-all;'>".$text."</div>";
		echo "
			<form action='mail.php' method='POST'>
				<div class='form-group'>
				<label for='exampleInputEmail1'>Traducere:</label>
				<textarea class='form-control' rows='3' name='text' type='text' required='required' autocomplete='off' required></textarea>
				</div>
				<input type='hidden' name='id' value='$id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='mail' value='$mail'>
				<input type='hidden' name='skype' value='$skype'>
				<input type='hidden' name='post' value='$post'>
				<input type='hidden' name='exp' value='$exp'>
				<input type='hidden' name='test' value='$test'>
				<button type='submit' class='btn btn-default btn-danger'>Trimite Aplicatia</button>
			</form>
			";
	}
	else
		echo "<h1>NO DATA</h1>";
}
if($post == "tmanga")
	echo "Te contactam noi pentru test.
			<form action='mail.php' method='POST'>
				<input type='hidden' name='id' value='$id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='mail' value='$mail'>
				<input type='hidden' name='skype' value='$skype'>
				<input type='hidden' name='post' value='$post'>
				<input type='hidden' name='exp' value='$exp'>
				<button type='submit' class='btn btn-default btn-danger'>Trimite Aplicatia</button>
			</form>";
if($post == "emanga")
	echo "Te contactam noi pentru test.
			<form action='mail.php' method='POST'>
				<input type='hidden' name='id' value='$id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='mail' value='$mail'>
				<input type='hidden' name='skype' value='$skype'>
				<input type='hidden' name='post' value='$post'>
				<input type='hidden' name='exp' value='$exp'>
				<button type='submit' class='btn btn-default btn-danger'>Trimite Aplicatia</button>
			</form>";
if($post == "encoder")
	echo "Te contactam noi pentru test.
			<form action='mail.php' method='POST'>
				<input type='hidden' name='id' value='$id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='mail' value='$mail'>
				<input type='hidden' name='skype' value='$skype'>
				<input type='hidden' name='post' value='$post'>
				<input type='hidden' name='exp' value='$exp'>
				<button type='submit' class='btn btn-default btn-danger'>Trimite Aplicatia</button>
			</form>";
if($post == "uploader")
	echo "Ok! Te vom contacta cat de curand pentru a discuta despre functia de uploader. Te rog apasa pe 'Trimite Aplicatia' pentru a finaliza cererea.
			<form action='mail.php' method='POST'>
				<input type='hidden' name='id' value='$id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='mail' value='$mail'>
				<input type='hidden' name='skype' value='$skype'>
				<input type='hidden' name='post' value='$post'>
				<input type='hidden' name='exp' value='$exp'>
				<button type='submit' class='btn btn-default btn-danger'>Trimite Aplicatia</button>
			</form>";
if($post == "webdev")
	echo "Ok! Te vom contacta cat de curand pentru a discuta despre detalii. Te rog apasa pe 'Trimite Aplicatia' pentru a finaliza cererea.
			<form action='mail.php' method='POST'>
				<input type='hidden' name='id' value='$id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='mail' value='$mail'>
				<input type='hidden' name='skype' value='$skype'>
				<input type='hidden' name='post' value='$post'>
				<input type='hidden' name='exp' value='$exp'>
				<button type='submit' class='btn btn-default btn-danger'>Trimite Aplicatia</button>
			</form>";
?>