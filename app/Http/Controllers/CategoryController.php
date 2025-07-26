<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Helpers\StorageHelper;

class CategoryController extends Controller
{
    public function __construct()
    {
        view()->composer('crm.layouts.link', function ($view) {
            $view->with(['active_name' => 'categories']);
        });
    }

    public function index()
    {
        $categories = Category::all();
        return view('crm.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('crm.categories.create');
    }

    public function store(Request $request)
    {
        $storage = new StorageHelper('image', $request->file('file'), null);
        $filename = $storage->saveImage();

        Category::create([
            'name' => $request->input('name'),
            'image' => $filename,
        ]);

        return redirect('/category');
    }

    public function edit(Category $category)
    {
        return view('crm.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $storage = new StorageHelper('image', $request->file('file'), $category);
        $filename = $storage->saveImage();

        $category->update([
            'name' => $request->input('name'),
            'image' => $filename,
        ]);

        return redirect('/category');
    }

    public function destroy(Category $category)
    {
        $storage = new StorageHelper('image', null, $category);
        $storage->destroyImage();

        $category->delete();

        return redirect('/category');
    }
}

