<footer class="it-footer">
    <div class="it-footer-main">
        <div class="container-fluid">
            <section>
                <div class="row clearfix">
                    <div class="col-sm-12 pt-4">
                            <h4><a href="#">SCOPRI L'ORIENTAMENTO</a></h4>
                    </div>
                </div>
                <div class="row">

                    @foreach ($orientamentoFooterArray as $orientamentoFooterSubArray)
                        @foreach ($orientamentoFooterSubArray as $orientamentoFooterElement)

                            <div class="col-lg-4 col-md-4 col-sm-12 @if($loop->last) pb-4 @else pb-0 @endif">
                                <div class="link-list-wrapper">
                                    <ul class="footer-list link-list clearfix mb-0">
                                        <li><a class="list-item" href="/pagina-orientamento/{{$orientamentoFooterElement->slug_it}}"
                                               title="{{$orientamentoFooterElement->titolo_it}}">{{$orientamentoFooterElement->titolo_it}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        @endforeach
                    @endforeach
                </div>
            </section>
            <section class="py-4 border-white border-top">
                <div class="row">
                    <div class="col-lg-6 col-md-6 pb-2">
                        <h4><a href="#" title="Vai alla pagina: Contatti">Contatti</a></h4>
                        <p>
                            <strong>Scuola Normale Superiore</strong><br>
                            Piazza dei Cavalieri, 7 - 56125 Pisa
                        </p>
                    <p>
                        <strong>Orari uffici</strong><br/>
                        Lun-Ven 9.30-12.30<br/>
                        Lun, Mar, Mer, Gio 14.30-16.30
                    </p>
                        <div class="link-list-wrapper">
                            <ul class="footer-list link-list clearfix">
                                <li><a class="list-item" href="mailto:orientamento@sns.it"
                                       title="Invia email a orientamento@sns.it">orientamento@sns.it</a>
                                </li>
                                <li>
                                    +39 050 50 9307/9670/9057/9493
                                </li>
                                <li>
                                    +39 3316990724
                                </li>
                                <li>
                                    +39 3471092201
                                </li>
{{--                                <li>--}}
{{--                                    Staff dei corsi id orientamento--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 pb-2 d-flex flex-column justify-content-end">
                        <div class="pb-2">
                            <h4><a href="#" title="Vai alla pagina: Segui la Scuola Normale su">Segui la Scuola Normale su</a></h4>
                            <ul class="list-inline text-left social">


                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="https://www.facebook.com/scuolanormale" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-facebook"></use>
                                        </svg>
                                        <span class="visually-hidden">Facebook</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="https://www.instagram.com/scuolanormale" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-instagram"></use>
                                        </svg>
                                        <span class="visually-hidden">Instagram</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="https://www.youtube.com/user/ScuolaNormale" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-youtube"></use>
                                        </svg>
                                        <span class="visually-hidden">Youtube</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="https://www.linkedin.com/school/scuola-normale-superiore/" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-linkedin"></use>
                                        </svg>
                                        <span class="visually-hidden">LinkedIn</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="https://www.twitter.com/scuolanormale/" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-twitter"></use>
                                        </svg>
                                        <span class="visually-hidden">X</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="">
                            <h4><a href="#" title="Iscriviti alla newsletter">Newsletter</a></h4>

                            <div class="row pt-4">
                                <div class="m-auto">
                                    <div class="form-group">
                                        <div class="input-group mb-3 newsletter-form">
                                            <input type="email" required class="form-control"
                                                   placeholder="Inserisci la tua email"
                                                   aria-label="Inserisci la tua email" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="button-3">Iscriviti</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
    <div class="it-footer-small-prints clearfix">
        <div class="container-fluid">
            <!-- <h3 class="visually-hidden">Sezione Link Utili</h3> -->
            <ul class="it-footer-small-prints-list list-inline mb-0 d-flex flex-column flex-md-row">
                <li class="list-inline-item"><a href="/pagina/media-policy" title="Media Policy">Media policy</a></li>
                <li class="list-inline-item"><a href="/pagina/note-legali" title="Note Legali">Note legali</a></li>
                <li class="list-inline-item"><a href="/pagina/privacy-policy" title="Privacy Policy">Privacy policy</a></li>
                <li class="list-inline-item" data-cc="show-preferencesModal"><a href="#">Manage cookie preferences</a></li>
{{--                <li class="list-inline-item"><a href="#" title="Mappa del sito">Mappa del sito</a></li>--}}

            </ul>
        </div>
    </div>
</footer>
