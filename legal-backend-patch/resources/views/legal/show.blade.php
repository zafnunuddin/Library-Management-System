<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $page->title }} - LMS / EDU</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f9;
        }

        .legal-header {
            background: #205ce8;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .legal-header h1 {
            margin: 0;
            font-weight: 700;
            font-size: 26px;
        }

        .legal-header p {
            margin: 6px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .legal-wrapper {
            max-width: 800px;
            margin: 30px auto 60px;
            padding: 0 20px;
        }

        .legal-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            padding: 40px;
        }

        .legal-card h2 {
            color: #205ce8;
            font-size: 19px;
            margin-top: 28px;
        }

        .legal-card h2:first-child {
            margin-top: 0;
        }

        .legal-card p {
            color: #444;
            line-height: 1.7;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #205ce8;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }

    </style>

</head>

<body>

    <div class="legal-header">
        <h1>{{ $page->title }}</h1>
        <p>LMS / EDU &mdash; Library Management System</p>
    </div>

    <div class="legal-wrapper">

        <a href="{{ url()->previous() === url()->current() ? route('login') : url()->previous() }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>

        <div class="legal-card">

            {!! $page->content !!}

            <hr class="mt-4">

            <p class="text-muted small mb-0">
                Last updated: {{ $page->updated_at->format('F j, Y') }}
            </p>

        </div>

    </div>

</body>

</html>
