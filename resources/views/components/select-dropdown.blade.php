@props([
    'apiUrl',
    'items' => [],
    'label',
    'name',
])

<div {{$attributes}} x-data="SelectDropdown('{{$apiUrl}}', @js($items))">
    <input type="hidden" name="{{$name}}"/>
    <label>{{$label}}</label>
    <div class="list-group mb-1">
        <template x-for="item in selected">
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <template x-if="!deleted.includes(item.id)">
                    <input type="hidden" name="{{$name}}[]" x-bind:value="item.id"/>
                </template>
                <span x-text="item.name"></span>
                <div class="btn-group btn-group-sm">
                    <template x-if="!deleted.includes(item.id)">
                        <button type="button"
                                class="btn btn-outline-danger"
                                x-on:click="remove(item.id)">Remove</button>
                    </template>
                    <template x-if="deleted.includes(item.id)">
                        <button type="button"
                                class="btn btn-outline-danger"
                                x-on:click="forceRemove(item.id)">Remove</button>
                    </template>
                    <template x-if="deleted.includes(item.id)">
                        <button type="button"
                                class="btn btn-outline-success"
                                x-on:click="restore(item.id)">Restore</button>
                    </template>
                </div>
            </div>
        </template>
    </div>
    <input @class(['form-control']) x-model="temp" x-on:keyup="search()"/>
    <div class="list-group mt-1">
        <template x-for="item in items">
            <button type="button" class="list-group-item list-group-item-action"
                    x-on:click="select(item)"
                    x-text="item.name"></button>
        </template>
    </div>
</div>

@once
    @push('scripts')
        <script>
            const SelectDropdown = (apiUrl, selected) => ({
                temp: '',
                items: [],
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
                select(item) {
                    this.selected.push(item);
                    this.items = this.filterNotSelected(this.items);
                },
                search() {
                    if (this.temp) {
                        axios.get(`${apiUrl}?term=${this.temp}`).then(resp => {
                            this.items = this.filterNotSelected(resp.data.data);
                        });
                    } else {
                        this.items = [];
                    }
                },
                inSelected(id) {
                    return this.selected.map(q => q.id).includes(id)
                },
                filterNotSelected(items) {
                    return items.filter(q => !this.inSelected(q.id));
                }
            });
        </script>
    @endpush
@endonce
