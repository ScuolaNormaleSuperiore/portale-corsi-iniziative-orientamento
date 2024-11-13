<section class="pb-5 mb-5 px-2 ps-4" style="background-color:#F4FAFB">
    <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $bTitle => $bLink)
                @if ($loop->last)
                    @php $pTitle = $bTitle; @endphp
                    <li class="breadcrumb-item active">{{$bTitle}}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{$bLink}}">{{$bTitle}}</a><span class="separator">/</span></li>
                @endif
            @endforeach
        </ol>
    </nav>

    <h2 class="h2 text-primary">{{$pTitle}}</h2>
</section>