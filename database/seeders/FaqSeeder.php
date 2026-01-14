<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // Definizione delle categorie
        $categorie = [
            ['nome' => 'Informazioni Generali', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Requisiti e Ammissione', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Criteri di Selezione', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Candidatura', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Attività e Programma', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Logistica e Costi', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Per Docenti', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Per Genitori', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Inclusione e Accessibilità', 'created_at' => $now, 'updated_at' => $now],
            ['nome' => 'Supporto Tecnico', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('faq_categorie')->insert($categorie);

        // Recupero gli ID delle categorie
        $catGenerali = DB::table('faq_categorie')->where('nome', 'Informazioni Generali')->first()->id;
        $catRequisiti = DB::table('faq_categorie')->where('nome', 'Requisiti e Ammissione')->first()->id;
        $catSelezione = DB::table('faq_categorie')->where('nome', 'Criteri di Selezione')->first()->id;
        $catCandidatura = DB::table('faq_categorie')->where('nome', 'Candidatura')->first()->id;
        $catAttivita = DB::table('faq_categorie')->where('nome', 'Attività e Programma')->first()->id;
        $catLogistica = DB::table('faq_categorie')->where('nome', 'Logistica e Costi')->first()->id;
        $catDocenti = DB::table('faq_categorie')->where('nome', 'Per Docenti')->first()->id;
        $catGenitori = DB::table('faq_categorie')->where('nome', 'Per Genitori')->first()->id;
        $catInclusione = DB::table('faq_categorie')->where('nome', 'Inclusione e Accessibilità')->first()->id;
        $catSupporto = DB::table('faq_categorie')->where('nome', 'Supporto Tecnico')->first()->id;

        // Definizione delle FAQ
        $faqs = [
            // Informazioni Generali
            [
                'domanda' => 'Cosa sono i corsi di orientamento della Scuola Normale Superiore?',
                'risposta' => 'I corsi di orientamento della Scuola Normale Superiore (SNS) sono programmi intensivi, tre giorni di attività residenziale, rivolti a studenti e studentesse del penultimo anno delle scuole secondarie di secondo grado (generalmente del quarto anno) che si distinguono per merito e potenzialità. In via residuale sono ammessi a partecipare anche studenti e studentesse dell\'ultimo anno su domanda diretta',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali sono gli obiettivi principali dei corsi di orientamento?',
                'risposta' => 'L\'obiettivo principale è fornire un\'esperienza formativa di alto livello, aiutando i e le partecipanti a esplorare le proprie inclinazioni e a prendere decisioni più consapevoli sul percorso universitario e professionale.',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Che tipo di attività si svolgono durante i corsi?',
                'risposta' => 'L\'attività didattica include lezioni tenute da docenti universitari, seminari e laboratori dedicati a diversi ambiti di ricerca e a temi di attualità. Al termine degli incontri, le partecipanti e i partecipanti sono invitati a contribuire al dibattito, confrontandosi tra loro e dialogando con le relatrici e i relatori.',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali sono le tematiche principali trattate nei corsi?',
                'risposta' => 'I corsi si concentrano sulle discipline di studio della Scuola Normale, con particolare riferimento a: Lettere antiche e moderne, Storia dell\'Arte, Filosofia, Storia, Archeologia, Fisica, Matematica, Biologia, Chimica, Informatica, Scienze politico-sociali',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'I corsi sono incentrati su materie specifiche o sono interdisciplinari?',
                'risposta' => 'La maggior parte delle lezioni è specifica di un ambito disciplinare ma possono essere previsti interventi interdisciplinari',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'I corsi sono incentrati su materie insegnate alla Normale?',
                'risposta' => 'Sì',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quando si svolgono i corsi di orientamento?',
                'risposta' => 'I corsi residenziali si svolgono in genere in estate nei mesi di giugno e luglio. Sulla base della programmazione delle attività possono essere previsti corsi anche tra fine agosto e i primi di settembre',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Dove posso trovare maggiori informazioni sui corsi?',
                'risposta' => 'Sul sito dedicato raggiungibile all\'indirizzo orientamento.sns.it',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'C\'è un contatto diretto a cui rivolgersi per dubbi o domande?',
                'risposta' => 'Potete scrivere all\'indirizzo orientamento@sns.it',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Sono previsti incontri informativi prima dell\'inizio dei corsi?',
                'risposta' => 'Come iniziativa distinta e parallela ai corsi di orientamento estivi citiamo "Alla Normale anche tu", dedicata alla presentazione nelle scuole del modello e dell\'offerta formativa della Scuola Normale e delle iniziative di orientamento che ogni anno vengono realizzate. È possibile partecipare in presenza o da remoto, in una delle sessioni che saranno programmate in diverse scuole d\'Italia tra febbraio e maggio 2025. Il calendario degli appuntamenti è disponibile su questo sito nella sezione dedicata.',
                'categoria_id' => $catGenerali,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Requisiti e Ammissione
            [
                'domanda' => 'Chi può partecipare ai corsi di orientamento?',
                'risposta' => 'In via preferenziale e maggioritaria i corsi sono destinati a studenti e studentesse del penultimo anno delle scuole secondarie di secondo grado. Possono presentare domanda diretta (non tramite scuole) anche studenti e studentesse dell\'ultimo anno.',
                'categoria_id' => $catRequisiti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono requisiti specifici per accedere?',
                'risposta' => 'Non sono previsti requisiti particolari, se non una buona media scolastica e interesse e motivazioni solide per prendervi parte. Da tenere in considerazione che uno dei parametri di selezione è la media',
                'categoria_id' => $catRequisiti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È necessario superare un test o presentare un dossier per essere ammessi?',
                'risposta' => 'È necessario candidarsi, la candidatura viene poi valutata da una commissione',
                'categoria_id' => $catRequisiti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quanti studenti e studentesse vengono selezionati per ogni corso?',
                'risposta' => 'In media vengono ammessi 80 partecipanti',
                'categoria_id' => $catRequisiti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Posso partecipare anche se non ho voti altissimi in tutte le materie?',
                'risposta' => 'La possibilità di partecipare dipende dagli esiti delle selezioni. In generale, è possibile essere ammessi se si ha una buona media in generale con punte di eccellenza in discipline specifiche.',
                'categoria_id' => $catRequisiti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È necessario avere conoscenze o competenze specifiche per partecipare?',
                'risposta' => 'Oltre ad un buon cv scolastico e a profilo e motivazioni di interesse, si richiede apertura al dialogo e al confronto sia con i e le docenti e i e le tutor, sia con gli altri e le altre partecipanti al corso',
                'categoria_id' => $catRequisiti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È un corso adatto anche a chi viene da piccole scuole o paesi?',
                'risposta' => 'È certamente adatto a chiunque presenti le caratteristiche specificate anche nei criteri di ammissione, indipendentemente dalla provenienza. È anzi auspicabile che la conoscenza del modello e delle opportunità formative offerte dalla Scuola Normale si diffonda oltre i confini delle grandi città per arrivare anche nelle zone più "remote" del Paese',
                'categoria_id' => $catRequisiti,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Criteri di Selezione
            [
                'domanda' => 'Quali sono i criteri di selezione?',
                'risposta' => 'I posti sono assegnati a studenti e studentesse valutati/e meritevoli e idonei/e in base ai dati risultanti dalla candidatura, la valutazione terrà conto dei voti finali di profitto, della media dei voti, dei risultati particolarmente significativi in materie tra loro affini (che segnalino interessi e capacità orientati a un determinato campo di studio), del profilo inserito in candidatura e della partecipazione a concorsi in materie scientifiche e umanistiche. Sulla base delle preferenze espresse, le persone selezionate per ciascuna delle due aree comprese nei corsi (scientifica e umanistica) non potranno superare il 60%. All\'interno di ciascuna area, le persone dello stesso genere non potranno essere più del 60%.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come vengono valutati i voti di profitto ottenuti nei due precedenti anni scolastici?',
                'risposta' => 'Vengono valutati i voti finali di profitto ottenuti nei due precedenti anni scolastici. Saranno presi in considerazione sia la media dei voti (con esclusione di condotta, educazione cattolica, scienze motorie, comunque denominate), sia risultati particolarmente significativi in materie tra loro affini: 1. media dei voti: punteggio da 1 (media di 7/10) a 4 (media di 10/10), con possibilità di decimali; 2. risultati particolarmente significativi in materie tra loro affini, che segnalino interessi e capacità orientati a un determinato campo di studio: fino a un massimo incremento di 2 punti, con possibilità di decimali. Il punteggio complessivo per i risultati scolastici, in ogni caso, non potrà essere superiore a punti 4 su 10.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Cosa rappresenta il profilo inserito in candidatura e come viene valutato?',
                'risposta' => 'Il Profilo dovrebbe comprendere interessi e attività anche extrascolastici e le motivazioni fornite dallo studente relativamente alla partecipazione ai corsi di orientamento. È valutato dalla commissione fino a 4 punti su 10, con possibilità di decimali.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La partecipazione a concorsi su materie scientifiche e umanistiche ha un peso nella valutazione della candidatura?',
                'risposta' => 'Sì, la partecipazione e i risultati ottenuti in concorsi su materie scientifiche e/o umanistiche (olimpiadi, campionati, certamina ecc.) vengono valutati fino a 2 punti su 10, con possibilità di decimali.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Le informazioni personali caricate in fase di candidatura vengono valutate dalla commissione?',
                'risposta' => 'No, le altre informazioni personali che saranno acquisite nella candidatura hanno rilievo puramente statistico e non concorreranno in alcun modo all\'attribuzione di punteggio al momento della selezione.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come vengono gestite le candidature equivalenti o i pari merito?',
                'risposta' => 'In situazioni valutate equivalenti, potranno essere tenuti in considerazione criteri di inclusione sociale, come il titolo di studio dei genitori. Sempre in situazioni equivalenti, la selezione potrà favorire la partecipazione di studenti e studentesse proposti/e da istituti dai quali non sono stati/e selezionati/e candidati/e nel precedente biennio, al fine di consentire l\'inclusione di un maggior numero di istituti scolastici e località e una rotazione tra gli istituti. Di norma, potranno essere due al massimo le persone selezionate da uno stesso istituto scolastico.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Cosa si intende con candidature equivalenti?',
                'risposta' => 'Sono considerate equivalenti le candidature che, dopo la valutazione in base ai criteri indicati, presentano una differenza di punteggio contenuta entro 0,5/10.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Gli studenti segnalati per i corsi della Scuola potranno essere anche segnalati per i corsi congiunti organizzati in collaborazione con la Scuola Superiore Sant\'Anna (Scuola di Orientamento Universitario - SOU)?',
                'risposta' => 'Sì, Studenti e studentesse segnalati/e per i corsi di orientamento della Scuola Normale potranno essere segnalati/e anche per i corsi della Scuola di Orientamento Universitario organizzata in collaborazione con la Scuola Superiore Sant\'Anna; in nessun caso, però, una stessa persona potrà essere selezionata per prendere parte a più di una iniziativa.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Per gli studenti che hanno fatto autocandidatura valgono gli stessi criteri utilizzati per le segnalazioni da parte delle Scuole?',
                'risposta' => 'Sì, i criteri di selezione sono gli stessi per le segnalazioni delle scuole e anche per la selezione di studenti e studentesse che faranno domanda tramite autocandidatura. In questo caso possono presentare domanda anche studenti e studentesse che stiano frequentando il V anno delle superiori.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Chi è il responsabile della selezione dei corsi di orientamento della Scuola Normale?',
                'risposta' => 'Responsabile della selezione per i corsi organizzati dalla Scuola Normale Superiore è il Direttore, che potrà avvalersi, per le attività istruttorie, di una apposita Commissione.',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'In base a cosa viene formata la graduatoria degli ammessi?',
                'risposta' => 'Viene formata in base ai punteggi assegnati dalla Commissione',
                'categoria_id' => $catSelezione,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Candidatura
            [
                'domanda' => 'Quali sono le modalità di presentazione delle candidature?',
                'risposta' => 'Esistono due modalità di presentazione della candidatura: 1. La segnalazione dello studente è fatta dal referente dell\'istituto scolastico di appartenenza che compila una candidatura per conto dello studente sul portale orientamento.sns.it. Ciascuna scuola può presentare fino ad un massimo di 5 candidature 2. domanda diretta da parte dello studente che si collega al portale e inserisce direttamente i propri dati',
                'categoria_id' => $catCandidatura,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quando possono essere presentate le candidature?',
                'risposta' => 'In genere le candidature possono essere inserite in un periodo preciso ed indicato nel bando e sul portale. Tipicamente tra marzo e inizio maggio',
                'categoria_id' => $catCandidatura,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come fa una scuola a registrarsi sul portale delle candidature?',
                'risposta' => 'La/Il referente della Scuola potrà avviare la registrazione dalla sezione partecipa ai corsi del portale. Durante la registrazione il docente dovrà ricercare la scuola attraverso il nome e/o il codice meccanografico e/o la provincia di riferimento, dopo aver selezionato il proprio istituto il docente deve verificare che l\'indirizzo ufficiale derivante dal sistema informativo del MIM sia corretto e se l\'indirizzo ufficiale viene confermato può procedere con la scelta della password. Una volta ricevuta conferma di attivazione il docente potrà accedere con le credenziali impostate (username: indirizzo email istituzionale; password: quella scelta). Qualora l\'email ufficiale dell\'istituto non sia presidiata e/o si preferisca impostarne una diversa, è possibile farlo indicando il nuovo indirizzo email nel campo apposito ed inserendo delle note identificative. Il sistema invierà una notifica agli uffici SNS che provvederanno a validare il nuovo indirizzo e una volta ricevuta conferma di validazione il docente potrà accedere con le credenziali impostate (username: indirizzo email; password: quella scelta)',
                'categoria_id' => $catCandidatura,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'C\'è una scadenza fissa per le candidature?',
                'risposta' => 'Il termine per la presentazione delle candidature è esplicitato in ciascuno dei bandi pubblicati su questo sito',
                'categoria_id' => $catCandidatura,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come avviene l\'assegnazione ai diversi corsi?',
                'risposta' => 'Il candidato deve esprimere minimo due preferenze circa le sedi dei corsi in programma. L\'assegnazione avviene da un lato tenendo conto di queste preferenze espresse, dall\'altro in modo che in ciascun corso sia presente una rappresentanza il più possibile completa di studenti e studentesse provenienti da tutte le Regioni d\'Italia e di scuole estere.',
                'categoria_id' => $catCandidatura,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come posso ricevere un riscontro sull\'esito della candidatura?',
                'risposta' => 'Gli esiti delle candidature sono pubblicati nell\'apposita sezione del sito dedicato. Ammesse e ammessi a partecipare ricevono un invito per email al quale devono dare riscontro di accettazione',
                'categoria_id' => $catCandidatura,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Attività e Programma
            [
                'domanda' => 'Quali sono gli obiettivi formativi dei corsi di orientamento?',
                'risposta' => 'I corsi si propongono di favorire il confronto e il contatto con lezioni universitarie di discipline impartite alla Scuola Normale, al fine di consentire una prima comprensione di metodi e contenuti di un approccio di studio universitario',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali competenze o attitudini vengono valorizzate durante i corsi?',
                'risposta' => 'Tra le competenze valorizzate troviamo la capacità di comprensione e di adattamento al registro argomentativo e a contenuti di livello più complesso rispetto a quelli a cui gli studenti e le studentesse sono abituati. A queste si aggiungono capacità di dialogo e di confronto con coetanei e docenti',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono tematiche o ambiti disciplinari privilegiati?',
                'risposta' => 'Gli ambiti disciplinari sono quelli di pertinenza dell\'offerta formativa della SNS e le tematiche al centro dell\'attenzione sono quelle oggetto di studio e di ricerca da parte dei docenti della Scuola Normale',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali vantaggi posso trarre dalla partecipazione a questi corsi?',
                'risposta' => 'I corsi permettono di farsi un\'idea di come le discipline vengono trattate a livello universitario, sia in termini di metodo che di contenuti. In particolare, offrono l\'opportunità di entrare in contatto con docenti e allievi e allieve della SNS consentendo di farsi un\'idea diretta delle specificità che contraddistinguono la nostra Istituzionale',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Partecipare ai corsi aumenta le possibilità di accedere alla Scuola Normale come allievo?',
                'risposta' => 'No, non c\'è alcuna connessione causale tra la partecipazione ai corsi di orientamento e l\'ammissione alla Scuola Normale',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'I corsi aiutano a orientarsi nella scelta universitaria?',
                'risposta' => 'I corsi aiutano ad orientarsi nelle discipline impartite alla Scuola Normale, con riferimento in particolare quindi a quelle umanistiche (lettere antiche e moderne, storia, storia dell\'arte, filosofia) e scientifiche (fisica, biologia, matematica, chimica e informatica)',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'C\'è la possibilità di ricevere consigli personalizzati dai docenti?',
                'risposta' => 'Ogni lezione è seguita da uno spazio dedicato alle domande dei partecipanti. In considerazione del loro carattere residenziale, i corsi prevedono inoltre momenti informali durante i quali i partecipanti possono interagire direttamente e personalmente con tutor e docenti',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Dopo il corso di orientamento, vengono forniti attestati o certificati?',
                'risposta' => 'Al termine del corso viene rilasciato un attestato di partecipazione riportante il numero di ore di attività frequentate e l\'elenco delle discipline su cui si sono concentrate le lezioni del corso',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Posso parlare con ex partecipanti per avere feedback sull\'esperienza?',
                'risposta' => 'Sì, è possibile confrontarsi con allieve e allievi della Scuola che possono aver partecipato ai corsi sia durante le scuole secondarie che come tutor durante il loro corso di studi in Normale',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come posso entrare in contatto con ex partecipanti?',
                'risposta' => 'Nella sezione "sportello da studente a studente" del portale di orientamento è possibile prenotare un appuntamento con gli studenti e le studentesse tutor.',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono risorse online, come video o brochure, per saperne di più?',
                'risposta' => 'Su questo sito sono disponibili video dedicati di lezioni di docenti della Normale rivolte a studenti e studentesse delle scuole secondarie di secondo grado',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La frequenza ai corsi può essere riconosciuta in termini di PCTO?',
                'risposta' => 'Al termine del corso viene rilasciato un attestato con indicazione delle ore frequentate, che l\'Istituto scolastico di appartenenza del o della partecipante può considerare ai fini del PCTO. in caso di necessità, la Scuola Normale stipula con gli istituti scolastici che ne facciano richieste convenzioni per il riconoscimento delle attività PCTO.',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Che differenza c\'è tra "Corsi di orientamento residenziali SNS" e "Scuola Orientamento Universitario (SOU)"?',
                'risposta' => 'I corsi di orientamento residenziali sono organizzati in autonomia dalla Scuola Normale Superiore e sono finalizzati alla presentazione della sua offerta formativa, con interventi di docenti delle discipline di studio e di ricerca impartite alla Scuola. La Scuola di Orientamento Universitario (SOU) è organizzata dalla Scuola Normale in collaborazione con la Scuola Superiore Sant\'Anna e si articola in lezioni e laboratori tenuti da docenti e giovani studiosi e studiose di entrambe le istituzioni, a copertura degli ambiti disciplinari sia delle materie pure (di pertinenza della SNS) che di quelle applicate (relative alla Scuola Superiore Sant\'Anna, con ingegneria, giurisprudenza, agraria, medicina ecc.). Per entrambe le iniziative l\'accesso avviene attraverso una selezione sulla base di criteri esplicitati nelle pagine di riferimento di questo sito: in comune la centralità del profitto scolastico, del profilo e delle motivazioni espresse. I canali di candidatura dei corsi residenziali di orientamento SNS sono due: da parte degli istituti scolastici o direttamente da parte di studenti e studentesse interessati. Per la Scuola di Orientamento Universitario l\'unico canale di candidatura attivo è quello diretto da parte di studenti e studentesse interessati.',
                'categoria_id' => $catAttivita,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Logistica e Costi
            [
                'domanda' => 'Dove si tengono i corsi di orientamento?',
                'risposta' => 'I corsi si tengono in diverse località d\'Italia, che vengono stabilite entro la fine dell\'anno precedente dalla Commissione dedicata a queste attività. Tipicamente almeno uno dei corsi di svolge al Nord (negli ultimi anni Torino), uno al centro (San Miniato e/o Roma) e uno al Sud (negli ultimi anni Napoli e Camigliatello)',
                'categoria_id' => $catLogistica,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'I corsi sono in presenza o online?',
                'risposta' => 'I corsi sono in presenza, il corso è residenziale. Le studentesse e gli studenti selezionati risiedono per l\'intera durata del corso nelle stesse strutture, così da favorire momenti di socializzazione e condivisione tra le e i partecipanti',
                'categoria_id' => $catLogistica,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Qual è la durata di un corso di orientamento?',
                'risposta' => 'I corsi settimanali hanno una durata di tre giorni. Altre iniziative specifiche possono avere durata diversa.',
                'categoria_id' => $catLogistica,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono spese da sostenere per partecipare?',
                'risposta' => 'Le uniche spese a carico dei partecipanti sono quelle relative al viaggio per e dalla sede del corso. I corsi sono gratuiti e le spese di soggiorno e vitto durante le attività a carico della Scuola',
                'categoria_id' => $catLogistica,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La Scuola offre vitto e alloggio per chi partecipa ai corsi?',
                'risposta' => 'Sì',
                'categoria_id' => $catLogistica,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Sono previste modalità di supporto per studenti e studentesse che vivono lontano o con difficoltà economiche?',
                'risposta' => 'La Commissione può valutare la possibilità di un supporto per le spese di viaggio in considerazione del luogo di partenza (distanza dalla sede del corso assieme a difficoltà legate ai mezzi di trasporto per raggiungerlo) o della condizione socio-economica come attestato da ISEE o documentazione analoga',
                'categoria_id' => $catLogistica,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Per Docenti
            [
                'domanda' => 'Quali documenti o informazioni devo fornire per proporre un candidato o una candidata?',
                'risposta' => 'Il candidato o la candidata devono inserire i voti finali conseguiti nelle singole materie di studio previste dalla scuola di appartenenza al termine dell\'anno scolastico precedente e di due anni prima e i voti conseguiti nel primo quadrimestre dell\'anno in cui presenta la sua domanda per i corso di orientamento',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'C\'è un limite al numero di studenti e studentesse che un o una docente può segnalare?',
                'risposta' => 'Ogni scuola può candidare al massimo 5 studenti/studentesse',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come posso assicurarmi che la candidatura di uno studente o di una studentessa venga presa in considerazione?',
                'risposta' => 'Tutte le candidature vengono esaminate dalla Commissione che le valuta sulla base dei criteri di selezione esposti in questo sito nella sezione dedicata',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È previsto un modulo online o una procedura specifica per l\'invio delle candidature?',
                'risposta' => 'Sul portale dell\'orientamento è possibile registrarsi per accedere al form di invio delle candidature',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali caratteristiche devono avere una studentessa o uno studente per essere una buona candidata o un buon candidato?',
                'risposta' => 'Deve avere una buona media nei due anni precedenti e nel primo quadrimestre dell\'anno in cui si effettua la candidatura, anche con focus su determinati ambiti disciplinari (quelli di interesse della Scuola Normale, quindi umanistiche o scientifiche), un curriculum interessante per profilo (con evidenza di esperienze anche extracurriculari) e motivazioni e interessi spiccati per le discipline della Scuola',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono criteri specifici di valutazione per la selezione?',
                'risposta' => 'I posti sono assegnati a studenti e studentesse valutati/e meritevoli e idonei/e in base ai dati risultanti dalla candidatura, la valutazione terrà conto dei voti finali di profitto, della media dei voti, dei risultati particolarmente significativi in materie tra loro affini (che segnalino interessi e capacità orientati a un determinato campo di studio), del profilo inserito in candidatura e della partecipazione a concorsi in materie scientifiche e umanistiche. Sulla base delle preferenze espresse, le persone selezionate per ciascuna delle due aree comprese nei corsi (scientifica e umanistica) non potranno superare il 60%. All\'interno di ciascuna area, le persone dello stesso genere non potranno essere più del 60%. I criteri in dettaglio sono esposti nella sezione dedicata del sito',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Il profitto scolastico è determinante o contano anche altre qualità, come motivazione e curiosità intellettuale?',
                'risposta' => 'Il profilo scolastico è uno dei parametri di valutazione, accanto a motivazione, profilo complessivo e curiosità intellettuale',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Gli studenti e le studentesse con un percorso scolastico non lineare ma con potenziale possono essere considerati?',
                'risposta' => 'Possono essere presi in considerazione, sempre avendo presenti però i criteri esposti nel sito per la valutazione finale e complessiva della candidatura',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Qual è la durata e la sede dei corsi di orientamento per i docenti?',
                'risposta' => 'I corsi di orientamento durano 3 giorni, e sono organizzati in diversi luoghi del territorio nazionale. Le sedi vengono stabilite normalmente entro il mese di marzo con indicativamente un corso al Nord, uno al Sud e uno al centro',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Le studentesse e gli studenti selezionati devono coprire i costi di partecipazione, come viaggio, vitto o alloggio?',
                'risposta' => 'Restano a carico delle e dei partecipanti le sole spese di viaggio per raggiungere la sede del corso a cui si è assegnati. La Scuola Normale copre le spese di vitto e alloggio durante la permanenza al corso. Il corso non prevede quota di iscrizione.',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'C\'è la possibilità di essere coinvolti come docenti nella promozione o nel supporto ai corsi?',
                'risposta' => 'La collaborazione con le scuole secondarie di secondo grado è per la Scuola Normale di importanza strategica. Il duplice canale di candidatura - tramite le scuole e direttamente da parte di studenti e studentesse interessati - nasce proprio dalla volontà della Normale di stabilire un rapporto diretto con le istituzioni scolastiche e con i loro e le loro docenti: in quest\'ottica saremo grati delle iniziative di promozione e diffusione delle nostre iniziative di orientamento che vorranno intraprendere partendo dalle nostre circolari informative a vantaggio dei loro studenti',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Le studentesse e gli studenti che partecipano ai corsi ricevono un attestato di partecipazione?',
                'risposta' => 'Al termine del corso viene rilasciato un attestato di partecipazione che riporta il numero di ore effettuato.',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La partecipazione ai corsi può influenzare positivamente l\'ammissione futura alla Scuola Normale o ad altre università?',
                'risposta' => 'La finalità dei corsi non è di offrire un vantaggio competitivo rispetto al concorso di ammissione ma di consentire un primo accostamento a temi, metodi e caratteristiche del contesto universitario, con particolare riferimento a quello della Scuola Normale.',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È possibile organizzare un incontro informativo presso la nostra scuola per promuovere i corsi di orientamento?',
                'risposta' => 'Oltre ai corsi di orientamento, la Scuola organizza anche l\'iniziativa "Alla Normale anche tu", che si propone di presentare sia l\'offerta formativa che le sue attività di orientamento in ingresso. Le scuole del territorio possono proporsi per ospitare queste iniziative nell\'ambito della programmazione degli appuntamenti che la Scuola fa ad inizio di ogni anno. Gli appuntamenti disponibili durante l\'anno sono elencati nella pagina dedicata all\'iniziativa sul sito orientamento.sns.it',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono materiali informativi (brochure, video, presentazioni) che posso condividere con i miei studenti?',
                'risposta' => 'Tutte le informazioni sono disponibili sul sito dedicato alle attività d orientamento della Scuola Normale',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Posso mettermi in contatto con ex partecipanti ai corsi per capire meglio l\'esperienza?',
                'risposta' => 'È possibile confrontarsi con allieve e allievi della SNS che possono aver partecipato ai corsi o durante le scuole secondarie o come tutor durante il loro corso di studi alla SNS',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come posso mantenere un dialogo continuo con la Scuola Normale per eventuali future segnalazioni?',
                'risposta' => 'Scrivendo all\'indirizzo dedicato orientamento@sns.it',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È prevista una rete di scuole o docenti referenti per rafforzare la collaborazione con la Scuola Normale?',
                'risposta' => 'La collaborazione tra la Scuola Normale e le scuole secondarie di secondo grado è per noi di importanza strategica. Saremo lieti di accogliere manifestazioni di interesse per collaborazioni strutturate con i diversi istituti scolastici',
                'categoria_id' => $catDocenti,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Per Genitori
            [
                'domanda' => 'Cosa sono i corsi di orientamento organizzati dalla Scuola Normale Superiore?',
                'risposta' => 'I corsi di orientamento organizzati dalla Scuola Normale sono corsi residenziali della durata di 3 giorni, destinati a studenti e studentesse brillanti e motivati del penultimo (preferibilmente) e dell\'ultimo (in via residuale) anno delle scuole secondarie di secondo grado di tutta Italia e dell\'estero. I corsi si svolgono nel periodo estivo, tra giugno e luglio, e sono volti a mettere in contatto i e le partecipanti con lezioni di livello universitario nelle discipline e sui temi di studio e di ricerca, con focus quindi sulle discipline umanistiche (lettere classiche e moderne, storia, filosofia, storia dell\'arte), scientifiche (matematica, fisica, biologia, chimica e informatica).',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali sono gli obiettivi principali di questi corsi per genitori?',
                'risposta' => 'I corsi sono finalizzati a mettere in contatto i e le partecipanti con lezioni di livello universitario nelle discipline e sui temi di studio e di ricerca, con focus quindi sulle discipline umanistiche (lettere classiche e moderne, storia, filosofia, storia dell\'arte), scientifiche (matematica, fisica, biologia, chimica e informatica) e scienze politico-sociali.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'A chi sono rivolti i corsi?',
                'risposta' => 'A studenti e studentesse del penultimo (in via preferenziale) e dell\'ultimo (in via residuale) anno delle scuole secondarie di secondo grado in Italia e all\'estero (con conoscenza della lingua italiana)',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quanti studenti e studentesse partecipano ogni anno ai corsi di orientamento?',
                'risposta' => 'Ad ogni corsi sono ammessi indicativamente 80/90 partecipanti a seconda della sede individuata per ospitarli',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali sono i temi principali trattati durante i corsi?',
                'risposta' => 'Lezioni e seminari si concentrano sulle discipline e sui temi oggetto di studio e di ricerca alla Scuola Normale: discipline umanistiche (lettere classiche e moderne, storia, filosofia, storia dell\'arte), scientifiche (matematica, fisica, biologia, chimica e informatica) e scienze politico-sociali.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Se mia figlia o mio figlio viene scelto, quanto impegno richiedono questi corsi?',
                'risposta' => 'L\'impegno è a tempo pieno per l\'intera durata del corso (3 giorni) e la frequenza delle lezioni in programma obbligatoria.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Mia figlia/Mio figlio non è mai stato fuori casa da solo. Sarebbe seguito e accompagnato durante i corsi?',
                'risposta' => 'Durante i corsi i e le partecipanti sono costantemente assistiti dallo staff organizzativo e dai tutor a cui possono rivolgersi per qualsiasi necessità organizzativa e logistica',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Mio/mia figlio/figlia può candidarsi? Quali sono i requisiti per la partecipazione?',
                'risposta' => 'Suo/a figlio/a può presentare domanda direttamente o essere candidato/a dalla scuola di appartenenza. Per partecipare occorre avere una buona media nei due anni precedenti e nel primo quadrimestre dell\'anno in cui ci si candida per partecipare anche con focus su settori disciplinari specifici di interesse della Scuola Normale, un buon profilo che testimoni esperienze anche extracurriculari, motivazioni strutturate che lo spingano a voler partecipare a questa nostra iniziativa',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali sono i criteri di selezione per gli studenti e le studentesse?',
                'risposta' => 'I criteri di selezione sono dettagliati nella sezione dedicata di questo sito',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come si invia la candidatura e quali documenti sono necessari?',
                'risposta' => 'La candidatura può essere trasmessa solo attraverso il modulo presente su questo sito. Tutte le informazioni richieste devono essere inserite direttamente nel modulo di candidatura senza il caricamento di documenti. Le informazioni richieste sono: voti finali per singole materie dei due anni precedenti e voti per singole materie del primo quadrimestre di quest\'anno, profilo con esperienze anche extracurriculari, corredato eventualmente di informazioni relative alla partecipazione a Olimpiadi, e alle conoscenze linguistiche possedute, motivazioni. Il modulo di iscrizione conserva in ogni caso le informazioni inserite e la compilazione può avvenire in più step con completamento entro e non oltre il termine fissato per la presentazione delle candidature',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Entro quando bisogna presentare la domanda?',
                'risposta' => 'La domanda deve essere presentata entro la scadenza fissata per il bando e reperibile nella sezione dedicata del sito',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Posso presentare la domanda per conto di mio figlio/mia figlia?',
                'risposta' => 'La domanda può essere presentata o dalla scuola di appartenenza di suo/sua figlio/figlia o direttamente da suo/sua a figlio/figliaa',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È importante che mio figlio/mia figlia abbia partecipato ad altre attività extracurriculari o a gare scolastiche?',
                'risposta' => 'La partecipazione ad attività extracurriculari e a gare (p.e,. Olimpiadi) rappresenta un valore aggiunto importante per la candidatura, come si evince dai criteri di selezione esplicitati nel sito',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Che tipo di attività vengono svolte durante i corsi? Sono previsti lezioni, laboratori o esercitazioni pratiche?',
                'risposta' => 'Sono previste lezioni frontali da parte di docenti delle diverse discipline, con una prima parte di intervento da parte del relatore/relatrice e una seconda parte dedicata a domande e interventi dei partecipanti; sono previsti inoltre seminari e laboratori di carattere più interattivo coordinati dai tutor dei corsi',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'I corsi trattano argomenti specifici delle discipline scientifiche, umanistiche o entrambi?',
                'risposta' => 'Ciascun corso prevede lezioni di tutte le discipline oggetto di studio alla Normale, quindi sia lezioni sulle discipline umanistiche che su quelle scientifiche',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Chi sono le e i docenti che tengono le lezioni? Si tratta di professori della Scuola Normale o di esperti esterni?',
                'risposta' => 'A tenere lezioni sono in prevalenza docenti della Scuola Normale; possono intervenire anche docenti e relatrici e relatori esterni ma comunque sempre sulle discipline di studio coltivate all\'interno della Scuola',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Gli studenti e le studentesse possono interagire direttamente con i e le docenti e confrontarsi tra loro?',
                'risposta' => 'Gli studenti e le studentesse hanno costante occasione di dialogo e interazione con i e le docenti: sia al termine di ciascuna delle loro lezioni, sia nei momenti più informali che un corso di carattere residenziale include (pause, pasti ecc.)',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È previsto un percorso personalizzato per gli studenti e le studentesse in base ai loro interessi?',
                'risposta' => 'I corsi sono uguali per tutti, non sono previsti sotto- percorsi personalizzati: in considerazione della natura residenziale, in ogni caso, ciascun e ciascuna partecipante hanno l\'opportunità di approfondire con gli interlocutori e le interlocutrici di suo interesse - sia docenti che tutor allievi e allieve della Scuola - le tematiche, gli aspetti e le dimensioni che più gli premono in ottica di orientamento.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'In che modo la partecipazione ai corsi può aiutare mio figlio o mia figlia nel suo percorso scolastico o universitario?',
                'risposta' => 'I corsi consentono di farsi un\'idea dei temi, dei linguaggi e delle metodologie dello studio a livello universitario e mettono a disposizione strumenti per una scelta più consapevole del percorso più in linea con le aspirazioni, le competenze e le potenzialità delle e dei partecipanti',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'I corsi offrono un certificato o un attestato di partecipazione?',
                'risposta' => 'Al termine del corso viene rilasciato un attestato di partecipazione riportante il numero di ore di attività frequentate e l\'elenco delle discipline su cui si sono concentrate le lezioni del corso',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La partecipazione ai corsi può agevolare l\'ammissione alla Scuola Normale o ad altre università?',
                'risposta' => 'Non c\'è correlazione diretta tra la partecipazione ai corsi e l\'ammissione alla Scuola Normale, che avviene attraverso un concorso completamente indipendente dalle procedure previste per l\'orientamento. Lo scopo dei corsi è informativo e agisce non sulle procedure concorsuali bensì sulla scelta consapevole del percorso di studi più adatto alle proprie aspirazioni e potenzialità.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Sono previsti momenti di orientamento sulle scelte future per l\'università o la carriera?',
                'risposta' => 'Le lezioni e gli interventi proposti hanno proprio questa finalità orientante: attraverso il contatto diretto con temi e metodi dello studio e della ricerca universitari intendono offrire una prima conoscenza diretta di questo mondo per consentire una scelta più consapevole. Sono previsti inoltre momenti formali e informali di presentazione della Scuola Normale, del suo modello formativo e delle sue specificità',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono testimonianze o esperienze di ex partecipanti che si sono distinte e distinti grazie a questa esperienza?',
                'risposta' => 'Possono essere previsti testimonianze o interventi di alunne e alunni della SNS, che in alcuni casi hanno partecipato anche ai corsi di orientamento.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Dove si svolgono i corsi di orientamento? Sono in presenza o online?',
                'risposta' => 'I corsi si svolgono in diverse località d\'Italia (tipicamente uno al Nord, uno al centro e uno al Sud) e sono esclusivamente in presenza',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La Scuola Normale offre vitto e alloggio per gli studenti e le studentesse che partecipano ai corsi?',
                'risposta' => 'Vitto e alloggio dei partecipanti sono a carico della Scuola Normale, che si occupa interamente delle prenotazioni e della logistica',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ci sono costi per partecipare ai corsi? Se sì, quali spese sono a carico delle famiglie?',
                'risposta' => 'Le sole spese che restano a carico delle e dei partecipanti sono quelle relative al viaggio per raggiungere la sede del corso.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quanto durano i corsi e in quali periodi dell\'anno si tengono?',
                'risposta' => 'Ciascuno dei corsi ha una durata di 3 giorni e si tengono tipicamente nel periodo estivo (giugno, luglio) al termine del periodo scolastico',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come posso contattare la Scuola Normale per ricevere ulteriori dettagli o chiarimenti?',
                'risposta' => 'È possibile contattare il servizio dedicato scrivendo all\'indirizzo orientamento@sns.it o telefonando ai numeri 050509307-670-757-214',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La Scuola Normale offre supporto o informazioni anche per le famiglie che non conoscono il mondo universitario?',
                'risposta' => 'La Scuola offre la sua completa disponibilità ad offrire informazioni mirate a tutte e tutti gli interessati. In ottica di promozione della mobilità sociale e del merito, particolare cura sarà dedicata a trasmettere informazioni puntuali e dettagliate anche e soprattutto a famiglie e interlocutori con informazioni non specifiche sul contesto universitario',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Se mio figlio/mia figlia viene selezionato, come posso aiutarlo/a a prepararsi?',
                'risposta' => 'La partecipazione ai corsi non prevede alcuna preparazione preliminare in termini di studio. I corsi di per sè vogliono configurarsi come occasioni di apprendimento, di formazione e di crescita personale',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Posso visitare la Scuola Normale per capire meglio l\'ambiente e il corso?',
                'risposta' => 'Su appuntamento è certamente possibile organizzare una visita alla Scuola Normale, per avere informazioni di prima mano anche sull\'ambiente che accoglie il percorso di studi. Dal punto di vista dei corsi, però, la visita alla Scuola non aggiunge informazioni importanti perchè i corsi non si tengono normalmente a Pisa ma in altre sedi e strutture, anche lontani dalla Toscana',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Mio figlio è il primo della famiglia a pensare di fare l\'università. Questo corso può aiutarlo a orientarsi in questo percorso?',
                'risposta' => 'I nostri corsi sono di assoluta utilità per fornire uno sguardo dall\'interno del mondo universitario, sotto il punto di vista di una istituzione del tutto particolare come la Scuola. Aggiungiamo che la Scuola Normale, come istituzione universitaria pubblica, assicura una formazione di eccellenza a costo zero, sulla base esclusiva del merito a prescindere dalla provenienza, per cui può essere l\'Istituzione ideale anche per chi proviene da contesti familiari per i quali la spesa dell\'istruzione universitaria sarebbe insostenibile',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Esistono borse di studio o aiuti economici per partecipare ai corsi o per proseguire gli studi alla Scuola Normale?',
                'risposta' => 'In caso di necessità e sulla base di attestazioni ISEE, la Scuola può coprire le spese di viaggio per raggiungere la sede del corso (le spese di vitto e alloggio sono già a carico della Scuola Normale mentre il corso non prevede costi di iscrizione). Gli studi alla Normale sono totalmente gratuiti: la Scuola, come istituzione pubblica, assicura vitto e alloggio nelle sue strutture per l\'intera durata del corso di studi, il rimborso delle tasse versate all\'Università di Pisa (gli iscritti e le iscritte alla Normale devono contestualmente frequentare il corrispondente corso di studi all\'Università di Pisa per le discipline umanistiche e per le discipline scientifiche e all\'Università di Firenze per le scienze politico-sociali), e un piccolo contributo mensile per le piccole spese correnti.',
                'categoria_id' => $catGenitori,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Inclusione e Accessibilità
            [
                'domanda' => 'I corsi sono progettati per essere inclusivi nei confronti degli studenti e delle studentesse con disabilità?',
                'risposta' => 'I corsi sono organizzati tenendo conto delle possibili disabilità delle e dei partecipanti ammessi. In caso di necessità la Scuola copre le spese di vitto e alloggio anche per eventuale personale di accompagnamento',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali misure di supporto sono previste per studenti e studentesse con disabilità fisiche, sensoriali o cognitive durante i corsi?',
                'risposta' => 'In caso di necessità la Scuola è attiva per assicurare tutte le soluzioni possibili per garantire la partecipazione di studenti e studentesse con disabilità',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È possibile segnalare esigenze particolari per organizzare l\'accesso agli spazi o ai materiali didattici?',
                'risposta' => 'È possibile segnalare esigenze particolari, di cui la Scuola si impegnerà a tenere conto nella progettazione delle attività.',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come vengono garantite l\'accessibilità degli strumenti digitali e la fruibilità delle lezioni online, se previste?',
                'risposta' => 'Non sono previste lezioni online. Le lezioni in presenza vengono registrate e successivamente messe a disposizione dei partecipanti; è possibile prevedere misure di accessibilità per partecipanti con esigenze specifiche.',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'È disponibile un/una referente o un/una tutor dedicati per supportare gli studenti con bisogni speciali?',
                'risposta' => 'Il personale organizzativo dei corsi è a disposizione delle e dei partecipanti per rispondere alle specifiche necessità di ciascuno e ciascuna di essi.',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La partecipazione ai corsi rispetta criteri di parità di genere? C\'è un\'attenzione particolare per promuovere la partecipazione femminile in discipline STEM o maschile in discipline umanistiche?',
                'risposta' => 'In fase di selezione delle e dei partecipanti una attenzione specifica è dedicata all\'equa distribuzione in ottica di parità di genere. Rivolta specificatamente al superamento del Gender Gap nelle discipline scientifiche è l\'iniziativa dedicata alle ragazze dal titolo "Scienziate di domani", su cui è possibile trovare informazioni puntuali nella sezione dedicata del sito. Il problema del gender gap nelle discipline umanistiche, con riferimento al genere maschile, non si pone come critico per cui al momento non sono previste misure specifiche',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Esistono attività o iniziative specifiche per favorire il dialogo su temi legati alla diversità e all\'inclusività nei percorsi formativi?',
                'risposta' => 'La Scuola ha adottato un gender equality plan che dedica attenzione specifica a questi temi e si è dotata di una serie di organi, servizi e strumenti per assicurare il rispetto delle diversità e l\'inclusione a tutti i livelli, ivi compresi i corsi di orientamento. Alcune delle lezioni possono affrontare questi temi.',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'La Scuola Normale prevede politiche per affrontare eventuali casi di discriminazione o disparità durante i corsi?',
                'risposta' => 'Qualora durante i corsi dovessero verificarsi casi di questo tipo, la Scuola Normale metterà in atto tutte le azioni di intervento e correttive necessarie per consentirne il contrasto e il superamento',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Quali modelli di riferimento vengono offerti durante i corsi per ispirare studenti e stundentesse di diversa provenienza e identità?',
                'risposta' => 'Il modello - in assoluto più inclusivo e paritario - che sta alla base di tutte le attività formative della Scuola Normale, anche per quanto riguarda i corsi di orientamento, è quello della libera ricerca scientifica. In questa dimensione, l\'apporto di tutte e tutti è valorizzato al massimo in una logica assolutamente inclusiva e paritaria.',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come vengono valorizzate le differenze culturali, di genere e di background degli studenti e delle studentesse?',
                'risposta' => 'I corsi offrono a tutte e tutti i partecipanti l\'opportunità di mettersi in gioco attraverso il confronto con i relatori e i coetanei, anche attraverso domande e interventi che riflettono e valorizzano le specificità di ciascuno e ciascuna di loro',
                'categoria_id' => $catInclusione,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Supporto Tecnico
            [
                'domanda' => 'Come posso recuperare le credenziali di accesso al portale se le ho dimenticate?',
                'risposta' => 'Se ha utilizzato le credenziali SPID dovrà utilizzare la piattaforma messa a disposizione dal suo IDP per recuperarle. Se ha registrato un utente locale potrà utilizzare il sistema di recupero password della piattaforma',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Il sistema segnala un errore durante la compilazione del modulo: come posso risolverlo?',
                'risposta' => 'Deve segnalare l\'errore al supporto tecnico scrivendo all\'indirizzo orientamento@sns.it e specificando il problema riscontrato. Il personale attiverà il servizio di supporto tecnico dedicato.',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Non riesco a selezionare il corso a cui voglio iscrivermi: cosa devo fare?',
                'risposta' => 'Dopo aver effettuato il login sulla piattaforma saranno disponibili tutti i corsi attivi. Nel caso non trovi il corso contatti la segreteria dei corsi ai seguenti contatti: orientamento@sns.it - tel. 050509307 - 670 - 214 - 057',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Posso modificare la mia candidatura dopo averla inviata? Se sì, come?',
                'risposta' => 'No, dopo l\'invio non è possibile modificare la candidatura. Si prega di verificare i dati prima di procedere con l\'invio. Prima dell\'invio è possibile modificare i dati in bozza.',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Il portale non risponde o è molto lento: come posso procedere?',
                'risposta' => 'Contattare il supporto tecnico scrivendo all\'indirizzo orientamento@sns.it e specificando il problema riscontrato. Il personale attiverà il servizio di supporto tecnico dedicato.',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Dove trovo le informazioni di contatto per assistenza tecnica diretta?',
                'risposta' => 'Potete scrivere all\'indirizzo orientamento@sns.it o contattare i seguenti recapiti telefonici - tel. 050509307 - 670 - 214 - 057e specificando il problema riscontrato. Il personale attiverà il servizio di supporto tecnico dedicato.',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Non riesco ad accedere al portale: come posso risolvere il problema?',
                'risposta' => 'Potete scrivere all\'indirizzo orientamento@sns.it o contattare i seguenti recapiti telefonici - tel. 050509307 - 670 - 214 - 057e specificando il problema riscontrato. Il personale attiverà il servizio di supporto tecnico dedicato',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Come posso registrarmi al portale per iniziare la mia candidatura?',
                'risposta' => 'Se è uno studente o una studentessa italiano/a può registrarsi al portale utilizzando le credenziali SPID. Se non è di nazionalità italiana o non è in possesso di credenziali SPID può effettuare la registrazione locale.',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Non riesco a trovare il modulo di candidatura per il corso a cui voglio iscrivermi. Dove posso trovarlo?',
                'risposta' => 'Dopo aver effettuato il login potrà accedere alla pagina contenente tutti i corsi attivi per i quale è possibile candidarsi. Nel caso non trovi il corso che sta cercando può chiedere chiarimenti scrivendo a scrivere all\'indirizzo orientamento@sns.it o contattando i seguenti recapiti telefonici - tel. 050509307 - 670 - 214 - 057',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Ricevo un messaggio di errore generico durante la compilazione del modulo: cosa devo fare?',
                'risposta' => 'Potete scrivere all\'indirizzo orientamento@sns.it o contattare i seguenti recapiti telefonici - tel. 050509307 - 670 - 214 - 057e specificando il problema riscontrato. Il personale attiverà il servizio di supporto tecnico dedicato',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'domanda' => 'Il portale si blocca o non risponde: è possibile candidarsi in un altro modo?',
                'risposta' => 'No, non è possibile. Qualora avvenga potete scrivere all\'indirizzo orientamento@sns.it o contattare i seguenti recapiti telefonici - tel. 050509307 - 670 - 214 - 057e specificando il problema riscontrato. Il personale attiverà il servizio di supporto tecnico dedicato',
                'categoria_id' => $catSupporto,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Inserisco le FAQ
        DB::table('faqs')->insert($faqs);
    }
}
