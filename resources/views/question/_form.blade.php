<x-form :action="$url" :method="$method ?? 'POST'">
    <div class="form-group">
        <x-form.control :model="$question" name="name" type="textarea" :label="__('Name')"/>
    </div>
    <div class="form-group">
        <x-form.control :model="$question" name="content" type="textarea" rows="15" :label="__('Content')"
                        class="simple-mde"/>
    </div>
    <div class="form-group mt-3">
        <x-form.submit :value="$submitText ?? __('Save')"/>
        <x-button.link route="questions.index" :label="__('Back')" append />
    </div>
</x-form>

@push('scripts')
    <script src="{{asset('js/simplemde.js')}}"></script>
@endpush
