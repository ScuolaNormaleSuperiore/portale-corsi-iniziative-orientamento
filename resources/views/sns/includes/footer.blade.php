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
                                        <li><a class="list-item" href="#"
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
                            <strong>Sede di Pisa</strong><br>
                            Piazza dei Cavalieri, 7 - 56125 Pisa
                        </p>
                        <div class="link-list-wrapper">
                            <ul class="footer-list link-list clearfix">
                                <li><a class="list-item" href="mailto:orientamento@sns.it"
                                       title="Invia email a orientamento@sns.it">orientamento@sns.it</a>
                                </li>
                                <li>
                                       +39 050509111
                                </li>
                                <li>
                                    Staff dei corsi id orientamento
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 pb-2">
                        <div class="pb-2">
                            <h4><a href="#" title="Vai alla pagina: Seguici su">Seguici su</a></h4>
                            <ul class="list-inline text-left social">
                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-facebook"></use>
                                        </svg>
                                        <span class="visually-hidden">Facebook</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-instagram"></use>
                                        </svg>
                                        <span class="visually-hidden">Instagram</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-2 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="{{Theme::url('svg/sprites.svg')}}#it-twitter"></use>
                                        </svg>
                                        <span class="visually-hidden">Twitter</span></a>
                                </li>
                            </ul>
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
                <li class="list-inline-item"><a href="#" title="Note Legali">Media policy</a></li>
                <li class="list-inline-item"><a href="#" title="Note Legali">Note legali</a></li>
                <li class="list-inline-item"><a href="#" title="Privacy-Cookies">Privacy policy</a></li>
                <li class="list-inline-item"><a href="#" title="Mappa del sito">Mappa del sito</a></li>
            </ul>
        </div>
    </div>
</footer>