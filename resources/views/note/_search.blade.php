<x-form :action="route('notes.index')"
        class="row row-cols-auto d-flex justify-content-end">
    @isset($filter['category_id'])
        <input name="category_id" type="hidden" value="{{ $filter['category_id'] }}"/>
    @endisset
    <div class="col">
        <x-form.control :model="$filter" name="search" :placeholder="__('Search...')"/>
    </div>
    <div class="col">
        <x-form.submit variant="outline-primary" :value="__('Search')"/>
        <x-button.link variant="outline-info" :label="__('Reset')" route="notes.index"/>
    </div>
</x-form>
