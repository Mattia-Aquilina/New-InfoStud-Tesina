<?php
require_once('../Sito/phpFunctions-display.php');
require_once('../Sito/phpFunctions-get.php');
session_start();

if(!isset($_GET['gestisciStudente']) && !isset($_GET['gestisciDocente']) && !isset($_GET['gestisciSegretario'])) {
    header('Location: homepage-users.php');
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
    <title>Gestione Utenza - InfoStuff</title>
</head>
<body style="background-color: gainsboro;">
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
        <?php
        if(!isset($_SESSION['loginType'])) {?>
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
        <?php
        }
        elseif(isset($_SESSION['loginType'])) {?>
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
        <?php
        }?>    
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
                    if(isset($_GET['gestisciStudente']))
                        echo '<h2 style="margin-left: 3%;">GESTIONE STUDENTE</h2>';
                    elseif(isset($_GET['gestisciDocente']))
                        echo '<h2 style="margin-left: 3%;">GESTIONE DOCENTE</h2>';
                    elseif(isset($_GET['gestisciSegretario']))
                        echo '<h2 style="margin-left: 3%;">GESTIONE SEGRETARIO</h2>';
                    ?>
                </div>
                <div class="infoTitle-user">
                <?php
                    if(isset($_GET['gestisciStudente'])) {
                        $studente = getStudenteFromMatricola($_GET['matricola']);
                        echo "<h2 style=\"margin-right: 3%;\">{$studente->nome} {$studente->cognome}, {$studente->matricola}</h2>";
                        $utenza = 'studente';
                        $id = $studente->matricola;
                        $stato = $studente->stato;
                    }
                    elseif(isset($_GET['gestisciDocente'])) {
                        $docente = getDocenteFromMatricola($_GET['matricola']);
                        echo "<h2 style=\"margin-right: 3%;\">{$docente->nome} {$docente->cognome}, {$docente->matricola}</h2>";
                        $utenza = 'docente';
                        $id = $docente->matricola;
                        $stato = $docente->stato;
                    }
                    elseif(isset($_GET['gestisciSegretario'])) {       
                        $segretario = getSegretarioFromUsername($_GET['username']);
                        echo "<h2 style=\"margin-right: 3%;\">{$segretario->username}</h2>";
                        $utenza = 'segretario';
                        $id = $segretario->username;
                        $stato = $segretario->stato;
                    }?>
                </div>
            </div>    
            <div><hr class="redBar" /></div>
            <?php
                if(isset($_GET['gestisciStudente'])) 
                    displayFullStudente($studente);

                elseif(isset($_GET['gestisciDocente'])) 
                    displayFullDocente($docente);
                    
                elseif(isset($_GET['gestisciSegretario']))
                    displayFullSegretario($segretario);
            ?>
            <div class="menuAdmin" style="margin-left: 30%; margin-top: 5%;">
                <form action="modificaUtenza.php" style="" method="POST">
                    <input class="admin" type="submit" value="MODIFICA">
                <?php
                    if(isset($_GET['gestisciStudente'])) {
                        echo '
                        <input type="hidden" name="matricola" value="'.$_GET['matricola'].'">
                        <input type="hidden" name="utenza" value="studente">';
                    }
                    elseif(isset($_GET['gestisciDocente'])) {
                        echo '
                        <input type="hidden" name="matricola" value="'.$_GET['matricola'].'">
                        <input type="hidden" name="utenza" value="docente">';
                    }
                    elseif(isset($_GET['gestisciSegretario'])) {
                        echo '
                        <input type="hidden" name="username" value="'.$_GET['username'].'">
                        <input type="hidden" name="utenza" value="segretario">';
                    }
                ?>
                </form>
                <?php
                    if($stato == 1) { ?>
                        <form action="sospendiUtente.php" style="margin-left: 20%;" method="POST">
                            <input class="admin" type="submit" value="SOSPENDI" name="sospendi">
                            <input type="hidden" name="utenza" value="<?php echo $utenza ?>">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </form>
                <?php } else { ?> 
                        <form action="riabilitaUtente.php" style="margin-left: 20%;" method="POST">
                            <input class="admin" type="submit" value="RIABILITA" name="riabilita">
                            <input type="hidden" name="utenza" value="<?php echo $utenza ?>">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </form>
                <?php } ?>
                <form action="eliminaUtenza-script.php" style="margin-left: 20%;" method="POST" onsubmit="alertClick()">
                    <input class="admin" type="submit" name="elimina" value="ELIMINA">
                <?php
                    if(isset($_GET['gestisciStudente'])) {
                        echo '
                        <input type="hidden" name="matricola" value="'.$_GET['matricola'].'">
                        <input type="hidden" name="utenza" value="studente">';
                    }
                    elseif(isset($_GET['gestisciDocente'])) {
                        echo '
                        <input type="hidden" name="matricola" value="'.$_GET['matricola'].'">
                        <input type="hidden" name="utenza" value="docente">';
                    }
                    elseif(isset($_GET['gestisciSegretario'])) {
                        echo '
                        <input type="hidden" name="username" value="'.$_GET['username'].'">
                        <input type="hidden" name="utenza" value="segretario">';
                    }
                ?>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function alertClick(){
        let cnf = confirm("Sei sicuro di voler effettuare l'eliminazione?")
        if(!cnf) event.preventDefault(); 
    } 
</script>
