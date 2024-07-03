<?php
require_once('phpClasses.php');
require_once('phpFunctions-get.php');
require_once('phpFunctions-misc.php');


/* ================================= 
======== Modify functions ==========
==================================== */

function assegnaCorso($id_corso, $matricola_docente, $matricola_codocente) {
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $corsi = simplexml_load_file('../Xml/corsi.xml');

    foreach($corsi as $corso) {
        if($corso->id == $id_corso && $corso->stato == 1) {
            $corso->matricolaDocente = $matricola_docente;
            $corso->matricolaCoDocente = $matricola_codocente;
        }
    }


    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/corsi.xml', "w");
    $result = fwrite($f,  $corsi->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function modificaEsitoPrenotazione($idPrenotazione, $nuovoEsito) {
    if($idPrenotazione == 0)
        return FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $prenotazioni = simplexml_load_file('../Xml/prenotazione.xml');

    foreach($prenotazioni as $prenotazione) {
        if($prenotazione->id == $idPrenotazione && $prenotazione->stato == 1)
            $prenotazione->esito = $nuovoEsito;
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/prenotazione.xml', "w");
    $result = fwrite($f,  $prenotazioni->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else{
        $prenotazione = getPrenotazioneFromId($idPrenotazione);
        $studente = getStudenteFromMatricola($prenotazione->matricolaStudente);
        if(calcolaMedia_CFU($studente))
            return TRUE;
    }
}


function calcolaMedia_CFU($studente) {
    if(!$studente)
        return FALSE;
    
    $esamiSuperati = getVerbalizzazioniPositive($studente);

    $numeroEsamiSuperati = sizeof($esamiSuperati);
    $cfuTot = 0;
    $sommaVoti = 0;
    $media = 0.0;

    // Calcolo dei cfu e della media

    foreach($esamiSuperati as $esameSuperato) {
        $appello = getAppelloFromId($esameSuperato->idAppello);
        $corso = getCorsoById($appello->idCorso);
        
        $cfuTot += $corso->cfu;
        $sommaVoti += intval($esameSuperato->esito);
    }
    
    if($numeroEsamiSuperati == 0) {
        $cfuTot = 0;
        $media = 0.0;
    }
    else {
        $media = $sommaVoti/$numeroEsamiSuperati;
        round($media, 2);   # La media ha due cifre significative
    }   


    // Modifica dei dati dello studente


    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');

    foreach($studenti as $stud) {
        if($stud->matricola == $studente->matricola && $stud->stato != 0) {
            $stud->cfuTotale = $cfuTot;
            $stud->media = $media;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $studenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function modificaAppello($idAppello, $nuovaData, $nuovaOra, $nuovoCorso) {
    if($idAppello == 0)
        return FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $appelli = simplexml_load_file('../Xml/appelli.xml');

    foreach($appelli as $appello) {
        if($appello->id == $idAppello && $appello->stato == 1) {
            $appello->dataOra = $nuovaData." ".$nuovaOra;
            $appello->idCorso = $nuovoCorso;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/appelli.xml', "w");
    $result = fwrite($f,  $appelli->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else{
        return TRUE;
    }
}


function modificaFaq($id, $newText) {
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $faqs = simplexml_load_file('../Xml/faqs.xml');

    foreach($faqs as $faq)
        if($faq->id == $id && $faq->stato == 1)
            $faq->risposta = $newText;

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/faqs.xml', "w");
    $result = fwrite($f,  $faqs->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function modifyFaqVote($matricola,$idFaq,$voto){
    $xmlString = "";
    foreach ( file("../Xml/votoFAQ.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    $voti = simplexml_load_file('../Xml/votoFAQ.xml');

    foreach($voti as $voto){
        if($voto->idFAQ == $idFaq && $voto->matricolaStudente == $matricola && $voto->stato == 1)
            $voto->utilita = (string)$voto;
    }
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoFAQ.xml', "w");
    $result = fwrite($f,  $voti->asXML());
    fclose($f);

    updateFaqUtility($idFaq);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function updateFaqUtility($idFaq) {
    #aggiorniamo il campo utilitaTotale della faq passata
    $xmlString = "";
    foreach ( file("../Xml/votoFAQ.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    $utilitaTot = 0;

    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $tmp = $con->textContent;
        $con = $con->nextSibling;
        $tmp = $con->textContent;
        $con = $con->nextSibling;
        $tmp = $con->textContent;
        if($tmp != $idFaq) continue;
        $con = $con->nextSibling;
        $utilita = (integer)$con->textContent; 
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if(!$stato) continue;
        $utilitaTot += $utilita;
    }

    #modifico la FAQ
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $faqs = simplexml_load_file('../Xml/faqs.xml');

    foreach($faqs as $faq){
        if($faq->id == $idFaq && $faq->stato == 1)
            $faq->utilitaTotale = $utilitaTot;
    }
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/faqs.xml', "w");
    $result = fwrite($f,  $faqs->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function modifyContentText($id, $newText) {
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $commenti = simplexml_load_file('../Xml/commenti.xml');

    foreach($commenti as $comm)
        if($comm->id == $id && $comm->stato == 1)
            $comm->corpo = $newText;

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/commenti.xml', "w");
    $result = fwrite($f,  $commenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}

function modifyPostContent($id, $newText) {
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $posts = simplexml_load_file('../Xml/posts.xml');

    foreach($posts as $post)
        if($post->id == $id && $post->stato == 1)
            $post->corpo = $newText;

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/posts.xml', "w");
    $result = fwrite($f,  $posts->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}

function updateCommentAccordo($idCommento){
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    $accordoTot = 0;
    $numVoti = 0;

    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $tmp = $con->textContent; #id
        $con = $con->nextSibling;
        $tmp = $con->textContent; #matricola studente
        $con = $con->nextSibling;
        $tmp = $con->textContent; #idCommento
        if($tmp != $idCommento) continue;
        $con = $con->nextSibling;
        $accordo = $con->textContent; #accordo
        $con = $con->nextSibling;
        $tmp = $con->textContent; #idAutoreCommento
        $con = $con->nextSibling;
        $stato = $con->textContent; #stato
        
        if(!$stato) continue;
        
        $accordoTot+=$accordo;
        $numVoti++;
    }

    $media =  $numVoti > 0 ? $accordoTot/$numVoti : 0;
    #modifico la FAQ
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $commenti = simplexml_load_file('../Xml/commenti.xml');
    $autoreCommento = null;
    foreach($commenti as $commento){
        if($commento->id == $idCommento && $commento->stato == 1) {
            $commento->accordoMedio = bcdiv($media, 1, 2);
            $autoreCommento = $commento->matricolaStudente;
        }
    }
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/commenti.xml', "w");
    $result = fwrite($f,  $commenti->asXML());
    fclose($f);
    calcolaReputazioneStudente($autoreCommento);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function modificaCorsoDiLaurea($idCorsoDiLaurea, $nome) {
    if($idCorsoDiLaurea == 0)
        return FALSE;

    $modificato = FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $corsiDiLaurea = simplexml_load_file('../Xml/corsiDiLaurea.xml');

    foreach($corsiDiLaurea as $corsoDiLaurea) {
        if($corsoDiLaurea->id == $idCorsoDiLaurea && !verificaPresenzaCorsoDiLaurea($nome) && $corsoDiLaurea->stato == 1) {
            $corsoDiLaurea->nome = $nome;
            $modificato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/corsiDiLaurea.xml', "w");
    $result = fwrite($f,  $corsiDiLaurea->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificato)
        return TRUE;
}


function modificaCorso($idCorso, $nome, $descrizione, $matricolaDocente, $matricolaCodocente, $anno, $semestre, $curriculum, $cfu, $ssd, $idCorsoLaurea) {
    if($idCorso == 0)
        return FALSE;

    $modificato = FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $corsi = simplexml_load_file('../Xml/corsi.xml');

    foreach($corsi as $corso) {
        if($corso->id == $idCorso && $corso->stato == 1) {
            $corso->nome = $nome;
            $corso->descrizione = $descrizione;
            $corso->matricolaDocente = $matricolaDocente;
            $corso->matricolaCoDocente = $matricolaCodocente;
            $corso->anno = $anno;
            $corso->semestre = $semestre;
            $corso->curriculum = $curriculum;
            $corso->cfu = $cfu;
            $corso->ssd = $ssd;
            $corso->idCorsoLaurea = $idCorsoLaurea;

            $modificato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/corsi.xml', "w");
    $result = fwrite($f,  $corsi->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificato)
        return TRUE;
}


function modificaPasswordStudente($matricola, $nuovaPassword) {
    if($matricola == 0 || $nuovaPassword == "")
        return FALSE;

    $modificata = FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');

    foreach($studenti as $studente) {
        if($studente->matricola == $matricola && $studente->stato != 0) {
            $studente->password = encryptPassword($nuovaPassword);
            $modificata = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $studenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificata)
        return TRUE;
}


function modificaPasswordDocente($matricola, $nuovaPassword) {
    if($matricola == 0 || $nuovaPassword == "")
        return FALSE;

    $modificata = FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $docenti = simplexml_load_file('../Xml/docenti.xml');

    foreach($docenti as $docente) {
        if($docente->matricola == $matricola && $docente->stato != 0) {
            $docente->password = encryptPassword($nuovaPassword);
            $modificata = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/docenti.xml', "w");
    $result = fwrite($f,  $docenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificata)
        return TRUE;
}


function modificaPasswordSegretario($username, $nuovaPassword) {
    if($username == 0 || $nuovaPassword == "")
        return FALSE;

    $modificata = FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $segretari = simplexml_load_file('../Xml/segreteria.xml');

    foreach($segretari as $segretario) {
        if($segretario->username == $username && $segretario->stato != 0) {
            $segretario->password = encryptPassword($nuovaPassword);
            $modificata = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/segreteria.xml', "w");
    $result = fwrite($f,  $segretari->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificata)
        return TRUE;
}


function modificaPasswordAmministratore($username, $nuovaPassword) {
    if($username == 0 || $nuovaPassword == "")
        return FALSE;

    $modificata = FALSE;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/amministrazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $amministratori = simplexml_load_file('../Xml/amministrazione.xml');

    foreach($amministratori as $amministratore) {
        if($amministratore->username == $username && $amministratore->stato != 0) {
            $amministratore->password = encryptPassword($nuovaPassword);
            $modificata = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/amministrazione.xml', "w");
    $result = fwrite($f,  $amministratori->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificata)
        return TRUE;
}


function updatePostUtility($idPost) {
    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $voti = simplexml_load_file('../Xml/votoPost.xml');
    $utilitaTot = 0;

    foreach($voti as $voto){
        if($voto->idPost == $idPost && $voto->stato == 1)
            $utilitaTot += $voto->utilita;
    }

    #modifico il post
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $posts = simplexml_load_file('../Xml/posts.xml');

    foreach($posts as $post){
        if($post->id == $idPost && $post->stato == 1) {
            $post->utilitaTotale = $utilitaTot;
            $autorePost = $post->matricolaStudente;
        }
    }
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/posts.xml', "w");
    $result = fwrite($f,  $posts->asXML());
    fclose($f);
    calcolaReputazioneStudente($autorePost);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function sospendiStudente($matricola) { 
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');

    foreach($studenti as $studente) {
        if($studente->matricola == $matricola) {
            $studente->stato = -1;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $studenti->asXML());
    fclose($f);
}


function sospendiDocente($matricola) { 
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $docenti = simplexml_load_file('../Xml/docenti.xml');

    foreach($docenti as $docente) {
        if($docente->matricola == $matricola) {
            $docente->stato = -1;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/docenti.xml', "w");
    $result = fwrite($f,  $docenti->asXML());
    fclose($f);
}


function sospendiSegretario($username) { 
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/segretari.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $segretari = simplexml_load_file('../Xml/segretari.xml');

    foreach($segretari as $segretario) {
        if($segretario->username == $username) {
            $segretario->stato = -1;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/segretari.xml', "w");
    $result = fwrite($f,  $segretari->asXML());
    fclose($f);
}


function riabilitaStudente($matricola) { 
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');

    foreach($studenti as $studente) {
        if($studente->matricola == $matricola) {
            $studente->stato = 1;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $studenti->asXML());
    fclose($f);
}


function riabilitaDocente($matricola) { 
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $docenti = simplexml_load_file('../Xml/docenti.xml');

    foreach($docenti as $docente) {
        if($docente->matricola == $matricola) {
            $docente->stato = 1;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/docenti.xml', "w");
    $result = fwrite($f,  $docenti->asXML());
    fclose($f);
}


function riabilitaSegretario($username) { 
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/segretari.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $segretari = simplexml_load_file('../Xml/segretari.xml');

    foreach($segretari as $segretario) {
        if($segretario->username == $username) {
            $segretario->stato = 1;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/segretari.xml', "w");
    $result = fwrite($f,  $segretari->asXML());
    fclose($f);
}


function modificaStudente($matricola, $nuovoNome, $nuovoCognome, $nuovaMatricola, $nuovoCorsoDiLaurea, $nuovaDataNascita, $nuovaPassword) {
    if($matricola == 0)
        return FALSE;

    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $modificato = FALSE;    
    $studenti = simplexml_load_file('../Xml/studenti.xml');

    foreach($studenti as $studente) {
        if($studente->matricola == $matricola && $studente->stato != 0) {
            $studente->matricola = $nuovaMatricola;
            $studente->nome = $nuovoNome;
            $studente->cognome = $nuovoCognome;
            $studente->idCorsoDiLaurea = $nuovoCorsoDiLaurea;
            $studente->dataNascita = $nuovaDataNascita;
            if($nuovaPassword != "")
                $studente->password = encryptPassword($nuovaPassword);
            
            $modificato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $studenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificato)
        return TRUE;
}


function modificaDocente($matricola, $nuovoNome, $nuovoCognome, $nuovaMatricola, $nuovaPassword) {
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $modificato = FALSE;    
    $docenti = simplexml_load_file('../Xml/docenti.xml');

    foreach($docenti as $docente) {
        if($docente->matricola == $matricola && $docente->stato != 0) {
            $docente->matricola = $nuovaMatricola;
            $docente->nome = $nuovoNome;
            $docente->cognome = $nuovoCognome;
            if($nuovaPassword != "")
                $docente->password = encryptPassword($nuovaPassword);
            
            $modificato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/docenti.xml', "w");
    $result = fwrite($f,  $docenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificato)
        return TRUE;
}


function modificaSegretario($username, $nuovoUsername, $nuovaPassword) {
    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $modificato = FALSE;    
    $segretari = simplexml_load_file('../Xml/segreteria.xml');

    foreach($segretari as $segretario) {
        if($segretario->username == $username && $segretario->stato != 0) {
            $segretario->username = $nuovoUsername;
            if($nuovaPassword != "")
                $segretario->password = encryptPassword($nuovaPassword);
            
            $modificato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/segreteria.xml', "w");
    $result = fwrite($f,  $segretari->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $modificato)
        return TRUE;
}


function modificaAffiniStudente($vecchiaMatricola, $nuovaMatricola) {
    if($vecchiaMatricola == $nuovaMatricola)
        return FALSE;

    /* ================== Modifica delle PRENOTAZIONI ============================= */
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $prenotazioni = simplexml_load_file('../Xml/prenotazione.xml');

    foreach($prenotazioni as $prenotazione) {
        if($prenotazione->matricolaStudente == $vecchiaMatricola && $prenotazione->stato == 1)
            $prenotazione->matricolaStudente = $nuovaMatricola;
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/prenotazione.xml', "w");
    $result = fwrite($f,  $prenotazioni->asXML());
    fclose($f);
    if(!$result)
        return FALSE;

    
    
    /* ================== Modifica dei POST ============================= */
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $posts = simplexml_load_file('../Xml/posts.xml');

    foreach($posts as $post) {
        if($post->matricolaStudente == $vecchiaMatricola && $post->stato == 1)
            $post->matricolaStudente = $nuovaMatricola;
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/posts.xml', "w");
    $result = fwrite($f,  $posts->asXML());
    fclose($f);
    if(!$result)
        return FALSE;
    

    
    /* ================== Modifica dei COMMENTI ============================= */
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $commenti = simplexml_load_file('../Xml/commenti.xml');

    foreach($commenti as $commento) {
        if($commento->matricolaStudente == $vecchiaMatricola && $commento->stato == 1)
            $commento->matricolaStudente = $nuovaMatricola;
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/commenti.xml', "w");
    $result = fwrite($f,  $commenti->asXML());
    fclose($f);
    if(!$result)
        return FALSE;
    
    
    
    /* ================== Modifica delle FAQ ============================= */
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $faqs = simplexml_load_file('../Xml/faqs.xml');

    foreach($faqs as $faq) {
        if($faq->idAutore == $vecchiaMatricola && $faq->stato == 1)
            $faq->idAutore = $nuovaMatricola;
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/faqs.xml', "w");
    $result = fwrite($f,  $faqs->asXML());
    fclose($f);
    if(!$result)
        return FALSE;
    
    
    
    /* ================== Modifica dei VOTI POST ============================= */
    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $voti = simplexml_load_file('../Xml/votoPost.xml');

    foreach($voti as $voto) {
        if($voto->matricolaStudente == $vecchiaMatricola && $voto->stato == 1)
            $voto->matricolaStudente = $nuovaMatricola;
    }

    $f = fopen('../Xml/votoPost.xml', "w");
    $result = fwrite($f,  $voti->asXML());
    fclose($f);
    if(!$result)
        return FALSE;
    
    
    
    /* ================== Modifica dei VOTI COMMENTI ============================= */
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $voti = simplexml_load_file('../Xml/votoCommento.xml');

    foreach($voti as $voto) {
        if($voto->matricolaStudente == $vecchiaMatricola && $voto->stato == 1)
            $voto->matricolaStudente = $nuovaMatricola;
    }

    $f = fopen('../Xml/votoCommento.xml', "w");
    $result = fwrite($f,  $voti->asXML());
    fclose($f);
    if(!$result)
        return FALSE;



    /* ================== Modifica dei VOTI FAQ ============================= */
    $xmlString = "";
    foreach ( file("../Xml/votoFAQ.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    $voti = simplexml_load_file('../Xml/votoFAQ.xml');

    foreach($voti as $voto){
        if($voto->matricolaStudente == $vecchiaMatricola && $voto->stato == 1)
            $voto->matricolaStudente = $nuovaMatricola;
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoFAQ.xml', "w");
    $result = fwrite($f,  $voti->asXML());
    fclose($f);
    if(!$result)
        return FALSE;


    // Se arrivo quì, è andato tutto bene
    return TRUE;
}


function modificaAffiniDocente($vecchiaMatricola, $nuovaMatricola) {
    if($vecchiaMatricola == $nuovaMatricola)
        return FALSE;

    
    /* ================== Modifica dei CORSI ============================= */
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $corsi = simplexml_load_file('../Xml/corsi.xml');

    foreach($corsi as $corso) {
        if($corso->matricolaDocente == $vecchiaMatricola && $corso->stato == 1)
            $corso->matricolaDocente = $nuovaMatricola;
        elseif($corso->matricolaCoDocente == $vecchiaMatricola && $corso->stato == 1)
            $corso->matricolaCoDocente = $nuovaMatricola;
    }

    $f = fopen('../Xml/corsi.xml', "w");
    $result = fwrite($f,  $corsi->asXML());
    fclose($f);
    if(!$result) 
        return FALSE;

    
    // Se arrivo quì, è andato tutto bene
    return TRUE;
}
?>