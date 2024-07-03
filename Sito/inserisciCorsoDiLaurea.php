<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");
require_once("../Sito/phpFunctions-insert.php");
require_once("../Sito/phpClasses.php");


if(!isset($_SESSION['loginType']) || $_SESSION['loginType'] != "Amministratore")
    header('Location: homepage.php');

if(isset($_SESSION['username']))
    $adminLoggato = getAdminFromUsername($_SESSION['username']);
else
    echo "<p>ERRORE</p>";

if(isset($_POST['invio'])) {
    $presenzaDati = FALSE;

    if(isset($_POST['nome']) && $_POST['nome'] != "") {
        $presenzaDati = TRUE;

        $corsoDiLaurea = new corsoDiLaurea($_POST['nome']);

        if(!inserisciCorsoDiLaurea($corsoDiLaurea)) {
            setcookie('cdl', "ERRORE: Inserimento del corso di laurea non riuscito.");
            header('Location: avvisoErrore.php');
        }
        else
            header('Location: avvisoOK.php');
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
    <title>Inserisci corso di laurea - InfoStuff</title>
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
                    <h2 style="margin-left: 3%; padding-right: 1%;" class="hForm"> 
                        <form action="homepage-users.php">
                            <input type="submit" value="">
                        </form>
                        Home >
                    </h2>
                    <h2 class="hForm" style="">
                        <form action="">
                            <input type="button" value="">
                        </form>
                        Inserisci corso di laurea
                    </h2>
                </div>
                <div class="infoTitle-user">
                <?php
                    echo "<h2>{$adminLoggato->username}</h2>";
                ?>
                </div>
            </div>    
            <hr />
            <div class="boxInsCDL">
            <form action="inserisciCorsoDiLaurea.php" method="POST">
                <div class="insContainer" style="padding-right: 47%;">
                    <div class="labels">
                        <h3>Nome: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    if(isset($_POST['nome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"nome\" value=\"{$_POST['nome']}\" required>";
                    elseif(!isset($_POST['nome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"nome\" required>";
                    ?>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 50%;">
                    <input class="bottoni" type="submit" name="invio" value="INVIO">
                </div>
            </form>
            </div>
            <?php
            if(isset($_POST['invio']) && !$presenzaDati)
                echo "
                <div style=\"margin-left: -6%; padding-bottom: 7%;\">
                    <h2 class=\"error\">DATI MANCANTI! Riprovare.</h2>
                </div>";
            ?>
        </div>
    </div>
</div>
</body>
</html>