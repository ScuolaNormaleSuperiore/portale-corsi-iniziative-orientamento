# Manuale utente

## 1. Scopo del portale

Il portale gestisce i corsi e le iniziative di orientamento della Scuola Normale Superiore. Consente di pubblicare contenuti informativi, presentare corsi e iniziative, raccogliere candidature di studenti e scuole, consultare news, eventi, video e informazioni di orientamento.

Le principali aree funzionali sono:

- sito pubblico informativo;
- registrazione e accesso di studenti e referenti scolastici;
- compilazione e invio delle candidature;
- backoffice per amministrazione di contenuti, utenti, scuole, corsi e tabelle di supporto;
- servizi informativi come archivio news, eventi, video, sportello studenti e chatbot.

## 2. Tipologie di utenti

### Visitatori

I visitatori possono navigare le pagine pubbliche senza autenticazione. Possono consultare:

- homepage;
- sezione Orientamento;
- pagine informative sui corsi;
- dettaglio dei corsi pubblicati;
- archivio news;
- archivio eventi;
- archivio video;
- sportello "da studente a studente";
- pagina chatbot e contatti.

### Studenti

Gli studenti registrati possono accedere all'area candidature, creare una candidatura personale, salvarla in bozza e inviarla entro il periodo di apertura dell'iniziativa.

### Referenti scuola

Gli utenti con ruolo Scuola possono inserire candidature per conto della scuola associata al proprio profilo. Il numero massimo di candidature dipende dalla configurazione dell'iniziativa.

### Amministratori e superutenti

Gli utenti con ruolo Admin o Superutente possono gestire contenuti e dati tramite backoffice, comprese candidature, iniziative, corsi, scuole, pagine, news, eventi, video, utenti e tabelle di classificazione.

## 3. Navigazione pubblica

### Homepage

La homepage mostra i contenuti principali configurati dagli operatori:

- pagine di orientamento in evidenza;
- corsi in evidenza;
- news in evidenza;
- eventi in evidenza;
- avvisi attivi;
- video in evidenza;
- feed RSS esterni, se configurati;
- copertina grafica della homepage.

### Orientamento

La sezione Orientamento raccoglie pagine editoriali attive, ordinate secondo la configurazione di backoffice. Ogni pagina può avere sezioni interne e allegati.

### Info corsi

La sezione Info corsi contiene:

- pagine informative generali;
- iniziative attive nel periodo corrente;
- corsi collegati alle iniziative;
- eventuali allegati e sezioni di approfondimento.

Un'iniziativa è visibile quando è attiva e la data corrente è compresa tra data di apertura e data di chiusura.

### News, eventi e video

Gli archivi consentono di consultare contenuti pubblicati e attivi. Le pagine archivio permettono la ricerca testuale; l'archivio video prevede anche il filtro per categoria/materia.

### Sportello studenti

Lo sportello "da studente a studente" mostra le classi e i tutor disponibili. La pagina di una classe elenca gli studenti/tutor associati alle materie della classe selezionata.

### Chatbot

La pagina Chatbot propone domande frequenti sui corsi di orientamento, informazioni di contatto e orari dell'ufficio orientamento.

## 4. Registrazione e accesso

Gli utenti accedono dalle pagine di autenticazione del portale. Il progetto prevede flussi distinti per:

- registrazione studente;
- registrazione scuola;
- login classico;
- login tramite integrazione SAML2/Cineca, quando configurata;
- recupero password;
- verifica email.

Dopo la registrazione, l'utente deve completare la verifica dell'indirizzo email quando richiesta. Alcune funzioni, tra cui la gestione candidature, sono disponibili solo agli utenti autenticati e verificati.

## 5. Gestione candidature

### Accesso all'area candidature

Dopo il login, la pagina Candidature mostra:

- iniziative aperte e attive;
- candidature già create dall'utente;
- stato delle candidature;
- azioni disponibili, come modifica, visualizzazione o cancellazione della bozza.

Le candidature possono essere modificate solo quando sono in stato Bozza. Dopo l'invio, la candidatura diventa consultabile ma non modificabile dall'utente ordinario.

### Creazione di una candidatura

Per creare una candidatura:

1. accedere all'area Candidature;
2. scegliere un'iniziativa aperta;
3. avviare una nuova candidatura;
4. compilare gli step richiesti;
5. salvare la bozza o procedere allo step successivo;
6. verificare il riepilogo;
7. accettare l'informativa;
8. inviare la candidatura.

Gli studenti possono normalmente presentare una candidatura per iniziativa. Le scuole possono presentare un numero massimo di candidature definito dall'iniziativa.

### Step della candidatura

#### Step 1: dati personali e familiari

Raccoglie:

- dati anagrafici: cognome, nome, codice fiscale, luogo e data di nascita, sesso;
- dati di contatto: email, telefono, indirizzo, comune, CAP, provincia/nazione;
- titoli di studio e professioni dei genitori.

#### Step 2: informazioni scolastiche

Raccoglie:

- provincia della scuola;
- scuola italiana o scuola estera;
- classe e sezione;
- voti scolastici per le materie previste.

Se la candidatura è compilata da una scuola, il portale può precompilare la scuola associata all'utente.

#### Step 3: profilo, competenze ed esperienze

Raccoglie:

- profilo personale;
- competenze linguistiche;
- partecipazione a olimpiadi, gare, stage o concorsi;
- eventuali esperienze all'estero.

Il profilo personale deve rispettare i limiti di lunghezza configurati dal sistema, di norma tra 400 e 1500 caratteri.

#### Step 4: preferenze e corsi

Raccoglie:

- materie preferite;
- settore professionale di interesse;
- motivazioni della candidatura;
- preferenze per i corsi disponibili;
- modalità con cui il candidato ha conosciuto i corsi SNS.

Le motivazioni devono rispettare i limiti di lunghezza configurati, di norma tra 400 e 1500 caratteri. Quando sono disponibili più corsi, il portale richiede la selezione di almeno due preferenze.

#### Step 5: informativa

Richiede l'accettazione dell'informativa prevista dal portale.

#### Step 6: riepilogo

Mostra i dati inseriti prima dell'invio. L'utente deve controllare attentamente le informazioni prima di completare la candidatura.

### Salvataggio, autosalvataggio e invio

Durante la compilazione è possibile salvare la candidatura in bozza. Il sistema include anche un endpoint di autosalvataggio per aggiornare la bozza durante l'uso dell'interfaccia.

L'invio finale registra la data di candidatura e applica la transizione di stato verso "inviata". Una candidatura inviata non può essere modificata tramite il flusso utente standard.

### Eliminazione di una candidatura

Una candidatura in bozza può essere eliminata dall'area Candidature. Il sistema verifica che l'utente abbia i permessi necessari prima di completare l'eliminazione.

## 6. Backoffice amministrativo

Il backoffice è basato su interfacce CRUD configurate tramite Foorm/Cupparis. Gli amministratori possono gestire le entità abilitate dal sistema e dai relativi permessi.

Le aree principali includono:

- utenti e ruoli;
- candidature;
- iniziative;
- corsi;
- scuole e richieste scuola;
- pagine standard;
- pagine informative sui corsi;
- pagine di orientamento;
- sezioni e contenuti;
- news;
- eventi;
- avvisi;
- video e categorie video;
- classi, materie e materie di orientamento;
- tabelle geografiche e tassonomie;
- allegati e immagini.

### Gestione contenuti pubblici

Per pubblicare un contenuto:

1. accedere al backoffice;
2. aprire la sezione corrispondente, ad esempio News, Eventi, Pagine o Video;
3. creare o modificare il record;
4. compilare titolo, descrizione, date, ordinamento e campi richiesti;
5. impostare il contenuto come attivo;
6. salvare;
7. verificare la visualizzazione sul sito pubblico.

I contenuti non attivi non sono mostrati nelle pagine pubbliche.

### Gestione iniziative e corsi

Un'iniziativa definisce il periodo di apertura delle candidature, i posti, le modalità di candidatura e i limiti per le scuole. I corsi sono collegati a un'iniziativa e descrivono sede, date, luogo e contenuti.

Per rendere una candidatura disponibile agli utenti:

1. creare o aggiornare l'iniziativa;
2. impostare `attivo`;
3. configurare `data_apertura` e `data_chiusura`;
4. collegare uno o più corsi attivi;
5. controllare la pagina Info corsi e l'area Candidature.

### Gestione scuole

Il portale gestisce scuole italiane, scuole estere e richieste di associazione scuola. Le scuole possono essere importate da dataset o dump e possono essere associate a un utente referente.

### Esportazioni e azioni massive

Le rotte di azione Foorm prevedono operazioni come:

- cancellazione singola;
- cancellazione multipla;
- aggiornamento di un campo;
- autocomplete;
- caricamento file;
- esportazione CSV;
- esportazione PDF;
- split tables;
- gestione datafile.

La disponibilità effettiva dipende dai permessi dell'utente e dalla configurazione della singola entità.

## 7. Notifiche email

Il sistema contiene template e notifiche per:

- verifica email;
- recupero password;
- registrazione studente;
- candidatura inviata;
- nuova candidatura da studente o scuola;
- richiesta scuola;
- accettazione richiesta scuola.

L'invio richiede una configurazione corretta del mailer in `.env`.

## 8. Buone pratiche operative

- Controllare date di apertura e chiusura delle iniziative prima della pubblicazione.
- Verificare che i corsi collegati siano attivi e completi.
- Tenere aggiornate scuole, province, comuni e tabelle di supporto.
- Provare una candidatura completa in ambiente di test prima di aprire un nuovo bando.
- Verificare periodicamente che le email partano correttamente.
- Usare l'anteprima pubblica per controllare pagine, allegati e immagini.
- Non modificare candidature inviate senza una procedura amministrativa definita.

## 9. Glossario

- **Iniziativa**: contenitore principale di un bando o programma di orientamento.
- **Corso**: singolo corso collegato a un'iniziativa.
- **Candidatura**: domanda presentata da uno studente o da una scuola.
- **Bozza**: candidatura salvata ma non inviata.
- **Inviata**: candidatura completata e trasmessa.
- **Foorm**: sistema di configurazione dei form e delle CRUD amministrative.
- **Cupparis**: base applicativa usata per backoffice, permessi e componenti CRUD.
