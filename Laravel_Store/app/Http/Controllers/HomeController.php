<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::all()->take(2);
        $products = Product::all()->take(6);

        return view('home', compact('categories', 'products'));
    }
}
