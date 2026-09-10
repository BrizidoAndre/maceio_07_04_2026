<x-layout>
    <h1>Create</h1>
    <x-form method="post" action="{{route('store')}}">
        <x-field name="id">Dialogue ID</x-field>
        <div class="mb-3">
            <label for="tag_id" class="form-label">Tag</label>
            <select name="tag_id" id="tag_id" class="form-select">
                @foreach(\App\Models\Tag::pluck('title', 'id') as $id=> $tag)
                    <option value="{{$id}}">{{$tag}}</option>
                @endforeach
            </select>
        </div>
        <x-field name="protagonist_name">Protagonist name</x-field>
        <x-field name="notes">Notes</x-field>
        <button class="btn btn-primary">Create</button>
    </x-form>
</x-layout>
