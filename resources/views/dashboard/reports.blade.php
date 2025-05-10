@extends('layouts.admin')

@section('title', 'تقارير لوحة التحكم')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">تقارير لوحة التحكم</h2>

        {{-- البطاقات --}}
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">عدد المنتجات</h5>
                        <p class="display-6">{{ $productsCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-success h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">عدد التصنيفات</h5>
                        <p class="display-6">{{ $categoriesCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-dark h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">عدد الطلبات</h5>
                        <p class="display-6"></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- جدول الطلبات --}}
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">تفاصيل الطلبات</h5>
            </div>
            <div class="card-body">
                @if($orders->isEmpty())
                    <p class="text-center">لا توجد طلبات حالياً.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
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
                                        <td>{{ $order->customer_name }}</td>
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
    </div>

    <div class="container mt-4">
    <h2 class="mb-4">تقارير المنتجات</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">إجمالي المنتجات</h5>
                    <p class="card-text fs-4">{{ $products_count }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">إجمالي التصنيفات</h5>
                    <p class="card-text fs-4">{{ $categories_count }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الكمية</h5>
                    <p class="card-text fs-4">{{ $total_stock }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
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