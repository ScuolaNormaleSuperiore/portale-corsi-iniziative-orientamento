<div class="card card-bg rounded card-teaser bg-white card-orientamento"
     style="border-top: 3px solid #005A74;">
    <div class="card-body">
        <h3 class="card-title h5 text-primary">{{$pagina->titolo_it ?: $pagina->nome_it }}</h3>
        <p class="card-text font-sans-serif">
            <a href="/{{$baselink ?? 'pagina-orientamento'}}/{{isset($routefield) ? $pagina->$routefield : $pagina->slug_it}}" class="fw-semibold">
                Scopri di più
                <svg class="icon icon-primary icon-sm">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                </svg>
            </a>
        </p>
    </div>
</div>