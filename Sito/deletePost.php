<?php
//implenentazione del pattern Post/Redirect/Get per 
//l'eliminazione di una nuova faq
require_once('phpFunctions-delete.php');
session_start();
if(!isset($_SESSION['loginType']))
    header('Location: homepage.php');

if(isset($_POST['deletePost'])){
    deletePost($_POST['idPost']);
    header("Location: homepage-users-visualizzaBacheca.php?idCorso={$_POST['idCorso']}&pageNum=1");
}

?>