@extends('layouts.app')

@section('title', __('Notes: List'))

@section('content')
    <h1 class="mb-3">{{ __('Notes') }}</h1>

    <div class="row mb-2">
        <div class="col">
            <x-button.link route="notes.create" :label="__('Add')" append/>
        </div>
        <div class="col">
            @include('note._search')
        </div>
    </div>

    <div class="row">
        <div class="col">
            @foreach($notes as $note)
                <div class="shadow-sm p-3 mb-2 bg-white rounded row">
                    <div class="col">
                        @markdown($note->content)

                        <x-block-list :items="$note->questions"
                                      :label="__('Questions')"
                                      :url-render="fn($item) => route('questions.index', ['id' => $item->id])"/>

                        <x-block-list :items="$note->links"
                                      :label="__('Links')"
                                      :url-render="fn($item) => $item->url"
                                      target="_blank"/>
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
                        <x-button.link route="notes.edit" :params="$note" :label="__('Edit')" append/>
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

    <x-pagination :items="$notes->withQueryString()"/>

@endsection

@push('scripts')
    <script src="{{asset('js/highlight.js')}}"></script>
@endpush
