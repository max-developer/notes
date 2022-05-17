@extends('layouts.app')

@section('title', __('Links: List'))

@section('content')
    <h1 class="mb-3">{{ __('Link') }}</h1>

    <x-button.link route="links.create" :label="__('Add')"/>

    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th class="col-2">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($links as $link)
            <tr>
                <td>
                    <a href="{{$link->url}}" target="_blank">
                        {{$link->name ?: $link->url}}
                    </a>
                </td>
                <td>
                    <x-button.link
                        variant="danger"
                        route="links.destroy"
                        :params="$link"
                        :label="__('Delete')"
                        data-confirm="Are you sure?"
                        data-method="DELETE"
                    />
                    <x-button.link route="links.edit" :params="$link" :label="__('Edit')" append/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <x-pagination :items="$links->withQueryString()" />

@endsection
