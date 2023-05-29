
<?php

require_once 'dbconfig.php'; 

session_start();

function checkAuth(){

	
	if(isset($_SESSION["session_user_id"]))
	{
	
		return $_SESSION["session_user_id"];
	}
	else{
		return 0;
	}
					}
  ?>
	<!--check Auth serve per verificare la presenza di una sessione se esiste la ritorna altrimenti ritorna zero.-->