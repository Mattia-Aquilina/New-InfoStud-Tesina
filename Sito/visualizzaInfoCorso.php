<?php
session_start();
require_once('../Sito/phpFunctions-get.php');
if(!isset($_POST['idCorso'])) {
    if(isset($_SESSION['loginType']))
        header('Location: homepage-users.php');
    else
        header('Location: homepage.php');
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stile-visualizza-esame.css">
    <link rel="stylesheet" href="stileVisualizzazioneLista.css">
    <title>Info corso - InfoStuff</title>
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
            <div class="info-section">
                <div class="exam-block">
                    <?php
                        //Otteniamo le informazioni da stampare
                        $idCorso = $_POST['idCorso'];

                        $corso = getCorsoById($idCorso);       
                    ?>
                    <div class="exam-title">
                        <h2 style="margin-left: 2%;"><?php echo $corso->nome?></h2>
                    </div>   
                    <div><hr class="blackBar" /></div>   
                    <div class="sub-titles ">
                        <h3 style="margin-left: 2%;">Obiettivi</h3>
                    </div>
                    <div class="text-container">
                        <?php echo $corso->descrizione?>
                    </div> 
                    <div><hr class="blackBar" /></div>
                    <div class="sub-titles ">
                        <h3 style="margin-left: 2%;">Docente: <?php
                        if($corso->matricolaDocente == 0)
                            echo "Docente in fase di assegnazione";
                        else {
                            $prof = getDocenteFromMatricola($corso->matricolaDocente);
                            echo "{$prof->nome} {$prof->cognome}";
                        }
                        ?></h3>
                    </div>
                    <?php
                        if($corso->matricolaCoDocente != 0) { ?>
                            <div class="sub-titles ">
                                <h3 style="margin-left: 2%;">Co-Docente: <?php
                                $prof = getDocenteFromMatricola($corso->matricolaCoDocente);
                                echo "{$prof->nome} {$prof->cognome}"; ?></h3>
                            </div>
                   <?php }?>
                </div>
                <div class="info-block">
                    <div class="box-title">
                        <h3 style="margin-left: 3%;">Scheda Insegnamento</h3>
                    </div>
                    <div class="box-list">
                        <ul>
                            <li>Curriculum: <?php echo $corso->curriculum; ?></li>
                            <li>Anno: <?php echo $corso->anno; ?></li>
                            <li>Semestre: <?php echo $corso->semestre; ?></li>
                            <li>SSD: <?php echo $corso->ssd; ?></li>
                            <li>CFU: <?php echo $corso->cfu; ?></li>
                            <li>Corso di laurea: <?php
                                $corsoDiLaurea = getNomeCorsoDiLaureaByID($corso->idCorsoLaurea);
                                echo $corsoDiLaurea; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
