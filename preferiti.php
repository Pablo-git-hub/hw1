
<?php
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header("Location: login_session.php");
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

// Controlla la connessione al database
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Inizializza una sessione (assicurati di chiamare questa funzione all'inizio dello script)

// Ottieni i dati inviati tramite la richiesta AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Prepara i dati per l'inserimento nella tabella dei preferiti
if ($data) {
    $name = mysqli_real_escape_string($conn, $data['name']);
    $image = mysqli_real_escape_string($conn, $data['image']);
    $userid = mysqli_real_escape_string($conn, $_SESSION['session_user_id']);

    if ($name != null && $image != null) {
        // Esegui la query per verificare se esiste già una riga con i valori specificati
        $checkQuery = "SELECT * FROM preferiti WHERE name = '$name' AND image = '$image' AND user = '$userid'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (!$checkResult) {
            die("Errore nella query: " . mysqli_error($conn));
        }

        // Controlla il numero di righe restituite dalla query
        if (mysqli_num_rows($checkResult) > 0) {
            // La riga duplicata esiste già nella tabella
            echo "La riga esiste già nella tabella dei preferiti.";
        } else {
            // Esegui l'inserimento nella tabella dei preferiti
            $insertQuery = "INSERT INTO preferiti (name, image, user) VALUES ('$name', '$image', '$userid')";
            if (mysqli_query($conn, $insertQuery)) {
                // Inserimento riuscito
                echo "Dati salvati correttamente nel database.";
            } else {
                // Errore durante l'inserimento
                echo "Errore durante il salvataggio dei dati nel database: " . mysqli_error($conn);
            }
        }

        // Chiudi il risultato della query
        mysqli_free_result($checkResult);
    }
}

// Chiudi la connessione al database




  

    $query = "SELECT * FROM preferiti";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Errore nella query: " . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet"  href="preferiti.css">
    <script src="preferiti.js" defer="true"></script>
    <title>Visualizzazione dati tabella Preferiti</title>
   
</head>
<body>
    <div class="main">
        
 <div id="container_head"> 
        <h1>Preferiti</h1>
         <div class="topbar">
 <a href="logout_session.ph">Esci</a>
 <a href="home_session.php">Home</a>
</div>
    </div>
        <div id="elimina_mess">Per eliminare un elemento, fare clic sulla foto.</div>
  




    <div class="preferiti-container">
    <?php while ($row = mysqli_fetch_assoc($result)) {
        // Controlla se l'attributo 'image' non è vuoto
        if (!empty($row['image'])) { ?>
            <div class="preferiti-item">
                <img src="<?php echo $row['image']; ?>" alt="Immagine preferita" data-id="<?php echo $row['id']; ?>">
                <div class="preferiti-item-name"><?php echo $row['name']; ?></div>
                <div id="nascondi_id">ID: <?php echo $row['id']; ?></div>
            </div>
        <?php }
    } ?>
</div>

    </div>
   


</body>
</html>

<?php mysqli_close($conn); ?>
