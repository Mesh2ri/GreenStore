<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | لوحة التحكم</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            /* يجعل المحتوى يأخذ المساحة المتبقية */
        }
    </style>
</head>

<body dir="rtl">

    {{-- Navbar --}}
    @include('components.admin.navbar')

    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-3 col-lg-2 p-0">
                @include('components.admin.sidebar')
            </div>

            {{-- Main Content --}}
            <main class="col-md-9 col-lg-10 py-4 px-3">
                @yield('content')
            </main>
        </div>
    </div>
    @include('components.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>