<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.form');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'تمت إضافة التصنيف بنجاح');
    }

    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.form', compact('category'));
    }

    
    public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        'description' => 'nullable|string|max:1000',
    ]);

    $category->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('dashboard.categories.index')->with('success', 'تم تحديث التصنيف بنجاح');
}


    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', 'تم حذف التصنيف بنجاح');
    }
}
