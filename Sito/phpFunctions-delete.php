<?php
require_once('phpFunctions-modify.php');
require_once('phpFunctions-get.php');


/* ================================= 
======== Delete functions ==========
==================================== */

function eliminaAppello($idAppello) {
    if($idAppello == 0)
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $appelli = simplexml_load_file('../Xml/appelli.xml');
    $eliminato = FALSE;

    foreach($appelli as $appello) {
        if($appello->id == $idAppello && $appello->stato == 1) {
            $appello->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/appelli.xml', "w");
    $result = fwrite($f,  $appelli->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}


function eliminaAppelliCorso($id_corso) {
    if($id_corso == 0)
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/appelli.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $appelli = simplexml_load_file('../Xml/appelli.xml');

    foreach($appelli as $appello)
        if($appello->idCorso == $id_corso && $appello->stato == 1)
            $appello->stato = 0;

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/appelli.xml', "w");
    $result = fwrite($f,  $appelli->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result)
        return TRUE;
}


function eliminaCorso($_id) {
    if($_id == 0)
        return FALSE;
    
    if(!eliminaAppelliCorso($_id))
        return FALSE;

    $xmlString = "";
    foreach ( file("../Xml/corsi.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $corsi = simplexml_load_file('../Xml/corsi.xml');
    $eliminato = FALSE;

    foreach($corsi as $corso) {
        if($corso->id == $_id && $corso->stato == 1) {
            $corso->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }


    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/corsi.xml', "w");
    $result = fwrite($f,  $corsi->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}


function eliminaPrenotazioneAppello($idPrenotazione) {
    if($idPrenotazione == 0)
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $prenotazioni = simplexml_load_file('../Xml/prenotazione.xml');
    $eliminato = FALSE;

    foreach($prenotazioni as $prenotazione) {
        if($prenotazione->id == $idPrenotazione && $prenotazione->stato == 1) {
            $prenotazione->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }


    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/prenotazione.xml', "w");
    $result = fwrite($f,  $prenotazioni->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}


function deleteFaq($idFaq) {
    if($idFaq == 0)
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/faqs.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $faqs = simplexml_load_file('../Xml/faqs.xml');
    $eliminato = FALSE;

    foreach($faqs as $faq) {
        if($faq->id == $idFaq && $faq->stato == 1) {
            $faq->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }


    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/faqs.xml', "w");
    $result = fwrite($f,  $faqs->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $eliminato) {
        # Rimuoviamo tutti i voti associati alla FAQ
        
        $xmlString = "";
        foreach ( file("../Xml/votoFAQ.xml") as $node ) {
            $xmlString .= trim($node);
        }

        $votiFAQ = simplexml_load_file('../Xml/votoFAQ.xml');

        foreach($votiFAQ as $voto)
            if($voto->idFAQ == $idFaq && $voto->stato == 1)
                $voto->stato = 0;
        
        // Sovrascrive il vecchio file con i nuovi dati
        $f = fopen('../Xml/votoFAQ.xml', "w");
        $result = fwrite($f,  $votiFAQ->asXML());
        fclose($f);

        if(!$result) 
            return FALSE;
    }

    return TRUE;
}


function deletePost($idPost) {
    # Rimuoviamo tutti i voti dei commenti associati al post
    
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $commenti = simplexml_load_file('../Xml/commenti.xml');

    foreach($commenti as $commento){
        if($commento->idPost == $idPost && $commento->stato == 1){
            print("napoli colera".$commento->id);
            deleteAllCommentVotes($commento->id);  
        } 
    }   

    //============================================================================
    //==========================Eliminazione Commenti=============================
    //============================================================================

    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $commenti = simplexml_load_file('../Xml/commenti.xml');

    foreach($commenti as $commento){
        if($commento->idPost == $idPost && $commento->stato == 1){
            $commento->stato = 0;
        }  
    }
    $f = fopen('../Xml/commenti.xml', "w");
    $result = fwrite($f,  $commenti->asXML());
    fclose($f);
    if(!$result) return FALSE;

    //============================================================================
    //==========================Eliminazione Voti Post============================
    //============================================================================

    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
    $xmlString .= trim($node);
    }

    $votiPost = simplexml_load_file('../Xml/votoPost.xml');

    foreach($votiPost as $voto)
        if($voto->idPost == $idPost && $voto->stato == 1)
            $voto->stato = 0;

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoPost.xml', "w");
    $result = fwrite($f,  $votiPost->asXML());
    fclose($f);
    if(!$result) return FALSE;

    //============================================================================
    //==========================Eliminazione Post================================
    //============================================================================
    $xmlString = "";
    foreach ( file("../Xml/posts.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $posts = simplexml_load_file('../Xml/posts.xml');

    foreach($posts as $post) {
        if($post->id == $idPost && $post->stato == 1) {
            $post->stato = 0;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/posts.xml', "w");
    $result = fwrite($f,  $posts->asXML());
    fclose($f);

    updateReputazione();
    if(!$result) 
        return FALSE;

    return TRUE;

}

function deleteAllCommentVotes($idCommento){
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $votiCommento = simplexml_load_file('../Xml/votoCommento.xml');
    foreach($votiCommento as $voto) {
        if((int)$voto->idCommento == (int)$idCommento && $voto->stato ==1) {
            $voto->stato = 0;
        }
    }
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoCommento.xml', "w");
    $result = fwrite($f,  $votiCommento->asXML());
    fclose($f);

    if(!$result) return FALSE;
    return true;
}

function deleteFaqVote($matricola, $idFaq) {
    if($matricola == 0 || $idFaq == 0)
        return FALSE;

    $xmlString = "";
    foreach ( file("../Xml/votoFAQ.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $votiFAQ = simplexml_load_file('../Xml/votoFAQ.xml');
    $eliminato = FALSE;

    foreach($votiFAQ as $voto) {
        if($voto->idFAQ == $idFaq && $voto->matricolaStudente == $matricola && $voto->stato == 1) {
            $voto->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }

    
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoFAQ.xml', "w");
    $result = fwrite($f,  $votiFAQ->asXML());
    fclose($f);

    $updateUtility = updateFaqUtility($idFaq);

    if(!$result) 
        return FALSE;
    elseif($result && $eliminato && $updateUtility)
        return TRUE;
}


function deleteCommentVote($idCommento, $matricola) {
    if($idCommento == 0 || $matricola == 0)
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/votoCommento.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $votiCommento = simplexml_load_file('../Xml/votoCommento.xml');
    $eliminato = FALSE;

    foreach($votiCommento as $voto) {
        if($voto->matricolaStudente == $matricola && $voto->idCommento == $idCommento && $voto->stato != 0) {
            $voto->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }


    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoCommento.xml', "w");
    $result = fwrite($f,  $votiCommento->asXML());
    fclose($f);

    $updateAccordo = updateCommentAccordo($idCommento);

    if(!$result) 
        return FALSE;
    elseif($result && $eliminato && $updateAccordo)
        return TRUE;
}


function deleteComment($idCommento) {
    if($idCommento == 0)
        return FALSE;

    deleteAllCommentVotes($idCommento);
    
    $xmlString = "";
    foreach ( file("../Xml/commenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $commenti = simplexml_load_file('../Xml/commenti.xml');
    $eliminato = FALSE;

    foreach($commenti as $commento) {
        if($commento->id == $idCommento && $commento->stato == 1) {
            $commento->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }
    
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/commenti.xml', "w");
    $result = fwrite($f,  $commenti->asXML());
    fclose($f);

    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}


function eliminaCorsoDiLaurea($idCorsoDiLaurea) {
    if($idCorsoDiLaurea == 0)
        return FALSE;
    #In caso di eliminazione del cors di laurea dobbiamo eliminare
    #Faq, Bacheche, Studenti, Corsi, Appelli

    #=================================
    #====Eliminazione Degi Studenti===
    #=================================
    $studenti = getStudenti();
    foreach($studenti as $studente){
        if($studente->idCorsoLaurea == $idCorsoDiLaurea)
            eliminaStudente($studente->matricola);
    }

    $corsi = getCorsiFromCorsoDiLaurea($idCorsoDiLaurea);
    foreach($corsi as $corso){  
        #eliminiamo post e faqs
        foreach(getListaPost($corso->id) as $post)
            deletePost($post->id);

        foreach(array_merge(getFaqComplete($corso->id),getFaqIncomplete($corso->id)) as $faq)
            deleteFaq($faq->id);

        eliminaCorso($corso->id); #Elimazione di corsi e appelli
    }
    #Eliminazione del corso di laurea 

    $xmlString = "";
    foreach ( file("../Xml/corsiDiLaurea.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $corsiDiLaurea = simplexml_load_file('../Xml/corsiDiLaurea.xml');
    $eliminato = FALSE;

    foreach($corsiDiLaurea as $corsoDiLaurea) {
        if($corsoDiLaurea->id == $idCorsoDiLaurea && $corsoDiLaurea->stato == 1) {
            $corsoDiLaurea->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }
    
    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/corsiDiLaurea.xml', "w");
    $result = fwrite($f,  $corsiDiLaurea->asXML());
    fclose($f);

    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}


function deletePostVote($matricola, $idPost) {
    if($idPost == 0 || $matricola == 0)
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/votoPost.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $votiPost = simplexml_load_file('../Xml/votoPost.xml');

    foreach($votiPost as $voto) {
        if($voto->matricolaStudente == $matricola && $voto->idPost == $idPost && $voto->stato != 0) {
            $voto->stato = 0;
            break;
        }
    }


    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/votoPost.xml', "w");
    $result = fwrite($f,  $votiPost->asXML());
    fclose($f);

    $updateAccordo = updatePostUtility($idPost);

    if(!$result) 
        return FALSE;
    elseif($result && $updateAccordo)
        return TRUE;
}


function eliminaPrenotazioniStudente($matricola) {  
    if($matricola == 0)
        return FALSE;

    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $prenotazioni = simplexml_load_file('../Xml/prenotazione.xml');

    foreach($prenotazioni as $prenotazione) {
        if($prenotazione->matricolaStudente == $matricola && $prenotazione->stato == 1)
            $prenotazione->stato = 0;
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/prenotazione.xml', "w");
    $result = fwrite($f,  $prenotazioni->asXML());
    fclose($f);
    if(!$result) 
        return FALSE;
    

    return TRUE;
}


function eliminaPrenotazioniStudentePostVerbalizzazione($matricola, $idCorso) {  
    if($matricola == 0 || $idCorso == 0)
        return FALSE;

    $xmlString = "";
    foreach ( file("../Xml/prenotazione.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $prenotazioni = simplexml_load_file('../Xml/prenotazione.xml');

    foreach($prenotazioni as $prenotazione) {
        if($prenotazione->matricolaStudente == $matricola && $prenotazione->esito == "NULL" && $prenotazione->stato == 1) {
            $appello = getAppelloFromId($prenotazione->idAppello);

            if($appello->idCorso == $idCorso)
                $prenotazione->stato = 0;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/prenotazione.xml', "w");
    $result = fwrite($f,  $prenotazioni->asXML());
    fclose($f);
    if(!$result) 
        return FALSE;
    

    return TRUE;
}


function eliminaStudente($matricola) {
    if($matricola == 0)
        return FALSE;

    if(!eliminaPrenotazioniStudente($matricola))
        return FALSE;

    if(!modificaAffiniStudente($matricola, -1))
        return FALSE;

    $xmlString = "";
    foreach ( file("../Xml/studenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $studenti = simplexml_load_file('../Xml/studenti.xml');
    $eliminato = FALSE;

    foreach($studenti as $studente) {
        if($studente->matricola == $matricola && $studente->stato != 0) {
            $studente->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/studenti.xml', "w");
    $result = fwrite($f,  $studenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}


function eliminaDocente($matricola) {
    if($matricola == 0)
        return FALSE;

    if(!modificaAffiniDocente($matricola, 0))
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/docenti.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $eliminato = FALSE;    
    $docenti = simplexml_load_file('../Xml/docenti.xml');

    foreach($docenti as $docente) {
        if($docente->matricola == $matricola && $docente->stato != 0) {
            $docente->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/docenti.xml', "w");
    $result = fwrite($f,  $docenti->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}


function eliminaSegretario($username) {
    if($username == "")
        return FALSE;
    
    $xmlString = "";
    foreach ( file("../Xml/segreteria.xml") as $node ) {
        $xmlString .= trim($node);
    }

    $eliminato = FALSE;    
    $segretari = simplexml_load_file('../Xml/segreteria.xml');

    foreach($segretari as $segretario) {
        if($segretario->username == $username && $segretario->stato != 0) {
            $segretario->stato = 0;
            $eliminato = TRUE;
            break;
        }
    }

    // Sovrascrive il vecchio file con i nuovi dati
    $f = fopen('../Xml/segreteria.xml', "w");
    $result = fwrite($f,  $segretari->asXML());
    fclose($f);


    if(!$result) 
        return FALSE;
    elseif($result && $eliminato)
        return TRUE;
}

function eliminaContributiStudente($matricola){
    $corsoLaurea = getStudenteFromMatricola($matricola)->idCorsoLaurea;

    foreach(getCorsiFromCorsoDiLaurea($corsoLaurea) as $corso){
        $faqs = array_merge(getFaqComplete($corso->id),getFaqIncomplete($corso->id));
        $posts = getListaPost($corso->id);

        foreach($faqs as $faq){
            if($faq->matricolaStudente == $matricola)
                deleteFaq($faq->id);
        }

        foreach($posts as $post){
            if($post->matricolaStudente == $matricola)
                    deletePost($post->id);
            else{
                foreach(getPostComments($post->id) as $commento){
                    if($commento->matricolaStudente == $matricola)
                        deleteComment($commento ->id);
                }
            }
        }
    }
}
?>