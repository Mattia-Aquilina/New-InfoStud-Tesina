<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");


if(!isset($_SESSION['loginType']))
    header('Location: homepage.php');
elseif(isset($_SESSION['loginType']))
    $loginType = $_SESSION['loginType'];

switch($loginType) {

    case "Studente":
        if(isset($_SESSION['matricola']))
            $studenteLoggato = getStudenteFromMatricola($_SESSION['matricola']);
        break;

    case "Docente":
        if(isset($_SESSION['matricola']))
            $docenteLoggato = getDocenteFromMatricola($_SESSION['matricola']);
        break;

    case "Segretario":
        if(isset($_SESSION['username']))
            $segretarioLoggato = getSegretarioFromUsername($_SESSION['username']);
        break;

    case "Amministratore":
        if(isset($_SESSION['username']))
            $adminLoggato = getAdminFromUsername($_SESSION['username']);
        break;
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <title>Homepage - InfoStuff</title>
</head>
<body>
    <div class="header">
        <div class="nav-left">
            <div class="nav-logo">
                <a href="homepage.php">
                    <img src="https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300" alt="logo" width="90px">
                </a>
            </div>
            <div class="vertical-bar"></div>
                <h2>
                    <form action="">
                        <input type="button">
                    </form>
                    InfoStuff
                </h2>
            <div class="vertical-bar"></div>
        </div>
        <div class="nav-right">
        <h2>
            <form action="logout.php">
                <input type="submit" value="">
            </form>
                Logout
        </h2>
        <div class="vertical-bar"></div>
            <div class="nav-logo">
                <a href="homepage-users.php">
                    <img src="account.png" alt="logo" width="90px">
                </a>
            </div>
        </div>
        </div>
    </div>
    <div class="central-block">
        <?php
        if(isset($_SESSION['loginType']))
            creaSidebar($_SESSION['loginType']);
        ?>
        <div class="body">
            <div class="infoTitle">
                <div class="infoTitle-position">
                    <h2>ANAGRAFICA</h2>
                </div>
                <div class="infoTitle-user">
                <?php
                    if($loginType == "Studente") {
                        echo "<h2>{$studenteLoggato->nome} {$studenteLoggato->cognome}, {$studenteLoggato->matricola}</h2>";
                    }
                    elseif($loginType == "Docente") {
                        echo "<h2>{$docenteLoggato->nome} {$docenteLoggato->cognome}, {$docenteLoggato->matricola}</h2>";
                    }
                    elseif($loginType == "Segretario") {       
                        echo "<h2>{$segretarioLoggato->username}</h2>";
                    }
                    elseif($loginType == "Amministratore") {
                        echo "<h2>{$adminLoggato->username}</h2>";
                    }?>
                </div>
            </div>    
            <hr />
            <?php
            if($loginType == "Studente")
                displayAnagraficaStudente($studenteLoggato);
            elseif($loginType == "Docente") 
                displayAnagraficaDocente($docenteLoggato);
            elseif($loginType == "Segretario")
                displayAnagraficaSegretario($segretarioLoggato);
            elseif($loginType == "Amministratore")
                displayAnagraficaAmministratore($adminLoggato);
            ?>
        </div>
    </div>
</div>
</body>
</html>