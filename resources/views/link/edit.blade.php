@extends('layouts.app')

@section('title', __('Links: Edit'))

@section('content')
    <h1 class="mb-5">{{ __('Edit') }}</h1>

    @include('link._form', [
        'method' => 'PATCH',
        'url' => route('links.update', $link),
        'submitText' => __('Save'),
    ])
@endsection


