@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">جميع المنتجات</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="border rounded p-3 h-100 d-flex flex-column justify-content-between text-center">
                    <div class="mb-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 200px;">
                        @else
                            <img src="https://via.placeholder.com/200x200?text=No+Image" class="img-fluid" alt="صورة غير متوفرة">
                        @endif
                    </div>

                    <div class="mb-2">
                        <h5 class="fw-bold">{{ $product->name }}</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                        <p class="fw-bold">السعر: {{ $product->price }} ريال</p>
                    </div>

                    <div>
                        @auth
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success w-100">أضف إلى السلة</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-outline-secondary w-100"
                                onclick="alert('يرجى تسجيل الدخول أولاً لإضافة المنتجات إلى السلة.')">
                                أضف إلى السلة
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">لا توجد منتجات متاحة حالياً.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
