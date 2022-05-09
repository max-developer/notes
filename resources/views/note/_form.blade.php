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
    <div class="form-group" x-data="SelectQuestion(@js($note->questions))">
        <input type="hidden" name="questions"/>
        <label>{{__('Questions')}}</label>
        <div class="row mb-1">
            <div class="col-6">
                <input @class(['form-control']) x-model="temp" x-on:keyup="search()"/>
                <div class="list-group">
                    <template x-for="question in questions">
                        <button type="button" class="list-group-item list-group-item-action"
                                x-on:click="select(question)"
                                x-text="question.name"></button>
                    </template>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="list-group">
                    <template x-for="question in selected">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <template x-if="!deleted.includes(question.id)">
                                <input type="hidden" name="questions[]" x-bind:value="question.id"/>
                            </template>
                            <span x-text="question.name"></span>
                            <div class="btn-group btn-group-sm">
                                <template x-if="!deleted.includes(question.id)">
                                    <button type="button" class="btn btn-outline-danger"
                                            x-on:click="remove(question.id)">
                                        Remove
                                    </button>
                                </template>
                                <template x-if="deleted.includes(question.id)">
                                    <button type="button" class="btn btn-outline-danger"
                                            x-on:click="forceRemove(question.id)">Remove
                                    </button>
                                </template>
                                <template x-if="deleted.includes(question.id)">
                                    <button type="button" class="btn btn-outline-success"
                                            x-on:click="restore(question.id)">
                                        Restore
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group mt-3">
        <x-form.submit :value="$submitText ?? __('Save')"/>
        <x-button.link route="notes.index" :label="__('Back')" append />
    </div>
</x-form>

@push('scripts')
    <script src="{{asset('js/simplemde.js')}}"></script>
    <script>
        const SelectQuestion = (selected) => ({
            temp: '',
            questions: [],
            deleted: [],
            selected: selected || [],
            forceRemove(id) {
                this.selected = this.selected.filter(q => q.id !== id);
                this.restore(id);
            },
            restore(id) {
                this.deleted = this.deleted.filter(i => i !== id);
            },
            remove(id) {
                this.deleted.push(id);
            },
            select(question) {
                this.selected.push(question);
                this.questions = this.filterNotSelected(this.questions);
            },
            search() {
                if (this.temp) {
                    axios.get(`/api/questions?term=${this.temp}`).then(resp => {
                        this.questions = this.filterNotSelected(resp.data.data);
                    });
                } else {
                    this.questions = [];
                }
            },
            inSelected(id) {
                return this.selected.map(q => q.id).includes(id)
            },
            filterNotSelected(questions) {
                return questions.filter(q => !this.inSelected(q.id));
            }
        });
    </script>
@endpush

