<?php
// require_once('phpClasses.php');

// /* ================================= 
// ========== PHP FUNCTIONS ===========
// ==================================== */

// function console_log( $data ){
//     echo '<script>';
//     echo 'console.log('. json_encode( $data ) .')';
//     echo '</script>';
// }


// function generaMatricola($tipoUtenza) {
//     $file = "";

//     if($tipoUtenza == "Studente")
//         $file = '../Xml/studenti.xml';
//     elseif($tipoUtenza == "Docente")
//         $file = '../Xml/docenti.xml';
//     else
//         return 0;   /* ERRORE */


//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file($file) as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $ultimaMatricola = $con->textContent;
//     }

//     return (intval($ultimaMatricola) + 1);
// }


// function verificaPresenzaCorsoDiLaurea($nome) {
//     $listaCorsiDiLaurea = getCorsiDiLaurea();

//     foreach($listaCorsiDiLaurea as $corso)
//         if(strtolower($corso->nome) == strtolower($nome))
//             return TRUE;
    
//     return FALSE;
// }


// function verificaPresenzaCorso($corso) {
//     $listaCorsi = getCorsiFromCorsoDiLaurea($corso->idCorsoLaurea);

//     foreach($listaCorsi as $c)
//         if($c->nome == $corso->nome)
//             return TRUE;
    
//     return FALSE;
// }


// function verificaPresenzaAppello($appello) {
//     $listaAppelli = getAppelliFromCorso($appello->idCorso);
//     $dataAppello = getDataFromDataora($appello->dataOra);

//     foreach($listaAppelli as $app) {
//         $dataApp = getDataFromDataora($app->dataOra);
//         if($dataAppello == $dataApp)
//             return TRUE;
//     }

//     return FALSE;
// }



// function nextFaqid(){
//     $xmlString = "";
//     foreach ( file("../Xml/faqs.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaId = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }
//     $id = 1;

//     while(in_array($id,$listaId)){
//         $id++;
//     }
    
//     return $id;
// }

// function nextFaqVoteId(){
//     $xmlString = "";
//     foreach ( file("../Xml/votoFAQ.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaId = [];
     
//     for ($i=0; $i<$records->length; $i++) { 
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }
//     $id = 1;

//     while(in_array($id,$listaId)){
//         $id++;
//     }
    
//     return $id;
// }

// function  nextPostId() {
//     $xmlString = "";
//     foreach ( file("../Xml/posts.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaId = [];
     
//     for ($i=0; $i<$records->length; $i++) { 
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }
//     $id = 1;

//     while(in_array($id,$listaId)){
//         $id++;
//     }
    
//     return $id;
// }
// function  nextCommentVoteId() {
//     $xmlString = "";
//     foreach ( file("../Xml/votoCommento.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaId = [];
     
//     for ($i=0; $i<$records->length; $i++) { 
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }
//     $id = 1;

//     while(in_array($id,$listaId)){
//         $id++;
//     }

//     return $id;
// }

// function nextCommentId() {
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaId = [];
     
//     for ($i=0; $i<$records->length; $i++) { 
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }
//     $id = 1;

//     while(in_array($id,$listaId)){
//         $id++;
//     }

//     return $id;
// }

// /* ================================= 
// ======== Display functions =========
// ==================================== */


// function creaSidebar($loginType) {
//     switch($loginType) {

//         case "Studente":
//             echo '
//             <div class="sidebar">
//                 <h5>
//                     Informazioni
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users.php" style="display: flex; margin: 0px;">Visualizza anagrafica</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users-Carriera.php" style="display: flex; margin: 0px;">Visualizza carriera</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <h5>
//                     Esami
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users-appelliPrenotati.php" style="display: flex; margin: 0px;">Appelli prenotati</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users-prenotaAppello.php" style="display: flex; margin: 0px;">Prenota appello</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users-esamiSostenuti.php" style="display: flex; margin: 0px;">Esami sostenuti</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <div style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzione" href="homepage-bacheca.php">Bacheca</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <div style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzione" href="homepage-faq.php">FAQ</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//             </div>
//             ';
//             break;


//         case "Docente":
//             echo '
//             <div class="sidebar">
//                 <h5>
//                     Informazioni
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users.php" style="display: flex; margin: 0px;">Visualizza anagrafica</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <h5>
//                     Esami
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="inserisciAppello.php" style="display: flex; margin: 0px;">Inserisci appello</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="visualizzaAppelli.php" style="display: flex; margin: 0px;">Visualizza appelli</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="gestionePrenotazioni.php" style="display: flex; margin: 0px;">Gestione prenotazioni</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <div style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzione" href="homepage-users-visualizzaFaq.php">FAQ</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//             </div>
//             ';
//             break;


//         case "Segretario":
//             echo '
//             <div class="sidebar">
//                 <h5>
//                     Informazioni
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users.php" style="display: flex; margin: 0px;">Visualizza anagrafica</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <h5>
//                     Esami
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="inserisciAppello.php" style="display: flex; margin: 0px;">Inserisci appello</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="visualizzaAppelli.php" style="display: flex; margin: 0px;">Visualizza appelli</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="gestionePrenotazioni.php" style="display: flex; margin: 0px;">Gestione prenotazioni</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <div style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzione" href="homepage-bacheca.php">Bacheca</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <div style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzione" href="homepage-faq.php">FAQ</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//             </div>
//             ';
//             break;


//         case "Amministratore":
//             echo '
//             <div class="sidebar" style="">
//                 <h5>
//                     Informazioni
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="homepage-users.php" style="display: flex; margin: 0px;">Visualizza anagrafica</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <h5>
//                     Esami
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="inserisciAppello.php" style="display: flex; margin: 0px;">Inserisci appello</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="visualizzaAppelli.php" style="display: flex; margin: 0px;">Visualizza appelli</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="gestionePrenotazioni.php" style="display: flex; margin: 0px;">Gestione prenotazioni</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <div style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzione" href="homepage-bacheca.php">Bacheca</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <div style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzione" href="homepage-faq.php">FAQ</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <h5>
//                     Moderazione utenze
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="visualizzaStudentiAdmin.php" style="display: flex; margin: 0px;">Visualizza studenti</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="visualizzaDocentiAdmin.php" style="display: flex; margin: 0px;">Visualizza docenti</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="visualizzaSegreteriaAdmin.php" style="display: flex; margin: 0px;">Visualizza segreteria</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//                 <h5>
//                     Altre funzionalità
//                 </h5>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="inserisciCorsoDiLaurea.php" style="display: flex; margin: 0px;">Inserisci corso di laurea</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="inserisciCorso.php" style="display: flex; margin: 0px;">Inserisci corso</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="gestisciCorsiDiLaurea.php" style="display: flex; margin: 0px;">Gestisci corsi di laurea</a>
//                     </h5>
//                 </div>
//                 <div style="display: flex;">
//                     <img src="arrow.png" alt="freccia" width="20px" style="display: flex;">
//                     <h5 style="display: flex; margin: 0px;">
//                         <a class="opzionetab" href="gestisciCorsi.php" style="display: flex; margin: 0px;">Gestisci corsi</a>
//                     </h5>
//                 </div>
//                 <hr style="width: 90%; margin-left: -2%;" />
//             </div>
//             ';
//             break;
//     }
// }


// function displayFullStudente($studente) {
//     $corsoDiLaurea = getNomeCorsoDiLaureaByID($studente->idCorsoLaurea);
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;">
//         <div class="infoVoice">
//             <h2>Utenza: Studente</h2>
//         </div>
//         <div class="infoVoice">
//             <h2>Nome: '.$studente->nome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Cognome: '.$studente->cognome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Matricola: '.$studente->matricola.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Corso di laurea: '.$corsoDiLaurea.'</h2>
//         </div>
//         <div class="infoVoice">
//             <h2>Data di nascita: '.$studente->dataNascita.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Password: '.$studente->password.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Reputazione totale: '.$studente->reputazioneTotale.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>CFU totali: '.$studente->cfuTotale.'</h2>
//         </div>
//         <div class="infoVoice">
//             <h2>Media voti: '.$studente->media.'</h2>
//         </div>
//     </div>
// </div>
//     ';
// }


// function displayFullDocente($docente) {
//     $corso = getNomeCorso($docente->idCorso);
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;">
//         <div class="infoVoice">
//             <h2>Utenza: Docente</h2>
//         </div>
//         <div class="infoVoice">
//             <h2>Nome: '.$docente->nome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Cognome: '.$docente->cognome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Matricola: '.$docente->matricola.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Insegnamento: '.$corso.'</h2>
//         </div> 
//         <div class="infoVoice">
//             <h2>Password: '.$docente->password.'</h2>
//         </div>
//     </div>
// </div>
//     ';
// }


// function displayFullSegretario($segretario) {
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;">
//         <div class="infoVoice">
//             <h2>Utenza: Segretario</h2>
//         </div>
//         <div class="infoVoice">
//             <h2>Username: '.$segretario->username.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Password: '.$segretario->password.'</h2>
//         </div>  
//     </div>
// </div>
//     ';
// }


// function displayAnagraficaStudente($studente) {
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;">
//         <div class="infoVoice">
//             <h2>Matricola: '.$studente->matricola.'</h2>
//         </div>
//         <div class="infoVoice">
//             <h2>Nome: '.$studente->nome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Cognome: '.$studente->cognome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Data di nascita: '.$studente->dataNascita.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Password: '.$studente->password.'</h2>
//         </div>  
//     </div>
// </div>
//     ';
// }


// function displayAnagraficaDocente($docente) {
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;">
//         <div class="infoVoice">
//             <h2>Matricola: '.$docente->matricola.'</h2>
//         </div> 
//         <div class="infoVoice">
//             <h2>Nome: '.$docente->nome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Cognome: '.$docente->cognome.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Password: '.$docente->password.'</h2>
//         </div>
//     </div>
// </div>
//     ';
// }


// function displayAnagraficaSegretario($segretario) {
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;">
//         <div class="infoVoice">
//             <h2>Username: '.$segretario->username.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Password: '.$segretario->password.'</h2>
//         </div>  
//     </div>
// </div>
//     ';
// }


// function displayAnagraficaAmministratore($amministratore) {
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;">
//         <div class="infoVoice">
//             <h2>Username: '.$amministratore->username.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Password: '.$amministratore->password.'</h2>
//         </div>  
//     </div>
// </div>
//     ';
// }


// function displayCarrieraStudente($studente) {
//     $corsoDiLaurea = getNomeCorsoDiLaureaByID($studente->idCorsoLaurea);
//     echo '
// <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
//     <div style="margin-left: 2%;"> 
//         <div class="infoVoice">
//             <h2>Corso di laurea: '.$corsoDiLaurea.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>Reputazione totale: '.$studente->reputazioneTotale.'</h2>
//         </div>  
//         <div class="infoVoice">
//             <h2>CFU totali: '.$studente->cfuTotale.'</h2>
//         </div>
//         <div class="infoVoice">
//             <h2>Media voti: '.$studente->media.'</h2>
//         </div>
//     </div>
// </div>
//     ';
// }


// function displayAppelliPrenotabili($studente) {
//     $appelli = [];
//     $appelli = getAppelliPrenotabili($studente);

//     if(!$appelli)
//         echo '<h2>Nessun appello prenotabile trovato.</h2>';
//     else {
//         foreach($appelli as $appello) {
//             $corso = getCorsoById($appello->idCorso);
//             echo '
//             <div class="blocco-esame" style="background-color:lightblue;">
//                 <div class="nome-esame">
//                     '.$corso->nome."<br />".$appello->dataOra.'
//                 </div> 
//                 <div class="info-button">
//                     PRENOTA
//                     <form action="prenotaAppello-script.php" method="POST">
//                         <input type="submit" name="prenota" value="" >
//                         <input type="hidden" name="matricola" value="'.$_SESSION['matricola'].'">
//                         <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                     </form>
//                 </div>  
//             </div>
//             ';
//         }
//     }
// }


// function displayFullAppelli() {
//     $appelli = [];
//     $appelli = getAppelli();

//     if(!$appelli)
//         echo '<h2>Nessun appello trovato.</h2>';
//     else {
//         foreach($appelli as $appello) {
//             $corso = getCorsoById($appello->idCorso);
            
//             if($_SESSION['src'] == "manage") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome."<br />".$appello->dataOra.'
//                     </div> 
//                     <div class="info-button">
//                         INFO
//                         <form action="visualizzaPrenotazioni.php" method="POST">
//                             <input type="submit" name="info" value="" >
//                             <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                         </form>
//                     </div>  
//                 </div>
//                 ';
//             }

//             elseif($_SESSION['src'] == "edit") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome."<br />".$appello->dataOra.'
//                     </div> 
//                     <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                         <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                             MODIFICA
//                             <form action="modificaAppello.php" method="POST">
//                                 <input type="submit" name="modifica" value="" >
//                                 <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                                 <input type="hidden" name="idCorso" value="'.$appello->idCorso.'">
//                                 <input type="hidden" name="dataOra" value="'.$appello->dataOra.'">
//                             </form>
//                         </div>  
//                         <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                             ELIMINA
//                             <form action="eliminaAppello-script.php" method="POST">
//                                 <input type="submit" name="elimina" value="" >
//                                 <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                             </form>
//                         </div> 
//                     </div>
//                 </div>
//                 ';
//             }
//         }
//     }
// }


// function displayAppelliFromCorso($idCorso) {
//     $appelli = [];
//     $appelli = getAppelliAfterDateFromCorso(date('Y-m-d'), $idCorso);

//     if(!$appelli)
//         echo '<h2>Nessun appello trovato.</h2>';
//     else {
//         foreach($appelli as $appello) {
//             $corso = getCorsoById($appello->idCorso);
            
//             if($_SESSION['src'] == "manage") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome."<br />".$appello->dataOra.'
//                     </div> 
//                     <div class="info-button">
//                         INFO
//                         <form action="visualizzaPrenotazioni.php" method="POST">
//                             <input type="submit" name="info" value="" >
//                             <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                         </form>
//                     </div>  
//                 </div>
//                 ';
//             }

//             elseif($_SESSION['src'] == "edit") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome."<br />".$appello->dataOra.'
//                     </div> 
//                     <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                         <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                             MODIFICA
//                             <form action="modificaAppello.php" method="POST">
//                                 <input type="submit" name="modifica" value="" >
//                                 <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                                 <input type="hidden" name="idCorso" value="'.$appello->idCorso.'">
//                                 <input type="hidden" name="dataOra" value="'.$appello->dataOra.'">
//                             </form>
//                         </div>  
//                         <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                             ELIMINA
//                             <form action="eliminaAppello-script.php" method="POST">
//                                 <input type="submit" name="elimina" value="" >
//                                 <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                             </form>
//                         </div> 
//                     </div> 
//                 </div>
//                 ';
//             }
//         }
//     }
// }


// function displayAppelliLike($nomeCorso) {
//     $corsi = [];
//     $corsi = getCorsiLike($nomeCorso);

//     if(!$corsi)
//         echo '<h2>Nessun appello corrispondente ai criteri di ricerca.</h2>';
//     else {
//         foreach($corsi as $corso) {
//             $appelli = [];
//             $appelli = getAppelliFromCorso($corso->id);
//             if(!$appelli) {
//                 echo '<h2>Nessun appello corrispondente ai criteri di ricerca.</h2>';
//                 break;
//             }
//             else {
//                 foreach($appelli as $appello) {
//                     if($_SESSION['src'] == "manage") {
//                         echo '
//                         <div class="blocco-esame" style="background-color:lightblue;">
//                             <div class="nome-esame">
//                                 '.$corso->nome."<br />".$appello->dataOra.'
//                             </div> 
//                             <div class="info-button">
//                                 INFO
//                                 <form action="visualizzaPrenotazioni.php" method="POST">
//                                     <input type="submit" name="info" value="" >
//                                     <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                                 </form>
//                             </div>  
//                         </div>
//                         ';
//                     }
        
//                     elseif($_SESSION['src'] == "edit") {
//                         echo '
//                         <div class="blocco-esame" style="background-color:lightblue;">
//                             <div class="nome-esame">
//                                 '.$corso->nome."<br />".$appello->dataOra.'
//                             </div> 
//                             <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                                 <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                                     MODIFICA
//                                     <form action="modificaAppello.php" method="POST">
//                                         <input type="submit" name="modifica" value="" >
//                                         <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                                         <input type="hidden" name="idCorso" value="'.$appello->idCorso.'">
//                                         <input type="hidden" name="dataOra" value="'.$appello->dataOra.'">
//                                     </form>
//                                 </div>  
//                                 <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                                     ELIMINA
//                                     <form action="eliminaAppello-script.php" method="POST">
//                                         <input type="submit" name="elimina" value="" >
//                                         <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                                     </form>
//                                 </div> 
//                             </div>
//                         </div>
//                         ';
//                     }
//                 }
//             }
//         }
//     }
// }


// function displayAppelliAfterDate($data) {
//     if($_SESSION['loginType'] == "Docente") {
//         $docente = getDocenteFromMatricola($_SESSION['matricola']);
//         $appelli = getAppelliAfterDateFromCorso($data, $docente->idCorso);
//     }
//     else 
//         $appelli = getAppelliAfterDate($data);

//     if(!$appelli)
//         echo '<h2>Nessun appello corrispondente ai criteri di ricerca.</h2>';
//     else {
//         foreach($appelli as $appello) {
//             $corso = getCorsoById($appello->idCorso);
    
//             if($_SESSION['src'] == "manage") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome."<br />".$appello->dataOra.'
//                     </div> 
//                     <div class="info-button">
//                         INFO
//                         <form action="visualizzaPrenotazioni.php" method="POST">
//                             <input type="submit" name="info" value="" >
//                             <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                         </form>
//                     </div>  
//                 </div>
//                 ';
//             }
    
//             elseif($_SESSION['src'] == "edit") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome."<br />".$appello->dataOra.'
//                     </div> 
//                     <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                         <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                             MODIFICA
//                             <form action="modificaAppello.php" method="POST">
//                                 <input type="submit" name="modifica" value="" >
//                                 <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                                 <input type="hidden" name="idCorso" value="'.$appello->idCorso.'">
//                                 <input type="hidden" name="dataOra" value="'.$appello->dataOra.'">
//                             </form>
//                         </div>  
//                         <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                             ELIMINA
//                             <form action="eliminaAppello-script.php" method="POST">
//                                 <input type="submit" name="elimina" value="" >
//                                 <input type="hidden" name="idAppello" value="'.$appello->id.'">
//                             </form>
//                         </div> 
//                     </div>
//                 </div>
//                 ';
//             }
//         }
//     }
// }


// function displayCorsiDiLaurea() {
//     $corsiDiLaurea = [];
//     $corsiDiLaurea = getCorsiDiLaurea();

//     if(!$corsiDiLaurea)
//         echo '<h2>Nessun corso di laurea trovato.</h2>';
//     else {
//         foreach($corsiDiLaurea as $corsoDiLaurea) {
//             if($_SESSION['src'] == "edit") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corsoDiLaurea->nome.'
//                     </div> 
//                     <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                         <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                             MODIFICA
//                             <form action="modificaCorsoDiLaurea.php" method="POST">
//                                 <input type="submit" name="modifica" value="" >
//                                 <input type="hidden" name="idCorsoDiLaurea" value="'.$corsoDiLaurea->id.'">
//                                 <input type="hidden" name="nomeCorsoDiLaurea" value="'.$corsoDiLaurea->nome.'">
//                             </form>
//                         </div>  
//                         <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                             ELIMINA
//                             <form action="eliminaCorsoDiLaurea-script.php" method="POST">
//                                 <input type="submit" name="elimina" value="" >
//                                 <input type="hidden" name="idCorsoDiLaurea" value="'.$corsoDiLaurea->id.'">
//                             </form>
//                         </div> 
//                     </div>
//                 </div>
//                 ';
//             }
//         }
//     }
// }


// function displayCorsiDiLaureaLike($nome) {
//     $corsiDiLaurea = [];
//     $corsiDiLaurea = getCorsiDiLaureaLike($nome);

//     if(!$corsiDiLaurea)
//         echo '<h2>Nessun corso di laurea trovato.</h2>';
//     else {
//         foreach($corsiDiLaurea as $corsoDiLaurea) {
//             if($_SESSION['src'] == "edit") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corsoDiLaurea->nome.'
//                     </div> 
//                     <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                         <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                             MODIFICA
//                             <form action="modificaCorsoDiLaurea.php" method="POST">
//                                 <input type="submit" name="modifica" value="" >
//                                 <input type="hidden" name="idCorsoDiLaurea" value="'.$corsoDiLaurea->id.'">
//                                 <input type="hidden" name="nomeCorsoDiLaurea" value="'.$corsoDiLaurea->nome.'">
//                             </form>
//                         </div>  
//                         <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                             ELIMINA
//                             <form action="eliminaCorsoDiLaurea-script.php" method="POST">
//                                 <input type="submit" name="elimina" value="" >
//                                 <input type="hidden" name="idCorsoDiLaurea" value="'.$corsoDiLaurea->id.'">
//                             </form>
//                         </div> 
//                     </div>
//                 </div>
//                 ';
//             }
//         }
//     }
// }


// function displayCorsi() {
//     $corsi = [];
//     $corsi = getCorsi();

//     if(!$corsi)
//         echo '<h2>Nessun corso trovato.</h2>';
//     else {
//         foreach($corsi as $corso) {
//             if($_SESSION['src'] == "edit") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome.'
//                     </div> 
//                     <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                         <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                             MODIFICA
//                             <form action="modificaCorso.php" method="POST">
//                                 <input type="submit" name="modifica" value="" >
//                                 <input type="hidden" name="idCorso" value="'.$corso->id.'">
//                             </form>
//                         </div>  
//                         <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                             ELIMINA
//                             <form action="eliminaCorso-script.php" method="POST">
//                                 <input type="submit" name="elimina" value="" >
//                                 <input type="hidden" name="idCorso" value="'.$corso->id.'">
//                             </form>
//                         </div> 
//                     </div>
//                 </div>
//                 ';
//             }
//         }
//     }
// }


// function displayCorsiLike($nome) {
//     $corsi = [];
//     $corsi = getCorsiLike($nome);

//     if(!$corsi)
//         echo '<h2>Nessun corso trovato.</h2>';
//     else {
//         foreach($corsi as $corso) {
//             if($_SESSION['src'] == "edit") {
//                 echo '
//                 <div class="blocco-esame" style="background-color:lightblue;">
//                     <div class="nome-esame">
//                         '.$corso->nome.'
//                     </div> 
//                     <div style="display: flex; flex-direction: row; padding-top: 10%; margin-left: -10%;">
//                         <div class="info-button" style="padding-left: 15%; padding-right: 15%;">
//                             MODIFICA
//                             <form action="modificaCorso.php" method="POST">
//                                 <input type="submit" name="modifica" value="" >
//                                 <input type="hidden" name="idCorso" value="'.$corso->id.'">
//                             </form>
//                         </div>  
//                         <div class="info-button" style="margin-left: 10%; padding-left: 15%; padding-right: 15%;">
//                             ELIMINA
//                             <form action="eliminaCorso-script.php" method="POST">
//                                 <input type="submit" name="elimina" value="" >
//                                 <input type="hidden" name="idCorso" value="'.$corso->id.'">
//                             </form>
//                         </div> 
//                     </div>
//                 </div>
//                 ';
//             }
//         }
//     }
// }





// /* ================================= 
// ========= Login functions ==========
// ==================================== */

// function verificaPresenzaMatricola($matricola, $loginType) {
//     $file = "";

//     if($loginType == "Studente")
//         $file = '../Xml/studenti.xml';
//     elseif($loginType == "Docente")
//         $file = '../Xml/docenti.xml';
//     else
//         return 0;   /* ERRORE */

    
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file($file) as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $matr = $con->textContent;
        
//         if($matr == $matricola) return TRUE;
//     }

//     return FALSE;
// }

// function verificaPresenzaUsername($username, $loginType) {
//     $file = "";

//     if($loginType == "Segretario")
//         $file = '../Xml/segreteria.xml';
//     elseif($loginType == "Amministratore")
//         $file = '../Xml/amministrazione.xml';
//     else
//         return 0;   /* ERRORE */

    
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file($file) as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $uname = $con->textContent;
        
//         if($uname == $username) return TRUE;
//     }

//     return FALSE;
// }

// function verificaPasswordStudentiDocenti($password, $loginType) {
//     $file = "";

//     if($loginType == "Studente")
//         $file = '../Xml/studenti.xml';
//     elseif($loginType == "Docente")
//         $file = '../Xml/docenti.xml';
//     else
//         return 0;   /* ERRORE */
    
    
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file($file) as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $nome = $con->textContent;
//         $con = $con->nextSibling;
//         $cognome = $con->textContent;
//         $con = $con->nextSibling;
//         $pwd = $con->textContent;
        
//         if($pwd == $password) return TRUE;
//     }

//     return FALSE;
// }

// function verificaPasswordSegretarioAmministratore($password, $loginType) {
//     $file = "";

//     if($loginType == "Segretario")
//         $file = '../Xml/segreteria.xml';
//     elseif($loginType == "Amministratore")
//         $file = '../Xml/amministrazione.xml';
//     else
//         return 0;   /* ERRORE */
    
    
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file($file) as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $username = $con->textContent;
//         $con = $con->nextSibling;
//         $pwd = $con->textContent;
        
//         if($pwd == $password) return TRUE;
//     }

//     return FALSE;
// }





// /* ================================= 
// ========== Get functions ===========
// ==================================== */

// function getCorsi() {
//      /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $listaCorsi = [];

//     for ($i=0; $i<$records->length; $i++) {
//         $corso = new corso("", "", "", "", "", "", "", "", "");
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $corso->id = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->descrizione = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->matricola_prof = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->colore = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->anno = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->semstre = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->curriculum = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->cfu = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->ssd = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->idCorsoLaurea = $con->textContent;

//         $listaCorsi[] = $corso;
//     }
//     return $listaCorsi;
// }


// function getCorsoById($_id) {
//     /*accedo al file xml*/
//     $xmlString = "";
//    foreach ( file("../Xml/corsi.xml") as $node ) {
//        $xmlString .= trim($node);
//    }
   
//    // Creazione del documento
//    $doc = new DOMDocument();
//    $doc->loadXML($xmlString);
//    $records = $doc->documentElement->childNodes;

//    for ($i=0; $i<$records->length; $i++) {
//        $corso = new corso("", "", "", "", "", "", "", "", "");
//        $record = $records->item($i);

//        $con = $record->firstChild;
//        $id = $con->textContent;
//        if($id != $_id) continue; 

//        $corso->id = $id;
//        $con = $con->nextSibling;
//        $corso->nome = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->descrizione = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->matricolaProf = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->colore = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->anno = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->semestre = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->curriculum = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->cfu = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->ssd = $con->textContent;
//        $con = $con->nextSibling;
//        $corso->idCorsoLaurea = $con->textContent;
       
//        return $corso;
//    }
//    return null;  
// }


// function getCorsiLike($_nome){
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $listaCorsi = [];

//     for ($i=0; $i<$records->length; $i++) {
//         $corso = new corso("", "", "", "", "", "", "", "", "");
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $corso->id = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->descrizione = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->matricola_prof = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->colore = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->anno = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->semstre = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->curriculum = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->cfu = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->ssd = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->idCorsoLaurea = $con->textContent;
        
//         /*controllo sul nome*/
//         if(preg_match("#^{$_nome}#i", $corso->nome)) $listaCorsi[] = $corso;
//     }
//     return $listaCorsi;
// }


// function getCorsiFromCorsoDiLaurea($idCorsoLaurea) {
//     $listaCorsi = [];
//     $corsi = getCorsi();

//     foreach($corsi as $corso) {
//         if($corso->idCorsoLaurea == $idCorsoLaurea) 
//             $listaCorsi[] = $corso;
//     }

//     return $listaCorsi;
// }


// function getCorsiFromCorsoDiLaureaLike($idCorsoLaurea, $_nome) {
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $listaCorsi = [];

//     for ($i=0; $i<$records->length; $i++) {
//         $corso = new corso("", "", "", "", "", "", "", "", "");
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $corso->id = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->descrizione = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->matricola_prof = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->colore = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->anno = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->semstre = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->curriculum = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->cfu = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->ssd = $con->textContent;
//         $con = $con->nextSibling;
//         $corso->idCorsoLaurea = $con->textContent;
        
//         /* Controllo sul nome e sul corso di laurea di appartenenza */
//         if(preg_match("#^{$_nome}#i", $corso->nome) && $corso->idCorsoLaurea == $idCorsoLaurea) 
//             $listaCorsi[] = $corso;
//     }
//     return $listaCorsi;
// }


// function getNomeCorso($num) {
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $nomeCorso = "N/A";

//     if($records->length > 0) { /* C'è almeno un corso */
//         for ($i=0; $i<$records->length; $i++) {
//             $record = $records->item($i); // i-esimo corso

//             $idElement = $record->firstChild;   // Id
//             $id = $idElement->textContent;
//             if($id == $num) {
//                 $nomeCorsoElement = $idElement->nextSibling;    // Nome corso
//                 $nomeCorso = $nomeCorsoElement->textContent;
//             }
//         }
//     }

//     return $nomeCorso;
// }


// function getColoreCorso($num) {
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     if($records->length > 0) { /* C'è almeno un corso */
//         for ($i=0; $i<$records->length; $i++) {
//             $record = $records->item($i); // i-esimo corso

//             $idElement = $record->firstChild;   // Id
//             $id = $idElement->textContent;
//             if($id == $num) {
//                 $nomeCorsoElement = $idElement->nextSibling;
//                 $descrizioneElement = $nomeCorsoElement->nextSibling;
//                 $infoProfElement = $descrizioneElement->nextSibling;

//                 $coloreCorsoElement = $infoProfElement->nextSibling;
//                 $coloreCorso = $coloreCorsoElement->textContent;
//             }
//         }
//     }
//     else $coloreCorso = "white";

//     return $coloreCorso;
// }


// function cercaCorso($nomeCorsoDaCercare) {
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     if($records->length > 0) {
//         for ($i=0; $i<$records->length; $i++) {
//             $record = $records->item($i);

//             $idElement = $record->firstChild;
//             $id = $idElement->textContent;
//             $nomeElement = $idElement->nextSibling;
//             $nome = $nomeElement->textContent;

//             if($nome == $nomeCorsoDaCercare) {
//                 return $id;
//             }
//         }
//     }

//     return 0;
// }


// function calcolaIdCorso() {
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $listaId = [];
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }

//     $id=1;
//     while(in_array($id,$listaId)){
//         $id++;
//     }

//     return $id;
// }


// function calcolaIdCorsoDiLaurea() {
//     $xmlString = "";
//     foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $listaId = [];
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }

//     $id=1;
//     while(in_array($id,$listaId)){
//         $id++;
//     }

//     return $id;
// }


// function calcolaIdAppello() {
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $listaId = [];
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }

//     $id=1;
//     while(in_array($id,$listaId)){
//         $id++;
//     }

//     return $id;
// }


// function calcolaIdPrenotazione() {
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     $listaId = [];
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $listaId[] = $con->textContent;
//     }

//     $id=1;
//     while(in_array($id,$listaId)){
//         $id++;
//     }

//     return $id;
// }


// function getCorsiDiLaurea() {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaCorsiDiLaurea = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $corsoDiLaurea = new corsoDiLaurea("");
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $corsoDiLaurea->id = $con->textContent;
//         $con = $con->nextSibling;
//         $corsoDiLaurea->nome = $con->textContent;
             
//         $listaCorsiDiLaurea[] = $corsoDiLaurea;
//     }
//     return $listaCorsiDiLaurea;
// }


// function getCorsiDiLaureaLike($_nome) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaCorsiDiLaurea = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $corsoDiLaurea = new corsoDiLaurea("");
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $corsoDiLaurea->id = $con->textContent;
//         $con = $con->nextSibling;
//         $corsoDiLaurea->nome = $con->textContent;
             
//         /*controllo sul nome*/
//         if(preg_match("#^{$_nome}#i", $corsoDiLaurea->nome))
//             $listaCorsiDiLaurea[] = $corsoDiLaurea;
//     }
//     return $listaCorsiDiLaurea;
// }


// function getCorsoDiLaureaFromId($idCorsoDiLaurea) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     for ($i=0; $i<$records->length; $i++) {
//         $corsoDiLaurea = new corsoDiLaurea("");
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $corsoDiLaurea->id = $con->textContent;
//         $con = $con->nextSibling;
//         $corsoDiLaurea->nome = $con->textContent;
//         if($corsoDiLaurea->id == $_id)
//             return $corsoDiLaurea;
//     }
//     return NULL;
// }


// function getNomeCorsoDiLaureaByID($_id) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     for ($i=0; $i<$records->length; $i++) {
//         $corsoDiLaurea = new corsoDiLaurea("");
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $corsoDiLaurea->id = $con->textContent;
//         $con = $con->nextSibling;
//         $corsoDiLaurea->nome = $con->textContent;
//         if($corsoDiLaurea->id == $_id)
//             return $corsoDiLaurea->nome;
//     }
//     return NULL;
// }


// function getDocenti() {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaDocenti = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $docente = new docente("", "", "", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $docente->matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->cognome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->password = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->idCorso = $con->textContent;
             
//         $listaDocenti[] = $docente;
//     }
//     return $listaDocenti;
// }


// function getDocenteFromMatricola($matr) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     for ($i=0; $i<$records->length; $i++) {
//         $docente = new docente("", "", "", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $docente->matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->cognome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->password = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->idCorso = $con->textContent;
             
//         if($docente->matricola == $matr) return $docente;
//     }
//     return NULL;
// }


// function getDocentiLike($_nome) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaDocenti = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $docente = new docente("", "", "", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $docente->matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->cognome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->password = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->idCorso = $con->textContent;
        
//         /*controllo sul nome*/
//         if(preg_match("#^{$_nome}#i", ($docente->cognome." ".$docente->nome)))
//             $listaDocenti[] = $docente;
//     }
//     return $listaDocenti;  
// }


// function getDocentiDisponibili() {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaDocenti = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $docente = new docente("", "", "", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $docente->matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->cognome = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->password = $con->textContent;
//         $con = $con->nextSibling;
//         $docente->idCorso = $con->textContent;

//         if($docente->idCorso == 0) 
//             $listaDocenti[] = $docente;
//     }
//     return $listaDocenti;
// }


// function getStudenti() {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/studenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaStudenti = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $studente = new studente("", "", "", "");  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $studente->matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->cognome = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->password = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->dataNascita = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->reputazioneTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->cfuTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->media = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->idCorsoLaurea = $con->textContent;
             
//         $listaStudenti[] = $studente;
//     }
//     return $listaStudenti;
// }


// function getStudenteFromMatricola($matr) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/studenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     for ($i=0; $i<$records->length; $i++) {
//         $studente = new studente("", "", "", "");  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $studente->matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->nome = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->cognome = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->password = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->dataNascita = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->reputazioneTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->cfuTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->media = $con->textContent;
//         $con = $con->nextSibling;
//         $studente->idCorsoLaurea = $con->textContent;
             
//         if($studente->matricola == $matr) return $studente;
//     }
//     return NULL;
// }


// function getSegretari() {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/segreteria.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaSegretari = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $segretario = new segretario("", "");  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $segretario->username = $con->textContent;
//         $con = $con->nextSibling;
//         $segretario->password = $con->textContent;
             
//         $listaSegretari[] = $segretario;
//     }
//     return $listaSegretari;
// }


// function getSegretariLike($uname) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/segreteria.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaSegretari = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $segretario = new segretario("", "");  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $segretario->username = $con->textContent;
//         $con = $con->nextSibling;
//         $segretario->password = $con->textContent;
             
//         if(preg_match("#^{$uname}#i", $segretario->username))
//             $listaSegretari[] = $segretario;
//     }
//     return $listaSegretari;
// }


// function getSegretarioFromUsername($uname) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/segreteria.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

     
//     for ($i=0; $i<$records->length; $i++) {
//         $segretario = new segretario("", "");  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $segretario->username = $con->textContent;
//         $con = $con->nextSibling;
//         $segretario->password = $con->textContent;
             
//         if($segretario->username == $uname)
//             return $segretario;
//     }
//     return NULL;
// }


// function getAdminFromUsername($uname) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/amministrazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

     
//     for ($i=0; $i<$records->length; $i++) {
//         $admin = new amministratore("", "");  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $admin->username = $con->textContent;
//         $con = $con->nextSibling;
//         $admin->password = $con->textContent;
             
//         if($admin->username == $uname)
//             return $admin;
//     }
//     return NULL;
// }


// function getAppelli() {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaAppelli = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $appello = new appello("", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $appello->id = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->dataOra = $con->textContent;
             
//         $listaAppelli[] = $appello;
//     }
//     return $listaAppelli;
// }


// function getAppelliFromCorsoDiLaurea($idCorsoLaurea) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaAppelli = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $appello = new appello("", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $appello->id = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->dataOra = $con->textContent;

//         $corso = getCorsoById($appello->idCorso);

//         if($corso->idCorsoLaurea == $idCorsoLaurea)
//             $listaAppelli[] = $appello;
//     }
//     return $listaAppelli;
// }


// function getAppelliFromCorso($idCorso) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
    
//     $listaAppelli = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $appello = new appello("", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $appello->id = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->dataOra = $con->textContent;

//         if($appello->idCorso == $idCorso)
//             $listaAppelli[] = $appello;
//     }
//     return $listaAppelli;
// }


// function getAppelloFromId($idAppello) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
    
     
//     for ($i=0; $i<$records->length; $i++) {
//         $appello = new appello("", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $appello->id = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->dataOra = $con->textContent;

//         if($appello->id == $idAppello)
//             return $appello;
//     }
//     return NULL;
// }


// function getEsamiSostenuti($studente) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaEsami = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $esame = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $esame->id = $con->textContent;
//         $con = $con->nextSibling;
//         $esame->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $esame->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $esame->esito = $con->textContent;

//         $appello = getAppelloFromId($esame->idAppello);
//         $corso = getCorsoById($appello->idCorso);

//         if($esame->matricolaStudente == $studente->matricola && $corso->idCorsoLaurea == $studente->idCorsoLaurea) 
//             if($esame->esito != "NULL")
//                 $listaEsami[] = $esame;
//     }
//     return $listaEsami;
// }


// function getEsamiSuperati($studente) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaEsamiSuperati = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $esame = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $esame->id = $con->textContent;
//         $con = $con->nextSibling;
//         $esame->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $esame->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $esame->esito = $con->textContent;

//         $appello = getAppelloFromId($esame->idAppello);
//         $corso = getCorsoById($appello->idCorso);

//         if($esame->matricolaStudente == $studente->matricola && $corso->idCorsoLaurea == $studente->idCorsoLaurea) 
//             if($esame->esito != "NULL" && $esame->esito != "R" && $esame->esito != "B")
//                 $listaEsamiSuperati[] = $corso->id;
//     }
//     return $listaEsamiSuperati;
// }


// function getAppelliPrenotati($studente) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaPrenotazioni = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $prenotazione = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $prenotazione->id = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->esito = $con->textContent;

//         $appello = getAppelloFromId($prenotazione->idAppello);
//         $corso = getCorsoById($appello->idCorso);

//         if($prenotazione->matricolaStudente == $studente->matricola && $corso->idCorsoLaurea == $studente->idCorsoLaurea) 
//             if($prenotazione->esito == "NULL")
//                 $listaPrenotazioni[] = $appello;
//     }
//     return $listaPrenotazioni;
// }


// function getAppelliPrenotabili($studente) {
//     $appelli = [];
//     $appelli = getAppelliFromCorsoDiLaurea($studente->idCorsoLaurea);
//     if(!$appelli)
//         return NULL;

    
//     $appelliPrenotati = [];
//     $appelliPrenotati = getAppelliPrenotati($studente);

//     $esamiSuperati = [];
//     $esamiSuperati = getEsamiSuperati($studente);

//     $appelliPrenotabili = [];
//     foreach($appelli as $appello) {
//         $dataAppello = getDataFromDataora($appello->dataOra);
//         $dataAppello = strtotime($dataAppello);
//         $dataAppello = date('Y-m-d', $dataAppello);

//         if($dataAppello > date('Y-m-d') && !in_array($appello, $appelliPrenotati) && !in_array($appello->idCorso, $esamiSuperati))
//             $appelliPrenotabili[] = $appello;
//     }

//     return $appelliPrenotabili;
// }


// function getAppelliAfterDate($data) {
//     $dataRif = strtotime($data);
//     $dataRif = date('Y-m-d', $dataRif);

//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaAppelli = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $appello = new appello("", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $appello->id = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->dataOra = $con->textContent;

//         $dataAppello = getDataFromDataora($appello->dataOra);
//         $dataAppello = strtotime($dataAppello);
//         $dataAppello = date('Y-m-d', $dataAppello);

//         if($dataAppello >= $dataRif)
//             $listaAppelli[] = $appello;
//     }
//     return $listaAppelli;
// }


// function getAppelliAfterDateFromCorso($data, $idCorso) {
//     $dataRif = strtotime($data);
//     $dataRif = date('Y-m-d', $dataRif);

//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaAppelli = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $appello = new appello("", 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $appello->id = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $appello->dataOra = $con->textContent;

//         $dataAppello = getDataFromDataora($appello->dataOra);
//         $dataAppello = strtotime($dataAppello);
//         $dataAppello = date('Y-m-d', $dataAppello);

//         if($dataAppello >= $dataRif && $appello->idCorso == $idCorso)
//             $listaAppelli[] = $appello;
//     }
//     return $listaAppelli;
// }


// function getDataFromDataora($dataora) {
//     return substr($dataora, 0, 10);
// }


// function getOraFromDataora($dataora) {
//     return substr($dataora, 11, 5);
// }


// function getPrenotazioniStudente($studente) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaPrenotazioni = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $prenotazione = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $prenotazione->id = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->esito = $con->textContent;

//         $appello = getAppelloFromId($prenotazione->idAppello);
//         $corso = getCorsoById($appello->idCorso);

//         if($prenotazione->matricolaStudente == $studente->matricola && $corso->idCorsoLaurea == $studente->idCorsoLaurea) 
//             if($prenotazione->esito == "NULL")
//                 $listaPrenotazioni[] = $prenotazione;
//     }
//     return $listaPrenotazioni;
// }


// function getPrenotazioniFromAppello($idAppello) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaPrenotazioni = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $prenotazione = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $prenotazione->id = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->esito = $con->textContent;

//         if($prenotazione->idAppello == $idAppello && $prenotazione->esito == "NULL")
//             $listaPrenotazioni[] = $prenotazione;
//     }
//     return $listaPrenotazioni;
// }


// function getFullPrenotazioni() {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaPrenotazioni = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $prenotazione = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $prenotazione->id = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->esito = $con->textContent;

//         $listaPrenotazioni[] = $prenotazione;
//     }
//     return $listaPrenotazioni;
// }


// function getPrenotazioneFromId($idPrenotazione) {
//     if($idPrenotazione == 0)
//         return NULL;

//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     for ($i=0; $i<$records->length; $i++) {
//         $prenotazione = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $prenotazione->id = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->esito = $con->textContent;

//         if($prenotazione->id == $idPrenotazione)
//             return $prenotazione;
//     }
//     return NULL;
// }


// function getVerbalizzazioniPositive($studente) {
//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaPrenotazioni = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $prenotazione = new prenotazione(0, 0);  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $prenotazione->id = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->idAppello = $con->textContent;
//         $con = $con->nextSibling;
//         $prenotazione->esito = $con->textContent;

//         if($prenotazione->matricolaStudente == $studente->matricola && $prenotazione->esito != "NULL" && $prenotazione->esito != "R" && $prenotazione->esito != "B")
//             $listaPrenotazioni[] = $prenotazione;
//     }
//     return $listaPrenotazioni;
// }


// function getFaqComplete($idCorso){
//     $xmlString = "";
//     foreach ( file("../Xml/faqs.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaFaq = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $faq = new faq();  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $faq->id = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->domanda = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->risposta = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->utilitaTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->idAutore = $con->textContent;

//         if($faq->idCorso == $idCorso && $faq->risposta != "")
//             $listaFaq [] = $faq;
//     }
//     return $listaFaq;
// }

// function getFaqIncomplete($idCorso){
//     $xmlString = "";
//     foreach ( file("../Xml/faqs.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
     
//     $listaFaq = [];
     
//     for ($i=0; $i<$records->length; $i++) {
//         $faq = new faq();  # Default constructor
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $faq->id = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->domanda = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->risposta = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->utilitaTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $faq->idAutore = $con->textContent;
//         if($faq->idCorso == $idCorso && $faq->risposta == "")
//             $listaFaq [] = $faq;
//     }
//     return $listaFaq;
// }

// function getVotoFaq($idStudente,$idFaq){
//     $xmlString = "";
//     foreach ( file("../Xml/votoFAQ.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
       
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $id = $con->textContent;
//         $con = $con->nextSibling;
//         $matricola = $con->textContent;
//         $con = $con->nextSibling;
//         $idFAQ = $con->textContent;
//         $con = $con->nextSibling;
//         $utilita = $con->textContent;

//         if($idFAQ == $idFaq && $matricola == $idStudente)
//             return $utilita;
//     }

//     return 0;//voto non dato
// }

// function getListaPost($_idCorso){
//     $xmlString = "";
//     foreach ( file("../Xml/posts.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
//     $postList = [];
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);    
//         $post = new post();

//         $con = $record->firstChild;
//         $post->id = $con->textContent;
//         $con = $con->nextSibling;
//         $post->titolo = $con->textContent;
//         $con = $con->nextSibling;
//         $post->corpo = $con->textContent;
//         $con = $con->nextSibling;
//         $post->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $post->utilitaTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $post->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $post->data = $con->textContent;
//         $post->replies = getPostReplies($post->id);

//         if($_idCorso == $post->idCorso)
//             $postList[] = $post;
//     }
//     return $postList;//voto non dato
// }

// function getPostReplies($idPost) {
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
//     $replies = 0;
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);    

//         $con = $record->firstChild;
//         $tmp = $con->textContent; #id
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #corpo
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #matricola studente
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #accordoMedio
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #idPost
//         if($tmp == $idPost)
//             $replies++;
//     return $replies;
//     }
// }

// function getPostComments($idPost) {
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
//     $listaCommenti = [];
//     for ($i=0; $i<$records->length; $i++) {
//         $commento = new comment();
//         $record = $records->item($i);    

//         $con = $record->firstChild;
//         $commento->id = $con->textContent; #id
//         $con = $con->nextSibling;
//         $commento->corpo = $con->textContent; #corpo
//         $con = $con->nextSibling;
//         $commento->matricolaStudente = $con->textContent; #matricola studente
//         $con = $con->nextSibling;
//         $commento->accordoMedio = $con->textContent; #accordoMedio
//         $con = $con->nextSibling;
//         $commento->idPost = $con->textContent; #idPost
//         $con = $con->nextSibling;
//         $commento->data = $con->textContent; #data
//         if($commento->idPost == $idPost)
//             $listaCommenti[] = $commento;
//     }

//     return $listaCommenti;//voto non dato
// }

// function getPostFromId($_idPost){
//     $xmlString = "";
//     foreach ( file("../Xml/posts.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);    
//         $post = new post();

//         $con = $record->firstChild;
//         $post->id = $con->textContent;
//         $con = $con->nextSibling;
//         $post->titolo = $con->textContent;
//         $con = $con->nextSibling;
//         $post->corpo = $con->textContent;
//         $con = $con->nextSibling;
//         $post->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $post->utilitaTotale = $con->textContent;
//         $con = $con->nextSibling;
//         $post->idCorso = $con->textContent;
//         $con = $con->nextSibling;
//         $post->data = $con->textContent;
//         $post->replies = getPostReplies($post->id);

//         if($_idPost == $post->id)
//             return $post;
//     }
//     return null;//voto non dato
// }

// function getVotoCommento($idCommento,$matricola) {
//     $xmlString = "";
//     foreach ( file("../Xml/votoCommento.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);    
//         $vote = new commentVote();

//         $con = $record->firstChild;
//         $vote->id = $con->textContent;
//         $con = $con->nextSibling;
//         $vote->matricolaStudente = $con->textContent;
//         $con = $con->nextSibling;
//         $vote->idCommento = $con->textContent;
//         $con = $con->nextSibling;
//         $vote->accordo = $con->textContent;
//         $con = $con->nextSibling;
//         $vote->idAutoreCommento = $con->textContent;
    
//         if($vote->matricolaStudente == $matricola && $vote->idCommento == $idCommento)
//             return $vote;
//     }
//     return null;//voto non dato
// }





// /* ================================= 
// ======== Insert functions ==========
// ==================================== */

// function inserisciCorso($nuovoCorso) {
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     if(verificaPresenzaCorso($nuovoCorso)) {
//         setcookie('corso', "ERRORE: Il corso \"{$nuovoCorso->nome}\" esiste già!");
//         return FALSE;
//     }

//     $xml = simplexml_load_file('../Xml/corsi.xml');

//     // Crea una tupla <corso> </corso>
//     $newcorso = $xml->addChild('corso');
//     $asd = $newcorso->addChild('id', $nuovoCorso->id);
//     $asd = $newcorso->addChild('nome', $nuovoCorso->nome);
//     $asd = $newcorso->addChild('descrizione', $nuovoCorso->descrizione);
//     $asd = $newcorso->addChild('matricolaProf', $nuovoCorso->matricola_prof);
//     $asd = $newcorso->addChild('colore', 'lightblue');
//     $asd = $newcorso->addChild('anno', $nuovoCorso->anno);
//     $asd = $newcorso->addChild('semestre', $nuovoCorso->semestre);
//     $asd = $newcorso->addChild('curriculum', $nuovoCorso->curriculum);
//     $asd = $newcorso->addChild('cfu', $nuovoCorso->cfu);
//     $asd = $newcorso->addChild('ssd', $nuovoCorso->ssd);
//     $asd = $newcorso->addChild('idCorsoLaurea', $nuovoCorso->idCorsoLaurea);

//     //sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/corsi.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function inserisciStudente($studente) {
//     $xmlString = "";
//     foreach ( file("../Xml/studenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/studenti.xml');

//     // Crea una tupla <studente> </studente>

//     $newStudente = $xml->addChild('studente');
//     $tmp = $newStudente->addChild('matricola', $studente->matricola);
//     $tmp = $newStudente->addChild('nome', $studente->nome);
//     $tmp = $newStudente->addChild('cognome', $studente->cognome);
//     $tmp = $newStudente->addChild('password', $studente->password);
//     $tmp = $newStudente->addChild('dataNascita', $studente->dataNascita);
//     $tmp = $newStudente->addChild('reputazioneTotale', $studente->reputazioneTotale);
//     $tmp = $newStudente->addChild('cfuTotale', $studente->cfuTotale);
//     $tmp = $newStudente->addChild('media', $studente->media);
//     $tmp = $newStudente->addChild('idCorsoDiLaurea', $studente->idCorsoLaurea);


//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/studenti.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function inserisciDocente($docente) {
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/docenti.xml');

//     // Crea una tupla <docente> </docente>

//     $newDocente = $xml->addChild('docente');
//     $tmp = $newDocente->addChild('matricola', $docente->matricola);
//     $tmp = $newDocente->addChild('nome', $docente->nome);
//     $tmp = $newDocente->addChild('cognome', $docente->cognome);
//     $tmp = $newDocente->addChild('password', $docente->password);
//     $tmp = $newDocente->addChild('idCorso', $docente->idCorso);


//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/docenti.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }

// function inserisciSegretario($segretario) {
//     $xmlString = "";
//     foreach ( file("../Xml/segreteria.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $username = $con->textContent;

//         if($username == $segretario->username) 
//             return false;   /* Lo username non può essere duplicato! */
//     }


//     $xml = simplexml_load_file('../Xml/segreteria.xml');

//     // Crea una tupla <segretario> </segretario>

//     $newSegretario = $xml->addChild('segretario');
//     $tmp = $newSegretario->addChild('username', $segretario->username);
//     $tmp = $newSegretario->addChild('password', $segretario->password);

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/segreteria.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function inserisciAmministratore($amministratore) {
//     $xmlString = "";
//     foreach ( file("../Xml/amministrazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
        
//         $con = $record->firstChild;
//         $username = $con->textContent;

//         if($username == $amministratore->username) 
//             return false;   /* Lo username non può essere duplicato! */
//     }


//     $xml = simplexml_load_file('../Xml/amministrazione.xml');

//     // Crea una tupla <amministratore> </amministratore>

//     $newAmministratore = $xml->addChild('amministratore');
//     $tmp = $newAmministratore->addChild('username', $amministratore->username);
//     $tmp = $newAmministratore->addChild('password', $amministratore->password);

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/amministrazione.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function inserisciCorsoDiLaurea($corsoDiLaurea) {
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     if(verificaPresenzaCorsoDiLaurea($corsoDiLaurea->nome))  {
//         setcookie('cdl', "ERRORE: Il corso di laurea \"{$corsoDiLaurea->nome}\" esiste già!");
//         return FALSE;
//     }

//     $xml = simplexml_load_file('../Xml/corsiDiLaurea.xml');

//     // Crea una tupla <corsoDiLaurea> </corsoDiLaurea>
//     $newcorsoDiLaurea = $xml->addChild('corsoDiLaurea'); 
//     $tmp = $newcorsoDiLaurea->addChild('id', $corsoDiLaurea->id);
//     $tmp = $newcorsoDiLaurea->addChild('nome', $corsoDiLaurea->nome);
    
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/corsiDiLaurea.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function inserisciAppello($appello) {
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     $corso = getCorsoById($appello->idCorso);
//     $data = getDataFromDataora($appello->dataOra);

//     if(verificaPresenzaAppello($appello))  {
//         setcookie('appello', "ERRORE: Esiste già un appello di {$corso->nome} nel giorno {$data}!");
//         return FALSE;
//     }

//     $xml = simplexml_load_file('../Xml/appelli.xml');

//     // Crea una tupla <appello> </appello>
//     $newAppello = $xml->addChild('appello'); 
//     $tmp = $newAppello->addChild('id', $appello->id);
//     $tmp = $newAppello->addChild('idCorso', $appello->idCorso);
//     $tmp = $newAppello->addChild('dataOra', $appello->dataOra);
    
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/appelli.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function inserisciPrenotazioneAppello($matricolaStudente, $idAppello) {
//     if($matricolaStudente == 0 || $idAppello == 0)
//         return FALSE;
    
//     $prenotazione = new prenotazione($matricolaStudente, $idAppello);
    
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/prenotazione.xml');

//     // Crea una tupla <prenotazione> </prenotazione>
//     $newPrenotazione = $xml->addChild('prenotazione'); 
//     $tmp = $newPrenotazione->addChild('id', $prenotazione->id);
//     $tmp = $newPrenotazione->addChild('matricolaStudente', $prenotazione->matricolaStudente);
//     $tmp = $newPrenotazione->addChild('idAppello', $prenotazione->idAppello);
//     $tmp = $newPrenotazione->addChild('esito', $prenotazione->esito);
    
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/prenotazione.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function insertFaq($idCorso,$domanda,$idAutore) {
//     $xmlString = "";
//     foreach ( file("../Xml/faqs.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/faqs.xml');

//     // Crea una tupla <studente> </studente>

//     $newStudente = $xml->addChild('faq');
//     $tmp = $newStudente->addChild('id', nextFaqid());
//     $tmp = $newStudente->addChild('domanda', $domanda);
//     $tmp = $newStudente->addChild('risposta', "");
//     $tmp = $newStudente->addChild('utilitaTotale', 0);
//     $tmp = $newStudente->addChild('idCorso', $idCorso);
//     $tmp = $newStudente->addChild('idAutore', $idAutore);

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/faqs.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }

// function insertFaqVote($faqVote) {
//     $xmlString = "";
//     foreach ( file("../Xml/votoFAQ.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/votoFAQ.xml');

//     // Crea una tupla <studente> </studente>

//     $newStudente = $xml->addChild('votoFAQ');
//     $tmp = $newStudente->addChild('id', $faqVote->id);
//     $tmp = $newStudente->addChild('matricolaStudente', $faqVote->matricolaStudente);
//     $tmp = $newStudente->addChild('idFAQ', $faqVote->idFAQ);
//     $tmp = $newStudente->addChild('utilita', $faqVote->utilita);

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/votoFAQ.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);

//     updateFaqUtility($faqVote->idFAQ);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }

// function inserisciPost($titolo,$corpo,$idAutore,$idCorso,$data) {
//     $xmlString = "";
//     foreach ( file("../Xml/posts.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/posts.xml');


//     $newStudente = $xml->addChild('post');
//     $tmp = $newStudente->addChild('id', nextPostId());
//     $tmp = $newStudente->addChild('titolo', $titolo);
//     $tmp = $newStudente->addChild('corpo', $corpo);
//     $tmp = $newStudente->addChild('matricolaStudente', $idAutore);
//     $tmp = $newStudente->addChild('utilitaTotale', 0);
//     $tmp = $newStudente->addChild('idCorso', $idCorso);
//     $tmp = $newStudente->addChild('data', $data);
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/posts.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }

// function insertCommentVote($idCommento, $matricola, $vote,$idAutore) {
//     $xmlString = "";
//     foreach ( file("../Xml/votoCommento.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/votoCommento.xml');


//     $newStudente = $xml->addChild('votoCommento');
//     $tmp = $newStudente->addChild('id', nextCommentVoteId());
//     $tmp = $newStudente->addChild('matricolaStudente', $matricola);
//     $tmp = $newStudente->addChild('idCommento', $idCommento);
//     $tmp = $newStudente->addChild('accordo', $vote);
//     $tmp = $newStudente->addChild('idAutoreCommento', $idAutore);
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/votoCommento.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);
//     updateCommentAccordo($idCommento);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }

// function inserisciCommento($corpo,$idAutore,$idPost,$data) {
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $xml = simplexml_load_file('../Xml/commenti.xml');


//     $newStudente = $xml->addChild('commento');
//     $tmp = $newStudente->addChild('id', nextCommentId());
//     $tmp = $newStudente->addChild('corpo', $corpo);
//     $tmp = $newStudente->addChild('matricolaStudente', $idAutore);
//     $tmp = $newStudente->addChild('accordoMedio', 0);
//     $tmp = $newStudente->addChild('idPost', $idPost);
//     $tmp = $newStudente->addChild('data', $data);
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/commenti.xml', "w");
//     $result = fwrite($f,  $xml->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }





// /* ================================= 
// ======== Delete functions ==========
// ==================================== */

// function eliminaAppello($idAppello) {
//     if($idAppello == 0)
//         return FALSE;
    

//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $nodeToRemove = null;
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("appello");

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $id = $con->textContent;

//         if($idAppello == $id) {
//             $nodeToRemove=$record;
//             break;
//         }
//     }

//     // Eliminazione
//     if ($nodeToRemove->parentNode->removeChild($nodeToRemove) == null) 
//         return FALSE;
    
//     echo $doc->save("../Xml/appelli.xml"); 
//     return TRUE;
// }


// function eliminaAppelliCorso($id_corso) {
//     if($id_corso == 0)
//         return FALSE;
    
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("appello");
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $_codice = $con->textContent;
//         $con = $con->nextSibling;
//         $con = $con->nextSibling;
//         $con = $con->nextSibling;
//         $idCorso= $con->textContent;

//         if($id_corso == $idCorso)
//             $record->parentNode->removeChild($record);
//     }

//     echo $doc->save("../Xml/appelli.xml"); 
//     return TRUE;
// }


// function eliminaCorso($_id) {
//     if($_id == 0)
//         return FALSE;
    
//     if(!eliminaAppelliCorso($_id))
//         return FALSE;

//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("corso");
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $id = $con->textContent;

//         if($id == $_id){
//             $record->parentNode->removeChild($record);
//             break;
//         }
            
//     }

//     echo $doc->save("../Xml/corsi.xml"); 
//     return true;
// }


// function eliminaPrenotazioneAppello($idPrenotazione) {
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("prenotazione");
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $id = $con->textContent;

//         if($id == $idPrenotazione){
//             $record->parentNode->removeChild($record);
//             break;
//         }
            
//     }

//     echo $doc->save("../Xml/prenotazione.xml"); 
//     return TRUE;
// }


// function deleteFaq($idFaq) {
//     $xmlString = "";
//     foreach ( file("../Xml/faqs.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("faq");

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $id = $con->textContent;

//         if($id == $idFaq){
//             $record->parentNode->removeChild($record);
//             break;
//         }
            
//     }

//     echo $doc->save("../Xml/faqs.xml"); 
//     #rimuoviamo tutti i voti associati alla FAQ
//     $xmlString = "";
//     foreach ( file("../Xml/votoFAQ.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("faq");

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $tmp = $con->textContent;
//         $con = $record->firstChild;
//         $tmp = $con->textContent;
//         $con = $record->firstChild;
//         $tmp = $con->textContent;
//         if($id == $idFaq)
//             $record->parentNode->removeChild($record);      
//     }
// }

// function deletePost($idPost) {
//     $xmlString = "";
//     foreach ( file("../Xml/posts.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("post");

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $id = $con->textContent;

//         if($id == $idPost){
//             $record->parentNode->removeChild($record);
//             break;
//         }
            
//     }

//     $doc->save("../Xml/posts.xml"); 
//     #rimuoviamo tutti i commenti associati al post
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("commento");
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $id = $con->textContent; #id
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #corpo
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #matricolaStudente
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #accordoMedio
//         $con = $con->nextSibling;
//         $idP = $con->textContent; #idPost
//         if($idP == $idPost)
//             $record->parentNode->removeChild($record);         
//     }
//     echo $doc->save("../Xml/commenti.xml"); 
//     return true;
// }


// function deleteFaqVote($matricola,$idFaq){
//     $xmlString = "";
//     foreach ( file("../Xml/votoFAQ.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("votoFAQ");

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $tmp = $con->textContent; #id
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #matricolaStudente
//         if($tmp != $matricola) continue;
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #idFAQ
//         if($tmp != $idFaq) continue;
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #utilitaTotale

//         $record->parentNode->removeChild($record);
//         break;         
//     }
//     echo $doc->save("../Xml/votoFAQ.xml"); 
//     updateFaqUtility($idFaq);
//     return true;
// }

// function deleteCommentVote($idCommento, $matricola) {
//     $xmlString = "";
//     foreach ( file("../Xml/votoCommento.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("votoCommento");

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $tmp = $con->textContent; #id
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #matricolaStudente
//         if($tmp != $matricola) continue;
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #idCommento
//         if($tmp != $idCommento) continue;

//         $record->parentNode->removeChild($record);
//         break;         
//     }
//     echo $doc->save("../Xml/votoCommento.xml"); 
//     updateCommentAccordo($idCommento);
//     return true;
// }

// function deleteComment($idCommento) {
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("commento");

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $tmp = $con->textContent; #id
//         if($tmp != $idCommento) continue;

//         $record->parentNode->removeChild($record);
//         break;         
//     }
//     echo $doc->save("../Xml/commenti.xml"); 
//     return true;
// }


// function eliminaCorsoDiLaurea($idCorsoDiLaurea) {
//     $xmlString = "";
//     foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->getElementsByTagName("corsoDiLaurea");
//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);

//         $con = $record->firstChild;
//         $id = $con->textContent;

//         if($id == $idCorsoDiLaurea){
//             $record->parentNode->removeChild($record);
//             break;
//         }            
//     }

//     echo $doc->save("../Xml/corsiDiLaurea.xml"); 
//     return TRUE;
// }





// /* ================================= 
// ======== Modify functions ==========
// ==================================== */

// function assegnaCorso($corso, $matricola_prof) {
//     $xmlString = "";
//     foreach ( file("../Xml/docenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $docenti = simplexml_load_file('../Xml/docenti.xml');

//     foreach($docenti as $docente)
//         if($docente->matricola == $matricola_prof)
//             $docente->idCorso = $corso->id;

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/docenti.xml', "w");
//     $result = fwrite($f,  $docenti->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function modificaEsitoPrenotazione($idPrenotazione, $nuovoEsito) {
//     if($idPrenotazione == 0)
//         return FALSE;

//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/prenotazione.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $prenotazioni = simplexml_load_file('../Xml/prenotazione.xml');

//     foreach($prenotazioni as $prenotazione) {
//         if($prenotazione->id == $idPrenotazione)
//             $prenotazione->esito = $nuovoEsito;
//     }

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/prenotazione.xml', "w");
//     $result = fwrite($f,  $prenotazioni->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else{
//         $prenotazione = getPrenotazioneFromId($idPrenotazione);
//         $studente = getStudenteFromMatricola($prenotazione->matricolaStudente);
//         if(calcolaMedia_CFU($studente))
//             return TRUE;
//     }
// }


// function calcolaMedia_CFU($studente) {
//     if(!$studente)
//         return FALSE;
    
//     $esamiSuperati = getVerbalizzazioniPositive($studente);

//     $numeroEsamiSuperati = sizeof($esamiSuperati);
//     $cfuTot = 0;
//     $sommaVoti = 0;
//     $media = 0.0;

//     // Calcolo dei cfu e della media

//     foreach($esamiSuperati as $esameSuperato) {
//         $appello = getAppelloFromId($esameSuperato->idAppello);
//         $corso = getCorsoById($appello->idCorso);
        
//         $cfuTot += $corso->cfu;
//         $sommaVoti += intval($esameSuperato->esito);
//     }

//     $media = $sommaVoti/$numeroEsamiSuperati;


//     // Modifica dei dati dello studente


//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/studenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $studenti = simplexml_load_file('../Xml/studenti.xml');

//     foreach($studenti as $stud) {
//         if($stud->matricola == $studente->matricola) {
//             $stud->cfuTotale = $cfuTot;
//             $stud->media = $media;
//             break;
//         }
//     }

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/studenti.xml', "w");
//     $result = fwrite($f,  $studenti->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function modificaAppello($idAppello, $nuovaData, $nuovaOra, $nuovoCorso) {
//     if($idAppello == 0)
//         return FALSE;

//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/appelli.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $appelli = simplexml_load_file('../Xml/appelli.xml');

//     foreach($appelli as $appello) {
//         if($appello->id == $idAppello) {
//             $appello->dataOra = $nuovaData." ".$nuovaOra;
//             $appello->idCorso = $nuovoCorso;
//         }
//     }

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/appelli.xml', "w");
//     $result = fwrite($f,  $appelli->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else{
//         return TRUE;
//     }
// }


// function modificaFaq($id, $newText) {
//     $xmlString = "";
//     foreach ( file("../Xml/faqs.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $faqs = simplexml_load_file('../Xml/faqs.xml');

//     foreach($faqs as $faq)
//         if($faq->id == $id)
//             $faq->risposta = $newText;

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/faqs.xml', "w");
//     $result = fwrite($f,  $faqs->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function modifyFaqVote($matricola,$idFaq,$voto){
//     $xmlString = "";
//     foreach ( file("../Xml/votoFAQ.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
    
//     $voti = simplexml_load_file('../Xml/votoFAQ.xml');

//     foreach($voti as $voto){
//         if($voto->idFAQ == $idFaq && $voto->matricolaStudente == $matricola)
//             $voto->utilita = (string)$voto;
//     }
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/votoFAQ.xml', "w");
//     $result = fwrite($f,  $voti->asXML());
//     fclose($f);

//     updateFaqUtility($idFaq);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function updateFaqUtility($idFaq){
//     #aggiorniamo il campo utilitaTotale della faq passata
//     $xmlString = "";
//     foreach ( file("../Xml/votoFAQ.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
//     $utilitaTot = 0;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $tmp = $con->textContent;
//         $con = $con->nextSibling;
//         $tmp = $con->textContent;
//         $con = $con->nextSibling;
//         $tmp = $con->textContent;
//         if($tmp != $idFaq) continue;
//         $con = $con->nextSibling;
//         $utilita = $con->textContent;
//         $utilitaTot+=(int)$utilita;
//     }

//     #modifico la FAQ
//     $xmlString = "";
//     foreach ( file("../Xml/faqs.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $faqs = simplexml_load_file('../Xml/faqs.xml');

//     foreach($faqs as $faq){
//         if($faq->id == $idFaq)
//             $faq->utilitaTotale = $utilitaTot;
//     }
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/faqs.xml', "w");
//     $result = fwrite($f,  $faqs->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function modifyContentText($id, $newText) {
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $commenti = simplexml_load_file('../Xml/commenti.xml');

//     foreach($commenti as $comm)
//         if($comm->id == $id)
//             $comm->corpo = $newText;

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/commenti.xml', "w");
//     $result = fwrite($f,  $commenti->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }

// function modifyPostContent($id, $newText) {
//     $xmlString = "";
//     foreach ( file("../Xml/posts.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $posts = simplexml_load_file('../Xml/posts.xml');

//     foreach($posts as $post)
//         if($post->id == $id)
//             $post->corpo = $newText;

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/posts.xml', "w");
//     $result = fwrite($f,  $posts->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }

// function updateCommentAccordo($idCommento){
//     $xmlString = "";
//     foreach ( file("../Xml/votoCommento.xml") as $node ) {
//         $xmlString .= trim($node);
//     }
         
//     // Creazione del documento
//     $doc = new DOMDocument();
//     $doc->loadXML($xmlString);
//     $records = $doc->documentElement->childNodes;
//     $accordoTot = 0;
//     $numVoti = 0;

//     for ($i=0; $i<$records->length; $i++) {
//         $record = $records->item($i);
             
//         $con = $record->firstChild;
//         $tmp = $con->textContent; #id
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #matricola studente
//         $con = $con->nextSibling;
//         $tmp = $con->textContent; #idCommento
//         if($tmp != $idCommento) continue;
//         $con = $con->nextSibling;
//         $accordo = $con->textContent; #accordo
//         $accordoTot+=(int)$accordo;
//         $numVoti++;
//     }

//     $media =  $numVoti > 0 ? $accordoTot/$numVoti : 0;
//     #modifico la FAQ
//     $xmlString = "";
//     foreach ( file("../Xml/commenti.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $commenti = simplexml_load_file('../Xml/commenti.xml');

//     foreach($commenti as $commento){
//         if($commento->id == $idCommento)
//             $commento->accordoMedio = bcdiv($media, 1, 2);
//     }
//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/commenti.xml', "w");
//     $result = fwrite($f,  $commenti->asXML());
//     fclose($f);

//     if(!$result) 
//         return FALSE;
//     else
//         return TRUE;
// }


// function modificaCorsoDiLaurea($idCorsoDiLaurea, $nome) {
//     if($idCorsoDiLaurea == 0)
//         return FALSE;

//     $modificato = FALSE;

//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $corsiDiLaurea = simplexml_load_file('../Xml/corsiDiLaurea.xml');

//     foreach($corsiDiLaurea as $corsoDiLaurea) {
//         if($corsoDiLaurea->id == $idCorsoDiLaurea && !verificaPresenzaCorsoDiLaurea($nome)) {
//             $corsoDiLaurea->nome = $nome;
//             $modificato = TRUE;
//             break;
//         }
//     }

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/corsiDiLaurea.xml', "w");
//     $result = fwrite($f,  $corsiDiLaurea->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     elseif($result && $modificato)
//         return TRUE;
// }


// function modificaCorso($idCorso, $nome, $descrizione, $matricolaProf, $anno, $semestre, $curriculum, $cfu, $ssd, $idCorsoLaurea) {
//     if($idCorso == 0)
//         return FALSE;

//     $modificato = FALSE;

//     /*accedo al file xml*/
//     $xmlString = "";
//     foreach ( file("../Xml/corsi.xml") as $node ) {
//         $xmlString .= trim($node);
//     }

//     $corsi = simplexml_load_file('../Xml/corsi.xml');

//     foreach($corsi as $corso) {
//         if($corso->id == $idCorso) {
//             $corso->nome = $nome;
//             $corso->descrizione = $descrizione;
//             $corso->matricolaProf = $matricolaProf;
//             $corso->anno = $anno;
//             $corso->semestre = $semestre;
//             $corso->curriculum = $curriculum;
//             $corso->cfu = $cfu;
//             $corso->ssd = $ssd;
//             $corso->idCorsoLaurea = $idCorsoLaurea;

//             $modificato = TRUE;
//             break;
//         }
//     }

//     // Sovrascrive il vecchio file con i nuovi dati
//     $f = fopen('../Xml/corsi.xml', "w");
//     $result = fwrite($f,  $corsi->asXML());
//     fclose($f);


//     if(!$result) 
//         return FALSE;
//     elseif($result && $modificato)
//         return TRUE;
// }
?>
