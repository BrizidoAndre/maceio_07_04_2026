<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('products');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function store(ProductRequest $request)
    {
        $file = $request->file('photo');
        $model = Product::create([
            ...$request->all(),
            'restaurant_id' => auth()->id(),
            'price' => 10,
            'photo' => 'pending...',
        ]);

        $url = Str::remove('img/', $file->move('img', "product_{$model->getKey()}.{$file->extension()}"));
        $model->update([
            'photo' => $url,
        ]);
        return redirect()->route('products.index');
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $url = $product->photo;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $url = Str::remove('img/', $file->move('img', "product_{$product->getKey()}.{$file->extension()}"));
        }
        $product->update([
            ...$request->validated(),
            'photo' => $url,
        ]);
        return redirect()->route('products.index');
    }
}
