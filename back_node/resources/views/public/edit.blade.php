<x-layout>
    <h1>Update</h1>
    <x-form method="put" action="{{route('edit', $model)}}">
        <x-field value="{{$model->id}}" name="id">Dialogue ID</x-field>
        <div class="mb-3">
            <label for="tag_id" class="form-label">Tag</label>
            <select name="tag_id" id="tag_id" class="form-select">
                @foreach(\App\Models\Tag::pluck('title', 'id') as $id=> $tag)
                    <option @checked($id === $model->tag_id) value="{{$id}}">{{$tag}}</option>
                @endforeach
            </select>
        </div>
        <x-field value="{{$model->protagonist_name}}" name="protagonist_name">Protagonist name</x-field>
        <x-field value="{{$model->notes}}" name="notes">Notes</x-field>
        <button class="btn btn-primary">Update</button>
    </x-form>
</x-layout>
