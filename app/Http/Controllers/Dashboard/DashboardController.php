<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $ordersCount = Order::count();

        $products = Product::with('category')->get();
        $total_stock = Product::sum('stock');

        $orders = Order::latest()->take(10)->get([
            'id',
            'user_id',
            'total_price',
            'created_at'
        ]);

        foreach ($orders as $order) {
            $order->products_count = $order->items()->count();
        }

        return view('dashboard.index', compact(
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'products',
            'total_stock',
            'orders'
        ));
    }

    public function getReports()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $ordersCount = Order::count();

        $products = Product::with('category')->get();
        $total_stock = Product::sum('stock');

        $orders = Order::latest()->take(10)->get([
            'id',
            'customer_name',
            'total_price',
            'created_at'
        ]);

        // إضافة عدد المنتجات لكل طلب
        foreach ($orders as $order) {
            $order->products_count = $order->items()->count();
        }

        return view('dashboard.reports', compact(
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'products',
            'total_stock'
        ));
    }
}
