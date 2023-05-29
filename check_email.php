<?php 

require_once 'dbconfig.php';


if(!isset($_GET["q"])){
	echo "Errore parametro mancante ";
	exit;
}


header('Content_Type: application/json');

$conn=mysqli_connect($dbconfig["host"],$dbconfig["user"],$dbconfig["password"],$dbconfig["name"]) or die(mysqli_error($conn));

$email=mysqli_real_escape_string($conn,$_GET["q"]);

$query="SELECT email FROM users WHERE email='$email'";

$res=mysqli_query($conn,$query);

if(mysqli_num_rows($res) > 0){

echo json_encode(array('exists' => mysqli_num_rows($res));

}

/*echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));*/

mysql_close($conn);
 ?>