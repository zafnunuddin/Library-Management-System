<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body style="background:#f4f6f9;">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold"><i class="bi bi-clock-history text-primary"></i> Borrowed Book History</h3>
            <p class="text-muted mb-0">List of all books you have returned previously</p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @forelse($returnedBooks as $history)
                <div class="border rounded p-3 mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h6 class="fw-bold mb-1">{{ $history->book->title ?? 'Unknown Book' }}</h6>
                            <small class="text-muted">Condition: <span class="badge bg-secondary">{{ $history->condition }}</span></small>
                        </div>

                        <div class="col-md-3">
                            <small class="text-muted">Return Date</small>
                            <div class="fw-bold">{{ \Carbon\Carbon::parse($history->actual_return_date)->format('d M Y') }}</div>
                        </div>

                        <div class="col-md-3">
                            <small class="text-muted">Fine Charged</small>
                            <div class="fw-bold text-danger">৳{{ number_format($history->fine, 2) }}</div>
                        </div>

                        <div class="col-md-2 text-md-end">
                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Returned</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-journal-x" style="font-size:50px;color:#aaa;"></i>
                    <h5 class="mt-3">No Book History Found</h5>
                    <p class="text-muted">You have not returned any books yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

</body>
</html>