<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{


    public function index()
{
    $products = Product::with('category')->get(); // جلب كل المنتجات مع تصنيفاتها

    return view('website.products', compact('products'));
}
}
