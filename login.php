<?php
require_once("config.php");
@$status = $_GET["status"];
setcookie("auth", false, time() - (86400 * 99), "/" );
setcookie("key", false, time() - (86400 * 99), "/" ); 
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
		<center style="margin-top: 10px;"><img src="img/logo.png" /></center>
<?php
if($status == "error")
    echo '<center><div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> You provide an worng id and password. Please double check before send.
            </div></center>';
?>
		<div id='bs'>
            <center>
			<form method='POST' action='logindo.php' autocomplete="off" id="loggin">
			<input type='hidden' name='status' value='dologin'>
			  <div class='form-group'>
				<label for='exampleInputEmail1'>Username: </label>
				<input id='id' type='text' class='form-control' readonly onfocus="this.removeAttribute('readonly');" name='user' placeholder='Username' required='required' autocomplete='off' required>
			  </div>
			  <div class='form-group'>
				<label for='exampleInputEmail1'>Password: </label>
				<input id='pass' type='password' class='form-control' readonly onfocus="this.removeAttribute('readonly');" name='pass' placeholder='Password' required='required' autocomplete='off' required>
			  </div>
			  <button type='submit' class='btn btn-default btn-danger'>Login</button>
			</form>
            </center>
            <script type="text/javascript">
                $('#pass').attr('autocomplete','off');
                $('#id').attr('autocomplete','off');
              document.getElementById("loggin").reset();
            </script>
        </div>
    </body>
</html>