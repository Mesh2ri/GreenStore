@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">المنتجات</h2>
                <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">إضافة منتج</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>الاسم</th>
                            <th>الوصف</th>
                            <th>السعر</th>
                            <th>التصنيف</th>
                            <th>الصورة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" width="60" height="60" alt="صورة المنتج">
                                    @else
                                        <span class="text-muted">لا يوجد</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <form action="{{ route('dashboard.products.delete', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">لا توجد منتجات حالياً</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
