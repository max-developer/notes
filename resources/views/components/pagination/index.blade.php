@props([
    'items',
    'template' => 'prev,first,range,last,next'
])
@if($items->hasPages())
    @php
        $startPage = $items->currentPage() - 1;
        if ($startPage === 0) {
            $startPage = 1;
        }
        $endPage = $items->currentPage() + 1;
        if ($endPage > $items->lastPage()) {
            $endPage = $items->lastPage();
        }
    @endphp
    <nav {{$attributes}}>
        <ul class="pagination">
            @section('component.pagination.prev')
                <x-pagination.link :disabled="!$items->previousPageUrl()"
                                   :url="$items->previousPageUrl()"
                                   :label="__('Prev')"/>
            @endsection

            @section('component.pagination.first')
                <x-pagination.link :disabled="$items->currentPage() === 1"
                                   :url="$items->url(1)"
                                   :label="__('First')"/>
            @endsection

            @section('component.pagination.last')
                <x-pagination.link :disabled="$items->currentPage() >= $items->lastPage()"
                                   :url="$items->url($items->lastPage())"
                                   :label="__('Last')"/>
            @endsection

            @section('component.pagination.next')
                <x-pagination.link :disabled="!$items->nextPageUrl()"
                                   :url="$items->nextPageUrl()"
                                   :label="__('Next')"/>
            @endsection

            @section('component.pagination.range')
                @foreach($items->getUrlRange($startPage, $endPage) as $page => $url)
                    <x-pagination.link :active="$items->currentPage() === $page" :url="$url" :label="$page"/>
                @endforeach
            @endsection

            @foreach(explode(',', $template) as $tag)
                @yield(sprintf('component.pagination.%s', trim($tag)))
            @endforeach
        </ul>
    </nav>
@endif

