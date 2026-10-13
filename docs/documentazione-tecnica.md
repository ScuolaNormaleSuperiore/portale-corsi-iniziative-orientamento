# Documentazione tecnica

## 1. Panoramica

Il progetto è un'applicazione Laravel per la gestione dei corsi e delle iniziative di orientamento della Scuola Normale Superiore. Il codice combina:

- backend Laravel 10;
- autenticazione Laravel Breeze/Sanctum;
- ruoli e permessi tramite Spatie Permission;
- backoffice e CRUD tramite pacchetti Gecche Cupparis/Foorm;
- frontend pubblico Blade con tema `sns`;
- asset pipeline Laravel Mix;
- integrazione SAML2;
- notifiche email;
- import e dataset per scuole, geografia e tassonomie.

Repository principale: `ScuolaNormaleSuperiore/portale-corsi-iniziative-orientamento`.

## 2. Requisiti

### Runtime applicativo

- PHP 8.1 o superiore, come indicato in `composer.json`.
- Composer.
- Node.js e npm per la build degli asset.
- Database MySQL/MariaDB per l'uso applicativo ordinario.
- Redis opzionale secondo configurazione Laravel/Sail.
- Mailer SMTP per l'invio delle notifiche.

### Estensioni PHP consigliate

Per Laravel e le dipendenze del progetto sono normalmente necessarie:

- `mbstring`;
- `xml`;
- `curl`;
- `zip`;
- `mysql`;
- `sqlite3`, utile per test locali;
- `gd`;
- `intl`;
- `bcmath`.

## 3. Installazione locale

Il README del repository indica il seguente flusso di base:

1. eseguire `sh scripts/storage.sh` dalla root del progetto;
2. installare o aggiornare le dipendenze Composer;
3. eseguire `php artisan storage:link`;
4. creare il link `storage/app/files` verso `../files`;
5. copiare `.env.example` in `.env`;
6. configurare database e `APP_URL`;
7. importare i dump in `database/dumps`;
8. eseguire `php artisan init` e confermare le domande.

Per un setup ripetibile in sviluppo:

```bash
cp .env.example .env
composer install
npm ci
sh scripts/storage.sh
php artisan key:generate
php artisan storage:link
ln -sfn ../files storage/app/files
php artisan migrate
php artisan db:seed
npm run dev
php artisan serve --host=0.0.0.0 --port=8000
```

Se si usa un database già popolato, importare prima i dump SQL necessari e poi verificare le migrazioni residue.

## 4. Configurazione `.env`

Le variabili principali sono:

- `APP_NAME`: nome applicazione.
- `APP_ENV`: ambiente Laravel.
- `APP_KEY`: chiave applicativa generata con `php artisan key:generate`.
- `APP_DEBUG`: debug locale.
- `APP_URL`: URL pubblico dell'applicazione.
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: connessione database.
- `THEME_NAME`: tema frontend, nel progetto impostato su `roma-vue` nell'esempio.
- `CACHE_DRIVER`, `QUEUE_CONNECTION`, `SESSION_DRIVER`: driver Laravel.
- `MAIL_*`: configurazione SMTP.
- `REDIS_*`: configurazione Redis, se usato.
- `PUSHER_*` e `VITE_PUSHER_*`: eventuale broadcasting.
- `MAX_LENGTH_TEXTAREA` e `MIN_LENGTH_TEXTAREA`: limiti testuali usati nella candidatura, se definiti.

Non salvare valori segreti nel repository.

## 5. Struttura del progetto

Percorsi principali:

- `app/Http/Controllers`: controller web, API, autenticazione e backoffice.
- `app/Models`: modelli Eloquent di dominio.
- `app/Foorm`: classi Foorm per form/list/edit/view.
- `app/Enums`: enumerazioni usate in candidatura e tabelle.
- `app/Notifications` e `app/Mail`: notifiche e mail.
- `app/Policies`: policy di autorizzazione.
- `config/fe/candidatura.php`: configurazione degli step candidatura.
- `config/foorms`: configurazione Foorm delle entità.
- `database/migrations`: schema dati.
- `database/seeders`: seed iniziali e dati demo.
- `database/dataset`: dataset JSON.
- `database/dumps`: dump SQL per pagine/scuole.
- `resources/views/sns`: viste Blade del tema pubblico.
- `resources/js` e `resources/css`: asset compilati con Laravel Mix.
- `routes/web.php`: rotte web pubbliche e autenticate.
- `routes/api.php`: API applicative e integrazioni.
- `routes/foorm.php`: rotte CRUD Foorm.
- `public`: asset pubblici e build.

## 6. Dominio applicativo

Le entità principali sono:

- `Iniziativa`: programma o bando di orientamento.
- `Corso`: corso collegato a un'iniziativa.
- `Candidato`: candidatura presentata da studente o scuola.
- `CandidatoVoti`: voti scolastici del candidato.
- `CandidatoCorso`: preferenze corsi del candidato.
- `Scuola` e `ScuolaRichiesta`: istituti scolastici e richieste correlate.
- `Pagina`, `PaginaInfo`, `PaginaOrientamento`: contenuti editoriali.
- `SezioneContenuto` e `SezioneLayout`: sezioni riusabili di pagina.
- `News`, `Evento`, `Avviso`, `Video`: contenuti pubblici.
- `Classe`, `Materia`, `MateriaOrientamento`: classificazioni didattiche.
- `Regione`, `Provincia`, `Comune`, `Nazione`: dati geografici.
- `User`, `Role`, `Permission`: utenti e autorizzazioni.

## 7. Rotte web principali

Le rotte pubbliche principali sono definite in `routes/web.php`:

- `/`: homepage;
- `/orientamento`: area orientamento;
- `/info-corsi/{pagina?}`: pagine informative e iniziative aperte;
- `/info-corso/{corso}`: dettaglio corso;
- `/pagina-orientamento/{pagina}`: pagina orientamento;
- `/pagina/{pagina}`: pagina standard;
- `/sportello-studenti`: sportello studenti;
- `/sportello-studenti/{classe}`: tutor per classe;
- `/archivio-news`: archivio news;
- `/dettaglio-news/{notizia}`: dettaglio news;
- `/archivio-eventi`: archivio eventi;
- `/dettaglio-evento/{evento}`: dettaglio evento;
- `/archivio-video`: archivio video;
- `/chat`: chatbot;
- `/cortesia-scuola-richiesta`: pagina cortesia richiesta scuola.

Le rotte candidatura sono protette da `auth` e `verified`:

- `GET/POST /candidature`;
- `GET /candidatura/{iniziativa}/new`;
- `POST /candidatura/{iniziativa}/new`;
- `GET /candidatura/edit/{candidatura}/{step?}`;
- `PUT /candidatura/edit/{candidatura}/{step?}`;
- `GET /candidatura/view/{candidatura}`;
- `GET /candidatura/delete/{candidatura}`.

## 8. Rotte API

Le API principali sono in `routes/api.php`:

- `POST /api/login`: login API;
- `ANY /api/logout`: logout con Sanctum;
- `GET /api/me`: utente autenticato;
- `GET /api/app-menu`: menu applicativo;
- `POST /api/newsletter/add`: iscrizione newsletter;
- `GET /api/iniziativa-corsi/{iniziativa}`: corsi di un'iniziativa;
- `POST /api/scuole-suggest`: autocomplete scuole;
- `POST /api/comuni-provincia`: comuni per provincia;
- `PUT /api/candidatura/edit/{candidatura}/{step?}`: autosalvataggio candidatura.

API esterne:

- `POST /api/ext/login`;
- `POST /api/ext/candidato`;
- `POST /api/ext/candidato/{iniziativaId}`;
- `POST /api/ext/iniziativa`;
- `POST /api/ext/faq`.

Le API esterne richiedono autenticazione Sanctum e ruolo `ApiUser`.

## 9. Candidature

Il flusso candidature è gestito da `App\Http\Controllers\CandidatureController` e dalla configurazione `config/fe/candidatura.php`.

### Regole di accesso

- `Admin` e `Superutente` possono creare e modificare candidature.
- `Studente` può creare candidature personali, con limite predefinito di una candidatura per iniziativa.
- `Scuola` può creare candidature per la scuola associata, entro `max_candidature_scuola` dell'iniziativa.
- Le candidature non in bozza non sono modificabili dal flusso utente standard.
- Le candidature in bozza non sono visualizzabili tramite la rotta di sola lettura.

### Step configurati

1. `dati_personali`: dati anagrafici, contatti, informazioni familiari.
2. `info_scolastiche`: scuola, classe, voti.
3. `profilo_competenze`: profilo, lingue, concorsi, esperienze.
4. `preferenze`: materie, motivazioni, corsi, modalità conoscenza SNS.
5. `informativa`: accettazione informativa.
6. `riepilogo`: riepilogo finale.

### Stati

Gli stati sono modellati tramite `App\Enums\CandidatoStatuses` e transizioni FSM. L'invio esegue la transizione `inviata` e valorizza `data_candidatura` se assente.

## 10. Backoffice Foorm/Cupparis

Le rotte CRUD generiche sono in `routes/foorm.php`.

Pattern principali:

- `GET /foorm/{foorm}/list/{type}`;
- `GET /foorm/{foorm}/new/{type?}`;
- `GET /foorm/{foorm}/{id}/edit/{type?}`;
- `POST /foorm/{foorm}/{type?}`;
- `PUT /foorm/{foorm}/{id}/{type?}`;
- `DELETE /foormaction/delete/{foorm}/{foormtype}/{foormpk?}`;
- `POST /foormaction/multi-delete/{foorm}/{foormtype}/{foormpk?}`;
- `POST /foormaction/autocomplete/{foorm}/{foormtype}/{foormpk?}`;
- `POST /foormaction/uploadfile/{foorm}/{foormtype}/{foormpk?}`;
- `POST /foormaction/csv-export/{foorm}/{foormtype}/{foormpk?}`;
- `POST /foormaction/pdf-export/{foorm}/{foormtype}/{foormpk?}`.

Le entità sono abilitate dalla configurazione Cupparis e dalle configurazioni in `config/foorms`.

## 11. Autenticazione e autorizzazione

Il progetto usa:

- Laravel Breeze per autenticazione web;
- Sanctum per API token/sessioni API;
- Spatie Permission per ruoli e permessi;
- policy Laravel in `app/Policies`;
- integrazione SAML2 per accessi esterni, configurata in `config/saml2.php`.

Ruoli emersi dal codice e dai seed:

- `Superutente`;
- `Admin`;
- `Operatore`;
- `Studente`;
- `Scuola`;
- `ApiUser`.

La disponibilità dei ruoli dipende dai seed, dalle migrazioni e dai dati importati.

## 12. Database, seed e import

Le migrazioni definiscono tabelle applicative, candidature, pagine, contenuti, tassonomie, scuole e geografia.

Seeder rilevanti:

- `PermissionsTableSeeder`: ruoli e permessi base;
- `UsersTableSeeder`: utenti amministrativi demo;
- `RegioniProvinceTableSeeder`: regioni e province;
- `TitoliProfessioniLivelliTableSeeder`: titoli, professioni, livelli linguistici e modalità conoscenza;
- `IniziativeTableSeeder`: iniziative e corsi demo;
- `CandidatiTableSeeder`: candidature demo;
- seeder per pagine informative, pagine standard, FAQ e dataset.

Sono presenti dump SQL in `database/dumps` per pagine e scuole.

Il comando `php artisan init` estende il comando Cupparis e, nel flusso `standard`, esegue operazioni come update Composer, reset/migrate, seed, import demo, permessi e pulizia cache.

## 13. Asset frontend

Gli asset principali sono compilati con Laravel Mix tramite `webpack.mix.js`:

```js
mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
       require('autoprefixer'),
   ]);
```

Comandi npm:

- `npm run dev`: build sviluppo;
- `npm run watch`: watch;
- `npm run watch-poll`: watch con polling;
- `npm run hot`: hot reload;
- `npm run prod`: build produzione;
- script dedicati per pacchetti CRUD Vue in `packages/cupparis-crud`.

## 14. File, upload e storage

La configurazione upload è in `config/cupparis-app.php`:

- foto: massimo 2000 KB, estensioni `jpeg,jpg,png`;
- attachment: massimo 10000 KB, estensioni `pdf,zip,rar,doc,docx,xls,xlsx,ppt,pptx,odf,ods,txt,csv`.

Lo script `scripts/storage.sh` crea le directory richieste in `storage` e `bootstrap/cache`.

Strutture rilevanti:

- `storage/files`;
- `storage/files/allegati`;
- `storage/files/foto`;
- `storage/files/queues`;
- `storage/files/queues-failed`;
- `storage/files/temp`;
- `storage/framework/cache`;
- `storage/framework/sessions`;
- `storage/framework/testing`;
- `storage/framework/views`;
- `storage/logs`.

## 15. Integrazioni

### SAML2/Cineca

Il progetto include `24slides/laravel-saml2` e controller di autenticazione dedicati. La configurazione avviene in `config/saml2.php` e tramite variabili d'ambiente.

### Feed RSS

`FEController::getFeeds()` legge `config('feeds.url')` e mostra fino a tre elementi in homepage.

### Brevo

Il progetto include `hofmannsven/laravel-brevo` e la configurazione `config/brevo.php`.

### Newsletter

L'endpoint `POST /api/newsletter/add` è gestito da `App\Http\Controllers\Api\AppController`.

### Chatbot

La rotta `/chat` carica asset da `public/chat/manifest.json` quando presenti e mostra una raccolta di domande frequenti.

## 16. Test e qualità

Il progetto contiene test PHPUnit in:

- `tests/Unit`;
- `tests/Feature`;
- `tests/Feature/Auth`.

Comando previsto:

```bash
php artisan test
```

Il file `phpunit.xml` imposta ambiente `testing`, cache array, mail array, queue sync e session array. Le righe SQLite sono presenti ma commentate; per test senza MySQL si possono abilitare `DB_CONNECTION=sqlite` e `DB_DATABASE=:memory:` in una configurazione locale dedicata, verificando prima la compatibilità delle migrazioni.

## 17. Deploy

Indicazioni operative generali:

1. installare dipendenze con `composer install --no-dev --optimize-autoloader`;
2. installare dipendenze Node e generare asset con `npm ci` e `npm run prod`;
3. configurare `.env` con database, mailer, SAML2, URL pubblici e servizi esterni;
4. creare directory storage e link pubblici;
5. eseguire migrazioni e import dati necessari;
6. pulire e rigenerare cache Laravel:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

7. configurare scheduler e queue worker se usati in produzione;
8. verificare homepage, login, candidatura e backoffice.

## 18. Checklist manutenzione

- Verificare periodicamente backup database e storage.
- Tenere aggiornati certificati e metadati SAML2.
- Controllare scadenze delle iniziative prima dell'apertura delle candidature.
- Testare invio email dopo modifiche SMTP.
- Ricompilare asset dopo modifiche a `resources/js`, `resources/css` o pacchetti frontend.
- Aggiornare dataset scuole/geografia secondo le fonti ufficiali.
- Eseguire test e smoke test dopo aggiornamenti Composer o npm.

## 19. Note per sviluppatori

- Evitare di committare `.env`, file generati in `storage` e credenziali.
- Mantenere allineate configurazioni Foorm, modelli, policy e migrazioni quando si aggiunge una nuova entità.
- Le candidature dipendono sia da `CandidatureController` sia da `config/fe/candidatura.php`; modificare uno step richiede controllo di validazione, viste e Foorm.
- Le pagine pubbliche filtrano spesso per `attivo`, `homepage`, `evidenza` e date: controllare questi campi prima di diagnosticare contenuti "mancanti".
- Le API autenticate usano Sanctum; le API esterne richiedono anche il ruolo `ApiUser`.
