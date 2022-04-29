<div class="col-lg-20 col-20 text-center">
    {{-- <nav aria-label="..." class="text-center"> --}}
        <ul class="movie-paginate justify-content-center">
            @foreach ($elements  as $element)
                @if (is_string($element))
                        <li>
                            <a href="javascript:void()" class="">{{ $element }}</a>
                        </li>
                    @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <a href="javascript:void()" class="">{{ $page }}</a>
                            </li>
                        @else
                            <li >
                                <a href="{{ $url }}" class="">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
                {{-- <!-- Next Page Link -->
                @if ($paginator->hasMorePages())
                <li >
                    <a class="page-link" href="#">Next</a>
                </li>
                @endif --}}
            @endforeach
        </ul>
    {{-- </nav> --}}
</div>

<style>
    ul.movie-paginate li {
        background-color: {{ env("SCRIPT_SECONDARY_COLOR") }};
    }


    ul.movie-paginate li.active {
        background-color: {{ env('SCRIPT_PRIMARY_COLOR', '') }};
    }

</style>