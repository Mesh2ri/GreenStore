@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4">الفاتورة النهائية</h2>

        <div class="row justify-content-center">
            <div class="col-md-10">

                {{-- معلومات العميل --}}
                <div class="mb-4">
                    <p><strong>الاسم:</strong> {{ $order->user->name ?? 'زائر'  }}</p>
                    <p><strong>الايميل:</strong> {{ $order->user->email ?? '-'  }}</p>
                    <p><strong>تاريخ الطلب:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>

                {{-- جدول المنتجات --}}
                <table class="table table-bordered text-center align-middle mb-5">
                    <thead class="table-dark">
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
                            @php $subtotal = $item->quantity * $item->price;
                            $total += $subtotal; @endphp
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }} ريال</td>
                                <td>{{ $subtotal }} ريال</td>
                            </tr>
                        @endforeach
                        <tr class="table-light fw-bold">
                            <td colspan="3">الإجمالي الكلي</td>
                            <td>{{ $total }} ريال</td>
                        </tr>
                    </tbody>
                </table>

                {{-- الأزرار --}}
                <div class="text-center mt-4">
                    <a href="{{ route('checkout.invoice.pdf', $order->id) }}" class="btn btn-outline-primary px-5">
                        تحميل الفاتورة PDF
                    </a>


                    <form action="{{ route('website.home') }}" method="get" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-success px-5">
                            الذهاب للصفحة الرئيسية
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection