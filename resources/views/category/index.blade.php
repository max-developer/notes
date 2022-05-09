@extends('layouts.app')

@section('content')
    <h1 class="mb-3">{{ __('Category') }}</h1>

    <x-button.link route="categories.create" :label="__('Add')"/>

    <table class="table mt-2">
        <thead>
        <tr>
            <th class="col-1">ID</th>
            <th>{{ __('Name') }}</th>
            <th class="col-2">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <x-button.link
                        variant="danger"
                        route="categories.destroy"
                        :params="$category"
                        :label="__('Delete')"
                        data-confirm="Are you sure?"
                        data-method="DELETE"
                    />
                    <x-button.link route="categories.edit" :params="$category" :label="__('Edit')"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
