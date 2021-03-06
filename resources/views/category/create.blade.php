@extends('layouts.app')

@section('title', __('Categories: Add'))

@section('content')
    <h1 class="mb-5">{{ __('Create') }}</h1>

    @include('category._form', [
        'url' => route('categories.store'),
        'submitText' => __('Create')
    ])
@endsection


