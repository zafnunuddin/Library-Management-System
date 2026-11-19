<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Pages - Admin</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container-fluid mt-4">

    <div class="card shadow mb-4">

        <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0">
                <i class="fas fa-file-contract mr-2"></i>
                Legal Pages
            </h5>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left"></i>
                Dashboard
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <p class="text-muted">
                These pages are shown to students on the login and registration screens (Terms of Use / Privacy Policy links).
                Edit the content below &mdash; changes go live immediately.
            </p>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Page</th>
                        <th>Slug</th>
                        <th>Version</th>
                        <th>Last Updated</th>
                        <th>Updated By</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td><code>{{ $page->slug }}</code></td>
                            <td>v{{ $page->version }}</td>
                            <td>{{ $page->updated_at->format('M j, Y g:i A') }}</td>
                            <td>{{ $page->updater->name ?? '—' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.legal.edit', $page->slug) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a href="{{ route($page->slug === 'terms' ? 'terms' : 'privacy') }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-eye"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No legal pages found. Run <code>php artisan db:seed --class=LegalPageSeeder</code> to create defaults.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</div>

</body>

</html>
