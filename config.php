<?php
$url = "";
$sql = new mysqli("", "", "", "");
if ($sql->connect_error) {
    die('Connect Error (' . $sql->connect_errno . ') '
            . $sql->connect_error);
}

function getuserbykey ($key){
  global $sql;
	$result = $sql->query("SELECT * FROM `admin` WHERE `session`='$key'");
	if($result->num_rows == 1)
		$row = $data->fetch_row();
    return $row["1"];
}

function addlog($user, $action, $at){
    global $sql;
    $user = strtolower($user);
    $action = strtolower($action);
    $data = date("d-m-Y [H:i]");
    $at = strtolower($at);
    $result = $sql->query("INSERT INTO `logs` (`user`, `action`, `data`, `at`) VALUES ('$user', '$action', '$data', '$at')");
}
?>