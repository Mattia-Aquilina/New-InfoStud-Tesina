<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");
require_once("../Sito/phpFunctions-insert.php");
require_once("../Sito/phpFunctions-misc.php");
require_once("../Sito/phpClasses.php");


if(!isset($_SESSION['loginType']) || $_SESSION['loginType'] == "Studente")
    header('Location: homepage.php');

if(isset($_SESSION['username']) && $_SESSION['loginType'] == "Amministratore")
    $adminLoggato = getAdminFromUsername($_SESSION['username']);
elseif(isset($_SESSION['username']) && $_SESSION['loginType'] == "Segretario")
    $segretarioLoggato = getSegretarioFromUsername($_SESSION['username']);
elseif(isset($_SESSION['matricola']) && $_SESSION['loginType'] == "Docente") {
    $docenteLoggato = getDocenteFromMatricola($_SESSION['matricola']);
    $insegnamenti = getCorsiFromDocente($docenteLoggato->matricola);
}
else
    echo "<p>ERRORE</p>";
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <link rel="stylesheet" href="stile-amministrazione.css">
    <title>Inserisci appello - InfoStuff</title>
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
                    <h2 class="hForm">
                        <form action="">
                            <input type="button">
                        </form>
                        Inserisci appello
                    </h2>
                </div>
                <div class="infoTitle-user">
                <?php
                if(isset($_SESSION['username']) && $_SESSION['loginType'] == "Amministratore")
                    echo "<h2>{$adminLoggato->username}</h2>";
                elseif(isset($_SESSION['username']) && $_SESSION['loginType'] == "Segretario")
                    echo "<h2>{$segretarioLoggato->username}</h2>";
                elseif(isset($_SESSION['matricola']) && $_SESSION['loginType'] == "Docente")
                    echo "<h2>{$docenteLoggato->nome} {$docenteLoggato->cognome}, {$docenteLoggato->matricola}</h2>";                   
                ?>
                </div>
            </div>
            <div>    
                <hr class="redBar" />
            </div>
            <?php
            if($_SESSION['loginType'] == "Docente" && !$insegnamenti)
                echo '<h2 style="text-align: center;">ERRORE: il docente non ha un corso assegnato.</h2>';
            else {
            ?>
            <div class="boxInsAPP">
            <form action="avvisoCorrispondenze.php" method="POST" id="input">
                <div class="insContainer">
                    <div class="labels">
                        <h3>Data: </h3>
                        <h3>Ora: </h3>
                        <h3>Corso: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    if(isset($_POST['data']))
                        echo "<input class=\"textField\" type=\"date\" name=\"data\" id=\"data\" value=\"{$_POST['data']}\" required>";
                    elseif(!isset($_POST['data']))
                        echo "<input class=\"textField\" type=\"date\" name=\"data\" id=\"data\" required>";
                    
                    if(isset($_POST['ora']))
                        echo "<input class=\"textField\" type=\"time\" name=\"ora\" value=\"{$_POST['ora']}\" required>";
                    elseif(!isset($_POST['ora']))
                        echo "<input class=\"textField\" type=\"time\" name=\"ora\" required>";
                    ?>
                    <select class="choice" name="corso" style="width: 87%;" onfocus='this.size=4; this.style="width: 120%; overflow-x: auto;";' onblur='this.size=1; this.style="width: 87%;";' onchange='this.size=1; this.blur(); this.style="width: 87%;";'>
                        <?php
                            if(isset($_POST['corso']) && $_POST['corso'] != "seleziona") {
                                $corso = getCorsoById($_POST['corso']);
                                $nomeCDL = getNomeCorsoDiLaureaById($corso->idCorsoLaurea);
                                echo "<option value=\"{$corso->id}\">{$corso->nome} ({$nomeCDL})</option>";
                            }
                            elseif(!isset($_POST['corso']))
                                echo "<option value=\"seleziona\">Corso...</option>";

                            if($_SESSION['loginType'] == "Docente") {
                                $corsi = [];
                                $corsi = getCorsiFromDocente($docenteLoggato->matricola);
                                foreach($corsi as $corso) {
                                    $nomeCDL = getNomeCorsoDiLaureaById($corso->idCorsoLaurea);
                                    echo "<option value=\"{$corso->id}\">{$corso->nome} ({$nomeCDL})</option>";
                                }
                            }
                            else {
                                $corsi = [];
                                $corsi = getCorsi();
                                foreach($corsi as $corso) {
                                    $nomeCDL = getNomeCorsoDiLaureaById($corso->idCorsoLaurea);
                                    echo "<option value=\"{$corso->id}\">{$corso->nome} ({$nomeCDL})</option>";
                                }
                            }
                        ?>
                    </select><?php
                    }?>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 45%;">
                    <input class="bottoni" type="submit" name="invio" value="INVIO" onclick="popupDate()">
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

<script>
function popupDate() {
    tmp = document.getElementById("data");

    var dataInserita = new Date(tmp.value);
    var dataOdierna = new Date();

    if(dataInserita <= dataOdierna) {
        event.preventDefault();
        window.alert('ATTENZIONE: Va inserita una data successiva a quella attuale!');
    }
}
</script>