@props([
    'variant' => 'primary',
])
<input {{$attributes->class(['btn', 'btn-' . $variant])->merge(['value' => 'Submit', 'type' => 'submit'])}} />
