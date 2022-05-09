@extends('layouts.app')

@section('content')
    <h1 class="mb-3">{{ __('Question') }}</h1>

    <x-button.link route="questions.create" :label="__('Add')"/>

    <table class="table mt-2">
        <thead>
        <tr>
            <th class="col-1">ID</th>
            <th>{{ __('Name') }}</th>
            <th class="col-2">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td>{{$question->id}}</td>
                <td>{{$question->name}}</td>
                <td>
                    <x-button.link
                        variant="danger"
                        route="questions.destroy"
                        :params="$question"
                        :label="__('Delete')"
                        data-confirm="Are you sure?"
                        data-method="DELETE"
                    />
                    <x-button.link route="questions.edit" :params="$question" :label="__('Edit')"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <x-pagination :items="$questions" />

@endsection
