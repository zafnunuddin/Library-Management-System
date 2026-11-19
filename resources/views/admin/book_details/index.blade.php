<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Book Details - {{ $book->title }}</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}"
          rel="stylesheet">

    <style>

        body {
            background: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
            color: #343a40;
        }

        .details-wrapper {
            padding: 25px;
        }

        /* Header */

        .details-title {
            font-size: 28px;
            font-weight: 700;
            border-bottom: 1px solid #6c757d;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .details-title i {
            color: rgb(32, 92, 232);
            margin-right: 10px;
        }

        /* Book Cover */

        .book-cover {
            width: 100%;
            max-width: 325px;
            height: 315px;
            object-fit: cover;
            border: 1px solid #ced4da;
            border-radius: 6px;
        }

        .borrow-btn {
            width: 100%;
            max-width: 325px;
            margin-top: 18px;
            background: rgb(32, 92, 232);
            border: none;
            color: white;
            font-weight: 700;
            padding: 10px;
            border-radius: 5px;
        }

        .borrow-btn:hover {
            background: rgb(24, 75, 190);
            color: white;
        }

        /* Book title */

        .book-title {
            font-size: 31px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .book-author {
            color: #6c757d;
            font-size: 18px;
            margin-bottom: 22px;
        }

        /* Details */

        .book-info {
            font-size: 17px;
            line-height: 1.9;
        }

        .book-info strong {
            font-weight: 700;
        }

        .available {
            color: #198754;
            font-weight: 700;
        }

        .status {
            color: #087cff;
            font-weight: 700;
        }

        /* Abstract */

        .abstract {
            margin-top: 18px;
            font-size: 17px;
            color: #6c757d;
            line-height: 1.6;
        }

        /* TOC */

        .section-title {
            color: rgb(32, 92, 232);
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .toc-box {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 18px 25px;
            margin-bottom: 30px;
        }

        .toc-box ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .toc-box li {
            margin-bottom: 5px;
            font-size: 16px;
        }

        /* Preview */

        .preview-section {
            border-top: 1px solid #dee2e6;
            padding-top: 28px;
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .page-label {
            background: #6c757d;
            color: white;
            padding: 5px 12px;
            border-radius: 7px;
            font-weight: 600;
        }

        .preview-box {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            background: white;
        }

        .preview-image {
            width: 100%;
            max-height: 600px;
            object-fit: contain;
            border-radius: 6px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.15);
        }

        /* Navigation */

        .preview-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .preview-navigation button {
            min-width: 140px;
        }

        /* Close */

        .close-area {
            text-align: right;
            margin-top: 25px;
        }

        .close-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 25px;
            border-radius: 6px;
        }

        .close-btn:hover {
            background: #545b62;
        }

        /* Mobile */

        @media (max-width: 768px) {

            .details-wrapper {
                padding: 15px;
            }

            .details-title {
                font-size: 23px;
            }

            .book-title {
                font-size: 25px;
                margin-top: 20px;
            }

            .book-cover,
            .borrow-btn {
                max-width: 100%;
            }

            .book-info {
                font-size: 15px;
            }

            .preview-image {
                max-height: 450px;
            }

        }

    </style>

</head>


<body style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="details-wrapper">

    <!-- ============================= -->
    <!-- BOOK DETAILS HEADER -->
    <!-- ============================= -->

    <div class="details-title">

        <i class="fas fa-info-circle"></i>

        Book Details

    </div>


    <!-- ============================= -->
    <!-- MAIN BOOK INFORMATION -->
    <!-- ============================= -->

    <div class="row">


        <!-- LEFT SIDE -->

        <div class="col-lg-3 col-md-4 text-center">

            @php
                $coverUrl = $book->photo ? asset('storage/' . $book->photo) : 'https://via.placeholder.com/325x315?text=No+Cover+Available';
            @endphp

            <img
                src="{{ $coverUrl }}"
                class="book-cover"
                alt="{{ $book->title }}"
                onerror="this.onerror=null; this.src='https://via.placeholder.com/325x315?text=No+Cover+Available';">

        </div>


        <!-- RIGHT SIDE -->

        <div class="col-lg-9 col-md-8">

            <div class="book-title">

                {{ $book->title }}

            </div>


            <div class="book-author">

                By {{ $book->author }}

            </div>


            <div class="row book-info">

                <!-- Column 1 -->

                <div class="col-md-4">

                    <div>
                        <strong>Serial No:</strong>
                        {{ $book->serial_no ?? 'N/A' }}
                    </div>

                    <div>
                        <strong>Publication Year:</strong>
                        {{ $book->publication_year ?? 'N/A' }}
                    </div>

                    <div>
                        <strong>Genre:</strong>
                        {{ $book->genre }}
                    </div>

                    <div class="available">
                        Available Copies:
                        {{ $book->available_quantity }}
                    </div>

                    <div class="status">
                        Status:
                        {{ $book->status }}
                    </div>

                </div>


                <!-- Column 2 -->

                <div class="col-md-4">

                    <div>
                        <strong>ISBN:</strong>
                        {{ $book->isbn ?? 'N/A' }}
                    </div>

                    <div>
                        <strong>Publisher:</strong>
                        {{ $book->publisher ?? 'N/A' }}
                    </div>

                    <div>
                        <strong>Shelf Location:</strong>
                        {{ $book->shelf_location ?? 'N/A' }}
                    </div>

                </div>


                <!-- Column 3 -->

                <div class="col-md-4">

                    <div>
                        <strong>Edition:</strong>
                        {{ $book->edition }}
                    </div>

                    <div>
                        <strong>Language:</strong>
                        {{ $book->language ?? 'N/A' }}
                    </div>

                    <div>
                        <strong>Total Copies:</strong>
                        {{ $book->quantity }}
                    </div>

                    <div>
                        <strong>Printing No:</strong>
                        {{ $book->printing_no ?? 'N/A' }}
                    </div>

                </div>

            </div>


            <!-- Abstract -->

            <div class="abstract">

                <strong>
                    Book Abstract:
                </strong>

                {{ $book->book_abstract ?? 'No abstract available.' }}

            </div>


            <!-- ============================= -->
            <!-- TABLE OF CONTENTS -->
            <!-- ============================= -->

            <div class="mt-3">

                <div class="section-title">

                    <i class="fas fa-align-left mr-2"></i>

                    Table of Contents
                    (Chapters & Topics)

                </div>


                <div class="toc-box">

                    @if($book->table_of_contents)

                        <ul>

                            @foreach(explode("\n", $book->table_of_contents) as $toc)

                                @if(trim($toc) != '')

                                    <li>
                                        {{ $toc }}
                                    </li>

                                @endif

                            @endforeach

                        </ul>

                    @else

                        <p class="mb-0 text-muted">
                            No table of contents available.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- ============================= -->
    <!-- SAMPLE BOOK PREVIEW -->
    <!-- ============================= -->

    <div class="preview-section">


        <div class="preview-header">

            <div class="section-title mb-0">

                <i class="fas fa-book mr-2"></i>

                Sample Book Preview

            </div>


            <span
                class="page-label"
                id="pageLabel">

                Cover Page

            </span>

        </div>


        <div class="preview-box">

            @php
                $fallbackCover = $book->photo ? asset('storage/' . $book->photo) : 'https://via.placeholder.com/500x600?text=No+Preview+Available';

                $previewImages = [
                    $book->preview_cover ? asset('storage/' . $book->preview_cover) : $fallbackCover,
                    $book->preview_page_1 ? asset('storage/' . $book->preview_page_1) : 'https://via.placeholder.com/500x600?text=Page+1+Not+Available',
                    $book->preview_page_2 ? asset('storage/' . $book->preview_page_2) : 'https://via.placeholder.com/500x600?text=Page+2+Not+Available',
                    $book->preview_page_3 ? asset('storage/' . $book->preview_page_3) : 'https://via.placeholder.com/500x600?text=Page+3+Not+Available',
                    $book->preview_page_4 ? asset('storage/' . $book->preview_page_4) : 'https://via.placeholder.com/500x600?text=Page+4+Not+Available',
                ];
            @endphp


            <img
                id="previewImage"
                class="preview-image"
                src="{{ $previewImages[0] }}"
                alt="Book Preview"
                onerror="this.onerror=null; this.src='https://via.placeholder.com/500x600?text=Preview+Image+Not+Found';">


            <div class="preview-navigation">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    id="previousBtn"
                    onclick="previousPage()"
                    disabled>

                    <i class="fas fa-chevron-left"></i>

                    Previous Page

                </button>


                <button
                    type="button"
                    class="btn btn-outline-primary"
                    id="nextBtn"
                    onclick="nextPage()">

                    Next Page

                    <i class="fas fa-chevron-right"></i>

                </button>

            </div>

        </div>


    </div>


    <!-- Close -->

    <div class="close-area">

        <button
            type="button"
            class="close-btn"
            onclick="history.back()">

            Close

        </button>

    </div>


</div>


<script>
    const previewImages = @json($previewImages);

    let currentPage = 0;

    const labels = [
        "Cover Page",
        "Page 1",
        "Page 2",
        "Page 3",
        "Page 4"
    ];

    function updatePreview() {
        const image = document.getElementById('previewImage');
        const label = document.getElementById('pageLabel');
        const previous = document.getElementById('previousBtn');
        const next = document.getElementById('nextBtn');

        image.src = previewImages[currentPage];
        label.innerText = labels[currentPage];

        previous.disabled = currentPage === 0;
        next.disabled = currentPage === previewImages.length - 1;
    }

    function nextPage() {
        if (currentPage < previewImages.length - 1) {
            currentPage++;
            updatePreview();
        }
    }

    function previousPage() {
        if (currentPage > 0) {
            currentPage--;
            updatePreview();
        }
    }
</script>


</body>

</html>