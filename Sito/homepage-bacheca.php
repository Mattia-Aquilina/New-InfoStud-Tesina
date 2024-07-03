<?php
session_start();
require_once('../Sito/phpFunctions-get.php');
require_once('phpFunctions-display.php');


if(!isset($_SESSION['loginType']) || (isset($_SESSION['loginType']) && $_SESSION['loginType'] == "Docente"))
    header('Location: homepage.php');

if(isset($_SESSION['matricola']))
    $studenteLoggato = getStudenteFromMatricola($_SESSION['matricola']);

switch ($_SESSION['loginType']) {
    case 'Studente':
         # code...
        $utenzaLoggata = getStudenteFromMatricola($_SESSION['matricola']);
        $listaCorsi = getCorsiFromCorsoDiLaurea($utenzaLoggata->idCorsoLaurea);
        break;
    case 'Segretario':
        # code...
        $utenzaLoggata = getSegretarioFromUsername($_SESSION['username']);
        $listaCorsi = getCorsi();
        break;
    case 'Amministratore':
        # code...
        $utenzaLoggata = getAdminFromUsername($_SESSION['username']);
        $listaCorsi = getCorsi();
        break;    
    default:
        # code...
        break;
    }

    if($_SESSION['loginType']!= "Amministratore" && (int)$utenzaLoggata->stato == -1) { ?>
        <script>
            window.alert("sei stato sospeso da questa funzionalità");
            window.location.replace('homepage-users.php');
        </script>
    <?php 
    }
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileVisualizzazioneLista.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <title>Bacheca - InfoStuff</title>
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
                        Bacheche
                    </h2>
                </div>
                <div class="infoTitle-user">
                    <h2>
                        <?php 
                            if($_SESSION['loginType'] == 'Docente' || $_SESSION['loginType'] == 'Studente')
                                echo $utenzaLoggata->nome." ".$utenzaLoggata->cognome.", ".$utenzaLoggata->matricola;
                            else
                                echo $_SESSION['loginType'].": ".$utenzaLoggata->username;
                            ?>
                    </h2><!--Generato dallo script-->
                </div>
            </div>    
            <div><hr class="redBar" /></div>
        <div class="listContainer">
                <div class="listItem">
                    <div class="element">
                        <h2>Nome</h2>
                    </div>
                </div> 
                <hr />
                <?php foreach($listaCorsi as $corso) { ?>
                <form action="homepage-users-visualizzaBacheca.php" method="GET">
                    <div class="listItem">
                    <input type="submit" value="" class="bottoneCorsi"> <!--Struttura di ogni bottone -->
                                <input type="hidden" value="<?php echo $corso->id;?>" name="idCorso">
                                <input type="hidden" value="1" name="pageNum">
                        <div class="element">
                            <h2><?php echo $corso->nome;?></h2>
                        </div>
                        <div class="element">
                            
                        </div>
                        <div class="lastElement">
                            <img src="arrowBlack.png" alt="err" width="30px" height="30px" style="display:flex;align-content:center">
                        </div>
                    </div> 
                </form>
                <hr />
                <?php } ?>
        </div>
    </div>
</div>
</body>
</html>