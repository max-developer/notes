@props([
    'id',
    'name',
    'label',
    'model' => null,
    'list' => [],
    'placeholder' => null,
])

@isset($label)
    <x-form.label :for="$id ?? $name">{{$label}}</x-form.label>
@endisset

<select {{$attributes
            ->class(['form-select', 'is-invalid' => $errors->has($name)])
            ->merge(['id' => $id ?? $name, 'name' => $name])}}>
    @if($placeholder)
    <option value="">{{$placeholder}}</option>
    @endif
    @if(count($list))
        @foreach($list as $key => $value)
            <option value="{{$key}}" @if(old($name, data_get($model, $name)) == $key)selected @endif >{{$value}}</option>
        @endforeach
    @else
        {{$slot}}
    @endif
</select>

<x-form.control.invalid :name="$id ?? $name" />
