@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Create') }}</h1>

    @include('question._form', [
        'url' => route('questions.store'),
        'submitText' => __('Create')
    ])
@endsection
