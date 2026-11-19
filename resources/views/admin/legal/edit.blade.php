<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $page->title }} - Admin</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        textarea#content {
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }
    </style>
</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container-fluid mt-4">

    <div class="card shadow mb-4">

        <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0">
                <i class="fas fa-edit mr-2"></i>
                Edit {{ $page->title }}
            </h5>

            <a href="{{ route('admin.legal.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left"></i>
                Back to List
            </a>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.legal.update', $page->slug) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Page Title</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $page->title) }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">
                        Content (HTML supported)
                    </label>
                    <textarea
                        id="content"
                        name="content"
                        class="form-control"
                        rows="20"
                        required>{{ old('content', $page->content) }}</textarea>
                    <small class="form-text text-muted">
                        You can use basic HTML tags like &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;/&lt;li&gt;, &lt;strong&gt;, and &lt;a&gt; to format the page.
                        This content is displayed as-is to every visitor, so only paste content you trust.
                    </small>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        Currently v{{ $page->version }} &middot; last saved {{ $page->updated_at->diffForHumans() }}
                        @if($page->updater)
                            by {{ $page->updater->name }}
                        @endif
                    </span>

                    <div>
                        <a href="{{ route('admin.legal.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>
