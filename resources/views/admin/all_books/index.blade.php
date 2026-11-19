<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - All Book List</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        #content-wrapper { background-color: rgba(248, 249, 252, 0.85) !important; }
        .book-img { width: 50px; height: 65px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;" id="page-top">

    <div id="wrapper">
        <!-- Sidebar placeholder -->
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="container-fluid mt-4">
                
                <!-- Page Title -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">📚 All Book List (সব বইয়ের তালিকা)</h1>
                    <!-- static link fixed to route -->
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Book
                    </a>
                </div>

                <!-- Table Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Library Inventory</h6>
                    </div>
                    <div class="card-body">

                        <!-- Flash Success Alert -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-light text-black">
                                    <tr>
                                        <th>Book ID</th>
                                        <th>Photo</th>
                                        <th>Title (নাম)</th>
                                        <th>Author (লেখক)</th>
                                        <th>Genre (ক্যাটাগরি)</th>
                                        <th>Edition</th>
                                        <th>Stock (Avail / Total)</th>
                                        <th>Upload Time</th>
                                        <th>Action (কাজ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td class="text-center">
                                                @php
                                                    $imagePath = $book->photo ? asset('storage/' . $book->photo) : 'https://via.placeholder.com/150x200?text=No+Cover';
                                                @endphp
                                                <img src="{{ $imagePath }}" 
                                                     class="book-img border" 
                                                     alt="{{ $book->title }}"
                                                     onerror="this.onerror=null; this.src='https://via.placeholder.com/150x200?text=No+Cover';">
                                            </td>
                                            <td><strong>{{ $book->title }}</strong></td>
                                            <td>{{ $book->author }}</td>
                                            <td><span class="badge badge-info">{{ $book->genre }}</span></td>
                                            <td>{{ $book->edition }}</td>
                                            <td>
                                                <span class="badge badge-{{ $book->available_quantity > 0 ? 'success' : 'danger' }}">
                                                    {{ $book->available_quantity }} / {{ $book->quantity }}
                                                </span>
                                            </td>
                                            <td>{{ $book->uploaded_at ? \Carbon\Carbon::parse($book->uploaded_at)->format('d M, Y') : 'N/A' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.book.details', $book->id) }}" class="btn btn-primary btn-sm" title="Details">
                                                        <i class="fas fa-info-circle"></i> Details
                                                    </a>
                                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                No Books Found in Inventory.
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

    <!-- JavaScript Core -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>