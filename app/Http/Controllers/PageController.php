<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    // This method handles the homepage
    public function index()
    {
        return view('index');  // Ensure 'index.blade.php' exists
    }

    // Change the about method to load the product page
    public function product()
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

    public function contact()
    {
        return view('contact');  // Ensure 'contact.blade.php' exists
    }
}
