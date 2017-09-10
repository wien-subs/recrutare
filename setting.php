<?php
require_once("config.php");
$status = @$_GET['status'];
$auth = @$_COOKIE['auth'];
$key = @$_COOKIE['key'];
function checklogin($auth, $key)
{
    global $sql, $url;
	$result = $sql->query("SELECT * FROM `user` WHERE `session`='$key'");
	if($result->num_rows == 1)
		return true;
	else
    {
        logout();
        //header("Location: $url/login.php");
		echo '<meta http-equiv="refresh" content="1; url='.$url.'/login.php" />';
        return false;
    }
}

function logout()
{
    global $sql, $key;
    $sql->query("UPDATE `user` SET `session`='false' WHERE `session`='$key' limit 1");
    setcookie("auth", false, time() - (86400 * 99), "/" );
    setcookie("key", false, time() - (86400 * 99), "/" ); 
}
if($status == "change")
{
	$id = $_GET['id'];
	$value = $_GET['astatus'];
  addlog(getuserbykey($key), "Change setting", "recrutare");
	$sql->query("UPDATE `setting` SET `value`='$value' WHERE `id`=$id");
}
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
    <script src="js/bootstrap.min.js"></script>
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
            <li><a href="admin.php">Admin</a></li>
            <li class="active"><a href="setting.php">Setting <span class="sr-only">(current)</span></a></li>
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
		echo "<table class='table table-hover'>
				<thead>
					<tr>
						<th>NO</th>
						<td>Setting</td>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>";
	$result = $sql->query("select * from `setting` ORDER BY id ASC");
	while($row = $result->fetch_row())
	{
		echo "<tr>
				<th scope='row'>".$row["0"]."</th>
                <td>".$row["1"]."</td>
				<th scope='row'><form method='get' action='setting.php' ><input type='hidden' name='status' value='change' /><input type='hidden' name='id' value='".$row["0"]."' /><select class='form-control' name='astatus' onchange='javascript: submit()'><option value='".$row["2"]."' selected>".$row["2"]."</option><option value='true'>True</option><option value='false'>False</option></select></form></th>
			</tr>";
	}
	echo "</tbody></table>";
}
else
	echo "";
?>