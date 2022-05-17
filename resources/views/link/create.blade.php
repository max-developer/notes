@extends('layouts.app')

@section('title', __('Links: Create'))

@section('content')
    <h1 class="mb-5">{{ __('Create') }}</h1>

    @include('link._form', [
        'url' => route('links.store'),
        'submitText' => __('Create')
    ])
@endsection


