<?php
//implenentazione del pattern Post/Redirect/Get per 
//l'eliminazione di una nuova faq
require_once('phpFunctions-delete.php');
session_start();
if(!isset($_SESSION['loginType']))
    header('Location: homepage.php');

if(isset($_POST['deleteComment'])){
    deleteComment($_POST['idComment']);

    header("Location: homepage-users-visualizzaPost.php?idPost={$_POST['idPost']}&idCorso={$_POST['idCorso']}&pageNum={$_POST['pageNum']}");
}

?>