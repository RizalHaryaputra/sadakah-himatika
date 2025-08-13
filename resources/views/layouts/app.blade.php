<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .ck-content ul,
        .ck-content ol {
            list-style-type: disc;
            /* atau decimal untuk <ol> */
            padding-left: 1.5rem;
            /* tambahkan indentasi */
            margin-bottom: 1rem;
        }

        .ck-content ol {
            list-style-type: decimal;
        }

        .ck-content li {
            margin-bottom: 0.25rem;
        }

        .ck-content h1 {
            font-size: 1.875rem;
            /* 30px */
            font-weight: 700;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            line-height: 1.2;
        }

        .ck-content h2 {
            font-size: 1.5rem;
            /* 24px */
            font-weight: 600;
            margin-bottom: 0.75rem;
            margin-top: 1.25rem;
            line-height: 1.3;
        }

        .ck-content h3 {
            font-size: 1.25rem;
            /* 20px */
            font-weight: 600;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
            line-height: 1.3;
        }

        /* FilePond Styling */
        .filepond--root {
            font-family: inherit;
        }

        .filepond--panel-root {
            border-radius: 0.75rem !important;
            background-color: #f9fafb !important;
            border: 1px solid #d1d5db !important;
        }

        .filepond--panel-root[data-filepond-state='dnd-highlight'] {
            border-color: #059669 !important;
            background-color: #d1fae5 !important;
        }

        .filepond--label-action {
            color: #059669;
            text-decoration-color: #059669;
        }

        .filepond--item-panel {
            border-radius: 0.75rem !important;
            background-color: #047857 !important;
        }

        .filepond--credits {
            display: none !important;
        }
    </style>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @include('sweetalert2::index')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    {{-- FilePond JS --}}
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
</body>

</html>