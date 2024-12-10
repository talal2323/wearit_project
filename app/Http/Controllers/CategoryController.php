<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
   {
        $category = Category::findOrFail($id); // Find the category by ID
        return view('categories.edit', compact('category')); // Pass the category to the view
   }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        // Find the category by ID
        $category = Category::findOrFail($id);
    
        // Update the category with the validated data
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    
        // Redirect back to the categories index with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);
    
        // Delete the category
        $category->delete();
    
        // Redirect to the categories index with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

}
