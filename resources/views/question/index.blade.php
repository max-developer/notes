@extends('layouts.app')

@section('title', __('Questions: List'))

@section('content')
    <h1 class="mb-3">{{ __('Questions') }}</h1>

    <div class="row">
        <div class="col">
            <x-button.link route="questions.create" :label="__('Add')"/>
        </div>
        <div class="col">
            @include('question._search')
        </div>
    </div>

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
                <td>
                    {{$question->name}}
                    @if($question->notes_count > 0)
                        <div>
                            Заметок:
                            <span class="badge bg-success rounded-pill">{{$question->notes_count}}</span>
                        </div>
                    @endif
                </td>
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

    <x-pagination :items="$questions->withQueryString()"/>
    Total: {{$questions->total()}}

@endsection
