<?php


require_once 'auth.php';


if(checkAuth()){ //se è vero !=0
header("Location: home_session.php");
exit;
}

//Verifichiamo se i campi sono pieni 
//lo dobbiamo fare per tutti i campi tranne l'immagine

if(!empty($_POST['username']) &&  !empty($_POST['password']) && !empty($_POST['email']) &&  !empty($_POST['nome']) &&  !empty($_POST['cognome']))
		{  // entriamo nel if solo se sono presenti valori di tutti i campi

	    $error=array();
		  $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'],$dbconfig['name']) or die(mysql_error($conn));

		  //controllo username 
		  //  i 2 slash '/.../' servono per escudere i caratteri speciali,l'esperssione  [a-zA-Z0-9_] permette di incluedere tutti i caratteri che vanno dalla a alla z indistintamente dal fatto che siano caratteri in maiuscolo o meno e tutti i numeri da 0 a 9, la stringa può essere  minimo 1 massimo 15 caratteri
		  if(!preg_match('/[a-zA-Z0-9_]{1,15}$/', $_POST['username']))
				{
				$error[]="Username non valido";
				}
						else  
								{
								$username=mysqli_real_escape_string($conn,$_POST['username']);
								$query="SELECT username FROM users WHERE username='$username'";
								$res=mysqli_query($conn,$query);
								if(mysqli_num_rows($res)>0)
									{	
									 //se ritorna un valore vuol dire che già esiste un utente con questo username
									 $error[]="Username già in uso";
									}
					  		}

									#password la password dovra essere minimo 8 caratteri Nota: operatore + almeno una o più occorrenze
									if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!#$%£%&?@])(?=.*[a-zA-Z0-9]).{8,}$/',$_POST['password']))
                    //   /\W/
										{
											$error[]="La password deve contenere:
	 										almeno 8 caratteri,
	 										almeno uno dei sequenti caratteri:!#$%£%&?@,
							  				almeno un carattere maiuscolo,
							  				almeno un carattere minuscolo,
							  				almeno un numero.";
										}

											#conferma password
										//strcmp() Restituisce -1 se string1 è minore di string2; 1 se stringa1 è maggiore di stringa2 e 0 se sono uguali.
											if(strcmp($_POST['password'],$_POST['conferma_password'])!=0)
												{
													$error[]="Le due password non coincidono";
												}
										//EMAIL
 	 									//La funzione filter_var() filtra una variabile con il filtro specificato. In questo caso il filtro è FILTER_VALIDATE_EMAIL che verifica se il valore è un indirizzo di posta elettronica valido.
											if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
												{
													$error[]="Indirizzo email non valido.";
												}
													else
													{
														//per sicurezza converiamo l'email in minuscolo
														$email=mysqli_real_escape_string($conn,strtolower($_POST['email']));
														//dobbiamo verificare se l'email è già presente nel database
														$query="SELECT email FROM users WHERE email='$email'";
														$res=mysqli_query($conn,$query)  or die(mysqli_error($conn));
															if(mysqli_num_rows($res)>0)
															{
																//se ritorna almeno un valore vuol dire che l'email è già presente 
																$error[]="L'email è gia presente!";
															}
												 	}


	

#caricamento immagine del profilo


#per verificare che non ci sono errori usiamo il comando:
/*if(count($error) == 0){
	if ($_FILES['immagine']['size']!=0) {
		$file=$_FILES['immagine'];
		$tipo
	}
}
//Per l'immagine verificiamo che l'estenzione sia corretta se questa è corretta con l'istruzione 
$allowedExt=array(IMAGETYPE_PNG  => 'png', IMAGETYPE_JPEG => 'jpeg')



  verifichiamo se gli errori sono pari a zero con il comando if($file['error']===0) se è vero verifichiamo la dimensine del immagine con if($file['size'] <7000000){
	$fileNameNew=uniqid('',true) ."."
}
*/


//SIGNIN nel DB

if(count($error)==0 )
{
	$name=mysqli_real_escape_string($conn,$_POST['nome']);
  $surname= mysqli_real_escape_string($conn,$_POST['cognome']);
 	$password=mysqli_real_escape_string($conn,$_POST['password']);
  //non memorizziamo la chiave in chiaro ma la criptiamo con la funzione password_hash()
	$password=password_hash($password, PASSWORD_BCRYPT);
	$query="INSERT INTO users(username, password, email, name, surname) VALUES('$username','$password','$email','$name','$surname')";
if(mysqli_query($conn,$query)){
  $_SESSION['session_username']=$_POST['username'];
$_SESSION['session_user_id']=mysqli_insert_id($conn);
mysqli_close($conn);
header("Location: home_session.php");
exit;
}
  else{
    $error[]="Errore durante la connesione al Database ";
  }
}
mysqli_close($conn);
		}
    else if(isset($_POST['username']) /*|| isset($_POST['nome']) || isset($_POST['cognome']) || isset($_POST['email']) || isset($_POST['password'])*/){
      $error=array("Riempi tutti i campi");
    }
?>


 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signin</title>
  <link rel="stylesheet" href="style_signin.css?ts=<?=time()?>&quot">
  <script src="java_signin.js" defer="true"  ></script>
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

      <div id="container_nome">
    <label for="nome">Nome</label>
        <input type="text" name="nome" placeholder="inserisci il tuo nome"
         <?php if(isset($_POST['nome'])){echo "value=".$_POST['nome']; } ?>> 
         <div class="mess_err"><span >Verifica l'inserimento: dati macanti o errati.</span></div>
      </div>

      <div id="container_cognome">
    <label for="cognome">Cognome</label>
    <input type="text" name="cognome" placeholder="inserisci il tuo cognome"<?php 
    if(isset($_POST['cognome'])){  echo "value=".$_POST['cognome'];} ?>>
<div class="mess_err"><span >Verifica l'inserimento: dati macanti o errati.</span></div>
      </div>

      <div id="container_username">
    <label for="username">Username</label>
    <input type="text" name="username"  placeholder="inserisci il tuo username"<?php 
    if(isset($_POST['username'])){  echo "value=".$_POST['username'];} ?>>
<div class="mess_err"><span >Verifica l'inserimento: dati macanti o errati.</span></div>
      </div>

      <div id="container_email">
    <label for="email">Email</label>
    <input type="email" name="email" placeholder="inserisci la tua email"<?php 
    if(isset($_POST['email'])){  echo "value=".$_POST['email'];} ?>>   
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

      <div id="container_confermapassword">
<label for="conferma_password">Conferma password</label>
    <input type="password" name="conferma_password"  <?php 
    if(isset($_POST['conferma_password'])){  echo "value=".$_POST['conferma_password'];} ?>>   
<span id="span_occhio"> <img id="occhioconf" src="hide_1.png"></span>
      </div>

 <label>&nbsp;<input id="sub" type="submit" value="Registrati"></label>


    </form>


</div>

</body>
</html>




