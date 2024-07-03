<?php
//implenentazione del pattern Post/Redirect/Get per 
//l'inserimento di una nuova faq
session_start();
require_once('phpFunctions-get.php');
require_once('phpFunctions-modify.php');


if(!isset($_SESSION['loginType']) && $_SERVER['loginType'] != 'Admin')
    header('Location: homepage.php');

if(isset($_POST['sospendi'])){
    switch ($_POST['utenza']) {
        case 'studente':
            sospendiStudente($_POST['id']);
            header("Location: gestioneUtenza.php?gestisciStudente=GESTISCI&matricola={$_POST['id']}");
            break;
        case 'docente':
            sospendiDocente($_POST['id']);
            header("Location: gestioneUtenza.php?gestisciDocente=GESTISCI&matricola={$_POST['id']}");
            break;
        case 'segretario':
            sospendiSegretario($_POST['id']);
            header("Location:gestioneUtenza.php?gestisciSegretario=GESTISCI&username={$_POST['id']}");
            break;
        default:
            # code...
            break;
    }
    
}
?>