<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Models\Category;

class ProductController extends Controller
{
    private $storage;

    public function __construct(Request $request)
    {
        view()->composer('crm.layouts.link', function ($view) {
            $view->with(['active_name' => 'products']);
        });

        $product_id = $request->route('product');
        $this->storage = new StorageHelper('image', $request->file('file'), Product::find($product_id));
    }

    public function index()
    {
        return view('crm.products.index', ['products' => Product::with('category')->get()]);
    }

    public function create()
    {
        return view('crm.products.create', ['categories' => Category::get()]);
    }

    public function store(Request $request)
    {
        $name = $request->hasFile('file') ? $this->storage->saveImage() : 'default-image.jpg';

        Product::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'count' => $request->input('count'),
            'self_cost' => $request->input('self_cost'),
            'cost' => $request->input('cost'),
            'image' => $name
        ]);

        return response()->redirectTo('/product');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('crm.products.edit', ['product' => $product,'categories' => Category::get()]);
    }

    public function update(Request $request, Product $product)
    {
        $name = $this->storage->saveImage();

        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->count = $request->input('count');
        $product->self_cost = $request->input('self_cost');
        $product->cost = $request->input('cost');
        $product->image = $name;
        $product->save();

        return response()->redirectTo('/product');
    }

    public function destroy(Product $product)
    {
        $this->storage->destroyImage();
        $product->delete();

        return response()->redirectTo('/product');
    }
}