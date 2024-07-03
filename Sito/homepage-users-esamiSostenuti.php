<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");


if(!isset($_SESSION['loginType']))
    header('Location: homepage-users.php');

if(isset($_SESSION['matricola']) && ($_SESSION['loginType'] == "Studente"))
    $studenteLoggato = getStudenteFromMatricola($_SESSION['matricola']);
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileVisualizzazioneLista.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <title>Esami sostenuti - InfoStuff</title>
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
                        Esami sostenuti
                    </h2>
                </div>
                <div class="infoTitle-user">
                <?php
                if(isset($_SESSION['matricola']) && ($_SESSION['loginType'] == "Studente"))
                    echo "<h2>{$studenteLoggato->nome} {$studenteLoggato->cognome}, {$studenteLoggato->matricola}</h2>";
                ?>
                </div>
            </div>    
            <div><hr class="redBar" /></div>
        <div class="listContainer">
                <div class="listItem">
                    <div class="element">
                        <h2>Corso</h2>
                    </div>
                    <div class="element">
                        <h2>Sostenuto il</h2>
                    </div>
                    <div class="lastElement">
                        <h2>Esito</h2>
                    </div>
                </div> 
                <hr />
                <?php
                    $esamiSostenuti = getEsamiSostenuti($studenteLoggato);
                    if(!$esamiSostenuti) {
                        echo "<h3 class=\"voceElenco\">Non risultano esami sostenuti.</h3>";
                    }
                    else {
                        foreach($esamiSostenuti as $esameSostenuto) {
                            $appello = getAppelloFromId($esameSostenuto->idAppello);
                            $corso = getCorsoById($appello->idCorso);
                            $dataEsame = getDataFromDataora($appello->dataOra);
                        ?>
                            <div class="listItem">
                                <div class="element">
                                    <h2><?php echo $corso->nome ?></h2>
                                </div>
                                <div class="element">
                                    <h2><?php echo $dataEsame ?></h2>
                                </div>
                                <div class="lastElement">
                                    <h2><?php echo $esameSostenuto->esito ?></h2>
                                </div>
                            </div>
                            <hr />
                        <?php
                        }
                    }
                ?>
        </div>
    </div>
</div>
</body>
</html>