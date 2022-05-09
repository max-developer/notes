@extends('layouts.app')

@section('content')
    <h1 class="mb-3">{{ __('Note') }}</h1>

    <div class="mb-2">
        <x-button.link route="notes.create" :label="__('Add')" append />
    </div>

    <div class="row">
        <div class="col">
            @foreach($notes as $note)
                <div class="shadow-sm p-3 mb-2 bg-white rounded row">
                    <div class="col">
                        @markdown($note->content)
                    </div>
                    <div class="col-2">
                        <x-button.link
                            variant="danger"
                            route="notes.destroy"
                            :params="$note"
                            :label="__('Delete')"
                            data-confirm="Are you sure?"
                            data-method="DELETE"
                            append
                        />
                        <x-button.link route="notes.edit" :params="$note" :label="__('Edit')"  append />
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-3">
            @inject('categoryService', 'App\\Services\\CategoryService')
            <div class="list-group">
                @foreach($categoryService->getAllWithCount() as $category)
                    <a href="{{route('notes.index', ['category_id' => $category->id])}}"
                        @class(['list-group-item d-flex justify-content-between align-items-center text-decoration-none', 'list-group-item-warning' => request()->query('category_id') == $category->id])>
                        {{$category->name}}
                        @if($category->notes_count > 0)
                            <span class="badge bg-success rounded-pill">{{$category->notes_count}}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@endsection
