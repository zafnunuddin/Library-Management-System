<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Book</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}"
          rel="stylesheet">

    <style>

        body {
            background: #f8f9fc;
        }

        .card-header {
            background: rgb(32, 92, 232) !important;
            color: white !important;
        }

        .btn-save {
            background: rgb(32, 92, 232);
            border-color: rgb(32, 92, 232);
            color: white;
        }

        .btn-save:hover {
            background: rgb(24, 72, 190);
            border-color: rgb(24, 72, 190);
            color: white;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgb(32, 92, 232);
            box-shadow: 0 0 0 0.15rem rgba(32, 92, 232, 0.15);
        }

        .section-title {
            color: rgb(32, 92, 232);
            font-weight: 700;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .preview-image {
            width: 140px;
            height: 180px;
            object-fit: cover;
        }

        .page-preview {
            width: 130px;
            height: 170px;
            object-fit: cover;
        }

    </style>

</head>


<body style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">


<div class="container mt-5 mb-5">

    <div class="card shadow">

        <!-- Header -->

        <div class="card-header py-3">

            <h4 class="m-0 font-weight-bold">

                <i class="fas fa-edit mr-2"></i>

                Edit Book Details

            </h4>

        </div>


        <div class="card-body">


            <!-- Validation Errors -->

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- Success Message -->

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif


            <!-- Main Edit Form -->

            <form action="{{ route('books.update', $book->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <!-- ========================= -->
                <!-- BASIC BOOK INFORMATION -->
                <!-- ========================= -->

                <div class="section-title">

                    <i class="fas fa-book mr-2"></i>

                    Basic Book Information

                </div>


                <div class="row">


                    <!-- Book Title -->

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">

                            Book Title

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $book->title) }}"
                            required>

                    </div>


                    <!-- Author -->

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">

                            Author Name

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="author"
                            class="form-control"
                            value="{{ old('author', $book->author) }}"
                            required>

                    </div>


                </div>


                <div class="row">


                    <!-- Edition -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">

                            Edition

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="edition"
                            class="form-control"
                            value="{{ old('edition', $book->edition) }}"
                            required>

                    </div>


                    <!-- Genre -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">

                            Genre

                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="genre"
                            class="form-control"
                            required>

                            <option value="">
                                Select Genre
                            </option>

                            <option value="Programming"
                                {{ old('genre', $book->genre) == 'Programming' ? 'selected' : '' }}>
                                Programming
                            </option>

                            <option value="Database"
                                {{ old('genre', $book->genre) == 'Database' ? 'selected' : '' }}>
                                Database
                            </option>

                            <option value="Networking"
                                {{ old('genre', $book->genre) == 'Networking' ? 'selected' : '' }}>
                                Networking
                            </option>

                            <option value="Mathematics"
                                {{ old('genre', $book->genre) == 'Mathematics' ? 'selected' : '' }}>
                                Mathematics
                            </option>

                            <option value="Fiction"
                                {{ old('genre', $book->genre) == 'Fiction' ? 'selected' : '' }}>
                                Fiction
                            </option>

                        </select>

                    </div>


                    <!-- Quantity -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">

                            Quantity

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="number"
                            name="quantity"
                            class="form-control"
                            min="1"
                            value="{{ old('quantity', $book->quantity) }}"
                            required>

                    </div>


                </div>


                <!-- ========================= -->
                <!-- PUBLICATION INFORMATION -->
                <!-- ========================= -->

                <div class="section-title">

                    <i class="fas fa-book-open mr-2"></i>

                    Publication Information

                </div>


                <div class="row">


                    <!-- Serial No -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">
                            Serial No
                        </label>

                        <input
                            type="text"
                            name="serial_no"
                            class="form-control"
                            value="{{ old('serial_no', $book->serial_no ?? '') }}"
                            placeholder="e.g. CSE-BK-101">

                    </div>


                    <!-- ISBN -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">
                            ISBN
                        </label>

                        <input
                            type="text"
                            name="isbn"
                            class="form-control"
                            value="{{ old('isbn', $book->isbn ?? '') }}"
                            placeholder="Enter ISBN">

                    </div>


                    <!-- Language -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">
                            Language
                        </label>

                        <input
                            type="text"
                            name="language"
                            class="form-control"
                            value="{{ old('language', $book->language ?? '') }}"
                            placeholder="English">

                    </div>


                    <!-- Publisher -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">
                            Publisher
                        </label>

                        <input
                            type="text"
                            name="publisher"
                            class="form-control"
                            value="{{ old('publisher', $book->publisher ?? '') }}"
                            placeholder="Enter Publisher">

                    </div>


                </div>


                <div class="row">


                    <!-- Publication Year -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">
                            Publication Year
                        </label>

                        <input
                            type="number"
                            name="publication_year"
                            class="form-control"
                            value="{{ old('publication_year', $book->publication_year ?? '') }}"
                            placeholder="2026">

                    </div>


                    <!-- Printing No -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">
                            Printing No.
                        </label>

                        <input
                            type="text"
                            name="printing_no"
                            class="form-control"
                            value="{{ old('printing_no', $book->printing_no ?? '') }}"
                            placeholder="1st Printing">

                    </div>


                    <!-- Publication Place -->

                    <div class="col-md-4 mb-3">

                        <label class="font-weight-bold">
                            Publication Place
                        </label>

                        <input
                            type="text"
                            name="publication_place"
                            class="form-control"
                            value="{{ old('publication_place', $book->publication_place ?? '') }}"
                            placeholder="Dhaka">

                    </div>


                </div>


                <div class="row">


                    <!-- Shelf Location -->

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">
                            Shelf Location
                        </label>

                        <input
                            type="text"
                            name="shelf_location"
                            class="form-control"
                            value="{{ old('shelf_location', $book->shelf_location ?? '') }}"
                            placeholder="Shelf A-01">

                    </div>


                    <!-- Status -->

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-control">

                            <option value="Available"
                                {{ old('status', $book->status) == 'Available' ? 'selected' : '' }}>
                                Available
                            </option>

                            <option value="Out of Stock"
                                {{ old('status', $book->status) == 'Out of Stock' ? 'selected' : '' }}>
                                Out of Stock
                            </option>

                        </select>

                    </div>


                </div>


                <!-- ========================= -->
                <!-- EDITION DETAILS -->
                <!-- ========================= -->

                <div class="section-title">

                    <i class="fas fa-history mr-2"></i>

                    Edition Details

                </div>


                <div class="row">


                    <!-- Past Edition -->

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">

                            Past Edition Details

                        </label>

                        <textarea
                            name="past_edition"
                            class="form-control"
                            rows="4">{{ old('past_edition', $book->past_edition) }}</textarea>

                    </div>


                    <!-- New Edition -->

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">

                            New Edition Details

                        </label>

                        <textarea
                            name="new_edition"
                            class="form-control"
                            rows="4">{{ old('new_edition', $book->new_edition) }}</textarea>

                    </div>


                </div>


                <!-- ========================= -->
                <!-- DESCRIPTION -->
                <!-- ========================= -->

                <div class="section-title">

                    <i class="fas fa-align-left mr-2"></i>

                    Book Description

                </div>


                <div class="mb-3">

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter book description">{{ old('description', $book->description) }}</textarea>

                </div>


                <!-- ========================= -->
                <!-- ABSTRACT -->
                <!-- ========================= -->

                <div class="mb-3">

                    <label class="font-weight-bold">

                        Book Abstract

                    </label>

                    <textarea
                        name="book_abstract"
                        class="form-control"
                        rows="5"
                        placeholder="Enter book abstract">{{ old('book_abstract', $book->book_abstract ?? '') }}</textarea>

                </div>


                <!-- ========================= -->
                <!-- TABLE OF CONTENTS -->
                <!-- ========================= -->

                <div class="mb-3">

                    <label class="font-weight-bold">

                        Table of Contents
                        (Chapters & Topics)

                    </label>

                    <textarea
                        name="table_of_contents"
                        class="form-control"
                        rows="7"
                        placeholder="Chapter 1 - Introduction&#10;Chapter 2 - Basic Concepts&#10;Chapter 3 - Advanced Topics">{{ old('table_of_contents', $book->table_of_contents ?? '') }}</textarea>

                </div>


                <!-- ========================= -->
                <!-- BOOK COVER -->
                <!-- ========================= -->

                <div class="section-title">

                    <i class="fas fa-image mr-2"></i>

                    Book Cover

                </div>


                <div class="row">


                    <!-- Change Cover -->

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">

                            Change Book Cover

                        </label>

                        <input
                            type="file"
                            name="photo"
                            id="photo"
                            class="form-control"
                            accept="image/*">

                        <small class="text-muted">

                            Leave empty if you don't want to change the cover.

                        </small>

                    </div>


                    <!-- Current Cover -->

                    <div class="col-md-6 mb-3 text-center">

                        <label class="font-weight-bold">

                            Current Book Cover

                        </label>

                        <br><br>

                        @php
                            $coverImg = $book->photo ? asset('storage/' . $book->photo) : 'https://via.placeholder.com/140x180?text=No+Cover';
                        @endphp

                        <img
                            id="previewImage"
                            src="{{ $coverImg }}"
                            class="preview-image img-thumbnail shadow"
                            alt="Current Book Cover"
                            onerror="this.onerror=null; this.src='https://via.placeholder.com/140x180?text=No+Cover';">

                        <br><br>

                    </div>


                </div>


                <!-- ========================= -->
                <!-- PREVIEW PAGES -->
                <!-- ========================= -->

                <div class="section-title">

                    <i class="fas fa-file-image mr-2"></i>

                    Sample Book Preview

                </div>


                <p class="text-muted">

                    Upload or replace the cover page and sample pages.

                </p>


                <div class="row">


                    <!-- Cover Page -->

                    <div class="col-md-6 mb-4">

                        <label class="font-weight-bold">

                            Cover Page

                        </label>

                        <input
                            type="file"
                            name="preview_cover"
                            class="form-control"
                            accept="image/*">

                        @if(!empty($book->preview_cover))

                            <div class="mt-2">

                                <img
                                    src="{{ asset('storage/' . $book->preview_cover) }}"
                                    class="page-preview img-thumbnail"
                                    alt="Cover Page"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/130x170?text=No+Preview';">

                            </div>

                        @endif

                    </div>


                    <!-- Page 1 -->

                    <div class="col-md-6 mb-4">

                        <label class="font-weight-bold">

                            Preview Page 1

                        </label>

                        <input
                            type="file"
                            name="preview_page_1"
                            class="form-control"
                            accept="image/*">

                        @if(!empty($book->preview_page_1))

                            <div class="mt-2">

                                <img
                                    src="{{ asset('storage/' . $book->preview_page_1) }}"
                                    class="page-preview img-thumbnail"
                                    alt="Preview Page 1"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/130x170?text=No+Preview';">

                            </div>

                        @endif

                    </div>


                    <!-- Page 2 -->

                    <div class="col-md-6 mb-4">

                        <label class="font-weight-bold">

                            Preview Page 2

                        </label>

                        <input
                            type="file"
                            name="preview_page_2"
                            class="form-control"
                            accept="image/*">

                        @if(!empty($book->preview_page_2))

                            <div class="mt-2">

                                <img
                                    src="{{ asset('storage/' . $book->preview_page_2) }}"
                                    class="page-preview img-thumbnail"
                                    alt="Preview Page 2"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/130x170?text=No+Preview';">

                            </div>

                        @endif

                    </div>


                    <!-- Page 3 -->

                    <div class="col-md-6 mb-4">

                        <label class="font-weight-bold">

                            Preview Page 3

                        </label>

                        <input
                            type="file"
                            name="preview_page_3"
                            class="form-control"
                            accept="image/*">

                        @if(!empty($book->preview_page_3))

                            <div class="mt-2">

                                <img
                                    src="{{ asset('storage/' . $book->preview_page_3) }}"
                                    class="page-preview img-thumbnail"
                                    alt="Preview Page 3"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/130x170?text=No+Preview';">

                            </div>

                        @endif

                    </div>


                    <!-- Page 4 -->

                    <div class="col-md-6 mb-4">

                        <label class="font-weight-bold">

                            Preview Page 4

                        </label>

                        <input
                            type="file"
                            name="preview_page_4"
                            class="form-control"
                            accept="image/*">

                        @if(!empty($book->preview_page_4))

                            <div class="mt-2">

                                <img
                                    src="{{ asset('storage/' . $book->preview_page_4) }}"
                                    class="page-preview img-thumbnail"
                                    alt="Preview Page 4"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/130x170?text=No+Preview';">

                            </div>

                        @endif

                    </div>


                </div>


                <!-- ========================= -->
                <!-- BUTTONS -->
                <!-- ========================= -->

                <div class="text-right border-top pt-3 mt-3">


                    <a
                        href="{{ route('all_books') }}"
                        class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>


                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fas fa-save"></i>

                        Save Changes

                    </button>


                </div>


            </form>


        </div>

    </div>

</div>


<!-- JavaScript -->

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>


<script>

document.getElementById("photo").addEventListener("change", function(e) {

    if (e.target.files.length) {

        const reader = new FileReader();

        reader.onload = function(event) {

            document.getElementById("previewImage").src =
                event.target.result;

        };

        reader.readAsDataURL(e.target.files[0]);

    }

});

</script>


</body>

</html>