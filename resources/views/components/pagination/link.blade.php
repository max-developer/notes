@props([
    'url',
    'label',
    'disabled' => false,
    'active' => false,
])
<li {{$attributes->class(['page-item', 'disabled' => $disabled, 'active' => $active])}}>
    @if($active || $disabled)
        <span class="page-link">{{$label ?? $slot}}</span>
    @else
        <a class="page-link" href="{{$url}}">{{$label ?? $slot}}</a>
    @endif
</li>
