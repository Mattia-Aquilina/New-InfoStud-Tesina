<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");
require_once("../Sito/phpFunctions-modify.php");
require_once("../Sito/phpFunctions-misc.php");


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


if(isset($_POST['modifica'])) {
    $passwordCorretta = FALSE;
    $match = FALSE;
    $uguali = TRUE;

    switch($loginType) {
        case "Studente":
            if(encryptPassword($_POST['vecchiaPassword']) == $studenteLoggato->password) {
                $passwordCorretta = TRUE;
                if($_POST['nuovaPassword'] == $_POST['confermaPassword']) {
                    $match = TRUE;
                    if($_POST['nuovaPassword'] != $_POST['vecchiaPassword']) {
                        $uguali = FALSE;

                        $tmp = modificaPasswordStudente($studenteLoggato->matricola, $_POST['nuovaPassword']);
                        if($tmp)
                            header('Location: avvisoOK.php');
                        else {
                            setcookie('pwd', 'ERRORE: Modifica password fallita.');
                            header('Location: avvisoErrore.php');
                        }
                    }
                }
            }            
            break;
        
        case "Docente":
            if(encryptPassword($_POST['vecchiaPassword']) == $docenteLoggato->password) {
                $passwordCorretta = TRUE;
                if($_POST['nuovaPassword'] == $_POST['confermaPassword']) {
                    $match = TRUE;
                    if($_POST['nuovaPassword'] != $_POST['vecchiaPassword']) {
                        $uguali = FALSE;

                        $tmp = modificaPasswordDocente($docenteLoggato->matricola, $_POST['nuovaPassword']);
                        if($tmp)
                            header('Location: avvisoOK.php');
                        else {
                            setcookie('pwd', 'ERRORE: Modifica password fallita.');
                            header('Location: avvisoErrore.php');
                        }
                    }
                }
            } 
            break;

        case "Segretario":
            if(encryptPassword($_POST['vecchiaPassword']) == $segretarioLoggato->password) {
                $passwordCorretta = TRUE;
                if($_POST['nuovaPassword'] == $_POST['confermaPassword']) {
                    $match = TRUE;
                    if($_POST['nuovaPassword'] != $_POST['vecchiaPassword']) {
                        $uguali = FALSE;

                        $tmp = modificaPasswordSegretario($segretarioLoggato->username, $_POST['nuovaPassword']);
                        if($tmp)
                            header('Location: avvisoOK.php');
                        else {
                            setcookie('pwd', 'ERRORE: Modifica password fallita.');
                            header('Location: avvisoErrore.php');
                        }
                    }
                }
            } 
            break;
        
        case "Amministratore":
            if(encryptPassword($_POST['vecchiaPassword']) == $adminLoggato->password) {
                $passwordCorretta = TRUE;
                if($_POST['nuovaPassword'] == $_POST['confermaPassword']) {
                    $match = TRUE;
                    if($_POST['nuovaPassword'] != $_POST['vecchiaPassword']) {
                        $uguali = FALSE;

                        $tmp = modificaPasswordAmministratore($adminLoggato->username, $_POST['nuovaPassword']);
                        if($tmp)
                            header('Location: avvisoOK.php');
                        else {
                            setcookie('pwd', 'ERRORE: Modifica password fallita.');
                            header('Location: avvisoErrore.php');
                        }
                    }
                }
            }
            break;
    }
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <link rel="stylesheet" href="stile-amministrazione.css">
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
                    <h2>MODIFICA PASSWORD</h2>
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
            <div><hr class="redBar" /></div>
            <div class="boxInsC">
            <form action="modificaPassword.php" method="POST" id="input">
                <div class="insContainer">
                    <div class="labels">
                        <h3>Vecchia password: </h3>
                        <h3>Nuova password: </h3>
                        <h3>Conferma password: </h3>
                    </div>
                    <div class="inputs">
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <input class="textField" type="password" name="vecchiaPassword" id="vecchiaPWD" required>
                            <img src="show.png" width="30px" height="30px" id="img1" onclick="showHidePassword(1)">
                        </div>
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <input class="textField" type="password" name="nuovaPassword" id="nuovaPWD" required>
                            <img src="show.png" width="30px" height="30px" id="img2" onclick="showHidePassword(2)">
                        </div>
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <input class="textField" type="password" name="confermaPassword" id="confermaPWD" required>
                            <img src="show.png" width="30px" height="30px" id="img3" onclick="showHidePassword(3)">
                        </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 50%;">
                    <input class="bottoni" type="submit" name="modifica" value="MODIFICA" style="width: 60%;">
                </div>
            </form>
            </div>
            <?php
            if(isset($_POST['modifica'])) {
                if(!$passwordCorretta) {                // Password errata
                    echo "
                        <div style=\"padding-bottom: 8%;\"><h2 style=\"position: relative; text-align: center; font-size: 200%; font-weight: bold; color: blue;\">
                            PASSWORD ORIGINALE ERRATA! Riprovare.
                        </h2></div>";
                }
                elseif($passwordCorretta && !$match) {                  // Le nuove password non corrispondono
                    echo "
                        <div style=\"padding-bottom: 8%;\"><h2 style=\"position: relative; text-align: center; font-size: 200%; font-weight: bold; color: blue;\">
                            LE DUE NUOVE PASSWORD NON COINCIDONO! Riprovare.
                        </h2></div>";
                }
                elseif($passwordCorretta && $match && $uguali) {                  // La nuova password è uguale alla vecchia
                    echo "
                        <div style=\"padding-bottom: 8%;\"><h2 style=\"position: relative; text-align: center; font-size: 200%; font-weight: bold; color: blue;\">
                            LA NUOVA PASSWORD È UGUALE ALLA VECCHIA! Riprovare.
                        </h2></div>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>

<script>
function showHidePassword(id) {
    var vecchia = document.getElementById('vecchiaPWD');     // Input type
    var nuova = document.getElementById('nuovaPWD');
    var conferma = document.getElementById('confermaPWD');
    
    var img1 = document.getElementById('img1');              // Occhiolino
    var img2 = document.getElementById('img2'); 
    var img3 = document.getElementById('img3'); 


    if(id === 1) {
        if(vecchia.type === "password") {                 // Se è oscurata, mostrala in chiaro
            vecchia.type = "text";
            img1.src = "hide.webp";
        }
        else {                                            // Se è mostrata in chiaro, oscurala
            if(vecchia.type === "text") {
                vecchia.type = "password";
                img1.src = "show.png";
            }
        }
    }
    else if(id === 2) {
        if(nuova.type === "password") {                 // Se è oscurata, mostrala in chiaro
            nuova.type = "text";
            img2.src = "hide.webp";
        }
        else {                                            // Se è mostrata in chiaro, oscurala
            if(nuova.type === "text") {
                nuova.type = "password";
                img2.src = "show.png";
            }
        }
    }
    else if(id === 3) {
        if(conferma.type === "password") {                 // Se è oscurata, mostrala in chiaro
            conferma.type = "text";
            img3.src = "hide.webp";
        }
        else {                                            // Se è mostrata in chiaro, oscurala
            if(conferma.type === "text") {
                conferma.type = "password";
                img3.src = "show.png";
            }
        }
    }
}
</script>