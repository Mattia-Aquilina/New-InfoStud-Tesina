# Tesina - NewInfostud

Si propone di realizzare una piattaforma che replichi le funzionalità del noto portale infostud. Il sito è visitabile a partire da una pagina home, accessibile da tutte le utenze, che illustra i corsi di laurea offerti dall’università con annesse informazioni relative agli esami che essi prevedono.
La lista dei corsi di laurea e degli esami può essere visionata applicando un filtro di visualizzazione basato sul nome.
Tramite un’apposita pagina di login, il visitatore può autenticarsi utilizzando le proprie credenziali, accedendo così alle funzionalità competenti alla sua utenza.
Un utente che sia autenticato come studente può innanzitutto visualizzare tutte le proprie informazioni personali (elencate successivamente). 
Tramite due pagine dedicate, egli può inoltre prenotarsi o cancellare le prenotazioni degli appelli. Oltre a ciò, uno studente può accedere e contribuire alla bacheca dei corsi. In particolare, esiste una bacheca per ciascun corso, all’interno della quale gli studenti possono creare dei post o contribuire a post già creati. 
Gli stessi studenti, e non solo i creatori dei post, possono valutare le risposte ottenute secondo i metodi di giudizio di utilità e accordo. L’insieme dei giudizi ricevuti costituirà la reputazione di uno studente.
Un’altra funzionalità importante è quella delle FAQ. Esiste una pagina di FAQ per ogni corso. Queste pagine possono essere costruite dai professori aggiungendo risposte a domande proposte dagli studenti.
In entrambe le sezioni di bacheca e FAQ, un’utenza autenticata come Segreteria è in grado di moderare, potendo modificare o eliminare post e domande.

---

Le tipologie di utenti che possono usufruire della piattaforma, con annesse rispettive funzionalità, sono le seguenti:
-	Visitatore (utente non autenticato);
-	Studente;
-	Docente;
-	Segreteria (moderatore bacheche e FAQ);
-	Utente Amministratore.

---

Le funzionalità associate alle utenze sopra elencate sono elencate di seguito.

Utente visitatore:
-	Visualizzare le informazioni relative a corsi di laurea ed esami associati;
-	Accedere tramite form di login;
-	Registrarsi presso la piattaforma.

Utente registrato – Studente:
-	Visualizzare informazioni riguardanti la sua carriera (reputazione acquisita, media, esami superati, cfu acquisiti, ecc…);
-	Prenotarsi agli appelli dei corsi relativi al suo percorso di studi;
-	Contribuire alla bacheca dei corsi, uno spazio dove più utenti possono discutere di argomenti riguardanti il singolo corso;
-	Recensire i post/commenti degli altri studenti;
-	Visualizzare le pagine FAQ dei corsi, ed eventualmente contribuire con delle domande.

Utente registrato – Professore:
-	Aggiungere, modificare o eliminare appelli dei suoi corsi;
-	Visualizzare gli studenti prenotati ad un dato appello, ed eventualmente registrare i voti, rinunce o bocciature;
-	Utilizzare il portale delle FAQ rispondendo alle domande che gli studenti propongono.

Utente registrato – Segreteria:
-	Moderare le bacheche dei corsi;
-	Moderare le pagine FAQ, anche inserendo nuove coppie domanda-risposta;
-	Visualizzare la lista degli appelli proposti da tutti i docenti;
-	Inserire, modificare ed eliminare appelli relativi agli esami presenti;
-	Verbalizzare gli esami sostenuti da parte degli studenti.

Utente Amministratore:
-	Sospendere o bloccare utenti;
-	Moderare le sezioni bacheca e FAQ, potendone modificare/eliminare i post, o alcune risposte;
-	Modificare dati associati delle altre utenze;
-	Inserire, modificare ed eliminare appelli relativi agli esami presenti;
-	Verbalizzare gli esami sostenuti da parte degli studenti.

---

I dati che verranno manipolati dalla piattaforma sono i seguenti:

Studente:
-	Matricola;
-	Nome;
-	Cognome;
-	Data di nascita;
-	Crediti acquisiti;
-	Media;
-	Lista esami prenotati; 
-	Corso di laurea;
-	Lista esami sostenuti;
-	Reputazione Totale;
-	Password di accesso.

Docente:
-	Nome;
-	Cognome;
-	Matricola;
-	Lista dei corsi impartiti;
-	Password di accesso.

Segreteria:
-	Username e password per accedere al pannello di amministrazione.

Amministrazione:
-	Username e password per accedere al pannello di amministrazione.

---
