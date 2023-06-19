@if ($paginator->hasPages())

    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"> <i class="w-4 h-4" data-lucide="chevron-left"></i> </a>
                    </li>
                @else
                    <li class="page-item ">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"> <i class="w-4 h-4" data-lucide="chevron-left"></i> </a>
                    </li>
                @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled"> <a class="page-link" href="#">{{ $element }}</a> </li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                     <li class="page-item active">
                                         <a class="page-link" href="#">{{ $page }}</a>
                                     </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                        </li>
                    @endif

            </ul>
        </nav>
    </div>
    <!-- END: Pagination -->
@endif
