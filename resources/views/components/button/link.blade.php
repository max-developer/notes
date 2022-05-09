@props([
    'route',
    'label',
    'append' => false,
    'variant' => 'primary',
    'params' => [],
])

@php
    $params = is_array($params) ? $params : [$params];
    if ($append) {
        $params = array_merge((array)request()->query(), $params);
    }
@endphp

<a {{$attributes
            ->class(['btn', 'btn-' . $variant])
            ->merge(['href' => route($route, $params)])}}>
    @if($label ?? false)
        {{$label}}
    @else
        {{$slot}}
    @endif
</a>
