<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signin</title>
	<link rel="stylesheet" href="stile_login.css">
	<script type="javascript.js"></script>
</head>



<body>
<div id="div_form"> 		
    <form  id="form" action="login_session.php" method="get">
		<label>Username<input type="text" name="username">  <!--nome_input=cognome -->
		</label>
		<label>E-mail<input type="email" name="email">  <!--nome_input=email -->
		</label>
		<label>Password<input type="password" name="password">  <!--nome_input=password -->
		</label>
		<label>&nbsp;<input type="submit"></label>
    </form>
</div>

</body>
</html>

<?php
$conn=mysqli_connect("localhost","root","","basedati") or die("Errore: ".mysqli_connect_error());
$query="SELECT * FROM users";

$res=mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));

while ($row=mysqli_fetch_row($res)) {
	print_r($row);
	}


c


?>
