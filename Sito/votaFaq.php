<?php
//implenentazione del pattern Post/Redirect/Get per 
//l'eliminazione di una nuova faq
session_start();
require_once('phpFunctions-insert.php');
require_once('phpFunctions-delete.php');
#require_once('phpFunctions-modify.php');
require_once('phpClasses.php');


if(!isset($_SESSION['loginType']))
    header('Location: homepage.php');


if(isset($_POST['type'])){
    #siamo sicuri che l'utenza sia di tipo Studente
    if(($_POST['voto'] == $_POST['type'])){
        #il voto va rimosso
        echo $_POST['type'];
        deleteFaqVote($_SESSION['matricola'],$_POST['idFaq']);
        echo "caso 1 voto = type";

    }elseif($_POST['voto'] == 0){
        echo $_POST['type'];
        insertFaqVote(new faqVote($_SESSION['matricola'],$_POST['idFaq'],$_POST['type']));
        echo "caso 2 voto = 0";
    }else{
        echo $_POST['type'];
        deleteFaqVote($_SESSION['matricola'],$_POST['idFaq']);
        insertFaqVote(new faqVote($_SESSION['matricola'],$_POST['idFaq'],$_POST['type']));
        #modifyFaqVote($_SESSION['matricola'],$_POST['idFaq'],$_POST['type']);
        echo "caso 3 voto != type";
    }
    header("Location: homepage-users-visualizzaFaq.php?idCorso=".$_POST['idCorso']);
}
?>