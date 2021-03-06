@extends('layouts.app')

@section('title', __('Notes: Edit'))

@section('content')
    <h1 class="mb-5">{{ __('Edit') }}</h1>

    @include('note._form', [
        'method' => 'PATCH',
        'url' => route('notes.update', [$note, ...(array)request()->query()]),
        'submitText' => __('Save'),
    ])
@endsection


