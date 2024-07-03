<?php
require_once('phpClasses.php');
require_once('phpFunctions-get.php');
require_once('phpFunctions-misc.php');
require_once('phpFunctions-modify.php');


function inserisciCorso($nuovoCorso) {
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    if(verificaPresenzaCorso($nuovoCorso)) {
        setcookie('corso', "ERRORE: Il corso \"{$nuovoCorso->nome}\" esiste già!");
        return FALSE;
    }

    $xml = simplexml_load_file('../Xml/corsi.xml');

    // Crea una tupla <corso> </corso>
    $newcorso = $xml->addChild('corso');
    $asd = $newcorso->addChild('id', $nuovoCorso->id);
    $asd = $newcorso->addChild('nome', $nuovoCorso->nome);
    $asd = $newcorso->addChild('matricolaDocente', $nuovoCorso->matricolaDocente);
    $asd = $newcorso->addChild('matricolaCoDocente', $nuovoCorso->matricolaCoDocente);
    $asd = $newcorso->addChild('descrizione', $nuovoCorso->descrizione);
    $asd = $newcorso->addChild('colore', 'lightblue');
    $asd = $newcorso->addChild('anno', $nuovoCorso->anno);
    $asd = $newcorso->addChild('semestre', $nuovoCorso->semestre);
    $asd = $newcorso->addChild('curriculum', $nuovoCorso->curriculum);
    $asd = $newcorso->addChild('cfu', $nuovoCorso->cfu);
    $asd = $newcorso->addChild('ssd', $nuovoCorso->ssd);
    $asd = $newcorso->addChild('idCorsoLaurea', $nuovoCorso->idCorsoLaurea);
    $asd = $newcorso->addChild('stato', 1);

    //sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/corsi.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function inserisciStudente($studente) {
    if($studente == NULL)
        return FALSE;

    if(verificaPresenzaStudente($studente))
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/studenti.xml');

    // Crea una tupla <studente> </studente>

    $newStudente = $xml->addChild('studente');
    $tmp = $newStudente->addChild('matricola', $studente->matricola);
    $tmp = $newStudente->addChild('nome', $studente->nome);
    $tmp = $newStudente->addChild('cognome', $studente->cognome);
    $tmp = $newStudente->addChild('password', $studente->password);
    $tmp = $newStudente->addChild('dataNascita', $studente->dataNascita);
    $tmp = $newStudente->addChild('reputazioneTotale', $studente->reputazioneTotale);
    $tmp = $newStudente->addChild('cfuTotale', $studente->cfuTotale);
    $tmp = $newStudente->addChild('media', $studente->media);
    $tmp = $newStudente->addChild('idCorsoDiLaurea', $studente->idCorsoLaurea);
    $tmp = $newStudente->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function inserisciDocente($docente) {
    if($docente == NULL)
        return FALSE;

    if(verificaPresenzaDocente($docente))
        return FALSE;

    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/docenti.xml');

    // Crea una tupla <docente> </docente>

    $newDocente = $xml->addChild('docente');
    $tmp = $newDocente->addChild('matricola', $docente->matricola);
    $tmp = $newDocente->addChild('nome', $docente->nome);
    $tmp = $newDocente->addChild('cognome', $docente->cognome);
    $tmp = $newDocente->addChild('password', $docente->password);
    $tmp = $newDocente->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/docenti.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}

function inserisciSegretario($segretario) {
    if($segretario == NULL)
        return FALSE;

    if(verificaPresenzaSegretario($segretario))
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/segreteria.xml');

    // Crea una tupla <segretario> </segretario>

    $newSegretario = $xml->addChild('segretario');
    $tmp = $newSegretario->addChild('username', $segretario->username);
    $tmp = $newSegretario->addChild('password', $segretario->password);
    $tmp = $newSegretario->addChild('stato', 1);
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/segreteria.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function inserisciAmministratore($amministratore) {
    if($amministratore == NULL)
        return FALSE;

    if(verificaPresenzaAmministratore($amministratore))
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/amministrazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/amministrazione.xml');

    // Crea una tupla <amministratore> </amministratore>

    $newAmministratore = $xml->addChild('amministratore');
    $tmp = $newAmministratore->addChild('username', $amministratore->username);
    $tmp = $newAmministratore->addChild('password', $amministratore->password);
    $tmp = $newAmministratore->addChild('stato', 1);
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/amministrazione.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function inserisciCorsoDiLaurea($corsoDiLaurea) {
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    if(verificaPresenzaCorsoDiLaurea($corsoDiLaurea->nome))  {
        setcookie('cdl', "ERRORE: Il corso di laurea \"{$corsoDiLaurea->nome}\" esiste già!");
        return FALSE;
    }

    $xml = simplexml_load_file('../Xml/corsiDiLaurea.xml');

    // Crea una tupla <corsoDiLaurea> </corsoDiLaurea>
    $newcorsoDiLaurea = $xml->addChild('corsoDiLaurea'); 
    $tmp = $newcorsoDiLaurea->addChild('id', $corsoDiLaurea->id);
    $tmp = $newcorsoDiLaurea->addChild('nome', $corsoDiLaurea->nome);
    $tmp = $newcorsoDiLaurea->addChild('stato', 1);
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/corsiDiLaurea.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function inserisciAppello($appello) {
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    $corso = getCorsoById($appello->idCorso);
    $data = getDataFromDataora($appello->dataOra);

    if(verificaPresenzaAppello($appello))  {
        setcookie('appello', "ERRORE: Esiste già un appello di {$corso->nome} nel giorno {$data}!");
        return FALSE;
    }

    $xml = simplexml_load_file('../Xml/appelli.xml');

    // Crea una tupla <appello> </appello>
    $newAppello = $xml->addChild('appello'); 
    $tmp = $newAppello->addChild('id', $appello->id);
    $tmp = $newAppello->addChild('idCorso', $appello->idCorso);
    $tmp = $newAppello->addChild('dataOra', $appello->dataOra);
    $tmp = $newAppello->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/appelli.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function inserisciPrenotazioneAppello($matricolaStudente, $idAppello) {
    if($matricolaStudente == 0 || $idAppello == 0)
        return FALSE;
    
    $prenotazione = new prenotazione($matricolaStudente, $idAppello);
    
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/prenotazione.xml');

    // Crea una tupla <prenotazione> </prenotazione>
    $newPrenotazione = $xml->addChild('prenotazione'); 
    $tmp = $newPrenotazione->addChild('id', $prenotazione->id);
    $tmp = $newPrenotazione->addChild('matricolaStudente', $prenotazione->matricolaStudente);
    $tmp = $newPrenotazione->addChild('idAppello', $prenotazione->idAppello);
    $tmp = $newPrenotazione->addChild('esito', $prenotazione->esito);
    $tmp = $newPrenotazione->addChild('stato', 1);
    
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/prenotazione.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}


function insertFaq($idCorso,$domanda,$idAutore) {
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/faqs.xml');

    // Crea una tupla <studente> </studente>

    $newStudente = $xml->addChild('faq');
    $tmp = $newStudente->addChild('id', nextFaqid());
    $tmp = $newStudente->addChild('domanda', $domanda);
    $tmp = $newStudente->addChild('risposta', "");
    $tmp = $newStudente->addChild('utilitaTotale', 0);
    $tmp = $newStudente->addChild('idCorso', $idCorso);
    $tmp = $newStudente->addChild('idAutore', $idAutore);
    $tmp = $newStudente->addChild('stato', 1);
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/faqs.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}

function insertFaqVote($faqVote) {
    $xmlString = "";
    foreach ( file("../Xml/votoFAQ.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/votoFAQ.xml');
    
    $newStudente = $xml->addChild('votoFAQ');
    $tmp = $newStudente->addChild('id', $faqVote->id);
    $tmp = $newStudente->addChild('matricolaStudente', $faqVote->matricolaStudente);
    $tmp = $newStudente->addChild('idFAQ', $faqVote->idFAQ);
    $tmp = $newStudente->addChild('utilita', $faqVote->utilita);
    $tmp = $newStudente->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoFAQ.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);

    updateFaqUtility($faqVote->idFAQ);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}

function inserisciPost($titolo,$corpo,$idAutore,$idCorso,$data) {
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/posts.xml');


    $newStudente = $xml->addChild('post');
    $tmp = $newStudente->addChild('id', nextPostId());
    $tmp = $newStudente->addChild('titolo', $titolo);
    $tmp = $newStudente->addChild('corpo', $corpo);
    $tmp = $newStudente->addChild('matricolaStudente', $idAutore);
    $tmp = $newStudente->addChild('utilitaTotale', 0);
    $tmp = $newStudente->addChild('idCorso', $idCorso);
    $tmp = $newStudente->addChild('data', $data);
    $tmp = $newStudente->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/posts.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}

function insertCommentVote($idCommento, $matricola, $vote,$idAutore) {
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/votoCommento.xml');


    $newStudente = $xml->addChild('votoCommento');
    $tmp = $newStudente->addChild('id', nextCommentVoteId());
    $tmp = $newStudente->addChild('matricolaStudente', $matricola);
    $tmp = $newStudente->addChild('idCommento', $idCommento);
    $tmp = $newStudente->addChild('accordo', $vote);
    $tmp = $newStudente->addChild('idAutoreCommento', $idAutore);
    $tmp = $newStudente->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoCommento.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);
    updateCommentAccordo($idCommento);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}

function inserisciCommento($corpo,$idAutore,$idPost,$data) {
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/commenti.xml');


    $newStudente = $xml->addChild('commento');
    $tmp = $newStudente->addChild('id', nextCommentId());
    $tmp = $newStudente->addChild('corpo', $corpo);
    $tmp = $newStudente->addChild('matricolaStudente', $idAutore);
    $tmp = $newStudente->addChild('accordoMedio', 0);
    $tmp = $newStudente->addChild('idPost', $idPost);
    $tmp = $newStudente->addChild('data', $data);
    $tmp = $newStudente->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/commenti.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    else
        return TRUE;
}
function insertPostVote($idPost, $tipoVoto, $matricola) {
    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $xml = simplexml_load_file('../Xml/votoPost.xml');

    // Crea una tupla <studente> </studente>

    $newStudente = $xml->addChild('votoPost');
    $tmp = $newStudente->addChild('id', nextVotoPostId());
    $tmp = $newStudente->addChild('matricolaStudente', $matricola);
    $tmp = $newStudente->addChild('idPost', $idPost);
    $tmp = $newStudente->addChild('utilita', $tipoVoto);
    $tmp = $newStudente->addChild('stato', 1);

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoPost.xml', "w");
    $result = fwrite($f,  $xml->asXML());
    fclose($f);

    updatePostUtility($idPost);

    if(!$result) 
        return FALSE;
    else
        return TRUE;
}
?>