<?php
require_once('phpFunctions-get.php');


function generaMatricola($tipoUtenza) {
    $file = "";

    if($tipoUtenza == "Studente")
        $file = '../Xml/studenti.xml';
    elseif($tipoUtenza == "Docente")
        $file = '../Xml/docenti.xml';
    else
        return 0;   /* ERRORE */


    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file($file) as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $ultimaMatricola = $con->textContent;
    }

    return (intval($ultimaMatricola) + 1);
}


function verificaPresenzaCorsoDiLaurea($nome) {
    $listaCorsiDiLaurea = getCorsiDiLaurea();

    foreach($listaCorsiDiLaurea as $corso)
        if(strtolower($corso->nome) == strtolower($nome))
            return TRUE;
    
    return FALSE;
}


function verificaPresenzaCorso($corso) {
    $listaCorsi = getCorsiFromCorsoDiLaurea($corso->idCorsoLaurea);

    foreach($listaCorsi as $c)
        if($c->nome == $corso->nome)
            return TRUE;
    
    return FALSE;
}


function verificaPresenzaAppello($appello) {
    $listaAppelli = getAppelliFromCorso($appello->idCorso);
    $dataAppello = getDataFromDataora($appello->dataOra);

    foreach($listaAppelli as $app) {
        $dataApp = getDataFromDataora($app->dataOra);
        if($dataAppello == $dataApp)
            return TRUE;
    }

    return FALSE;
}


function verificaPresenzaStudente($studente) {
    if($studente == NULL)
        return FALSE;

    $studenti = getStudenti();
    foreach($studenti as $stud)
        if($stud->nome == $studente->nome && $stud->cognome == $studente->cognome)
            return TRUE;
    
    return FALSE;
}


function verificaPresenzaDocente($docente) {
    if($docente == NULL)
        return FALSE;

    $docenti = getDocenti();
    foreach($docenti as $doc)
        if($doc->nome == $docente->nome && $doc->cognome == $docente->cognome)
            return TRUE;
    
    return FALSE;
}


function verificaPresenzaSegretario($segretario) {
    if($segretario == NULL)
        return FALSE;

    $segretari = getSegretari();
    foreach($segretari as $seg)
        if($seg->username == $segretario->username)
            return TRUE;
    
    return FALSE;
}


function verificaPresenzaAmministratore($admin) {
    if($admin == NULL)
        return FALSE;

    $admins = getAmministratori();
    foreach($admins as $amm)
        if($amm->username == $admin->username)
            return TRUE;
    
    return FALSE;
}


function nextFaqid(){
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaId = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }
    $id = 1;

    while(in_array($id,$listaId)){
        $id++;
    }
    
    return $id;
}


function nextFaqVoteId(){
    $xmlString = "";
    foreach ( file("../Xml/votoFAQ.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaId = [];
     
    for ($i=0; $i<$records->length; $i++) { 
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }
    $id = 1;

    while(in_array($id,$listaId)){
        $id++;
    }
    
    return $id;
}


function  nextPostId() {
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaId = [];
     
    for ($i=0; $i<$records->length; $i++) { 
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }
    $id = 1;

    while(in_array($id,$listaId)){
        $id++;
    }
    
    return $id;
}


function  nextCommentVoteId() {
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaId = [];
     
    for ($i=0; $i<$records->length; $i++) { 
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }
    $id = 1;

    while(in_array($id,$listaId)){
        $id++;
    }

    return $id;
}


function nextCommentId() {
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaId = [];
     
    for ($i=0; $i<$records->length; $i++) { 
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }
    $id = 1;

    while(in_array($id,$listaId)){
        $id++;
    }

    return $id;
}


function calcolaIdCorso() {
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    $listaId = [];
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
        
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }

    $id=1;
    while(in_array($id,$listaId)){
        $id++;
    }

    return $id;
}


function calcolaIdCorsoDiLaurea() {
    $xmlString = "";
    foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    $listaId = [];
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
        
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }

    $id=1;
    while(in_array($id,$listaId)){
        $id++;
    }

    return $id;
}


function calcolaIdAppello() {
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    $listaId = [];
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
        
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }

    $id=1;
    while(in_array($id,$listaId)){
        $id++;
    }

    return $id;
}


function calcolaIdPrenotazione() {
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    $listaId = [];
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
        
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }

    $id=1;
    while(in_array($id,$listaId)){
        $id++;
    }

    return $id;
}


function verificaAppelloPrenotato($studente, $appello) {
    $appelliPrenotati = getAppelliPrenotati($studente);

    if(!$appelliPrenotati)
        return FALSE;
    
    foreach($appelliPrenotati as $appelloPrenotato)
        if($appello->id == $appelloPrenotato->id)
            return TRUE;
    
    return FALSE;
}


function verificaEsameSostenuto($studente, $idCorso) {
    $esamiSuperati = getEsamiSuperati($studente);

    if(!$esamiSuperati)
        return FALSE;
    
    foreach($esamiSuperati as $esameSuperato)
        if($esameSuperato == $idCorso)
            return TRUE;
    
    return FALSE;
}


function verificaProssimita($appello) {
    if(!$appello) 
        return NULL;

    $dataAppello = date_create(getDataFromDataora($appello->dataOra));

    $corso = getCorsoById($appello->idCorso);
    $anno = $corso->anno;
    $corsi = getCorsiFromAnnoAndCorsoDiLaurea($anno, $corso->idCorsoLaurea);
    if(!$corsi) 
        return NULL;

    $appelli = [];
    foreach($corsi as $c)
        $appelli = array_merge($appelli, getAppelliFromCorso($c->id));

    if(!$appelli) 
        return NULL;

    
    $corrispondenze = [];
    foreach($appelli as $app) {
        $data = date_create(getDataFromDataora($app->dataOra));
        $diff = date_diff($dataAppello, $data);

        if(strval($diff->format("%a")) == "0" || strval($diff->format("%a")) == "1")
            $corrispondenze[] = $app;
    }

    return $corrispondenze;
}


function verificaPresenzaMatricolaStudente($matricola) {
    $studenti = simplexml_load_file('../Xml/studenti.xml');

    foreach($studenti as $studente)
        if($studente->matricola == $matricola)
            return TRUE;
        
    return FALSE;
}


function verificaPresenzaMatricolaDocente($matricola) {
    $docenti = simplexml_load_file('../Xml/docenti.xml');

    foreach($docenti as $docente)
        if($docente->matricola == $matricola)
            return TRUE;
        
    return FALSE;
}


function verificaPresenzaUsernameSegretario($username) {
    $segretari = simplexml_load_file('../Xml/segreteria.xml');

    foreach($segretari as $segretario)
        if($segretario->username == $username)
            return TRUE;

    return FALSE;
}


function nextVotoPostId() {
    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaId = [];
     
    for ($i=0; $i<$records->length; $i++) { 
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $listaId[] = $con->textContent;
    }
    $id = 1;

    while(in_array($id,$listaId)){
        $id++;
    }

    return $id;
}


function calcolaReputazioneStudente($idStudente) {
    /*
    Il calcolo si divide in due parti:-Calcolo della reputazione proveniente dai post,-Calcolo della reputazione proveniente dai commenti.
    Il risultato finale è un voto che va da 1 a 10(decimale).
    */

    /*Calcolo reputazione proveniente da post */
    $listaVotiPost = calcolaReputazionePosts($idStudente);
    $listaVotiCommenti = calcolaReputazioneCommenti($idStudente);
    $listaVoti = array_merge($listaVotiPost,$listaVotiCommenti);
    // echo implode(",",$listaVoti);
    $totVoti = 0;
    $numeroVotiUtili = 0;
    foreach($listaVoti as $voto){
        if($voto == -1) continue;
            $totVoti += $voto;
            $numeroVotiUtili += 1;
    }

    $reputazione = $numeroVotiUtili > 0 ? $totVoti/$numeroVotiUtili : 0;

    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');

    foreach($studenti as $studente){
        if($studente->matricola == $idStudente && $studente->stato == 1){
            $studente->reputazioneTotale = round($reputazione, 2);
            break;
        }       
    }

    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $studenti->asXML());
    fclose($f);

    if(!$result) 
        return FALSE;
    else
        return round($reputazione, 2);
}


function calcolaReputazionePosts($idStudente) {
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $posts = simplexml_load_file('../Xml/posts.xml');
    $votiPosts = [];
    foreach($posts as $post){
        if($post->matricolaStudente == $idStudente && $post->stato == 1) {
            $voto = calcolaReputazionePost($post->id, $post->utilitaTotale);
            $votiPosts[] = $voto;
        }
    }

    return $votiPosts;
}


function calcolaReputazionePost($idPost,$utilitaTotale){
    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $votiPost = simplexml_load_file('../Xml/votoPost.xml');
    $numVoti = 0;
    foreach($votiPost as $voto){
        if($voto->idPost == (int)$idPost && $voto->stato == 1){
           $numVoti+= 1;
        }
    }
    #otteniamo un voto che varia tra 0 e 10; In caso di assenza di numero voti il voto 
    #non viene marchiato con un -1
    return $numVoti > 0 ? (($utilitaTotale/$numVoti) + 1)*5 : -1; 
}


function calcolaReputazioneCommenti($idStudente) {
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $votiCommento = simplexml_load_file('../Xml/votoCommento.xml');
    $listaVoti = [];
    foreach($votiCommento as $voto){
        if($voto->idAutoreCommento == $idStudente && $voto->stato == 1)
            $listaVoti[] = $voto->accordo*2; 
    }

    return $listaVoti;

}

function updateReputazione() {
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');
    foreach($studenti as $studente)
        calcolaReputazioneStudente($studente->matricola);

    return 0;
}


function encryptPassword($password) {
    return md5($password);
}
?>