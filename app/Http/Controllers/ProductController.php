<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display all products on the product page.
     */
    public function showProducts()
    {
        // Fetch products whose category name is 'Men'
        $menProducts = Product::whereHas('category', function($query) {
            $query->where('name', 'Men'); // Filter by category name
        })->get();
    
        // Fetch products whose category name is 'Women'
        $womenProducts = Product::whereHas('category', function($query) {
            $query->where('name', 'Women'); // Filter by category name
        })->get();
    
        // Pass both categories of products to the view
        return view('product', compact('menProducts', 'womenProducts'));
    }

    /**
     * Display a listing of the resource (Admin View).
     */
    // In ProductController.php

    public function index()
    {
        // Eager load the category relationship
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        // Fetch all categories from the database
        $categories = Category::all();

        // Pass the categories to the create view
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Assuming category_id is a foreign key in the products table
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Image validation
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }

        // Create the product with the validated data
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Fetch categories for the dropdown
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Validate category_id exists in categories table
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Image validation
        ]);

        $product = Product::findOrFail($id);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image from storage
            if ($product->image) {
                $oldImagePath = public_path('images/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function filterProducts(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categoryId = $request->input('category');
    
        // Start building the query for the products
        $query = Product::query();
    
        // Filter by product name if the search term is provided
        if ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
    
        // Filter by category if the category ID is provided and not 'all'
        if ($categoryId && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }
    
        // Execute the query and get the results
        $products = $query->get();
    
        // Return the filtered products as JSON
        return response()->json($products);
    }
    


}
