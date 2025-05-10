@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">تعديل الطلب #{{ $order->id }}</h2>

    <form method="POST" action="{{ route('user.orders.update', $order->id) }}">
        @csrf
        @method('POST')

        @foreach($order->items as $index => $item)
            <div class="mb-3">
                <label class="form-label">المنتج</label>
                <input type="text" class="form-control" value="{{ $item->product->name ?? '—' }}" disabled>
            </div>

            <div class="mb-4">
                <label for="quantities[{{ $item->id }}]" class="form-label">الكمية</label>
                <input type="number" min="1" name="quantities[{{ $item->id }}]" class="form-control"
                       value="{{ old('quantities.' . $item->id, $item->quantity) }}" required>
            </div>

        @endforeach

        <div class="text-center">
            <button type="submit" class="btn btn-success px-4 w-50">تحديث الطلب</button>
        </div>
    </form>
</div>
@endsection
