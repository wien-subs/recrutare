<?php
require_once("config.php");
$rand = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
$rand = md5(rand(0,9).rand(0,9).rand(0,9).rand(0,9).$rand.rand(0,9).rand(0,9).rand(0,9));
setcookie("id", $rand, time() + (86400 * 2), "/" );
$already = @$_COOKIE["already"];
$specialkey = @$_COOKIE["specialkey"];
if($already == true)
die("<head><link href='css/style.min.css' rel='stylesheet'></head><center><h1 style='color:whitesmoke'>APLICATIE TRIMISA VA ROG ASTEPTATI RASPUNUL<hr/>Poti intra pe <a style='color:aqua' href='http://wien-subs.ro/recrutare/show.php'>http://wien-subs.ro/recrutare/show.php</a> pentru a iti vedea aplicatia folosind cheia asta<hr/><b>$specialkey</b></h1></center>");
$status = @$_GET["status"];
if($status == "complet")
die("<center><h1>APLICATIE TRIMISA VA ROG ASTEPTATI RASPUNUL</h1></center>");
if($status == "nokey")
die("<center><h1>Incerca din nou.</h1></center>");
function isenable($id)
{
    global $sql;
	$result = $sql->query("select * from `setting` WHERE `id`=$id");
	$row = $result->fetch_row();
    if($row["2"] == "false")
        return "disabled";
    else
        return "enable";
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
		<center style="margin-top: 10px;"><a href="http://wien-subs.ro"><img src="img/logo.png" /></a></center>
		<div id='bs'>
          <? if(isenable(0) == "disabled")
                die("<center><h1>NU SE MAI FAC RECRUTARI</h1></center></div></body></html>");?>
			<div id='hide'>
			<form method='POST' action='2nd.php'><center>
			  <div class="form-group">
				<label for="exampleInputEmail1">Nume (nickname): </label>
				<input type="text" class="form-control" id="exampleInputEmail1" name='name' placeholder="Your nickname" required="required" autocomplete="off" required>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">Mail (optional):</label>
				<input type="email" class="form-control" id="exampleInputEmail1" name='mail' placeholder="Enter email" required="required" autocomplete="off">
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">Skype:</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name='skype' placeholder="Skype ID" autocomplete="off" required>
			  </div></center>
			  <hr/>
			  <center>Ce post doresti sa ocupi? :</center>
				<div class="radio">
				  <label>
					<input type="radio" name="post" id="optionsRadios1" value="traducator" checked <?=isenable(1);?>>
					Traducator
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="post" id="optionsRadios1" value="tmanga" <?=isenable(6);?>>
					Traducator Manga
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="post" id="optionsRadios2" value="verificator" <?=isenable(2);?>>
					Verificator
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="post" id="optionsRadios2" value="encoder" <?=isenable(3);?>>
					Encoder (Experienta nu este necesara, Te invatam noi)
					<p class="help-block">Aveti nevoie de un calculator puternic.</p>
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="post" id="optionsRadios2" value="emanga" <?=isenable(7);?>>
					Editor Manga (Experienta nu este necesara, Te invatam noi)
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="post" id="optionsRadios2" value="uploader" <?=isenable(5);?>>
					[Uploader / Packer] - Limited Edition (Experienta nu este necesara, te invatam noi)
					<p class="help-block">Aveti nevoie de viteza mare de upload si spatiu de stocare</p>
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="post" id="optionsRadios2" value="webdev" <?=isenable(8);?>>
					Web Developer - Limited Edition
					<p class="help-block">Cunoștine PHP & MySQL & JS chiar si cele de baza sunt foarte bune</p>
				  </label>
				</div>
				<hr/>
			  <div class="form-group">
				<label for="exampleInputEmail1">Experienta:</label>
				<center><textarea class="form-control" style='min-width:350px;' rows="3" name="exp" type="text" required="required" autocomplete="off" required>Nu am experienta, dar sunt dornic sa invat.</textarea></center>
			  </div>
			  <div class="center-block"><b>Prin continuarea acestei probe înteleg ca trebuie sa traduc ( daca aplic pentru traducator ) minim un episod pe saptamâna si de asemenea ca voi prelua o serie de la suspendate sau cereri.</b></div><hr/>
			  <input type="hidden" value="<? echo $rand;?>" name="key">
			  <button type="submit" class="btn btn-default btn-danger">Continua -></button>
			</form>
			</div>
		</div>
  </body>
</html>