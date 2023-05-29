<!-- nell'input possiamo specificare i file che sono accettati con accept=".jpg, .gif, ecc"-->
	

<?php

require_once 'auth.php';

if(checkAuth()){
	header("Location: home_session.php");
	exit;
}

if(!empty($_POST['username']) && !empty($_POST['password'])) //entreremo nel if solo se vi è un username e una password, quindi se vi sono possiamo connetterci al database
{
//ci stiamo connettendo al database  
$conn=mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['password'],$dbconfig['name']) or die(mysqli_error($conn));

$username=mysqli_real_escape_string($conn,$_POST['username']);
$query="SELECT * FROM users WHERE username ='$username'";
$res=mysqli_query($conn,$query) or die(mysqli_error($conn));
if(mysqli_num_rows($res)> 0){
	//ritornera una sola riga, che va bene perchè l'autentificazione va fatta per sigolo utente
	$entry=mysqli_fetch_assoc($res);
	/*la funzione aspetta come parametri:
	password_verify(password, hash)*/
	if(password_verify($_POST['password'], $entry['password'])){
		//se è vero allora possiamo impostare una sessione 
		$_SESSION["session_username"]=$entry["username"];
		$_SESSION["session_user_id"]=$entry["id"];
		header("Location: home_session.php");
		mysqli_free_results($res);
		mysql_close($conn);
		exit;

	}
}
//se l'utente non è stato trovato dalla query oppure la verifica della password non è andata a buon fine 
$error="Username e/o password errati";
}else if (isset($_POST['username']) || isset($_POST['password'])) {//se è stato impostato solo l'username o solo la password
	$error="Inserire username e password";
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signin</title>
  <link rel="stylesheet" href="style_signin.css?ts=<?=time()?>&quot">
  <script src="java_login.js" defer="true"  ></script>
</head>

<!--nome_input=cognome -->
<!--nome_input=email -->
<!--nome_input=password -->
<body>
<div id="flexitem">
    
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0DFCweWBd7C-rVfShhuJvBOCwIPNXIJgdPMX-6uhilsgpqSYlD7N5xk8xtlySsxVrGgU&usqp=CAU">
    <h3>Registrazione</h3>
</div>

<div id="div_form" enctype="multipart/form-data">     
    <form   method="post" >

  

     

      <div id="container_username">
    <label for="username">Username</label>
    <input type="text" name="username"  placeholder="inserisci il tuo username"<?php 
    if(isset($_POST['username'])){  echo "value=".$_POST['username'];} ?>>
<div class="mess_err"><span >Verifica l'inserimento: dati macanti o errati.</span></div>
      </div>

      <div id="container_password">
    <label for="password">Password </label>

    <!-- div che contiene il menu -->
<ul> <!-- lista principale: definisce il menu nella sua interezza -->
<li>
<input id="pass" type="password" name="password" placeholder="inserisci la tua password" <?php 
    if(isset($_POST['password'])){  echo "value=".$_POST['password'];} ?>> 
<span id="span_occhio"> <img id="occhiopass" src="hide_1.png"></span>

<div id=container_sub>
<label>&nbsp;<input id="sub" type="submit" value="Accedi"></label>
    </div> 
 

<div class="mess_err"><span >Verifica l'inserimento: dati macanti o errati.</span></div>
<ul> 
<li><span id="head">La password deve contenere:</span></li>
<li><span class="menu_tendina">almeno 8 caratteri,</span></li>
<li><span class="menu_tendina">almeno uno dei sequenti caratteri:!#$%£%&?@,</span></li>
<li><span class="menu_tendina">almeno un carattere maiuscolo,</span></li>
<li><span class="menu_tendina">almeno un carattere minuscolo,</span></li>
<li><span class="menu_tendina">almeno un numero.</span></li>
</ul> <!-- Fine del sotto-menu -->
</li> <!-- Chiudo il list-item -->
      </div>



<h3>Non hai un account? </h3>
          
      <a id="crea" href="registrazione.php">Registrati</a>
    </form>


</div>


</body>
</html>








	