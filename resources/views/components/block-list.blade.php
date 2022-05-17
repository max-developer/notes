@props([
     'urlClass' => [],
    'items' => [],
    'label',
    'urlRender' => fn($item) => null,
    'nameRender' => fn($item) => $item->name,
])

@if(count($items) > 0)
    <hr/>
    <h6>{{$label}}</h6>
    <ul>
        @foreach($items as $item)
            <li>
                <a href="{{$urlRender($item)}}" {{$attributes->class(['text-decoration-underline'])}} >
                    {{$nameRender($item)}}
                </a>
            </li>
        @endforeach
    </ul>
@endif
