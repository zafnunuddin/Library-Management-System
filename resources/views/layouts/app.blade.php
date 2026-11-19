<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>

    <style>
        body {
            /* লারাভেলের asset() ফাংশন ব্যবহার করে ইমেজ পাথ দেওয়া হয়েছে */
            background-image: url('{{ asset('img/background.jpg') }}');
            
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed; /* স্ক্রল করার সময় ব্যাকগ্রাউন্ড স্থির রাখতে */
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

    <!-- Navigation with Logo -->
    <nav>
        <!-- Using the asset helper to point to public/images/logo.jpg -->
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Website Logo" width="120">
        </a>
    </nav>

    <!-- আপনার কন্টেন্ট এখানে থাকবে -->
    <h1>Welcome to My App</h1>

</body>
</html>