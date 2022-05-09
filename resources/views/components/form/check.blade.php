@props([
    'id',
    'name',
    'label',
    'value',
    'model' => null,
    'inline' => false,
    'type' => 'checkbox',
])

<div @class(['form-check', 'form-switch' => $type === 'switch', 'form-check-inline' => $inline]) >
    <input type="hidden" name="{{$name}}" value="">
    <input {{$attributes
                ->class(['form-check-input', 'is-invalid' => $errors->has($name)])
                ->merge([
                        'checked' => old($name, data_get($model, $name)) === $value,
                        'id' => $id ?? $name,
                        'name' => $name,
                        'value' => $value ?? '',
                        ])}}

           @if($type === 'switch')
               type="checkbox" role="switch"
           @else
               type="{{$type}}"
        @endif
    />

    @isset($label)
        <x-form.label :for="$id ?? $name" class="form-check-label">
            {{$label}}
        </x-form.label>
    @endisset
    <x-form.control.invalid :name="$name"/>
</div>
