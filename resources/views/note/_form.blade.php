@inject('categoryService', "App\Services\CategoryService")
<x-form :action="$url" :method="$method ?? 'POST'">
    <div class="form-group">
        <x-form.select :model="$note" name="category_id" :label="__('Category')"
                       :list="$categoryService->listOptions()"
                       :placeholder="__('Select category...')"/>
    </div>
    <div class="form-group">
        <x-form.control :model="$note" type="textarea" rows="20" name="content" :label="__('Content')"
                        class="simple-mde"/>
    </div>
    <div class="form-group col-6">
        <x-select-dropdown :label="__('Questions')"
                           name="questions"
                           :items="$note->questions"
                           api-url="/api/questions"/>
    </div>
    <div class="form-group col-6">
        <x-select-dropdown :label="__('Links')"
                           name="links"
                           :items="$note->links"
                           api-url="/api/links"/>
    </div>
    <div class="form-group mt-3">
        <x-form.submit :value="$submitText ?? __('Save')"/>
        <x-button.link route="notes.index" :label="__('Back')" append/>
    </div>
</x-form>

@push('scripts')
    <script src="{{asset('js/simplemde.js')}}"></script>
@endpush

