<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");
require_once("../Sito/phpFunctions-modify.php");


if(!isset($_SESSION['loginType']) || (isset($_SESSION['loginType']) && $_SESSION['loginType'] == "Docente"))
    header('Location: homepage.php');

if(isset($_SESSION['matricola']))
    $studenteLoggato = getStudenteFromMatricola($_SESSION['matricola']);

switch ($_SESSION['loginType']) {
    case 'Studente':
        $utenzaLoggata = getStudenteFromMatricola($_SESSION['matricola']);
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

if($_SESSION['loginType']!= "Amministratore" && (int)$utenzaLoggata->stato == -1) { ?>
    <script>
        window.alert("sei stato sospeso da questa funzionalità");
        window.location.replace('homepage-users.php');
    </script>
<?php 
}

$post = getPostFromId($_GET['idPost']);
if(!isset($_GET['idPost'])) header("Location: homepage-bacheca.php");

$votoPost = isset($_SESSION['matricola']) ? getVotoPostFromStudente($post->id,$_SESSION['matricola']) : "N/A";
$listaCommenti = getPostComments($_GET['idPost']);
$maxPageNum = ((int)(count($listaCommenti)/5)) + (count($listaCommenti)%5 > 0 ? 1 : 0);

$pageNum = $_GET['pageNum'] >= 1 ? $_GET['pageNum'] : 1;
$pageNum = $_GET['pageNum'] > $maxPageNum ? 1: $_GET['pageNum'];

$autore = ($post->matricolaStudente > 0 ? getStudenteFromMatricola($post->matricolaStudente) : $post->matricolaStudente);

?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

        <link rel="stylesheet" href="stile-base.css">
        <link rel="stylesheet" href="stileHomepage-users.css">
        <link rel="stylesheet" href="stileBacheca.css">
        <link rel="stylesheet" href="stilePost.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <title>Post - InfoStuff</title>
    <style>
        .checked {
        color: orange;
        }
    </style>
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
                    InfoStuff 
                    <form action="">
                        <input type="button">
                    </form>
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
                    <h2 class="hForm" style="padding-right: 1%;">
                        <form action="homepage-bacheca.php">
                            <input type="submit" value="">
                        </form>
                        Bacheche >
                    </h2>
                    <h2 class="hForm">
                        <form action="homepage-users-visualizzaBacheca.php" method="GET">
                            <input type="submit" value="" name="dsa">
                            <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso'] ?>">
                            <input type="hidden" name="pageNum" value="1">
                        </form>
                        <?php echo getCorsoById($_GET['idCorso'])->nome;?>
                    </h2>
                </div>
                <div class="infoTitle-user">
                    <h2>
                        <?php 
                            if($_SESSION['loginType'] == 'Studente')
                                echo "{$utenzaLoggata->nome} {$utenzaLoggata->cognome}, {$utenzaLoggata->matricola}";
                            else
                                echo "{$_SESSION['loginType']}: {$utenzaLoggata->username}";
                        ?>
                    </h2><!--Generato dallo script-->
                </div>
            </div>    
            <div><hr class="redBar" /></div>
            <div class="postHeader">
                <div class="upDown">
                    <form action="votaPost.php" method="POST">
                        <div>
                            <img src="up.png" alt="dsa">
                            <?php 
                                if(!isset($_SESSION['matricola']) || $post->matricolaStudente == $_SESSION['matricola']) { ?>
                                    <input type="button" onclick="window.alert('Non puoi votare questo post!')"> <?php
                                }else{ ?>
                                    <input type="submit" value="" name="votaPost">
                                    <input type="hidden" name="idPost" value="<?php echo $post->id?>">
                                    <input type="hidden" name="voto" value="<?php echo $votoPost?>">
                                    <input type="hidden" name="autorePost" value="<?php echo $post->matricolaStudente?>">
                                    <input type="hidden" name="tipoVoto" value="1">

                                    <input type="hidden" value="<?php echo $_GET["pageNum"];?>" name="pageNum"> 
                                    <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                                <?php } ?>
                        </div>
                    </form>
                    <div <?php if($votoPost != "N/A" && $votoPost != 0) { echo "style=\"color:".($votoPost >0 ? 'green': 'red').";\""; }?>>
                        <?php echo $post->utilitaTotale;?>
                    </div>
                    <form action="votaPost.php" method="POST">
                        <div>
                            <img src="down.png" alt="dsa">
                            <?php 
                                if(!isset($_SESSION['matricola']) || $post->matricolaStudente == $_SESSION['matricola']) { ?>
                                    <input type="button" onclick="window.alert('Non puoi votare questo post!')"> <?php
                                }else{ ?>
                                    <input type="submit" value="" name="votaPost">
                                    <input type="hidden" name="idPost" value="<?php echo $post->id?>">
                                    <input type="hidden" name="voto" value="<?php echo $votoPost?>">
                                    <input type="hidden" name="autorePost" value="<?php echo $post->matricolaStudente?>">
                                    <input type="hidden" name="tipoVoto" value="-1">

                                    <input type="hidden" value="<?php echo $_GET["pageNum"];?>" name="pageNum"> 
                                    <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                                <?php } ?>
                        </div>
                    </form>
                </div>
                <div class="postInfo">
                    <div class="postTitle">
                        <div class="titleContainer"><?php echo $post->titolo;?></div>
                        <?php if($_SESSION['loginType'] == 'Amministratore' || $_SESSION['loginType'] == 'Segretario' || $post->matricolaStudente == $_SESSION['matricola']) { ?>
                            <div class="adminTools">
                                <form action="deletePost.php" method="POST" onsubmit="alertClick()">
                                    <img src="bin.png" alt="err">
                                    <input type="submit" name="deletePost" value="">
                                    <input type="hidden" value="<?php echo $_GET["pageNum"];?>" name="pageNum"> 
                                    <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                                    <input type="hidden" value="<?php echo $_GET["idPost"]; ?>" name="idPost">
                                </form>
                                <form action="" name="editPostForm">
                                    <img src="edit.png" alt="err">
                                    <input type="submit" value="" onclick="editPost(<?php echo $post->id?>)">
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="postData">
                        <div class="postAuthor">
                            <?php 
                                if(is_object($autore)) echo "{$autore->nome} {$autore->cognome}, {$autore->matricola} · Reputazione: {$autore->reputazioneTotale}" ;
                                elseif($autore == -1)  echo 'Da Utente eliminato';
                                else echo "da Moderatore";
                            ?>
                        </div>
                        <div class="postDate">
                            <?php echo $post->data;?>
                        </div>
                    </div>
                    <div class="postData">
                        <div id="postText"><?php echo $post->corpo;?></div>
                        <form action="">
                            <textarea id="postInput" form="editPostForm" style="display:none;" required><?php echo $post->corpo;?></textarea>
                        </form>   
                    </div>
                </div>
            </div>
            <div class="pageNav">
                <form action="homepage-users-visualizzaPost.php" method="GET">
                    <div class="prev">
                        Prev  
                        <?php 
                            if($pageNum == 1){ ?>
                                <input type="button" onclick="window.alert('Non esistono pagine precedenti!')" class="bottoneForm"> <?php
                            }else{ ?>
                                <input type="submit" value="" class="bottoneForm"> <?php
                            }
                        ?>
                        <input type="hidden" value="<?php echo $pageNum-1; ?>" name="pageNum">
                        <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                        <input type="hidden" value="<?php echo $_GET["idPost"]; ?>" name="idPost">
                    </div>
                </form>
                <div class="pageList">
                    <?php 
                        for ($i=0; $i < $maxPageNum; $i++) { 
                            ?>
                            <form action="homepage-users-visualizzaPost.php" method="GET">
                                <div class="pageNumber" <?php if(($i+1) == $pageNum) echo "style=\"color:red;\"" ?>>
                                    <?php echo $i+1; ?>
                                    <input type="submit" value="" class="bottoneForm"> <!--Struttura di ogni bottone -->
                                    <input type="hidden" value="<?php echo $i+1; ?>" name="pageNum">
                                    <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                                    <input type="hidden" value="<?php echo $_GET["idPost"]; ?>" name="idPost">
                                </div>
                            </form>
                            <?php
                        }
                    ?>
                </div>
                <form action="homepage-users-visualizzaPost.php" method="GET">
                    <div class="next">
                        Next  
                        <?php 
                            if($pageNum == $maxPageNum){ ?>
                                <input type="button" onclick="window.alert('Non esistono pagine successive!')" class="bottoneForm"> <?php
                            }else{ ?>
                                <input type="submit" value="" class="bottoneForm"> <?php
                            }?>
                        <input type="hidden" value="<?php echo $pageNum+1; ?>" name="pageNum">
                        <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                        <input type="hidden" value="<?php echo $_GET["idPost"]; ?>" name="idPost">
                    </div>
                </form>
            </div>
            <!--Lista dei commenti-->
            <div class="commentContainer">
                <?php 
                
                for($i=($pageNum-1)*5; $i < min($pageNum*5,count($listaCommenti)); $i++){  
                    $autore = null;
                    $comment = $listaCommenti[$i];
                    $idC = $comment->id;
                    if($comment->matricolaStudente > 0){
                        $autore = getStudenteFromMatricola($comment->matricolaStudente);
                        if(isset($_SESSION['matricola']))
                            $voto = getVotoCommento($comment->id,$_SESSION['matricola']);
                    }
                    ?>
                    <div class="comment">
                        <div class="commentAuthorData">
                            <div class="authorDataElement">
                                <?php 
                                if($comment->matricolaStudente == -1)
                                    echo "Utente eliminato";
                                else
                                    echo isset($autore) ? 'Nome: '.$autore->nome : 'da Moderatore'?>
                            </div>
                            <div class="authorDataElement">
                                <?php echo isset($autore) ? 'Matricola: '.$autore->matricola : 'N/A'?>
                            </div>
                            <div class="authorDataElement">
                                <?php echo isset($autore) ? 'Reputazione: <span class="repTot'.$autore->matricola.'">'.$autore->reputazioneTotale.'</span>' : 'N/A'?>
                            </div>
                            <div class="authorDataElement">
                                <?php echo isset($autore) ? 'Corso di Laurea: '.getNomeCorsoDiLaureaByID($autore->idCorsoLaurea) : 'N/A'?>
                            </div>
                        </div>
                        <div class="commentContent">
                            <div class="commentTopBar">
                                <div class="commentTime">
                                    <?php echo  isset($autore) ? "{$comment->data} · Voto Totale: <span style=\"margin-left: 1%;\" id=\"votoTot{$comment->id}\">{$comment->accordoMedio}</span>" : $comment->data ?> 
                                </div>
                                <?php if ($_SESSION['loginType'] == 'Studente' && isset($autore) && $autore->matricola != $_SESSION['matricola']) { ?>
                                    <div class="commentTime" style="justify-content: flex-end;">
                                        Il tuo voto:  
                                    </div> 
                                    <div id="vote<?php echo $idC?>" class="commentVoteContainer" onclick="modifyVote('',<?php echo $idC?>,<?php echo $autore->matricola?>)">
                                        <?php echo isset($voto) ?$voto->accordo : 0;?>
                                    </div>
                                    <div id="stars<?php echo $idC?>" class="commentVoteContainer" style="display:none;">
                                        <div class="stars">
                                            <form action="">
                                                <input class="star star-5" id="star-5<?php echo $idC?>" type="radio" name="star" onclick="modifyVote('5',<?php echo $idC?>,<?php echo $autore->matricola?>)"/>
                                                <label class="star star-5" for="star-5<?php echo $idC?>"></label>
                                                <input class="star star-4" id="star-4<?php echo $idC?>" type="radio" name="star" onclick="modifyVote('4',<?php echo $idC?>,<?php echo $autore->matricola?>)"/>
                                                <label class="star star-4" for="star-4<?php echo $idC?>"></label>
                                                <input class="star star-3" id="star-3<?php echo $idC?>" type="radio" name="star" onclick="modifyVote('3',<?php echo $idC?>,<?php echo $autore->matricola?>)"/>
                                                <label class="star star-3" for="star-3<?php echo $idC?>"></label>
                                                <input class="star star-2" id="star-2<?php echo $idC?>" type="radio" name="star" onclick="modifyVote('2',<?php echo $idC?>,<?php echo $autore->matricola?>)"/>
                                                <label class="star star-2" for="star-2<?php echo $idC?>"></label>
                                                <input class="star star-1" id="star-1<?php echo $idC?>" type="radio" name="star" onclick="modifyVote('1',<?php echo $idC?>,<?php echo $autore->matricola?>)"/>
                                                <label class="star star-1" for="star-1<?php echo $idC?>"></label>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="commentText" id="commentText<?php echo $comment->id?>">
                                <?php echo $comment->corpo;?>
                            </div>
                            <div class="commentText" id="editTextForm">
                                <textarea id="commentInput<?php echo $comment->id?>" form="editTextForm<?php echo $comment->id?>" style="display:none;" required><?php echo $comment->corpo;?></textarea>
                            </div>
                            <?php if($_SESSION['loginType'] == 'Amministratore' || $_SESSION['loginType'] == 'Segretario' || $comment->matricolaStudente == $_SESSION['matricola']) { ?>
                                <div class="adminTools">
                                    <form action="deleteComment.php" method="POST" onsubmit="alertClick()">
                                        <img src="bin.png" alt="err">
                                        <input type="submit" name="deleteComment" value="">
                                        <input type="hidden" value="<?php echo $_GET["pageNum"];?>" name="pageNum"> 
                                        <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                                        <input type="hidden" value="<?php echo $_GET["idPost"]; ?>" name="idPost">
                                        <input type="hidden" value="<?php echo $comment->id?>" name="idComment"> 
                                    </form>
                                    <form action="" name="editTextForm<?php echo $comment->id?>">
                                        <img src="edit.png" alt="err">
                                        <input type="submit" value="" onclick="editComment(<?php echo $comment->id?>)">
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="formContainer">
                <div class="formBorder">
                    <div class="formTitle">
                        Contribuisci al post
                    </div>
                    <form action="insertComment.php" method="POST" id='inserisciComm'>
                        <textarea name="corpo" id="corpo" placeholder="Testo" form='inserisciComm' required></textarea>
                        <input type="submit" name="insertComment">
                        <input type="hidden" value="<?php echo $_GET["pageNum"];?>" name="pageNum"> 
                        <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                        <input type="hidden" value="<?php echo $_GET["idPost"]; ?>" name="idPost">
                    </form>
                </div>
            </div>   
        </div>
    </div>
</div>
</body>
</html>
<script>
    async function modifyVote(voto,id,idAutore) {
        console.log(id);
        if(document.getElementById("vote"+id).style.display == "none"){
            await delay(0.7);
            document.getElementById("stars"+id).style.display = "none";
            document.getElementById("vote"+id).style.display = "flex";

            document.getElementById("vote"+id).textContent = voto;

            //In questo id contiene il voto da sovrascrivere (ATTENZIONE, Bisogna modificare anche il voto medio!!!)
            console.log(voto +" "+id);
            //Possiamo usare uno script esterno volendo
            jQuery.ajax({
                        url: 'ajaxHandler.php',
                        type: 'POST',
                        data: jQuery.param({newVote: voto, id:id, autore:idAutore,richiesta: "modificaVotoPost"}), 
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        success: function (response) {
                            let text = response.split("-");
                            console.log(text);
                            document.getElementById("votoTot"+text[0]).textContent = text[1];

                            var elements = document.getElementsByClassName("repTot"+text[3]);
                            for (var i = 0; i < elements.length; i++) {
                                console.log(elements[i].textContent);
                                elements[i].textContent =  text[2];
                                
                            }
                        },
                        error: function () {
                            console.log("error");
                        }});

        }else{     
            document.getElementById("stars"+id).style.display = "flex";
            document.getElementById("vote"+id).style.display = "none";
        }
    }
    
    function delay(n){
    return new Promise(function(resolve){
        setTimeout(resolve,n*1000);
    });
    }

    function editComment(id) {
        
        if(document.getElementById("commentText" +id ).style.display == "none"){
            event.preventDefault(); //blocchiamo la normale esecuzione della form

            document.getElementById("commentText"+id).style.display = "flex";
            document.getElementById("commentInput"+id).style.display = "none";

            //Dobbiamo lanciarea la jquery
            _newText = $("#commentInput"+id).val(); // controlliamo se è vuoto 
            if(_newText.trim().length === 0){
                //la stringa inserita è vuota
                $("#commentInput"+id).textContent =  document.getElementById("commentText"+id).textContent;
                window.alert("È necessario specificare il contenuto!");
            }else{
                document.getElementById("commentText"+id).textContent = _newText;
                //Possiamo usare uno script esterno volendo
                jQuery.ajax({
                            url: 'ajaxHandler.php',
                            type: 'POST',
                            data: jQuery.param({newText: _newText, id:id, richiesta: "modificaContenutoPost"}), 
                            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                            success: function (response) {
                                console.log("Success");
                                //document.getElementById("votoTot"+id).textContent = "prova";
                                
                            },
                            error: function () {
                                console.log("error");
                            }});
            }

        }else{
            document.getElementById("commentText"+id).style.display = "none";
            document.getElementById("commentInput"+id).style.display = "flex";
        }
        event.preventDefault();
    }
    function editPost(id){
        event.preventDefault();
        if(document.getElementById("postText").style.display != "none"){
            document.getElementById("postText").style.display = "none";
            document.getElementById("postInput").style.display = "flex";
        }else{
            document.getElementById("postText").style.display = "flex";
            document.getElementById("postInput").style.display = "none";

            //Eseguiamo la modifica

            _newText = $("#postInput").val();
            
            if(_newText.trim().length === 0){
                //la stringa inserita è vuota
                $("#postInput"+id).textContent =  document.getElementById("postText").textContent;
                window.alert("È necessario specificare il contenuto!");
            }else{
                //Possiamo usare uno script esterno volendo
                document.getElementById("postText").textContent = _newText;
                jQuery.ajax({
                            url: 'ajaxHandler.php',
                            type: 'POST',
                            data: jQuery.param({newText: _newText, id:id, richiesta: "modificaPost"}), 
                            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                            success: function (response) {
                                console.log("Success");
                            },
                            error: function () {
                                console.log("error");
                            }});
            }
        }
    }

    function alertClick(){
        let cnf = confirm("Sei sicuro di voler effettuare l'eliminazione?")
        if(!cnf) event.preventDefault(); 
    } 
</script>