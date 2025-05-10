@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h4 class="mb-4 text-center">{{ isset($category) ? 'تعديل التصنيف' : 'إضافة تصنيف' }}</h4>

            <form action="{{ isset($category) ? route('dashboard.categories.update', $category->id) : route('dashboard.categories.store') }}" 
                class='form' method="POST">
                @csrf
                @if(isset($category))
                    @method('POST')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">اسم التصنيف</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $category->name ?? '') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea name="description" id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="4">{{ old('description', $category->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 w-100 fs-5">
                        {{ isset($category) ? 'تحديث' : 'إضافة' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
