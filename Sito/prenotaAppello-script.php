<?php
require_once('phpFunctions-insert.php');

if(isset($_POST['prenota']) && isset($_POST['matricola']) && isset($_POST['idAppello'])) {
    if(inserisciPrenotazioneAppello($_POST['matricola'], $_POST['idAppello']))
        header('Location: avvisoOK.php');
    else
        header('Location: avvisoErrore.php');
}
else {
    echo "<p>ERRORE nella prenotazione dell'appello.</p>";
}
?>