<x-form :action="$url" :method="$method ?? 'POST'">
    <div class="form-group">
        <x-form.control :model="$link" name="name" :label="__('Name')"/>
    </div>
    <div class="form-group">
        <x-form.control :model="$link" name="url" :label="__('Url')"/>
    </div>
    <div class="form-group mt-3">
        <x-form.submit :value="$submitText ?? __('Save')"/>
        <x-button.link route="links.index" :label="__('Back')" append/>
    </div>
</x-form>
