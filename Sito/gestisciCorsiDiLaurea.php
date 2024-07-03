<?php
session_start();
$_SESSION['src'] = "edit";
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");


if(!isset($_SESSION['loginType']) || $_SESSION['loginType'] != "Amministratore")
    header('Location: homepage-users.php');


if(isset($_SESSION['username']) && $_SESSION['loginType'] == "Amministratore")
    $adminLoggato = getAdminFromUsername($_SESSION['username']);
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
    <title>Gestisci corsi di laurea - InfoStuff</title>
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
        <div class="nav-central">
            <form action="gestisciCorsiDiLaurea.php" method="POST">
                <div class="nav-logo">
                    <input type="submit" name="ricerca" value="">
                    <img src="search.png" alt="err" width="20px" style="display: inline-flex;">
                </div>    
                    <input type="text" name="filtro">              
            </form>
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
                    <h2 class="hForm" style="">
                        <form action="">
                            <input type="button" value="">
                        </form>
                        Gestisci corsi di laurea
                    </h2>
                </div>
                <div class="infoTitle-user">
                <?php
                if(isset($_SESSION['username']) && $_SESSION['loginType'] == "Amministratore")
                    echo "<h2>{$adminLoggato->username}</h2>";               
                ?>
                </div>
            </div>    
            <div><hr class="redBar" /></div>
            <div class="container-esami">
                <?php
                if(isset($_POST['filtro']) && $_POST['filtro'] != "")
                    displayCorsiDiLaureaLike($_POST['filtro']);
                else
                    displayCorsiDiLaurea();
                ?>           
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
