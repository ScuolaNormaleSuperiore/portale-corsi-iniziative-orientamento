<div class="card card-bg rounded card-teaser bg-white card-orientamento"
     style="border-top: 3px solid #005A74;">
    <div class="card-body">
        <h5 class="card-title h5 text-primary">{{$pagina->titolo_it ?: $pagina->nome_it }}</h5>
        <p class="card-text font-sans-serif">
            <a href="/{{isset($baselink) ? $baselink : 'pagina-orientamento'}}/{{$pagina->id}}" class="fw-semibold">
                Scopri di più
                <svg class="icon icon-primary icon-sm">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                </svg>
            </a>
        </p>
    </div>
</div>