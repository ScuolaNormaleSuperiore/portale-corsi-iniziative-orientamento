
                <nav class="pagination-wrapper justify-content-center" aria-label="Navigazione centrata">
                    <ul class="pagination">
                        @if ($items->previousPageUrl())
                            <li class="page-item">
                                <a class="page-link" href="{{$items->previousPageUrl()}}" tabindex="-1"
                                   aria-hidden="true">
                                    <svg class="icon icon-primary">
                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-left"></use>
                                    </svg>
                                    <span class="visually-hidden">Pagina precedente</span>
                                </a>
                            </li>
                        @endif

                        @if ($items->currentPage() >= 3)

                            <li class="page-item"><a class="page-link" href="{{$items->url(1)}}">1</a></li>
                        @endif
                        @if ($items->currentPage() >= 4)
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        @if ($items->previousPageUrl())
                            <li class="page-item">
                                <a class="page-link" href="{{$items->previousPageUrl()}}">
                                    {{$items->currentPage() - 1}}
                                </a>
                            </li>
                        @endif
                        <li class="page-item active">
                            <a class="page-link" href="{{$items->url($items->currentPage())}}" aria-current="page">
                                <span class="d-inline-block d-sm-none">Pagina </span> {{$items->currentPage()}}
                            </a>
                        </li>
                        @if ($items->nextPageUrl())
                            <li class="page-item">
                                <a class="page-link" href="{{$items->nextPageUrl()}}">
                                    {{$items->currentPage() + 1}}
                                </a>
                            </li>
                        @endif
                        @if (($items->lastPage() > 4 && $items->currentPage() < ($items->lastPage() - 2))
                                            || ($items->lastPage() == 4) && $items->currentPage() == 1)
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                            @if (($items->lastPage() >= 3 && $items->currentPage() < ($items->lastPage() - 1)))



                            <li class="page-item">
                                <a class="page-link" href="{{$items->url($items->lastPage())}}">
                                    {{$items->lastPage()}}
                                </a>
                            </li>
                        @endif

                        @if ($items->nextPageUrl())
                            <li class="page-item">
                                <a class="page-link" href="{{$items->nextPageUrl()}}">
                                    <span class="visually-hidden">Pagina successiva</span>
                                    <svg class="icon icon-primary">
                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-right"></use>
                                    </svg>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>

