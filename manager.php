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
        header("Location: $url/login.php");
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

if($status == "logout")
	logout();
checklogin($auth, $key);
if($status == "add")
{
    $user = $_GET['user'];
    $pass = $_GET['pass'];
    $pass = hash("md5", $pass);
    $agree = $_GET['agree'];
    if($agree == 'true')
    {
        $sql->query("INSERT INTO `user` (`username`, `password`) VALUES ('$user', '$pass')");
        addlog(getuserbykey($key), "was add user $user ", "system");
        header("Location: $url/manager.php");
    }
}
if($status == "remove")
{
    $id = $_GET['id'];
    $sql->query("DELETE FROM `user` WHERE `id`=$id");
    header("Location: $url/manager.php");
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
        <li><a href="admin.php">Admin</a></li>
        <li><a href="setting.php">Setting</a></li>
        <li class="active"><a href="manager.php">Users <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin.php?status=logout&key=<?=$key;?>">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
		<center style="margin-top: 10px;"><img src="img/logo.png" /></center>
		<div id='bs'>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Users Existent
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
<?php
		echo "<table class='table table-hover'>
				<thead>
					<tr>
						<th>ID</th>
						<td>Username</td>
						<th>Remove?</th>
					</tr>
				</thead>
				<tbody>";
	$result = $sql->query("select * from `user` ORDER BY id ASC");
	while($row = $result->fetch_row())
	{
		echo "<tr>
				<th scope='row'>".$row["0"]."</th>
                <td>".$row["1"]."</td>
				<th scope='row'><a href='manager.php?status=remove&id=".$row["0"]."'>Delete</a></th>
			</tr>";
	}
	echo "</tbody></table>";
?>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Add new user
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <center><form method='GET' action='manager.php'>
                      <div class="form-group">
                        <label>Username: </label>
                        <input type="text" name='user' placeholder="Username" class="form-control" readonly onfocus="this.removeAttribute('readonly');">
                      </div>
                      <div class="form-group">
                        <label>Password: </label>
                        <input type="password" name='pass' placeholder="Password" class="form-control" readonly onfocus="this.removeAttribute('readonly');">
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name='agree' value='true' required> <span style="color:red;font-width:900;">Inteleg ca acest utilizator va avea access la intreg sistemul de recrutare</span>
                        </label>
                      </div>
                      <button type="submit" class="btn btn-default" name='status' value='add'>Adauga</button>
                    </form></center>
                  </div>
                </div>
              </div>
            </div>