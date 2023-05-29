<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_session.php");
        exit;
    }

    


       // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>




<!DOCTYPE html>
<html>
<head>
    <script src="profilo.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="profilo.css">
     <link href="https://fonts.googleapis.com/css?family=Pangolin:400,700|Proxima+Nova" rel="stylesheet" type="text/css">   
    <title>Musity - </title>
   </head>
<body>
<div class="container">
    <div class="main">
        <div class="topbar">
 <a href="logout_session.ph">Esci</a>
 <a href="home_session.php">Home</a>
 <a href="preferiti.php">Preferiti</a>
</div>
<div class='row'>
    <div class="col-md4-4">
        <div  class="card_text-center sidebar">
            <div class="card-body">
                <img src="" class="cerchio_rotondo">
                <div class="mt-3">
                    <h3>Profilo Utente</h3>
                    <a href=""></a>
                    <a href=""></a>
                    <a href=""></a>
                    <a href=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="card mb-3 content">
        <h1 class="m-3 pt-3">about </h1>
        
          <div class="row">
            <div class="col-md-3">
                <h5>Nome e Cognome:</h5>
            </div>
            <div class="col-md-9"><?php echo $userinfo['name'] . " " . $userinfo['surname']; ?></div>
          </div>
          <hr>
          <div class="row">
              <div class="col-md-3">
                  <h5>Email:</h5>
              </div>
              <div class="col-md-9">
                  <?php echo $userinfo['email']?>
              </div>
          </div>
          <hr>
          <div class="row">
               <div class="col-md-3">
                  <h5>Username:</h5>
              </div>
              <div class="col-md-9">
                  <?php echo $userinfo['username']?>
              </div>
          </div>
   
    </div>
</div>
    </div>

    </div>


</div>
   
</body>
<html>

<?php mysqli_close($conn); ?>