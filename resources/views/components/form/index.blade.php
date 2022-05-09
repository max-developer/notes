@props([
    'method' => 'GET'
])
@php
    $isMethodHidden = in_array($method, ['PATCH', 'DELETE', 'PUT']);
@endphp
<form {{$attributes->merge(['method' => $isMethodHidden ? 'POST' : $method])}}>
    @if($isMethodHidden)
        @method($method)
    @endif
    @csrf

    {{$slot}}
</form>
