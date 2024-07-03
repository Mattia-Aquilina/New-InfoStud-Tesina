<?php
session_start();
require_once('phpFunctions-modify.php');
require_once('phpFunctions-get.php');
require_once('phpFunctions-display.php');
require_once('phpFunctions-misc.php');


if(!isset($_SESSION['loginType']) || $_SESSION['loginType'] != "Amministratore")
    header('Location: homepage.php');

if(isset($_SESSION['username']))
    $adminLoggato = getAdminFromUsername($_SESSION['username']);
else
    echo "<p>ERRORE</p>";


if(isset($_POST['matricola']) && $_POST['utenza'] == "studente")
    $studente = getStudenteFromMatricola($_POST['matricola']);
elseif(isset($_POST['matricola']) && $_POST['utenza'] == "docente")
    $docente = getDocenteFromMatricola($_POST['matricola']);
elseif(isset($_POST['username']) && $_POST['utenza'] == "segretario")
    $segretario = getSegretarioFromUsername($_POST['username']);



if(isset($_POST['invioStudente'])) {
    if($_POST['nuovaMatricola'] == 0) {
        setcookie('modificaUtenza', "ERRORE: Non può esistere uno studente con matricola 0!");
        header('Location: avvisoErrore.php');
    }
    if($_POST['matricola'] != $_POST['nuovaMatricola']) {
        if(verificaPresenzaMatricolaStudente($_POST['nuovaMatricola'])) {
            setcookie('modificaUtenza', "ERRORE: È già presente uno studente con matricola {$_POST['nuovaMatricola']}!");
            header('Location: avvisoErrore.php');
        }
        else {
            if(modificaStudente($_POST['matricola'], $_POST['nome'], $_POST['cognome'], $_POST['nuovaMatricola'], $_POST['corsoLaurea'], $_POST['dataNascita'], $_POST['password'])) {
                if(modificaAffiniStudente($_POST['matricola'], $_POST['nuovaMatricola']))
                    header('Location: avvisoOK.php');
            }
            else {
                setcookie('modificaUtenza', "ERRORE: Modifica studente fallita.");
                header('Location: avvisoErrore.php');
            }
        }
    }
    elseif($_POST['matricola'] == $_POST['nuovaMatricola']) {
        if(modificaStudente($_POST['matricola'], $_POST['nome'], $_POST['cognome'], $_POST['nuovaMatricola'], $_POST['corsoLaurea'], $_POST['dataNascita'], $_POST['password']))
            header('Location: avvisoOK.php');
        else {
            setcookie('modificaUtenza', "ERRORE: Modifica studente fallita.");
            header('Location: avvisoErrore.php');
        }
    }
}

elseif(isset($_POST['invioDocente'])) {
    if($_POST['nuovaMatricola'] == 0) {
        setcookie('modificaUtenza', "ERRORE: Non può esistere un docente con matricola 0!");
        header('Location: avvisoErrore.php');
    }
    if($_POST['matricola'] != $_POST['nuovaMatricola']) {
        if(verificaPresenzaMatricolaDocente($_POST['nuovaMatricola'])) {
            setcookie('modificaUtenza', "ERRORE: È già presente un docente con matricola {$_POST['nuovaMatricola']}!");
            header('Location: avvisoErrore.php');
        }
        else {
            if(modificaDocente($_POST['matricola'], $_POST['nome'], $_POST['cognome'], $_POST['nuovaMatricola'], $_POST['password'])) {
                if(modificaAffiniDocente($_POST['matricola'], $_POST['nuovaMatricola']))
                    header('Location: avvisoOK.php');
            }
            else {
                setcookie('modificaUtenza', "ERRORE: Modifica docente fallita.");
                header('Location: avvisoErrore.php');
            }
        }
    }
    elseif($_POST['matricola'] == $_POST['nuovaMatricola']) {
        if(modificaDocente($_POST['matricola'], $_POST['nome'], $_POST['cognome'], $_POST['nuovaMatricola'], $_POST['password']))
            header('Location: avvisoOK.php');
        else {
            setcookie('modificaUtenza', "ERRORE: Modifica docente fallita.");
            header('Location: avvisoErrore.php');
        }
    }
}

elseif(isset($_POST['invioSegretario'])) {
    if($_POST['nuovoUsername']) {
        setcookie('modificaUtenza', "ERRORE: Non può esistere un segretario con username nullo!");
        header('Location: avvisoErrore.php');
    }
    if($_POST['username'] != $_POST['nuovoUsername']) {
        if(verificaPresenzaUsernameSegretario($_POST['nuovoUsername'])) {
            setcookie('modificaUtenza', "ERRORE: È già presente un segretario con username '{$_POST['nuovoUsername']}'!");
            header('Location: avvisoErrore.php');
        }
        else {
            if(modificaSegretario($_POST['username'], $_POST['nuovoUsername'], $_POST['password']))
                header('Location: avvisoOK.php');
            else {
                setcookie('modificaUtenza', "ERRORE: Modifica segretario fallita.");
                header('Location: avvisoErrore.php');
            }
        }
    }
    elseif($_POST['username'] == $_POST['nuovoUsername']) {
        if(modificaSegretario($_POST['username'], $_POST['nuovoUsername'], $_POST['password']))
            header('Location: avvisoOK.php');
        else {
            setcookie('modificaUtenza', "ERRORE: Modifica segretario fallita.");
            header('Location: avvisoErrore.php');
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
    <title>Modifica utenza - InfoStuff</title>
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
                <?php
                    if($_POST['utenza'] == "studente")
                        echo "<h2>MODIFICA STUDENTE</h2>";
                    if($_POST['utenza'] == "docente")
                        echo "<h2>MODIFICA DOCENTE</h2>";
                    if($_POST['utenza'] == "segretario")
                        echo "<h2>MODIFICA SEGRETARIO</h2>";
                ?>
                </div>
                <div class="infoTitle-user">
                <?php
                    if($_POST['utenza'] == "studente")
                        echo "<h2>{$studente->nome} {$studente->cognome}, {$studente->matricola}</h2>";
                    if($_POST['utenza'] == "docente")
                        echo "<h2>{$docente->nome} {$docente->cognome}, {$docente->matricola}</h2>";
                    if($_POST['utenza'] == "segretario")
                        echo "<h2>{$segretario->username}</h2>";
                ?>
                </div>
            </div>
            <div>    
                <hr class="redBar" />
            </div>
            <?php
            if($_POST['utenza'] == "studente") {
            ?>
            <div class="boxInsC">
            <form action="modificaUtenza.php" method="POST" id="input">
                <div class="insContainer">
                    <div class="labels">
                        <h3>Nome: </h3>
                        <h3>Cognome: </h3>
                        <h3>Matricola: </h3>
                        <h3>Corso di Laurea: </h3>
                        <h3>Data di nascita: </h3>
                        <h3>Password: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    echo "<input class=\"textField\" type=\"text\" name=\"nome\" value=\"{$studente->nome}\" required>";
                    echo "<input class=\"textField\" type=\"text\" name=\"cognome\" value=\"{$studente->cognome}\" required>";
                    echo "<input class=\"textField\" type=\"text\" name=\"nuovaMatricola\" value=\"{$studente->matricola}\" required>";
                    ?>
                    <select class="choice" name="corsoLaurea" style="width: 80%" onfocus='this.size=4; this.style="width: 95%; overflow-x: auto;";' onblur='this.size=1; this.style="width: 80%;";' onchange='this.size=1; this.blur(); this.style="width: 80%;";'>
                        <?php
                            $nomeCDL = getNomeCorsoDiLaureaByID($studente->idCorsoLaurea);
                            echo "<option value=\"{$studente->idCorsoLaurea}\">{$nomeCDL}</option>";
                                        
                            $corsiLaurea = [];
                            $corsiLaurea = getCorsiDiLaurea();
                            foreach($corsiLaurea as $corsoDiLaurea) {
                                echo "<option value=\"{$corsoDiLaurea->id}\">{$corsoDiLaurea->nome}</option>";
                            }
                        ?>
                    </select>
                    <?php
                    echo "<input class=\"textField\" type=\"date\" name=\"dataNascita\" value=\"{$studente->dataNascita}\" required>";
                    ?>
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <input class="textField" type="password" name="password" id="pwd">
                        <img src="show.png" width="30px" height="30px" id="img" onclick="showHidePassword()">
                    </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 50%;">
                    <input class="bottoni" type="submit" name="invioStudente" value="MODIFICA" style="width: 60%;">
                    <input type="hidden" name="matricola" value="<?php echo $_POST['matricola']; ?>">
                </div>
            </form>
            </div>
            <?php
            }
            elseif($_POST['utenza'] == "docente") {
            ?>
            <div class="boxInsC">
            <form action="modificaUtenza.php" method="POST" id="input">
                <div class="insContainer">
                    <div class="labels">
                        <h3>Nome: </h3>
                        <h3>Cognome: </h3>
                        <h3>Matricola: </h3>
                        <h3>Password: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    echo "<input class=\"textField\" type=\"text\" name=\"nome\" value=\"{$docente->nome}\" required>";
                    echo "<input class=\"textField\" type=\"text\" name=\"cognome\" value=\"{$docente->cognome}\" required>";
                    echo "<input class=\"textField\" type=\"text\" name=\"nuovaMatricola\" value=\"{$docente->matricola}\" required>";
                    ?>
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <input class="textField" type="password" name="password" id="pwd">
                        <img src="show.png" width="30px" height="30px" id="img" onclick="showHidePassword()">
                    </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 50%;">
                    <input class="bottoni" type="submit" name="invioDocente" value="MODIFICA" style="width: 60%;">
                    <input type="hidden" name="matricola" value="<?php echo $_POST['matricola']; ?>">
                </div>
            </form>
            </div>
            <?php
            }
            elseif($_POST['utenza'] == "segretario") {
            ?>
            <div class="boxInsC">
            <form action="modificaUtenza.php" method="POST" id="input">
                <div class="insContainer">
                    <div class="labels">
                        <h3>Username: </h3>
                        <h3>Password: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    echo "<input class=\"textField\" type=\"text\" name=\"nuovoUsername\" value=\"{$segretario->username}\" required>";
                    ?>
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <input class="textField" type="password" name="password" id="pwd">
                        <img src="show.png" width="30px" height="30px" id="img" onclick="showHidePassword()">
                    </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 50%;">
                    <input class="bottoni" type="submit" name="invioSegretario" value="MODIFICA" style="width: 60%;">
                    <input type="hidden" name="username" value="<?php echo $_POST['username']; ?>">
                </div>
            </form>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>

<script>
function showHidePassword() {
    var input = document.getElementById('pwd');     // Input type
    var img = document.getElementById('img');       // Occhiolino

    if(input.type === "password") {                 // Se è oscurata, mostrala in chiaro
        input.type = "text";
        img.src = "hide.webp";
    }
    else {                                          // Se è mostrata in chiaro, oscurala
        if(input.type === "text") {
            input.type = "password";
            img.src = "show.png";
        }
    }
}
</script>