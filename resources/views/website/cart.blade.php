@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">سلة المشتريات</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الإجمالي</th>
                        <th>إزالة</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                        @endphp
                        <tr>
                            <td>
                                @if(!empty($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" width="60" height="60" alt="صورة المنتج">
                                @else
                                    <span class="text-muted">لا يوجد</span>
                                @endif
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['price'] }} ر.س</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($itemTotal, 2) }} ر.س</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من إزالة المنتج؟')">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="4" class="text-end fw-bold">الإجمالي الكلي:</td>
                        <td colspan="2" class="fw-bold">{{ number_format($total, 2) }} ر.س</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('checkout.submit') }}" class="btn btn-success">اتمام الطلب</a>
        </div>
    @else
        <div class="alert alert-info text-center">
            سلة المشتريات فارغة حالياً.
        </div>
    @endif
</div>
@endsection
