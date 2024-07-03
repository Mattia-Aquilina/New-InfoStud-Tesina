<?php
require_once('phpFunctions-misc.php');

/* ================================= 
=========== PHP CLASSES ============
==================================== */

class corso {
    public $id;
    public $nome;
    public $matricolaDocente;
    public $matricolaCoDocente;
    public $descrizione;
    public $colore;
    public $anno;
    public $semestre;
    public $curriculum;
    public $cfu;
    public $ssd;
    public $idCorsoLaurea;

    public function __construct($nome, $descrizione, $matricolaDocente, $matricolaCoDocente, $anno, $semestre, $curriculum, $cfu, $ssd, $idCorsoLaurea) {
        $this->id = calcolaIdCorso();
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->matricolaDocente = $matricolaDocente;
        $this->matricolaDocente = $matricolaCoDocente;
        $this->anno = $anno;
        $this->semestre = $semestre;
        $this->curriculum = $curriculum;
        $this->cfu = $cfu;
        $this->ssd = $ssd;
        $this->idCorsoLaurea = $idCorsoLaurea;
        $this->colore = 'lightblue';
    }
}


class studente {
    public $matricola;
    public $nome;
    public $cognome;
    public $password;
    public $dataNascita;
    public $reputazioneTotale;
    public $cfuTotale;
    public $media;
    public $idCorsoLaurea;
    public $stato;
    public function __construct($nome, $cognome, $password, $dataNascita, $idCorsoLaurea) {
        $this->matricola = generaMatricola("Studente");
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
        $this->dataNascita = $dataNascita;         
        $this->reputazioneTotale = 0;
        $this->cfuTotale = 0;
        $this->media = 0;
        $this->idCorsoLaurea = $idCorsoLaurea;  
    }
}


class docente {
    public $matricola;
    public $nome;
    public $cognome;
    public $password;
    public $stato;
    public function __construct($nome, $cognome, $password) {
        $this->matricola = generaMatricola("Docente");
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
    }
}


class segretario {
    public $username;
    public $password;
    public $stato;
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
}


class amministratore {
    public $username;
    public $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
}


class appello {
    public $id;
    public $dataOra;
    public $idCorso;

    public function __construct($dataOra, $idCorso) {
        $this->id = calcolaIdAppello();
        $this->dataOra = $dataOra;
        $this->idCorso = $idCorso;
    }
}


class corsoDiLaurea {
    public $id;
    public $nome;

    public function __construct($nome) {
        $this->id = calcolaIdCorsoDiLaurea();
        $this->nome = $nome;
    }
}


class prenotazione {
    public $id;
    public $matricolaStudente;
    public $idAppello;
    public $esito;

    public function __construct($matricolaStudente, $idAppello) {
        $this->id = calcolaIdPrenotazione();
        $this->matricolaStudente = $matricolaStudente;
        $this->idAppello = $idAppello;
        $this->esito = "NULL";
    }
}

class faq {
    public $id;
    public $domanda;
    public $risposta;
    public $utilitaTotale;
    public $idCorso;
    public $idAutore;
}

class faqVote {
    public $id;
    public $matricolaStudente;
    public $idFAQ;
    public $utilita;
    public function __construct($matricola, $idFAQ, $utilita) {
        $this->matricolaStudente = $matricola;
        $this->idFAQ = $idFAQ;
        $this->utilita = $utilita;
        $this->id = nextFaqVoteId();
    }
}

class post {
    public $id;
    public $titolo;
    public $corpo;
    public $matricolaStudente;
    public $utilitaTotale;
    public $idCorso;
    public $data;
    public $replies;
}

class comment {
    public $id;
    public $corpo;
    public $matricolaStudente;
    public $accordoMedio;
    public $idPost;
    public $data;
}

class commentVote {
    public $id;
    public $matricolaStudente;
    public $idCommento;
    public $accordo;
    public $idAutoreCommento;
}
?>