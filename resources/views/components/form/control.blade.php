@props([
    'id',
    'name',
    'label',
    'model' => null,
    'type' => 'text',
])

@isset($label)
    <x-form.label :for="$id ?? $name">{{$label}}</x-form.label>
@endisset

@if($type === 'textarea')
    <textarea {{$attributes
            ->class(['form-control', 'is-invalid' => $errors->has($name)])
            ->merge(['id' => $id ?? $name, 'name' => $name])}}
    >{{old($name, data_get($model, $name))}}</textarea>
@else
    <input {{$attributes
            ->class(['form-control', 'is-invalid' => $errors->has($name)])
            ->merge([
                'id' => $id ?? $name,
                'name' => $name,
                'type' => $type,
                'value' => old($name, data_get($model, $name)),
                ])}}
    />
@endif

<x-form.control.invalid :name="$name"/>
