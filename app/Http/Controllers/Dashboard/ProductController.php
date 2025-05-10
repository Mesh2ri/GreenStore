<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // عرض كل المنتجات
    public function index()
    {
        $products = Product::with('category')->get();
        return view('dashboard.products.index', compact('products'));
    }

    // عرض نموذج الإضافة
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.form', compact('categories'));
    }

    // تخزين المنتج الجديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->categories_id = $request->categories_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }


    // عرض نموذج التعديل
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.products.form', compact('product', 'categories'));
    }

    // تحديث بيانات المنتج
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->categories_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }


    // حذف المنتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // حذف الصورة من التخزين
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('dashboard.products.index')->with('success', 'تم حذف المنتج');
    }
}


