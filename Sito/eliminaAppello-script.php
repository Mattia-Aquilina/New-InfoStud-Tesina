<?php
require_once('phpFunctions-delete.php');

if(isset($_POST['elimina']) && isset($_POST['idAppello']) && $_POST['idAppello'] != 0) {
    if(eliminaAppello($_POST['idAppello']))
        header('Location: avvisoEliminazione.php');
    else {
        setcookie('elimina', 'ERRORE: eliminazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
?>