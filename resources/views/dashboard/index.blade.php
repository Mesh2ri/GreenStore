@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">لوحة التحكم</h2>

    {{-- البطاقات الثلاث --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">المنتجات</h5>
                    <p class="card-text fs-5">عدد المنتجات: {{ $productsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">التصنيفات</h5>
                    <p class="card-text fs-5">عدد التصنيفات: {{ $categoriesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">الطلبات</h5>
                    <p class="card-text fs-5">عدد الطلبات: {{ $ordersCount }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- تقارير إضافية --}}
    <h3 class="my-4 text-center">تفاصيل الطلبات الأخيرة</h3>

    <div class="card mb-5">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">أحدث الطلبات</h5>
        </div>
        <div class="card-body">
            @if($orders->isEmpty())
                <p class="text-center">لا توجد طلبات حالياً.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم العميل</th>
                                <th>عدد المنتجات</th>
                                <th>السعر الإجمالي</th>
                                <th>تاريخ الإنشاء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->products_count }}</td>
                                    <td>{{ number_format($order->total_price, 2) }} ريال</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <h3 class="mb-4 text-center">تقارير المنتجات</h3>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">إجمالي المنتجات</h5>
                    <p class="fs-4">{{ $productsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h5 class="card-title">إجمالي التصنيفات</h5>
                    <p class="fs-4">{{ $categoriesCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body text-center">
                    <h5 class="card-title">إجمالي الكمية</h5>
                    <p class="fs-4">{{ $total_stock }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>اسم المنتج</th>
                    <th>التصنيف</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->price }} ريال</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
