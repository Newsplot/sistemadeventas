<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::paginate()
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        Category::create($data);

        return back()->with('message', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'description'=>'required|max:255'
        ]);

        $category->update($data);

        return back()->with('message', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('message', 'Category deleted.');
    }
}
