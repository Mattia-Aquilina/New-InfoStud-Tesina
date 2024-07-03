<?php
require_once('phpFunctions-insert.php');
require_once('phpFunctions-get.php');
require_once('phpFunctions-misc.php');
require_once('phpClasses.php');

if(isset($_POST['loginType'])) {
    $login = $_POST['loginType'];

    if(isset($_POST['invio'])) {
        $presenza_dati = FALSE;

        switch($login) {
            case "Studente":
                if((isset($_POST['nome']) && $_POST['nome'] != "") && (isset($_POST['cognome']) && $_POST['cognome'] != "") && (isset($_POST['dataNascita']) && $_POST['dataNascita'] != "") && (isset($_POST['password']) && $_POST['password'] != "") && (isset($_POST['corsoLaurea']) && $_POST['corsoLaurea'] != "seleziona")) {
                    $presenza_dati = TRUE;
                    
                    $studente = new studente (
                        $_POST['nome'], 
                        $_POST['cognome'], 
                        encryptPassword($_POST['password']), 
                        $_POST['dataNascita'],
                        $_POST['corsoLaurea']
                    );             

                    if(!inserisciStudente($studente))
                        header('Location: avvisoErrore.php');
                    else {
                        setcookie('matricola', $studente->matricola);
                        header('Location: avvisoOK.php');
                    }
                }
                break;

            case "Docente":
                if((isset($_POST['nome']) && $_POST['nome'] != "") && (isset($_POST['cognome']) && $_POST['cognome'] != "") && (isset($_POST['password']) && $_POST['password'] != "")) {
                    $presenza_dati = TRUE;

                    $idCorso = 0;

                    $docente = new docente (
                        $_POST['nome'],
                        $_POST['cognome'],
                        encryptPassword($_POST['password']),
                        $idCorso
                    );

                    if(!inserisciDocente($docente))
                        header('Location: avvisoErrore.php');
                    else {
                        setcookie('matricola', $docente->matricola);
                        header('Location: avvisoOK.php');
                    }
                }
                break;

            case "Segretario":
                if((isset($_POST['username']) && $_POST['username'] != "") && (isset($_POST['password']) && $_POST['password'] != "")) {
                    $presenza_dati = TRUE;

                    $segretario = new segretario (
                        $_POST['username'],
                        encryptPassword($_POST['password'])
                    );

                    if(!inserisciSegretario($segretario))
                        header('Location: avvisoErrore.php');
                    else
                        header('Location: avvisoOK.php');
                }
                break;

            case "Amministratore":
                if((isset($_POST['username']) && $_POST['username'] != "") && (isset($_POST['password']) && $_POST['password'] != "")) {
                    $presenza_dati = TRUE;

                    $amministratore = new amministratore (
                        $_POST['username'],
                        encryptPassword($_POST['password'])
                    );

                    if(!inserisciAmministratore($amministratore))
                        header('Location: avvisoErrore.php');
                    else
                        header('Location: avvisoOK.php');
                }
                break;
        }
    }
}
else {
    header('Location: homepage.php');
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileLogin.css">
    <link rel="stylesheet" href="stile-amministrazione.css">
    <title>Registrazione - InfoStuff</title>
</head>
<body class="bodyLogin">
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
        </div>
        <div class="nav-right">
            <h2>
                <form action="login.php" method="POST">
                    <input type="submit" value="">
                    <input name="loginType" type="hidden" value="Studente">
                </form>
                    Studenti      
            </h2>
            <div class="vertical-bar"></div>
            <h2>
                <form action="login.php" method="POST">
                    <input type="submit" value="">
                    <input name="loginType" type="hidden" value="Docente">
                </form>
                    Docenti
                
            </h2>
            <div class="vertical-bar"></div>
            <h2>
                <form action="login.php" method="POST">
                    <input type="submit" value="">
                    <input name="loginType" type="hidden" value="Segretario">
                </form>
                    Segreteria
                
            </h2>
            <div class="vertical-bar"></div>
            <h2>
                <form action="login.php" method="POST">
                    <input type="submit" value="">
                    <input name="loginType" type="hidden" value="Amministratore">
                </form>
                    Amministrazione
            </h2>   
        </div>
    </div>
    <div class="central-block">
        <div class="bodyReg">
            <h2 class="title">Registrazione <?php echo $login; ?></h2>
            <?php
            if($login == "Studente") {?>
            <div class="boxReg">
            <form action="form_registrazione.php" method="POST">
                <div class="regContainer">
                    <div class="labels">
                        <h3>Nome: </h3>
                        <h3>Cognome: </h3>
                        <h3>Data di nascita: </h3>
                        <h3>Corso di laurea: </h3>
                        <h3>Password: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    if(isset($_POST['nome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"nome\" value=\"{$_POST['nome']}\" required>";
                    elseif(!isset($_POST['nome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"nome\" required>";
                    
                    if(isset($_POST['cognome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"cognome\" value=\"{$_POST['cognome']}\" required>";
                    elseif(!isset($_POST['cognome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"cognome\" required>";
                    
                    if(isset($_POST['dataNascita']))
                        echo "<input class=\"textField\" type=\"date\" name=\"dataNascita\" value=\"{$_POST['dataNascita']}\" required>";
                    elseif(!isset($_POST['dataNascita']))
                        echo "<input class=\"textField\" type=\"date\" name=\"dataNascita\" required>";
                    ?>
                    <select class="choice" name="corsoLaurea" style="width: 80%;" onfocus='this.size=4; this.style="width: 100%; overflow-x: auto;";' onblur='this.size=1; this.style="width: 80%;";' onchange='this.size=1; this.blur(); this.style="width: 80%;";'>
                        <?php
                            if(isset($_POST['corsoLaurea']) && $_POST['corsoLaurea'] != "seleziona") {
                                $nomeCDL = getNomeCorsoDiLaureaByID($_POST['corsoLaurea']);
                                echo "<option value=\"{$_POST['corsoLaurea']}\">{$nomeCDL}</option>";
                            }
                            elseif(!isset($_POST['corsoLaurea']))
                                echo "<option value=\"seleziona\">Corso di laurea...</option>";
                                        
                            $corsiLaurea = [];
                            $corsiLaurea = getCorsiDiLaurea();
                            foreach($corsiLaurea as $corso) {
                                echo "<option value=\"{$corso->id}\">{$corso->nome}</option>";
                            }
                        ?>
                    </select>
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <input class="textField" type="password" name="password" id="pwd" required>
                        <img src="show.png" width="30px" height="30px" id="img" onclick="showHidePassword()">
                    </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 30%;">
                    <input class="bottoni" type="submit" name="invio" value="INVIO">
                    <input name="loginType" type="hidden" value="Studente">
                </div>
            </form>
            </div>
            <?php
            }
            elseif($login == "Docente") {?>
            <div class="boxReg">
            <form action="form_registrazione.php" method="POST">
                <div class="regContainer">
                    <div class="labels">
                        <h3>Nome: </h3>
                        <h3>Cognome: </h3>
                        <h3>Password: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    if(isset($_POST['nome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"nome\" value=\"{$_POST['nome']}\" required>";
                    elseif(!isset($_POST['nome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"nome\" required>";
                    
                    if(isset($_POST['cognome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"cognome\" value=\"{$_POST['cognome']}\" required>";
                    elseif(!isset($_POST['cognome']))
                        echo "<input class=\"textField\" type=\"text\" name=\"cognome\" required>";
                    ?>
                        
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <input class="textField" type="password" name="password" id="pwd" required>
                        <img src="show.png" width="30px" height="30px" id="img" onclick="showHidePassword()">
                    </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 30%;">
                    <input class="bottoni" type="submit" name="invio" value="INVIO">
                    <input name="loginType" type="hidden" value="Docente">
                </div>
            </form>
            </div>
            <?php
            }
            elseif($login == "Segretario") {?>
            <div class="boxReg">
            <form action="form_registrazione.php" method="POST">
                <div class="regContainer">
                    <div class="labels">
                        <h3>Username: </h3>
                        <h3>Password: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    if(isset($_POST['username']))
                        echo "<input class=\"textField\" type=\"text\" name=\"username\" value=\"{$_POST['username']}\" required>";
                    elseif(!isset($_POST['username']))
                        echo "<input class=\"textField\" type=\"text\" name=\"username\" required>";
                    ?>
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <input class="textField" type="password" name="password" id="pwd" required>
                        <img src="show.png" width="30px" height="30px" id="img" onclick="showHidePassword()">
                    </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 30%;">
                    <input class="bottoni" type="submit" name="invio" value="INVIO">
                    <input name="loginType" type="hidden" value="Segretario">
                </div>
            </form>
            </div>
            <?php
            }
            elseif($login == "Amministratore") {?>
            <div class="boxReg">
            <form action="form_registrazione.php" method="POST">
                <div class="regContainer">
                    <div class="labels">
                        <h3>Username: </h3>
                        <h3>Password: </h3>
                    </div>
                    <div class="inputs">
                    <?php
                    if(isset($_POST['username']))
                        echo "<input class=\"textField\" type=\"text\" name=\"username\" value=\"{$_POST['username']}\" required>";
                    elseif(!isset($_POST['username']))
                        echo "<input class=\"textField\" type=\"text\" name=\"username\" required>";
                    ?>
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <input class="textField" type="password" name="password" id="pwd" required>
                        <img src="show.png" width="30px" height="30px" id="img" onclick="showHidePassword()">
                    </div>
                    </div>
                </div>
                <div style="padding-top: 1%; margin-left: 30%;">
                    <input class="bottoni" type="submit" name="invio" value="INVIO">
                    <input name="loginType" type="hidden" value="Amministratore">
                </div>
            </form>
            </div>
            <?php
            }
            if(isset($_POST['invio']) && !$presenza_dati) {
                // Manca qualche dato
            echo "
                <div class=\"box4\">
                    <h2 class=\"error\">DATI MANCANTI! Riprovare.</h2>
                </div>";
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