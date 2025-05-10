<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_items;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('website.cart', compact('cart'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$id]['quantity'] ?? 0) + 1,
            'image' => $product->image,
        ];

        session()->put('cart', $cart);
        return redirect()->route('cart.view')->with('success', 'تمت إضافة المنتج إلى السلة.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->route('cart.view')->with('success', 'تمت إزالة المنتج من السلة.');
    }
    public function submitOrder()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'سلة المشتريات فارغة.');
        }

        
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total_price' => $total,
        ]);

        foreach ($cart as $productId => $item) {
            Order_items::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('checkout.invoice', $order->id);
    }


    public function viewInvoice($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('website.invoice', compact('order'));
    }


    public function downloadInvoice($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('website.invoice_pdf', compact('order'));
        return $pdf->download('فاتورة_طلب_' . $order->id . '.pdf');
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('items')->latest()->get();
        return view('website.orders', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->items()->delete(); 
        $order->delete();

        return redirect()->route('user.orders.index')->with('success', 'تم حذف الطلب بنجاح.');
    }

    public function edit($id)
    {
        $order = Order::where('user_id', Auth::id())->with('items.product')->findOrFail($id);
        return view('website.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('user.orders.index')->with('success', 'تم تحديث حالة الطلب.');
    }

    public function editOrder($id)
    {
        $order = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('website.editOrders', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);

        $quantities = $request->input('quantities', []);

        foreach ($order->items as $item) {
            if (isset($quantities[$item->id])) {
                $item->update(['quantity' => $quantities[$item->id]]);
            }
        }

        return redirect()->route('user.orders.index')->with('success', 'تم تعديل الطلب بنجاح.');
    }


}
