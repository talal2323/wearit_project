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
        // Fetch products categorized as 'Men' and 'Women'
        $menProducts = Product::where('category', 'Men')->get();
        $womenProducts = Product::where('category', 'Women')->get();
    
        // Pass both categories of products to the view
        return view('product', compact('menProducts', 'womenProducts'));
    }

    public function contact()
    {
        return view('contact');  // Ensure 'contact.blade.php' exists
    }
}
