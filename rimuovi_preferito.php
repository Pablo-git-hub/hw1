<?php 

require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_session.php");
        exit;
    }


$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
  if (!$conn) {
        die("Connessione al database fallita: " . mysqli_connect_error());
    }

    $preferitoSRC = mysqli_real_escape_string($conn,$_POST['preferitoSRC']);

    $userid = mysqli_real_escape_string($conn, $_SESSION['session_user_id']);
    // Esegui la query per rimuovere l'elemento dalla tabella dei preferiti
    $query = "DELETE  FROM preferiti WHERE image = '$preferitoSRC' AND user = '$userid'";
    

    echo($preferitoID);
    


// Ottieni i dati inviati tramite la richiesta AJAX


if ($conn->query($query) === TRUE) {
    // Inserimento riuscito
    echo "Dati eliminati  correttamente dal database.";
} else {
    // Errore durante l'inserimento
    echo "Errore durante il salvataggio dei dati nel database: " . $conn->error;
}












 ?>
