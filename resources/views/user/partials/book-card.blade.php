@php
    $inStock = $book->available_quantity > 0;
    $alreadyIssued = in_array($book->id, $issuedBookIds ?? []);
    $alreadyPending = in_array($book->id, $pendingBookIds ?? []);
    $modalId = 'bookModal'.$book->id;

    // ---- Sample Book Preview slides -----------------------------------
    // Prefer real uploaded images (preview_cover / preview_page_1..4) when
    // an admin has set them. When a slot is empty, fall back to a
    // generated "parchment note" slide built from the book's own fields,
    // so every book -- not just ones with uploaded preview images -- gets
    // a working, useful preview.
    $firstChapter = null;
    if ($book->table_of_contents) {
        $lines = preg_split('/\r\n|\r|\n/', trim($book->table_of_contents));
        $firstChapter = $lines[0] ?? null;
    }

    $slides = [];

    // Slide 0: Cover
    $slides[] = [
        'label' => 'Cover Page',
        'type' => $book->preview_cover ? 'image' : 'cover',
        'image' => $book->preview_cover,
    ];

    // Slide 1: Preface / About this book
    $slides[] = [
        'label' => 'Page 1',
        'type' => $book->preview_page_1 ? 'image' : 'note',
        'image' => $book->preview_page_1,
        'eyebrow' => 'PREFACE',
        'heading' => 'About This Book',
        'body' => $book->book_abstract
            ?: $book->description
            ?: 'This edition explores the subject in depth, with a structured path from fundamentals to advanced topics.',
        'footer' => $book->title.' - Page 1 of 3',
    ];

    // Slide 2: Chapter 1 sample
    $slides[] = [
        'label' => 'Page 2',
        'type' => $book->preview_page_2 ? 'image' : 'note',
        'image' => $book->preview_page_2,
        'eyebrow' => 'CHAPTER 1',
        'heading' => $firstChapter ? preg_replace('/^Chapter\s*1:?\s*/i', '', $firstChapter) : 'Getting Started',
        'body' => 'This chapter lays the groundwork for the rest of the book, introducing the core ideas and terminology used throughout.',
        'footer' => $book->title.' - Page 2 of 3',
    ];

    // Slide 3: Review questions
    $slides[] = [
        'label' => 'Page 3',
        'type' => $book->preview_page_3 ? 'image' : 'note',
        'image' => $book->preview_page_3,
        'eyebrow' => 'REVIEW',
        'heading' => 'End-of-Chapter Questions',
        'body' => null,
        'questions' => [
            'What are the main goals covered in Chapter 1?',
            'Summarize the key terms introduced so far.',
            'How does this topic connect to real-world practice?',
        ],
        'footer' => $book->title.' - Page 3 of 3',
    ];

    if ($book->preview_page_4) {
        $slides[] = [
            'label' => 'Page 4',
            'type' => 'image',
            'image' => $book->preview_page_4,
        ];
    }
@endphp

<div class="card book-card shadow-sm position-relative">
    @if(!empty($isNew) && $isNew)
        <span class="badge bg-danger new-badge">NEW</span>
    @endif
    <span class="badge bg-info text-dark genre-badge">{{ $book->genre ?? 'General' }}</span>

    @if($book->photo)
        <img src="{{ asset('storage/'.$book->photo) }}" class="card-img-top" alt="{{ $book->title }}">
    @else
        <div class="card-img-top d-flex align-items-center justify-content-center text-muted">
            <i class="bi bi-book" style="font-size:3rem;"></i>
        </div>
    @endif

    <div class="card-body d-flex flex-column">
        <h6 class="fw-bold mb-1">{{ $book->title }}</h6>
        <p class="text-muted small mb-2">By {{ $book->author }}</p>

        @if($inStock)
            <p class="small text-success mb-2"><i class="bi bi-check-circle"></i> Qty: {{ $book->available_quantity }} Available</p>
        @else
            <p class="small text-danger mb-2"><i class="bi bi-x-circle"></i> Qty: 0 (Out of Stock)</p>
        @endif

        <div class="mt-auto d-flex gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm flex-fill" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                <i class="bi bi-info-circle"></i> Book Details
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="{{ $modalId }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="bi bi-info-circle text-primary"></i> Book Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        @if($book->photo)
                            <img src="{{ asset('storage/'.$book->photo) }}" class="img-fluid rounded" alt="{{ $book->title }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:190px;">
                                <i class="bi bi-book text-muted" style="font-size:3rem;"></i>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <h4 class="fw-bold mb-0">{{ $book->title }}</h4>
                        <p class="text-muted mb-3">By {{ $book->author }}</p>

                        <div class="row row-cols-1 row-cols-sm-3 g-2 small mb-2">
                            <div class="col"><strong>Serial No:</strong><br>{{ $book->serial_no ?? '—' }}</div>
                            <div class="col"><strong>ISBN:</strong><br>{{ $book->isbn ?? '—' }}</div>
                            <div class="col"><strong>Edition:</strong><br>{{ $book->edition ?? '—' }}</div>

                            <div class="col"><strong>Publication Year:</strong><br>{{ $book->publication_year ?? '—' }}</div>
                            <div class="col"><strong>Publisher:</strong><br>{{ $book->publisher ?? '—' }}</div>
                            <div class="col"><strong>Language:</strong><br>{{ $book->language ?? '—' }}</div>

                            <div class="col"><strong>Genre:</strong><br>{{ $book->genre ?? '—' }}</div>
                            <div class="col"><strong>Shelf Location:</strong><br>{{ $book->shelf_location ?? '—' }}</div>
                            <div class="col"><strong>Total Copies:</strong><br>{{ $book->quantity }}</div>
                        </div>

                        <p class="mb-1 fw-bold {{ $inStock ? 'text-success' : 'text-danger' }}">
                            Available Copies: {{ $book->available_quantity }}
                        </p>
                        <p class="mb-2">
                            <strong>Status:</strong>
                            @if($alreadyIssued)
                                <span class="text-primary">Issued to You</span>
                            @elseif($alreadyPending)
                                <span class="text-warning">Request Pending</span>
                            @elseif($inStock)
                                <span class="text-primary">Available for Issue</span>
                            @else
                                <span class="text-danger">Currently Unavailable</span>
                            @endif
                        </p>

                        @if($book->book_abstract || $book->description)
                            <p class="text-muted small mb-0">{{ $book->book_abstract ?: $book->description }}</p>
                        @endif
                    </div>
                </div>

                @if($book->table_of_contents)
                    <hr>
                    <h6 class="fw-bold text-primary"><i class="bi bi-list-ul"></i> Table of Contents (Chapters &amp; Topics)</h6>
                    <div class="border rounded p-3 bg-light bg-opacity-50">
                        <ul class="mb-0">
                            @foreach(preg_split('/\r\n|\r|\n/', trim($book->table_of_contents)) as $line)
                                @if(trim($line) !== '')
                                    <li>{{ $line }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                <hr>

                {{-- ============ SAMPLE BOOK PREVIEW ============ --}}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold text-primary mb-0"><i class="bi bi-journal-richtext"></i> Sample Book Preview</h6>
                    <span class="badge bg-secondary" data-preview-label="{{ $modalId }}">{{ $slides[0]['label'] }}</span>
                </div>

                <div class="book-preview-viewport" data-preview-viewport="{{ $modalId }}" data-total="{{ count($slides) }}">
                    @foreach($slides as $i => $slide)
                        <div class="book-preview-slide" data-preview-slide="{{ $modalId }}" data-index="{{ $i }}" style="{{ $i === 0 ? '' : 'display:none;' }}">
                            @if($slide['type'] === 'image')
                                <img src="{{ asset('storage/'.$slide['image']) }}" class="w-100 rounded" style="max-height:280px;object-fit:cover;" alt="{{ $slide['label'] }}">
                            @elseif($slide['type'] === 'cover')
                                <div class="preview-cover-fallback rounded d-flex flex-column justify-content-end p-3"
                                     style="background-image:{{ $book->photo ? "url('".asset('storage/'.$book->photo)."')" : 'none' }};">
                                    <div class="preview-cover-overlay rounded p-3">
                                        <span class="badge bg-light text-dark mb-2">{{ strtoupper($book->genre ?? 'BOOK') }}</span>
                                        <h5 class="text-white fw-bold mb-1">{{ $book->title }}</h5>
                                        <p class="text-white-50 mb-1">By {{ $book->author }}</p>
                                        <span class="badge bg-light text-dark">{{ $book->edition ?? '' }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="preview-note rounded p-4 text-center">
                                    <div class="text-uppercase small fw-bold text-secondary" style="letter-spacing:2px;">{{ $slide['eyebrow'] }}</div>
                                    <h5 class="fw-bold my-2">{{ $slide['heading'] }}</h5>
                                    <hr class="w-25 mx-auto">
                                    @if(!empty($slide['body']))
                                        <p class="mb-2">{{ $slide['body'] }}</p>
                                    @endif
                                    @if(!empty($slide['questions']))
                                        <ol class="text-start d-inline-block mb-2">
                                            @foreach($slide['questions'] as $q)
                                                <li>{{ $q }}</li>
                                            @endforeach
                                        </ol>
                                    @endif
                                    <p class="small fst-italic text-muted mb-0">{{ $slide['footer'] }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" disabled
                            data-preview-prev="{{ $modalId }}" onclick="lmsPreviewNav('{{ $modalId }}', -1)">
                        <i class="bi bi-chevron-left"></i> Previous Page
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-preview-next="{{ $modalId }}" onclick="lmsPreviewNav('{{ $modalId }}', 1)">
                        Next Page <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                @if($alreadyIssued)
                    <span class="badge bg-primary p-2">You already have this book issued</span>
                @elseif($alreadyPending)
                    <span class="badge bg-warning text-dark p-2">Request Pending Approval</span>
                @elseif(!$inStock)
                    <button class="btn btn-secondary" disabled>Out of Stock</button>
                @else
                    <form action="{{ route('user.books.request', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-bookmark-plus"></i> Request to Borrow
                        </button>
                    </form>
                @endif
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .preview-cover-fallback {
        min-height: 220px;
        background-size: cover;
        background-position: center;
        background-color: #10131a;
    }
    .preview-cover-overlay {
        background: linear-gradient(to top, rgba(0,0,0,.85), rgba(0,0,0,.15));
    }
    .preview-note {
        min-height: 220px;
        background: #fbf3e1;
        border: 1px solid #d9c9a3;
        color: #4a3f2c;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    [data-bs-theme="dark"] .preview-note { background: #2a2416; color: #ecdfc0; border-color: #4a3f2c; }
</style>
