<?php
require_once('../Sito/phpFunctions-login.php');


if(isset($_POST['loginType'])) {
    $login = $_POST['loginType'];

    if(isset($_POST['login'])) {
        $presenzaDati = FALSE;
        $registrato = FALSE;
        $autenticato = FALSE;

        switch($login) {
            case "Studente":
                if((isset($_POST['matricola']) && $_POST['matricola'] != "") && ((isset($_POST['password']) && $_POST['password'] != ""))) {
                    $presenzaDati = TRUE;
                        
                    $registrato = verificaPresenzaMatricola($_POST['matricola'], $login);
                    if($registrato)
                        $autenticato = verificaPasswordStudentiDocenti($_POST['matricola'], $_POST['password'], $login);
                        
                    if($autenticato) {
                        session_start();
                        $_SESSION['loginType'] = $login;
                        $_SESSION['matricola'] = $_POST['matricola'];
                        header('Location: homepage-users.php'); 
                    }
                }
                break;
                    
            case "Docente":
                if((isset($_POST['matricola']) && $_POST['matricola'] != "") && ((isset($_POST['password']) && $_POST['password'] != ""))) {
                    $presenzaDati = TRUE;

                    $registrato = verificaPresenzaMatricola($_POST['matricola'], $login);
                    if($registrato)
                        $autenticato = verificaPasswordStudentiDocenti($_POST['matricola'], $_POST['password'], $login);
                        
                    if($autenticato) {
                        session_start();
                        $_SESSION['loginType'] = $login;
                        $_SESSION['matricola'] = $_POST['matricola'];
                        header('Location: homepage-users.php');
                    }
                }
                break;

            case "Segretario":
                if((isset($_POST['username']) && $_POST['username'] != "") && ((isset($_POST['password']) && $_POST['password'] != ""))) {
                    $presenzaDati = TRUE;

                    $registrato = verificaPresenzaUsername($_POST['username'], $login);
                    if($registrato)
                        $autenticato = verificaPasswordSegretarioAmministratore($_POST['username'], $_POST['password'], $login);
                        
                    if($autenticato) {
                        session_start();
                        $_SESSION['loginType'] = $login;
                        $_SESSION['username'] = $_POST['username'];
                        header('Location: homepage-users.php');
                    }
                }
                break;

            case "Amministratore":
                if((isset($_POST['username']) && $_POST['username'] != "") && ((isset($_POST['password']) && $_POST['password'] != ""))) {
                    $presenzaDati = TRUE;

                    $registrato = verificaPresenzaUsername($_POST['username'], $login);
                    if($registrato)
                        $autenticato = verificaPasswordSegretarioAmministratore($_POST['username'], $_POST['password'], $login);
                        
                    if($autenticato) {
                        session_start();
                        $_SESSION['loginType'] = $login;
                        $_SESSION['username'] = $_POST['username'];
                        header('Location: homepage-users.php');
                    }
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
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Login - InfoStuff</title>
    <link rel="stylesheet" href="stileLogin.css">
    <link rel="stylesheet" href="stile-base.css">
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
        <h2 class="title">Login <?php echo $login; ?></h2> 

        <form action="login.php" method="POST">
        <div class="box">
            <?php
                if(isset($_POST['loginType']) && ($login == "Studente" || $login == "Docente")) {
            ?>
            <h2>Matricola:</h2>
            <?php
                }
                elseif(isset($_POST['loginType']) && ($login == "Segretario" || $login == "Amministratore")) {
            ?>
            <h2>Username:</h2>
            <?php
                }

                if(isset($_POST['matricola']) && ($login == "Studente" || $login == "Docente")) {
                    echo "<input class=\"textField\" type=\"text\" name=\"matricola\" value=\"{$_POST['matricola']}\" required>";
                }
                elseif(!isset($_POST['matricola']) && ($login == "Studente" || $login == "Docente")) {
                ?>
                    <input class="textField" type="text" name="matricola" required>
                <?php
                }
                elseif(isset($_POST['username']) && ($login == "Segretario" || $login == "Amministratore")) {
                    echo "<input class=\"textField\" type=\"text\" name=\"matricola\" value=\"{$_POST['username']}\" required>";
                }
                elseif(!isset($_POST['username']) && ($login == "Segretario" || $login == "Amministratore")) {
                ?>
                    <input class="textField" type="text" name="username" required>
                <?php
                }
            ?>
            <br />
            <h2>Password:</h2>
            <div style="display: flex; flex-direction: row; align-items: center;justify-content:center;">
                <input class="textField" type="password" name="password" id="pwd" required>
                <div style="display: flex;position: relative;align-items: center;">
                    <img src="show.png" width="30px" height="30px" id="img" style="position:absolute;" onclick="showHidePassword()">
                </div>
            </div>
            <br />
            <input class="bottoni" type="submit" name="login" value="LOGIN">
            <input name="loginType" type="hidden" value="<?php echo $login; ?>">
            </form>
            <form action="form_registrazione.php" method="POST">
                <div style="justify-content: center; display: flex; flex-direction: row; margin-top: 2em;">
                    <h3>oppure</h3>
                    <input class="bottoni2" type="submit" name="reg" value="REGISTRATI">
                    <input name="loginType" type="hidden" value=<?php echo $login ?>>
                </div>
            </form>
        </div> 
        <?php
        if(isset($_POST['login'])) {
            if(!$presenzaDati) {                // Manca qualche dato
                echo "
                    <div class=\"box4\">
                        <h2 class=\"error\">DATI MANCANTI! Riprovare.</h2>
                    </div>";
            }
            if($presenzaDati && !$registrato) {                  // Utente non registrato
                echo "
                    <div class=\"box4\">
                        <h2 class=\"error\">UTENTE NON REGISTRATO! Riprovare.</h2>
                    </div>";
            }
            if($presenzaDati && $registrato && !$autenticato) {  // Password errata
                echo "
                    <div class=\"box4\">
                        <h2 class=\"error\">PASSWORD ERRATA! Riprovare.</h2>
                    </div>";
            }
        }
        ?>
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