@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Create') }}</h1>

    @include('note._form', [
        'url' => route('notes.store', request()->query()),
        'submitText' => __('Create')
    ])
@endsection


