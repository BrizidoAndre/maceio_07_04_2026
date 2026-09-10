<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function store(ProductRequest $request)
    {
        $url = 'pending...';
        $created = Product::create([
            ...$request->validated(),
            'photo' => $url,
            'restaurant_id' => auth()->id(),
        ]);
        $file = request()->file('photo');
        $url = Str::remove('imgs/', $file->move('imgs', "product_" . $created->getKey() . "." . $file->extension()));
        $created->update([
            'photo' => $url,
        ]);
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $file = request()->file('photo');
        $url = $product->photo;
        if ($file) {
            $url = Str::remove('imgs/', $file->move('imgs', "product_" . $product->getKey() . "." . $file->extension()));
        }
        $product->update([
            ...$request->validated(),
            'photo' => $url,
        ]);
        return redirect()->route('products.index');
    }
}
