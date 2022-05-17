<x-form :action="route('questions.index')"
        class="row row-cols-auto d-flex justify-content-end">
    <div class="col">
        <x-form.control :model="$filter" name="search" :placeholder="__('Search...')"/>
    </div>
    <div class="col">
        <x-form.select :model="$filter" name="notes_count"
                       :placeholder="__('Select notes count...')"
                       :list="['y' => 'Есть заметки', 'n' => 'Нет заметок']"/>
    </div>
    <div class="col">
        <x-form.submit variant="outline-primary" :value="__('Search')"/>
        <x-button.link variant="outline-info" :label="__('Reset')" route="questions.index"/>
    </div>
</x-form>
