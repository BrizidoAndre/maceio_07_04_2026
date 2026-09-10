<x-layout>
    <h1>Questions</h1>
    <x-form method="put" action="{{route('node.update', $model)}}">
        @foreach($model->responses as $response)
            <x-field type="hidden" name="{{$response->getKey()}}[id]" value="{{$response->getKey()}}"></x-field>
            <x-field name="{{$response->getKey()}}[answer]" value="{{$response->answer}}">Answer</x-field>
            <x-field name="{{$response->getKey()}}[code_object]" value="{{$response->code_object}}">Code object</x-field>
            <x-field name="{{$response->getKey()}}[code_inventory]" value="{{$response->code_inventory}}">Code inventory</x-field>
            <x-field name="{{$response->getKey()}}[next_node_id]" value="{{$response->next_node_id}}"
                     placeholder="{{$response->next_node_id?:'<null>'}}">Next node id
            </x-field>
        @endforeach
        @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
        @endforeach
        <button class="btn btn-primary">Submit</button>
    </x-form>
</x-layout>
