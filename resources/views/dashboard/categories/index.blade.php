@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2 class="h4">التصنيفات</h2>
        </div>
        <div class="col-md-6 text-md-start text-start">
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">إضافة تصنيف</a>
        </div>
    </div>

    @if(session('success'))
        <div class="row mb-3">
            <div class="col">
                <div class="alert alert-success mb-0">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الوصف</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <form action="{{ route('dashboard.categories.delete', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">لا توجد تصنيفات حاليًا</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
