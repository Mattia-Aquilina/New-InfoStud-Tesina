<?php
//implenentazione del pattern Post/Redirect/Get per 
//l'inserimento di una nuova faq
require_once('phpFunctions-modify.php');
require_once('phpFunctions-delete.php');
require_once('phpFunctions-insert.php');
require_once('phpFunctions-misc.php');
session_start();

if(!isset($_POST['richiesta'])) header('Location: homepage.php');

switch ($_POST['richiesta']) {
    case 'modificaFaq':
        # Richiesta proveniente da visualizzaFaq.php
        # Otteniamo i parametri 
        $newText = $_POST['newText'];
        $id = $_POST['id'];

        modificaFaq($id,$newText);
        echo $newText;
        break;       
    case 'modificaVotoPost': 
        $vote = $_POST['newVote'];
        $idCommento = $_POST['id'];
        $idAutore = $_POST['autore'];
        //sicuramente utenza è ti tipo studente
        $commentoDaVotare = getCommentFromId($idCommento);
        deleteCommentVote($idCommento,  $_SESSION['matricola']); 
        insertCommentVote($idCommento,  $_SESSION['matricola'], $vote,$idAutore);
        $newRep = calcolaReputazioneStudente($idAutore);

        $commento = getCommentFromId($idCommento);

        echo "{$commento->id}-{$commento->accordoMedio}-{$newRep}-{$commentoDaVotare->matricolaStudente}";
        break;

    case 'modificaContenutoPost': 
        $text = $_POST['newText'];
        $idCommento = $_POST['id'];
        //sicuramente utenza è ti tipo studente

        echo modifyContentText($idCommento,$text);
        break;
    case 'modificaPost': 
        $text = $_POST['newText'];
        $idCommento = $_POST['id'];
        //sicuramente utenza è ti tipo studente

        echo modifyPostContent($idCommento,$text);
        break;
    default:
        # code...
        break;
}

?>