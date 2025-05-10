<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>فاتورة</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; direction: rtl; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">فاتورة الشراء</h2>

    <p><strong>رقم الطلب:</strong> {{ $order->id }}</p>
    <p><strong>العميل:</strong> {{ $order->user->name }}</p>
    <p><strong>الايميل:</strong> {{ $order->user->email }}</p>
    <p><strong>تاريخ الطلب:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>المنتج</th>
                <th>الكمية</th>
                <th>السعر للوحدة</th>
                <th>الإجمالي</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($order->items as $item)
                @php $subtotal = $item->quantity * $item->price; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }} ريال</td>
                    <td>{{ $subtotal }} ريال</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>الإجمالي الكلي</strong></td>
                <td><strong>{{ $total }} ريال</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
