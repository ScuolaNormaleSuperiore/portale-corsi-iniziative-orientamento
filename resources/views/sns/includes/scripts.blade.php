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
                        triggerNotificationMsg('Inserisci un indirizzo e-mail valido','not-newsletter-error');
                    };
                })
            })
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