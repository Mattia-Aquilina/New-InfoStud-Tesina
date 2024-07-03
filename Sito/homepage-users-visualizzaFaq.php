<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");


if(!isset($_SESSION['loginType']))
    header('Location: homepage.php');

//otteniamo l'oggetto associato all'utenza
if(!isset($_GET["idCorso"]) && $_SESSION['loginType']!= 'Docente')
    header('Location: homepage.php');


switch ($_SESSION['loginType']) {
    case 'Studente':
        $utenzaLoggata = getStudenteFromMatricola($_SESSION['matricola']);
        break;
    case 'Docente':
        $utenzaLoggata = getDocenteFromMatricola($_SESSION['matricola']);
        $corso = getCorsoById($_GET['idCorso']);
        break;
    case 'Segretario':
        $utenzaLoggata = getSegretarioFromUsername($_SESSION['username']);
        break;
    case 'Amministratore':
        $utenzaLoggata = getAdminFromUsername($_SESSION['username']);
        break;    
    default:
        break;
}
if($_SESSION['loginType']!= "Amministratore" && (int)$utenzaLoggata->stato == -1){ ?>
    <script>
        window.alert("sei stato sospeso da questa funzionalità");
        window.location.replace('homepage-users.php');
    </script>
<?php 
}

//otteniamo il corso che deve essere visualizzato
if($_SESSION['loginType']!= 'Docente') $corso = getCorsoById($_GET["idCorso"]);
$listaFaqComplete = getFaqComplete($corso->id);
$listaFaqIncomplete = getFaqIncomplete($corso->id);
$voto = [];
$colore = [];
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <link rel="stylesheet" href="stileBacheca.css">
    <link rel="stylesheet" href="stilePost.css">
    <link rel="stylesheet" href="stileFaq.css">
    <title>FAQ - InfoStuff</title>
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
            <div class="_body">
                <div class="infoTitle">
                    <div class="infoTitle-position">
                        <h2 style="margin-left: 3%; padding-right: 1%;" class="hForm"> 
                            <form action="homepage-users.php">
                                <input type="submit" value="">
                            </form>
                            Home >
                        </h2>
                        <h2 class="hForm" style="padding-right: 1%;">
                            <form action="homepage-faq.php">
                                <input type="submit" value="">
                            </form>
                            FAQ >
                        </h2>
                        <h2 class="hForm">
                            <form action="">
                                <input type="button" value="" name="dsa">
                            </form>
                            <?php echo getCorsoById($_GET['idCorso'])->nome;?>
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
                <!-- Container delle domande con risposta -->
                <div class="container">
                    <div class="title">
                        Domande e Risposte complete
                    </div>
                    <div>
                        <hr/>
                    </div>
                    <div class="faqContainer">      
                        <?php
                        
                        foreach($listaFaqComplete as $faq){
                            //Otteniamo i voti inviati dall'utente per la singola faq
                            ?>
                        
                            <div class="faq">
                                <?php
                                    //Controlliamo per ogni FAQ se è stata votata dall'utente
                                    //attualmente loggato
                                    if($_SESSION['loginType'] == 'Studente') {
                                        $voto[$faq->id] =  (float)getVotoFaq($_SESSION['matricola'],$faq->id);
                                        if($voto[$faq->id] > 0)
                                            $colore[$faq->id]  = "green";
                                        elseif($voto[$faq->id] < 0)
                                            $colore[$faq->id] = "red";
                                    }
                                ?>
                                <div  class="upDown">
                                    <form action="votaFaq.php" method="POST">
                                        <div>
                                            <img src="up.png" alt="dsa">
                                            <input type="hidden" value="1" name="type">
                                            <input type="hidden" value="<?php echo $faq->id?>" name="idFaq">
                                            <input type="hidden" value="<?php echo $corso->id?>" name="idCorso">
                                            <?php if($_SESSION['loginType'] == 'Studente' && $_SESSION['matricola'] !=  $faq->idAutore) {?>
                                                <input type="hidden" value="<?php echo $voto[$faq->id]?>" name="voto">
                                                <input type="submit" value="">
                                            <?php }else {?>
                                                <input type="button" onclick="window.alert('questa utenza non può votare')">
                                            <?php } ?>
                                        </div>
                                    </form>
                                    <div <?php if(isset($colore[$faq->id])) echo "style=color:{$colore[$faq->id]}"?>>
                                        <?php echo getUtilitaTotale($faq->id)?>
                                    </div>
                                    <form action="votaFaq.php" method="POST">
                                        <div>
                                            <img src="down.png" alt="dsa">
                                            <input type="hidden" value="-1" name="type">
                                            <input type="hidden" value="<?php echo $faq->id?>" name="idFaq">
                                            <input type="hidden" value="<?php echo $corso->id?>" name="idCorso">
                                            <?php if($_SESSION['loginType'] == 'Studente' && $_SESSION['matricola'] !=  $faq->idAutore) {?>
                                                <input type="hidden" value="<?php echo $voto[$faq->id]?>" name="voto">
                                                <input type="submit" value="">
                                            <?php }else {?>
                                                <input type="button" onclick="window.alert('questa utenza non può votare')">
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="vBar"></div>
                                <div class="faqContent">
                                    <div class="contentRow">
                                        <div class="contentTitle">
                                            Domanda
                                        </div>
                                        <div class="contentQuestion">
                                            <?php echo $faq->domanda ?>
                                        </div>
                                    </div>
                                    <div class="contentRow">
                                        <div class="contentTitle">
                                            Risposta
                                        </div>
                                        <form action="deleteFaq.php" method="POST" onsubmit="alertClick()">
                                            <div class="content"> 
                                                <input name="idCorso" type="text" value="<?php echo $corso->id?>"> 
                                                <input id="input<?php echo $faq->id?>" type="text" value="<?php echo $faq->risposta ?>"> 
                                                <div id="text<?php echo $faq->id?>"><?php echo $faq->risposta ?></div>
                                            </div>
                                            <?php
                                                if($_SESSION['loginType'] != 'Studente') {?>
                                                    <div class="editButton">
                                                        <input type="submit" value="" onclick="toggleInput(<?php echo $faq->id?>)">
                                                        <img  src="edit.png" alt="err">
                                                    </div>
                                                    <div class="editButton">
                                                        <input type="submit" value="">
                                                        <img  src="bin.png" alt="err">
                                                        <input type="hidden" name="idFaq" value="<?php echo $faq->id?>">
                                                        <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>"> 
                                                    </div>
                                            <?php
                                                }
                                            ?>
                                        </form>
                                    </div>
                                    <div class="faqAuthorData">
                                        Da <?php
                                                if($faq->idAutore> 0) {
                                                    $autore = getStudenteFromMatricola($faq->idAutore);
                                                    echo $autore->nome.' '.$autore->cognome.','.$autore->matricola;
                                                }
                                                elseif($faq->idAutore == 0)
                                                    echo "Segretario";
                                                elseif($faq->idAutore == -1)
                                                    echo "Utente eliminato";
                                                else
                                                    echo "Amministratore";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <!-- Container delle domande senza risposta -->
                <div class="container">
                    <div class="title">
                        Domande e Risposte Incomplete
                    </div>
                    <div>
                        <hr/>
                    </div>
                        <div class="faqContainer">
                        <?php
                            foreach($listaFaqIncomplete as $faq){
                                //Otteniamo i voti inviati dall'utente per la singola faq
                            ?>
                        
                            <div class="faq">
                            <?php
                                    //Controlliamo per ogni FAQ se è stata votata dall'utente
                                    //attualmente loggato
                                    if($_SESSION['loginType'] == 'Studente') {
                                        $voto[$faq->id] =  (int)getVotoFaq($_SESSION['matricola'],$faq->id);
                                        if($voto[$faq->id] > 0)
                                            $colore[$faq->id] = "green";
                                        elseif($voto[$faq->id] < 0)
                                            $colore[$faq->id] = "red";
                                    }
                                ?>
                                <div  class="upDown">
                                    <form action="votaFaq.php" method="POST">
                                        <div>
                                            <img src="up.png" alt="dsa">
                                            <input type="hidden" value="1" name="type">
                                            <input type="hidden" value="<?php echo $faq->id?>" name="idFaq">
                                            <input type="hidden" value="<?php echo $corso->id?>" name="idCorso">
                                            <?php if($_SESSION['loginType'] == 'Studente' && $_SESSION['matricola'] !=  $faq->idAutore) {?>
                                                <input type="hidden" value="<?php echo $voto[$faq->id]?>" name="voto">
                                                <input type="submit" value="">
                                            <?php }else {?>
                                                <input type="button" onclick="window.alert('questa utenza non può votare')">
                                            <?php } ?>
                                        </div>
                                    </form>
                                    <div <?php if(isset($colore[$faq->id])) echo "style=\"color:{$colore[$faq->id]}\""?>>
                                        <?php echo getUtilitaTotale($faq->id)?>
                                    </div>
                                    <form action="votaFaq.php" method="POST">
                                        <div>
                                            <img src="down.png" alt="dsa">
                                            <input type="hidden" value="-1" name="type">
                                            <input type="hidden" value="<?php echo $faq->id?>" name="idFaq">
                                            <input type="hidden" value="<?php echo $corso->id?>" name="idCorso">
                                            <?php if($_SESSION['loginType'] == 'Studente' && $_SESSION['matricola'] !=  $faq->idAutore) {?>
                                                <input type="hidden" value="<?php echo $voto[$faq->id]?>" name="voto">
                                                <input type="submit" value="">
                                            <?php }else {?>
                                                <input type="button" onclick="window.alert('questa utenza non può votare')">
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="vBar"></div>
                                <div class="faqContent">
                                    <div class="contentRow">
                                        <div class="contentTitle">
                                            Domanda
                                        </div>
                                        <div class="contentQuestion">
                                            <?php echo $faq->domanda ?>
                                        </div>
                                    </div>
                                    <div class="contentRow">
                                        <div class="contentTitle">
                                            Risposta
                                        </div>
                                        <form action="deleteFaq.php" method="POST" onsubmit="alertClick()"> 
                                            <div class="content"> 
                                                <input id="input<?php echo $faq->id?>" type="text" value="<?php echo $faq->risposta ?>"> 
                                                <div id="text<?php echo $faq->id?>"><?php echo $faq->risposta ?></div>
                                            </div>
                                            <?php
                                                if($_SESSION['loginType'] != 'Studente') {?>
                                                    <div class="editButton">
                                                        <input type="submit" value="" onclick="toggleInput(<?php echo $faq->id?>)">
                                                        <img  src="edit.png" alt="err">
                                                    </div>
                                                    <div class="editButton">
                                                        <input type="submit" value="">
                                                        <img  src="bin.png" alt="err">
                                                        <input type="hidden" name="idFaq" value="<?php echo $faq->id?>">
                                                        <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>"> 
                                                    </div>
                                            <?php
                                                }
                                            ?>
                                        </form>
                                    </div>
                                    <div class="faqAuthorData">
                                        Da <?php
                                                if($faq->idAutore> 0) {
                                                    $autore = getStudenteFromMatricola($faq->idAutore);
                                                    echo $autore->nome.' '.$autore->cognome.','.$autore->matricola;
                                                }
                                                elseif($faq->idAutore == 0)
                                                    echo "Segretario";
                                                elseif($faq->idAutore == -1)
                                                    echo "Utente eliminato";
                                                else
                                                    echo "Amministratore";
                                            ?>
                                    </div>
                                </div>
                            </div>
                        
                    <?php
                        }
                    ?>
                </div></div>
                <!-- Container della form di input -->
                <?php if($_SESSION['loginType'] != 'Docente') { ?>
                    <div class="formContainer">
                        <div class="formBorder" style="background-color: gainsboro;">
                            <div class="formTitle">
                                Proponi una nuova domanda
                            </div>
                            <form action="insertFaq.php" method="POST" id="newFaq">
                                <textarea name="faqContent" placeholder="Domanda" form="newFaq"></textarea>
                                <input type="submit" name="addFaq">
                                <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>">
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function toggleInput(id) {
        event.preventDefault();
        if(document.getElementById("text"+id).style.display == "none"){
            document.getElementById("input"+id).style.display = "none";
            document.getElementById("text"+id).style.display = "flex";

            _newText = $("#input"+id).val(); 

            console.log(_newText);
            document.getElementById("text"+id).textContent = _newText;

            //Possiamo usare uno script esterno volendo
            jQuery.ajax({
                        url: 'ajaxHandler.php',
                        type: 'POST',
                        data: jQuery.param({newText: _newText, id:id, richiesta: "modificaFaq"}), 
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        dataType: "text",

                        success: function (response) {
                            setTimeout(
                                        function() 
                                        {
                                            location.reload();
                                        }, 0001);                          
                        },
                        
                        error: function () {
                            console.log(response);
                        }});

        }else{
            document.getElementById("text"+id).style.display = "none";
            document.getElementById("input"+id).style.display = "flex";
        }  
    }
    function alertClick(){
        let cnf = confirm("Sei sicuro di voler effettuare l'eliminazione?")
        if(!cnf) event.preventDefault(); 
    } 
</script>
