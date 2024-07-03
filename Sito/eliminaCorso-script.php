<?php
require_once('phpFunctions-delete.php');

if(isset($_POST['elimina']) && isset($_POST['idCorso']) && $_POST['idCorso'] != 0) {
    if(eliminaCorso($_POST['idCorso']))
        header('Location: avvisoEliminazione.php');
    else {
        setcookie('elimina', 'ERRORE: eliminazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
?>