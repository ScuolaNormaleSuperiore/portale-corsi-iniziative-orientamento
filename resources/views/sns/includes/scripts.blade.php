{!!  Theme::js('js/bootstrap-italia.bundle.min.js') !!}
{!!  Theme::js('js/axios.min.js') !!}
{!!  Theme::js('js/cookieconsent.umd.js') !!}

<script>

    {{--let newsletterAdded = "{{request()->get('newsletterconfirmed')}}";--}}

    {{--document.addEventListener("DOMContentLoaded", function() {--}}
    {{--    // if (parseInt(newsletterAdded) === 1) {--}}
    {{--        triggerNotification('not-newsletter-success-doi');--}}
    {{--    // }--}}
    {{--});--}}

    window.addEventListener('load', function () {
        document.querySelectorAll('.newsletter-form')
            .forEach(function (node) {
                var button = node.querySelector('button');
                button.addEventListener('click', function () {
                    var input = node.querySelector('input');
                    var valid = input.checkValidity();
                    console.log("VALID::: ",valid);
                    if (valid) {
                        newsletterIn(input.value);
                    } else {
                        triggerNotificationMsg('Inserisci un indirizzo e-mail valido','not-newsletter-error');
                    };
                })
            })

        // const myToastEl = document.querySelector('#not-newsletter-error')
        // console.log("NOT:::",myToastEl);
        // myToastEl.addEventListener('hidden.bs.notification', () => {
        //     alert('herenot');
        //     // do something...
        // })

        CookieConsent.run({

            categories: {
                necessary: {
                    enabled: true,  // this category is enabled by default
                    readOnly: true  // this category cannot be disabled
                },
                analytics: {
                    readOnly: false,
                    enabled: false,
                    services: {
                        youtube: {
                            label: 'Google Youtube',
                            onAccept: () => {
                                bootstrap.cookies.rememberChoice('youtube.com',true);
                                // enable ga
                            },
                            onReject: () => {
                                alert('here');
                                    bootstrap.cookies.rememberChoice('youtube.com',false);
                                // disable ga
                            },
                            cookies: [
                                {
                                    name: /^(youtube)/
                                }
                            ]
                        },
                    }
                }
            },

            language: {
                default: 'en',
                translations: {
                    en: {
                        consentModal: {
                            title: '',
                            description: 'Questo sito fa uso di cookie tecnici essenziali al corretto funzionamento delle pagine web, di cookie di analisi e misurazione e di cookie di terze parti.'+
                                '<br/>Selezionando "Accetta tutti i cookie" si acconsente all\'utilizzo di tutti i cookie.'+
                            '<br/>Selezionando "Rifiuta tutti i cookie" o chiudendo il banner verranno utilizzati solo i cookie tecnici: così facendo alcune funzionalità ed alcuni contenuti potrebbero non essere disponibili.'+
            '<br/>La preferenza può essere modificata in qualsiasi momento dall\'Informativa cookie.',
                            acceptAllBtn: 'Accetta tutti',
                            acceptNecessaryBtn: 'Rifiuta tutti',
                            showPreferencesBtn: 'Personalizza i Cookie'
                        },
                        preferencesModal: {
                            title: 'Personalizza le preferenze sui cookie',
                            acceptAllBtn: 'Accetta tutti',
                            acceptNecessaryBtn: 'Rifiuta tutti',
                            savePreferencesBtn: 'Accetta la selezione attuale',
                            closeIconLabel: 'Chiudi',
                            sections: [
                                {
                                    title: 'Informazioni e preferenze sui cookie',
                                    description: 'I cookie sono piccoli file di testo che i siti web visitati inviano al device dell\'utente, dove vengono memorizzati per raccogliere informazioni attraverso il browser, per essere poi ritrasmessi agli stessi siti nelle visite successive.'+
                                        'Sono utilizzati essenzialmente per misurare e migliorare la qualità dei siti attraverso l\'analisi del comportamento dei visitatori.',
                                },
                                {
                                    title: 'Cookie strettamente necessari',
                                    description: 'Questi cookies sono essenziali per il corretto funzionamento del portale e non possono essere disabilitati.',

                                    //this field will generate a toggle linked to the 'necessary' category
                                    linkedCategory: 'necessary'
                                },
                                {
                                    title: 'Cookie facoltativi',
                                    description: 'Questi cookie di terze parti collezionano dati riguardo al tuo utilizzo del portale. Tutti i dati sono anonimizzati e non possono essere usati per identificarti.',
                                    linkedCategory: 'analytics'
                                },
                                {
                                    title: 'Ulteriori informazioni',
                                    description: 'Per ogni ulteriore infomrazione riguardo alle nostre cookie e privacy policy fai riferimento alla nostra <a href="/pagina/privacy-policy">pagina dedicata</a>.'
                                }
                            ]
                        }
                    }
                }
            }
        });
    })


    function newsletterIn(email) {

        axios.post('/api/newsletter/add', {
            email: email,
        })
            .then(function (response) {
                // console.log("RESPONSE" ,response);
                // var data = response.data;
                triggerNotification('not-newsletter-success');
            })
            .catch(function (error) {
                var data = error.response.data;
                // console.log(error.response.data);
                var msg = "Ci sono stati dei problemi con l'inserimento della tua email";
                if (data && data.msg) {
                   msg = data.msg;
                }
                triggerNotificationMsg(msg,'not-newsletter-error');
                // console.log(error);
            });

    }


    function triggerNotificationMsg(msg,notificationId,timeout) {
        var notificationDOM = document.querySelector('#'+notificationId);
        notificationDOM.querySelector('p').innerText = msg;
        triggerNotification(notificationId,timeout);
    }
    function triggerNotification(notificationId,timeout) {
        const myNotification = new bootstrap.Notification(document.getElementById(notificationId), {
            timeout: (timeout ? timeout : 3000),

        })
        myNotification.show();
    }
</script>

<style>

#cc-main {
/** Change font **/
--cc-font-family: "Titillium Web";

/** Change button primary color to black **/
--cc-btn-primary-bg: #005a73;
--cc-btn-primary-border-color: #005a73;
--cc-btn-primary-hover-bg: rgba(0, 90, 115, 0.85);
--cc-btn-primary-hover-border-color: rgba(0, 90, 115, 0.85);

/** Also make toggles the same color as the button **/
--cc-toggle-on-bg: var(--cc-btn-primary-bg);

/** Make the buttons a bit rounder **/
--cc-btn-border-radius: 10px;
}
</style>

@yield('extra-scripts')
