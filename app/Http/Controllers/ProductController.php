<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $this->productService->createProduct($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    public function create()
    {
        $categories = Category::all(); // Fetch categories for the dropdown
        return view('products.create', compact('categories'));
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $this->productService->updateProduct($id, $validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function filterProducts(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categoryId = $request->input('category');

        $products = $this->productService->filterProducts($searchTerm, $categoryId);
        return response()->json($products);
    }
}
