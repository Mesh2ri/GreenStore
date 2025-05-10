@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h4 class="mb-4 text-center">{{ isset($product) ? 'تعديل المنتج' : 'إضافة منتج جديد' }}</h4>

            <form action="{{ isset($product) ? route('dashboard.products.update', $product->id) : route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($product))
                    @method('POST')
                @endif

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="name" class="form-label">اسم المنتج</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $product->name ?? '') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="description" class="form-label">الوصف</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="price" class="form-label">السعر</label>
                        <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', $product->price ?? '') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="stock" class="form-label">المخزون</label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock', $product->stock ?? '') }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="categories_id" class="form-label">التصنيف</label>
                        <select name="categories_id" class="form-select @error('categories_id') is-invalid @enderror">
                            <option value="">اختر تصنيف</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('categories_id', $product->categories_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <label for="image" class="form-label">الصورة</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @isset($product)
                            @if($product->image)
                                <div class="mt-3">
                                    <label class="form-label d-block">الصورة الحالية:</label>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" style="max-width: 150px;">
                                </div>
                            @endif
                        @endisset
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 fs-5">
                    {{ isset($product) ? 'تحديث' : 'إضافة' }}
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
