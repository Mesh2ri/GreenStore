@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">طلباتي</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">لا توجد طلبات حالياً.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>عدد العناصر</th>
                        <th>الكمية الإجمالية</th>
                        <th>الحالة</th>
                        <th>الإجمالي</th>
                        <th>التاريخ</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @php
                            $statusColors = [
                                'pending' => 'secondary',
                                'processing' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                        @endphp
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->items->count() }}</td>
                            <td>{{ $order->items->sum('quantity') }}</td>
                            <td>
                                <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>{{ $order->total_price }} ر.س</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('user.orders.edit', $order->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                <form action="{{ route('user.orders.delete', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
