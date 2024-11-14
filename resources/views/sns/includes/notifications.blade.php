{{--NOTIFICHE NEWSLETTER--}}
<div class="container test-desktop">
    <div class="notification with-icon success" role="alert" aria-labelledby="not-newsletter-success-title"
         id="not-newsletter-success">
        <h2 id="not-newsletter-success-title" class="h5 ">
            <svg class="icon">
                <use href="{{Theme::url('svg/sprites.svg')}}#it-check-circle"></use>
            </svg>
            Inserimento newsletter
        </h2>
        <p>Il tuo indirizzo email è stato aggiunto alla nostra newsletter</p>
    </div>
    <div class="notification with-icon error" role="alert" aria-labelledby="not-newsletter-error-title"
         id="not-newsletter-error">
        <h2 id="not-newsletter-error-title" class="h5 ">
            <svg class="icon">
                <use href="{{Theme::url('svg/sprites.svg')}}#it-close-circle"></use>
            </svg>
            Inserimento newsletter
        </h2>
        <p></p>
    </div>
</div>