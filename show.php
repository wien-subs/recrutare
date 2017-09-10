<?php
require_once("config.php");
$key = @$_GET['key'];
$admin = @$_GET['admin'];
function test($id, $post)
{
	global $sql;
    $id = $sql->real_escape_string($id);
	if($post == "traducator")
		$sqldo = "SELECT * FROM `traducere` WHERE testid=$id";
	else
		$sqldo = "SELECT * FROM `verificare` WHERE testid=$id";
	$result = $sql->query($sqldo);
	$row = $result->fetch_row();
	return $row["2"];
}
function name($id)
{
	global $sql;
    $id = $sql->real_escape_string($id);
	$result = $sql->query("SELECT * FROM `teste` WHERE `session`='$id'");
    if($result->num_rows == 1)
	{
        $row = $result->fetch_row();
        return $row["1"];
    }
    else
        return "@#$?@!%";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recrutare - <?=name($key);?></title>
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
<?
if($admin == true)
echo '<nav class="navbar navbar-default">
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin.php?status=logout">Logout</a></li>
        <li><a href="manager.php">Users</a></li>
      </ul>
    </div>
  </div>
</nav>';?>
		<center style="margin-top: 10px;"><a href="show.php"><img src="img/logo.png" /></a></center>
		<div id='bs'>
			<div id='hide'>
			<? if(!isset($key))
				echo"
			<form method='GET' action='show.php'>
			  <div class='form-group'>
				<label for='exampleInputEmail1'>Vrei sa iti vezi testul de traducator? Pune cheia aici si poti sa il vezi oricand!: </label>
				<center><input type='password' style='min-width:450px' class='form-control' name='key' placeholder='Your key' required='required' autocomplete='off' required></center>
			  </div>
			  <button type='submit' class='btn btn-default btn-danger'>Continua -></button>
			</form>";
			else
			{
                $key = $sql->real_escape_string($key);
				$result = $sql->query("select * from `teste` where `key`='$key'");
				if($result->num_rows > 0)
				{
					$row = $result->fetch_row();
                    $uid = $row["0"];
                    $huh = strlen($row["9"]);
					echo "<h2>Rezultatul aplicatiei: ".$row["9"]."</h2><hr/>";
					echo "Numele: ".$row["1"]."<br/>";
					echo "Mail: ".$row["2"]."<br/>";
					echo "Skype: ".$row["3"]."<br/>";
					echo "Functie: ".$row["4"]."<br/>";
					echo "Experienta: ".$row["5"]."<br/>";
					echo "Key: ".$row["6"]."<br/>";
					if($row["4"] == "traducator" || $row["4"] == "verificator")
					{
						echo "TestID: ".$row["7"]."<br/>";
						echo "Test in engleza: <pre>".test($row["7"],$row["4"])."</pre><br/>";
						echo "Test Result(from user): <pre>".$row["8"]."</pre><hr/>";
					}
                    if($admin == true && $huh == strlen("In asteptare"))
                        echo "<button type='button' class='btn btn-success'><a href='admin.php?status=achange&achane=Acceptat&id=$uid'>Acceptat</a></button> <button type='button' class='btn btn-danger'><a href='admin.php?status=achange&achane=Respins&id=$uid'>Respins</a></button>";
				}
				else
					echo "<center><h1 style='color:#F44336'><b>Imi pare rau dar nu am gasit nici un test cu acesta cheie.<br/>$key</b></h1></center>";
			}
?>
			</div>
		</div>
  </body>
</html>