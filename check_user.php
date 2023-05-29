<?php



require_once 'dbconfing.php'

if(!isset($_GET["q"])){
	echo("non dovresti essere qui");
	exit;
}


header('Content_Type: application/json');
$conn=mysql_connect($dbconfin['host'],);
mysqli_real_escape($_GET["q"], manca un parametro)
  ?>