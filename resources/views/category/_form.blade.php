<x-form :action="$url" :method="$method ?? 'POST'">
    <div class="form-group">
        <x-form.control :model="$category" name="name" :label="__('Name')"/>
    </div>
    <div class="form-group mt-3">
        <x-form.submit :value="$submitText ?? __('Save')"/>
    </div>
</x-form>
