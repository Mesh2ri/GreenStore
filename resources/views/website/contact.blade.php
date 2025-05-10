@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">تواصل معنا</h2>

    <form action="#" method="POST" class="w-75 mx-auto">
        {{-- لاحقًا سنربطه بـ POST حقيقي --}}
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">الاسم الكامل</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">رسالتك</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">إرسال</button>
        </div>
    </form>
</div>
@endsection
