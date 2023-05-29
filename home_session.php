<?php
require_once 'auth.php';
if(!checkAuth()){
header("Location: login_session.php");
  exit;
}
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <script defer='true' src="fetchJava.js"  ></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link rel="stylesheet"  href="style_home.css?ts=<?=time()?>&quot">
</head>
<body>
  <div class="menu">
    <div id="containe_hover">
      <p class="etic_vert">Hover me</p>
    </div>

    <ul>
      <li id="primo"><a href="profilo.php">Profilo</a></li>
      <li id="secondo"><a href="preferiti.php">Preferiti</a></li>
     <!-- <li><a href="#">Anime</a></li>
      <li><a href="#">Personaggi</a></li>
      <li><a href="#">Eventi</a></li>-->
    </ul>
  </div>
  <nav>
    <div id="container-botton">  
    <a id="bott_sig"href="registrazione.php">Registrati</a> <a id="bott_login"href="login_session.php">Accedi</a><a id="bott_logout"href="logout_session.php">Esci</a>
    </div>
  </nav>
  <div class="container_home">
    <section>
      
    <h1>Benvenuto nella Homepage di OnFood</h1>
    <!--<p>Benvenuto, inizia subito a condividere e leggere le recenzioni dei manga che ti piacciono.</p>-->
    

<h2>Cerca il cibo che vuoi:</h2>
    <div id="container_form">

    <form>
      
      <label> <input type='text' name = 'content' id ='content'></label>  
      
      <label>&nbsp;<input type='submit' id="submit"></label>
       
    </form>
      <div id="mess_err">
         <span id="err">Per effettuare la ricerca è necessario fornire il nome dell'ingrediente.</span>
       </div>  
    </div>

<div id="album">
          <ul id="griglia" class="img_json" >
<li><a href="login_session.php"><img class="img_json" src="" >
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="" >
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
<li><a href="login_session.php"><img class="img_json" src="">
<span class="etichetta">prova</span></a>
</li> 
</ul>
    </div>
    </section>
  </div>
<div id="modale">

</div>
</body>
</html>
