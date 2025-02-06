{{--RESPONSIVE DA VEDERE--}}

<div class="card-wrapper px-0">
    <div class="card rounded card-img">
        <div class="card-body" style="height:120px;">
            <a href="{{$link ?? "#"}}">
                <h3 class="card-title h5 text-primary">{{$title}}</h3>
                <p class="card-text font-serif text-secondary">{{$subtitle}}</p>
            </a>
        </div>
        <div class="img-responsive-wrapper">
            <div class="img-responsive img-responsive-panoramic">
                <a href="{{$link ?? "#"}}">
                    <figure class="img-wrapper">
                        <img src="{!! $img !!}"
                             title="{{$title}}" alt="{{$title}}">
                    </figure>
                </a>
            </div>
        </div>
    </div>
</div>
