<?php
//implenentazione del pattern Post/Redirect/Get per 
//l'inserimento di una nuova faq
session_start();
require_once('phpFunctions-get.php');
require_once('phpFunctions-insert.php');


if(!isset($_SESSION['loginType']))
    header('Location: homepage.php');

if(isset($_POST['addFaq'])){
    if($_SESSION['loginType']=='Studente') $idAutore = getStudenteFromMatricola($_SESSION['matricola'])->matricola;
    elseif($_SESSION['loginType']=='Amministratore') $idAutore = -2;
    else $idAutore = 0;

    insertFaq($_POST['idCorso'],$_POST['faqContent'],$idAutore);

    header("Location: homepage-users-visualizzaFaq.php?idCorso=".$_POST['idCorso']);
}

?>