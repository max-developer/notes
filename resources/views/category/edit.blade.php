@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Edit') }}</h1>

    @include('category._form', [
        'method' => 'PATCH',
        'url' => route('categories.update', $category),
        'submitText' => __('Save'),
    ])
@endsection


