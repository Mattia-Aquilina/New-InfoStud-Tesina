<?php
require_once('phpFunctions-delete.php');

if(isset($_POST['elimina']) && isset($_POST['utenza']) && $_POST['utenza'] == "studente") {
    if(eliminaStudente($_POST['matricola']))
        header('Location: avvisoEliminazione.php');
    else {
        setcookie('elimina', 'ERRORE: eliminazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
elseif(isset($_POST['elimina']) && isset($_POST['utenza']) && $_POST['utenza'] == "docente") {
    if(eliminaDocente($_POST['matricola']))
        header('Location: avvisoEliminazione.php');
    else {
        setcookie('elimina', 'ERRORE: eliminazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
elseif(isset($_POST['elimina']) && isset($_POST['utenza']) && $_POST['utenza'] == "segretario") {
    if(eliminaSegretario($_POST['username']))
        header('Location: avvisoEliminazione.php');
    else {
        setcookie('elimina', 'ERRORE: eliminazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
?>