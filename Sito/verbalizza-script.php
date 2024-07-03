<?php
require_once('phpFunctions-modify.php');
require_once('phpFunctions-delete.php');


$success = FALSE;

if(isset($_POST['verbalizza']) && isset($_POST['idPrenotazioni']) && isset($_POST['esito'])) {
    for($i = 0; $i < sizeof($_POST['idPrenotazioni']); $i++) {
        if($_POST['esito'][$i] != "NULL") {
            if(modificaEsitoPrenotazione($_POST['idPrenotazioni'][$i], $_POST['esito'][$i])) {
                if($_POST['esito'][$i] != "NULL" && $_POST['esito'][$i] != "B" && $_POST['esito'][$i] != "R") {
                    $pren = getPrenotazioneFromId($_POST['idPrenotazioni'][$i]);
                    $appello = getAppelloFromId($pren->idAppello);
                    
                    if(eliminaPrenotazioniStudentePostVerbalizzazione($pren->matricolaStudente, $appello->idCorso))
                        $success = TRUE;
                }
            }
            else {
                $success = FALSE;
                break;
            }
        }
    }

    if($success)
        header('Location: avvisoOK.php');
    else {
        setcookie('verb', 'ERRORE: Verbalizzazione fallita.');
        header('Location: avvisoErrore.php');
    }
}
?>