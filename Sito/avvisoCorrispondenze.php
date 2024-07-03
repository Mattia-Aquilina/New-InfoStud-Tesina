<?php
session_start();
$_SESSION['src'] = "edit";
require_once("../Sito/phpFunctions-display.php");
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-insert.php");
require_once("../Sito/phpFunctions-modify.php");
require_once("../Sito/phpClasses.php");


if(!isset($_SESSION['loginType']) || $_SESSION['loginType'] == "Studente")
    header('Location: homepage-users.php');


if(isset($_SESSION['username']) && $_SESSION['loginType'] == "Amministratore")
    $adminLoggato = getAdminFromUsername($_SESSION['username']);
elseif(isset($_SESSION['username']) && $_SESSION['loginType'] == "Segretario")
    $segretarioLoggato = getSegretarioFromUsername($_SESSION['username']);
elseif(isset($_SESSION['matricola']) && $_SESSION['loginType'] == "Docente") {
    $docenteLoggato = getDocenteFromMatricola($_SESSION['matricola']);
    $corsi = getCorsiFromDocente($docenteLoggato->matricola);
}
else
    echo "<p>ERRORE</p>";


if(isset($_POST['invioModifica'])) {
    $_SESSION['ins'] = 0;
    $idAppello = $_POST['idAppello'];

    if((isset($_POST['data']) && $_POST['data'] != "") &&
       (isset($_POST['ora']) && $_POST['ora'] != "") &&
       (isset($_POST['corso']) && $_POST['corso'] != "seleziona")) {

        $appello = getAppelloFromId($idAppello);
        $appello->dataOra = "".strval($_POST['data'])." ".strval($_POST['ora'])."";

        $corrispondenze = [];
        $corrispondenze = verificaProssimita($appello);

        if(!$corrispondenze) {
            $tmp = modificaAppello($idAppello, $_POST['data'], $_POST['ora'], $_POST['corso']);

            if(!$tmp) 
                header('Location: avvisoErrore.php');
            else
                header('Location: avvisoOK.php');
        }
    }
}


if(isset($_POST['invio'])) {
    $_SESSION['ins'] = 1;
    $presenzaDati = FALSE;

    if((isset($_POST['data']) && $_POST['data'] != "") &&
       (isset($_POST['ora']) && $_POST['ora'] != "") &&
       (isset($_POST['corso']) && $_POST['corso'] != "seleziona")) {
            $presenzaDati = TRUE;

            $dataOra = "".strval($_POST['data'])." ".strval($_POST['ora'])."";
            $appello = new appello($dataOra, $_POST['corso']);
            
            $corrispondenze = [];
            $corrispondenze = verificaProssimita($appello);

            if(!$corrispondenze) {
                $tmp = inserisciAppello($appello);

                if(!$tmp)
                    header('Location: avvisoErrore.php');
                else
                    header('Location: avvisoOK.php');
            }
    }
}


if(isset($_POST['si'])) {
    $appello = new appello("", 0);

    $appello->id = $_POST['idAppello'];
    $appello->idCorso = $_POST['corso'];
    $appello->dataOra = strval($_POST['data'])." ".strval($_POST['ora']);
    if($_SESSION['ins'])
        $tmp = inserisciAppello($appello);
    else
        $tmp = modificaAppello($appello->id, $_POST['data'], $_POST['ora'], $_POST['corso']);

    if(!$tmp)
        header('Location: avvisoErrore.php');
    else
        header('Location: avvisoOK.php');
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stile-amministrazione.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <title>Visualizza appelli - Infostud</title>
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
    <div class="central-block">
    <?php creaSidebar($_SESSION['loginType']); ?>
        <div class="body">
            <div class="infoTitle">
                <div class="infoTitle-position">
                    <h2>AVVISO CORRISPONDENZE</h2>
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
            <div><hr class="redBar" /></div>
            <div class="box-avviso" style="padding: 1%; background-color: rgba(240, 255, 240, 0.102);">
                <h1>Sono state rilevate corrispondenze.</h1>
                <h3>Inserire comunque l'appello?</h3>
                <div style="display: flex; flex-direction: row; margin-top: 5%; margin-left: 30%;">
                    <form action="avvisoCorrispondenze.php" method="POST">
                        <input class="bottoni" type="submit" name="si" value="SI">
                        <?php
                        $data = getDataFromDataora($appello->dataOra);
                        $ora = getOraFromDataora($appello->dataOra);
                        $corso = getCorsoById($appello->idCorso);
                        ?>
                        <input type="hidden" name="data" value="<?php echo $data; ?>">
                        <input type="hidden" name="ora" value="<?php echo $ora; ?>">
                        <input type="hidden" name="corso" value="<?php echo $corso->id; ?>">
                        <input type="hidden" name="idAppello" value="<?php echo $appello->id; ?>">
                    </form>
                    <form action="inserisciAppello.php" method="POST">
                        <input class="bottoni" type="submit" name="no" value="NO">
                        <?php
                        $data = getDataFromDataora($appello->dataOra);
                        $ora = getOraFromDataora($appello->dataOra);
                        $corso = getCorsoById($appello->idCorso);
                        ?>
                        <input type="hidden" name="data" value="<?php echo $data; ?>">
                        <input type="hidden" name="ora" value="<?php echo $ora; ?>">
                        <input type="hidden" name="corso" value="<?php echo $corso->id; ?>">
                    </form>
                </div>
            </div>
            <h2 style="margin-top: 5%; margin-left: 36%; text-align: center; background-color: yellow; width: 25%;">Corrispondenze rilevate:</h2>
            <div class="container-esami">
            <?php
                displayCorrispondenze($corrispondenze); 
            ?>       
            </div>    
        </div>
    </div>
</div>
</body>
</html>
