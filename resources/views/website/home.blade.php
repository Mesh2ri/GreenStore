@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">مرحبًا بكم في <span class="text-success">Green Store</span></h1>
    <p class="lead text-center mb-5">اكتشف منتجاتنا الزراعية المتنوعة</p>

    @foreach ($categories as $category)
        <h3 class="text-center mb-4">{{ $category->name }}</h3>
        <div class="row justify-content-center mb-5">
            @forelse ($category->products as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="border rounded p-3 text-center h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3" style="max-height: 150px;">
                        @endif
                        <h5>{{ $product->name }}</h5>
                        <p class="text-muted">{{ $product->price }} ر.س</p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success w-100">إضافة إلى السلة</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">لا توجد منتجات حالياً ضمن هذا التصنيف</p>
            @endforelse
        </div>
    @endforeach
</div>
@endsection
