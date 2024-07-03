<?php
session_start();
require_once('phpFunctions-modify.php');
require_once('phpFunctions-get.php');
require_once('phpFunctions-display.php');
require_once('phpFunctions-misc.php');
require_once('phpClasses.php');


if(!isset($_SESSION['loginType']) || $_SESSION['loginType'] != "Amministratore")
    header('Location: homepage.php');

if(isset($_SESSION['username']))
    $adminLoggato = getAdminFromUsername($_SESSION['username']);
else
    echo "<p>ERRORE</p>";

if(isset($_POST['idCorso']) && $_POST['idCorso'] != 0)
    $corso = getCorsoById($_POST['idCorso']);

if(isset($_POST['invio'])) {
    if((isset($_POST['idCorso']) && $_POST['idCorso'] != "") &&
       (isset($_POST['nome']) && $_POST['nome'] != "") && 
       (isset($_POST['docente']) && $_POST['docente'] != "seleziona") && 
       (isset($_POST['codocente']) && $_POST['codocente'] != "seleziona") && 
       (isset($_POST['anno']) && $_POST['anno'] != "seleziona") && 
       (isset($_POST['semestre']) && $_POST['semestre'] != "") &&
       (isset($_POST['curriculum']) && $_POST['curriculum'] != "") &&
       (isset($_POST['cfu']) && $_POST['cfu'] != "seleziona") &&
       (isset($_POST['ssd']) && $_POST['ssd'] != "") &&
       (isset($_POST['corsoLaurea']) && $_POST['corsoLaurea'] != "seleziona") &&
       (isset($_POST['descrizione']) && $_POST['descrizione'] != "")) {

            $corsoTMP = new corso("", "", 0, 0, 0, 0, "", 0, "", 0);
            $corsoTMP->nome = $_POST['nome'];
            $corsoTMP->idCorsoLaurea = $_POST['corsoLaurea'];
            if(verificaPresenzaCorso($corsoTMP)) {
                setcookie('modificaCorso', 'ERRORE: Il corso è già presente!');
                header('Location: avvisoErrore.php');
            }
            else {
                $tmp = modificaCorso($_POST['idCorso'], $_POST['nome'], $_POST['descrizione'], $_POST['docente'], $_POST['codocente'], $_POST['anno'], $_POST['semestre'], $_POST['curriculum'], $_POST['cfu'], $_POST['ssd'], $_POST['corsoLaurea']);
                if(!$tmp) {
                    setcookie('modificaCorso', 'ERRORE: Modifica del corso non riuscita.');
                    header('Location: avvisoErrore.php');
                }
                else {
                    $corso = getCorsoById($_POST['idCorso']);
                    $tmp = assegnaCorso($corso, $_POST['docente'], $_POST['codocente']);
                    if($tmp)
                        header('Location: avvisoOK.php');
                    else
                        header('Location: avvisoErrore.php'); 
                }
            }
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
    <title>Modifica corso - InfoStuff</title>
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
                    <h2 class="hForm" style="padding-right: 1%;">
                        <form action="gestisciCorsi.php">
                            <input type="submit" value="">
                        </form>
                        Gestisci corsi >
                    </h2>
                    <h2 class="hForm" style="">
                        <form action="">
                            <input type="button" value="">
                        </form>
                        Modifica corso
                    </h2>
                </div>
                <div class="infoTitle-user">
                <?php
                    echo "<h2>{$adminLoggato->username}</h2>";
                ?>
                </div>
            </div>
            <div>    
                <hr class="redBar" />
            </div>
            <div class="boxInsC">
            <form action="modificaCorso.php" method="POST" id="input">
                <div class="insContainer">
                    <div class="labels">
                        <h3>Nome: </h3>
                        <h3>Docente: </h3>
                        <h3>Co-Docente: </h3>
                        <h3>Anno: </h3>
                        <h3>Semestre: </h3>
                        <h3>Curriculum: </h3>
                        <h3>CFU: </h3>
                        <h3>SSD: </h3>
                        <h3>Corso di Laurea: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    echo "<input class=\"textField\" type=\"text\" name=\"nome\" value=\"{$corso->nome}\" required>";
                    ?>
                    <select class="choice" name="docente" onfocus='this.size=3; this.style="width: 95%;";' onblur='this.size=1; this.style="width: 82%;";' onchange='this.size=1; this.blur(); this.style="width: 82%;";'>
                        <?php
                            $docente = getDocenteFromMatricola($corso->matricolaDocente);
                            echo "<option value=\"{$docente->matricola}\">{$docente->nome} {$docente->cognome}</option>";

                            $docenti = [];
                            $docenti = getDocenti();
                            foreach($docenti as $docente) {
                                echo "<option value=\"{$docente->matricola}\">{$docente->nome} {$docente->cognome}</option>";
                            }
                        ?>
                    </select>
                    <select class="choice" name="codocente" onfocus='this.size=3; this.style="width: 95%;";' onblur='this.size=1; this.style="width: 82%;";' onchange='this.size=1; this.blur(); this.style="width: 82%;";'>
                        <?php
                            if($corso->matricolaCoDocente == 0)
                                echo "<option value=\"0\">Nessuno</option>";
                            else {
                                $docente = getDocenteFromMatricola($corso->matricolaCoDocente);
                                echo "<option value=\"{$docente->matricola}\">{$docente->nome} {$docente->cognome}</option>";
                            }
                            
                            echo "<option value=\"0\">Nessuno</option>";

                            $docenti = [];
                            $docenti = getDocenti();
                            foreach($docenti as $docente) {
                                echo "<option value=\"{$docente->matricola}\">{$docente->nome} {$docente->cognome}</option>";
                            }
                        ?>
                    </select>
                    <select class="choice" name="anno">
                        <?php
                            echo "<option value=\"{$corso->anno}\">{$corso->anno}</option>
                                <option value=\"1\">1</option>
                                <option value=\"2\">2</option>
                                <option value=\"3\">3</option>";
                        ?>
                    </select>
                    <select class="choice" name="semestre">
                        <?php
                        echo "<option value=\"{$corso->semestre}\">{$corso->semestre}</option>
                            <option value=\"1\">1</option>
                            <option value=\"2\">2</option>";
                        ?>
                    </select>
                    <?php
                    echo "<input class=\"textField\" type=\"text\" name=\"curriculum\" value=\"{$corso->curriculum}\" required>";
                    ?>
                    <select class="choice" name="cfu">
                        <?php
                        echo "<option value=\"{$corso->cfu}\">{$corso->cfu}</option>
                            <option value=\"3\">3</option>
                            <option value=\"6\">6</option>
                            <option value=\"9\">9</option>
                            <option value=\"12\">12</option>";
                        ?>
                    </select>
                    <?php
                    echo "<input class=\"textField\" type=\"text\" name=\"ssd\" value=\"{$corso->ssd}\" required>";
                    ?>
                    <select class="choice" name="corsoLaurea" onfocus='this.size=3; this.style="width: 95%; overflow-x: auto;";' onblur='this.size=1; this.style="width: 80%;";' onchange='this.size=1; this.blur(); this.style="width: 80%;";'>
                        <?php
                            $nomeCDL = getNomeCorsoDiLaureaByID($corso->idCorsoLaurea);
                            echo "<option value=\"{$corso->idCorsoLaurea}\">{$nomeCDL}</option>";
                                        
                            $corsiLaurea = [];
                            $corsiLaurea = getCorsiDiLaurea();
                            foreach($corsiLaurea as $corsoDiLaurea) {
                                echo "<option value=\"{$corsoDiLaurea->id}\">{$corsoDiLaurea->nome}</option>";
                            }
                        ?>
                    </select>
                    </div>
                </div>
                <div style="text-align:center;">
                    <h3>Descrizione: </h3>
                    <?php
                    echo "<textarea form=\"input\" name=\"descrizione\">{$corso->descrizione}</textarea>";
                    ?>
                </div>
                <div style="padding-top: 1%; margin-left: 50%;">
                    <input class="bottoni" type="submit" name="invio" value="INVIO">
                    <input type="hidden" name="idCorso" value="<?php echo $_POST['idCorso']; ?>">
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>