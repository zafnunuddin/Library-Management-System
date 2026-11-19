<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - LMS</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: #f8f9fc;
        }

        .book-details-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .book-image {
            width: 100%;
            max-height: 450px;
            object-fit: contain;
            border-radius: 10px;
        }

        .book-title {
            color: #202020;
            font-weight: 700;
        }

        .book-info {
            font-size: 16px;
        }

        .info-label {
            font-weight: 700;
            color: #555;
        }

        .back-btn {
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('home') }}" class="btn btn-secondary back-btn">
            <i class="fas fa-arrow-left mr-1"></i> Back to Home
        </a>
    </div>

    <!-- Book Details Card -->
    <div class="card shadow book-details-card">
        <div class="card-body p-4">
            <div class="row align-items-center">

                <!-- Book Image -->
                <div class="col-lg-5 text-center mb-4 mb-lg-0">
                    @php
                        $photoUrl = $book->photo ? asset('storage/' . $book->photo) : asset('images/default-book.png');
                    @endphp
                    <img src="{{ $photoUrl }}" alt="{{ $book->title }}" class="book-image" onerror="this.onerror=null; this.src='https://via.placeholder.com/350x450?text=No+Cover';">
                </div>

                <!-- Book Information -->
                <div class="col-lg-7">
                    <h1 class="book-title mb-3">{{ $book->title }}</h1>

                    <div class="book-info">
                        <p><span class="info-label">Author:</span> {{ $book->author }}</p>
                        <p><span class="info-label">Book ID:</span> {{ $book->id }}</p>
                        <p><span class="info-label">ISBN:</span> {{ $book->isbn ?? 'N/A' }}</p>
                        <p><span class="info-label">Edition:</span> {{ $book->edition ?? 'N/A' }}</p>
                        <p><span class="info-label">Genre:</span> {{ $book->genre ?? 'N/A' }}</p>
                        <p><span class="info-label">Total Quantity:</span> {{ $book->quantity }}</p>
                        <p>
                            <span class="info-label">Available Copies:</span> 
                            <span class="badge {{ $book->available_quantity > 0 ? 'badge-success' : 'badge-danger' }} px-2 py-1">
                                {{ $book->available_quantity }}
                            </span>
                        </p>

                        @if(!empty($book->description))
                            <hr>
                            <h5 class="font-weight-bold">Description</h5>
                            <p class="text-muted">{{ $book->description }}</p>
                        @endif
                    </div>

                    <!-- Dynamic Action Button -->
                    <div class="mt-4">
                        @auth
                            <a href="{{ route('user.dashboard') }}" class="btn btn-success">
                                <i class="fas fa-tachometer-alt mr-1"></i> Go to Student Dashboard to Borrow
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login to Borrow Book
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>