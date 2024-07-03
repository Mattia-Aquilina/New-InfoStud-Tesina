<?php
//implenentazione del pattern Post/Redirect/Get per 
//l'inserimento di una nuova faq
session_start();
require_once('phpFunctions-get.php');
require_once('phpFunctions-insert.php');


if(!isset($_SESSION['loginType']))
    header('Location: homepage.php');

if(isset($_POST['insertComment'])){
    if($_SESSION['loginType']=='Studente') $idAutore = getStudenteFromMatricola($_SESSION['matricola'])->matricola;
    elseif($_SESSION['loginType']=='Amministratore') $idAutore = -2;
    else $idAutore = 0;
    
    inserisciCommento( $_POST['corpo'], $idAutore, $_POST['idPost'], date('Y-m-d'));
    header("Location: homepage-users-visualizzaPost.php?idPost={$_POST['idPost']}&idCorso={$_POST['idCorso']}&pageNum={$_POST['pageNum']}");
}
?>