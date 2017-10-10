<?php
 session_start();

echo "Failed logins"."<br/>";
echo "Count:".count($_SESSION['report'])."<br/>";
$reportarray = $_SESSION['report'];
foreach($reportarray as $x => $x_value){

	echo "username:".$x." password:".$x_value."<br/>";
}
?>
