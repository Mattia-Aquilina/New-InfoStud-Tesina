<?php
require_once('phpFunctions-delete.php');

if(isset($_POST['annulla']) && isset($_POST['idPrenotazione']) && $_POST['idPrenotazione'] != 0) {
    if(eliminaPrenotazioneAppello($_POST['idPrenotazione']))
        header('Location: avvisoEliminazione.php');
    else {
        setcookie('elimina', 'ERRORE: eliminazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
?>