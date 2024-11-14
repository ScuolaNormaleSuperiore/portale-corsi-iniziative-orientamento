{!!  Theme::js('js/bootstrap-italia.bundle.min.js') !!}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

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
                        triggerNotification('not-newsletter-error','Inserisci un indirizzo e-mail valido');
                    };
                })
            })
    })

    function newsletterIn(email) {

        axios.post('/api/newsletter/add', {
            email: email,
        })
            .then(function (response) {
                triggerNotification('not-newsletter-success');
            })
            .catch(function (error) {
                triggerNotification('not-newsletter-error');
                // console.log(error);
            });

    }

    function triggerNotification(notificationId,msg,timeout) {
        if (!timeout) {
            timeout = 3000;
        }
        if (!msg) {
            msg = "Ci sono stati dei problemi con l'inserimento della tua email";
        }
        var notificationDOM = document.querySelector('#'+notificationId);
        notificationDOM.querySelector('p').innerText = msg;
        const myNotification = new bootstrap.Notification(document.getElementById(notificationId), {
            timeout: 3000
        })
        myNotification.show();
    }
</script>