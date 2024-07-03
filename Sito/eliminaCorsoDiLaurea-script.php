<?php
require_once('phpFunctions-delete.php');

if(isset($_POST['elimina']) && isset($_POST['idCorsoDiLaurea']) && $_POST['idCorsoDiLaurea'] != 0) {
    if(eliminaCorsoDiLaurea($_POST['idCorsoDiLaurea']))
        header('Location: avvisoEliminazione.php');
    else {
        setcookie('elimina', 'ERRORE: eliminazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
?>