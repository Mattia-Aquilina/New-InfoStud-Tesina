<?php
session_start();
require_once('../Sito/phpFunctions-get.php');
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileVisualizzazioneLista.css">
    <title>Corsi di Laurea - InfoStuff</title>
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
        <div class="nav-central">
            <form action="visualizzaCorsiDiLaurea.php" method="POST">
                <div class="nav-logo">
                    <input type="submit" name="ricerca" value="">
                    <img src="search.png" alt="err" width="20px" style="display: inline-flex;">
                </div>    
                    <input type="text" name="filtro">              
            </form>
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
        <div class="sidebar">
            <div style="display: flex;">
                <h5 style="display: flex; margin: 0px;">
                    <a class="opzione" href="homepage.php">Homepage</a>
                </h5>
            </div>
            <div style="display: flex;">
                <h5 style="display: flex; margin: 0px;">
                    <a class="opzione" href="visualizzaCorsi.php">I nostri corsi</a>
                </h5>
            </div>
            <div style="display: flex;">
                <h5 style="display: flex; margin: 0px;">
                    <a class="opzione" href="visualizzaDocenti.php">I nostri docenti</a>
                </h5>
            </div>
        </div>
        <div class="body">
            <h2 style="margin-left: 2.5%; font-size: 200%;">I NOSTRI CORSI DI LAUREA:</h2>
            <div><hr class="redBar" /></div>
            <div class="listContainer">
                <div class="listItem">
                    <div class="element">
                        <h2>Corso di Laurea</h2>
                    </div>
                </div>
                <hr />
            <?php
                $corsiDiLaurea = [];
                if(isset($_POST['filtro']) && $_POST['filtro'] != "") {
                    $corsiDiLaurea = getCorsiDiLaureaLike($_POST['filtro']);

                    if(!$corsiDiLaurea) {
                        echo "<h3 class=\"voceElenco\">Non sono disponibili corsi di laurea corrispondenti ai criteri di ricerca.</h3>";
                    }
                    else {
                        foreach($corsiDiLaurea as $corsoDiLaurea) {
                        ?>
                            <div class="listItem">
                                <div class="element" style="width: 50%;">
                                    <h2><?php echo $corsoDiLaurea->nome; ?></h2>
                                </div>
                                <div class="lastElement" style="width: 50%;">
                                    <form action="visualizzaCorsiDaCorsoDiLaurea.php" method="POST">
                                        <input type="image" src="arrowBlack.png" class="arrow" width="30px" height="30px" alt="err">
                                        <input type="hidden" name="idCorsoLaurea" value="<?php echo $corsoDiLaurea->id; ?>">
                                    </form>
                                </div>
                            </div>
                            <hr />
                        <?php
                        }
                    }
                }
                else {
                    $corsiDiLaurea = getCorsiDiLaurea();

                    if(!$corsiDiLaurea) {
                        echo "<h3 class=\"voceElenco\">Al momento non sono disponibili corsi di laurea.</h3>";
                    }
                    else {
                        foreach($corsiDiLaurea as $corsoDiLaurea) {
                        ?>
                            <div class="listItem">
                                <div class="element" style="width: 50%;">
                                    <h2><?php echo $corsoDiLaurea->nome; ?></h2>
                                </div>
                                <div class="lastElement" style="width: 50%;">
                                    <form action="visualizzaCorsiDaCorsoDiLaurea.php" method="POST">
                                        <input type="image" src="arrowBlack.png" class="arrow" width="30px" height="30px" alt="err">
                                        <input type="hidden" name="idCorsoLaurea" value="<?php echo $corsoDiLaurea->id; ?>">
                                    </form>
                                </div>
                            </div>
                            <hr />
                        <?php
                        }
                    }
                }
            ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>