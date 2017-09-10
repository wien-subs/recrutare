<?php
require_once("config.php");
$status = @$_GET['status'];
$auth = @$_COOKIE['auth'];
$key = @$_COOKIE['key'];
function logout()
{
    global $sql, $key;
    $sql->query("UPDATE `user` SET `session`='false' WHERE `session`='$key' limit 1");
	setcookie("auth", false, time() - (86400 * 99), "/" );
	setcookie("key", false, time() - (86400 * 99), "/" ); 
}
if($status == "remove")
{
	$id = $_GET["id"];
	if(checklogin($auth, $key) == true)
	{
		$sql->query("DELETE FROM `teste` WHERE `id`='$id' limit 1");
    $usr = getuserbykey($key);
    addlog($usr, "was delete test with id $id", "recrutare");
		return header("Location: admin.php");
	}
	else
		logout();
}
function checklogin($auth, $key)
{
	global $sql, $url;
	$result = $sql->query("SELECT * FROM `user` WHERE `session`='$key'");
	if($result->num_rows == 1)
		return true;
	else
    {
      $sql->query("UPDATE `user` SET `session`='false' WHERE `session`='$key' limit 1");
      //header("Location: $url/login.php");
      echo '<meta http-equiv="refresh" content="1; url='.$url.'/login.php" />';
    }
}
if($status == "logout")
	logout();
if($status == "achange")
{
	$id = $_GET['id'];
	$value = $_GET['astatus'];
	$sql->query("UPDATE `teste` SET `status`='$value' WHERE `id`=$id");
	$data = $sql->query("SELECT * FROM `teste` WHERE `id`=$id");
	if($data->num_rows > 0)
	{
		while($row = $data->fetch_row())
		{
			$nume = $row["1"];
			$mail = $row["2"];
			$post = $row["4"];
		}
		sendinfomail($nume, $mail, $post, $value);
	}
}

function sendinfomail($nume, $mail, $post, $value)
{
	$to = $mail;
	$headers = "From: Recrutare@Wein-Subs.Ro" . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$subject = "Rezultat Testare $name [ $post ]";
	$message = "<html xmlns='https://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
</head>";
	$message = "<h1>Salut, $nume</h1>";
	$message .= "Aplicatia dumneavoastra a fost corectata si avem raspunsul aici.<br/>";
	$message .= "Rezultatul dumneavoastra : <b><u><h2>$value</h2></u></b><br/>";
	$message .= "<hr>Wien-Subs Staff &copy; 2016";
	mail($to, $subject, $message, $headers);
}
checklogin($auth, $key);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recrutare</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">W-S</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="admin.php">Admin <span class="sr-only">(current)</span></a></li>
        <li><a href="setting.php">Setting</a></li>
        <li><a href="manager.php">Users</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin.php?status=logout&key=<?=$key;?>">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
		<center style="margin-top: 10px;"><img src="img/logo.png" /></center>
		<div id='bs'>
<?php
if(checklogin($auth, $key) == true)
{
	if(!isset($_GET["limit"]))
		$limit = 5;
	else
		$limit = 99999;

		echo "<table class='table table-hover'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nume</th>
						<th>Mail</th>
						<th>Skype</th>
						<th>Post</th>
						<th>Status</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>";
	$result = $sql->query("select * from `teste` ORDER BY id DESC limit $limit");
	while($row = $result->fetch_row())
	{
		echo "<tr>
				<th scope='row'><a href='show.php?key=".$row["6"]."&admin=true'>".$row["0"]."</a></th>
				<td>".$row["1"]."
				<td>".$row["2"]."
				<td><a href='skype:".$row["3"]."?add' data-toggle='tooltip' title='Click pentru a adauga'>".$row["3"]."</a>
				<td>".$row["4"]."
				<td><form method='get' action='admin.php' ><input type='hidden' name='status' value='achange' /><input type='hidden' name='id' value='".$row["0"]."' /><select class='form-control' name='astatus' onchange='javascript: submit()'><option value='".$row["9"]."' selected>".$row["9"]."</option><option value='Acceptat'>Acceptat</option><option value='Respins'>Respins</option></select></form></td>
				<th scope='row'>";
				if($row["9"] == "Acceptat" || $row["9"] == "Respins" )
					echo "<center><span class='glyphicon glyphicon-ban-circle'></span></center>"; 
				else
					echo "<a href='admin.php?status=remove&id=".$row["0"]."'><center><span class='glyphicon glyphicon-remove'></span></center></a>";
				echo "</th>
			</tr>";
	}
	echo "</tbody></table>";
	if(!isset($_GET["limit"]))
		echo "<br/><center><h2><a href='admin.php?limit=999'>Load all data</a></h2></center><br/>";
    echo "<div class='tooltip top' role='tooltip'>
  <div class='tooltip-arrow'></div>
  <div class='tooltip-inner'>
    Click pentru a adauga
  </div>
</div>";
}
else
	echo "";
?>