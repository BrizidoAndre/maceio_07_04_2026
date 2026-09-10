<x-layout>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Dialogs</h1>
        <a href="{{route('create')}}" class="btn btn-primary">Create</a>
    </div>
    <x-form>
        <label class="form-label" for="tag_id">Tag</label>
        <select class="form-select" name="tag_id" id="tag_id">
            <option value=""></option>
            @foreach(\App\Models\Tag::all() as $tag)
                <option
                    @selected(old('tag_id', $tag->getKeyName()) == $tag->getKey()) value="{{$tag->getKey()}}">{{$tag->title}}</option>
            @endforeach
        </select>
        <button class="mt-1 btn btn-secondary">Search</button>
    </x-form>
    <table class="table">
        <thead>
        <tr>
            <th>Dialogue ID</th>
            <th>Nodes attached</th>
            <th>Tag</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dialogs as $dialog)
            <tr>
                <td>{{$dialog->getKey()}}</td>
                <td>{{1}}</td>
                <td>{{$dialog->tag->title}}</td>
                <td class="d-flex gap-2">
                    <a href="{{route('edit', $dialog)}}" class="btn btn-secondary">Modify</a>
                    <a href="{{route('node.update', $dialog->node)}}" class="btn btn-primary">Nodes</a>
                    <x-form method="delete" action="{{route('destroy', ['dialog' =>$dialog->getKey()])}}"
                            onsubmit="return window.confirm('Are you sure?')">
                        <button class="btn btn-danger">Delete</button>
                    </x-form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
