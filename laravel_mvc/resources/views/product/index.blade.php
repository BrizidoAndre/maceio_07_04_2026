<x-layout>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Products</h1>
        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="btn btn-primary">New
            product
        </button>
    </div>
    <div class="modal open fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <x-form action="{{route('products.store')}}" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="create-modal-title">Create Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-field name="name">Name</x-field>
                        <x-field name="price" type="number">Price</x-field>
                        <x-field-area name="description">Description</x-field-area>
                        <x-field-image name="photo" type="photo">Photo</x-field-image>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    @foreach($errors->all() as $error)
                        <p class="text-danger">{{$error}}</p>
                    @endforeach
                </x-form>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Product::all() as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td><img width="120px" src="{{asset('imgs/'.$product->photo)}}" alt=""></td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#update-modal-{{$product->getKey()}}"
                            class="btn btn-secondary">Update
                    </button>
                    <div class="modal open fade" id="update-modal-{{$product->getKey()}}" tabindex="-1"
                         aria-labelledby="update-modal-title"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <x-form action="{{route('products.update', $product)}}" method="put">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="create-modal-title">Create Product</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <x-field name="name" value="{{$product->name}}">Name</x-field>
                                        <x-field name="price" value="{{$product->price}}" type="number">Price</x-field>
                                        <x-field-area name="description" value="{{$product->description}}">Description
                                        </x-field-area>
                                        <x-field-image name="photo" type="photo">Photo</x-field-image>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    @foreach($errors->all() as $error)
                                        <p class="text-danger">{{$error}}</p>
                                    @endforeach
                                </x-form>
                            </div>
                        </div>
                    </div>
                    <a onclick="return window.confirm('Are you sure you want to delete?')"
                       href="{{route('products.destroy', $product)}}"
                       class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
