<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Fetch all products.
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }

    /**
     * Store a new product.
     */
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

        $product = $this->productService->createProduct($validated);
        return response()->json(['message' => 'Product created successfully!', 'product' => $product], 201);
    }

    /**
     * Fetch a specific product by ID.
     */
    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    /**
     * Update a specific product by ID.
     */
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

        $product = $this->productService->updateProduct($id, $validated);
        return response()->json(['message' => 'Product updated successfully!', 'product' => $product]);
    }

    /**
     * Delete a specific product by ID.
     */
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully!']);
    }

    /**
     * Filter products.
     */
    public function filter(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categoryId = $request->input('category');

        $products = $this->productService->filterProducts($searchTerm, $categoryId);
        return response()->json($products);
    }
}
