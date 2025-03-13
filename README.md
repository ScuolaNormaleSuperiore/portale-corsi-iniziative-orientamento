# Piattaforma per la gestione dei corsi e delle iniziative di orientamento universitario

La piattaforma è stata realizzata per la gestione delle candidature dei corsi e delle iniziative di orientamento della Scuola Normale Superiore di Pisa (SNS).
I corsi e le iniziative sono programmi dedicati agli studenti delle scuole secondarie, in particolare a quelli del penultimo anno, che desiderano approfondire temi accademici e conoscere meglio l'ambiente della SNS. Questi corsi sono progettati per offrire un assaggio dell'eccellenza accademica e della ricerca svolta all'interno della SNS, con lo scopo di orientare i ragazzi verso i percorsi universitari e stimolare la loro curiosità intellettuale. I corsi sono gratuiti e l'ammissione è basata sul merito, con una selezione basata sui risultati scolastici e su una lettera di motivazione.

La piattaforma offre un'interfaccia web responsive intuitiva e user-friendly, progettata adottando un approccio “accessibility by design” e “mobile ﬁrst” per guidare i referenti delle scuole secondarie di secondo grado e i candidati (iscrizione spontanea), passo dopo passo, dalla registrazione alla presentazione della domanda. Per il design dell’interfaccia, sono stati utilizzati gli strumenti di sviluppo messi a disposizione da Designers Italia, adottando Bootstrap Italia.

## Funzionalità

-   Gestione candidature studenti
-   Gestione candidature referenti scolastici
-   Gestione scuole
-   Gestione iniziative
-   Gestione corsi
-   Gestione pagine informative
-   Gestione eventi
-   Gestione contenuti multimediali
-   Gestione sportello studenti
-   Gestione avvisi
-   Gestione hero home page
-   Gestione utenti
-   Gestione tabelle tassonomie

## Integrazioni

-   Integrazione con Gateway SSO di Cineca (per accesso e registrazione con SPID e CIE, accesso con credenziali di ateneo per operatore)
-   Integrazione con Magazine News di ateneo (tramite feed RSS)
-   Integrazione con piattaforma di mail marketing Brevo
-   Importazione elenco scuole pubbliche e paritarie fornito dal MIM

## Installazione

-   dalla root del progetto eseguire "sh scripts/storage.sh"
-   composer update
-   php artisan storage:link
-   dalla directory storage/app eseguire ln -s ../files files
-   copiare il file .env.example come .env
-   modificare il contenuto .env generato secondo le proprie esigenze (cambire in particolare il database e app_url)
-   importare il db in database/dumps
-   eseguire il comando php artisan init e rispondere "y" alle domande
