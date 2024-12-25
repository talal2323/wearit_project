<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Get all products.
     */
    public function getAllProducts()
    {
        return Product::with('category')->get();
    }

    /**
     * Store a new product.
     */
    public function createProduct($validatedData)
    {
        if (isset($validatedData['image'])) {
            $image = $validatedData['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        return Product::create($validatedData);
    }

    /**
     * Get a product by ID.
     */
    public function getProductById($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    /**
     * Update a product.
     */
    public function updateProduct($id, $validatedData)
    {
        $product = Product::findOrFail($id);

        if (isset($validatedData['image'])) {
            // Delete old image
            if ($product->image) {
                $oldImagePath = public_path('images/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save new image
            $image = $validatedData['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $product->update($validatedData);
        return $product;
    }

    /**
     * Delete a product.
     */
    public function deleteProduct($id)
    {
        // Find the product by ID or fail if not found
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Optionally reset auto-increment (use with caution)
        \DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');

        // Return a success response or status
        return true; // Or you can return a message or status code as needed
    }

    /**
     * Filter products.
     */
    public function filterProducts($searchTerm, $categoryId)
    {
        $query = Product::query();

        if ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        if ($categoryId && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }

        return $query->get();
    }
}
