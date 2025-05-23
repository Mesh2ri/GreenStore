<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class MainController extends Controller
{
    public function index()
{
    $categories = Category::with('products')->get(); 
    return view('website.home', compact('categories'));
}
}
