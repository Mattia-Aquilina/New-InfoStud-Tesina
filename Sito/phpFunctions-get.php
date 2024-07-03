<?php
require_once('phpClasses.php');
require_once('phpFunctions-misc.php');


function getCorsi() {
    /*accedo al file xml*/
   $xmlString = "";
   foreach ( file("../Xml/corsi.xml") as $node ) {
       $xmlString .= trim($node);
   }
   
   // Creazione del documento
   $doc = new DOMDocument();
   $doc->loadXML($xmlString);
   $records = $doc->documentElement->childNodes;

   $listaCorsi = [];

   for ($i=0; $i<$records->length; $i++) {
       $corso = new corso("", "", 0, 0, 0, 0, "", 0, "", 0);
       $record = $records->item($i);
       
       $con = $record->firstChild;
       $corso->id = $con->textContent;
       $con = $con->nextSibling;
       $corso->nome = $con->textContent;
       $con = $con->nextSibling;
       $corso->matricolaDocente = $con->textContent;
       $con = $con->nextSibling;
       $corso->matricolaCoDocente = $con->textContent;
       $con = $con->nextSibling;
       $corso->descrizione = $con->textContent;
       $con = $con->nextSibling;
       $corso->colore = $con->textContent;
       $con = $con->nextSibling;
       $corso->anno = $con->textContent;
       $con = $con->nextSibling;
       $corso->semestre = $con->textContent;
       $con = $con->nextSibling;
       $corso->curriculum = $con->textContent;
       $con = $con->nextSibling;
       $corso->cfu = $con->textContent;
       $con = $con->nextSibling;
       $corso->ssd = $con->textContent;
       $con = $con->nextSibling;
       $corso->idCorsoLaurea = $con->textContent;
       $con = $con->nextSibling;
       $stato = $con->textContent;
       if($stato)
        $listaCorsi[] = $corso;
   }
   return $listaCorsi;
}


function getCorsoById($_id) {
   /*accedo al file xml*/
   $xmlString = "";
  foreach ( file("../Xml/corsi.xml") as $node ) {
      $xmlString .= trim($node);
  }
  
  // Creazione del documento
  $doc = new DOMDocument();
  $doc->loadXML($xmlString);
  $records = $doc->documentElement->childNodes;

  for ($i=0; $i<$records->length; $i++) {
      $corso = new corso("", "", "", "", "", "", "", "", "","");
      $record = $records->item($i);

      $con = $record->firstChild;
      $id = $con->textContent;
      if($id != $_id) continue; 

       $con = $record->firstChild;
       $corso->id = $con->textContent;
       $con = $con->nextSibling;
       $corso->nome = $con->textContent;
       $con = $con->nextSibling;
       $corso->matricolaDocente = $con->textContent;
       $con = $con->nextSibling;
       $corso->matricolaCoDocente = $con->textContent;
       $con = $con->nextSibling;
       $corso->descrizione = $con->textContent;
       $con = $con->nextSibling;
       $corso->colore = $con->textContent;
       $con = $con->nextSibling;
       $corso->anno = $con->textContent;
       $con = $con->nextSibling;
       $corso->semestre = $con->textContent;
       $con = $con->nextSibling;
       $corso->curriculum = $con->textContent;
       $con = $con->nextSibling;
       $corso->cfu = $con->textContent;
       $con = $con->nextSibling;
       $corso->ssd = $con->textContent;
       $con = $con->nextSibling;
       $corso->idCorsoLaurea = $con->textContent;
       $con = $con->nextSibling;
       $stato = $con->textContent;
      if(!$stato) continue;

      return $corso;
  }
  return null;  
}


function getCorsiLike($_nome){
   $xmlString = "";
   foreach ( file("../Xml/corsi.xml") as $node ) {
       $xmlString .= trim($node);
   }
   
   // Creazione del documento
   $doc = new DOMDocument();
   $doc->loadXML($xmlString);
   $records = $doc->documentElement->childNodes;

   $listaCorsi = [];

   for ($i=0; $i<$records->length; $i++) {
        $corso = new corso("", "", "", "", "", "", "", "", "","");
        $record = $records->item($i);
        
        $con = $record->firstChild;
        $corso->id = $con->textContent;
        $con = $con->nextSibling;
        $corso->nome = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaCoDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->descrizione = $con->textContent;
        $con = $con->nextSibling;
        $corso->colore = $con->textContent;
        $con = $con->nextSibling;
        $corso->anno = $con->textContent;
        $con = $con->nextSibling;
        $corso->semestre = $con->textContent;
        $con = $con->nextSibling;
        $corso->curriculum = $con->textContent;
        $con = $con->nextSibling;
        $corso->cfu = $con->textContent;
        $con = $con->nextSibling;
        $corso->ssd = $con->textContent;
        $con = $con->nextSibling;
        $corso->idCorsoLaurea = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato != 1) continue;

        /*controllo sul nome*/
        if(preg_match("/{$_nome}/i", $corso->nome) && $stato) 
            $listaCorsi[] = $corso;
    }
    return $listaCorsi;
}


function getCorsiFromDocente($idDocente) {
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }
        
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaCorsi = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $corso = new corso("", "", "", "", "", "", "", "", "","");
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $corso->id = $con->textContent;
        $con = $con->nextSibling;
        $corso->nome = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaCoDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->descrizione = $con->textContent;
        $con = $con->nextSibling;
        $corso->colore = $con->textContent;
        $con = $con->nextSibling;
        $corso->anno = $con->textContent;
        $con = $con->nextSibling;
        $corso->semestre = $con->textContent;
        $con = $con->nextSibling;
        $corso->curriculum = $con->textContent;
        $con = $con->nextSibling;
        $corso->cfu = $con->textContent;
        $con = $con->nextSibling;
        $corso->ssd = $con->textContent;
        $con = $con->nextSibling;
        $corso->idCorsoLaurea = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato != 1) continue;
        
        /*controllo sulla matricola*/
        if($corso->matricolaDocente == $idDocente || $corso->matricolaCoDocente == $idDocente) 
            $listaCorsi[] = $corso;
    }
    return $listaCorsi;
}

function getCorsiFromCorsoDiLaurea($idCorsoLaurea) {
    $listaCorsi = [];
    $corsi = getCorsi();

    foreach($corsi as $corso) {
        if($corso->idCorsoLaurea == $idCorsoLaurea) 
            $listaCorsi[] = $corso;
    }

    return $listaCorsi;
}


function getCorsiFromCorsoDiLaureaLike($idCorsoLaurea, $_nome) {
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }

    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    $listaCorsi = [];

    for ($i=0; $i<$records->length; $i++) {
        $corso = new corso("", "", "", "", "", "", "", "", "","");
        $record = $records->item($i);
        
        $con = $record->firstChild;
        $corso->id = $con->textContent;
        $con = $con->nextSibling;
        $corso->nome = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaCoDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->descrizione = $con->textContent;
        $con = $con->nextSibling;
        $corso->colore = $con->textContent;
        $con = $con->nextSibling;
        $corso->anno = $con->textContent;
        $con = $con->nextSibling;
        $corso->semestre = $con->textContent;
        $con = $con->nextSibling;
        $corso->curriculum = $con->textContent;
        $con = $con->nextSibling;
        $corso->cfu = $con->textContent;
        $con = $con->nextSibling;
        $corso->ssd = $con->textContent;
        $con = $con->nextSibling;
        $corso->idCorsoLaurea = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato != 1) continue;
        
        /* Controllo sul nome e sul corso di laurea di appartenenza */
        if(preg_match("/{$_nome}/i", $corso->nome) && $corso->idCorsoLaurea == $idCorsoLaurea) 
            $listaCorsi[] = $corso;
   }
   return $listaCorsi;
}


function getCorsiFromAnnoAndCorsoDiLaurea($anno, $idCorsoLaurea) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
 
    $listaCorsi = [];
 
    for ($i=0; $i<$records->length; $i++) {
        $corso = new corso("", "", 0, 0, 0, 0, "", 0, "", 0);
        $record = $records->item($i);
        
        $con = $record->firstChild;
        $corso->id = $con->textContent;
        $con = $con->nextSibling;
        $corso->nome = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->matricolaCoDocente = $con->textContent;
        $con = $con->nextSibling;
        $corso->descrizione = $con->textContent;
        $con = $con->nextSibling;
        $corso->colore = $con->textContent;
        $con = $con->nextSibling;
        $corso->anno = $con->textContent;
        $con = $con->nextSibling;
        $corso->semestre = $con->textContent;
        $con = $con->nextSibling;
        $corso->curriculum = $con->textContent;
        $con = $con->nextSibling;
        $corso->cfu = $con->textContent;
        $con = $con->nextSibling;
        $corso->ssd = $con->textContent;
        $con = $con->nextSibling;
        $corso->idCorsoLaurea = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato == 1 && $anno == $corso->anno && $idCorsoLaurea == $corso->idCorsoLaurea)
            $listaCorsi[] = $corso;
    }
    return $listaCorsi;
}


function getNomeCorso($num) {
   $xmlString = "";
   foreach ( file("../Xml/corsi.xml") as $node ) {
       $xmlString .= trim($node);
   }
   
   // Creazione del documento
   $doc = new DOMDocument();
   $doc->loadXML($xmlString);
   $records = $doc->documentElement->childNodes;

   $nomeCorso = "N/A";

   if($records->length > 0) { /* C'è almeno un corso */
       for ($i=0; $i<$records->length; $i++) {
           $record = $records->item($i); // i-esimo corso

           $idElement = $record->firstChild;   // Id
           $id = $idElement->textContent;
           if($id == $num) {
                $nomeCorsoElement = $idElement->nextSibling;    // Nome corso
                $nomeCorso = $nomeCorsoElement->textContent;
           }
       }
   }

   return $nomeCorso;
}


function cercaCorso($nomeCorsoDaCercare) {
    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }
    
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    if($records->length > 0) {
        for ($i=0; $i<$records->length; $i++) {
            $record = $records->item($i);

            $idElement = $record->firstChild;
            $id = $idElement->textContent;
            $nomeElement = $idElement->nextSibling;
            $nome = $nomeElement->textContent;

            if($nome == $nomeCorsoDaCercare) {
                return $id;
            }
        }
    }

    return 0;
}

function getCorsiDiLaurea() {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaCorsiDiLaurea = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $corsoDiLaurea = new corsoDiLaurea("");
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $corsoDiLaurea->id = $con->textContent;
        $con = $con->nextSibling;
        $corsoDiLaurea->nome = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if(!$stato) continue;

        $listaCorsiDiLaurea[] = $corsoDiLaurea;
    }
    return $listaCorsiDiLaurea;
}


function getCorsiDiLaureaLike($_nome) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaCorsiDiLaurea = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $corsoDiLaurea = new corsoDiLaurea("");
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $corsoDiLaurea->id = $con->textContent;
        $con = $con->nextSibling;
        $corsoDiLaurea->nome = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        /*controllo sul nome*/
        if(preg_match("/{$_nome}/i", $corsoDiLaurea->nome) && $stato)
            $listaCorsiDiLaurea[] = $corsoDiLaurea;
    }
    return $listaCorsiDiLaurea;
}


function getCorsoDiLaureaFromId($idCorsoDiLaurea) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    for ($i=0; $i<$records->length; $i++) {
        $corsoDiLaurea = new corsoDiLaurea("");
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $corsoDiLaurea->id = $con->textContent;
        $con = $con->nextSibling;
        $corsoDiLaurea->nome = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($corsoDiLaurea->id == $idCorsoDiLaurea && $stato)
            return $corsoDiLaurea;
    }
    return NULL;
}


function getNomeCorsoDiLaureaByID($_id) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    for ($i=0; $i<$records->length; $i++) {
        $corsoDiLaurea = new corsoDiLaurea("");
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $corsoDiLaurea->id = $con->textContent;
        $con = $con->nextSibling;
        $corsoDiLaurea->nome = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($corsoDiLaurea->id == $_id && $stato)
            return $corsoDiLaurea->nome;
    }
    return NULL;
}


function getDocenti() {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaDocenti = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $docente = new docente("", "", "", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $docente->matricola = $con->textContent;
        $con = $con->nextSibling;
        $docente->nome = $con->textContent;
        $con = $con->nextSibling;
        $docente->cognome = $con->textContent;
        $con = $con->nextSibling;
        $docente->password = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato != 0)  
            $listaDocenti[] = $docente;
    }
    return $listaDocenti;
}


function getDocenteFromMatricola($matr) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    for ($i=0; $i<$records->length; $i++) {
        $docente = new docente("", "", "", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $docente->matricola = $con->textContent;
        $con = $con->nextSibling;
        $docente->nome = $con->textContent;
        $con = $con->nextSibling;
        $docente->cognome = $con->textContent;
        $con = $con->nextSibling;
        $docente->password = $con->textContent;
        $con = $con->nextSibling;
        $docente->stato = $con->textContent;

        if($docente->matricola == $matr && $docente->stato != 0) return $docente;
    }
    return NULL;
}


function getDocentiLike($_nome) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaDocenti = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $docente = new docente("", "", "", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $docente->matricola = $con->textContent;
        $con = $con->nextSibling;
        $docente->nome = $con->textContent;
        $con = $con->nextSibling;
        $docente->cognome = $con->textContent;
        $con = $con->nextSibling;
        $docente->password = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        /*controllo sul nome*/
        if(preg_match("/{$_nome}/i", ($docente->cognome." ".$docente->nome)) && $stato != 0)
            $listaDocenti[] = $docente;
    }
    return $listaDocenti;  
}


function getStudenti() {
    updateReputazione();
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaStudenti = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $studente = new studente("", "", "", "", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $studente->matricola = $con->textContent;    
        $con = $con->nextSibling;
        $studente->nome = $con->textContent;
        $con = $con->nextSibling;
        $studente->cognome = $con->textContent;
        $con = $con->nextSibling;
        $studente->password = $con->textContent;
        $con = $con->nextSibling;
        $studente->dataNascita = $con->textContent;
        $con = $con->nextSibling;
        $studente->reputazioneTotale = $con->textContent;
        $con = $con->nextSibling;
        $studente->cfuTotale = $con->textContent;
        $con = $con->nextSibling;
        $studente->media = $con->textContent;
        $con = $con->nextSibling;
        $studente->idCorsoLaurea = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato != 0) 
            $listaStudenti[] = $studente;
    }
    return $listaStudenti;
}


function getStudenteFromMatricola($matr) {
    calcolaReputazioneStudente($matr);
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    for ($i=0; $i<$records->length; $i++) {
        $studente = new studente("", "", "", "", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $studente->matricola = $con->textContent;
        $con = $con->nextSibling;
        $studente->nome = $con->textContent;
        $con = $con->nextSibling;
        $studente->cognome = $con->textContent;
        $con = $con->nextSibling;
        $studente->password = $con->textContent;
        $con = $con->nextSibling;
        $studente->dataNascita = $con->textContent;
        $con = $con->nextSibling;
        $studente->reputazioneTotale = $con->textContent;
        $con = $con->nextSibling;
        $studente->cfuTotale = $con->textContent;
        $con = $con->nextSibling;
        $studente->media = $con->textContent;
        $con = $con->nextSibling;
        $studente->idCorsoLaurea = $con->textContent;
        $con = $con->nextSibling;
        $studente->stato = $con->textContent;

        if($studente->matricola == $matr && $studente->stato != 0) return $studente;
    }
    return NULL;
}


function getSegretari() {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaSegretari = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $segretario = new segretario("", "");  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $segretario->username = $con->textContent;
        $con = $con->nextSibling;
        $segretario->password = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato != 0) 
            $listaSegretari[] = $segretario;
    }
    return $listaSegretari;
}


function getSegretariLike($uname) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaSegretari = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $segretario = new segretario("", "");  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $segretario->username = $con->textContent;
        $con = $con->nextSibling;
        $segretario->password = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if(preg_match("\{$uname}\i", $segretario->username) && $stato != 0)
            $listaSegretari[] = $segretario;
    }
    return $listaSegretari;
}


function getSegretarioFromUsername($uname) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

     
    for ($i=0; $i<$records->length; $i++) {
        $segretario = new segretario("", "");  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $segretario->username = $con->textContent;
        $con = $con->nextSibling;
        $segretario->password = $con->textContent;
        $con = $con->nextSibling;
        $segretario->stato = $con->textContent;

        if($segretario->username == $uname && $segretario->stato != 0)
            return $segretario;
    }
    return NULL;
}


function getAmministratori() {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/amministrazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

    $listaAdmin = [];
    for ($i=0; $i<$records->length; $i++) {
        $admin = new amministratore("", "");  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $admin->username = $con->textContent;
        $con = $con->nextSibling;
        $admin->password = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($stato != 0)
            $listaAdmin[] = $admin;
    }
    return $listaAdmin;
}


function getAdminFromUsername($uname) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/amministrazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;

     
    for ($i=0; $i<$records->length; $i++) {
        $admin = new amministratore("", "");  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $admin->username = $con->textContent;
        $con = $con->nextSibling;
        $admin->password = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($admin->username == $uname && $stato != 0)
            return $admin;
    }
    return NULL;
}


function getAppelli() {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaAppelli = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $appello = new appello("", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $appello->id = $con->textContent;
        $con = $con->nextSibling;
        $appello->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $appello->dataOra = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($stato)   
            $listaAppelli[] = $appello;
    }
    return $listaAppelli;
}


function getAppelliFromCorsoDiLaurea($idCorsoLaurea) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaAppelli = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $appello = new appello("", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $appello->id = $con->textContent;
        $con = $con->nextSibling;
        $appello->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $appello->dataOra = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato != 1) continue;

        $corso = getCorsoById($appello->idCorso);

        if($corso->idCorsoLaurea == $idCorsoLaurea)
            $listaAppelli[] = $appello;
    }
    return $listaAppelli;
}


function getAppelliFromCorso($idCorso) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    
    $listaAppelli = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $appello = new appello("", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $appello->id = $con->textContent;
        $con = $con->nextSibling;
        $appello->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $appello->dataOra = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($appello->idCorso == $idCorso && $stato)
            $listaAppelli[] = $appello;
    }
    return $listaAppelli;
}


function getAppelloFromId($idAppello) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    
     
    for ($i=0; $i<$records->length; $i++) {
        $appello = new appello("", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $appello->id = $con->textContent;
        $con = $con->nextSibling;
        $appello->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $appello->dataOra = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($appello->id == $idAppello && $stato)
            return $appello;
    }
    return NULL;
}


function getEsamiSostenuti($studente) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaEsami = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $esame = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $esame->id = $con->textContent;
        $con = $con->nextSibling;
        $esame->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $esame->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $esame->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato == 1) {
            $appello = getAppelloFromId($esame->idAppello);
            $corso = getCorsoById($appello->idCorso);
    
            if($esame->matricolaStudente == $studente->matricola && $corso->idCorsoLaurea == $studente->idCorsoLaurea) 
                if($esame->esito != "NULL")
                    $listaEsami[] = $esame;
        }
    }
    return $listaEsami;
}


function getEsamiSuperati($studente) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaEsamiSuperati = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $esame = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $esame->id = $con->textContent;
        $con = $con->nextSibling;
        $esame->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $esame->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $esame->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato == 1) {
            $appello = getAppelloFromId($esame->idAppello);
            $corso = getCorsoById($appello->idCorso);
    
            if($esame->matricolaStudente == $studente->matricola && $corso->idCorsoLaurea == $studente->idCorsoLaurea) 
                if($esame->esito != "NULL" && $esame->esito != "R" && $esame->esito != "B")
                    $listaEsamiSuperati[] = $corso->id;
        }
    }
    return $listaEsamiSuperati;
}


function getAppelliPrenotati($studente) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaPrenotazioni = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $prenotazione = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $prenotazione->id = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        
        if($stato == 1) {

          if($prenotazione->matricolaStudente == $studente->matricola) {
              $appello = getAppelloFromId($prenotazione->idAppello);
              $corso = getCorsoById($appello->idCorso);

              if($corso->idCorsoLaurea == $studente->idCorsoLaurea){
                  if($prenotazione->esito == "NULL")
                      $listaPrenotazioni[] = $appello;
              }
          }
       }
    }
    return $listaPrenotazioni;
}


function getAppelliPrenotabili($studente) {
    $appelli = [];
    $appelli = getAppelliFromCorsoDiLaurea($studente->idCorsoLaurea);
    if(!$appelli)
        return NULL;

    $appelliPrenotabili = [];
    foreach($appelli as $appello) {
        $dataAppello = getDataFromDataora($appello->dataOra);
        $dataAppello = strtotime($dataAppello);
        $dataAppello = date('Y-m-d', $dataAppello);

        if($dataAppello > date('Y-m-d') && !verificaAppelloPrenotato($studente, $appello) && !verificaEsameSostenuto($studente, $appello->idCorso))
            $appelliPrenotabili[] = $appello;
    }

    return $appelliPrenotabili;
}


function getAppelliAfterDate($data) {
    $dataRif = strtotime($data);
    $dataRif = date('Y-m-d', $dataRif);

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaAppelli = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $appello = new appello("", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $appello->id = $con->textContent;
        $con = $con->nextSibling;
        $appello->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $appello->dataOra = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato == 1) {
            $dataAppello = getDataFromDataora($appello->dataOra);
            $dataAppello = strtotime($dataAppello);
            $dataAppello = date('Y-m-d', $dataAppello);
    
            if($dataAppello >= $dataRif)
                $listaAppelli[] = $appello;
        }
    }
    return $listaAppelli;
}


function getAppelliAfterDateFromCorso($data, $idCorso) {
    $dataRif = strtotime($data);
    $dataRif = date('Y-m-d', $dataRif);

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaAppelli = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $appello = new appello("", 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $appello->id = $con->textContent;
        $con = $con->nextSibling;
        $appello->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $appello->dataOra = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;
        if($stato == 1) {
            $dataAppello = getDataFromDataora($appello->dataOra);
            $dataAppello = strtotime($dataAppello);
            $dataAppello = date('Y-m-d', $dataAppello);
    
            if($dataAppello >= $dataRif && $appello->idCorso == $idCorso)
                $listaAppelli[] = $appello;
        }
    }
    return $listaAppelli;
}


function getDataFromDataora($dataora) {
    return substr($dataora, 0, 10);
}


function getOraFromDataora($dataora) {
    return substr($dataora, 11, 5);
}


function getPrenotazioniStudente($studente) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaPrenotazioni = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $prenotazione = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $prenotazione->id = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($stato == 1) {
            $appello = getAppelloFromId($prenotazione->idAppello);
            $corso = getCorsoById($appello->idCorso);
    
            if($prenotazione->matricolaStudente == $studente->matricola && $corso->idCorsoLaurea == $studente->idCorsoLaurea) 
                if($prenotazione->esito == "NULL")
                    $listaPrenotazioni[] = $prenotazione;
        }
    }
    return $listaPrenotazioni;
}


function getPrenotazioniFromAppello($idAppello) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaPrenotazioni = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $prenotazione = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $prenotazione->id = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($prenotazione->idAppello == $idAppello && $prenotazione->esito == "NULL" && $stato == 1)
            $listaPrenotazioni[] = $prenotazione;
    }
    return $listaPrenotazioni;
}


function getFullPrenotazioni() {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaPrenotazioni = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $prenotazione = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $prenotazione->id = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($stato == 1)
            $listaPrenotazioni[] = $prenotazione;
    }
    return $listaPrenotazioni;
}


function getPrenotazioneFromId($idPrenotazione) {
    if($idPrenotazione == 0)
        return NULL;

    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    for ($i=0; $i<$records->length; $i++) {
        $prenotazione = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $prenotazione->id = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($prenotazione->id == $idPrenotazione && $stato == 1)
            return $prenotazione;
    }
    return NULL;
}


function getVerbalizzazioniPositive($studente) {
    /*accedo al file xml*/
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaPrenotazioni = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $prenotazione = new prenotazione(0, 0);  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $prenotazione->id = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->idAppello = $con->textContent;
        $con = $con->nextSibling;
        $prenotazione->esito = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($prenotazione->matricolaStudente == $studente->matricola && $prenotazione->esito != "NULL" && $prenotazione->esito != "R" && $prenotazione->esito != "B" && $stato == 1)
            $listaPrenotazioni[] = $prenotazione;
    }
    return $listaPrenotazioni;
}


function getFaqComplete($idCorso){
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaFaq = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $faq = new faq();  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $faq->id = $con->textContent;
        $con = $con->nextSibling;
        $faq->domanda = $con->textContent;
        $con = $con->nextSibling;
        $faq->risposta = $con->textContent;
        $con = $con->nextSibling;
        $faq->utilitaTotale = $con->textContent;
        $con = $con->nextSibling;
        $faq->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $faq->idAutore = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($faq->idCorso == $idCorso && $faq->risposta != "" && $stato)
            $listaFaq [] = $faq;
    }
    return $listaFaq;
}

function getFaqIncomplete($idCorso){
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
     
    $listaFaq = [];
     
    for ($i=0; $i<$records->length; $i++) {
        $faq = new faq();  # Default constructor
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $faq->id = $con->textContent;
        $con = $con->nextSibling;
        $faq->domanda = $con->textContent;
        $con = $con->nextSibling;
        $faq->risposta = $con->textContent;
        $con = $con->nextSibling;
        $faq->utilitaTotale = $con->textContent;
        $con = $con->nextSibling;
        $faq->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $faq->idAutore = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($faq->idCorso == $idCorso && $faq->risposta == "" && $stato)
            $listaFaq [] = $faq;
    }
    return $listaFaq;
}

function getVotoFaq($idStudente,$idFaq){
    $xmlString = "";
    foreach ( file("../Xml/votoFAQ.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
       
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);
             
        $con = $record->firstChild;
        $id = $con->textContent;
        $con = $con->nextSibling;
        $matricola = $con->textContent;
        $con = $con->nextSibling;
        $idFAQ = $con->textContent;
        $con = $con->nextSibling;
        $utilita = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($idFAQ == $idFaq && $matricola == $idStudente && $stato == 1)
            return $utilita;
    }

    return 0;//voto non dato
}

function getListaPost($_idCorso){
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    $postList = [];
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);    
        $post = new post();

        $con = $record->firstChild;
        $post->id = $con->textContent;
        $con = $con->nextSibling;
        $post->titolo = $con->textContent;
        $con = $con->nextSibling;
        $post->corpo = $con->textContent;
        $con = $con->nextSibling;
        $post->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $post->utilitaTotale = $con->textContent;
        $con = $con->nextSibling;
        $post->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $post->data = $con->textContent;
        $post->replies = getPostReplies($post->id);
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($_idCorso == $post->idCorso && $stato)
            $postList[] = $post;
    }
    return $postList;//voto non dato
}

function getPostReplies($idPost) {
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    $replies = 0;
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);    

        $con = $record->firstChild;
        $tmp = $con->textContent; #id
        $con = $con->nextSibling;
        $tmp = $con->textContent; #corpo
        $con = $con->nextSibling;
        $tmp = $con->textContent; #matricola studente
        $con = $con->nextSibling;
        $tmp = $con->textContent; #accordoMedio
        $con = $con->nextSibling;
        $tmp = $con->textContent; #idPost
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($tmp == $idPost && $stato)
            $replies++;
    }
    return $replies;
}


function getPostComments($idPost) {
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    $listaCommenti = [];
    for ($i=0; $i<$records->length; $i++) {
        $commento = new comment();
        $record = $records->item($i);    

        $con = $record->firstChild;
        $commento->id = $con->textContent; #id
        $con = $con->nextSibling;
        $commento->corpo = $con->textContent; #corpo
        $con = $con->nextSibling;
        $commento->matricolaStudente = $con->textContent; #matricola studente
        $con = $con->nextSibling;
        $commento->accordoMedio = $con->textContent; #accordoMedio
        $con = $con->nextSibling;
        $commento->idPost = $con->textContent; #idPost
        $con = $con->nextSibling;
        $commento->data = $con->textContent; #data
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($commento->idPost == $idPost && $stato)
            $listaCommenti[] = $commento;
    }

    return $listaCommenti;//voto non dato
}

function getCommentFromId($idCommento) {
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    for ($i=0; $i<$records->length; $i++) {
        $commento = new comment();
        $record = $records->item($i);    

        $con = $record->firstChild;
        $commento->id = $con->textContent; #id
        $con = $con->nextSibling;
        $commento->corpo = $con->textContent; #corpo
        $con = $con->nextSibling;
        $commento->matricolaStudente = $con->textContent; #matricola studente
        $con = $con->nextSibling;
        $commento->accordoMedio = $con->textContent; #accordoMedio
        $con = $con->nextSibling;
        $commento->idPost = $con->textContent; #idPost
        $con = $con->nextSibling;
        $commento->data = $con->textContent; #data
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($commento->id == $idCommento && $stato)
            return $commento;
    }

    return null;//voto non dato
}

function getPostFromId($_idPost){
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);    
        $post = new post();

        $con = $record->firstChild;
        $post->id = $con->textContent;
        $con = $con->nextSibling;
        $post->titolo = $con->textContent;
        $con = $con->nextSibling;
        $post->corpo = $con->textContent;
        $con = $con->nextSibling;
        $post->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $post->utilitaTotale = $con->textContent;
        $con = $con->nextSibling;
        $post->idCorso = $con->textContent;
        $con = $con->nextSibling;
        $post->data = $con->textContent;
        $post->replies = getPostReplies($post->id);
        $con = $con->nextSibling;
        $stato = $con->textContent;


        if($_idPost == $post->id && $stato)
            return $post;
    }
    return null;//voto non dato
}


function getVotoCommento($idCommento,$matricola) {
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }
         
    // Creazione del documento
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);
    $records = $doc->documentElement->childNodes;
    for ($i=0; $i<$records->length; $i++) {
        $record = $records->item($i);    
        $vote = new commentVote();

        $con = $record->firstChild;
        $vote->id = $con->textContent;
        $con = $con->nextSibling;
        $vote->matricolaStudente = $con->textContent;
        $con = $con->nextSibling;
        $vote->idCommento = $con->textContent;
        $con = $con->nextSibling;
        $vote->accordo = $con->textContent;
        $con = $con->nextSibling;
        $vote->idAutoreCommento = $con->textContent;
        $con = $con->nextSibling;
        $stato = $con->textContent;

        if($vote->matricolaStudente == $matricola && $vote->idCommento == $idCommento && $stato)
            return $vote;
    }
    return null;//voto non dato
}


function getVotoPostFromStudente($idPost, $matricola){
    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $votiPost = simplexml_load_file('../Xml/votoPost.xml');
    $numVoti = 0;
    foreach($votiPost as $voto){
        if($voto->idPost == $idPost && $voto->matricolaStudente == $matricola && $voto->stato == 1)
           return $voto->utilita;
    }
    return 0;
}


function getPasswordStudente($matricola) {
    if($matricola == 0)
        return "";
    
    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');
    foreach($studenti as $studente)
        if($studente->matricola == $matricola && $studente->stato != 0)
            return $studente->password;

    return "";
}


function getPasswordDocente($matricola) {
    if($matricola == 0)
        return "";

    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $docenti = simplexml_load_file('../Xml/docenti.xml');
    foreach($docenti as $docente)
        if($docente->matricola == $matricola && $docente->stato != 0)
            return $docente->password;

    return "";
}


function getPasswordSegretario($username) {
    if($username == "")
        return "";

    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $segretari = simplexml_load_file('../Xml/segreteria.xml');
    foreach($segretari as $segretario)
        if($segretario->username == $username && $segretario->stato != 0)
            return $segretario->password;

    return "";
}


function getPasswordAmministratore($username) {
    if($username == "")
        return "";
        
    $xmlString = "";
    foreach ( file("../Xml/amministrazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $amministratori = simplexml_load_file('../Xml/amministrazione.xml');
    foreach($amministratori as $admin)
        if($admin->username == $username && $admin->stato != 0)
            return $admin->password;

    return "";
}


function getStatoStudente($studente) {
    if(!$studente)
        return 0;

    $studenti = simplexml_load_file('../Xml/studenti.xml');
    foreach($studenti as $stud)
        if($studente->matricola == $stud->matricola)
            return $stud->stato;

    return 0;
}


function getStatoDocente($docente) {
    if(!$docente)
        return 0;

    $docenti = simplexml_load_file('../Xml/docenti.xml');
    foreach($docenti as $doc)
        if($docente->matricola == $doc->matricola)
            return $doc->stato;

    return 0;
}


function getStatoSegretario($segretario) {
    if(!$segretario)
        return 0;

    $segretari = simplexml_load_file('../Xml/segreteria.xml');
    foreach($segretari as $sgrt)
        if($segretario->username == $sgrt->username)
            return $sgrt->stato;

    return 0;
}


function getUtilitaTotale($id){
    updateFaqUtility($id);
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $faqs = simplexml_load_file('../Xml/faqs.xml');
    foreach($faqs as $faq)
        if($faq->id == $id )
            return $faq->utilitaTotale;

    return 0;
}


function getHiddenPassword($password) {
    $hidden_password = "";

    for($i = 0; $i < strlen($password); $i+=1)
        $hidden_password .= '*';

    return $hidden_password;
}
?>