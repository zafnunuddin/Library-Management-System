<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damaged Books Inventory</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        #content-wrapper { background-color: rgba(248, 249, 252, 0.85) !important; }
        .book-img { width: 50px; height: 65px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body id="page-top" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-attachment: fixed;">

    <div id="wrapper">
        <!-- Sidebar included here -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="container-fluid mt-4">
                
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">⚠️ Damaged Books Record</h1>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Dashboard
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger">Damaged Books Inventory & Fines</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="bg-light text-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Book Info</th>
                                        <th>User Details</th>
                                        <th>Damaged Qty</th>
                                        <th>Book Price</th>
                                        <th>Late Fee</th>
                                        <th>Total Fee</th>
                                        <th>Photo</th>
                                        <th>Return Date</th>
                                        <th>Notice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($damagedBooks as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $bookCover = optional($item->book)->photo ? asset('storage/'.optional($item->book)->photo) : 'https://via.placeholder.com/50x65?text=No+Cover';
                                                    @endphp
                                                    <img src="{{ $bookCover }}" 
                                                         class="book-img mr-2 border" 
                                                         alt="Cover"
                                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/50x65?text=No+Cover';">
                                                    <div>
                                                        <strong>{{ $item->book->title ?? 'N/A' }}</strong><br>
                                                        <small class="text-muted">Author: {{ $item->book->author ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ $item->user->name ?? 'N/A' }}</strong><br>
                                                <small class="text-muted">{{ $item->user->email ?? 'N/A' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger font-weight-bold p-2">
                                                    {{ $item->quantity ?? 1 }} Copy
                                                </span>
                                            </td>
                                            <td>৳{{ number_format($item->book_price ?? 0, 2) }}</td>
                                            <td>৳{{ number_format($item->late_fee ?? 0, 2) }}</td>
                                            <td>
                                                <strong class="text-danger">
                                                    ৳{{ number_format(($item->book_price ?? 0) + ($item->late_fee ?? 0), 2) }}
                                                </strong>
                                            </td>
                                            <td class="text-center">
                                                @if($item->damage_photo && $item->damage_photo != 'default-book.jpg')
                                                    @php
                                                        $damagePhotoUrl = asset('storage/'.$item->damage_photo);
                                                    @endphp
                                                    <a href="{{ $damagePhotoUrl }}" target="_blank">
                                                        <img src="{{ $damagePhotoUrl }}" 
                                                             class="book-img border" 
                                                             alt="Proof"
                                                             onerror="this.onerror=null; this.src='https://via.placeholder.com/50x65?text=No+Proof';">
                                                    </a>
                                                @else
                                                    <span class="text-muted">No Photo</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->actual_return_date ? \Carbon\Carbon::parse($item->actual_return_date)->format('d M, Y') : 'N/A' }}</td>
                                            <td>{{ $item->notice ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">
                                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i><br>
                                                No Damaged Books Found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>