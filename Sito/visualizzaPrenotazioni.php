<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");


if(!isset($_SESSION['loginType']) || $_SESSION['loginType'] == "Studente")
    header('Location: homepage-users.php');


if(isset($_SESSION['username']) && $_SESSION['loginType'] == "Amministratore")
    $adminLoggato = getAdminFromUsername($_SESSION['username']);
elseif(isset($_SESSION['username']) && $_SESSION['loginType'] == "Segretario")
    $segretarioLoggato = getSegretarioFromUsername($_SESSION['username']);
elseif(isset($_SESSION['matricola']) && $_SESSION['loginType'] == "Docente")
    $docenteLoggato = getDocenteFromMatricola($_SESSION['matricola']);
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
    <link rel="stylesheet" href="stileVisualizzazioneLista.css">
    <link rel="stylesheet" href="stile-amministrazione.css">
    <title>Visualizza prenotazioni - InfoStuff</title>
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
        <?php
        if($_SESSION['loginType'] == "Segretario" || $_SESSION['loginType'] == "Amministratore") {?>
            <div class="nav-central">
                <form action="visualizzaAppelli.php" method="POST">
                    <div class="nav-logo">
                        <input type="submit" name="ricerca" value="">
                        <img src="search.png" alt="err" width="20px" style="display: inline-flex;">
                    </div>    
                        <input type="text" name="filtro">              
                </form>
            </div>
        <?php
        }?>
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
                    <h2 class="hForm" style="padding-right: 1%;">
                        <form action="gestionePrenotazioni.php">
                            <input type="submit" value="">
                        </form>
                        Verbalizza esami >
                    </h2>
                    <h2 class="hForm">
                        <form action="">
                            <input type="button">
                        </form>
                        Informazioni
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
            <hr />
            <div class="listContainer">
                <div class="listItem">
                    <div class="element">
                        <h2>Appello del</h2>
                    </div>
                    <div class="element">
                        <h2>Corso</h2>
                    </div>
                    <div class="element">
                        <h2>Studente</h2>
                    </div>
                    <div class="lastElement">
                        <h2>Esito</h2>
                    </div>
                </div>
                <hr />
                <?php
                if(isset($_POST['idAppello']))
                    $appello = getAppelloFromId($_POST['idAppello']);
                $corso = getCorsoById($appello->idCorso);
                    
                $prenotazioni = [];
                $prenotazioni = getPrenotazioniFromAppello($appello->id);
    
                if(!$prenotazioni) {
                    echo "<h3 class=\"voceElenco\">Nessuna prenotazione registrata.</h3>";
                }
                else {?>
                    <form action="verbalizza-script.php" method="POST"><?php
                    $listaIdPrenotazioni = [];

                    foreach($prenotazioni as $prenotazione) {
                        $studente = getStudenteFromMatricola($prenotazione->matricolaStudente);
                        $data = getDataFromDataora($appello->dataOra);
                    ?>  
                        <input type="hidden" name="idPrenotazioni[]" value="<?php echo $prenotazione->id; ?>">
                        <div class="listItem">
                            <div class="element">
                                <h2><?php echo "{$data}" ?></h2>
                            </div>
                            <div class="element">
                                <h2><?php echo "{$corso->nome}" ?></h2>
                            </div>
                            <div class="element">
                                <h2><?php echo "{$studente->cognome} {$studente->nome}, {$studente->matricola}" ;?></h2>
                            </div>
                            <div class="lastElement">
                                <select class="choice" name="esito[]" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' style="width: 30%;">
                                    <option value="NULL">NULL</option>
                                    <option value="B">B</option>
                                    <option value="R">R</option>
                                <?php
                                    for($i = 18; $i <= 30; $i++)
                                        echo "<option value=\"{$i}\">{$i}</option>";
                                ?>
                                    <option value="31">30L</option>
                                </select>
                            </div>
                        </div>
                        <hr class="blackBar" />
                    <?php
                    }
                }
                if($prenotazioni) {
                ?>
                <div class="listItem" style="margin-top: 5%;">
                    <div class="element"></div>
                    <div class="element"></div>
                    <div class="element"></div>
                    <div class="element">
                    <input class="verbalizza" type="submit" name="verbalizza" value="VERBALIZZA">
                    </div>
                </div></form><?php
                }?>
            </div>
        </div>
    </div>
</div>
</body>
</html>