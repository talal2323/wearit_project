<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display all products on the product page.
     */
    public function showProducts()
{
    // Fetch products categorized as 'Men' and 'Women'
    $menProducts = Product::where('category', 'Men')->get();
    $womenProducts = Product::where('category', 'Women')->get();

    // Pass both categories of products to the view
    return view('product', compact('menProducts', 'womenProducts'));
}

    

    /**
     * Display a listing of the resource (Admin View).
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|string',
        ]);
        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
{
    // Validate input data
    $validated = $request->validate([
        'name' => 'required|string',
        'category' => 'required|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Update validation to allow image file upload
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Handle image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Delete old image from public/images if it exists
        if ($product->image) {
            $oldImagePath = public_path('images/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete old image
            }
        }
    
        // Store new image in public/images and get the filename
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique name
        $image->move(public_path('images'), $imageName); // Move the image to public/images
    
        // Save the new image filename to the product
        $validated['image'] = $imageName; // Store only the image name
    }
    

    // Update the product with validated data
    $product->update($validated);

    // Redirect to the product list with a success message
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
}
