<?php
session_start();
require_once("../Sito/phpFunctions-get.php");
require_once("../Sito/phpFunctions-display.php");


if(!isset($_SESSION['loginType']) || (isset($_SESSION['loginType']) && $_SESSION['loginType'] == "Docente") || !isset($_GET['pageNum']))
    header('Location: homepage.php');

switch ($_SESSION['loginType']) {
    case 'Studente':
        # code...
        $utenzaLoggata = getStudenteFromMatricola($_SESSION['matricola']);
        break;
    case 'Segretario':
        # code...
        $utenzaLoggata = getSegretarioFromUsername($_SESSION['username']);
        break;
    case 'Amministratore':
        # code...
        $utenzaLoggata = getAdminFromUsername($_SESSION['username']);
        break;    
    default:
        # code...
        break;
}
$listaPost = getListaPost($_GET['idCorso']);
$pageNum = $_GET['pageNum'];
$order = isset($_GET['filter']) ? $_GET['filter'] : 'dateDesc';

#ordiniamo la lista dei post secodno il filtro
switch ($order) {
    case 'repDesc':
        usort($listaPost, fn($a, $b) => $b->replies <=> $a->replies);
        break; 
    case 'repAsc':
        usort($listaPost, fn($a, $b) => $a->replies <=> $b->replies);
        break;
    case 'utlDesc':
        usort($listaPost, fn($a, $b) => $b->utilitaTotale <=> $a->utilitaTotale);
        break;
    case 'utlAsc':
        usort($listaPost, fn($a, $b) => $a->utilitaTotale <=> $b->utilitaTotale);
        break;
    case 'dateDesc':
        usort($listaPost, fn($a, $b) => $b->data <=> $a->data);
        break;
    case 'dateAsc':    
        usort($listaPost, fn($a, $b) => $a->data <=> $b->data);
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

#calcoliamo il numero di pagine per visualizzare tutti i post
$maxPageNum = ((int)(count($listaPost)/5)) + (count($listaPost)%5 > 0 ? 1 : 0);
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <link rel="stylesheet" href="stileHomepage-users.css">
    <link rel="stylesheet" href="stileBacheca.css">
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
                    <h2 class="hForm" style="padding-right: 1%;">
                        <form action="homepage-bacheca.php">
                            <input type="submit" value="">
                        </form>
                        Bacheche >
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
                            if($_SESSION['loginType'] == 'Studente')
                                echo "{$utenzaLoggata->nome} {$utenzaLoggata->cognome}, {$utenzaLoggata->matricola}";
                            else
                                echo "{$_SESSION['loginType']}: {$utenzaLoggata->username}";
                        ?>
                    </h2><!--Generato dallo script-->
                </div>
            </div>    
            <hr class="redBar" />
            <div class="pageNav">
                <form action="homepage-users-visualizzaBacheca.php">
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
                    </div>
                </form>
                <div class="pageList">
                    <?php 
                        for ($i=0; $i < $maxPageNum; $i++) { 
                            ?>
                            <form action="">
                                <div class="pageNumber" <?php if(($i+1) == $pageNum) echo "style=\"color:red;\"" ?>>
                                    <?php echo $i+1; ?>
                                    <input type="submit" value="" class="bottoneForm"> <!--Struttura di ogni bottone -->
                                    <input type="hidden" value="<?php echo $i+1; ?>" name="pageNum">
                                    <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                                </div>
                            </form>
                            <?php
                        }
                    ?>
                </div>
                <form action="homepage-users-visualizzaBacheca.php">
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
                    </div>
                </form>
                <!-- Form per creare un Post-->
                <form action="" style="display: flex;width: -webkit-fill-available;justify-content: flex-end;">
                    <div class="next" style="width:fit-content;padding: 0% .5% 0% .5%;">
                        Crea post  
                        <input type="button" onclick="toggleCreatePost()" class="bottoneForm">       
                    </div>
                </form>
            </div>
            <div style="display: flex; align-items:center;justify-content:center;display:none;" id="formCreaPost">
                <div class="insertPost">
                    <form action="insertPost.php" id="newPost" method="post" name="newPost">
                        <div class="postFormContainer">
                            <textarea name="titolo" placeholder="Titolo" form="newPost" cols="50" rows="1" required ></textarea>
                            <textarea name="corpo" placeholder="Contenuto" form="newPost" cols="50" rows="5" required></textarea>
                            <input type="hidden" value="<?php echo $pageNum; ?>" name="pageNum">
                            <input type="hidden" value="<?php echo $_GET["idCorso"]; ?>" name="idCorso">
                            <input type="submit" value="invia" name="insertPost">
                        </div>
                    </form>
                </div>
            </div>
            <div class="postList">
                <div class="postListHeader">
                    <div class="headerBar">
                        <div class="postData">
                            <div class="postName" style="color: white;">
                            </div>
                        </div>
                        <div class="repliesOrUtility" style="color: white;">
                            <h3 class="hForm">
                                <?php 
                                    if($order == 'repDesc')
                                        echo '↓Replies↓';
                                    elseif($order == 'repAsc')
                                        echo '↑Replies↑';
                                    else
                                        echo 'Replies';
                                    ?>
                                <form action="homepage-users-visualizzaBacheca.php" method="GET">
                                        <input type="submit" value="">
                                        <input type="hidden" name="filter" value="<?php echo ($order == 'repDesc' ? 'repAsc' : 'repDesc')?>">
                                        <input type="hidden" name="pageNum" value="<?php echo $_GET['pageNum']?>">
                                        <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>">
                                </form> 
                            </h3>                          
                        </div>
                        <div class="repliesOrUtility" style="color: white;">     
                            <h3 class="hForm">
                                <?php 
                                    if($order == 'utlDesc')
                                        echo '↓Utility↓';
                                    elseif($order == 'utlAsc')
                                        echo '↑Utility↑';
                                    else
                                        echo 'Utility';
                                    ?>
                                <form action="homepage-users-visualizzaBacheca.php" method="GET">
                                    <input type="submit" value=''>
                                    <input type="hidden" name="filter" value="<?php echo ($order == 'utlDesc' ? 'utlAsc' : 'utlDesc')?>">
                                    <input type="hidden" name="pageNum" value="<?php echo $_GET['pageNum']?>">
                                    <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>">
                                </form> 
                            </h3>    
                        </div>
                        <div class="postDate" style="color: white;">
                            <div style="display: flex;width: -webkit-fill-available;justify-content: flex-end;"> 
                                <h3 class="hForm">
                                    <?php 
                                        if($order == 'dateDesc')
                                            echo '↓Date↓';
                                        elseif($order == 'dateAsc')
                                            echo '↑Date↑';
                                        else
                                            echo 'Date';
                                    ?>
                                    <form action="homepage-users-visualizzaBacheca.php" method="GET">
                                        <input type="submit" value=''>
                                        <input type="hidden" name="filter" value="<?php echo ($order == 'dateDesc' ? 'dateAsc' : 'dateDesc')?>">
                                        <input type="hidden" name="pageNum" value="<?php echo $_GET['pageNum']?>">
                                        <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>">
                                    </form> 
                                </h3> 
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="postContainer"> 
                        <!-- Stampo i due post con più utilita --> 
                        <?php 
                            if($pageNum == 1) {
                                $list = array_merge(array(), $listaPost);
                                usort($list, fn($a, $b) => $b->utilitaTotale <=> $a->utilitaTotale);
                                for ($i=0; $i < min(2,count($listaPost)); $i++) {
                                    ?>
                                        <form action="homepage-users-visualizzaPost.php" method="GET">
                                            <div <?PHP if($i%2==0) echo "class=\"postItem\""; else echo "class=\"postItemAlt\"";?>>
                                                <input type="submit" value="" class="bottoneForm"> <!--Struttura di ogni bottone -->
                                                <input type="hidden" name="idPost" value="<?php echo $list[$i]->id;?>">
                                                <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>">
                                                <input type="hidden" value="1" name="pageNum">
                                                <div class="postData">
                                                    <div class="postName">
                                                        <h3><?php echo $list[$i]->titolo; ?></h3>
                                                    </div>
                                                    <div class="postAuthor">
                                                        <h4>
                                                            <?php
                                                                if($list[$i]->matricolaStudente > 0){
                                                                    $autore = getStudenteFromMatricola($list[$i]->matricolaStudente);
                                                                    echo "{$autore->nome} {$autore->cognome}, {$autore->matricola} ";
                                                                }elseif($list[$i]->matricolaStudente == -1)
                                                                    echo "da Utente eliminato";
                                                                else
                                                                    echo "da Moderatore";
                                                            ?>
                                                        </h4>       
                                                    </div>
                                                </div>
                                                <div class="repliesOrUtility">
                                                    <h3>Replies</h3>
                                                    <h3><?php echo $list[$i]->replies; ?></h3>
                                                </div>
                                                <div class="repliesOrUtility">
                                                    <h3>Utility</h3>
                                                    <h3><?php echo $list[$i]->utilitaTotale; ?></h3>
                                                </div>
                                                <div class="postDate">
                                                    <h3><?php echo $list[$i]->data; ?></h3>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    <?php
                                }
                                ?><hr style="
                                background-color: #aefffe94;
                                height: 8px;
                                margin: 0%;
                                border:0;
                                display: flex;"
                                > 
                            <?PHP
                            }
                        ?>
                        <!-- LISTA POST NORMALE -->
                        <?php for ($i=($pageNum-1)*5; $i < min($pageNum*5,count($listaPost)); $i++) { ?>
                            <form action="homepage-users-visualizzaPost.php" method="GET">
                                <div <?PHP if($i%2==0) echo "class=\"postItem\""; else echo "class=\"postItemAlt\"";?>>
                                    <input type="submit" value="" class="bottoneForm"> <!--Struttura di ogni bottone -->
                                    <input type="hidden" name="idPost" value="<?php echo $listaPost[$i]->id;?>">
                                    <input type="hidden" name="idCorso" value="<?php echo $_GET['idCorso']?>">
                                    <input type="hidden" value="1" name="pageNum">
                                    <div class="postData">
                                        <div class="postName">
                                            <h3> <?php echo $listaPost[$i]->titolo; ?></h3>
                                        </div>
                                        <div class="postAuthor">
                                            <h4>
                                                <?php
                                                    if($listaPost[$i]->matricolaStudente > 0){
                                                        $autore = getStudenteFromMatricola($listaPost[$i]->matricolaStudente);
                                                        echo "{$autore->nome} {$autore->cognome}, {$autore->matricola} ";
                                                    }elseif($listaPost[$i]->matricolaStudente == -1)
                                                        echo "da Utente eliminato";
                                                    else
                                                        echo "da Moderatore";
                                                ?>
                                            </h4>       
                                        </div>
                                    </div>
                                    <div class="repliesOrUtility">
                                        <h3>Replies</h3>
                                        <h3><?php echo $listaPost[$i]->replies; ?></h3>
                                    </div>
                                    <div class="repliesOrUtility">
                                        <h3>Utility</h3>
                                        <h3><?php echo $listaPost[$i]->utilitaTotale; ?></h3>
                                    </div>
                                    <div class="postDate">
                                        <h3><?php echo $listaPost[$i]->data; ?></h3>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function toggleCreatePost() {
        if(document.getElementById("formCreaPost").style.display == "none")
            document.getElementById("formCreaPost").style.display = "flex";
        else
        document.getElementById("formCreaPost").style.display = "none";
    }
</script>