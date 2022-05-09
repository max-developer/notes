@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Edit') }}</h1>

    @include('question._form', [
        'method' => 'PATCH',
        'url' => route('questions.update', $question),
        'submitText' => __('Save'),
    ])
@endsection


